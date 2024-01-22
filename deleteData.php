<?php 

$db = mysqli_connect("localhost","root","root","todoList");

$Delvalue = $_POST['id'];

$select_stmt = mysqli_prepare($db,"DELETE FROM todos WHERE id = ?");
mysqli_stmt_bind_param($select_stmt,"i",$Delvalue);
mysqli_stmt_execute($select_stmt);
mysqli_stmt_close($select_stmt);

?>