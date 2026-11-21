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
## Online storefront

Online registration/login, database product categories and product details, session cart, COD checkout, customer account and order history are supported. Admin users with the existing sale/view permission can review orders at `/admin/online-orders/` (also linked from Sales).

Apply `db/migrations/20261121_storefront_orders.sql` before deploying. On local XAMPP, `C:\xampp\php\php.exe tests/storefront-setup.php` applies the additive order-table migration. This migration has been applied to the current local database. No existing products or users are changed.

Manage available products, categories, uploaded images, regular/discounted prices and tax percentages through the existing admin screens. Only active, non-deleted products with positive prices can be purchased. Amounts are INR; checkout adds the configured CGST+SGST for Odisha or IGST for other states. Shipping is currently zero. Checkout records cash-on-delivery orders as unpaid; no card/UPI processing, stock reservation, size variants or payment gateway is implemented in this version. Order totals and product names/prices are snapshotted in the order tables. Admin order review is read-only.

Run `node tests/storefront-flow.cjs` against local XAMPP for the HTTP integration checks. It creates a uniquely named temporary account, places a test COD order, verifies access and CSRF behavior, and removes only its own fixtures afterwards. Never run this test against a production store.
