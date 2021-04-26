<?php
include('database_connection.php');

session_start();

$d="SELECT * FROM admin WHERE username = '".$_SESSION['name']."'";
$statement_d = $connect->prepare($d);

$statement_d->execute();

$result_d = $statement_d->fetchAll();

foreach($result_d as $row_d)
{
 $user__id = $row_d['username'];
 $ID = $row_d['ID'];
}
//$user_details_query = mysqli_query($con, "SELECT * FROM login WHERE username= '$_SESSION['username']'");
$output = '
<table class="table table-bordered table-striped">
 <tr>
  <th>Username</th>
  <th>Status</th>
  <th>Action</th>
 </tr>
';


 $data= " SELECT * FROM admin WHERE username != '".$_SESSION['name']."'";
 $statement_data = $connect->prepare($data);

 $statement_data->execute();

 $result_data = $statement_data->fetchAll();

 foreach($result_data as $row_data)
 {
  $name = $row_data['username'];



//for($i=0;$i<$count;$i++){
  $query23 = "
  SELECT * FROM admin WHERE (username != '".$_SESSION['name']."' )";
  $statement23 = $connect->prepare($query23);

  $statement23->execute();

  $result23 = $statement23->fetchAll();

  foreach($result23 as $row23)
  {
   $id = $row23['ID'];



    $query = "
    SELECT * FROM admin
    WHERE ID = '".$id."'
    ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();



    foreach($result as $row)
    {
     $status = '';
     $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
     $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
     $user_last_activity = fetch_user_last_activity($row['username'], $connect);

     $name__=$row['username'];
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
      <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="'.$row['ID'].'" data-tousername="'.$row['username'].'">Start Chat</button></td>
     </tr>
     ';
    }

}
}
$output .= '</table>';

echo $output;
?>
