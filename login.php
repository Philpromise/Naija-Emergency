<?php
require_once 'config/config.php';
require_once 'lib/functions.php';
require_once 'lib/csrf.php';

$flash = getFlash();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login | <?= APP_NAME ?></title>

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="container">

<h2>Login</h2>

<?php if($flash): ?>

<div class="<?= $flash['type']; ?>">

<?= $flash['message']; ?>

</div>

<?php endif; ?>

<form action="php/login.php" method="POST">

<input
type="hidden"
name="csrf_token"
value="<?= csrf_token(); ?>"
>

<input
type="email"
name="email"
placeholder="Email Address"
required
>

<input
type="password"
name="password"
placeholder="Password"
required
>

<button type="submit">

Login

</button>

</form>

<p>

Don't have an account?

<a href="register.php">

Register

</a>

</p>

</div>

</body>

</html>