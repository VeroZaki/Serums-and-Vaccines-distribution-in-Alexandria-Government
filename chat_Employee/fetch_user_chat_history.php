
<?php

//fetch_user_chat_history.php

include('database_connection.php');

session_start();
$d= "
SELECT * FROM employee WHERE userusername = '".$_SESSION['name_Employee']."'
";
$statement_d = $connect->prepare($d);

$statement_d->execute();

$result_d = $statement_d->fetchAll();

foreach($result_d as $row_d)
{
 $user__id = $row_d['EID'];
}
echo fetch_user_chat_history($user__id, $_POST['to_user_id'], $connect);

?>
