<?php
session_start();

if (isset($_SESSION['login'])) {
   header("Location: index.php");
   exit;
}

require 'function.php';

if (isset($_POST['login'])) {
   $username = $_POST['username'];
   $password = $_POST['password'];


   $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

   // cek username
   if (mysqli_num_rows($result) === 1) {
      // cek password
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row['password'])) {
         // set session
         $_SESSION['login'] = true;
         header("Location: index.php");
         exit;
      }
   }
   $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <!-- css -->
   <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
   <div class="wrapper">
      <div class="title">
         Login Form
      </div>
      <?php if (isset($error)) : ?>
         <p style="color: red;">Username/Password salah!</p>
      <?php endif; ?>
      <form action="#" method="POST">
         <div class="field">
            <input type="text" name="username" required>
            <label>Username</label>
         </div>
         <div class="field">
            <input type="password" name="password" required>
            <label>Password</label>
         </div>
         <div class="content">
            <div class="checkbox">
               <input type="checkbox" id="remember-me">
               <label for="remember-me">Remember me</label>
            </div>
            <div class="pass-link">
               <a href="#">Forgot password?</a>
            </div>
         </div>
         <div class="field">
            <input type="submit" value="Login" name="login">
         </div>
         <div class="signup-link">
            Not a member? <a href="register.php">Register</a>
         </div>
      </form>
   </div>
</body>

</html>