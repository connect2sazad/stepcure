<?php
if(PHP_SAPI!=='cli'){http_response_code(404);exit;}require __DIR__.'/../core/init.php';sc_db()->query(ltrim(file_get_contents(__DIR__.'/../db/migrations/20261122_online_stock.sql'),"\xEF\xBB\xBF"));echo "Online stock mapping ready.\n";
