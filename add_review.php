<?php

session_start();
include "includes/db.php";

$user_id = $_SESSION['user_id'];
$book_id = $_POST['book_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];

$query = "INSERT INTO reviews(user_id,book_id,rating,comment)
VALUES('$user_id','$book_id','$rating','$comment')";

mysqli_query($conn,$query);

header("Location: book_details.php?id=".$book_id);

?>