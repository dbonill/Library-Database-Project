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

    if(isset($_POST['addmember'])){

        $data_missing = array(); //storing the values of empty slots
        
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
        if(empty($_POST['password'])){
            $data_missing[] = 'password';
        }else{
            $password = trim($_POST['password']);
        }
        if(empty($_POST['usertype'])){
            $data_missing[] = 'usertype';
        }else{
            $usertype = trim($_POST['usertype']);
        }
    
        if(empty($data_missing)){  //everything was entered $data_missing is empty
            require_once('../connection.php'); //bring in connection 
    
            $sql = 
            "INSERT INTO members(username, fname, lname, phone, email, password, usertype)
             VALUES ('$username', '$fname', '$lname', '$phone', '$email', '$password', '$usertype')";
    
            if(!mysqli_query($con, $sql)){
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }else{
                echo "New Record was created succ";
                header("Location: ../search_user.php");
            }
    
            
    
        }else{ //some data was missing
            
            echo 'You need to enter the following data <br />';
    
            foreach($data_missing as $missingitem){
                echo "$missingitem <br/>";
                
    
            }
            header("Location: ../search_user.php");
        }
        

    }
    
    if(isset($_POST['editMem'])){

        $data_missing = array(); //storing the values of empty slots
        
        $cardnumber = trim($_POST['cardnumber']);
        
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
        if(empty($_POST['password'])){
            $data_missing[] = 'password';
        }else{
            $password = trim($_POST['password']);
        }
        if(empty($_POST['usertype'])){
            $data_missing[] = 'usertype';
        }else{
            $usertype = trim($_POST['usertype']);
        }
    
        if(empty($data_missing)){  //everything was entered $data_missing is empty
            require_once('../connection.php'); //bring in connection 
    
            $sql = 
            "UPDATE members SET username='$username', fname='$fname', lname='$lname', phone='$phone', email='$email', password='$password', usertype='$usertype' WHERE cardnumber='$cardnumber'";
    
            if(!mysqli_query($con, $sql)){
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }else{
                echo "New Record was edited success";
                header("Location: ../search_user.php");
            }
    
            
    
        }else{ //some data was missing
            
            echo 'You need to enter the following data <br />';
    
            foreach($data_missing as $missingitem){
                echo "$missingitem <br/>";
                
    
            }
            header("Location: ../search_user.php");
        }
        

    }

?>
    
    
    
    
</body>
</html>