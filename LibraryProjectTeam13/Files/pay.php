<?php
    require_once('connection.php');

    //BOOKS

    if(isset($_GET['pay'])){
        $cardnumber = $_GET['pay']; //
        $query = "UPDATE fines SET paid=1 WHERE cardnumber=$cardnumber and paid=0";
        $result = mysqli_query($con, $query);
        header("Location: fines.php");
    }
    
?>