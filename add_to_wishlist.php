<?php

session_start();
include "includes/db.php";

/* check if user logged in */

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = $_GET['id'];

/* prevent duplicate wishlist */

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

/* return to previous page */

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();

?>