<?php
if(PHP_SAPI!=='cli')exit;require __DIR__.'/../core/init.php';sc_db()->query(ltrim(file_get_contents(__DIR__.'/../db/migrations/20261122_admin_tasks.sql'),"\xEF\xBB\xBF"));echo "Personal follow-up table ready.\n";
