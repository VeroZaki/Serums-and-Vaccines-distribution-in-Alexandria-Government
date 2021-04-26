<?php
  session_start();

  $con=mysqli_connect('localhost','root','');

  mysql_select_db($con, "serums & vaccines inventory system");

  $username = $_POST['username'];
  $password = $_POST['password'];

  $s = "select * from employee where userusername = '$username' and
        userpassword = '$password'";
  $result = mysqli_query($con, $s);
  $num = mysqli_num_rows($result);
  if($num == 1){
    header('location:home.php');
  }
  else{
    header('location:AdminLogin.html');
  }
?>
