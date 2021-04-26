<?php
include('database_connection.php');

session_start();

$d="SELECT * FROM employee WHERE userusername = '".$_SESSION['name_Employee']."'";
$statement_d = $connect->prepare($d);

$statement_d->execute();

$result_d = $statement_d->fetchAll();

foreach($result_d as $row_d)
{
 $user__id = $row_d['userusername'];
 $ID = $row_d['EID'];
 $DID = $row_d['DID'];
}
  $_SESSION['DID_Employee'] = $DID;
//$user_details_query = mysqli_query($con, "SELECT * FROM login WHERE username= '$_SESSION['username']'");
$output = '
<table class="table table-bordered table-striped">
 <tr>
  <th>Username</th>
  <th>Status</th>
  <th>Action</th>
 </tr>
';


 $data= " SELECT * FROM employee WHERE userusername != '".$_SESSION['name_Employee']."'";
 $statement_data = $connect->prepare($data);

 $statement_data->execute();

 $result_data = $statement_data->fetchAll();

 foreach($result_data as $row_data)
 {
  $name = $row_data['userusername'];
  $DID = $row_data['DID'];



//for($i=0;$i<$count;$i++){
  $query23 = "
  SELECT * FROM employee WHERE (userusername != '".$_SESSION['name_Employee']."') AND (DID != '".$_SESSION['DID_Employee']."')";
  $statement23 = $connect->prepare($query23);

  $statement23->execute();

  $result23 = $statement23->fetchAll();

  foreach($result23 as $row23)
  {
   $id = $row23['EID'];



    $query = "
    SELECT * FROM employee
    WHERE EID = '".$id."'
    ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();



    foreach($result as $row)
    {
     $status = '';
     $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
     $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
     $user_last_activity = fetch_user_last_activity($row['userusername'], $connect);

     $name__=$row['userusername'];
     if($user_last_activity > $current_timestamp)
     {
      $status = '<span class="label label-success">Online</span>';
     }
     else
     {
      $status = '<span class="label label-danger">Offline</span>';
     }
     $output .= '
     <tr>
      <td>'.$name__.' '.count_unseen_message($ID, $id, $connect).'</td>
      <td>'.$status.'</td>
      <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['EID'].'" data-tousername="'.$row['userusername'].'">Start Chat</button></td>
     </tr>
     ';
    }

}
}
$output .= '</table>';

echo $output;
?>
