<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="css/style.css">

</head>

<body>



<nav class="navbar navbar-expand-lg px-4 custom-navbar">

<a class="navbar-brand d-flex align-items-center" href="index.php">
<img src="images/logo.png" width="45" class="me-2">
<span class="fw-bold brand-text">BookFlix</span>
</a>

<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav me-auto ms-4">

<li class="nav-item">
<a class="nav-link nav-hover" href="index.php"><b>Home</b></a>
</li>

<li class="nav-item">
<a class="nav-link nav-hover" href="browse.php"><b>Browse</b></a>
</li>

<li class="nav-item">
<a class="nav-link nav-hover" href="genre.php"><b>Genres</b></a>
</li>

<li class="nav-item">
<a class="nav-link nav-hover" href="add_book.php"><b>Add Book</b></a>
</li>

<li class="nav-item">
<a class="nav-link nav-hover" href="wishlist.php"><b>Wishlist</b></a>
</li>


</ul>

<?php if(isset($_SESSION['user_id'])) { ?>

<span class="text-white me-3">
Hi, <?php echo $_SESSION['user_name']; ?>
</span>

<a href="logout.php" class="btn btn-danger">Logout</a>

<?php } else { ?>

<a href="login.php" class="btn btn-outline-light me-2">Login</a>
<a href="register.php" class="btn btn-danger">Register</a>

<?php } ?>
</div>

</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>