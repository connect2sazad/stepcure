<?php
if(PHP_SAPI!=='cli'){http_response_code(404);exit;}
require __DIR__.'/../core/init.php';
$email=$argv[1]??'';if(!preg_match('/^sc-test-[a-f0-9]{10}@example\.invalid$/',$email))exit(1);
$db=sc_db();$db->begin_transaction();
try{ $user=sc_query('SELECT id FROM online_users WHERE email=?','s',[$email])->get_result()->fetch_assoc();if($user){sc_query('DELETE i FROM web_order_items i JOIN web_orders o ON o.id=i.order_id WHERE o.online_user_id=?','i',[$user['id']]);sc_query('DELETE FROM web_orders WHERE online_user_id=?','i',[$user['id']]);sc_query('DELETE FROM online_users WHERE id=? AND email=?','is',[$user['id'],$email]);}$db->commit();echo "Temporary test account and orders removed.\n";}catch(Throwable $e){$db->rollback();exit(1);}
