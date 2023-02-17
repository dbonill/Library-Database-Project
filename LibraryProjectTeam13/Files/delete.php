<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    
<?php
    require_once('connection.php');

    if(isset($_GET['deleteB'])){ // we are getting id that was sent from display with edit button
        $id = $_GET['deleteB']; //get id
        $query = "DELETE FROM books WHERE id=$id";
        
        $cascade1 = $con->query("DELETE FROM borrow WHERE id=$id AND type='book'");
        $cascade2 = $con->query("DELETE FROM hold WHERE id=$id AND type='book'");
        $cascade3 = $con->query("DELETE FROM fines WHERE id=$id AND type='book' AND paid = 0");
        
        mysqli_query($con, $query);
        header("Location: display.php");
    }

    if(isset($_GET['deleteM'])){ // we are getting id that was sent from display with edit button
        $id = $_GET['deleteM']; //get id
        $query = "DELETE FROM media WHERE id=$id";
        
        $cascade1 = $con->query("DELETE FROM borrow WHERE id=$id AND type='media'");
        $cascade2 = $con->query("DELETE FROM hold WHERE id=$id AND type='media'");
        $cascade3 = $con->query("DELETE FROM fines WHERE id=$id AND type='media' AND paid = 0");
        
        
        mysqli_query($con, $query);
        header("Location: display.php");
    }

    if(isset($_GET['deleteD'])){ // we are getting id that was sent from display with edit button
        $id = $_GET['deleteD']; //get id
        $query = "DELETE FROM devices WHERE id=$id";
        
        $cascade1 = $con->query("DELETE FROM borrow WHERE id=$id AND type='device'");
        $cascade2 = $con->query("DELETE FROM hold WHERE id=$id AND type='device'");
        $cascade3 = $con->query("DELETE FROM fines WHERE id=$id AND type='device' AND paid = 0");
        
        
        mysqli_query($con, $query);
        header("Location: display.php");
    }

    if(isset($_GET['deleteJ'])){ // we are getting id that was sent from display with edit button
        $id = $_GET['deleteJ']; //get id
        $query = "DELETE FROM journals WHERE id=$id";
        
        $cascade1 = $con->query("DELETE FROM borrow WHERE id=$id AND type='journal'");
        $cascade2 = $con->query("DELETE FROM hold WHERE id=$id AND type='journal'");
        $cascade3 = $con->query("DELETE FROM fines WHERE id=$id AND type='journal' AND paid = 0");
        
        mysqli_query($con, $query);
        header("Location: display.php");
    }
    
    if(isset($_GET['deleteE'])){ // we are getting id that was sent from display with edit button
        $ssn = $_GET['deleteE']; //get id
        $query = "DELETE FROM employees WHERE ssn=$ssn";
        mysqli_query($con, $query);
        header("Location: employees.php");
    }
    
    if(isset($_GET['deleteMem'])){ // we are getting id that was sent from display with edit button
        $cardnumber = $_GET['deleteMem']; //get id
        $query = "DELETE FROM members WHERE cardnumber=$cardnumber";
        
        
        $cascade1 = $con->query("DELETE FROM borrow WHERE cardnumber = $cardnumber");   //MADE A LOT OF CHANGES HERE
        
        
        //need to update hold queue if he has a hold
        $checkhold = $con->query("SELECT * from hold WHERE cardnumber = $cardnumber");
        if($checkhold->num_rows>0){
            while($holddata = $checkhold->fetch_array()){
                $id = $holddata['id'];
                $type = $holddata['type'];
                
                 $type2 = "";
                if($type == "book")
                    $type2 = "books";
                if($type=="device")
                    $type2 = "devices";
                if($type=="journal")
                    $type2 = "journals";
                if($type =="media")
                    $type2 = "media";
                
                if($holddata['queue'] == 0){ //if his hold position is 0
                    
                    
                    $con->query("DELETE FROM hold WHERE id = $id and type = '$type' and cardnumber = $cardnumber");
                    $con->query("UPDATE hold SET queue = queue - 1 where id = $id and type = '$type' and queue>0");
                    $date_to_return = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")+7, date("Y")));
                    $con->query("UPDATE hold SET end_date = '$date_to_return' where id = $id and type = '$type' and end_date = '0000-00-00' and queue = 0");
                    $updateStatus = $con->query("SELECT * from `$type2` where id = $id");
                    $holding = $con->query("SELECT * from hold where id = $id and type = '$type'");
                    //echo $updateStatus->num_rows;
                    $statusData = $updateStatus->fetch_array();
                    
                    if($statusData['quantity']>$holding->num_rows){
                        $con->query("UPDATE `$type2` SET `status` = 'available' where `id` = $id");
                    }
                    else{
                        $con->query("UPDATE `$type2` SET `status` = 'hold' where `id` = $id");
                    }
                    if($statusData['quantity']==0)
                        $con->query("UPDATE `$type2` SET `status` = 'unavailable' where `id` = $id");
                }
                else if($holddata['queue'] > 0){ //if his hold position is greater than 0
                    $con->query("DELETE FROM hold WHERE id = $id and type = '$type' and cardnumber = $cardnumber");
                    $updateQueue = $con->query("Select * from hold WHERE id = $id AND type = '$type' AND queue>0 ORDER BY queue ASC");
                    $QueueReset = 1;
                    //echo $updateQueue;
                    if($updateQueue->num_rows>0)
                    while($QData = $updateQueue->fetch_array()){
                        $usernum = $QData['cardnumber'];
                        $updateHold = $con->query("UPDATE `hold` SET `queue` = $QueueReset WHERE `hold`.`cardnumber` = $usernum");
                        $QueueReset = $QueueReset + 1;
                        
                    }
                }
            }
        }
        //$cascade2 = $con->query("DELETE FROM hold WHERE cardnumber = $cardnumber");
        
        $cascade3 = $con->query("DELETE FROM fines WHERE cardnumber = $cardnumber");
        
        
        
        mysqli_query($con, $query);
        header("Location: search_user.php");
    }

?>

</div>
</body>
</html>