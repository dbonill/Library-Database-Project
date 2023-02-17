
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>display.php</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>

<?php
session_start();
if(isset($_SESSION['username'])){
?>

<body>
    

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


	<br>
	<form method="post" action="display.php">
		<input type="text" name="q" placeholder="Search Query...">
		<select name="column">
			<option value="">All</option>
			<option value="Book">Book</option>
			<option value="Media">Media</option>
			<option value="Journal">Journal</option>
			<option value="Device">Device</option>
		</select>
		<input type="submit" name="submit" value="Find">
	</form>
	
		
		

<?php
    require_once('connection.php');
?>

<?php
	if (isset($_POST['submit'])) {
		//$connection = new mysqli("localhost", "root", "", "phpSearch");
		$q = $con->real_escape_string($_POST['q']);
		$column = $con->real_escape_string($_POST['column']);

		if ($column == ""){
			$column = "Title";

		$sql = $con->query("Select id, title, 'Book', 'editB', 'deleteB'  from books WHERE $column LIKE '%$q%'
                union Select id, title, 'Media', 'editM', 'deleteM' from media WHERE $column LIKE '%$q%'
                union Select id, title, 'Journal', 'editJ', 'deleteJ'  from journals WHERE $column LIKE '%$q%'
                union Select id, title, 'Device', 'editD', 'deleteD' from devices WHERE $column LIKE '%$q%'");
		}
		if ($column == "Book"){
			$column = "Title";
			$sql = $con->query("Select id, title, 'Book', 'editB', 'deleteB'  from books WHERE $column LIKE '%$q%'");
		}
		if ($column == "Media"){
			$column = "Title";
			$sql = $con->query("Select id, title, 'Media', 'editM', 'deleteM' from media WHERE $column LIKE '%$q%'");
		}
		if ($column == "Journal"){
			$column = "Title";
			$sql = $con->query("Select id, title, 'Journal', 'editJ', 'deleteJ'  from journals WHERE $column LIKE '%$q%'");
		}
		if ($column == "Device"){
			$column = "Title";
			$sql = $con->query("Select id, title, 'Device', 'editD', 'deleteD' from devices WHERE $column LIKE '%$q%'");
		}
?>

	<table align="center" cellspacing="5" cellpadding="8" class="table table-bordered table-striped">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Type</th>
			<th>Action</th>
			
		</tr>
		
		<?php
		if (isset($_POST['submit'])) {		
    		if ($sql->num_rows > 0) {
    			while($data = $sql->fetch_array()) { ?>
    				<tr>
    					<td><?php echo $data['id']; ?></td>
    					<td><?php echo $data['title']; ?></td>
    					<td><?php echo $data[2]; ?></td>
    					<td>
    					<?php echo'
                            <a href="edit.php?'.$data[3].'='.$data['id'].'"class="btn btn-info"> Edit</a>
                            <a href="delete.php?'.$data[4].'='.$data['id'].'"class="btn btn-danger"> Delete</a>'
                        ?>
                        </td>
    				</tr>
		<?php 
			    
			    }
		    }
		    
		    else echo "Your search query doesn't match any data!";
	    }
	}
	?>
	</table>







<!-- books -->
<div class="col-md-12">

<?php
    //below displays the tables
    $query = "SELECT id, isbn, title, author, publisher, genre, date_published, status, quantity FROM books";

    $response = mysqli_query($con, $query);

    if($response){
        echo '
        <h2 class="pull-left">Books</h2>
        <table align="center" cellspacing="5" cellpadding="8" class="table table-bordered table-striped">
            <tr><td align="left"><b>id </b></td>
                <td align="left"><b>isbn</b></td>
                <td align="left"><b>title </b></td>
                <td align="left"><b>author </b></td>
                <td align="left"><b>publisher</b></td>
                <td align="left"><b>genre</b></td>
                <td align="left"><b>date_published</b></td>
                <td align="left"><b>status</b></td>
                <td align="left"><b>quantity</b></td>
                <td align="left"><b>action</b></td></tr>';

        while($row = mysqli_fetch_assoc($response)){

            echo '<tr>
            <td align="left">'.$row['id'].'</td>
            <td align="left">'.$row['isbn'].'</td>
            <td align="left">'.$row['title'].'</td>
            <td align="left">'.$row['author'].'</td>
            <td align="left">'.$row['publisher'].'</td>
            <td align="left">'.$row['genre'].'</td>
            <td align="left">'.$row['date_published'].'</td>
            <td align="left">'.$row['status'].'</td>
            <td align="left">'.$row['quantity'].'</td>
            <td>
            <a href="edit.php?editB='.$row['id'].'"class="btn btn-info"> Edit</a>
            <a href="delete.php?deleteB='.$row['id'].'"class="btn btn-danger">Delete</a>'//hmmmmmmmmmmmmmm
            .'</td>
            </tr>';

        }
        
        echo '</table>';
        
        $sql="SELECT count(*) as total from books";
        $result=mysqli_query($con,$sql);
        $data=mysqli_fetch_assoc($result);
        echo "Total: " .$data['total']. "<br><br>";
        
        
        
    }else{

        echo "Couldn't issue databse query";

        echo mysqli_error($con);

    }
?>
</div>



<!-- media -->
<div class="col-md-12">

<?php
    $query = "SELECT id, identification, title, director, genre, date_published, status, quantity FROM media";

    $response = mysqli_query($con, $query);

    if($response){
        echo '
        <h2 class="pull-left">Media</h2>
        <table align="center" cellspacing="5" cellpadding="8" class="table table-bordered table-striped">
            <tr><td align="left"><b>id </b></td>
                <td align="left"><b>identification</b></td>
                <td align="left"><b>title </b></td>
                <td align="left"><b>director </b></td>
                <td align="left"><b>genre</b></td>
                <td align="left"><b>date_published</b></td>
                <td align="left"><b>status</b></td>
                <td align="left"><b>quantity</b></td>
                <td align="left"><b>action</b></td></tr>';

        while($row = mysqli_fetch_assoc($response)){

            echo '<tr>
            <td align="left">'.$row['id'].'</td>
            <td align="left">'.$row['identification'].'</td>
            <td align="left">'.$row['title'].'</td>
            <td align="left">'.$row['director'].'</td>
            <td align="left">'.$row['genre'].'</td>
            <td align="left">'.$row['date_published'].'</td>
            <td align="left">'.$row['status'].'</td>
            <td align="left">'.$row['quantity'].'</td>
            <td>
            <a href="edit.php?editM='.$row['id'].'"class="btn btn-info"> Edit</a>
            <a href="delete.php?deleteM='.$row['id'].'"class="btn btn-danger">Delete</a>
            </td>
            </tr>';

        }
        
        echo '</table>';
        
        $sql="SELECT count(*) as total from media";
        $result=mysqli_query($con,$sql);
        $data=mysqli_fetch_assoc($result);
        echo "Total: " .$data['total']. "<br><br>";
        
    }else{

        echo "Couldn't issue databse query";
        echo mysqli_error($con);

    }

?>
</div>



<!-- devices -->
<div class="col-md-12">

<?php
    $query = "SELECT id, model_no, title, brand, date_published, status, quantity FROM devices";

    $response = mysqli_query($con, $query);

    if($response){
        echo '
        <h2 class="pull-left">Devices</h2>
        <table align="center" cellspacing="5" cellpadding="8" class="table table-bordered table-striped">
            <tr><td align="left"><b>id</b></td>
                <td align="left"><b>model_no</b></td>
                <td align="left"><b>title</b></td>
                <td align="left"><b>brand</b></td>
                <td align="left"><b>date_published</b></td>
                <td align="left"><b>status</b></td>
                <td align="left"><b>quantity</b></td>
                <td align="left"><b>action</b></td></tr>';

        while($row = mysqli_fetch_assoc($response)){

            echo '<tr>
            <td align="left">'.$row['id'].'</td>
            <td align="left">'.$row['model_no'].'</td>
            <td align="left">'.$row['title'].'</td>
            <td align="left">'.$row['brand'].'</td>
            <td align="left">'.$row['date_published'].'</td>
            <td align="left">'.$row['status'].'</td>
            <td align="left">'.$row['quantity'].'</td>
            <td>
            <a href="edit.php?editD='.$row['id'].'"class="btn btn-info"> Edit</a>
            <a href="delete.php?deleteD='.$row['id'].'"class="btn btn-danger">Delete</a>
            </td>
            </tr>';

        }
        
        echo '</table>';
        
        $sql="SELECT count(*) as total from devices";
        $result=mysqli_query($con,$sql);
        $data=mysqli_fetch_assoc($result);
        echo "Total: " .$data['total']. "<br><br>";
        
    }else{

        echo "Couldn't issue databse query";
        echo mysqli_error($con);

    }

?>
</div>



<!-- journals -->
<div class="col-md-12">

<?php
    $query = "SELECT id, journal_id, title, author, publisher, date_published, status, quantity FROM journals";

    $response = mysqli_query($con, $query);

    if($response){
        echo '
        <h2 class="pull-left">Journals</h2>
        <table align="center" cellspacing="5" cellpadding="8" class="table table-bordered table-striped">
            <tr><td align="left"><b>id</b></td>
                <td align="left"><b>journal_id</b></td>
                <td align="left"><b>title</b></td>
                <td align="left"><b>author</b></td>
                <td align="left"><b>publisher</b></td>
                <td align="left"><b>date_published</b></td>
                <td align="left"><b>status</b></td>
                <td align="left"><b>quantity</b></td>
                <td align="left"><b>action</b></td></tr>';

        while($row = mysqli_fetch_assoc($response)){

            echo '<tr>
            <td align="left">'.$row['id'].'</td>
            <td align="left">'.$row['journal_id'].'</td>
            <td align="left">'.$row['title'].'</td>
            <td align="left">'.$row['author'].'</td>
            <td align="left">'.$row['publisher'].'</td>
            <td align="left">'.$row['date_published'].'</td>
            <td align="left">'.$row['status'].'</td>
            <td align="left">'.$row['quantity'].'</td>
            <td>
            <a href="edit.php?editJ='.$row['id'].'"class="btn btn-info"> Edit</a>
            <a href="delete.php?deleteJ='.$row['id'].'"class="btn btn-danger">Delete</a>
            </td>
            </tr>';

        }
        
        echo '</table>';
        
        $sql="SELECT count(*) as total from journals";
        $result=mysqli_query($con,$sql);
        $data=mysqli_fetch_assoc($result);
        echo "Total: " .$data['total']. "<br><br>";
        
    }else{

        echo "Couldn't issue databse query";
        echo mysqli_error($con);

    }


    mysqli_close($con);

?>
</div>

</div> <!-- for the nav -->

</body>
</html>

<?php
}else{
echo '<div class="alert alert-danger" align=centre><em>Must be logged in</em></div>';
}
?>
