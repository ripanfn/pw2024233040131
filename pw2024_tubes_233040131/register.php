<?php
require 'function.php';

if (isset($_POST['register'])) {
   if (register($_POST) > 0) {
      echo "<script>
                alert('user berhasil ditambahkan!');
            </script>";
   } else {
      echo mysqli_error($koneksi);
   }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <!-- css -->
   <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
   <div class="wrapper">
      <div class="title">
         Register Form
      </div>
      <form action="#" method="POST">
         <div class="field">
            <input type="text" name="username" required>
            <label>Username</label>
         </div>
         <div class="field">
            <input type="password" name="password" required>
            <label>Password</label>
         </div>
         <div class="field">
            <input type="password" name="password2" required>
            <label>Konfirmasi Password</label>
         </div>
         <div class="field">
            <input type="submit" value="Register" name="register">
         </div>
         <div class="signup-link">
            Not a member? <a href="login.php">Login now</a>
         </div>
      </form>
   </div>
</body>

</html>