# StepCure

Official Website for StepCure. Stepcure Healthcare offers customized care for all ages with conditions like diabetic foot, flat feet, clubfoot (CTEV), high arches, and foot deformities. Services include aesthetic footwear, insoles, orthotics, splints, and cosmetic foot restoration with advanced scanning technology.


✅ 2. Update if exists, Insert if not (Safe Way)
If you're trying to insert or update the permission safely without getting a duplicate key error, use:

🧠 MySQL Query:
php

$allow = 1;

$query = "INSERT INTO user_permissions (user_id, permission_id, allow)
          VALUES (?, ?, ?)
          ON DUPLICATE KEY UPDATE allow = VALUES(allow)";
$stmt = $pdo->prepare($query);
$stmt->execute([$userId, $permissionId, $allow]);
This automatically updates the permission if it exists or inserts a new one if it doesn’t. No need to manually check.


update address_states
update permissions