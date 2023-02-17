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






             <h1  class="d-flex justify-content-center">Return Items</h1>



<?php 

session_start();
include("connection.php");
$check = $_SESSION['username'];

if(isset($_SESSION['username'])){
		$check = $_SESSION['username'];
        $sql = $con->query("Select * from members where username = '$check'");
        $memberarray = $sql->fetch_array();
        $cardnum = $memberarray['cardnumber'];
        $sql = $con->query("Select * from borrow where cardnumber = '$cardnum' and date_returned = '0000-00-00'");
        $holdsql = $con->query("Select * from hold where cardnumber = '$cardnum'");


        echo "<h1  class='d-flex justify-content-center'>Borrowed</h1>";
        if ($sql->num_rows > 0)
                {
                    while($data = $sql->fetch_array()) {
                        //echo $data[0];
                        //echo "checkpoint";
                        $type2 = "";
                        if($data['type'] == "book"){
                            $type2 = "books";}
                        else if($data['type']=="device"){
                            $type2 = "devices";}
                        else if($data['type']=="journal"){
                            $type2 = "journals";}
                        else if($data['type'=="media"]){
                            $type2 = "media";}
                        $itemid = $data['id'];
                        //echo $itemid;
                        $fetchTitle = $con->query("Select title, quantity from $type2 where id = $itemid");
                        $itemTitle = $fetchTitle->fetch_array();
                        //echo $type2;
                        ?>
                    

                    <table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
                        <tr>
                            <th>BorrowID</th>
                            <th>Title</th>
                            <th>ItemID</th>
                            <th>Type</th>
                            <th>Date Issued</th>
                            <th>Date Due</th>
                            <th></th>
                            
                            
                        </tr>
                        <tr>
                            <td><?php echo $data[0]; ?></td>
                            <td><?php echo $itemTitle[0]; ?></td>
                            <td><?php echo $data[2]; ?></td>
                            <td><?php echo $data[3]; ?></td>
                            <td><?php echo $data[4]; ?></td>
                            <td><?php echo $data[5]; ?></td>
                            <td><a href="returnitem.php?id=<?php echo $data['id']; ?>&amp;type=<?php echo $data['type']; ?>&quantity=<?php echo $itemTitle['quantity']; ?>">Return</a></td>
                            
                        </tr>
                    </table>
                
                <?php 
                    }
                } 
                else
                {
                    echo '<div class="alert alert-danger"><em>No items borrowed</em></div>';
                }
                
                
                
                
                
                
                
                
                
                
                echo "<h1 class='d-flex justify-content-center'>On Hold</h1>";
                //$holdsql = $con->query();
                if ($holdsql->num_rows > 0)
                {
                    //echo "item here";
                    while($data = $holdsql->fetch_array()) {
                        //echo $data[0];
                        //echo "checkpoint";
                        $type2 = "";
                        if($data['type'] == "book"){
                            $type2 = "books";
                        }
                        else if($data['type']=="device"){
                            $type2 = "devices";
                            
                        }
                        else if($data['type']=="journal"){
                            $type2 = "journals";
                        
                        }
                        else if($data['type'=="media"]){
                            $type2 = "media";
                        }
                        $itemid = $data['id'];
                        //echo $itemid;
                        $fetchTitle = $con->query("Select title, quantity from $type2 where id = $itemid");
                        $itemTitle = $fetchTitle->fetch_array();
                        //echo $type2;
                        ?>
                    

                    <table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
                        <tr>
                            <th>HoldID</th>
                            <th>Title</th>
                            <th>ItemID</th>
                            <th>Type</th>
                            <th>Date Issued</th>
                            <th>Hold Cut Off</th>
                            <th>Queue Position</th>
                            <th></th>
                            
                            
                        </tr>
                        <tr>
                            <td><?php echo $data[0]; ?></td>
                            <td><?php echo $itemTitle[0]; ?></td>
                            <td><?php echo $data[2]; ?></td>
                            <td><?php echo $data[3]; ?></td>
                            <td><?php echo $data[5]; ?></td>
                            <td><?php echo $data[6]; ?></td>
                            <td><?php echo $data['queue'] ?></td>
                            <td><a href="returnitem.php?id=<?php echo $data['id']; ?>&amp;type=<?php echo $data['type']; ?>&quantity=<?php echo $itemTitle['quantity']; ?>">Remove Hold</a></td>
                            
                        </tr>
                    </table>
                
                <?php 
                    }
                }
                else
                {
                    echo '<div class="alert alert-danger"><em>No items on hold</em></div>';
                }







	}
else{
echo '<div class="alert alert-danger" align=centre><em>"Must be logged in to receive Account Report</em></div>';
}
?>










<br>
</body>
</html>