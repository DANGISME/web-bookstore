<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $confirm_password = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $user_type = $_POST['user_type'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Lỗi truy vấn');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'Người dùng đã tồn tại!';
   }else{
      if($password != $confirm_password){
         $message[] = 'Xác nhận mật khẩu không khớp!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password, user_type) VALUES('$name', '$email', '$confirm_password', '$user_type')") or die('Lỗi truy vấn');
         $message[] = 'Đăng ký thành công!';
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đăng ký</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<div class="form-container">

   <form action="" method="post">
      <h3>Đăng ký ngay</h3>
      <input type="text" name="name" placeholder="Nhập tên của bạn" required class="box">
      <input type="email" name="email" placeholder="Nhập email của bạn" required class="box">
      <input type="password" name="password" placeholder="Nhập mật khẩu" required class="box">
      <input type="password" name="cpassword" placeholder="Nhập lại mật khẩu" required class="box">
      <select name="user_type" class="box">
      <option value="user">Người dùng</option>
         <option value="admin">Quản Trị Viên</option>
      </select>
      <input type="submit" name="submit" value="Đăng ký ngay" class="btn">
      <p>Bạn đã có sẵn tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
   </form>

</div>

</body>
</html>
