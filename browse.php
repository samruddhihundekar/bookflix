<?php
include "includes/db.php";
include "includes/header.php";

$user_id = $_SESSION['user_id'] ?? 0;
?>

<div class="container mt-5">

<h2 class="text-white mb-4">Browse Books</h2>

<!-- Search Bar -->

<form method="GET" class="mb-4">

<div class="input-group">

<input type="text" id="search" class="form-control" placeholder="Search books by title or author">

<button class="btn btn-danger">
<i class="fa fa-search"></i> Search
</button>

</div>

</form>

<div class="row" id="book-results">

<?php

if(isset($_GET['search']) && $_GET['search'] != "")
{
$search = mysqli_real_escape_string($conn,$_GET['search']);

$query = "SELECT books.*, 
          AVG(reviews.rating) AS avg_rating,
          wishlist.book_id AS in_wishlist
          FROM books
          LEFT JOIN reviews ON books.book_id = reviews.book_id
          LEFT JOIN wishlist 
          ON books.book_id = wishlist.book_id 
          AND wishlist.user_id = '$user_id'
          WHERE books.title LIKE '%$search%' 
          OR books.author LIKE '%$search%'
          GROUP BY books.book_id";
}
else
{
$query = "SELECT books.*, 
          AVG(reviews.rating) AS avg_rating,
          wishlist.book_id AS in_wishlist
          FROM books
          LEFT JOIN reviews ON books.book_id = reviews.book_id
          LEFT JOIN wishlist 
          ON books.book_id = wishlist.book_id 
          AND wishlist.user_id = '$user_id'
          GROUP BY books.book_id
          ORDER BY books.created_at DESC";
}

$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result) > 0)
{

while($row = mysqli_fetch_assoc($result))
{
?>

<div class="col-md-3 mb-4">

<div class="book-card">

<img src="images/<?php echo $row['cover_image']; ?>">

<h5 class="mt-2"><?php echo $row['title']; ?></h5>

<p class="text-secondary"><?php echo $row['author']; ?></p>

<p class="text-warning">

<?php
if($row['avg_rating'])
{
echo "⭐ " . number_format($row['avg_rating'],1) . " / 5";
}
else
{
echo "⭐ No ratings yet";
}
?>

</p>

<a href="book_details.php?id=<?php echo $row['book_id']; ?>" class="btn btn-danger btn-sm">
View Details
</a>

<?php if($row['in_wishlist']) { ?>

<a href="remove_wishlist.php?id=<?php echo $row['book_id']; ?>" 
class="wishlist-heart text-danger">
❤️
</a>

<?php } else { ?>

<a href="add_to_wishlist.php?id=<?php echo $row['book_id']; ?>" 
class="wishlist-heart">
🤍
</a>

<?php } ?>

</div>

</div>

<?php
}
}
else
{
?>

<div class="col-12 text-center">

<h4 class="text-white mt-4">No books found 📚</h4>
<p class="text-secondary">Try searching with a different title or author.</p>

</div>

<?php
}
?>

</div>

</div>

<script>

document.getElementById("search").addEventListener("keyup", function(){

let searchValue = this.value;

let xhr = new XMLHttpRequest();

xhr.open("POST","search_books.php",true);

xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");

xhr.onload = function(){

document.getElementById("book-results").innerHTML = this.responseText;

};

xhr.send("search=" + searchValue);

});

</script>