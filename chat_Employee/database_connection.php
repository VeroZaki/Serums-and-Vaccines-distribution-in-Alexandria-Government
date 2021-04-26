
<?php

//database_connection.php

$connect = new PDO("mysql:host=localhost;dbname=project", "root", "");

date_default_timezone_set('Asia/Kolkata');

function fetch_user_last_activity($user_id, $connect)
{
 $query = "
 SELECT * FROM login_details_Employee
 WHERE user_id = '$user_id'
 ORDER BY last_activity DESC
 LIMIT 1
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['last_activity'];
 }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
 $query = "
 SELECT * FROM chat_message_Employee
 WHERE (from_user_id = '".$from_user_id."'
 AND to_user_id = '".$to_user_id."')
 OR (from_user_id = '".$to_user_id."'
 AND to_user_id = '".$from_user_id."')
 ORDER BY timestamp DESC
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $from_user_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["chat_message"].'
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 //echo $to_user_id;
 //echo $from_user_id;

 $output .= '</ul>';
 $query = "
 UPDATE chat_message_Employee
 SET status = '1'
 WHERE from_user_id = '".$to_user_id."'
 AND to_user_id = '".$from_user_id."'
 AND status = '0'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $output;
}

function get_user_name($user_id, $connect)
{
 $query = "SELECT userusername FROM employee WHERE EID = '$user_id'";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['userusername'];
 }
}

function count_unseen_message($to_user_id,$from_user_id, $connect)
{

 $query = "
 SELECT * FROM chat_message_Employee
 WHERE from_user_id = '$from_user_id'
 AND to_user_id = '$to_user_id'
 AND status = '0'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 $count = $statement->rowCount();
 $output = '';
 if($count > 0)
 {
  $output = '<span class="label label-success">'.$count.'</span>';
 }
 return $output;
}



?>
