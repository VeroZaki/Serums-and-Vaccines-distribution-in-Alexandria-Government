<!--
//login.php
!-->

<?php

include('database_connection.php');

session_start();
$message = '';

echo $_POST["username"];
 $query = "
   SELECT * FROM admin
    WHERE username = :username
 ";
 echo " da5al";
 $statement = $connect->prepare($query);
 $statement->execute(
    array(
      ':username' => $_POST["username"]
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
      echo $_POST["password"];
      echo $row["password"];
      if($_POST["password"] == $row["password"])
      {
        echo "yes";
        $_SESSION['name'] = $row['username'];
        $sub_query = "
        INSERT INTO login_details
        (user_id)
        VALUES ('".$row['ID']."')
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
