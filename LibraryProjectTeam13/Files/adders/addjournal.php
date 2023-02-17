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
if(isset($_POST['journalsubmit'])){

    $data_missing = array(); //storing the values of empty slots

    //journal_id
    if(empty($_POST['journal_id'])){
        $data_missing[] = 'journal_id';
    }else{
        $journal_id = trim($_POST['journal_id']);
    }
    //title
    if(empty($_POST['title'])){
        $data_missing[] = 'title';
    }else{
        $title = trim($_POST['title']);
    }
    //author
    if(empty($_POST['author'])){
        $data_missing[] = 'author';
    }else{
        $author = trim($_POST['author']);
    }
    //publisher
    if(empty($_POST['publisher'])){
        $data_missing[] = 'publisher';
    }else{
        $publisher = trim($_POST['publisher']);
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
        "INSERT INTO journals(journal_id, title, author, publisher, date_published, status, quantity)
         VALUES ('$journal_id', '$title', '$author', '$publisher', '$date_published', '$status', '$quantity')";

        if(!mysqli_query($con, $sql)){
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }else{
            echo "New Record was created succ in devices";
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

if(isset($_POST['editJ'])){

    $data_missing = array(); //storing the values of empty slots

    $id = $_POST['id'];

    //journal_id
    if(empty($_POST['journal_id'])){
        $data_missing[] = 'journal_id';
    }else{
        $journal_id = trim($_POST['journal_id']);
    }
    //title
    if(empty($_POST['title'])){
        $data_missing[] = 'title';
    }else{
        $title = trim($_POST['title']);
    }
    //author
    if(empty($_POST['author'])){
        $data_missing[] = 'author';
    }else{
        $author = trim($_POST['author']);
    }
    //publisher
    if(empty($_POST['publisher'])){
        $data_missing[] = 'publisher';
    }else{
        $publisher = trim($_POST['publisher']);
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
        "UPDATE journals SET journal_id='$journal_id', title='$title', author='$author', publisher='$publisher', date_published='$date_published', status='$status', quantity='$quantity' WHERE id='$id'";

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