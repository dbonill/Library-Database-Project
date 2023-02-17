<?php
require_once('connection.php');

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username = $_POST["username"];
    $password = $_POST["pwd"];
    
    if($username == NULL || $password == NULL)
    {
        echo "Please enter both your username and password.";
    }
    else
    {
        if(isset($_POST["member"]))
        {
            $sql = "SELECT * FROM members WHERE username = '$username' AND password = '$password'";
            $result = $con->query($sql);
            if($result->num_rows == 1){
            $_SESSION['username'] = $username;
            header("Location: member.php");
            }
        }

        else if(($_POST["employee"]))
        {
            $sql = "SELECT * FROM employees WHERE username = '$username' AND password = '$password'";
            $result = $con->query($sql);
            if($result->num_rows == 1){
            $_SESSION['username'] = $username;
            header("Location: admin.php");
         
            }
        }

        echo "Wrong username or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS file -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>


<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<h1 class="text-center my-3 mt-5">Library of Houston</h1> 
<div class="container mt-5">
        <div class="row justify-content-around">
            <div class="col-3 p-2 bg-light border ">
                <p class="fs-4" fw-bold>Member Login</p>
                <form  method="post">
                  <label for="username">Username:</label><br>
                  <input type="text" id="username" name="username"><br>
                  <label for="pwd">Password:</label><br>
                  <input type="password" id="pwd" name="pwd"><br><br>
                  <input type="submit" name = "member" class="btn btn-primary" value="Go to Member Page" /><br>
                </form>
            </div>
            <div class="col-3 p-2 bg-light border">
                <p class="fs-4" fw-bold>Employee Login</p>
                <form  method="post">
                  <label for="username">Username:</label><br>
                  <input type="text" id="username" name="username"><br>
                  <label for="pwd">Password:</label><br>
                  <input type="password" id="pwd" name="pwd"><br><br>
                  <input type="submit" name = "employee" class="btn btn-primary" value="Go to Admin Page" /><br>
                </form>
        </div>
    </div>
</div>



<div class="container position-absolute bottom-0 end-0">
    <p class = "text-center my-5 fw-bold">Website Created By Team 13. </p>
</div>


</body>
</html>