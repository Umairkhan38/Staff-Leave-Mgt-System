<?php
error_reporting(E_ERROR | E_PARSE);
require('db.inc.php');
$msg="";

   $name=$_POST['name'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$password=$_POST['password'];
   $address = $_POST['address'];
   $department = $_POST['department'];
   $DOB = $_POST['DOB'];

   $deptartment_id=mysqli_query($con,"select id from department WHERE department = '$department'");

   $ans=mysqli_fetch_assoc($deptartment_id);
   $dept_id=$ans['id'];

   $check=mysqli_num_rows(mysqli_query($con,"select * from employee where email='$email'"));

   if($check>0){
   $msg="Email Already exists!!";   
   }elseif(isset($_POST['submit'])){
		mysqli_query($con,"insert into employee(name,email,mobile,password,department_id,address,birthday,role) values('$name','$email','$mobile','$password','$dept_id','$address','$DOB','2')");
      header('location:login.php');

   }
	
?>



<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Sign Up Page</title>
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
   <body class="bg-dark" style="background-image:url('images/background.jpg');background-position:center;height:500px;background-repeat:no-repeat;background-size:cover;">
      <div class="sufee-login d-flex align-content-center flex-wrap">
      <div class="login-img" style="margin:20px auto;">
            <img src="./images/logo.png" style="height: 123px;width: 530px; border-radius: 16px;" alt="" >
         </div>

         <div class="container">
            <div class="login-content" >
               <div class="login-form mt-150" style="margin-top:28px;background: #fff;border-radius: 2px;height:380px;padding: 28px;overflow-x:hidden;overflow-y:auto">
                  <div class="option">
                     <a class="signIn" href="login.php" style="font-size:1.2rem;margin-left:20px;">SignIn</a>
                     <a class="signIn" href="login.php" style="color:green;border-bottom:2px solid green;font-size:1.2rem;margin-left:300px;">SignUp</a>
                  </div>
                  <form method="post" >
                     <div class="form-group">
                         <hr>
                         <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                         </div>
                        <label >Email address</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                     </div>
                     <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                     </div>
                     <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" name="mobile" class="form-control" placeholder="Enter Your Mobile No" required>
                     </div>
                     <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Your Address" required>
                     </div>
                     <div class="form-group">
                        <label>Department:</label>
                        <select name="department" style="width:200px" required>
                        <option value="Sales Department">Sales</option>
                        <option value="PR Department">PR</option>
                        <option value="HR Department">HR</option>
                    </select>
                     </div>
      
                     <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" name="DOB" class="form-control" placeholder="DOB" required>
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                     <a href="login.php" style="margin-left:130px;color:blue;">Already have an Account</a>
                     
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
