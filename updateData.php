<?php 

$db = mysqli_connect("localhost","root","root","todoList");

if(isset($_POST['mark_task'])){
    $id = $_POST['mark_task'];
    
    $stmt_select= mysqli_prepare($db,"SELECT completed FROM todos WHERE id = ?");
    mysqli_stmt_bind_param($stmt_select,"i",$id);
    mysqli_stmt_execute($stmt_select);
    mysqli_stmt_bind_result($stmt_select, $isCompleted);


    mysqli_stmt_fetch($stmt_select);
    mysqli_stmt_close($stmt_select);
    if(!$isCompleted){
        $stmt_update = mysqli_prepare($db,"UPDATE todos SET completed = true WHERE id = ?");
       
    }else{
        $stmt_update = mysqli_prepare($db,"UPDATE todos SET completed = false WHERE id = ?");
       
    }

     mysqli_stmt_bind_param($stmt_update,"i", $id);
     mysqli_stmt_execute($stmt_update);
     mysqli_stmt_close($stmt_update);

    //  header('location: index.php'); // Redirect to a clean URL after updating
     exit(); 
   
}

?>