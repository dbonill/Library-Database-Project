<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add book</title>
</head>
<body>
    
<?php
require_once('../connection.php'); //execute whatever is in connection 
if(isset($_POST['booksubmit'])){

    $data_missing = array(); //storing the values of empty slots

    //isbn
    if(empty($_POST['isbn'])){
        $data_missing[] = 'isbn';
    }else{
        $isbn = trim($_POST['isbn']);
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
        "INSERT INTO books(isbn, title, author, publisher, genre, date_published, status, quantity)
         VALUES ('$isbn', '$title', '$author', '$publisher', '$genre', '$date_published', '$status', '$quantity')";

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

if(isset($_POST['editB'])){

    $data_missing = array(); //storing the values of empty slots

    $id = $_POST['id'];

    if(empty($_POST['isbn'])){
        $data_missing[] = 'isbn';
    }else{
        $isbn = trim($_POST['isbn']);
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
        "UPDATE books SET isbn='$isbn', title='$title', author='$author', publisher='$publisher', genre='$genre', date_published='$date_published', status='$status', quantity='$quantity' WHERE id='$id'";

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