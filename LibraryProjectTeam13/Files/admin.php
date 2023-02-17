<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin.php</title>

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
        
<!-- BOOK -->
        <div class="row">
            <div class="col border bg-light">
            <form action="adders/addbook.php" method="post">
                <b> Add a new book</b>

                <p> isbn:
                <input type="text" name="isbn" size="30" value="">
                </P>

                <p> title:
                <input type="text" name="title" size="30" value="">
                </P>

                <p> author:
                <input type="text" name="author" size="30" value="">
                </P>
                
                <p> publisher:
                <input type="text" name="publisher" size="30" value="">
                </P>

                <p> genre:
                <input type="text" name="genre" size="30" value="">
                </P>
                
                <p> date_published:
                <input type="date" name="date_published" size="30" value="">
                </P>

                <p> status:
                <input type="text" name="status" size="30" value="">
                </P>

                <p> quantity:
                <input type="text" name="quantity" size="30" value="">
                </P>

                <p>
                    <input type="submit" name="booksubmit" value="Add Book" class="btn btn-primary">
                </P>

            </form>
            </div>

<!-- MEDIA -->
            <div class="col border">
            <form action="adders/addmedia.php" method="post">
                <b> Add media</b>

                <p> identification:
                <input type="text" name="identification" size="30" value="">
                </P>

                <p> title:
                <input type="text" name="title" size="30" value="">
                </P>

                <p> director:
                <input type="text" name="director" size="30" value="">
                </P>

                <p> genre:
                <input type="text" name="genre" size="30" value="">
                </P>
                
                <p> date_published:
                <input type="date" name="date_published" size="30" value="">
                </P>

                <p> status:
                <input type="text" name="status" size="30" value="">
                </P>

                <p> quantity:
                <input type="text" name="quantity" size="30" value="">
                </P>

                <p>
                    <input type="submit" name="mediasubmit" value="Add Media" class="btn btn-primary">
                </P>

            </form>
            </div>
        </div>

<!-- DEVICE -->
        <div class="row">
            <div class="col border">
            <form action="adders/adddevice.php" method="post">
                <b> Add a new device</b>

                <p> model_no:
                <input type="text" name="model_no" size="30" value="">
                </P>
                
                <p> title:
                <input type="text" name="title" size="30" value="">
                </P>

                <p> brand:
                <input type="text" name="brand" size="30" value="">
                </P>

                <p> date_published:
                <input type="date" name="date_published" size="30" value="">
                </P>

                <p> status:
                <input type="text" name="status" size="30" value="">
                </P>

                <p> quantity:
                <input type="text" name="quantity" size="30" value="">
                </P>

                <p>
                    <input type="submit" name="devicesubmit" value="Add Device" class="btn btn-primary">
                </P>

            </form>
            </div>

<!-- Journal -->
            <div class="col border bg-light">
            <form action="adders/addjournal.php" method="post">
                <b> Add a new journal</b>


                <p> journal ID:
                <input type="text" name="journal_id" size="30" value="">
                </P>

                <p> title:
                <input type="text" name="title" size="30" value="">
                </P>

                <p> author:
                <input type="text" name="author" size="30" value="">
                </P>
                
                <p> publisher:
                <input type="text" name="publisher" size="30" value="">
                </P>
                
                <p> date_published:
                <input type="date" name="date_published" size="30" value="">
                </P>

                <p> status:
                <input type="text" name="status" size="30" value="">
                </P>

                <p> quantity:
                <input type="text" name="quantity" size="30" value="">
                </P>

                <p>
                    <input type="submit" name="journalsubmit" value="Add Journal" class="btn btn-primary">
                </P>

            </form>
            </div>


        </div>

    </div>
</body>
</html>

<?php
}else{
echo '<div class="alert alert-danger" align=centre><em>Must be logged in</em></div>';
echo '<a class="btn btn-success" href="index.php"> Login</a>';
}
?>


