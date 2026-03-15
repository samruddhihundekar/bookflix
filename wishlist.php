<?php

session_start();
include "includes/db.php";
include "includes/header.php";

/* check if user logged in */

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "SELECT books.* 
          FROM wishlist
          JOIN books ON wishlist.book_id = books.book_id
          WHERE wishlist.user_id = $user_id";

$result = mysqli_query($conn,$query);

?>

<div class="container mt-5">

<h2 class="text-white mb-4">My Wishlist ❤️</h2>

<div class="row">

<?php

if(mysqli_num_rows($result) > 0)
{

while($row = mysqli_fetch_assoc($result))
{
?>

<div class="col-md-3 mb-4">

<div class="book-card">

<img src="images/<?php echo $row['cover_image']; ?>">

<h5><?php echo $row['title']; ?></h5>

<p class="text-secondary"><?php echo $row['author']; ?></p>

<a href="book_details.php?id=<?php echo $row['book_id']; ?>" class="btn btn-danger btn-sm">
View Details
</a>

<a href="remove_wishlist.php?id=<?php echo $row['book_id']; ?>" 
class="wishlist-heart text-danger fs-4"
title="Remove from Wishlist">
❤️
</a>

</div>

</div>

<?php
}

}
else
{
?>

<div class="col-12 text-center">

<h4 class="text-white mt-4">Your wishlist is empty ❤️</h4>

<p class="text-secondary">Start exploring books and add them to your wishlist.</p>

<a href="browse.php" class="btn btn-danger mt-3">
Browse Books
</a>

</div>

<?php
}
?>

</div>

</div>