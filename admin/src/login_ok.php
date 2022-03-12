<?php
if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

if($user_id =='junseok816' &&  $user_pw !='tlsrn815' || $user_id =='funware' || $user_pw !='ilovefunware') {
        session_start();
        
}else{
        echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');history.back();</script>";
        exit;
}
      
$_SESSION['user_id'] = $user_id;
$_SESSION['user_pw'] = $user_pw;
?>
<meta http-equiv='refresh' content='0; url=http://funware.shop/admin/src/main.php'>
