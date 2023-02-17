<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add media</title>
</head>
<body>
    
<?php
require_once('../connection.php'); //execute whatever is in connection 
if(isset($_POST['mediasubmit'])){

    $data_missing = array(); //storing the values of empty slots

    //identification
    if(empty($_POST['identification'])){
        $data_missing[] = 'identification';
    }else{
        $identification = trim($_POST['identification']);
    }
    //title
    if(empty($_POST['title'])){
        $data_missing[] = 'title';
    }else{
        $title = trim($_POST['title']);
    }
    //director
    if(empty($_POST['director'])){
        $data_missing[] = 'director';
    }else{
        $director = trim($_POST['director']);
    }
    //genre
    if(empty($_POST['genre'])){
        $data_missing[] = 'genre';
    }else{
        $genre = trim($_POST['genre']);
    }
    //date_published
    if(empty($_POST['date_published'])){
        $data_missing[] = 'date_published';
    }else{
        $date_published = trim($_POST['date_published']);
    }
    //status
    if(empty($_POST['status'])){
        $data_missing[] = 'status';
    }else{
        $status = trim($_POST['status']);
    }
    //quantity
    if(empty($_POST['quantity'])){
        $data_missing[] = 'quantity';
    }else{
        $quantity = trim($_POST['quantity']);
    }

    if(empty($data_missing)){  //everything was entered $data_missing is empty
        

        $sql = 
        "INSERT INTO media(identification, title, director, genre, date_published, status, quantity)
         VALUES ('$identification', '$title', '$director', '$genre', '$date_published', '$status', '$quantity')";

        if(!mysqli_query($con, $sql)){
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }else{
            echo "New Record was created succ";
            header("Location: ../admin.php");
        }

    }else{ //some data was missing
        
        echo 'You need to enter the following data <br />';

        foreach($data_missing as $missingitem){
            echo "$missingitem <br/>";
            

        }
        header("Location: ../admin.php");
    }
        

}

if(isset($_POST['editM'])){

    $data_missing = array(); //storing the values of empty slots

    $id = $_POST['id'];

    //identification
    if(empty($_POST['identification'])){
        $data_missing[] = 'identification';
    }else{
        $identification = trim($_POST['identification']);
    }
    //title
    if(empty($_POST['title'])){
        $data_missing[] = 'title';
    }else{
        $title = trim($_POST['title']);
    }
    //director
    if(empty($_POST['director'])){
        $data_missing[] = 'director';
    }else{
        $director = trim($_POST['director']);
    }
    //genre
    if(empty($_POST['genre'])){
        $data_missing[] = 'genre';
    }else{
        $genre = trim($_POST['genre']);
    }
    //date_published
    if(empty($_POST['date_published'])){
        $data_missing[] = 'date_published';
    }else{
        $date_published = trim($_POST['date_published']);
    }
    //status
    if(empty($_POST['status'])){
        $data_missing[] = 'status';
    }else{
        $status = trim($_POST['status']);
    }
    //quantity
    if(empty($_POST['quantity'])){
        $data_missing[] = 'quantity';
    }else{
        $quantity = trim($_POST['quantity']);
    }

    if(empty($data_missing)){  //everything was entered $data_missing is empty
        
        $sql = 
        "UPDATE media SET identification='$identification', title='$title', director='$director', genre='$genre', date_published='$date_published', status='$status', quantity='$quantity' WHERE id='$id'";

        if(!mysqli_query($con, $sql)){
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }else{
            
            header("Location: ../display.php");
            echo "New Record was updated succ";
        }

    }else{ //some data was missing
        
        echo 'You need to enter the following data <br />';

        foreach($data_missing as $missingitem){
            echo "$missingitem <br/>";
            

        }
        header("Location: ../display.php");
    }
}

?>

</body>
</html>