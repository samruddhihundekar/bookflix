<?php
include "includes/db.php";
include "includes/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BookFlix - Discover Books</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<link rel="stylesheet" href="css/style.css">

</head>

<body>




<section class="hero">

<div class="container">

<h1>Discover Your Next Favorite Book</h1>

<p>Browse thousands of books, reviews and recommendations from readers around the world.</p>

<a href="browse.php" class="btn btn-danger btn-lg mt-3">Browse Books</a>

</div>

</section>



<div class="container mt-5">

<h3 class="text-white mb-2"> Trending Books🔥 </h3>
<p class="text-secondary mb-4">Books readers are talking about right now</p>

<div class="row">

<?php

$query = "SELECT books.*, COUNT(reviews.review_id) AS review_count
          FROM books
          LEFT JOIN reviews ON books.book_id = reviews.book_id
          GROUP BY books.book_id
          ORDER BY review_count DESC
          LIMIT 4";

$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result))
{
?>

<div class="col-md-3 mb-4">

<div class="book-card">

<img src="images/<?php echo $row['cover_image']; ?>">

<h5 class="mt-2"><?php echo $row['title']; ?></h5>

<p class="text-secondary"><?php echo $row['author']; ?></p>

<a href="book_details.php?id=<?php echo $row['book_id']; ?>" 
class="btn btn-sm btn-danger mt-2">
View Details
</a>

</div>

</div>

<?php } ?>

</div>

</div>



<div class="container mt-5">

<h3 class="text-white mb-2">📚 Recently Added</h3>
<p class="text-secondary mb-4">Newest books added to BookFlix</p>

<div class="row">

<?php

$query = "SELECT * FROM books 
          ORDER BY created_at DESC 
          LIMIT 4";

$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result))
{
?>

<div class="col-md-3 mb-4">

<div class="book-card">

<img src="images/<?php echo $row['cover_image']; ?>">

<h5><?php echo $row['title']; ?></h5>

<p class="text-secondary"><?php echo $row['author']; ?></p>

<a href="book_details.php?id=<?php echo $row['book_id']; ?>" 
class="btn btn-sm btn-danger mt-2">
View Details
</a>

</div>

</div>

<?php } ?>

</div>

</div>


<?php

$books = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM books"))[0];
$reviews = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM reviews"))[0];
$users = mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM users"))[0];

?>

<div class="container mt-5">

<div class="row text-center">

<div class="col-md-4">

<h2 class="text-danger"><?php echo $books; ?></h2>
<p class="text-light">Books</p>

</div>

<div class="col-md-4">

<h2 class="text-danger"><?php echo $reviews; ?></h2>
<p class="text-light">Reviews</p>

</div>

<div class="col-md-4">

<h2 class="text-danger"><?php echo $users; ?></h2>
<p class="text-light">Readers</p>

</div>

</div>

</div>

<div class="container text-center mt-5">

<a href="browse.php" class="btn btn-danger btn-lg">
Explore More Books
</a>

</div>




<footer class="footer mt-5 text-center text-light p-3">

<p>© 2026 BookFlix | Book Recommendation Platform</p>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>