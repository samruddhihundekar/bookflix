<?php
session_start();
include "includes/db.php";

if(isset($_POST['login']))
{

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn,$query);

$user = mysqli_fetch_assoc($result);

if($user && password_verify($password,$user['password']))
{

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];

echo "<script>window.location='index.php';</script>";

}
else
{
echo "<script>alert('Invalid Email or Password');</script>";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

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


<h3 class="text-center">Welcome Back, Reader</h3>

<p class="text-center text-secondary mb-4">
Log in to continue discovering books and sharing your thoughts.
</p>

<form method="POST">

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<button class="btn btn-danger w-100" name="login">
Login
</button>

<p class="text-center mt-3">
Don't have an account? 
<a href="register.php" class="text-danger">Register</a>
</p>

</form>

</div>

</div>

</div>

</div>

</body>
</html>