<?php
  
    session_start();
    require_once("connection.php");

    $sql = "SELECT M.Email, M.cardnumber, B.type, B.id, B.date_due
            FROM members as M, borrow as B
            WHERE B.date_returned = '0000-00-00' AND  M.cardnumber = B.cardnumber AND B.date_due - curdate() > 0
            ORDER BY B.cardnumber";

    $result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0){
        $email = array();    #array to keep track of emails that checked out
        $msg = "";     #msg to put in the body of email
        $counter = 0;
        
        while($row = mysqli_fetch_assoc($result)){
        //////////////check if next in list already exists in the array//////////////
            if(!array_key_exists($row["Email"],$email)){
                if(array_count_values($email)>0){
                    #echo $msg;
                    mail(str_replace("'", "", $key),'Following items are due in 3 days',$msg,'From: onethree@onethreelibrary.site');
                    $msg = "";
                }
                $key = $row["Email"];
                
                $email[$key] = $row["cardnumber"];       #add new email to the array to keep track of
            }
            $counter+=1;
            
            
        //////////////////check if type is a book/////////////////////
            if($row["type"] == 'book'){
                $id = $row['id'];
                $query="SELECT B.title, B.isbn
                        FROM books as B 
                        WHERE '$id' = B.id";
                $book = mysqli_query($con, $query);
                if($col = mysqli_fetch_assoc($book)){
                    #echo $col['title'] . '<br>';
                    $msg .= "title: " . $col['title'] . " - isbn: " . $col['isbn'] . ":  due on " . $row['date_due']  . "\n\n";
                }
            }
        //////////////////check if type is a film/////////////////////
            if($row["type"] == 'media'){
                $id = $row['id'];
                $query="SELECT M.title, M.director
                        FROM media as M
                        WHERE '$id' = M.id";
                $media = mysqli_query($con, $query);
                if($col = mysqli_fetch_assoc($media)){
                    #echo $col['title'] . '<br>';
                    $msg .= "Name: " . $col['title'] . " - director: " . $col['director'] . ":  due on " . $row['date_due'] . "\n\n"; 
                    
                }
            }
        //////////////////check if type is a journal/////////////////////
            if($row["type"] == 'journal'){
                $id = $row['id'];
                
                $query="SELECT J.title, J.author
                        FROM journals as J
                        WHERE '$id' = J.id";
                $journal = mysqli_query($con, $query);
                if($col = mysqli_fetch_assoc($journal)){
                    #echo $col['title'] . '<br>';
                    $msg .= "title: " . $col['title'] . " - isbn: " . $col['isbn'] . ":  due on " . $row['date_due'] . "\n\n"; 
                
                }
            }
        //////////////////check if type is a device/////////////////////
            if($row["type"] == 'device'){
                $id = $row['id'];
                
                $query="SELECT D.title, D.brand
                        FROM devices as D
                        WHERE '$id' = D.id";
                $device = mysqli_query($con, $query);
                if($col = mysqli_fetch_assoc($device)){
                    #echo $col['title'] . '<br>';
                    $msg .= "title: " . $col['title'] . " - brand: " . $col['brand'] . ":  due on " . $row['date_due'] . "\n\n";
                
                }
            }
            if($counter == mysqli_num_rows($result)){
                #echo $msg;
                mail(str_replace("'", "", $key),'Following items are due in three weeks',$msg,'From: onethree@onethreelibrary.site');
            }
        }
    }
            
    else{
        echo "0 results";
    }
  
?>



