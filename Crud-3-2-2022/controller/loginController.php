<?php
require "./config/myConfig.php";
class LoginController extends Database
{
   const COOKIE_EXPIRED_TIME = 3600 * 24 * 7;  
   public function __construct()
   {
      $this->login();
   }
   public function getData($sql) {

      $db = Database::getInstance();
      $mysqli = $db->getConnection(); 
      $result = $mysqli->query($sql);
      $db->disConnect();
      return $result;
  }

   public function requiredFeild(){
      return (empty($_POST['username']) || empty($_POST['password']));
   }
   public function findUser($username, $password){
      $userQuery = "SELECT * from users where username='$username' AND password='$password'";
      return $this->getData($userQuery);
      // return $this->run()->query($userQuery);
   }

   public function rememberMe($username,$password){
      if (!empty($_POST['remember'])) {
         $rememberCheckbox = $_POST['remember'];
         ///set cookie
         setcookie('username', $username,time() + self::COOKIE_EXPIRED_TIME);
         setcookie('password', $password,time() + self::COOKIE_EXPIRED_TIME);
         setcookie('userLogin', $rememberCheckbox,time() + self::COOKIE_EXPIRED_TIME);
      } else {
         //expire cookie
         setcookie('username', $username, 30);
         setcookie('password', $password, 30);
      };
   }
   public function redirectToLogin($userRes){
      $userData = mysqli_fetch_assoc($userRes);
      $_SESSION['user_id'] = $userData['id'];
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
            if ($userRes->num_rows > 0) {

               //remember me
               $this->rememberMe($username, $password);
               //redirect login
              $this->redirectToLogin($userRes);
            } else {
               echo "Username or password is incorrect";
            }
         }
      }
   }
}
