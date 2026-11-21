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

Manage available products, categories, uploaded images, regular/discounted prices and tax percentages through the existing admin screens. Only active, non-deleted products with positive prices can be purchased. Amounts are INR; checkout adds the configured CGST+SGST for Odisha or IGST for other states. Shipping is currently zero. Checkout records cash-on-delivery orders as unpaid; no card/UPI processing, size variants or payment gateway is implemented in this version. Order totals and product names/prices are snapshotted in the order tables. Admins with sale/update permission can cancel placed orders and restore their deducted stock once.

Run `node tests/storefront-flow.cjs` against local XAMPP for the HTTP integration checks. It creates a uniquely named temporary account, places a test COD order, verifies access and CSRF behavior, and removes only its own fixtures afterwards. Never run this test against a production store.

### Catalog and stock tracking

Apply `db/migrations/20261122_online_stock.sql` after the order-table migration (or run `C:\xampp\php\php.exe tests/stock-setup.php` locally). Applied to the current local database. Pre-existing orders are left unchanged and do not receive a retrospective stock deduction.

Product and category create/edit endpoints require an authenticated administrator, module permissions and CSRF protection. Products start with zero stock; receive units through Admin > Inventory > Add Stock. Custom Footwear is available as product type 3. Images support JPEG/PNG/WebP/GIF up to 1 MB each.

The storefront uses existing `inventory` balances for the configured `default_site_id`. Checkout locks the applicable inventory rows, refuses shortages and deducts units in the same transaction as saving the order. Every deduction and cancellation restock is recorded in existing `inventory_transactions`. `web_order_stock` maps each order to the exact inventory rows to restore. Only placed orders can be cancelled; repeated cancellation does not increase stock twice. Other clinic sites are not pooled into online availability.

Run `C:\xampp\php\php.exe tests/catalog-stock.php` locally to check category/product creation and editing, stock receipts, shortages, stock deduction, cancellation/restoration and authentication checks. This creates and removes only its own temporary catalog fixtures. Do not run on production.
### Admin commerce sections and search

The sidebar includes Online Users, Online Orders and Appearance. Online customer and order views use the existing `sale:view` permission, with changes requiring `sale:update`; staff accounts and online customers remain separate. Customer access can be enabled/disabled without deleting their order history. Placed orders may be shipped or cancelled; shipped orders may be marked delivered; COD payment can be confirmed after delivery. Cancellation restocks only orders with a recorded stock deduction.

The header search submits to `/admin/search/`. Search covers permitted features, product/category records, customers, orders, staff, patients, invoices, consultation/report records, sites, sales and page content. It does not read arbitrary files or index PDF/image contents. Consultation results retain site restrictions for users outside the admin groups.

Appearance adds Red Blood, Chess Board and Cartoon presets. Themes are saved per account. SQL-paged tables skip DataTables entirely, including after AJAX updates, so there is one pagination control per table. Native selects are used for page sizes; other enhanced selects are initialized only once. The opaque sidebar brand reads StepCure, and its fading scroll-shadow layer is removed.
