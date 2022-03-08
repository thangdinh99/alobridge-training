<?php
session_start();
require './controller/loginController.php';
$login = new LoginController();
?>
<!DOCTYPE html>
<html>

<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./css/login-styles.css">
   <title>Login</title>
</head>

<body>
   <div class="container">
      <div class="form-container log-in-container">
         <form action="" method="post">
            <h1>Login</h1>
            <input type="text" name="username" placeholder="Username" required value="<?php if (isset($_COOKIE['username'])) {
                                                                                          echo $_COOKIE['username'];
                                                                                       }; ?>" />
            <input type="password" name="password" placeholder="Password" required value="<?php if (isset($_COOKIE['password'])) {
                                                                                             echo $_COOKIE['password'];
                                                                                          }; ?>" />
            <div class="remember-me">
               <input type="checkbox" name="remember" id="remember" <?php if (isset($_COOKIE["userLogin"])) {
                                                                        echo "checked";
                                                                     }; ?> />
               <label for="remember">Remember me</label>
            </div>

            <button type="submit" name="login">Log In</button>
         </form>
      </div>
      <div class="image-container">
         <img src="https://picsum.photos/seed/picsum/500">
      </div>
   </div>
</body>

</html>

