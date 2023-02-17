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
       $sql = $con->query("Select * from members where username = '$check'");
       $userdata = $sql->fetch_array();
       $usertype = $userdata['usertype'];
       $cardnumber = $userdata['cardnumber'];



?>



    <h1  class="d-flex justify-content-center">Fines</h1>
    <?php
        //$sql = $con->query("Select id, title, 'Book' from books WHERE $column LIKE '%$q%'")
        
        
        $sql = $con->query("Select * from fines where cardnumber = '$cardnumber' AND paid = 0 AND fine_amount > 0");
        
        if ($sql->num_rows > 0)
		{
		    $boolreturn = 0;
		while($data = $sql->fetch_array()) { 
		    ?>	

			<table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
				<tr>
					<th>Fine ID</th>
					<th>Cardnumber</th>
					<th>Fine Amount</th>
					<th>Date Issued</th>
				</tr>
				<tr>
					<td><?php echo $data[0]; ?></td>
					<td><?php echo $data[1]; ?></td>
					<td>$<?php echo $data[2]; ?></td>
					<td><?php echo $data[3]; ?></td>
			
				</tr>
			</table>
		
		
		<?php }
		    
		    
    		$borrowsql = $con->query("Select * from borrow where cardnumber = '$cardnumber' and date_returned = '0000-00-00'");
			if($borrowsql->num_rows>0)
			    $boolreturn = 1;
		  	
			$sql="SELECT sum(fine_amount) as total from fines where cardnumber=$cardnumber and paid=0";
			//$finesql->query()
            $result=mysqli_query($con,$sql);
            $newdata=mysqli_fetch_assoc($result);
            
            
            
         
            
            
            
            
            
            
            if($boolreturn==0){
            
		    ?>
			
			<a href="pay.php?pay=<?php echo $cardnumber ?>"class="btn btn-success"> Pay <?php echo "$".$newdata['total'] ?></a>  
			<?php }
			else
			    echo '<div class="alert alert-danger" align=centre><em>Can not pay fines until items are returned</em></div>';
		    
		}
		else{
		   
		    echo '<div class="alert alert-danger" align=centre><em>You do not have any unpaid fines at the moment</em></div>';
		      
    }
}
else
    echo "You must be logged in to pay fines";
    ?>
</body>
</html>