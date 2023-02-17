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





<?php 

session_start();
include("connection.php");
$check = $_SESSION['username'];

if(isset($_SESSION['username'])){
		$check = $_SESSION['username'];
        $id = $_GET['id'];
        $type = $_GET['type'];
        $quantity = $_GET['quantity'];
        $sql = $con->query("Select * from members where username = '$check'");

        $type2 = "";
        if($type == "books")
            $type2 = "book";
        if($type=="devices")
            $type2 = "device";
        if($type=="journals")
            $type2 = "journal";
        if($type=="media")
            $type2 = "media";
        $nextInQueue = $con->query("Select * FROM hold WHERE id = $id AND type = '$type2'");
        if($nextInQueue->num_rows <= 0)
            $nextInQueue = 0;
        //holds for items currently unavailable
        //hold system takes place when quantity is less than hold amound
        //if quantity and hold = 0 then hold system will take place
        //echo $nextInQueue->num_rows;
       if($quantity <= $nextInQueue) //REGULAR HOLD
        {
            if ($sql->num_rows > 0){
                $data = $sql->fetch_array();
                $maxItems = $data['numitemscheckedout'] + 1;
                $memberType = $data['usertype'];
                $maxBorrow = 4;
                if($memberType == "student")
                    $maxBorrow = 4;
                if($memberType == "faculty")
                    $maxBorrow = 6;
                
                    if($maxItems < $maxBorrow)
                    { //max items for member has to be less than 6 to work
                    	
                        
                    
                    
                    if($data['isallowedtorent'] == 1) //check to see if they can hold
                    {
                        
                        $cardnum = $data['cardnumber'];
                        $IsCheckedOut = $con->query("Select * from borrow where cardnumber = $cardnum AND id = $id AND type = '$type2' AND date_returned = '0000-00-00'"); //check borrow to see if already checked out
                        $IsHold = $con->query("Select * from hold where cardnumber = $cardnum AND id = $id AND type = '$type2'");
                        //need to make another query to check hold
                        //echo $IsHold->num_rows + 1;
                        
                        $bool = 0;
                        
                        if ($IsCheckedOut->num_rows > 0 || $IsHold->num_rows>0)
                        {
                            $bool = 1;
                        }
                        if($bool == 1) //need double ==
                            echo '<div class="alert alert-danger"><em>Failed to hold. You already have this item checked out or on hold!</em></div>';
                            //echo "Failed to hold. You already have this item checked out or on hold!";
                        else{
                            $updateTable = $con->query("UPDATE `members` SET `numitemscheckedout` = $maxItems WHERE `members`.`cardnumber` = $data[cardnumber]");
                            //insert into hold
                            
                            $date = date('Y-m-d');
                            $date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+7, date("Y")));
                            $InQueue = $con->query("Select * FROM hold WHERE id = $id AND type = '$type2' AND queue > 0");
                            $queuePOS = $InQueue->num_rows;
                            //echo $InQueue->num_rows;
                            //echo "$queuePOS";
                            if($queuePOS == 0)
                                $queuePOS = $queuePOS + 1;
                            else
                                $queuePOS = $queuePOS + 1;
                            //echo $queuePOS;
                            $insertCopy = $con->query( "INSERT INTO `hold` (`hold_id`, `cardnumber`, `id`, `type`, `queue`,`start_date`, `end_date`) VALUES (NULL, '$cardnum', '$id', '$type2', '$queuePOS', '$date', '0000-00-00')");
                            echo '<div class="alert alert-success"><em>Now put on hold in position '. $queuePOS.'<em></div>';
                            
                            //echo "Now put on hold in position ";
                            //echo "$queuePOS";
                            
                            
                            
                        }
                        
                    }
                    else
                    
                       echo '<div class="alert alert-danger"><em>Can not hold due to unpaid fines!</em></div>';
                }
                else
                    echo '<div class="alert alert-danger"><em>You have reached the max amount of items to hold/checkout</em></div>';
            }
            
            //echo "now put on hold";
        }
        else
        { //alert alert-success
            echo '<div class="alert alert-danger"><em>Item is currently available!<em></div>';
        }
        





	}
else
    echo '<div class="alert alert-danger"><em>Must be logged in to hold items<em></div>';



?>
<br>
<a href="library.php">Continue Browsing</a>

</body>
</html>
