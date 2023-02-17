<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin.php</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

</head>
<body>
    
    <?php

    if(isset($_POST['addemployee'])){

        $data_missing = array(); //storing the values of empty slots
        
        //ssn
        if(empty($_POST['ssn'])){
            $data_missing[] = 'ssn';
        }else{
            $ssn = trim($_POST['ssn']);
        }
        //username
        if(empty($_POST['username'])){
            $data_missing[] = 'username';
        }else{
            $username = trim($_POST['username']);
        }
        //fname
        if(empty($_POST['fname'])){
            $data_missing[] = 'fname';
        }else{
            $fname = trim($_POST['fname']);
        }
        //lname
        if(empty($_POST['lname'])){
            $data_missing[] = 'lname';
        }else{
            $lname = trim($_POST['lname']);
        }
        //bdate
        if(empty($_POST['bdate'])){
            $data_missing[] = 'bdate';
        }else{
            $bdate = trim($_POST['bdate']);
        }
        //sex
        if(empty($_POST['sex'])){
            $data_missing[] = 'sex';
        }else{
            $sex = trim($_POST['sex']);
        }
        //phone
        if(empty($_POST['phone'])){
            $data_missing[] = 'phone';
        }else{
            $phone = trim($_POST['phone']);
        }
        //email
        if(empty($_POST['email'])){
            $data_missing[] = 'email';
        }else{
            $email = trim($_POST['email']);
        }
        //address
        if(empty($_POST['address'])){
            $data_missing[] = 'address';
        }else{
            $address = trim($_POST['address']);
        }
        
        if(empty($_POST['password'])){
            $data_missing[] = 'password';
        }else{
            $password = trim($_POST['password']);
        }
    
        if(empty($data_missing)){  //everything was entered $data_missing is empty
            require_once('../connection.php'); //bring in connection 
    
            $sql = 
            "INSERT INTO employees(ssn, username, fname, lname, bdate, sex, phone, email, address, password)
             VALUES ('$ssn', '$username', '$fname', '$lname', '$bdate', '$sex', '$phone', '$email', '$address', '$password')";
    
            if(!mysqli_query($con, $sql)){
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }else{
                echo "New Record was created succ";
                header("Location: ../employees.php");
            }
    
            
    
        }else{ //some data was missing
            
            echo 'You need to enter the following data <br />';
    
            foreach($data_missing as $missingitem){
                echo "$missingitem <br/>";
                
    
            }
            header("Location: ../employees.php");
        }
        

    }
    
    if(isset($_POST[editE])){

        $data_missing = array(); //storing the values of empty slots
        
        $oldssn = trim($_POST['oldssn']);
        
        //ssn
        if(empty($_POST['ssn'])){
            $data_missing[] = 'ssn';
        }else{
            $ssn = trim($_POST['ssn']);
        }
        //username
        if(empty($_POST['username'])){
            $data_missing[] = 'username';
        }else{
            $username = trim($_POST['username']);
        }
        //fname
        if(empty($_POST['fname'])){
            $data_missing[] = 'fname';
        }else{
            $fname = trim($_POST['fname']);
        }
        //lname
        if(empty($_POST['lname'])){
            $data_missing[] = 'lname';
        }else{
            $lname = trim($_POST['lname']);
        }
        //bdate
        if(empty($_POST['bdate'])){
            $data_missing[] = 'bdate';
        }else{
            $bdate = trim($_POST['bdate']);
        }
        //sex
        if(empty($_POST['sex'])){
            $data_missing[] = 'sex';
        }else{
            $sex = trim($_POST['sex']);
        }
        //phone
        if(empty($_POST['phone'])){
            $data_missing[] = 'phone';
        }else{
            $phone = trim($_POST['phone']);
        }
        //email
        if(empty($_POST['email'])){
            $data_missing[] = 'email';
        }else{
            $email = trim($_POST['email']);
        }
        //address
        if(empty($_POST['address'])){
            $data_missing[] = 'address';
        }else{
            $address = trim($_POST['address']);
        }
        if(empty($_POST['password'])){
            $data_missing[] = 'password';
        }else{
            $password = trim($_POST['password']);
        }
    
        if(empty($data_missing)){  //everything was entered $data_missing is empty
            require_once('../connection.php'); //bring in connection 
    
            $sql = 
            "UPDATE employees SET ssn='$ssn', username='$username', fname='$fname', lname='$lname', bdate='$bdate', sex='$sex', phone='$phone', email='$email', address='$address', password='$password' WHERE ssn='$oldssn'";
    
            if(!mysqli_query($con, $sql)){
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }else{
                echo "New Record was created succ";
                header("Location: ../employees.php");
            }
    
            
    
        }else{ //some data was missing
            
            echo 'You need to enter the following data <br />';
    
            foreach($data_missing as $missingitem){
                echo "$missingitem <br/>";
                
    
            }
            header("Location: ../employees.php");
        }
        

    }

?>
    
    
    
    
</body>
</html>