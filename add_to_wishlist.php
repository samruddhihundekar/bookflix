<?php

session_start();
include "includes/db.php";


if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = $_GET['id'];



$check = "SELECT * FROM wishlist 
          WHERE user_id='$user_id' 
          AND book_id='$book_id'";

$result = mysqli_query($conn,$check);

if(mysqli_num_rows($result) == 0)
{
    $query = "INSERT INTO wishlist(user_id,book_id)
              VALUES('$user_id','$book_id')";

    mysqli_query($conn,$query);
}


header("Location: " . $_SERVER['HTTP_REFERER']);
exit();

?>