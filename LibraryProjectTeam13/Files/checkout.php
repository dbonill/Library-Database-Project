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
        if($type =="media")
            $type2 = "media";

        $giveToHolder = 0;
        $data = $sql->fetch_array();
        $memberType = $data['usertype'];
        $cardnum = $data['cardnumber'];
        $checkHold = $con->query("Select * from hold where id = $id AND type = '$type2' AND cardnumber = $cardnum");
        $HoldAmount = $con->query("Select * from hold where id = $id AND type = '$type2'");
        if($HoldAmount->num_rows>0)
        {
            $giveToHolder = 1;
            //give to holder
        }

        if($giveToHolder>0){
            //echo "hold over 1";
            if($checkHold->num_rows>0)
            {
                $checkPos = $checkHold->fetch_array();
                if($checkPos['queue'] < 1){
                
                $date = date('Y-m-d');
                $date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+14, date("Y")));
    
                $insertCopy = $con->query( "INSERT INTO `borrow` (`borrow_id`, `cardnumber`, `id`, `type`, `date_issued`, `date_due`, `date_returned`) VALUES (NULL, '$cardnum', '$id', '$type2', '$date', '$date_to_return', '0000-00-00')");
                $insertFines = $con->query("INSERT INTO `fines` (`fine_id`, `cardnumber`, `fine_amount`, `date_issued`, `paid`, `days_passed`, `id`, `type`) VALUES (NULL, '$cardnum', '0.0', '$date_to_return', '0', 0, '$id', '$type2')");
                $deleteHold = $con->query("DELETE FROM hold WHERE id = $id AND type = '$type2' AND cardnumber = $cardnum");
                
                $itemQuery = $con->query("Select quantity from $type where id = $id");
                $holdQuery = $con->query("Select * FROM hold WHERE id = $id AND type = '$type2'"); ///////////////////////////TESTING HERE
                $IQ = $itemQuery->fetch_array();
                $NewQuantity = $IQ[0]-1;
                if($NewQuantity<1)
                {
                    $updateStatus = $con->query("UPDATE `$type` SET `status` = 'unavailable' WHERE id = $id");
                }
                else if($NewQuantity <= $holdQuery->num_rows) //check hold doesn't work its just for the one account
                    $updateStatus = $con->query("UPDATE `$type` SET `status` = 'hold' WHERE id = $id");
                else if($NewQuantity > $holdQuery->num_rows)
                    $updateStatus = $con->query("UPDATE `$type` SET `status` = 'available' WHERE id = $id");
                
                $updateAmount = "UPDATE `$type` SET `quantity` = $NewQuantity WHERE id = $id";
                if($con->query($updateAmount) == TRUE)//insert borrow information into fine as well to make trigger work
                    echo '<div class="alert alert-success"><em>Checkout complete<em></div>';
                    //echo "Checkout complete";
                    
                }
                else
                    echo '<div class="alert alert-danger"><em>Item is currently on hold</em></div>';
                    //echo "Item is currently on hold";
            }
            else
                echo '<div class="alert alert-danger"><em>Item is currently on hold</em></div>';
                //echo "Item is currently on hold";
            
            
            //give to holder
        }
        else{ //regular checkout
                
            
            if($quantity < 1) //checks quantity
                echo '<div class="alert alert-danger"><em>Failed to checkout. Item is currently unavailable.</em></div>';
                //echo "Failed to checkout. Item is currently unavailable.";
            else{
                if ($sql->num_rows > 0)
                {
                    //$data = $sql->fetch_array();
                    if($data['isallowedtorent'] == 1)
                    { //check if member is allowed to rent
                        //need to check if this person has already checked it out.
                        $cardnum = $data['cardnumber'];
                        $IsCheckedOut = $con->query("Select * from borrow where cardnumber = $cardnum"); //check borrow to see if already checked out
                        $bool = 0;
                        if ($IsCheckedOut->num_rows > 0)
                        {
                            //echo "c1";
                            while($items = $IsCheckedOut->fetch_array())
                                if($items['id'] == $id && $items['type'] == $type2 && $items['date_returned'] == '0000-00-00'){
                                    $bool = 1;
                            }
                        }
                        
                        if($bool == 1) //need double ==
                            echo '<div class="alert alert-danger"><em>Failed to checkout. You can only have one copy of an item at a time!</em></div>';
                            //echo "Failed to checkout. You can only have one copy of an item at a time!";
                        else
                        {
                            //update borrow to place checked out item
                            $maxItems = $data['numitemscheckedout'] + 1;
                            //get user type
                            $maxBorrow = 4;
                            if($memberType == "student")
                                $maxBorrow = 4;
                            if($memberType == "faculty")
                                $maxBorrow = 6;
                            if($maxItems < $maxBorrow) //max items for member has to be less than 6 to work
                            {	
                                $updateTable = "UPDATE `members` SET `numitemscheckedout` = $maxItems WHERE `members`.`cardnumber` = $data[cardnumber]";
                                
                                
                                if($con->query($updateTable) == TRUE)
                                {
                                    
                                    $copyQuery = $con->query("Select * from borrow");
                                    $copyamount = "NULL"; //THIS DOESN'T ALWAYS WORK NEED TO FIGURE OUT HOW TO DO IT WITH AUTO INCREMENT
                                    $date = date('Y-m-d');
                                    $date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+14, date("Y")));
                                    //SET IF STATEMENT TO CHECK IF MEMBER OR FACULTY=======================================================
                                    $initfines = 0.0;
                                    if($memberType == "student"){
                                        $date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+14, date("Y")));
                                        $initfines = 0.0;
                                    }
                                    if($memberType == "faculty"){
                                        $date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+20, date("Y")));
                                        $initfines = -3.0;
                                        
                                    }
                                    $insertCopy = $con->query( "INSERT INTO `borrow` (`borrow_id`, `cardnumber`, `id`, `type`, `date_issued`, `date_due`, `date_returned`) VALUES (NULL, '$cardnum', '$id', '$type2', '$date', '$date_to_return', '0000-00-00')");
                                    $insertFines = $con->query("INSERT INTO `fines` (`fine_id`, `cardnumber`, `fine_amount`, `date_issued`, `paid`, `days_passed`, `id`, `type`) VALUES (NULL, '$cardnum', '$initfines', '$date_to_return', '0', 0, '$id', '$type2')");
    
                                    $itemQuery = $con->query("Select quantity from $type where id = $id");
                                    $IQ = $itemQuery->fetch_array();
                                    $NewQuantity = $IQ[0]-1;
                                    if($NewQuantity<1)
                                    {
                                        $updateStatus = $con->query("UPDATE `$type` SET `status` = 'unavailable' WHERE id = $id");
                                    }
                                    //echo $NewQuantity;
                                    $updateAmount = "UPDATE `$type` SET `quantity` = $NewQuantity WHERE id = $id";
                                    if($con->query($updateAmount) == TRUE)//insert borrow information into fine as well to make trigger work
                                        echo '<div class="alert alert-success"><em>Checkout complete<em></div>';
                                        //echo "Checkout complete";
                                    
                                    
                                }
                                else
                                    echo '<div class="alert alert-danger"><em>Checkout Error</em></div>';
                                   // echo "Checkout Error";
                            }
                            else
                                 echo '<div class="alert alert-danger"><em>Checkout failed. This account has reached its max amount of items checked out.</em></div>';
                                //echo "Checkout failed. This account has reached its max amount of items checked out.";
                        }
                    }
                    else
                        echo '<div class="alert alert-danger"><em>Checkout failed. This account can not check out any items due to unpaid fines.</em></div>';
                        //echo 'Checkout failed. This account can not check out any items due to unpaid fines.';
                }
            }
        }   



	}
else
    echo '<div class="alert alert-danger"><em>Must be logged in to check out</em></div>';
    //echo "Must be logged in to check out";



?>
<br>
<a href="library.php">Continue Browsing</a>
</body>
</html>