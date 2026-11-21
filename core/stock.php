<?php
function sc_stock_site() { return (int)systemVariable('default_site_id'); }
function sc_available($id) { return (int)sc_query('SELECT COALESCE(SUM(GREATEST(quantity,0)),0) AS n FROM inventory WHERE product_id=? AND site_id=?','ii',[(int)$id,sc_stock_site()])->get_result()->fetch_assoc()['n']; }
// Caller owns the transaction. Lock inventory rows before changing balances.
function sc_stock_log($row,$old,$new,$actor,$remarks,$invoice='') {
 $last=sc_query('SELECT transactionid FROM inventory_transactions ORDER BY transactionid DESC LIMIT 1 FOR UPDATE')->get_result()->fetch_assoc();$serial=($last['transactionid']??0)+1;$change=abs($new-$old);$type=$new<$old?1:0;$product=sc_query('SELECT price,discounted_price FROM products WHERE id=?','i',[$row['product_id']])->get_result()->fetch_assoc();$amount=$product?sc_price($product)*$change/100:0;
 sc_query('INSERT INTO inventory_transactions (transactionid,inventory_id,site_id,product_id,old_quantity,new_quantity,change_quantity,transaction_type,amount,invoice,remarks,created_by,updated_by) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)','iiiiiiiidssii',[$serial,$row['id'],$row['site_id'],$row['product_id'],$old,$new,$change,$type,$amount,$invoice,mb_substr($remarks,0,200),$actor,$actor]);
}
function sc_stock_deduct($orderId,$items) {
 usort($items,fn($a,$b)=>$a['id']<=>$b['id']);
 foreach($items as $p){$rows=sc_query('SELECT * FROM inventory WHERE product_id=? AND site_id=? ORDER BY id FOR UPDATE','ii',[$p['id'],sc_stock_site()])->get_result()->fetch_all(MYSQLI_ASSOC);$available=array_sum(array_map(fn($r)=>max(0,(int)$r['quantity']),$rows));if($available<$p['quantity'])throw new RuntimeException('Insufficient stock for '.$p['product_name'].'. Please update your cart.');$remaining=$p['quantity'];
 foreach($rows as $row){$take=min($remaining,max(0,(int)$row['quantity']));if(!$take)continue;$new=$row['quantity']-$take;sc_query('UPDATE inventory SET quantity=? WHERE id=?','ii',[$new,$row['id']]);sc_query('INSERT INTO web_order_stock (order_id,inventory_id,quantity) VALUES (?,?,?)','iii',[$orderId,$row['id'],$take]);sc_stock_log($row,(int)$row['quantity'],$new,1,'Online order #'.$orderId);$remaining-=$take;if(!$remaining)break;}}
}
function sc_stock_cancel($orderId,$actor) {
 $db=sc_db();$db->begin_transaction();try{$order=sc_query('SELECT * FROM web_orders WHERE id=? FOR UPDATE','i',[$orderId])->get_result()->fetch_assoc();if(!$order)throw new RuntimeException('Order not found.');if($order['status']==='cancelled'){$db->commit();return;}if($order['status']!=='placed')throw new RuntimeException('Only placed orders can be cancelled.');
 $rows=sc_query('SELECT i.*,s.quantity AS restore_quantity FROM web_order_stock s JOIN inventory i ON i.id=s.inventory_id WHERE s.order_id=? ORDER BY i.product_id,i.id FOR UPDATE','i',[$orderId])->get_result()->fetch_all(MYSQLI_ASSOC);
 foreach($rows as $row){$new=$row['quantity']+$row['restore_quantity'];sc_query('UPDATE inventory SET quantity=?,updated_by=? WHERE id=?','iii',[$new,$actor,$row['id']]);sc_stock_log($row,(int)$row['quantity'],$new,$actor,'Cancelled online order #'.$orderId);}
 sc_query("UPDATE web_orders SET status='cancelled' WHERE id=?",'i',[$orderId]);sc_audit('order.cancelled',$orderId);$db->commit();}catch(Throwable $e){$db->rollback();throw $e;}
}
function sc_admin_guard($module,$action,$request) {
 if(session_status()===PHP_SESSION_NONE)session_start();
 if(empty($_SESSION[USER_AUTH]))throw new RuntimeException('Please log in as an administrator.');
 if(!hash_equals(sc_csrf(),(string)($request['csrf']??'')))throw new RuntimeException('Your session expired. Reload the form.');
 $user=sc_query('SELECT * FROM users WHERE userid=? AND is_active=1 AND is_deleted=0','s',[$_SESSION[USER_AUTH]])->get_result()->fetch_assoc();if(!$user)throw new RuntimeException('Administrator not found.');
 if((int)$user['user_group']!==1){$slug=$module.':'.$action;$r=sc_query('SELECT p.id FROM permissions p LEFT JOIN user_permissions up ON up.permission_id=p.id AND up.user_id=? AND up.allow=1 LEFT JOIN group_permissions gp ON gp.permission_id=p.id AND gp.group_id=? AND gp.allow=1 WHERE p.slug=? AND (up.user_id IS NOT NULL OR gp.group_id IS NOT NULL) LIMIT 1','iis',[$user['id'],$user['user_group'],$slug])->get_result()->fetch_assoc();if(!$r)throw new RuntimeException('You do not have permission for this action.');}
 return $user;
}
function sc_add_stock($request) {
 try{$actor=sc_admin_guard('inventory','update',$request);$productId=filter_var($request['product_id']??0,FILTER_VALIDATE_INT);$siteId=filter_var($request['site_id']??0,FILTER_VALIDATE_INT);$qty=filter_var($request['change_quantity']??0,FILTER_VALIDATE_INT);if(!$productId||!$siteId||!$qty||$qty<1||$qty>100000)throw new RuntimeException('Choose a product, site and positive whole-number quantity.');
 if(!in_array((int)$actor['user_group'],[1,2],true)&&(int)$actor['treatment_site']!==$siteId)throw new RuntimeException('You can only add stock to your assigned site.');
 if(!sc_product($productId)||!sc_query('SELECT id FROM sites WHERE id=? AND is_active=1 AND is_deleted=0','i',[$siteId])->get_result()->fetch_assoc())throw new RuntimeException('Choose an active product and treatment site.');
 $invoice='';if(!empty($_FILES['invoice']['name'])){if($_FILES['invoice']['error']!==UPLOAD_ERR_OK || $_FILES['invoice']['size']>1048576)throw new RuntimeException('Invoice upload must be at most 1 MB.');$mime=(new finfo(FILEINFO_MIME_TYPE))->file($_FILES['invoice']['tmp_name']);if(!in_array($mime,['application/pdf','image/jpeg','image/png','image/webp','image/gif'],true))throw new RuntimeException('Upload an image or PDF invoice.');if($mime==='application/pdf')$_FILES['invoice']['name']='invoice.pdf';$upload=upload_file('invoice');if($upload['status']!=='success')throw new RuntimeException($upload['message']);$invoice=$upload['file_name'];}
 $db=sc_db();$db->begin_transaction();try{
 sc_query('SELECT id FROM products WHERE id=? FOR UPDATE','i',[$productId]);
 $row=sc_query('SELECT * FROM inventory WHERE product_id=? AND site_id=? ORDER BY id LIMIT 1 FOR UPDATE','ii',[$productId,$siteId])->get_result()->fetch_assoc();
 if(!$row){$last=sc_query('SELECT inventoryid FROM inventory ORDER BY inventoryid DESC LIMIT 1 FOR UPDATE')->get_result()->fetch_assoc();$serial=($last['inventoryid']??0)+1;sc_query('INSERT INTO inventory (inventoryid,site_id,product_id,quantity,created_by,updated_by) VALUES (?,?,?,0,?,?)','iiiii',[$serial,$siteId,$productId,$actor['id'],$actor['id']]);$row=['id'=>$db->insert_id,'site_id'=>$siteId,'product_id'=>$productId,'quantity'=>0];}
 $new=$row['quantity']+$qty;sc_query('UPDATE inventory SET quantity=?,updated_by=? WHERE id=?','iii',[$new,$actor['id'],$row['id']]);sc_stock_log($row,(int)$row['quantity'],$new,$actor['id'],trim($request['remarks']??'Stock received'),$invoice);sc_audit('inventory.received',$row['id']);$db->commit();return ['status'=>'success','message'=>'Stock received and movement recorded.'];}catch(Throwable $e){$db->rollback();throw $e;}
 }catch(mysqli_sql_exception $e){error_log($e->getMessage());return ['status'=>'failed','message'=>'Stock could not be saved. Please try again.'];}catch(RuntimeException $e){return ['status'=>'failed','message'=>$e->getMessage()];}
}
