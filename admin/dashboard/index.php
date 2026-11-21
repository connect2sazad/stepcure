<?php
require_once __DIR__ . '/../admin.php';

function dashboardRows($sql): array {
  $result = runQuery($sql);
  $rows = [];
  if ($result) while ($row = mysqli_fetch_assoc($result)) $rows[] = $row;
  return $rows;
}
function dashboardValue($sql, $key = 'value') {
  $rows = dashboardRows($sql);
  return $rows[0][$key] ?? 0;
}

$currentUser = (string) userVariable('userid');
$userSite = (int) (userVariable('treatment_site') ?? 0);
$userGroup = (int) (userVariable('user_group') ?? 0);
$canSeeAllSites = in_array($userGroup, [1, 2], true) || $userSite === 0;
$siteSales = $canSeeAllSites ? '' : ' AND site_id = ' . $userSite;
$siteConsultations = $canSeeAllSites ? '' : ' AND site_id = ' . $userSite;
$siteInventory = $canSeeAllSites ? '' : ' WHERE i.site_id = ' . $userSite;
$patientScope = $canSeeAllSites ? '' : " AND EXISTS (SELECT 1 FROM consultations dc WHERE dc.patient_id=patients.id AND dc.site_id={$userSite} AND dc.is_deleted=0)";

$stats = [
  'patients' => (int) dashboardValue("SELECT COUNT(*) value FROM patients WHERE is_deleted=0{$patientScope}"),
  'consultations' => (int) dashboardValue("SELECT COUNT(*) value FROM consultations WHERE is_deleted=0{$siteConsultations}"),
  'sales' => (int) dashboardValue("SELECT COUNT(*) value FROM sales WHERE is_deleted=0 AND is_sale_finalized=1{$siteSales}"),
  'revenue' => (float) dashboardValue("SELECT COALESCE(SUM(grand_total),0) value FROM sales WHERE is_deleted=0 AND is_sale_finalized=1{$siteSales}"),
  'inventory' => (int) dashboardValue("SELECT COALESCE(SUM(quantity),0) value FROM inventory" . ($canSeeAllSites ? '' : " WHERE site_id={$userSite}")),
  'low_stock' => (int) dashboardValue("SELECT COUNT(*) value FROM inventory WHERE quantity <= 5" . ($canSeeAllSites ? '' : " AND site_id={$userSite}")),
  'products' => (int) dashboardValue("SELECT COUNT(*) value FROM products WHERE is_deleted=0 AND is_active=1"),
  'sites' => (int) dashboardValue("SELECT COUNT(*) value FROM sites WHERE is_deleted=0 AND is_active=1"),
  'invoices' => (int) dashboardValue("SELECT COUNT(*) value FROM customer_invoices WHERE is_deleted=0"),
  'staff' => (int) dashboardValue("SELECT COUNT(*) value FROM users WHERE is_deleted=0 AND is_active=1")
];

$revenueRows = dashboardRows("SELECT DATE_FORMAT(date,'%b %Y') label, DATE_FORMAT(date,'%Y-%m') sort_key, ROUND(SUM(grand_total),2) total FROM sales WHERE is_deleted=0 AND is_sale_finalized=1{$siteSales} AND date >= DATE_SUB(CURDATE(), INTERVAL 11 MONTH) GROUP BY sort_key,label ORDER BY sort_key");
$patientRows = dashboardRows("SELECT DATE_FORMAT(created_at,'%b %Y') label, DATE_FORMAT(created_at,'%Y-%m') sort_key, COUNT(*) total FROM patients WHERE is_deleted=0{$patientScope} AND created_at >= DATE_SUB(CURDATE(), INTERVAL 11 MONTH) GROUP BY sort_key,label ORDER BY sort_key");
$consultationRows = dashboardRows("SELECT DATE_FORMAT(created_at,'%b %Y') label, DATE_FORMAT(created_at,'%Y-%m') sort_key, COUNT(*) total FROM consultations WHERE is_deleted=0{$siteConsultations} AND created_at >= DATE_SUB(CURDATE(), INTERVAL 11 MONTH) GROUP BY sort_key,label ORDER BY sort_key");
$salesStatus = [
  (int) dashboardValue("SELECT COUNT(*) value FROM sales WHERE is_deleted=0 AND is_sale_finalized=1{$siteSales}"),
  (int) dashboardValue("SELECT COUNT(*) value FROM sales WHERE is_deleted=0 AND is_sale_finalized=0{$siteSales}"),
  (int) dashboardValue("SELECT COUNT(*) value FROM sales WHERE is_deleted=1{$siteSales}")
];
$stockRows = dashboardRows("SELECT p.product_name label, COALESCE(SUM(i.quantity),0) total FROM inventory i JOIN products p ON p.id=i.product_id" . ($siteInventory ?: '') . " GROUP BY p.id,p.product_name ORDER BY total DESC LIMIT 8");
$siteRows = dashboardRows("SELECT s.site_name label, COUNT(c.id) total FROM sites s LEFT JOIN consultations c ON c.site_id=s.id AND c.is_deleted=0 WHERE s.is_deleted=0" . ($canSeeAllSites ? '' : " AND s.id={$userSite}") . " GROUP BY s.id,s.site_name ORDER BY total DESC LIMIT 8");

$activityMonths = [];
foreach ($patientRows as $row) $activityMonths[$row['sort_key']] = $row['label'];
foreach ($consultationRows as $row) $activityMonths[$row['sort_key']] = $row['label'];
ksort($activityMonths);
$patientMap = array_column($patientRows, 'total', 'sort_key');
$consultationMap = array_column($consultationRows, 'total', 'sort_key');
$activityLabels = array_values($activityMonths);
$patientSeries = [];
$consultationSeries = [];
foreach (array_keys($activityMonths) as $month) {
  $patientSeries[] = (int) ($patientMap[$month] ?? 0);
  $consultationSeries[] = (int) ($consultationMap[$month] ?? 0);
}

$recentPatients = dashboardRows("SELECT id,patientid,uhid,first_name,last_name,gender,created_at FROM patients WHERE is_deleted=0{$patientScope} ORDER BY created_at DESC LIMIT 7");
$recentConsultationScope = $canSeeAllSites ? '' : " AND c.site_id={$userSite}";
$recentConsultations = dashboardRows("SELECT c.id,c.consultationid,c.is_report_finalized,c.created_at,p.first_name,p.last_name,s.site_name FROM consultations c LEFT JOIN patients p ON p.id=c.patient_id LEFT JOIN sites s ON s.id=c.site_id WHERE c.is_deleted=0{$recentConsultationScope} ORDER BY c.created_at DESC LIMIT 7");
$recentSales = dashboardRows("SELECT s.id,s.saleid,s.grand_total,s.is_sale_finalized,s.date,p.first_name,p.last_name FROM sales s LEFT JOIN patients p ON p.id=s.patient_id WHERE s.is_deleted=0{$siteSales} ORDER BY s.created_at DESC LIMIT 7");
$recentInvoices = dashboardRows("SELECT id,customerinvoiceuid,customer_name,grand_total,is_invoice_generated,invoice_date FROM customer_invoices WHERE is_deleted=0 ORDER BY created_at DESC LIMIT 7");
$lowStock = dashboardRows("SELECT p.product_name,s.site_name,i.quantity FROM inventory i LEFT JOIN products p ON p.id=i.product_id LEFT JOIN sites s ON s.id=i.site_id WHERE i.quantity<=5" . ($canSeeAllSites ? '' : " AND i.site_id={$userSite}") . " ORDER BY i.quantity ASC,p.product_name LIMIT 8");

$dashboardData = [
  'revenue' => ['labels' => array_column($revenueRows,'label'), 'values' => array_map('floatval',array_column($revenueRows,'total'))],
  'activity' => ['labels' => $activityLabels, 'patients' => $patientSeries, 'consultations' => $consultationSeries],
  'salesStatus' => $salesStatus,
  'stock' => ['labels' => array_column($stockRows,'label'), 'values' => array_map('intval',array_column($stockRows,'total'))],
  'sites' => ['labels' => array_column($siteRows,'label'), 'values' => array_map('intval',array_column($siteRows,'total'))]
];
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="./" data-template="vertical-menu-template-free">
<head>
  <?= loadAdminMetaData() ?><?= loadAdminTitleAndFavicon() ?><?= loadAdminStyleSheets() ?><?= loadAdminScripts() ?>
  <link rel="stylesheet" href="<?= SITE_URL ?>assets/css/dashboard-dynamic.css">
</head>
<body>
<div class="layout-wrapper layout-content-navbar"><div class="layout-container">
  <?= loadAdminSidebar('Dashboard') ?>
  <div class="layout-page"><?= loadAdminNavbar() ?>
    <div class="content-wrapper"><div class="container-xxl flex-grow-1 container-p-y">
      <div class="dashboard-heading d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
        <div><h4 class="fw-bold mb-1">Operations overview</h4><p class="text-muted mb-0">Welcome back, <?= htmlspecialchars((string)userVariable('first_name'), ENT_QUOTES, 'UTF-8') ?>. Here is what is happening across StepCure.</p></div>
        <div class="d-flex gap-2"><button id="dashboard-edit" class="btn btn-outline-primary"><i class="bx bx-move"></i> Arrange dashboard</button><button id="dashboard-reset" class="btn btn-outline-secondary"><i class="bx bx-reset"></i> Reset layout</button></div>
      </div>

      <div class="row g-3 mb-4 dashboard-kpis">
        <?php $cards=[['Patients',$stats['patients'],'bx-user-plus','primary','patients/'],['Consultations',$stats['consultations'],'bx-pulse','info','consultations/'],['Finalized sales',$stats['sales'],'bx-receipt','success','sales/'],['Revenue','₹'.number_format($stats['revenue'],2),'bx-rupee','warning','sales/'],['Invoices',$stats['invoices'],'bx-file','success','invoices/'],['Stock units',$stats['inventory'],'bx-package','secondary','inventory/'],['Low stock',$stats['low_stock'],'bx-error-circle','danger','inventory/'],['Products',$stats['products'],'bx-shopping-bag','primary','products/'],['Treatment sites',$stats['sites'],'bx-clinic','info','treatment-sites/'],['Active staff',$stats['staff'],'bx-group','secondary','users/']]; foreach($cards as $card): ?>
        <div class="col-6 col-md-4 col-xl-3"><a class="card kpi-card h-100" href="<?= SITE_URL ?>admin/<?= $card[4] ?>"><div class="card-body"><span class="kpi-icon bg-label-<?= $card[3] ?>"><i class="bx <?= $card[2] ?>"></i></span><div><small><?= $card[0] ?></small><h4 class="mb-0"><?= $card[1] ?></h4></div></div></a></div>
        <?php endforeach; ?>
      </div>

      <div id="dashboard-grid" class="row g-4" data-layout-user="<?= htmlspecialchars($currentUser,ENT_QUOTES,'UTF-8') ?>">
        <div class="col-xl-8 dashboard-widget" draggable="false" data-widget="revenue"><div class="card h-100"><div class="card-header widget-header"><div><h5 class="mb-1">Revenue trend</h5><small class="text-muted">Finalized sales over the last 12 months</small></div><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="card-body"><div id="revenueChart"></div></div></div></div>
        <div class="col-xl-4 dashboard-widget" draggable="false" data-widget="sales-status"><div class="card h-100"><div class="card-header widget-header"><div><h5 class="mb-1">Sales status</h5><small class="text-muted">Finalized, draft and archived</small></div><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="card-body"><div id="salesStatusChart"></div></div></div></div>
        <div class="col-xl-7 dashboard-widget" draggable="false" data-widget="clinical-activity"><div class="card h-100"><div class="card-header widget-header"><div><h5 class="mb-1">Clinical activity</h5><small class="text-muted">New patients and consultations</small></div><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="card-body"><div id="activityChart"></div></div></div></div>
        <div class="col-xl-5 dashboard-widget" draggable="false" data-widget="stock"><div class="card h-100"><div class="card-header widget-header"><div><h5 class="mb-1">Inventory mix</h5><small class="text-muted">Units currently available by product</small></div><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="card-body"><div id="stockChart"></div></div></div></div>
        <div class="col-xl-5 dashboard-widget" draggable="false" data-widget="sites"><div class="card h-100"><div class="card-header widget-header"><div><h5 class="mb-1">Consultations by site</h5><small class="text-muted">Treatment-site workload</small></div><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="card-body"><div id="siteChart"></div></div></div></div>
        <div class="col-xl-7 dashboard-widget" draggable="false" data-widget="recent-patients"><div class="card h-100"><div class="card-header widget-header"><div><h5 class="mb-1">Recent patients</h5><small class="text-muted">Latest registrations</small></div><a href="<?= SITE_URL ?>admin/patients/">View all</a><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Patient</th><th>UHID</th><th>Gender</th><th>Added</th></tr></thead><tbody><?php foreach($recentPatients as $r): ?><tr><td><a href="<?= SITE_URL ?>admin/patients/?id=<?= (int)$r['id'] ?>&view"><?= htmlspecialchars(trim($r['first_name'].' '.$r['last_name'])) ?></a></td><td><?= htmlspecialchars($r['uhid']) ?></td><td><?= strtoupper(htmlspecialchars($r['gender'])) ?></td><td><?= date('d M Y',strtotime($r['created_at'])) ?></td></tr><?php endforeach; ?></tbody></table></div></div></div>
        <div class="col-xl-7 dashboard-widget" draggable="false" data-widget="recent-consultations"><div class="card h-100"><div class="card-header widget-header"><div><h5 class="mb-1">Recent consultations</h5><small class="text-muted">Clinical records and report status</small></div><a href="<?= SITE_URL ?>admin/consultations/">View all</a><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>ID</th><th>Patient</th><th>Site</th><th>Report</th></tr></thead><tbody><?php foreach($recentConsultations as $r): ?><tr><td><a href="<?= SITE_URL ?>admin/consultations/?id=<?= (int)$r['id'] ?>&view">CI-<?= str_pad((string)$r['consultationid'],3,'0',STR_PAD_LEFT) ?></a></td><td><?= htmlspecialchars(trim(($r['first_name']??'').' '.($r['last_name']??''))) ?></td><td><?= htmlspecialchars($r['site_name']??'—') ?></td><td><span class="badge bg-label-<?= $r['is_report_finalized']?'success':'warning' ?>"><?= $r['is_report_finalized']?'Finalized':'Draft' ?></span></td></tr><?php endforeach; ?></tbody></table></div></div></div>
        <div class="col-xl-5 dashboard-widget" draggable="false" data-widget="recent-sales"><div class="card h-100"><div class="card-header widget-header"><div><h5 class="mb-1">Recent sales</h5><small class="text-muted">Latest patient orders</small></div><a href="<?= SITE_URL ?>admin/sales/">View all</a><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Sale</th><th>Patient</th><th>Amount</th></tr></thead><tbody><?php foreach($recentSales as $r): ?><tr><td><a href="<?= SITE_URL ?>admin/sales/?id=<?= (int)$r['id'] ?>&view">SI-<?= str_pad((string)$r['saleid'],3,'0',STR_PAD_LEFT) ?></a></td><td><?= htmlspecialchars(trim(($r['first_name']??'').' '.($r['last_name']??''))) ?></td><td>₹<?= number_format((float)$r['grand_total'],2) ?></td></tr><?php endforeach; ?></tbody></table></div></div></div>
        <div class="col-xl-6 dashboard-widget" draggable="false" data-widget="recent-invoices"><div class="card h-100"><div class="card-header widget-header"><div><h5 class="mb-1">Recent invoices</h5><small class="text-muted">Customer billing records</small></div><a href="<?= SITE_URL ?>admin/invoices/">View all</a><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="table-responsive"><table class="table table-hover mb-0"><thead><tr><th>Invoice</th><th>Customer</th><th>Amount</th><th>Status</th></tr></thead><tbody><?php foreach($recentInvoices as $r): ?><tr><td><a href="<?= SITE_URL ?>admin/invoices/?id=<?= (int)$r['id'] ?>&view">CSI-<?= str_pad((string)$r['customerinvoiceuid'],3,'0',STR_PAD_LEFT) ?></a></td><td><?= htmlspecialchars($r['customer_name']) ?></td><td>₹<?= number_format((float)$r['grand_total'],2) ?></td><td><span class="badge bg-label-<?= $r['is_invoice_generated']?'success':'warning' ?>"><?= $r['is_invoice_generated']?'Generated':'Draft' ?></span></td></tr><?php endforeach; ?></tbody></table></div></div></div>
        <div class="col-12 dashboard-widget" draggable="false" data-widget="low-stock"><div class="card"><div class="card-header widget-header"><div><h5 class="mb-1">Low-stock watchlist</h5><small class="text-muted">Items with five or fewer units</small></div><a href="<?= SITE_URL ?>admin/inventory/">Manage inventory</a><span class="drag-handle"><i class="bx bx-grid-vertical"></i></span></div><div class="card-body"><div class="row g-3"><?php if(!$lowStock): ?><div class="col-12 text-muted">No low-stock items.</div><?php endif; foreach($lowStock as $r): ?><div class="col-sm-6 col-lg-3"><div class="stock-alert"><span class="bg-label-<?= (int)$r['quantity']===0?'danger':'warning' ?>"><i class="bx bx-package"></i></span><div><strong><?= htmlspecialchars($r['product_name']??'Unknown product') ?></strong><small><?= htmlspecialchars($r['site_name']??'Unassigned') ?> · <?= (int)$r['quantity'] ?> units</small></div></div></div><?php endforeach; ?></div></div></div></div>
      </div>
    </div><?= loadAdminFooter() ?></div>
  </div>
</div><div class="layout-overlay layout-menu-toggle"></div></div>
<script>window.StepCureDashboard=<?= json_encode($dashboardData,JSON_HEX_TAG|JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT) ?>;</script>
<?= loadAdminFooterScripts() ?>
<script src="<?= SITE_URL ?>assets/js/dashboard-dynamic.js"></script>
</body></html>
