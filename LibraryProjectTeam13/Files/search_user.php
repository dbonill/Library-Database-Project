
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS file -->
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
if(isset($_POST['addmemberbutton'])){
?>
            
    <a href="search_user.php"><button class="btn btn-danger my-2">Back</button></a>
    <div></div>
    <form action="adders/addmember.php" method="post" class="d-flex flex-column align-items-center col=3>
        
        <label for="username">username:</label>
        <input type="text" name="username"><br>

        <label for="fname">fname:</label>
        <input type="text" name="fname"><br>

        <label for="lname">lname:</label>
        <input type="text" name="lname"><br>

        <label for="phone">phone:</label>
        <input type="tel" name="phone"><br>
        
        <label for="email">email:</label>
        <input type="email" name="email"><br>
        
        <label for="password">password:</label>
        <input type="text" name="password"><br>
        
        <label for="usertype">usertype:</label>
        <input type="text" name="usertype"><br>
        
        <input type="submit" name="addmember" value="Add Member" class="btn btn-primary my-2"><br>
        
    </form>


<?php 
}else{
?>



    <div class="container mt-5">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">Search Member</h2>
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
        <div class="col-md-12">
            <?php
            // Include config file
            require_once "connection.php";

            $keyword = $_POST[keyword];
            
            // Attempt select query execution


            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $sql = "SELECT * FROM members where cardnumber = '$keyword' or CONCAT(fname, ' ', lname) like '%$keyword%'";
                if($result = mysqli_query($con, $sql)){
                    if(mysqli_num_rows($result) > 0){  
                        echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>User Id</th>";
                                    echo "<th>First Name</th>";
                                    echo "<th>Last Name</th>";
                                    echo "<th>Phone Number</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Checked Out Items Number</th>";
                                    echo "<th>Allowed to Borrow</th>";
                                    echo "<th>Password</th>";
                                    echo "<th>Student/Faculty</th>";
                                    echo "<th>Action</th>";
    
                                    
                                    
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['cardnumber'] . "</td>";
                                    echo "<td>" . $row['fname'] . "</td>";
                                    echo "<td>" . $row['lname'] . "</td>";
                                    echo "<td>" . $row['phone'] . "</td>";
                                    echo "<td>" . $row['email'] . "</td>";
                                    echo "<td>" . $row['numitemscheckedout'] . "</td>";
                                    echo "<td>" . $row['isallowedtorent'] . "</td>";
                                    echo "<td>" . $row['password'] . "</td>";
                                    echo "<td>" . $row['usertype'] . "</td>";
                                    echo '<td>
                                        <a href="edit.php?editMem='.$row['cardnumber'].'" class="btn btn-info"> Edit</a>
                                        <a href="delete.php?deleteMem='.$row['cardnumber'].'" class="btn btn-danger">Delete</a>
                                        </td>';

                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>"; 
                    }
                    else{
                        echo "No matched user";
                    }
                }
                
                echo '<form action="search_user.php" method="POST" class="d-flex justify-content-end">
                        <input type="submit" name="addmemberbutton" value="Add New Member" class="btn btn-success my-2">
                      </form>';
                
                
            }

            ?>
            
                
            </div>
        </div>
        
    </div>
<?php 
}
?>
</div>




</body>
</html>

<?php
}else{
echo '<div class="alert alert-danger" align=centre><em>Must be logged in</em></div>';
}
?>