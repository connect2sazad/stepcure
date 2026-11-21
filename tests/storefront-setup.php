<?php if(PHP_SAPI!=='cli'){http_response_code(404);exit;}
require __DIR__.'/../core/init.php';
$db=sc_db();$sql=file_get_contents(__DIR__.'/../db/migrations/20261121_storefront_orders.sql');$sql=ltrim($sql,"\xEF\xBB\xBF");$db->multi_query($sql);do{if($r=$db->store_result())$r->free();}while($db->more_results() && $db->next_result());
echo "Order tables ready.\n";
foreach(['online_users','products'] as $table){$r=$db->query("SHOW COLUMNS FROM $table");echo $table.': ';while($c=$r->fetch_assoc())echo $c['Field'].' ';echo "\n";}
echo 'Available products: '.$db->query('SELECT COUNT(*) AS n FROM products WHERE is_active=1 AND is_deleted=0')->fetch_assoc()['n']."\n";
