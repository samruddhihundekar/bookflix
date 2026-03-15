<?php
include "includes/db.php";
include "includes/header.php";

$book_id = $_GET['id'];

$query = "SELECT * FROM books WHERE book_id = $book_id";
$result = mysqli_query($conn,$query);
$book = mysqli_fetch_assoc($result);

$user_id = $_SESSION['user_id'] ?? 0;



$wish_query = "SELECT * FROM wishlist 
               WHERE user_id='$user_id' 
               AND book_id='$book_id'";

$wish_result = mysqli_query($conn,$wish_query);
$in_wishlist = mysqli_num_rows($wish_result) > 0;



$review_query = "SELECT * FROM reviews 
                 WHERE user_id='$user_id' 
                 AND book_id='$book_id'";

$review_result = mysqli_query($conn,$review_query);
$user_review = mysqli_fetch_assoc($review_result);
?>

<!DOCTYPE html>
<html>
<head>

<title><?php echo $book['title']; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container mt-5">

<div class="row">


<div class="col-md-4 text-center">

<div class="card bg-dark border-0 shadow-lg p-3">

<img src="images/<?php echo $book['cover_image']; ?>" class="img-fluid rounded">

</div>

</div>



<div class="col-md-8">

<div class="d-flex align-items-center justify-content-between mb-3">

<h2 class="fw-bold mb-0"><?php echo $book['title']; ?></h2>

<?php if($in_wishlist) { ?>

<a href="remove_wishlist.php?id=<?php echo $book_id; ?>" 
class="wishlist-heart text-danger fs-3"
title="Remove from Wishlist">❤️</a>

<?php } else { ?>

<a href="add_to_wishlist.php?id=<?php echo $book_id; ?>" 
class="wishlist-heart fs-3"
title="Add to Wishlist">🤍</a>

<?php } ?>

</div>

<h5 class="text-secondary mb-3">by <?php echo $book['author']; ?></h5>

<span class="badge bg-danger mb-4"><?php echo $book['genre']; ?></span>

<div class="card bg-dark border-0 shadow-lg p-3">

<table class="table table-dark table-hover mb-0">

<tr><td><b>Publisher</b></td><td><?php echo $book['publisher']; ?></td></tr>
<tr><td><b>Published Year</b></td><td><?php echo $book['published_year']; ?></td></tr>
<tr><td><b>Pages</b></td><td><?php echo $book['pages']; ?></td></tr>
<tr><td><b>Language</b></td><td><?php echo $book['language']; ?></td></tr>
<tr><td><b>ISBN</b></td><td><?php echo $book['isbn']; ?></td></tr>

</table>

</div>

<h4 class="mt-4">Description</h4>

<p class="text-light" style="line-height:1.8;">
<?php echo nl2br($book['description']); ?>
</p>


<h4 class="mt-4 text-white">Rate this Book</h4>

<?php if($user_review) { ?>


<form method="POST" action="update_review.php">

<input type="hidden" name="review_id" value="<?php echo $user_review['review_id']; ?>">
<input type="hidden" name="book_id" value="<?php echo $book_id; ?>">

<div class="rating-stars mb-3">

<i class="fa fa-star star" data-value="1"></i>
<i class="fa fa-star star" data-value="2"></i>
<i class="fa fa-star star" data-value="3"></i>
<i class="fa fa-star star" data-value="4"></i>
<i class="fa fa-star star" data-value="5"></i>

</div>

<input type="hidden" name="rating" id="rating-value" value="<?php echo $user_review['rating']; ?>">

<textarea name="comment" class="form-control mb-3"><?php echo $user_review['comment']; ?></textarea>

<button class="btn btn-warning">Update Review</button>

</form>

<?php } else { ?>



<form method="POST" action="add_review.php">

<input type="hidden" name="book_id" value="<?php echo $book_id; ?>">

<div class="rating-stars mb-3">

<i class="fa fa-star star" data-value="1"></i>
<i class="fa fa-star star" data-value="2"></i>
<i class="fa fa-star star" data-value="3"></i>
<i class="fa fa-star star" data-value="4"></i>
<i class="fa fa-star star" data-value="5"></i>

</div>

<input type="hidden" name="rating" id="rating-value">

<textarea name="comment" class="form-control mb-3" placeholder="Write your review"></textarea>

<button class="btn btn-danger">Submit Review</button>

</form>

<?php } ?>

<div class="mt-4">
<a href="index.php" class="btn btn-outline-light">← Back to Home</a>
</div>

</div>

</div>

</div>


<h4 class="mt-5 text-white">User Reviews</h4>

<?php

$query = "SELECT reviews.*, users.name 
          FROM reviews 
          JOIN users ON reviews.user_id = users.id
          WHERE book_id = $book_id
          ORDER BY created_at DESC";

$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result))
{
?>

<div class="card bg-dark text-white mb-3 p-3">

<strong><?php echo $row['name']; ?></strong>

<div class="text-warning mb-2">

<?php
for($i=1;$i<=5;$i++)
{
echo ($i <= $row['rating']) ? "★" : "☆";
}
?>

</div>

<p><?php echo $row['comment']; ?></p>

</div>

<?php } ?>


<script>

const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('rating-value');

stars.forEach((star,index)=>{

star.addEventListener('click',function(){

ratingInput.value = index + 1;

stars.forEach(s => s.classList.remove('active'));

for(let i=0;i<=index;i++){
stars[i].classList.add('active');
}

});

});

</script>

</body>
</html>

<!-- UPDATE books
SET description = 'The Hobbit is a fantasy adventure novel by J.R.R. Tolkien. It follows the journey of Bilbo Baggins, a hobbit who is unexpectedly recruited by the wizard Gandalf and a group of dwarves to help reclaim their treasure from the dragon Smaug. Along the way, Bilbo faces many challenges, discovers courage, and finds the mysterious One Ring.'
WHERE title = 'The Hobbit'; -->