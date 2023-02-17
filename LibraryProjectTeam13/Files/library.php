<?php
//session_start();
include('connection.php')
//include("functions.php");
//$Username = check_login($conn);
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

	<h1>Library Database</h1>

	<br>
	<form method="post" action="library.php">
		<input type="text" name="q" placeholder="Search Library...">
		<select name="column">
			<option value="">All</option>
			<option value="Book">Book</option>
			<option value="Media">Media</option>
			<option value="Journal">Journal</option>
			<option value="Device">Device</option>
		</select>
		<input type="submit" name="submit" class="btn btn-primary" value="Find">
	</form>
	
		
		

<?php
	if (isset($_POST['submit'])) {
		//$connection = new mysqli("localhost", "root", "", "phpSearch");
		$q = $con->real_escape_string($_POST['q']);
		$column = $con->real_escape_string($_POST['column']);

		if ($column == ""){
			$column = "Title";

		$sql = $con->query("Select id, title, 'Book', status, quantity from books  WHERE $column LIKE '%$q%'
                union Select id, title, 'Media', status, quantity from media WHERE $column LIKE '%$q%'
                union select id, title, 'Journal', status, quantity from journals WHERE $column LIKE '%$q%'
                union select id, title, 'Device', status, quantity from devices WHERE $column LIKE '%$q%'");
		}
		if ($column == "Book"){
			$column = "Title";
			$sql = $con->query("Select id, title, 'Book', status, quantity from books WHERE $column LIKE '%$q%'");
		}
		if ($column == "Media"){
			$column = "Title";
			$sql = $con->query("Select id, title, 'Media', status, quantity from media WHERE $column LIKE '%$q%'");
		}
		if ($column == "Journal"){
			$column = "Title";
			$sql = $con->query("Select id, title, 'Journal', status, quantity from journals WHERE $column LIKE '%$q%'");
		}
		if ($column == "Device"){
			$column = "Title";
			$sql = $con->query("Select id, title, 'Device', status, quantity from devices WHERE $column LIKE '%$q%'");
		}
		//if ($sql->num_rows > 0) {
			//while ($data = $sql->fetch_array())
				//echo $data['ItemID']. " ". $data['Title']."<br>";
				
		//} else
			//echo "Your search query doesn't match any data!";
	}
	//mysqli_close($conn);
?>


	<table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Type</th>
			<th>Status</th>
			<th>Quantity</th>
			<th>More Information</th>
		</tr>
		
		<?php //class="table table-bordered table-thead-light" FOR TABLE ABOVE
		if (isset($_POST['submit']))		
		if ($sql->num_rows > 0)
		{
			while($data = $sql->fetch_array()) { ?>
				<tr>
					<td><?php echo $data['id']; ?></td>
					<td><?php echo $data['title']; ?></td>
					<td><?php echo $data[2]; ?></td>
					<td><?php echo $data[3]; ?></td>
					<td><?php echo $data[4]; ?></td>
					<td><a href="information.php?id=<?php echo $data['id']; ?>&amp;type=<?php echo $data[2]; ?>">Info</a></td>
				</tr>
		
		<?php }}
		else echo '<div class="alert alert-danger"><em>Your search does not match any data!</em></div>';?>
	</table>
	
	
</body>
</html>