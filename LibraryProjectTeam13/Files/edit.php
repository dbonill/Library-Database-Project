<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
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

    <?php
    require_once('connection.php');

    //BOOKS

    if(isset($_GET['editB'])){ // we are getting id that was sent from display with edit button
        $id = $_GET['editB']; //get id
        $query = "SELECT * FROM books WHERE id=$id";
        $response = mysqli_query($con, $query);
        if(@count($response)==1){ //check if its only one row, remember @ gets rid of warnings and stuff(basically do not check)
            $row = mysqli_fetch_assoc($response);
        }
    
    ?>

    <b> Edit a book</b>
    <form action="adders/addbook.php" method="post">

        <input type="hidden" id="id" name="id" value="<?php echo $row['id']?>"><br>

        <label for="isbn">isbn:</label>
        <input type="text" id="isbn" name="isbn" value="<?php echo $row['isbn']?>"><br>

        <label for="title">title:</label>
        <input type="text" id="title" name="title" value="<?php echo $row['title']?>"><br>

        <label for="author">author:</label>
        <input type="text" id="author" name="author" value="<?php echo $row['author']?>"><br>

        <label for="publisher">publisher:</label>
        <input type="text" id="publisher" name="publisher" value="<?php echo $row['publisher']?>"><br>
        
        <label for="genre">genre:</label>
        <input type="text" id="genre" name="genre" value="<?php echo $row['genre']?>"><br>

        <label for="date_published">date_published:</label>
        <input type="date" id="date_published" name="date_published" value="<?php echo $row['date_published']?>"><br>

        <label for="status">status:</label>
        <input type="text" id="status" name="status" value="<?php echo $row['status']?>"><br>
        
        <label for="quantity">quantity:</label>
        <input type="text" id="quantity" name="quantity" value="<?php echo $row['quantity']?>"><br>

        <input type="submit" name="editB" value="Edit" class="btn btn-primary"><br>
    </form>
    <?php } ?>

    <?php

    //MEDIA

    if(isset($_GET['editM'])){ // we are getting id that was sent from display with edit button
        $id = $_GET['editM']; //get id
        $query = "SELECT * FROM media WHERE id=$id";
        $response = mysqli_query($con, $query);
        if(@count($response)==1){ //check if its only one row, remember @ gets rid of warnings and stuff(basically do not check)
            $row = mysqli_fetch_assoc($response);
        }
    
    ?>


    <b> Edit a Media Item</b>
    <form action="adders/addmedia.php" method="post">

        <input type="hidden" name="id" value="<?php echo $row['id']?>"><br>

        <label for="identification">identification:</label>
        <input type="text" name="identification" value="<?php echo $row['identification']?>"><br>

        <label for="title">title:</label>
        <input type="text" name="title" value="<?php echo $row['title']?>"><br>

        <label for="director">director:</label>
        <input type="text" name="director" value="<?php echo $row['director']?>"><br>
        
        <label for="genre">genre:</label>
        <input type="text" name="genre" value="<?php echo $row['genre']?>"><br>

        <label for="date_published">date_published:</label>
        <input type="date" name="date_published" value="<?php echo $row['date_published']?>"><br>

        <label for="status">status:</label>
        <input type="text" name="status" value="<?php echo $row['status']?>"><br>
        
        <label for="quantity">quantity:</label>
        <input type="text" name="quantity" value="<?php echo $row['quantity']?>"><br>

        <input type="submit" name="editM" value="Edit" class="btn btn-primary"><br>

    </form>
    <?php } ?>

    <?php

    //MEDIA

    if(isset($_GET['editD'])){ // we are getting id that was sent from display with edit button
        $id = $_GET['editD']; //get id
        $query = "SELECT * FROM devices WHERE id=$id";
        $response = mysqli_query($con, $query);
        if(@count($response)==1){ //check if its only one row, remember @ gets rid of warnings and stuff(basically do not check)
            $row = mysqli_fetch_assoc($response);
        }
    
    ?>


    <b> Edit a Device</b>
    <form action="adders/adddevice.php" method="post">

        <input type="hidden" name="id" value="<?php echo $row['id']?>"><br>

        <label for="model_no">model_no:</label>
        <input type="text" name="model_no" value="<?php echo $row['model_no']?>"><br>

        <label for="title">title:</label>
        <input type="text" name="title" value="<?php echo $row['title']?>"><br>

        <label for="brand">brand:</label>
        <input type="text" name="brand" value="<?php echo $row['brand']?>"><br>
    
        <label for="date_published">date_published:</label>
        <input type="date" name="date_published" value="<?php echo $row['date_published']?>"><br>

        <label for="status">status:</label>
        <input type="text" name="status" value="<?php echo $row['status']?>"><br>
        
        <label for="quantity">quantity:</label>
        <input type="text" name="quantity" value="<?php echo $row['quantity']?>"><br>

        <input type="submit" name="editD" value="Edit" class="btn btn-primary"><br>

    </form>
    <?php } ?>

    <?php

    //Journals

    if(isset($_GET['editJ'])){ // we are getting id that was sent from display with edit button
        $id = $_GET['editJ']; //get id
        $query = "SELECT * FROM journals WHERE id=$id";
        $response = mysqli_query($con, $query);
        if(@count($response)==1){ //check if its only one row, remember @ gets rid of warnings and stuff(basically do not check)
            $row = mysqli_fetch_assoc($response);
        }
    
    ?>


    <b> Edit a Journal</b>
    <form action="adders/addjournal.php" method="post">

        <input type="hidden" name="id" value="<?php echo $row['id']?>"><br>

        <label for="journal_id">journal_id:</label>
        <input type="text" name="journal_id" value="<?php echo $row['journal_id']?>"><br>

        <label for="title">title:</label>
        <input type="text" name="title" value="<?php echo $row['title']?>"><br>

        <label for="author">author:</label>
        <input type="text" name="author" value="<?php echo $row['author']?>"><br>
        
        <label for="publisher">publisher:</label>
        <input type="text" name="publisher" value="<?php echo $row['publisher']?>"><br>
    
        <label for="date_published">date_published:</label>
        <input type="date" name="date_published" value="<?php echo $row['date_published']?>"><br>

        <label for="status">status:</label>
        <input type="text" name="status" value="<?php echo $row['status']?>"><br>
        
        <label for="quantity">quantity:</label>
        <input type="text" name="quantity" value="<?php echo $row['quantity']?>"><br>

        <input type="submit" name="editJ" value="Edit" class="btn btn-primary"><br>

    </form>
    <?php } ?>
    
    <?php

    //Employees
    
    if(isset($_GET['editE'])){ // we are getting id that was sent from display with edit button
        $ssn = $_GET['editE']; //get id
        $query = "SELECT * FROM employees WHERE ssn=$ssn";
        $response = mysqli_query($con, $query);
        if(@count($response)==1){ //check if its only one row, remember @ gets rid of warnings and stuff(basically do not check)
            $row = mysqli_fetch_assoc($response);
        }
    
    ?>


    <b> Edit Employee Info</b>
    <form action="adders/addemployee.php" method="post">

        <input type="hidden" name="oldssn" value="<?php echo $row['ssn']?>"><br>
    
        <label for="ssn">ssn:</label>
        <input type="text" name="ssn" value="<?php echo $row['ssn']?>"><br>

        <label for="username">username:</label>
        <input type="text" name="username" value="<?php echo $row['username']?>"><br>

        <label for="fname">fname:</label>
        <input type="text" name="fname" value="<?php echo $row['fname']?>"><br>

        <label for="lname">lname:</label>
        <input type="text" name="lname" value="<?php echo $row['lname']?>"><br>
        
        <label for="bdate">bdate:</label>
        <input type="date" name="bdate" value="<?php echo $row['bdate']?>"><br>
        
        <?php 
        if($row['sex']=="M"){ ?>
        <input type="radio" id="male" name="sex" value="M" checked>
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="sex" value="F">
        <label for="female">Female</label><br>
        <?php }else{ ?>
        <input type="radio" id="male" name="sex" value="M">
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="sex" value="F" checked>
        <label for="female">Female</label><br>
        <?php } ?>
        
        <label for="phone">phone:</label>
        <input type="tel" name="phone" value="<?php echo $row['phone']?>"><br>
        
        <label for="email">email:</label>
        <input type="email" name="email" value="<?php echo $row['email']?>"><br>
        
        <label for="address">address:</label>
        <input type="text" name="address" value="<?php echo $row['address']?>"><br>
        
        <label for="password">password:</label>
        <input type="text" name="password" value="<?php echo $row['password']?>"><br>

        <input type="submit" name="editE" value="Edit" class="btn btn-primary"><br>

    </form>
    <?php } ?>
    
    <?php
    //members
    
    if(isset($_GET['editMem'])){ // we are getting id that was sent from display with edit button
        $cardnumber = $_GET['editMem']; //get cardnumber
        $query = "SELECT * FROM members WHERE cardnumber=$cardnumber";
        $response = mysqli_query($con, $query);
        if(@count($response)==1){ //check if its only one row, remember @ gets rid of warnings and stuff(basically do not check)
            $row = mysqli_fetch_assoc($response);
        }
    
    ?>


    <b> Edit Member Info</b>
    <form action="adders/addmember.php" method="post" class="d-flex flex-column align-items-center col=3">
        
        <input type="hidden" name="cardnumber" value="<?php echo $row['cardnumber']?>"><br>
        
        <label for="username">username:</label>
        <input type="text" name="username" value="<?php echo $row['username']?>"><br>

        <label for="fname">fname:</label>
        <input type="text" name="fname" value="<?php echo $row['fname']?>"><br>

        <label for="lname">lname:</label>
        <input type="text" name="lname" value="<?php echo $row['lname']?>"><br>

        <label for="phone">phone:</label>
        <input type="tel" name="phone" value="<?php echo $row['phone']?>"><br>
        
        <label for="email">email:</label>
        <input type="email" name="email" value="<?php echo $row['email']?>"><br>
        
        <label for="password">password:</label>
        <input type="text" name="password" value="<?php echo $row['password']?>"><br>
        
        <label for="usertype">usertype:</label>
        <input type="text" name="usertype" value="<?php echo $row['usertype']?>"><br>
        
        <input type="submit" name="editMem" value="Edit" class="btn btn-primary my-2"><br>
        
    </form>
    <?php } ?>
    
</div>
</body>
</html>