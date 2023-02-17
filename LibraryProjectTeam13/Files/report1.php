
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>



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
</div>

<div class="container mt-5">

    <div class="mt-5 mb-3 clearfix">
        <h2 class="pull-left">New Items From The Last 30 Days</h2>
                        <!--<a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a> -->


    </div>
</div>

<div class="container mt-5">
  <div class="row">

                <form  method="post">
                <label for="type">Item Type:</label>
                <select name="type" id="type">
                    <option value="all">All</option>
                    <option value="book">Books</option>
                    <option value="media">Media</option>
                    <option value="device">Devices</option>
                    <option value="journal">Journals</option>
                </select> &nbsp;&nbsp;&nbsp; 
                
                <label for="genre">Genre:</label>
                <select name="genre" id="genre">
                    <option value="all">All</option>
                    <option value="Novel">Novel</option>
                    <option value="Biography">Biography</option>
                    <option value="Self Help">Self-Help</option>
                    <option value="Romance">Romance</option>
                    <option value="History">History</option>
                </select>
                
                <input type="submit" name = "report" class="btn btn-primary" value="Generate Report" />   <br> <br>
                </form>  
</div>

  <div class="row">
        	<div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "connection.php";
                    
                    // Attempt select query execution
                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $type = $_POST[type];
                        $genre = $_POST[genre];
                        if($type == 'all' || $type == 'book'){
                            if($genre == 'all'){
                                $sql = "SELECT * FROM books  where date_added > date_sub(now(), interval 1 month) ORDER BY date_published DESC";
                            }
                            else{
                                $sql = "SELECT * FROM books  where date_added > date_sub(now(), interval 1 month) and genre ='$genre' ORDER BY date_published DESC";
                            }
                            if($result = mysqli_query($con, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    echo "<p align='left'> <font size='5pt'><b>Books: </b></font> </p>";
                                    echo '<table class="table table-bordered table-striped">';
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>Item Id</th>";
                                                echo "<th>ISBN</th>";
                                                echo "<th>Title</th>";
                                                echo "<th>Author</th>";
                                                echo "<th>Publisher</th>";
                                                echo "<th>Genre</th>";
                                                echo "<th>Status</th>";
                                                echo "<th>quantity</th>";
                                                echo "<th>Date Added</th>";                                                
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['isbn'] . "</td>";
                                                echo "<td>" . $row['title'] . "</td>";
                                                echo "<td>" . $row['author'] . "</td>";
                                                echo "<td>" . $row['publisher'] . "</td>";
                                                echo "<td>" . $row['genre'] . "</td>";
                                                echo "<td>" . $row['status'] . "</td>";
                                                echo "<td>" . $row['quantity'] . "</td>";
                                                echo "<td>" . $row['date_added'] . "</td>";                                                
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";                            
                                    echo "</table>";
                                if($genre == 'all'){
                                    $sql="SELECT count(*) as total from books where date_added > date_sub(now(), interval 1 month)";
                                }
                                else{
                                    $sql="SELECT count(*) as total from books where date_added > date_sub(now(), interval 1 month) and genre = '$genre'";
                                }
                                
                                $result=mysqli_query($con,$sql);
                                $data=mysqli_fetch_assoc($result);
                                echo "Total: " .$data['total']. "<br><br>";

                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                }
                            } else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }

                        }
                }
                ?>
            </div>
                </div>


            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "connection.php";
                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $type = $_POST[type];                    
                    if($type == 'all' || $type == 'device'){
                    $sql = "SELECT * FROM devices where date_added > date_sub(now(), interval 1 month)";
                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<p align='left'> <font size='5pt'><b>Devices: </b></font> </p>";                            
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Item ID</th>";
                                        echo "<th>Model</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>Brand</th>";
                                        echo "<th>Status</th>";                                        
                                        echo "<th>Quantity</th>";
                                        echo "<th>Date Added</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['model_no'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['brand'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>" . $row['date_added'] . "</td>";                                       
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";

                            $sql="SELECT count(*) as total from devices where date_added > date_sub(now(), interval 1 month)";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "Total: " .$data['total']. "<br><br>";

                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                }

             }
 
                   
                   
                    ?>
            </div>
                </div>

            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "connection.php";
                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $type = $_POST[type];                    
                    if($type == 'all' || $type == 'journal'){
                    $sql = "SELECT * FROM journals where date_added > date_sub(now(), interval 1 month)";
                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<p align='left'> <font size='5pt'><b>Journals: </b></font> </p>";                            
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Item ID</th>";
                                        echo "<th>Journal ID</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Author</th>";
                                        echo "<th>Publisher</th>";
                                        echo "<th>Status</th>";                                        
                                        echo "<th>Quantity</th>";
                                        echo "<th>Date Added</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['journal_id'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['author'] . "</td>";
                                        echo "<td>" . $row['publisher'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>" . $row['date_added'] . "</td>";                                       
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";

                            $sql="SELECT count(*) as total from journals where date_added > date_sub(now(), interval 1 month)";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "Total: " .$data['total']. "<br><br>";

                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                }

             }
 
                   
                   
                    ?>
            </div>
                </div>
                
            <div class="row">
                <div class="col-md-12">
                    <?php
                    // Include config file
                    require_once "connection.php";
                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $type = $_POST[type];                    
                    if($type == 'all' || $type == 'media'){
                    $sql = "SELECT * FROM media where date_added > date_sub(now(), interval 1 month)";
                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<p align='left'> <font size='5pt'><b>Media: </b></font> </p>";                            
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Item ID</th>";
                                        echo "<th>Barcode</th>";
                                        echo "<th>Title</th>";
                                        echo "<th>Director</th>";
                                        echo "<th>Genre</th>";
                                        echo "<th>Status</th>";                                        
                                        echo "<th>Quantity</th>";
                                        echo "<th>Date Added</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['identification'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>" . $row['director'] . "</td>";
                                        echo "<td>" . $row['genre'] . "</td>";
                                        echo "<td>" . $row['status'] . "</td>";
                                        echo "<td>" . $row['quantity'] . "</td>";
                                        echo "<td>" . $row['date_added'] . "</td>";                                       
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";

                            $sql="SELECT count(*) as total from media where date_published > date_sub(now(), interval 1 month)";
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "Total: " .$data['total']. "<br><br>";

                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                }

             }
 
                   
                   
                    ?>
            </div>
                </div>                


</div>
    
</body>
</html>

<?php
}else{
echo '<div class="alert alert-danger" align=centre><em>Must be logged in</em></div>';
}
?>