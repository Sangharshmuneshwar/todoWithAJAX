<?php 
$db = mysqli_connect("localhost","root","root","todoList");


$select_stmt = mysqli_prepare($db,"SELECT * FROM todos");
mysqli_stmt_execute($select_stmt);
mysqli_stmt_bind_result($select_stmt, $id, $title, $completed);
$counter = 1; // Initialize a counter for Sr No

while (mysqli_stmt_fetch($select_stmt)) {
    echo '<tr>';
    echo '<td>'. $counter . '</td>';
    echo '<td>'. $title. '</td>';
    echo '<td>' . ($completed ? 'Completed' : 'Incomplete') . '</td>';
    echo '<td>'.'<button onclick="updateStatus(' . $id . ')">Update Status</button>';
    echo '<button onclick="deleteTodo(' . $id . ')">Delete Todo</button>'.'</td>';
    echo '</tr>';

    $counter++; // Increment the counter for the next row
}
mysqli_stmt_close($select_stmt);

?>