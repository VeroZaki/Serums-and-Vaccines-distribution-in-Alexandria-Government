
<?php

//insert_chat.php

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
$data = array(
 ':to_user_id'  => $_POST['to_user_id'],
 ':from_user_id'  => $user__id,
 ':chat_message'  => $_POST['chat_message'],
 ':status'   => '0'
);

$query = "
INSERT INTO chat_message
(to_user_id, from_user_id, chat_message, status)
VALUES (:to_user_id, :from_user_id, :chat_message, :status)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
 echo fetch_user_chat_history($user__id, $_POST['to_user_id'], $connect);
}

?>
