<?php
include "includes/db.php";

if(isset($_POST['register']))
{

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$query = "INSERT INTO users(name,email,password)
VALUES('$name','$email','$password')";

mysqli_query($conn,$query);

echo "<script>alert('Registration Successful'); window.location='login.php';</script>";

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

</head>

<body>
    

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-5">

<div class="card bg-dark text-white shadow-lg p-4">

    <div class="text-center mb-4">
<a href="index.php">
<img src="images/logo.png" width="70">
</a>
<h3 class="text-danger mt-2">BookFlix</h3>

</div>

<h3 class="text-center">Join the BookFlix Community</h3>

<p class="text-center text-secondary mb-4">
Create your account to discover books, share reviews, and build your personal reading list.
</p>


<form method="POST">

<div class="mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-danger w-100" name="register">
Register
</button>

<p class="text-center mt-3">
Already have an account? 
<a href="login.php" class="text-danger">Login</a>
</p>

</form>

</div>

</div>

</div>

</div>

</body>
</html>