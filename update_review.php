<?php

session_start();
include "includes/db.php";

$review_id = $_POST['review_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$book_id = $_POST['book_id'];


$query = "UPDATE reviews 
          SET rating='$rating', comment='$comment'
          WHERE review_id='$review_id'";

mysqli_query($conn,$query);


header("Location: book_details.php?id=".$book_id);
exit();

?>