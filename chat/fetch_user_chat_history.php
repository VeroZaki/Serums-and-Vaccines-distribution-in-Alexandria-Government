
<?php

//fetch_user_chat_history.php

include('database_connection.php');

session_start();
$d= "
SELECT * FROM admin WHERE username = '".$_SESSION['name']."'
";
$statement_d = $connect->prepare($d);

$statement_d->execute();

$result_d = $statement_d->fetchAll();

foreach($result_d as $row_d)
{
 $user__id = $row_d['ID'];
}
echo fetch_user_chat_history($user__id, $_POST['to_user_id'], $connect);

?>
