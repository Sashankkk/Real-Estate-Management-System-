<?php
include 'components/connect.php';
if(isset($_POST['user_id'])){
    $user_id=$_POST['user_id'];
}
else{
    $user_id='';
    
}
if(isset($_POST['submit'])){


    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = sha1($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING); 
 
 
    $verify_users = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
    $verify_users->execute([$email, $pass]);
    $row = $verify_users->fetch(PDO::FETCH_ASSOC);
 
    if($verify_users->rowCount() > 0){
       setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
       header('location:home.php');
    }else{
       $warning_msg[] = 'Incorrect!';
    }
 
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--FONT-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
     <!--FONT-->
     <!--CSS-->
     <link rel="stylesheet" href="css/style.css">
     <!--CSS-->

</head>
<body>
<!-- header -->
<?php include 'components/user_header.php'; ?>
<!-- header -->
<!--Registe-->

<section class="form-container">

   <form action="" method="post">
      <h3>Login</h3>
     
      <input type="email" name="email" required maxlength="50" placeholder="Enter your Email" class="box">
   
      <input type="password" name="pass" required maxlength="50" placeholder="Enter your Password" class="box">
      
      <p>Don't have an account? <a href="register.php">Register Now</a></p>
      <input type="submit" name="submit" class="btn" value="Login Now">
   </form>

</section>
<!--Registe-->



 <!--footer -->
 <?php include 'components/footer.php'; ?>
<!--footer -->



<!-- Sweetalert -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Sweetalert -->






    <!--JavaScript-->
    <script src="js/script.js">
        </script>
    <!--JavaScript-->
    <?php include 'components/message.php'; ?>
</body>
</html>