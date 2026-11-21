<?php
require_once __DIR__ . '/../admin.php';
if (empty($_SESSION['profile_csrf'])) $_SESSION['profile_csrf'] = bin2hex(random_bytes(32));
$result = getUserByUserid($_SESSION[USER_AUTH]);
$profile = $result ? mysqli_fetch_assoc($result) : null;
if (!$profile) { include __DIR__ . '/../errors/404.php'; exit; }
$states = runQuery("SELECT id,state_name,state_code FROM address_states WHERE is_active=1 AND is_deleted=0 ORDER BY state_name");
$notice = $_SESSION['profile_notice'] ?? null; unset($_SESSION['profile_notice']);
$fullName = trim($profile['first_name'].' '.$profile['last_name']);
?>
<!DOCTYPE html><html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default">
<head><?= loadAdminMetaData() ?><?= loadAdminTitleAndFavicon() ?><?= loadAdminStyleSheets() ?><?= loadAdminScripts() ?></head>
<body><div class="layout-wrapper layout-content-navbar"><div class="layout-container">
<?= loadAdminSidebar('Profile') ?><div class="layout-page"><?= loadAdminNavbar() ?><div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between align-items-center mb-4"><div><h4 class="fw-bold mb-1">My Profile</h4><p class="text-muted mb-0">Update your personal and contact information.</p></div></div>
  <?php if($notice): ?><div class="alert alert-<?= $notice['type']==='success'?'success':'danger' ?> alert-dismissible" role="alert"><?= htmlspecialchars($notice['message']) ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div><?php endif; ?>
  <form method="post" action="update-profile.php" enctype="multipart/form-data" class="card">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['profile_csrf']) ?>">
    <div class="card-body"><div class="d-flex flex-column flex-sm-row align-items-center gap-4 pb-4 border-bottom">
      <div style="width:100px;height:100px" id="profile-avatar"><?= getDP(['full_name'=>$fullName,'file_name'=>$profile['profile_image'],'alt'=>$fullName]) ?></div>
      <div><label class="btn btn-primary mb-2" for="profile_image"><i class="bx bx-upload me-1"></i> Change photo</label><input class="d-none" type="file" id="profile_image" name="profile_image" accept="image/jpeg,image/png,image/webp"><p class="text-muted small mb-0">JPG, PNG or WebP. Maximum 1 MB.</p></div>
    </div></div>
    <div class="card-body"><div class="row g-3">
      <div class="col-md-6"><label class="form-label">User ID</label><input class="form-control" value="<?= htmlspecialchars($profile['userid']) ?>" disabled><small class="text-muted">User ID cannot be changed.</small></div>
      <div class="col-md-6"><label class="form-label">Email address</label><input class="form-control" value="<?= htmlspecialchars($profile['email']) ?>" disabled><small class="text-muted">Email cannot be changed here.</small></div>
      <div class="col-md-6"><label class="form-label" for="first_name">First name</label><input class="form-control" id="first_name" name="first_name" maxlength="100" required value="<?= htmlspecialchars($profile['first_name']) ?>"></div>
      <div class="col-md-6"><label class="form-label" for="last_name">Last name</label><input class="form-control" id="last_name" name="last_name" maxlength="50" value="<?= htmlspecialchars($profile['last_name']) ?>"></div>
      <div class="col-md-4"><label class="form-label" for="phone">Phone</label><input class="form-control" id="phone" name="phone" maxlength="15" value="<?= htmlspecialchars($profile['phone']) ?>"></div>
      <div class="col-md-4"><label class="form-label" for="whatsapp_no">WhatsApp</label><input class="form-control" id="whatsapp_no" name="whatsapp_no" maxlength="15" value="<?= htmlspecialchars($profile['whatsapp_no']) ?>"></div>
      <div class="col-md-4"><label class="form-label" for="alt_phone">Alternate phone</label><input class="form-control" id="alt_phone" name="alt_phone" maxlength="15" value="<?= htmlspecialchars($profile['alt_phone']) ?>"></div>
      <div class="col-12"><label class="form-label" for="address">Address</label><textarea class="form-control" id="address" name="address" maxlength="200" rows="2"><?= htmlspecialchars($profile['address']) ?></textarea></div>
      <div class="col-md-4"><label class="form-label" for="address_state">State</label><select class="form-select" id="address_state" name="address_state"><option value="">Select state</option><?php if($states) while($state=mysqli_fetch_assoc($states)): ?><option value="<?= (int)$state['id'] ?>" <?= (int)$profile['address_state']===(int)$state['id']?'selected':'' ?>><?= htmlspecialchars($state['state_name'].' ('.$state['state_code'].')') ?></option><?php endwhile; ?></select></div>
      <div class="col-md-4"><label class="form-label" for="address_city">City</label><input class="form-control" id="address_city" name="address_city" maxlength="50" value="<?= htmlspecialchars($profile['address_city']) ?>"></div>
      <div class="col-md-4"><label class="form-label" for="address_pin">PIN</label><input class="form-control" id="address_pin" name="address_pin" maxlength="6" inputmode="numeric" value="<?= htmlspecialchars($profile['address_pin']) ?>"></div>
      <?php foreach(['facebook_url'=>'Facebook URL','twitter_url'=>'X/Twitter URL','instagram_url'=>'Instagram URL','linkedin_url'=>'LinkedIn URL'] as $field=>$label): ?><div class="col-md-6"><label class="form-label" for="<?= $field ?>"><?= $label ?></label><input type="url" class="form-control" id="<?= $field ?>" name="<?= $field ?>" maxlength="255" value="<?= htmlspecialchars($profile[$field]) ?>"></div><?php endforeach; ?>
      <div class="col-12"><label class="form-label" for="remarks">About / remarks</label><textarea class="form-control" id="remarks" name="remarks" maxlength="200" rows="3"><?= htmlspecialchars($profile['remarks']) ?></textarea></div>
    </div></div>
    <div class="card-footer d-flex gap-2"><button class="btn btn-primary" type="submit"><i class="bx bx-save me-1"></i> Save changes</button><a href="<?= SITE_URL ?>admin/dashboard/" class="btn btn-outline-secondary">Cancel</a></div>
  </form>
</div><?= loadAdminFooter() ?></div></div></div><div class="layout-overlay layout-menu-toggle"></div></div>
<?= loadAdminFooterScripts() ?><script>document.getElementById('profile_image')?.addEventListener('change',e=>{const f=e.target.files[0];if(!f)return;const url=URL.createObjectURL(f);document.getElementById('profile-avatar').innerHTML='<img src="'+url+'" alt="Preview" style="width:100%;height:100%;border-radius:50%;object-fit:cover">';});</script>
</body></html>
