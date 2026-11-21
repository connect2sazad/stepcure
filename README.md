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

### Dashboard, search assistance and personal follow-ups

The dashboard uses bounded recent-record widgets without DataTables. Reporting periods are 7/30/90/365 days or all time; clinic sales value is distinguished from payment receipts. The permission-aware attention queue highlights pending reports, orders awaiting dispatch, delivered orders with unpaid COD and low-stock locations (threshold five units). Quick actions and privately owned follow-up tasks with optional due dates are available. Existing dashboard arrangement remains per-browser/per-user.

Apply `db/migrations/20261122_admin_tasks.sql` (or run `C:\xampp\php\php.exe tests/admin-tasks-setup.php`) on other deployments. Applied to the current local database. The header search provides debounced suggestions, arrow-key navigation and Ctrl/Cmd+K focus. Results are grouped, filterable and offer feature-word spelling suggestions when empty. It does not index PDF/image text.

Doctor, Aurora, Sandstone, Blueprint, Botanical and Neon Atelier are additional per-user appearance presets. Admin footer surfaces are transparent. Wide tables scroll within their own containers; dashboard widgets wrap their content instead of widening the page.

Run `C:\xampp\php\php.exe tests/admin-dashboard.php` for dashboard and task ownership checks. Temporary task fixtures are removed after the test.

### Website details, footer, support and admin auditing

Settings now manages public phone, email, address, opening hours, WhatsApp and social URLs. The Footer sidebar item opens a dedicated editor for the shared public footer text and CTA. Both require the existing `app_settings:update` permission. New values are stored in `systemv`, with existing site details used as defaults; no new database table is required. Contact/footer changes appear on the next public page request.

Follow-up forms submit asynchronously with inline status messages; normal form submissions remain available as a fallback. Select enhancement is opt-in (`data-enhance="search"`), avoiding native/Select2 double controls. Admin pages explicitly request an empty favicon; the public website icon is preserved.

Support includes a bounded ticket list, creation, replies, resolution/reopening, per-user access restrictions outside administrator groups, CSRF protection and safe PDF/image attachments (three files, 1 MB each). New attachments are protected by the root Apache rewrite rule and served only through an authenticated download controller. Legacy attachment references remain supported. Tickets are local; this does not send email or contact an external support service.

New catalog, stock, order, customer access, appearance, follow-up, website-setting and support changes write actor/action/record identifiers to `admin_updates`. Private follow-up text and passwords are excluded. Existing API mutations receive a fallback audit record when their handler did not already write one. Run `C:\xampp\php\php.exe tests/admin-maintenance.php` to verify follow-ups, audit entries, support workflows, footer propagation, URL validation and admin favicon behavior; temporary fixtures are removed.

### Festive season mode and context shortcuts

Admin > Festive Season (also linked from Settings) manually enables homepage-only effects. Access requires `app_settings:update`. Supported presets: Diwali, Holi, Eid al-Fitr, Eid al-Adha/Bakr Eid, Christmas, Dussehra, New Year, Easter, Ramadan, Navratri/Durga Puja, Ganesh Chaturthi and Onam. Settings include enable/disable, festival, gentle/balanced/lively particle levels and an optional 160-character greeting. Values live in `systemv`; no migration is needed. Default is disabled. There is no automatic festival-date scheduling.

Diwali and New Year have a bottom sky-rocket launcher with multicolour bursts. Holi creates colour splashes on clicks in non-interactive page areas. Eid/Ramadan use crescent/lantern decorations and golden stars, Christmas uses gentle snowfall, and other presets use petals/confetti. No sound is played. Links, form controls and shopping buttons do not trigger page effects. A visitor pause control, reduced-motion handling, particle limits, capped device-pixel ratio and hidden-tab suspension are included.

The admin can preview a selected festival on the homepage without publishing. Preview parameters work only for an authenticated administrator with settings-update permission; anonymous visitors cannot force effects on through a URL. Saving festive settings is audited. Tests restore the original settings afterwards: `C:\xampp\php\php.exe tests/festivals.php` and `node tests/festival-effects.cjs`.

The custom context menu is a flat, viewport-clamped, keyboard-accessible menu using the active theme's surface/text colours. Page/menu creation entries are removed. Private follow-up focuses the dashboard form or opens an inline-saving dialog elsewhere. Native text editing/selection menus remain available, and Shift + right-click preserves the browser menu.
