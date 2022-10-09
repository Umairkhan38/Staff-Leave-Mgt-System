<?php
require('db.inc.php');
$msg="";


if(isset($_POST['email']) && isset($_POST['password'])){
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$res=mysqli_query($con,"select * from employee where email='$email' and password='$password'");
	$count=mysqli_num_rows($res);
   
	if($count>0){
		$row=mysqli_fetch_assoc($res);
		$_SESSION['ROLE']=$row['role'];
		$_SESSION['USER_ID']=$row['id'];
		$_SESSION['USER_NAME']=$row['name']; 
      header('location:index.php');
      die();
      }else{
		$msg="Please enter correct login details";
	}

}


?>

<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="assets/css/style.css">
   </head>

   <body class="bg-dark" style="background-image:url('images/background.jpg');background-position:center;background-size:cover;height:100vh;background-repeat:no-repeat;background-size:cover;">
      <div class="sufee-login d-flex align-content-center flex-wrap">
      <div class="login-img" style="margin:20px auto;">
            <img src="./images/logo.png" style="height: 123px;width: 530px; border-radius: 16px;" alt="" >
      </div>

         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150" style="margin-top:28px;background: #fff;border-radius: 2px;height:380px;padding:28px">
                  <div class="option">
                     <a class="signIn" href="login.php" style="color:green;border-bottom:2px solid green;font-size:1.2rem;margin-left:20px;width:300px">SignIn</a>
                     <a class="signUp" href="signUp.php" style="font-size:1.2rem;margin-left:300px">SignUp</a>
                  </div>
                  <form method="post">
                     <div class="form-group">
                        <hr>
                        <label >Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                     <a href="signUp.php" style="margin-left:150px;margin-top:5px;color:blue;">Don't have an Account?</a>
               <div class="result_msg"><?php echo $msg?></div>
					</form>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>


