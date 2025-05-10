<?php
//db connection
include('../lib/connection.php');


//delete category
if( isset($_GET['ID'])){
    $d_id = $_GET['ID'];

    $delete_query = "DELETE FROM news WHERE ID = '$d_id'";
    
    if($conn->query($delete_query)){
        header('Location: news.php');
    }else{
        die($conn->error);
    }
}
else{
    header('Location: news.php');
}
?>