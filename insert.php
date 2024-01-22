<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$db = mysqli_connect("localhost", "root", "root", "todoList");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formValue = isset($_POST['forminput']) ? $_POST['forminput'] : '';

    $stmt_slect = mysqli_prepare($db, "SELECT title FROM todos WHERE title = ? ");
    mysqli_stmt_bind_param($stmt_slect, "s", $formValue);
    mysqli_stmt_execute($stmt_slect);
    mysqli_stmt_bind_result($stmt_slect, $title);
    mysqli_stmt_fetch($stmt_slect);
    mysqli_stmt_close($stmt_slect);

    if (!$title) {
        $stmt_insert = mysqli_prepare($db, "INSERT INTO todos (title, completed) VALUES (?, false)");
        mysqli_stmt_bind_param($stmt_insert, "s", $formValue);
        $result = mysqli_stmt_execute($stmt_insert);

        if ($result) {
            // Set success message
            $message = "Todo added successfully";
        } else {
            $errors = "Error: " . mysqli_error($db);
        }
        mysqli_stmt_close($stmt_insert);
    } else {
        $message = "Todo already exists";
    }

    echo json_encode(['message' => $message]); // Send message as JSON response
    exit();
}
?>
