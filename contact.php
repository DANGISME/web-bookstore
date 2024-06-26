<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit();
}

if (isset($_POST['send'])) {
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('Lỗi truy vấn');

   if (mysqli_num_rows($select_message) > 0) {
      
   } else {
      mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('Lỗi truy vấn');
      
   }
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Liên hệ</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Liên hệ với chúng tôi</h3>
   <p> <a href="home.php">Trang chủ</a> / Liên hệ </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>Hãy để lại lời nhắn</h3>
      <input type="text" name="name" required placeholder="Nhập tên của bạn" class="box">
      <input type="email" name="email" required placeholder="Nhập email của bạn" class="box">
      <input type="number" name="number" required placeholder="Nhập số điện thoại của bạn" class="box">
      <textarea name="message" class="box" placeholder="Nhập nội dung tin nhắn" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Gửi tin nhắn" name="send" class="btn">
   </form>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
