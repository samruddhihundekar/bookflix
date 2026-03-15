<?php
include "includes/db.php";
include "includes/header.php";
?>

<div class="container mt-5">

<h2 class="text-white mb-4">Book Genres</h2>

<div class="row">

<?php

$query = "SELECT DISTINCT genre FROM books";
$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result))
{

?>

<div class="col-md-3 mb-4">

<div class="card bg-dark text-white text-center p-4">

<h5><?php echo $row['genre']; ?></h5>

<a href="genre_books.php?genre=<?php echo $row['genre']; ?>" class="btn btn-danger mt-2">
View Books
</a>

</div>

</div>

<?php
}
?>

</div>

</div>