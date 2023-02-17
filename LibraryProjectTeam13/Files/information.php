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



<br>
<?php     include('connection.php')              ?>
<?php

$quantity = 0;
$type = "";
$id = $_GET['id'];

if (isset ( $_GET ['id'] ) && isset($_GET['type'])) {
	
	if($_GET['type'] == 'Book')
	{
    $type = "books";
	$sql = mysqli_query ( $con, 'select * from books where id=' . $_GET ['id'] );
	if ($sql->num_rows > 0)
		{
			while($data = $sql->fetch_array()) { ?>
			

			<table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
				<tr>
					<th>ItemID</th>
					<th>ISBN</th>
					<th>Title</th>
					<th>Author</th>
					<th>Publisher</th>
					<th>Genre</th>
					<th>Date Published</th>
					<th>Status</th>
					<th>Quantity</th>
				</tr>
				<tr>
					<td><?php echo $data[0]; ?></td>
					<td><?php echo $data[1]; ?></td>
					<td><?php echo $data[2]; ?></td>
					<td><?php echo $data[3]; ?></td>
					<td><?php echo $data[4]; ?></td>
					<td><?php echo $data[5]; ?></td>
					<td><?php echo $data[6]; ?></td>
					<td><?php echo $data[7]; ?></td>
					<td><?php echo $data[8]; $quantity = $data[8]; ?></td>
				</tr>
			</table>
		
		<?php }}
	}
	
	if($_GET['type'] == 'Media')
		{
        $type = "media";
		$sql = mysqli_query ( $con, 'select * from media where id=' . $_GET ['id'] );
		if ($sql->num_rows > 0)
			{
				while($data = $sql->fetch_array()) { ?>
				

				<table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
					<tr>
						<th>ItemID</th>
						<th>Identification</th>
						<th>Title</th>
						<th>Director</th>
						<th>Genre</th>
						<th>Date Published</th>
						<th>Status</th>
						<th>Quantity</th>
					</tr>
					<tr>
						<td><?php echo $data[0]; ?></td>
						<td><?php echo $data[1]; ?></td>
						<td><?php echo $data[2]; ?></td>
						<td><?php echo $data[3]; ?></td>
						<td><?php echo $data[4]; ?></td>
						<td><?php echo $data[5]; ?></td>
						<td><?php echo $data[6]; ?></td>
						<td><?php echo $data[7]; $quantity = $data[7]; ?></td>
					</tr>
				</table>
			
			<?php }}
		}
		
	if($_GET['type'] == 'Device')
			{
            $type = "devices";
			$sql = mysqli_query ( $con, 'select * from devices where id=' . $_GET ['id'] );
			if ($sql->num_rows > 0)
				{
					while($data = $sql->fetch_array()) { ?>
					

					<table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
						<tr>
							<th>ItemID</th>
							<th>Model Number</th>
							<th>Title</th>
							<th>Brand</th>
                            <th>Date Released</th>
							<th>Status</th>
							<th>Quantity</th>
						</tr>
						<tr>
							<td><?php echo $data[0]; ?></td>
							<td><?php echo $data[1]; ?></td>
							<td><?php echo $data[2]; ?></td>
							<td><?php echo $data[3]; ?></td>
							<td><?php echo $data[4]; ?></td>
							<td><?php echo $data[5]; ?></td>
                            <td><?php echo $data[6]; $quantity = $data[6]; ?></td>
						</tr>
					</table>
				
				<?php }}
			}
			
	if($_GET['type'] == 'Journal')
				{
                $type = "journals";
				$sql = mysqli_query ( $con, 'select * from journals where id=' . $_GET ['id'] );
				if ($sql->num_rows > 0)
					{
						while($data = $sql->fetch_array()) { ?>
						

						<table cellpadding="2" cellspacing="2" border="1" class="table table-bordered table-striped">
							<tr>
								<th>ItemID</th>
								<th>JournalID</th>
								<th>Title</th>
								<th>Author</th>
								<th>Publisher</th>
								<th>Date Published</th>
								<th>Status</th>
								<th>Quantity</th>
							</tr>
							<tr>
								<td><?php echo $data[0]; ?></td>
								<td><?php echo $data[1]; ?></td>
								<td><?php echo $data[2]; ?></td>
								<td><?php echo $data[3]; ?></td>
								<td><?php echo $data[4]; ?></td>
								<td><?php echo $data[5]; ?></td>
								<td><?php echo $data[6]; ?></td>
								<td><?php echo $data[7]; $quantity = $data[7]; ?></td>
							</tr>
						</table>
					
					<?php }}
				}

	
}


?>
<a href="checkout.php?id=<?php echo $id; ?>&amp;type=<?php echo $type; ?>&quantity=<?php echo $quantity; ?>">Check out</a> <br>
<a href="hold.php?id=<?php echo $id; ?>&amp;type=<?php echo $type; ?>&quantity=<?php echo $quantity; ?>">Hold</a> <br>
<a href="library.php">Continue Browsing</a>


</body>
</html>