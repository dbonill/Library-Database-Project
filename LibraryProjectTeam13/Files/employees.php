
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin.php</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
if(isset($_SESSION['username'])){
?>

<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="display.php">Inventory</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link active" href="employees.php">Employees</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link active" href="search_user.php">Members</a>
                </li>    
                
                <li class="nav-item">
                <a class="nav-link active" href="report1.php">New Items Report</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link active" href="overdue_report.php">Overdue Items Report</a>
                </li>                
                
                <li class="nav-item">
                <a class="nav-link active" href="logout.php">LogOut</a>
                </li>

            </ul>
            </div>
        </div>
        </nav>
        
        
        <?php 
        //the if statement wont work the first time, so it'll go to the else (always).
        if(isset($_POST['addemployeebutton'])){
        ?>
            
            <a href="employees.php"><button class="btn btn-danger my-2">Back</button></a>
            <div></div>
            <form action="adders/addemployee.php" method="post" class="d-flex flex-column align-items-center col=3>
                
                <label for="ssn">ssn:</label>
                <input type="text" name="ssn"><br>
        
                <label for="username">username:</label>
                <input type="text" name="username"><br>
        
                <label for="fname">fname:</label>
                <input type="text" name="fname"><br>
        
                <label for="lname">lname:</label>
                <input type="text" name="lname"><br>
                
                <label for="bdate">bdate:</label>
                <input type="date" name="bdate"><br>
                
                <input type="radio" id="male" name="sex" value="M">
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="sex" value="F">
                <label for="female">Female</label><br>
        
                <label for="phone">phone:</label>
                <input type="tel" name="phone"><br>
                
                <label for="email">email:</label>
                <input type="email" name="email"><br>
                
                <label for="address">address:</label>
                <input type="text" name="address"><br>
                
                <label for="password">password:</label>
                <input type="text" name="password"><br>
        
                <input type="submit" name="addemployee" value="Add Employee" class="btn btn-primary my-2"><br>
                
            </form>
        
        
        <?php 
        }else{
        ?>
        
        
        <div class="container mt-5">
            <div class="mt-5 mb-3 clearfix">
                <h2 class="pull-left">Search Employees</h2>
            </div>
        </div>


        <div class="container">
            <div class="row">
    
                <form  method="post">
                <label for="keyword">Type Name or User ID:</label><br>
                <input type="text" id="keyword" name="keyword">
                
                <input type="submit" name = "search" class="btn btn-primary" value="Search" />   <br> <br>
                </form> 
            
            
            </div>
        </div>
        
        
        
        <div class="row">
<?php
            
            require_once('connection.php');
            
            $keyword = $_POST[keyword];
            
    
        
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $sql = "SELECT * FROM employees where ssn = '$keyword' or CONCAT(fname, ' ', lname) like '%$keyword%'";
                if($response = mysqli_query($con, $sql)){
                    if(mysqli_num_rows($response) > 0){  
                        echo '<table class="table table-bordered table-striped">
                        <tr><td align="left"><b>ssn </b></td>
                        <td align="left"><b>username</b></td>
                        <td align="left"><b>fname </b></td>
                        <td align="left"><b>lname </b></td>
                        <td align="left"><b>bdate</b></td>
                        <td align="left"><b>sex</b></td>
                        <td align="left"><b>phone</b></td>
                        <td align="left"><b>email</b></td>
                        <td align="left"><b>address</b></td>
                        <td align="left"><b>password</b></td>
                        <td align="left"><b>action</b></td></tr>';
                
                        while($row = mysqli_fetch_assoc($response)){
                
                            echo '<tr>
                            <td align="left">'.$row['ssn'].'</td>
                            <td align="left">'.$row['username'].'</td>
                            <td align="left">'.$row['fname'].'</td>
                            <td align="left">'.$row['lname'].'</td>
                            <td align="left">'.$row['bdate'].'</td>
                            <td align="left">'.$row['sex'].'</td>
                            <td align="left">'.$row['phone'].'</td>
                            <td align="left">'.$row['email'].'</td>
                            <td align="left">'.$row['address'].'</td>
                            <td align="left">'.$row['password'].'</td>
                            <td>
                                <div class="d-flex justify-content-evenly">
                                    <a href="edit.php?editE='.$row['ssn'].'"class="btn btn-info"> Edit</a>
                                    <a href="delete.php?deleteE='.$row['ssn'].'"class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                            </tr>';
                        }
                    }else{
                        echo "No matched user";
                    }
        
                }
                
                echo '</table>';
                echo
                    '<form action="employees.php" method="POST" class="d-flex justify-content-end">
                        <input type="submit" name="addemployeebutton" value="Add New Employee" class="btn btn-success my-2">
                    </form>';
            }
?>
        </div>
        
<?php 
        }
?>
        
    
        
    </div>
</body>

<?php
}else{
echo '<div class="alert alert-danger" align=centre><em>Must be logged in</em></div>';
}
?>