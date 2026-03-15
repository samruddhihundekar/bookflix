<?php
include "includes/db.php";
include "includes/header.php";

$genre = $_GET['genre'];

$query = "SELECT * FROM books WHERE genre='$genre'";
$result = mysqli_query($conn,$query);
?>

<div class="container mt-5">

<h2 class="text-white mb-4"><?php echo $genre; ?> Books</h2>

<div class="row">

<?php
while($row = mysqli_fetch_assoc($result))
{
?>

<div class="col-md-3 mb-4">

<div class="book-card">

<img src="images/<?php echo $row['cover_image']; ?>">

<h5><?php echo $row['title']; ?></h5>

<p><?php echo $row['author']; ?></p>

<a href="book_details.php?id=<?php echo $row['book_id']; ?>" class="btn btn-danger btn-sm">
View Details
</a>

</div>

</div>

<?php
}
?>

</div>

</div>