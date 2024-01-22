<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "insert.php";

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
        }

        #Form {
            margin-bottom: 20px;
        }

        #resultTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #resultTable th, #resultTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        #resultTable1 td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #resultTable th {
            background-color: #f2f2f2;
        }
        </style>
    </head>
    <body>
       <div>
        <form method="post" id="Form" action="insert.php">
            <input type="text" id="forminput" name="forminput"/>
            <input type="submit" name="submit" id="submit" value="submit"/>
            <p id="massage"></p>
        </form>


        <table id="resultTable">
            <thead>
                <tr>
                    <td>sr No</td>
                    <td>title</td>
                    <td>status</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody id="resultTable1">
            <?php
             include 'selectData.php';
            ?>
            </tbody>
        </table>
       </div>
        
        <script>

                function updateStatus(id){
                    $.ajax({
                        type : 'post',
                        url : 'updateData.php',
                        data : {'mark_task' : id},
                        success : function(){
                            $('#resultTable tbody').load('selectData.php'); // Reload the table content
                            $('#massage').html('');
                        }
                    });
                }
                function deleteTodo(id){
                    $.ajax({
                        type : 'post',
                        url : 'deleteData.php',
                        data : {id : id},
                        success : function(){
                         $('#resultTable tbody').load('selectData.php'); // Reload the table content
                         $('#massage').html('');

                        }
                    });
                }

                function updateTable(){
                    $.ajax({
                        type : 'get',
                        url : 'selectData.php',
                        success : function(data){
                            $('#resultTable1').html(data);
                           
                        }
                    });
                }
            $(document).ready(function(){
                updateTable();

                $('#submit').click(function(e){
                    e.preventDefault();
                    var formValue = $('#forminput').val();
                    if(formValue == ''){
                        alert("pls enter the task");
                    }else{
                        $.ajax({
                            type : "post",
                            url : "insert.php",
                            data : $("#Form").serialize(),
                            dataType: "json", // Expect JSON response
                            success : function(result){  
                                // alert("result :"+result);
                                $('#Form p').html(result.message);
                                $('#resultTable tbody').load('selectData.php'); // Reload the table content
                                $('#forminput').val('');
                            }
                        });
                    }
                    return false;
                });
            });
        </script>
    </body>
</html>