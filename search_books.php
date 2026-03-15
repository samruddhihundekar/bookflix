<?php
include "includes/db.php";

$search = $_POST['search'];

$query = "SELECT * FROM books 
          WHERE title LIKE '%$search%' 
          OR author LIKE '%$search%'";

$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_assoc($result))
{
?>

<div class="col-md-3 mb-4">

<div class="book-card">

<img src="images/<?php echo $row['cover_image']; ?>">

<h5 class="mt-2"><?php echo $row['title']; ?></h5>

<p class="text-secondary"><?php echo $row['author']; ?></p>

<a href="book_details.php?id=<?php echo $row['book_id']; ?>" class="btn btn-danger btn-sm">
View Details
</a>

</div>

</div>

<?php
}
?>