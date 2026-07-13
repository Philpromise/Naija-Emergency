<?php
require_once 'config/config.php';
require_once 'lib/functions.php';
require_once 'lib/csrf.php';

$flash = getFlash();
?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<title>Register</title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="container">

<h2>Create Account</h2>

<?php if($flash): ?>

<div class="<?= $flash['type']; ?>">

<?= $flash['message']; ?>

</div>

<?php endif; ?>

<form action="php/register.php" method="POST">

<input
type="hidden"
name="csrf_token"
value="<?= csrf_token(); ?>"
>

<input
type="text"
name="full_name"
placeholder="Full Name"
required
>

<input
type="email"
name="email"
placeholder="Email"
required
>

<input
type="text"
name="phone"
placeholder="Phone Number"
required
>

<input
type="password"
name="password"
placeholder="Password"
required
>

<button type="submit">

Register

</button>

</form>

<p>

Already have an account?

<a href="login.php">

Login

</a>

</p>

</div>

</body>

</html>