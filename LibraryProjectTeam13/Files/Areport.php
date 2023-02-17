<?php
error_reporting(E_ERROR | E_PARSE);
    include('connection.php');
?>
<!DOCTYPE html>
<html>
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body>
    
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

          
                
                    <li class="nav-item">
                <a class="nav-link active" href="member.php">Home Page</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link active" href="library.php">Library</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link active" href="fines.php">Check Fines</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link active" href="return.php">Return Items</a>
                </li>
                
                 <li class="nav-item">
                <a class="nav-link active" href="Areport.php">Account Report</a>
                </li>
                
                
                
                 <li class="nav-item">
                <a class="nav-link active" href="logout.php">Logout</a>
                </li>


            </ul>
            </div>
        </div>
        </nav>
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
                
                <label for="Time">Time:</label>
                <select name="time" id="time">
                    <option value="none">Select Time Frame</option>
                    <option value="All Time">All</option>
                    <option value="1 Week">1 Week</option>
                    <option value="2 Week">2 Week</option>
                    <option value="3 Week">3 Week</option>
                </select>
                
                <input type="submit" name = "submit" class="btn btn-primary" value="Generate Report" />   <br> <br>
                </form>  
</div>

    
    
<?php
session_start();
include("connection.php");
$check = $_SESSION['username'];


if(isset($_SESSION['username'])){
    
   if (isset($_POST['submit'])){
    $type = $_POST[type];
    $time = $_POST[time];

            $sql = $con->query("Select * from members where username = '$check'");
        $memberarray = $sql->fetch_array();
        $cardnum = $memberarray['cardnumber'];
        
        
if($time=="All Time" || $time=="none"){
    if($type=="all"){
        $sql0 = $con->query("Select * from fines where cardnumber = '$cardnum' order by date_issued");
        $sql1 = $con->query("Select * from borrow where cardnumber = '$cardnum'order by date_issued");
        $sql2 = $con->query("Select * from hold where cardnumber = '$cardnum'order by start_date");
       }
       else{
        $sql0 = $con->query("Select * from fines where type = '$type' and cardnumber = '$cardnum' order by date_issued ");
        $sql1 = $con->query("Select * from borrow where type = '$type' and cardnumber = '$cardnum'order by date_issued ");
        $sql2 = $con->query("Select * from hold where type = '$type' and cardnumber = '$cardnum'order by start_date");
       }
    }
if($time=="1 Week"){
        if($type=="all"){
        $lastWeek = date("Y-m-d", strtotime("-7 days"));
        $sql0 = $con->query("Select * from fines where cardnumber = '$cardnum' and date_issued<'$lastWeek' order by date_issued ");
        //$sql12 =$con->query("date_sub(now(), interval 7 DAY) as date");
        //$check =  $sql12->fetch_array();
        //echo $check['0'];
        $sql1 = $con->query("Select * from borrow where cardnumber = '$cardnum'and date_issued>date_sub(now(), interval 7 DAY) order by date_issued");
        $sql2 = $con->query("Select * from hold where cardnumber = '$cardnum' and start_date>date_sub(now(), interval 7 DAY) order by start_date");
       }
       else{ 
        $lastWeek = date("Y-m-d", strtotime("-7 days"));
        $sql0 = $con->query("Select * from fines where type = '$type' and cardnumber = '$cardnum'  and date_issued<'$lastWeek' order by date_issued) order by date_issued ");
        $sql1 = $con->query("Select * from borrow where type = '$type' and cardnumber = '$cardnum' and date_issued>date_sub(now(), interval 7 DAY) order by date_issued ");
        $sql2 = $con->query("Select * from hold where type = '$type' and cardnumber = '$cardnum' and start_date>date_sub(now(), interval 7 DAY) order by start_date");
       }
       
    
    }
if($time=="2 Week"){
    
            if($type=="all"){
 $lastWeek = date("Y-m-d", strtotime("-14 days"));
        $sql0 = $con->query("Select * from fines where type = '$type' and cardnumber = '$cardnum'  and date_issued<'$lastWeek' order by date_issued) order by date_issued ");
        $sql1 = $con->query("Select * from borrow where cardnumber = '$cardnum'and date_issued>date_sub(now(), interval 14 DAY) order by date_issued");
        $sql2 = $con->query("Select * from hold where cardnumber = '$cardnum' and start_date>date_sub(now(), interval 14 DAY) order by start_date");
       }
       else{
         $lastWeek = date("Y-m-d", strtotime("-14 days"));
        $sql0 = $con->query("Select * from fines where type = '$type' and cardnumber = '$cardnum'  and date_issued<'$lastWeek' order by date_issued) order by date_issued ");
        $sql1 = $con->query("Select * from borrow where type = '$type' and cardnumber = '$cardnum' and date_issued>date_sub(now(), interval 14 DAY) order by date_issued ");
        $sql2 = $con->query("Select * from hold where type = '$type' and cardnumber = '$cardnum' and start_date>date_sub(now(), interval 14 DAY) order by start_date");
       }
       
 
          
       }
if($time=="3 Week"){
        if($type=="all"){
        $lastWeek = date("Y-m-d", strtotime("-21 days"));
        $sql0 = $con->query("Select * from fines where type = '$type' and cardnumber = '$cardnum'  and date_issued<'$lastWeek' order by date_issued) order by date_issued ");
        $sql1 = $con->query("Select * from borrow where cardnumber = '$cardnum'and date_issued>date_sub(now(), interval 21 DAY) order by date_issued");
        $sql2 = $con->query("Select * from hold where cardnumber = '$cardnum' and start_date>date_sub(now(), interval 21 DAY) order by start_date");
       }
       else{
        $lastWeek = date("Y-m-d", strtotime("-21 days"));
        $sql0 = $con->query("Select * from fines where type = '$type' and cardnumber = '$cardnum'  and date_issued<'$lastWeek' order by date_issued) order by date_issued ");
        $sql1 = $con->query("Select * from borrow where type = '$type' and cardnumber = '$cardnum' and date_issued>date_sub(now(), interval 21 DAY) order by date_issued ");
        $sql2 = $con->query("Select * from hold where type = '$type' and cardnumber = '$cardnum' and start_date>date_sub(now(), interval 21 DAY) order by start_date");
       } 
    } 

       
        if ($sql0->num_rows > 0 ){
            echo "<br>";
            
            ?>
            
     <h1  class="d-flex justify-content-center">Account Report</h1>
             <h1  class="d-flex justify-content-center">Fines History</h1>

            <?php
            
            while($data = $sql0->fetch_array()){
                $string = "";
                if($data[4]>0)
                    $string = "paid";
                else
                    $string = "not paid";
        
                if(($data[2])>0){?> 
		<table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
				<tr>
					<th>Fine ID</th>
					<th>Type</th>
					<th>CardNumber</th>
					<th>Total Amount</th>
					<th>Date Issued</th>
					<th>Status</th>
				</tr>
				<tr>
					<td><?php echo $data[0]; ?></td>
					<td><?php echo $data[7]; ?></td>
					<td><?php echo $data[1]; ?></td>
					<td>$<?php echo$data[2] ?></td>
					<td><?php echo $data[3]; ?></td>
					<td><?php echo $string; ?></td>
				</tr>
			</table>
		
		
         <?php       
               }     
            }
        }
        ?>
        <?PHP

        if ($sql1->num_rows > 0){
             echo "<br>";
            ?>
           
          
               <h1  class="d-flex justify-content-center">Borrowed History</h1>
            <?php
            while($data = $sql1->fetch_array()){ 
                      
                        $type2 = "";
                        if($data['type'] == "book")
                            $type2 = "books";
                        else if($data['type']=="device")
                            $type2 = "devices";
                        else if($data['type']=="journal")
                            $type2 = "journals";
                        else if($data['type'=="media"])
                            $type2 = "media";
                        $itemid = $data['id'];
                        //echo $itemid;
                        $fetchTitle = $con->query("Select title from $type2 where id = $itemid");
                        $itemTitle = $fetchTitle->fetch_array();
                       
                        
                    ?>
                    

                   <table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
 
                        <tr>
                            <th>BorrowID</th>
                            <th>Title</th>
                            <th>ItemID</th>
                            <th>Type</th>
                            <th>Date Issued</th>
                            <th>Date Due</th>
                            <th>Date Returned</th>
                            
                            
                            
                        </tr>
                        <tr>
                            <td><?php echo $data[0]; ?></td>
                            <td><?php echo $itemTitle[0]; ?></td>
                            <td><?php echo $data[2]; ?></td>
                            <td><?php echo $data[3]; ?></td>
                            <td><?php echo $data[4]; ?></td>
                            <td><?php echo $data[5]; ?></td>
                            <td><?php
                            
                            
                            
                            if( $data[6] == 0000-00-00)
                                echo "Still Out";
                            else
                                echo "$data[6]";
                            
                            
                            
                            
                            ?></td>
                            
                        </tr>
                    </table>
          

        
   <?php 
        
        }
        }
      
    ?>   
<?php
if ($sql2->num_rows > 0 ){
    echo "<br>";
    ?>
    <h1  class="d-flex justify-content-center">Current Holds</h1>
           
            <?php
            while($data = $sql2->fetch_array()){
              $type2 = "";
                        if($data['type'] == "book")
                            $type2 = "books";
                        else if($data['type']=="device")
                            $type2 = "devices";
                        else if($data['type']=="journal")
                            $type2 = "journals";
                        else if($data['type'=="media"])
                            $type2 = "media";
                        $itemid = $data['id'];
                        //echo $itemid;
                        $fetchTitle = $con->query("Select title from $type2 where id = $itemid");
                        $itemTitle = $fetchTitle->fetch_array();
                       ?> 
            
     
			<table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
				<tr>
				    <th>Hold ID</th>
					<th>CardNumber</th>
					<th>Title</th>
					<th>Type</th>
					<th>Date Issued</th>
					<th>queue</th>
				</tr>
				<tr>
				    <td><?php echo $data[0]; ?></td>
					<td><?php echo $data[1]; ?></td>
					<td><?php echo $itemTitle[0]; ?></td>
					<td><?php echo $data[3];?></td>
					<td><?php echo $data[5]; ?></td>
					<td><?php echo $data[4]; ?></td>
				</tr>
			</table>
		
		
         <?php       
               }     
            }
        
        ?>

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
       <?php
}
}   
else{

  echo '<div class="alert alert-danger" align=centre><em>"You must Sekect A week</em></div>';
			
}
				
				
			
   
?>









<br>
</body>
</html>