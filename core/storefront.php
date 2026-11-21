<?php
// Shared storefront helpers. All mutations run before the theme emits HTML.
function sc_db() { static $db; if (!$db) { $db = get_conn(); $db->set_charset('utf8mb4'); } return $db; }
function sc_query($sql, $types = '', $params = []) { $s = sc_db()->prepare($sql); if ($types !== '') $s->bind_param($types, ...$params); $s->execute(); return $s; }
function sc_e($v) { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }
function sc_url($path = '') { return rtrim(systemVariable('SITE_HOME'), '/') . '/' . ltrim($path, '/'); }
function sc_redirect($path) { header('Location: ' . sc_url($path), true, 303); exit; }
function sc_csrf() { if (empty($_SESSION['sc_csrf'])) $_SESSION['sc_csrf'] = bin2hex(random_bytes(32)); return $_SESSION['sc_csrf']; }
function sc_token() { return '<input type="hidden" name="csrf" value="' . sc_e(sc_csrf()) . '">'; }
function sc_user() { if (empty($_SESSION[CLIENT_USER_AUTH])) return null; return sc_query('SELECT id,email,first_name,last_name FROM online_users WHERE email=? AND is_active=1 AND is_deleted=0', 's', [$_SESSION[CLIENT_USER_AUTH]])->get_result()->fetch_assoc(); }
function sc_product($id) { return sc_query('SELECT p.*, c.slug AS category_slug FROM products p JOIN product_categories c ON c.id=p.category_id WHERE p.id=? AND p.is_active=1 AND p.is_deleted=0 AND c.is_active=1 AND c.is_deleted=0', 'i', [$id])->get_result()->fetch_assoc(); }
function sc_price($p) { $price = (float)$p['price']; $discount=(float)$p['discounted_price']; return (int)round(($discount>0 && $discount<$price ? $discount : $price)*100); }
function sc_money($cents) { return '₹' . number_format($cents / 100, 2); }
function sc_image($p) { $images=json_decode($p['product_images'] ?? '[]', true); $image=is_array($images)?($images[0]??''):''; return $image ? sc_url('uploads/' . rawurlencode(basename($image))) : theme_url('assets/img/products/custom-footwear.png'); }
function sc_cart() { $items=[]; foreach (($_SESSION['sc_cart']??[]) as $id=>$qty) { $p=sc_product((int)$id); if($p && sc_price($p)>0) { $p['quantity']=(int)$qty; $p['unit_cents']=sc_price($p); $p['line_cents']=$p['unit_cents']*$p['quantity']; $items[]=$p; } else { unset($_SESSION['sc_cart'][$id]); } } return $items; }
function sc_totals($items, $state='Odisha') { $subtotal=0;$tax=0; foreach($items as $p){$subtotal+=$p['line_cents'];$rate=strcasecmp(trim($state),'Odisha')===0 ? (float)$p['tax1_percent']+(float)$p['tax2_percent'] : (float)$p['igst_percent'];$tax+=(int)round($p['line_cents']*$rate/100);}return ['subtotal'=>$subtotal,'tax'=>$tax,'total'=>$subtotal+$tax]; }
function sc_flash() { if(!empty($_SESSION['sc_flash'])) { echo '<div class="alert alert-info" role="status">'.sc_e($_SESSION['sc_flash']).'</div>';unset($_SESSION['sc_flash']); } }
function sc_auth_register($data) {
 $first=trim($data['first_name']??'');$last=trim($data['last_name']??'');$email=strtolower(trim($data['email']??''));$password=$data['password']??'';
 if(!$first || strlen($first)>50 || strlen($last)>50 || strlen($email)>50 || !filter_var($email,FILTER_VALIDATE_EMAIL))return ['status'=>'failed','message'=>'Enter a valid name and email address (up to 50 characters).'];
 if(strlen($password)<8 || strlen($password)>72)return ['status'=>'failed','message'=>'Use a password between 8 and 72 characters.'];
 // Serialize registrations for the same email, including older schemas without a unique email index.
 $lock='sc_register_'.hash('sha256',$email);$got=sc_query('SELECT GET_LOCK(?, 5) AS acquired','s',[$lock])->get_result()->fetch_assoc();
 if((int)$got['acquired']!==1)return ['status'=>'failed','message'=>'Please try again in a moment.'];
 try {if(sc_query('SELECT id FROM online_users WHERE email=? LIMIT 1','s',[$email])->get_result()->fetch_assoc())return ['status'=>'failed','message'=>'An account already uses this email. Please log in.'];
 $hash=password_hash($password,PASSWORD_DEFAULT);
 sc_query("INSERT INTO online_users (email,password,first_name,last_name,phone,address,address_state,address_city,address_pin,patients,remarks,created_by,updated_by) VALUES (?,?,?,?,'','',0,'','','[]','',1,1)",'ssss',[$email,$hash,$first,$last]);
 return ['status'=>'success','message'=>'Account created. Please log in.'];
 } finally {sc_query('SELECT RELEASE_LOCK(?)','s',[$lock]);}
}
function sc_auth_login($data) {
 $email=strtolower(trim($data['email']??''));$password=$data['password']??'';
 $user=sc_query('SELECT * FROM online_users WHERE email=? AND is_active=1 AND is_deleted=0 LIMIT 1','s',[$email])->get_result()->fetch_assoc();
 if(!$user || !password_verify($password,$user['password']))return ['status'=>'failed','message'=>'Email or password is incorrect.'];
 session_regenerate_id(true);$_SESSION[CLIENT_USER_AUTH]=$user['email'];$_SESSION['sc_csrf']=bin2hex(random_bytes(32));return ['status'=>'success','message'=>'Logged in.'];
}
function sc_dispatch($page) {
 sc_csrf();$GLOBALS['sc_error']=''; if (in_array($page, ['signin','signup'], true) && sc_user()) sc_redirect('account');
 if($_SERVER['REQUEST_METHOD']!=='POST' || !isset($_POST['sc_action']))return;
 if(!hash_equals(sc_csrf(),(string)($_POST['csrf']??''))){http_response_code(403);$GLOBALS['sc_error']='Your session expired. Reload the page and try again.';return;}
 $action=$_POST['sc_action'];
 try {
 if($action==='signup' && $page==='signup') {
  if(($_POST['pass']??'')!==($_POST['re_pass']??''))throw new RuntimeException('The passwords do not match.');
  $r=sc_auth_register(['first_name'=>$_POST['first_name']??'','last_name'=>$_POST['last_name']??'','email'=>$_POST['email']??'','password'=>$_POST['pass']??'']);if($r['status']!=='success')throw new RuntimeException($r['message']);$_SESSION['sc_flash']=$r['message'];sc_redirect('signin');
 }
 if($action==='signin' && $page==='signin') {
  if(time()<($_SESSION['sc_login_after']??0))throw new RuntimeException('Too many attempts. Please wait a minute and try again.');
  $r=sc_auth_login($_POST);if($r['status']!=='success'){$_SESSION['sc_login_attempts']=($_SESSION['sc_login_attempts']??0)+1;if($_SESSION['sc_login_attempts']>=5){$_SESSION['sc_login_after']=time()+60;$_SESSION['sc_login_attempts']=0;}throw new RuntimeException($r['message']);}unset($_SESSION['sc_login_attempts'],$_SESSION['sc_login_after']);sc_redirect(!empty($_SESSION['sc_checkout_return'])?'checkout':'account');
 }
 if($action==='logout'){unset($_SESSION[CLIENT_USER_AUTH]);session_regenerate_id(true);sc_redirect('signin');}
 if($action==='cart_add') {
  $id=filter_var($_POST['product_id']??'',FILTER_VALIDATE_INT);$qty=filter_var($_POST['quantity']??1,FILTER_VALIDATE_INT);$p=$id?sc_product($id):null;
  if(!$p || sc_price($p)<=0 || !$qty || $qty<1 || $qty>20)throw new RuntimeException('Choose an available product and a quantity from 1 to 20.');
  $_SESSION['sc_cart'][$id]=min(20,($_SESSION['sc_cart'][$id]??0)+$qty);$_SESSION['sc_flash']='Added to your cart.';sc_redirect('cart');
 }
 if($action==='cart_update' && $page==='cart') { foreach(($_POST['quantity']??[]) as $id=>$qty){if(!isset($_SESSION['sc_cart'][$id]))continue;$n=filter_var($qty,FILTER_VALIDATE_INT);if($n===false || $n<0 || $n>20)throw new RuntimeException('Quantities must be between 0 and 20.');if($n===0)unset($_SESSION['sc_cart'][$id]);else $_SESSION['sc_cart'][$id]=$n;}sc_redirect('cart');}
 if($action==='place_order' && $page==='checkout') {
  $user=sc_user();if(!$user){$_SESSION['sc_checkout_return']=true;sc_redirect('signin');}
  $items=sc_cart();if(!$items || count($items)!==count($_SESSION['sc_cart']??[]))throw new RuntimeException('Your cart contains unavailable products. Please review your cart before checkout.');
  $fields=[];foreach(['full_name'=>100,'phone'=>15,'address'=>500,'city'=>100,'state'=>80,'pin'=>6] as $key=>$limit){$fields[$key]=trim($_POST[$key]??'');if(!$fields[$key] || strlen($fields[$key])>$limit)throw new RuntimeException('Complete all delivery details within the field limits.');}
  if(!preg_match('/^[6-9][0-9]{9}$/',$fields['phone']) || !preg_match('/^[1-9][0-9]{5}$/',$fields['pin']))throw new RuntimeException('Enter a valid Indian mobile number and six-digit PIN code.');
  $token=(string)($_POST['order_token']??'');if(!hash_equals($_SESSION['sc_order_token']??'', $token) || !$token)throw new RuntimeException('Checkout expired. Reload checkout and try again.');
  $totals=sc_totals($items,$fields['state']);if(isset($_POST['quoted_total']) && (int)$_POST['quoted_total']!==$totals['total'])throw new RuntimeException('Your total has changed for this delivery state. Review the updated amount and place the order again.');$db=sc_db();$db->begin_transaction();
  try { $existing=sc_query('SELECT id FROM web_orders WHERE checkout_token=? AND online_user_id=?','si',[$token,$user['id']])->get_result()->fetch_assoc();
   if(!$existing){$number='SC-'.date('Ymd').'-'.strtoupper(bin2hex(random_bytes(4)));$delivery=json_encode($fields,JSON_THROW_ON_ERROR);$subtotal=$totals['subtotal']/100;$tax=$totals['tax']/100;$total=$totals['total']/100;
    sc_query("INSERT INTO web_orders (order_number,online_user_id,checkout_token,delivery,subtotal,tax,total,payment_method,payment_status,status) VALUES (?,?,?,?,?,?,?,'cod','unpaid','placed')",'sissddd',[$number,$user['id'],$token,$delivery,$subtotal,$tax,$total]);$orderId=$db->insert_id;
    foreach($items as $p){$unit=$p['unit_cents']/100;$line=$p['line_cents']/100;sc_query('INSERT INTO web_order_items (order_id,product_id,product_name,quantity,unit_price,line_total) VALUES (?,?,?,?,?,?)','iisidd',[$orderId,$p['id'],$p['product_name'],$p['quantity'],$unit,$line]);}
   }else{$orderId=$existing['id'];}
   $db->commit();unset($_SESSION['sc_cart'],$_SESSION['sc_order_token'],$_SESSION['sc_checkout_return']);$_SESSION['sc_flash']='Order placed. Payment is due on delivery.';sc_redirect('orders');
  }catch(Throwable $e){$db->rollback();throw $e;}
 }
 } catch(mysqli_sql_exception $e){error_log('Storefront database: '.$e->getMessage());$GLOBALS['sc_error']='We could not save that action. Please try again or contact the store.';} catch(RuntimeException $e){$GLOBALS['sc_error']=$e->getMessage();} catch(Throwable $e){error_log('Storefront: '.$e->getMessage());$GLOBALS['sc_error']='We could not complete that action. Please try again or contact the store.';}
}
