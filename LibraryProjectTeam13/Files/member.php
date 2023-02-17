<?php
session_start();
include("connection.php");
$check = $_SESSION['username'];
//include("function.php");
//checkqueues();
//$Username = check_login($con);

//check and update queues where it reached max time;
$date = date('Y-m-d');
$holds = $con->query("SELECT * from hold where end_date > '0000-00-00' and end_date <= '$date'");
if($holds->num_rows>0){
    while($holddata = $holds->fetch_array()){
        $id = $holddata['id'];
        $type = $holddata['type'];
        $cardnumber = $holddata['cardnumber'];
        
        $type2 = "";
        if($type == "book")
            $type2 = "books";
        if($type=="device")
            $type2 = "devices";
        if($type=="journal")
            $type2 = "journals";
        if($type =="media")
            $type2 = "media";
        
        
        $con->query("UPDATE members SET numitemscheckedout = numitemscheckedout - 1 where cardnumber = $cardnumber");
        $con->query("DELETE FROM hold WHERE id = $id and type = '$type' and end_date > '0000-00-00' and end_date <= '$date'");
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
    
    
//update holds where items have been added
    
    
    
}








//mysqli_close($con);

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











<?php



//select hold list -> check item quantity for each hold -> if item quantity is greater than hold update list with while loop
//echo "hi";




//$sqlholdlist = $con->query("SELECT * from hold where queue > 0");
//if($sqlholdlist->num_rows>0){
    //echo $sqlholdlist->num_rows;
//    while($holddata = $sqlholdlist->fetch_array()){
//        $id = $holddata['id'];
//        $type = $holddata['type'];
        //echo $id;
        //echo $type;
//        $type2 = "";
//        if($type == "book")
//            $type2 = "books";
//        if($type=="device")
//            $type2 = "devices";
//        if($type=="journal")
//            $type2 = "journals";
//        if($type =="media")
//            $type2 = "media";
//        $checkitem = $con->query("select quantity from $type2 where id = $id");
//        echo $checkitem->num_rows;
//      if($checkitem->num_rows>0){
//           $quantity = $checkitem->fetch_array();
//            $q = $quantity['quantity'];
//            //echo $q;
//            if($q>0){ //subtract from queue till new amount of items are filled up                 if quantity refill then push up queue
 //               $specifichold = $con->query("select * from hold where type = '$type' and id = $id and queue > 0");
                //quantity - queue run that many times then sub 1 from queue each time
 //               echo $specifichold->num_rows;
//                //while
//                
//            }
//        }
            
            
            
//        echo $type2;
        
        //search quantity of item
        
//    }
    
//}











if(isset($check)){
      $sql = $con->query("Select * from members where username = '$check'");
       $userdata = $sql->fetch_array();
       $usertype = $userdata['usertype'];
       $cardnumber = $userdata['cardnumber'];
       
       
       //updates items to match how much people have checked out or on hold
       $sqlhold = $con->query("SELECT * from hold where cardnumber = $cardnumber");
       $sqlborrow = $con->query("SELECT * from borrow where cardnumber = $cardnumber AND date_returned = '0000-00-00'");
       $newquantity = $sqlhold->num_rows + $sqlborrow->num_rows;
       //echo $newquantity;
       $refreshcount = $con->query("UPDATE `members` SET `numitemscheckedout` = $newquantity where cardnumber = $cardnumber");
       
       
       
       $holdsavailable = $con->query("SELECT * from hold where end_date > '0000-00-00' AND queue = 0"); //check to see if anything is available
        //echo "hi";
        //echo $holdsavailable->num_rows;
        if($holdsavailable->num_rows>0){
            while($holdarray = $holdsavailable->fetch_array()){
                $id = $holdarray['id'];
                $type = $holdarray['type'];
                $cardnumber2 = $holdarray['cardnumber'];
                        
                $type2 = "";
                if($type == "book")
                    $type2 = "books";
                if($type=="device")
                    $type2 = "devices";
                if($type=="journal")
                    $type2 = "journals";
                if($type =="media")
                    $type2 = "media";
                
                if($cardnumber2==$cardnumber){
                    
                    $borrowtitle = $con->query("Select title from $type2 where id = $id");
                    $thetitle = $borrowtitle->fetch_array();
                    echo '<div class="alert alert-success"><em> '.$thetitle['title'].' is available for pickup</em></div>';
                    
                }
                
            }
        }
       
    echo '<div style="font-size:5em;color:black">Welcome to the library: '.$check.'! </div>';
        $sql = $con->query("Select * from fines where cardnumber = '$cardnumber' AND paid = 0 AND fine_amount > 0");
        
        if ($sql->num_rows > 0)
		{ echo '<div class="alert alert-danger" align=centre><em>"Due the Current fines the Account can not rent</em></div>';}
    
   
     ##echo <div class="paragraph'.$i.',style="font-size:1.25em;color:black">"Welcome to the library:\"$check\" !"</div>;<div style=font-size:1.25em">

}
?>



	<br>
	</ul>
		<li style="list-style-type:none"><a href="library.php">Browse Library</a></li>
		<li style="list-style-type:none"><a href="fines.php">Check Fines</a></li>
        <li style="list-style-type:none"><a href="return.php">Return Items</a></li>
        <li style="list-style-type:none"><a href="Areport.php">Account Report</a></li>
	</ul>
</body>
</html>