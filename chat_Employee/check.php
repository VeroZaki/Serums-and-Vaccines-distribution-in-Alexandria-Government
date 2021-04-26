<!--
//login.php
!-->

<?php

include('database_connection.php');

session_start();
$message = '';

echo $_POST["username_Employee"];
 $query = "
   SELECT * FROM employee
    WHERE userusername = :username_Employee
 ";
 echo " da5al";
 $statement = $connect->prepare($query);
 $statement->execute(
    array(
      ':username_Employee' => $_POST["username_Employee"]
     )
  );
  $count = $statement->rowCount();
  echo $count;
  if($count > 0)
 {
  $result = $statement->fetchAll();
  echo 'goa if';

    foreach($result as $row)
    {
    //  echo $_POST["password_Employee"];
      //echo $row["password"];
      if($_POST["password_Employee"] == $row["userpassword"])
      {
        echo "yes";
        $_SESSION['name_Employee'] = $row['userusername'];
        $sub_query = "
        INSERT INTO login_details_Employee
        (user_id)
        VALUES ('".$row['EID']."')
        ";
        $statement = $connect->prepare($sub_query);
        $statement->execute();
        $_SESSION['login_details_id'] = $connect->lastInsertId();
        header("location:index.php");
      }
      else
      {
       $message = "<label>Wrong Password</label>";
       header("location:login.php");
      }
    }
 }
 else
 {
  $message = "<label>Wrong Username</labe>";
  header("location:login.php");
 }


?>
