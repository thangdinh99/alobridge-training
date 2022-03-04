<?php
session_start();
include_once './config/myConfig.php';
if (isset($_POST['login'])) {
   if (empty($_POST['username']) || empty($_POST['password'])) {
      echo "Username or password is empty";
   } else {
      $username = $_POST['username'];
      $password = $_POST['password'];
      //check login
      $userQuery = "SELECT * from users where username='$username' AND password='$password'";
      $userRes = mysqli_query($conn, $userQuery);
      $userRow = mysqli_num_rows($userRes);
      if ($userRow > 0) {
         //session login
      $userData = mysqli_fetch_assoc($userRes);
      $_SESSION['user_id'] = $userData['id'];
	  
      //check checkbox
      if (!empty($_POST['remember'])) {
         $rememberCheckbox = $_POST['remember'];
         ///set cookie
         setcookie('username', $username, time() + 3600 * 24 * 7);
         setcookie('password', $password, time() + 3600 * 24 * 7);
         setcookie('userLogin', $rememberCheckbox, time() + 3600 * 24 * 7);
      } else {
         //expire cookie
         setcookie('username', $username, 30);
         setcookie('password', $password, 30);
      };
      //redirect to listProduct
	  
      header("Location: .\pages\listProduct.php");
      } else {
         echo "Username or password is incorrect";
      }
   }
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./css/styles.css">

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