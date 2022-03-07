<?php
require "./config/myConfig.php";
class LoginController extends Database
{

   public function __construct()
   {
      parent::__construct();
      $this->login();
   }
   public function requiredFeild(){
      if(empty($_POST['username']) || empty($_POST['password'])){
         return true;
      }else{
         return false;
      }
   }
   public function findUser($username, $password){
      $userQuery = "SELECT * from users where username='$username' AND password='$password'";
      $userRes = mysqli_query($this->conn, $userQuery);
      return $userRes;
   }

   public function rememberMe($username,$password){
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
   }
   public function sessionLogin($userRes){
      $userData = mysqli_fetch_assoc($userRes);
      $_SESSION['user_id'] = $userData['id'];
      //redirect to listProduct
      header("Location: .\pages\home.php");
   }
   public function login()
   {
      if (isset($_POST['login'])) {
         if ($this->requiredFeild()) {
            echo "Username or password is empty";
         } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            //check login
            $userRes = $this->findUser($username,$password);
            $userRow = mysqli_num_rows($userRes);
            if ($userRow > 0) {
               
               //remember me
               $this->rememberMe($username, $password);
               //session login
              $this->sessionLogin($userRes);
            } else {
               echo "Username or password is incorrect";
            }
         }
      }
   }
}
