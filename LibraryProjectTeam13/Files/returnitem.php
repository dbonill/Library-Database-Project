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
        if($type == "book")
            $type2 = "books";
        if($type=="device")
            $type2 = "devices";
        if($type=="journal")
            $type2 = "journals";
        if($type =="media")
            $type2 = "media";

        $removeHold = 0;
        $data = $sql->fetch_array();
        $cardnum = $data['cardnumber'];
        //echo $id;
        //echo $type;
        //echo $cardnum;
        $checkHold = $con->query("Select * from hold where id = $id AND type = '$type' AND cardnumber = $cardnum");
        $checkBorrow = $con->query("Select * from borrow where id = $id AND type = '$type' AND cardnumber = $cardnum AND date_returned = '0000-00-00'");
        //echo $checkHold->num_rows;
        if($checkHold->num_rows>0)
        {
            $removeHold = 1;
            //remove hold
        }

        if($removeHold>0){
            //echo "remove hold";
            //echo "hold over 1";
            
            //$date = date('Y-m-d');
            //$date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+14, date("Y")));

            //$insertCopy = $con->query( "INSERT INTO `borrow` (`borrow_id`, `cardnumber`, `id`, `type`, `date_issued`, `date_due`, `date_returned`) VALUES (NULL, '$cardnum', '$id', '$type2', '$date', '$date_to_return', '0000-00-00')");
            //$insertFines = $con->query("INSERT INTO `fines` (`fine_id`, `cardnumber`, `fine_amount`, `date_issued`, `paid`, `days_passed`, `id`, `type`) VALUES (NULL, '$cardnum', '0.0', '$date_to_return', '0', 0, '$id', '$type2')");
            
            $isZero = -1; //CHECKS FOR QUEUE POSITION ZEROS=========================================================================
            $zeroCheck = $checkHold->fetch_array();
            if($zeroCheck['queue'] == 0)
                $isZero = 0;
                
                
                
            $deleteHold = $con->query("DELETE FROM hold WHERE id = $id AND type = '$type' AND cardnumber = $cardnum");
            
            
            //for queue system it might be better to use date
            
            
            //update queue position----------------------------------------------------------
            
            //NEED TO MAKE IT WHERE IF QUEUE POSITION IS 0 IT SENDS IT OFF TO THE NEXT PERSON IN QUEUE WITH POS 1
            $updateQueue = $con->query("Select * from hold WHERE id = $id AND type = '$type' AND queue>0 ORDER BY queue ASC"); //NEEDS TO BE A SORTED QUEUE
            //$SecondQueue = $con->query("Select * from hold WHERE id = $id AND type = '$type' "); 
            if($isZero == 0){
                if($updateQueue->num_rows>0)
                {
                    $date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+7, date("Y")));
                    $newZero = $updateQueue->fetch_array();
                    $newcardnum = $newZero['cardnumber']; //new cardnumber with zeroth place
                    $updateHold = $con->query("UPDATE `hold` SET `queue` = 0, `end_date` = '$date_to_return' WHERE `hold`.`cardnumber` = $newcardnum");
                }
            }
            $updateQueue = $con->query("Select * from hold WHERE id = $id AND type = '$type' AND queue>0 ORDER BY queue ASC");
            $QueueReset = 1;
            //echo $updateQueue;
            if($updateQueue->num_rows>0)
            while($QData = $updateQueue->fetch_array()){
                $usernum = $QData['cardnumber'];
                $updateHold = $con->query("UPDATE `hold` SET `queue` = $QueueReset WHERE `hold`.`cardnumber` = $usernum");
                $QueueReset = $QueueReset + 1;
                
            }
            //use for loop to search through queue and reset the count maybe by using a query to sort the values then updating
            
            //if hold queue is less than item available then set to available
            $holdAmount = $con->query("Select * from hold WHERE id = $id AND type = '$type' AND queue<1");
            if($quantity>$holdAmount->num_rows)
                $updateStatus = $con->query("UPDATE `$type2` SET `status` = 'available' WHERE id = $id");
                
            $maxItems = $data['numitemscheckedout'] - 1;
            if($maxItems > -1) //cant subtract from 0
                $updateTable = $con->query("UPDATE `members` SET `numitemscheckedout` = $maxItems WHERE `members`.`cardnumber` = $data[cardnumber]");
                
            echo '<div class="alert alert-success"><em>Hold has been removed</em></div>';
            //echo "Hold has been removed";
            
            
        
        }
        else if ($checkBorrow->num_rows>0){ //return borrow
                //echo "return borrow";
                if ($sql->num_rows > 0)
                {
                    
                    //need to check if this person has already checked it out.
                    $cardnum = $data['cardnumber'];
                    //$IsCheckedOut = $con->query("Select * from borrow where cardnumber = $cardnum"); //check borrow to see if already checked out
             
                    //update borrow to place checked out item
                    $maxItems = $data['numitemscheckedout'] - 1;
                    if($maxItems > -1) //cant subtract from 0
                    {	
                        $updateTable = "UPDATE `members` SET `numitemscheckedout` = $maxItems WHERE `members`.`cardnumber` = $data[cardnumber]";
                        
                        
                        if($con->query($updateTable) == TRUE)
                        {
                            
                            //$copyQuery = $con->query("Select * from borrow");
                            //$copyamount = "NULL"; //THIS DOESN'T ALWAYS WORK NEED TO FIGURE OUT HOW TO DO IT WITH AUTO INCREMENT
                            $date = date('Y-m-d');
                            //$date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+14, date("Y")));
                            $borrowdata = $checkBorrow->fetch_array();
                            $borID = $borrowdata['borrow_id'];
                            $updateCopy = $con->query("UPDATE `borrow` SET `date_returned` = '$date' WHERE `borrow_id` = $borID");
                            //$deleteCopy = $con->query("DELETE FROM borrow WHERE id = $id AND type = '$type' AND cardnumber = $cardnum");
                            
                            
                            $IsFinePaid = $con->query("Select * from fines WHERE type = '$type' AND id = $id AND cardnumber = $cardnum AND paid = 0");
                            $paid = $IsFinePaid->fetch_array();
                            
                            
                            
                            if($paid['fine_amount']<=0)
                            {
                                
                                $updateFines = $con->query("Select * from fines where id = $id AND type = '$type' AND cardnumber = $cardnum AND paid = 0");
                                $finedata = $updateFines->fetch_array();
                                $fineID = $finedata['fine_id'];
                                $updateCopy = $con->query("UPDATE `fines` SET `paid` = 1 WHERE `fine_id` = $fineID");
                                //$deleteFine = $con->query("DELETE FROM fines WHERE id = $id AND type = '$type' AND cardnumber = $cardnum");
                                //echo "fines deleted";
                            }
                            else{
                                echo '<div class="alert alert-danger"><em>There are unpaid fines you must pay!</em></div>';
                                //echo "There are unpaid fines you must pay!<br>";
                            }
                            //$insertCopy = $con->query( "INSERT INTO `borrow` (`borrow_id`, `cardnumber`, `id`, `type`, `date_issued`, `date_due`, `date_returned`) VALUES (NULL, '$cardnum', '$id', '$type2', '$date', '$date_to_return', '0000-00-00')");
                            //$insertFines = $con->query("INSERT INTO `fines` (`fine_id`, `cardnumber`, `fine_amount`, `date_issued`, `paid`, `days_passed`, `id`, `type`) VALUES (NULL, '$cardnum', '0.0', '$date_to_return', '0', 0, '$id', '$type2')");

                            $itemQuery = $con->query("Select quantity from $type2 where id = $id");
                            $IQ = $itemQuery->fetch_array();
                            $NewQuantity = $IQ[0]+1;
                            
                            
          
                            
                            
                            
                            
                            //if queue then notify person
                            
                            
                            
                            
                            if($NewQuantity==1)
                            {
                                $updateStatus = $con->query("UPDATE `$type2` SET `status` = 'available' WHERE id = $id");
                            }
                            
                            
                            
                            //hold logic will go here for queues ---------------------------------------------also use this to set status to HOLD if lots of people holding item
                            
                            
                            $updateQueue = $con->query("Select * from hold WHERE id = $id AND type = '$type' AND queue>0 ORDER BY queue ASC"); //NEEDS TO BE A SORTED QUEUE
                            $QueueReset = 1;
                            //echo $updateQueue;
                            if($updateQueue->num_rows>=$NewQuantity){//if queue is larger than item quantity then set to hold
                            
                            
                            //$usernum = $QData['cardnumber'];
                            $QData = $updateQueue->fetch_array();
                            $usernum = $QData['cardnumber'];
                            
                            $date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+7, date("Y")));
                            $updateHold = $con->query("UPDATE `hold` SET `queue` = 0, `end_date` = '$date_to_return' WHERE `hold`.`cardnumber` = $usernum AND `hold`.`id` = $id AND `hold`.`type` = '$type'"); 
                            //from here set trigger to tell person their hold is ready for pickup
                            $con->query("UPDATE `hold` SET `queue` = queue - 1 WHERE id = $id AND type = '$type' AND queue>0");
                                
                                $updateQueue = $con->query("UPDATE `$type2` SET `status` = 'hold' WHERE id = $id");
                            }
                            
                            
                            
                            
                            //echo $NewQuantity;
                            $updateAmount = "UPDATE `$type2` SET `quantity` = $NewQuantity WHERE id = $id";
                            if($con->query($updateAmount) == TRUE)//insert borrow information into fine as well to make trigger work
                                echo '<div class="alert alert-success"><em>Return complete</em></div>';
                                //echo "Return complete";
                                
                                
                            
                            
                            
                        }
                        else
                            echo '<div class="alert alert-danger"><em>Return Error</em></div>';
                            //echo "Return Error";
                    }
                    else
                        echo '<div class="alert alert-danger"><em>Return failed. There is nothing to return.</em></div>';
                        //echo "Return failed. There is nothing to return.";
                
                    
                }
            
        }
        else
            echo '<div class="alert alert-danger"><em>Item already returned</em></div>';
            //echo "Item already returned";



	}
else
    echo "Must be logged in to do this action";



?>
<br>
<a href="return.php">Return Items</a>
</body>
</html>