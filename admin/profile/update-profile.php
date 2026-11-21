<?php
require_once __DIR__ . '/../admin.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ./'); exit; }
if (!isset($_POST['csrf_token'], $_SESSION['profile_csrf']) || !hash_equals($_SESSION['profile_csrf'], $_POST['csrf_token'])) {
    $_SESSION['profile_notice']=['type'=>'error','message'=>'Your session expired. Please try again.']; header('Location: ./'); exit;
}
$result=getUserByUserid($_SESSION[USER_AUTH]); $existing=$result?mysqli_fetch_assoc($result):null;
if(!$existing){ http_response_code(404); exit('User not found'); }
$fields=['first_name','last_name','phone','whatsapp_no','alt_phone','address','address_city','address_pin','facebook_url','twitter_url','instagram_url','linkedin_url','remarks'];
$data=[]; foreach($fields as $field) $data[$field]=trim((string)($_POST[$field]??''));
$data['address_state']=(int)($_POST['address_state']??0);
if($data['first_name']===''){ $_SESSION['profile_notice']=['type'=>'error','message'=>'First name is required.']; header('Location: ./'); exit; }
$profileImage=$existing['profile_image'];
if(!empty($_FILES['profile_image']['name'])){
    $allowedImageTypes=['image/jpeg','image/png','image/webp'];
    $detectedType=is_uploaded_file($_FILES['profile_image']['tmp_name']) ? mime_content_type($_FILES['profile_image']['tmp_name']) : '';
    if(!in_array($detectedType,$allowedImageTypes,true)){
        $_SESSION['profile_notice']=['type'=>'error','message'=>'Please upload a valid JPG, PNG or WebP image.']; header('Location: ./'); exit;
    }
    $upload=upload_file('profile_image',dirname(__DIR__,2).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR);
    if(($upload['status']??'failed')!=='success'){ $_SESSION['profile_notice']=['type'=>'error','message'=>$upload['message']??'Image upload failed.']; header('Location: ./'); exit; }
    $profileImage=$upload['file_name'];
}
$conn=get_conn();
$sql="UPDATE users SET first_name=?,last_name=?,phone=?,whatsapp_no=?,alt_phone=?,address=?,address_state=?,address_city=?,address_pin=?,facebook_url=?,twitter_url=?,instagram_url=?,linkedin_url=?,remarks=?,profile_image=?,updated_by=? WHERE id=?";
$stmt=mysqli_prepare($conn,$sql); $updatedBy=(int)$existing['id']; $id=(int)$existing['id'];
mysqli_stmt_bind_param($stmt,'ssssssissssssssii',$data['first_name'],$data['last_name'],$data['phone'],$data['whatsapp_no'],$data['alt_phone'],$data['address'],$data['address_state'],$data['address_city'],$data['address_pin'],$data['facebook_url'],$data['twitter_url'],$data['instagram_url'],$data['linkedin_url'],$data['remarks'],$profileImage,$updatedBy,$id);
$ok=mysqli_stmt_execute($stmt);
if($ok) addNewAdminUpdate($existing['userid'],'Updated their profile details.');
$_SESSION['profile_csrf']=bin2hex(random_bytes(32));
$_SESSION['profile_notice']=['type'=>$ok?'success':'error','message'=>$ok?'Profile updated successfully.':'Unable to update profile.'];
header('Location: ./'); exit;
