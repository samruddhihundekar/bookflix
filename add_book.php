<?php
include "includes/db.php";
include "includes/header.php";

if(isset($_POST['submit']))
{

$title = mysqli_real_escape_string($conn,$_POST['title']);
$author = mysqli_real_escape_string($conn,$_POST['author']);
$genre = mysqli_real_escape_string($conn,$_POST['genre']);
$publisher = mysqli_real_escape_string($conn,$_POST['publisher']);
$pages = intval($_POST['pages']);
$language = mysqli_real_escape_string($conn,$_POST['language']);
$isbn = mysqli_real_escape_string($conn,$_POST['isbn']);
$year = intval($_POST['year']);
$description = mysqli_real_escape_string($conn,$_POST['description']);


$image = $_FILES['cover']['name'];
$tmp = $_FILES['cover']['tmp_name'];

move_uploaded_file($tmp,"images/".$image);

$query = "INSERT INTO books(title,author,genre,description,cover_image,publisher,pages,language,isbn,published_year)
VALUES('$title','$author','$genre','$description','$image','$publisher','$pages','$language','$isbn','$year')";

mysqli_query($conn,$query);

echo "<script>alert('Book Added Successfully');</script>";

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Book</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">Add New Book</h2>

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">
<label>Book Title</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Author</label>
<input type="text" name="author" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Genre</label>
<input type="text" name="genre" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Publisher</label>
<input type="text" name="publisher" class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>Pages</label>
<input type="number" name="pages" class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>Language</label>
<input type="text" name="language" class="form-control">
</div>

<div class="col-md-4 mb-3">
<label>Published Year</label>
<input type="number" name="year" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>ISBN</label>
<input type="text" name="isbn" class="form-control">
</div>

<div class="col-md-6 mb-3">
<label>Book Cover</label>
<input type="file" name="cover" class="form-control" required>
</div>

<div class="col-12 mb-3">
<label>Description</label>
<textarea name="description" class="form-control" rows="4"></textarea>
</div>

</div>

<button class="btn btn-danger" name="submit">Add Book</button>

</form>

</div>

</body>
</html>