<?php
    include('connection.php');
    $date = date('Y-m-d');
    $con->query("UPDATE DaysOpened SET days_passed = days_passed + 1, CurrentDate = '$date'");
    //$con->query("DELETE FROM hold WHERE end_date = '$date'");
?>