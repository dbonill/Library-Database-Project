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
                <a class="nav-link active" href="index.php">LogOut</a>
                </li>

            </ul>
            </div>
        </div>
        
        </nav>
        </div>
        
<div class="container mt-5">

    <div class="mt-5 mb-3 clearfix">
        <h2 class="pull-left">Overdue Items Report</h2>
                        <!--<a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a> -->


    </div>
   </div>

<div class="container">
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
            	

                <label for="type">Order By:</label>
                <select name="order" id="order">
                    <option value="asc">Due Date Ascending</option>
                    <option value="desc">Due Date Descending</option>
                </select> &nbsp;&nbsp;&nbsp;
            	

                <label for="length">Late For:</label>
                <select name="length" id="length">
                    <option value="all">At Least A Day</option>
                    <option value="two_week">More Than Two Weeks</option>
                </select>  &nbsp;&nbsp;&nbsp;         

                <input type="submit" name = "report" class="btn btn-primary" value="Generate Report" />   <br> <br>
      

                </form>  
            </div>

  <div class="row">
  	<div class="col-md-12">
                    <?php
					error_reporting(E_ERROR | E_PARSE);
                    // Include config file
                    require_once "connection.php";
                    
                    // Attempt select query execution


                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $type = $_POST[type];
                        $order = $_POST[order];
                        $length = $_POST[length];

                        if($type == 'all' || $type == 'book'){
                        	if($order == 'asc'){
                        		if($length == 'all'){
                        			$sql = "SELECT * FROM members, borrow, books where members.cardnumber = borrow.cardnumber  and borrow.id = books.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ORDER BY borrow.date_due ASC";
                        		}
                        		else{
                        			$sql = "SELECT * FROM members, borrow, books where members.cardnumber = borrow.cardnumber  and borrow.id = books.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ORDER BY borrow.date_due ASC";                        			
                        		}

                        	}
                        	else{
                        		if($length == 'all'){
                        			$sql = "SELECT * FROM members, borrow, books where members.cardnumber = borrow.cardnumber  and borrow.id = books.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ORDER BY borrow.date_due DESC";
                        		}
                        		else{
                        			$sql = "SELECT * FROM members, borrow, books where members.cardnumber = borrow.cardnumber  and borrow.id = books.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ORDER BY borrow.date_due DESC";                        			
                        		}
                     		

                        	}


                            echo "<p align='left'> <font size='5pt'><b>Books: </b></font> </p>";
                            if($result = mysqli_query($con, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    

                                    echo '<table class="table table-bordered table-striped">';
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>Borrow ID</th>";
                                                echo "<th>Item ID</th>";
                                                echo "<th>Title</th>";
                                                echo "<th>User ID</th>";
                                                echo "<th>First Name</th>";
                                                echo "<th>Last Name</th>";
                                                echo "<th>Phone</th>";
                                                echo "<th>Email</th>";
                                                echo "<th>Borrowed Date</th>";
                                                echo "<th>Due Date</th>";
                                                echo "<th>Late For</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>";
                                                echo "<td>" . $row['borrow_id'] . "</td>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['title'] . "</td>";
                                                echo "<td>" . $row['cardnumber'] . "</td>";
                                                echo "<td>" . $row['fname'] . "</td>";
                                                echo "<td>" . $row['lname'] . "</td>";
                                                echo "<td>" . $row['phone'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                           		echo "<td>" . $row['date_issued'] . "</td>";
                                           		echo "<td>" . $row['date_due'] . "</td>";
												$ts2 = strtotime($row['date_due']);
												$ts1 = strtotime("now"); 

												$seconds_diff = $ts1 - $ts2;                            
												$time = ($seconds_diff/3600/24);
												echo "<td>" . floor($time) . " days" . "</td>";
												//echo "dd".floor($time). "<br>"; 

                                            	echo "</tr>";
                                        }
                                        echo "</tbody>";                            
                                    echo "</table>";

                        		if($length == 'all'){
                        			$sql = "SELECT count(*) as total FROM members, borrow, books where members.cardnumber = borrow.cardnumber  and borrow.id = books.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00";
                        		}
                        		else{
                        			$sql = "SELECT count(*) as total FROM members, borrow, books where members.cardnumber = borrow.cardnumber  and borrow.id = books.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00";                        			
                        		} 

                
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "Total: " .$data['total']. "<br> <br>";                                 
                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                }

                            } else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                                                                                    // Close connection
         

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
                    
                    // Attempt select query execution


                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $type = $_POST[type];
                        $order = $_POST[order];
                        $length = $_POST[length];

                        if($type == 'all' || $type == 'device'){
                        	if($order == 'asc'){
                        		if($length == 'all'){
                        			$sql = "SELECT * FROM members, borrow, devices where members.cardnumber = borrow.cardnumber  and borrow.id = devices.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ORDER BY borrow.date_due ASC";
                        		}
                        		else{
                        			$sql = "SELECT * FROM members, borrow, devices where members.cardnumber = borrow.cardnumber  and borrow.id = devices.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ORDER BY borrow.date_due ASC";                        			
                        		}

                        	}
                        	else{
                        		if($length == 'all'){
                        			$sql = "SELECT * FROM members, borrow, devices where members.cardnumber = borrow.cardnumber  and borrow.id = devices.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ORDER BY borrow.date_due DESC";
                        		}
                        		else{
                        			$sql = "SELECT * FROM members, borrow, devices where members.cardnumber = borrow.cardnumber  and borrow.id = devices.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ORDER BY borrow.date_due DESC";                        			
                        		}
                     		

                        	}


                            echo "<p align='left'> <font size='5pt'><b>Devices: </b></font> </p>";
                            if($result = mysqli_query($con, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    

                                    echo '<table class="table table-bordered table-striped">';
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>Borrow ID</th>";
                                                echo "<th>Item ID</th>";
                                                echo "<th>Title</th>";
                                                echo "<th>User ID</th>";
                                                echo "<th>First Name</th>";
                                                echo "<th>Last Name</th>";
                                                echo "<th>Phone</th>";
                                                echo "<th>Email</th>";
                                                echo "<th>Borrowed Date</th>";
                                                echo "<th>Due Date</th>";
                                                echo "<th>Late For</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>";
                                                echo "<td>" . $row['borrow_id'] . "</td>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['title'] . "</td>";
                                                echo "<td>" . $row['cardnumber'] . "</td>";
                                                echo "<td>" . $row['fname'] . "</td>";
                                                echo "<td>" . $row['lname'] . "</td>";
                                                echo "<td>" . $row['phone'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                           		echo "<td>" . $row['date_issued'] . "</td>";
                                           		echo "<td>" . $row['date_due'] . "</td>";
												$ts2 = strtotime($row['date_due']);
												$ts1 = strtotime("now"); 

												$seconds_diff = $ts1 - $ts2;                            
												$time = ($seconds_diff/3600/24);
												echo "<td>" . floor($time) . " days" . "</td>";
												//echo "dd".floor($time). "<br>"; 

                                            	echo "</tr>";
                                        }
                                        echo "</tbody>";                            
                                    echo "</table>";

                        		if($length == 'all'){
                        			$sql = "SELECT count(*) as total FROM members, borrow, devices where members.cardnumber = borrow.cardnumber  and borrow.id = devices.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00";
                        		}
                        		else{
                        			$sql = "SELECT count(*) as total FROM members, borrow, devices where members.cardnumber = borrow.cardnumber  and borrow.id = devices.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00";                        			
                        		} 

                
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "Total: " .$data['total']. "<br> <br>";                                 
                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                }

                            } else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                                                                                    // Close connection
         

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
                    
                    // Attempt select query execution


                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $type = $_POST[type];
                        $order = $_POST[order];
                        $length = $_POST[length];

                        if($type == 'all' || $type == 'journal'){
                        	if($order == 'asc'){
                        		if($length == 'all'){
                        			$sql = "SELECT * FROM members, borrow, journals where members.cardnumber = borrow.cardnumber  and borrow.id = journals.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ORDER BY borrow.date_due ASC";
                        		}
                        		else{
                        			$sql = "SELECT * FROM members, borrow, journals where members.cardnumber = borrow.cardnumber  and borrow.id = journals.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ORDER BY borrow.date_due ASC";                        			
                        		}

                        	}
                        	else{
                        		if($length == 'all'){
                        			$sql = "SELECT * FROM members, borrow, journals where members.cardnumber = borrow.cardnumber  and borrow.id = journals.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ORDER BY borrow.date_due DESC";
                        		}
                        		else{
                        			$sql = "SELECT * FROM members, borrow, journals where members.cardnumber = borrow.cardnumber  and borrow.id = journals.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ORDER BY borrow.date_due DESC";                        			
                        		}
                     		

                        	}


                            echo "<p align='left'> <font size='5pt'><b>Journals: </b></font> </p>";
                            if($result = mysqli_query($con, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    

                                    echo '<table class="table table-bordered table-striped">';
                                        echo "<thead>";
                                            echo "<tr>";
        
                                                echo "<th>Borrow ID</th>";
                                                echo "<th>Item ID</th>";
                                                echo "<th>Title</th>";
                                                echo "<th>User ID</th>";
                                                echo "<th>First Name</th>";
                                                echo "<th>Last Name</th>";
                                                echo "<th>Phone</th>";
                                                echo "<th>Email</th>";
                                                echo "<th>Borrowed Date</th>";
                                                echo "<th>Due Date</th>";
                                                echo "<th>Late For</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>";
                                                echo "<td>" . $row['borrow_id'] . "</td>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['title'] . "</td>";
                                                echo "<td>" . $row['cardnumber'] . "</td>";
                                                echo "<td>" . $row['fname'] . "</td>";
                                                echo "<td>" . $row['lname'] . "</td>";
                                                echo "<td>" . $row['phone'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                           		echo "<td>" . $row['date_issued'] . "</td>";
                                           		echo "<td>" . $row['date_due'] . "</td>";
												$ts2 = strtotime($row['date_due']);
												$ts1 = strtotime("now"); 

												$seconds_diff = $ts1 - $ts2;                            
												$time = ($seconds_diff/3600/24);
												echo "<td>" . floor($time) . " days" . "</td>";
												//echo "dd".floor($time). "<br>"; 

                                            	echo "</tr>";
                                        }
                                        echo "</tbody>";                            
                                    echo "</table>";

                        		if($length == 'all'){
                        			$sql = "SELECT count(*) as total FROM members, borrow, journals where members.cardnumber = borrow.cardnumber  and borrow.id = journals.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ";
                        		}
                        		else{
                        			$sql = "SELECT count(*) as total FROM members, borrow, journals where members.cardnumber = borrow.cardnumber  and borrow.id = journals.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ";                        			
                        		} 

                
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "Total: " .$data['total']. "<br> <br>";                                 
                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                }

                            } else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                                                                                    // Close connection
         

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
                    
                    // Attempt select query execution


                    if($_SERVER['REQUEST_METHOD'] == "POST"){
                        $type = $_POST[type];
                        $order = $_POST[order];
                        $length = $_POST[length];

                        if($type == 'all' || $type == 'media'){
                        	if($order == 'asc'){
                        		if($length == 'all'){
                        			$sql = "SELECT * FROM members, borrow, media where members.cardnumber = borrow.cardnumber  and borrow.id = media.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ORDER BY borrow.date_due ASC";
                        		}
                        		else{
                        			$sql = "SELECT * FROM members, borrow, media where members.cardnumber = borrow.cardnumber  and borrow.id = media.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ORDER BY borrow.date_due ASC";                        			
                        		}

                        	}
                        	else{
                        		if($length == 'all'){
                        			$sql = "SELECT * FROM members, borrow, media where members.cardnumber = borrow.cardnumber  and borrow.id = media.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ORDER BY borrow.date_due DESC";
                        		}
                        		else{
                        			$sql = "SELECT * FROM members, borrow, media where members.cardnumber = borrow.cardnumber  and borrow.id = media.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ORDER BY borrow.date_due DESC";                        			
                        		}
                     		

                        	}


                            
                            if($result = mysqli_query($con, $sql)){
                                echo "<p align='left'> <font size='5pt'><b>Media: </b></font> </p>";
                                if(mysqli_num_rows($result) > 0){
                                    

                                    echo '<table class="table table-bordered table-striped">';
                                        echo "<thead>";
                                            echo "<tr>";
        
                                                echo "<th>Borrow ID</th>";
                                                echo "<th>Item ID</th>";
                                                echo "<th>Title</th>";
                                                echo "<th>User ID</th>";
                                                echo "<th>First Name</th>";
                                                echo "<th>Last Name</th>";
                                                echo "<th>Phone</th>";
                                                echo "<th>Email</th>";
                                                echo "<th>Borrowed Date</th>";
                                                echo "<th>Due Date</th>";
                                                echo "<th>Late For</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo "<tr>";
                                                echo "<td>" . $row['borrow_id'] . "</td>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['title'] . "</td>";
                                                echo "<td>" . $row['cardnumber'] . "</td>";
                                                echo "<td>" . $row['fname'] . "</td>";
                                                echo "<td>" . $row['lname'] . "</td>";
                                                echo "<td>" . $row['phone'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                           		echo "<td>" . $row['date_issued'] . "</td>";
                                           		echo "<td>" . $row['date_due'] . "</td>";
												$ts2 = strtotime($row['date_due']);
												$ts1 = strtotime("now"); 

												$seconds_diff = $ts1 - $ts2;                            
												$time = ($seconds_diff/3600/24);
												echo "<td>" . floor($time) . " days" . "</td>";
												//echo "dd".floor($time). "<br>"; 

                                            	echo "</tr>";
                                        }
                                        echo "</tbody>";                            
                                    echo "</table>";

                        		if($length == 'all'){
                        			$sql = "SELECT count(*) as total FROM members, borrow, media where members.cardnumber = borrow.cardnumber  and borrow.id = media.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 0 and date_returned = 0000-00-00 ";
                        		}
                        		else{
                        			$sql = "SELECT count(*) as total FROM members, borrow, media where members.cardnumber = borrow.cardnumber  and borrow.id = media.id and unix_timestamp() - unix_timestamp(borrow.date_due) > 60* 60 *24 * 14 and date_returned = 0000-00-00 ";                        			
                        		} 

                
                            $result=mysqli_query($con,$sql);
                            $data=mysqli_fetch_assoc($result);
                            echo "Total: " .$data['total']. "<br> <br>";                                 
                                    // Free result set
                                    mysqli_free_result($result);
                                } else{
                                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                }

                            } else{
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                                                                                    // Close connection
         

                }
            }

         ?>
                
            </div>
                </div>
        
    </div>

</body>
</html>