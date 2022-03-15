<?php
require "../config/myConfig.php";

class ProductController extends Database
{
   public $currentPage;
   public $totalPage;
   public $listResult;
   public $imageFile;
   public function __construct()
   {
   }

   public function pagination()
   {

      $this->listResult = $this->getData("SELECT COUNT(*) as total FROM products");
      $row = $this->listResult->fetch_assoc();
      $totalRecord = $row['total'];
      $this->currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
      $limit = 5;
      $this->totalPage = ceil($totalRecord / $limit);
      if ($this->currentPage > $this->totalPage) {
         $this->currentPage = $this->totalPage;
      } else if ($this->currentPage < 1) {
         $this->currentPage = 1;
      }
      $start = ($this->currentPage - 1) * $limit;
      $this->listResult = $this->getData("SELECT products.id,products.name,products.description,products.price,products.image,
      GROUP_CONCAT(tags.name) as 'tagsname'
      FROM products LEFT JOIN product_tag ON products.id = product_tag.product_id LEFT JOIN tags ON product_tag.tag_id=tags.id
      GROUP BY products.id LIMIT $start, $limit");
   }

   public function checkName($name)
   {
      $sql = "SELECT * FROM products WHERE name = '$name'";
      $result = $this->getData($sql);
      if ($result->num_rows > 0) {
         return false;
      }
      return true;
   }

   public function validateFile()
   {
      if (isset($_FILES['image'])) {
         $image = $_FILES['image'];
         $imageName = $image['name'];
         $imageTmp = $image['tmp_name'];
         $imageSize = $image['size'];
         $imageError = $image['error'];
         $imageType = $image['type'];
         $imageExt = explode('.', $imageName);
         $imageActualExt = strtolower(end($imageExt));
         $imageAllowedExt = array('jpg', 'jpeg', 'png');
         if (in_array($imageActualExt, $imageAllowedExt)) {
            if ($imageError === 0) {
               if ($imageSize < 1000000) {
                  $imageNameNew = uniqid('', true) . "." . $imageActualExt;
                  $imageDestination = '../images/' . $imageNameNew;
                  move_uploaded_file($imageTmp, $imageDestination);
                  $this->imageFile = $imageNameNew;
                  return true;
               } else {
                  echo "Your image is too big";
                  return false;
               }
            } else {
               echo "There was an error uploading your image";
               return false;
            }
         } else {
            echo "You cannot upload files of this type";
            return false;
         }
      }
   }
   public function validateForm( $name, $description, $price, $quantity, $tags){
         if(empty($name) || empty($description) || empty($price) || empty($quantity) || empty($image) || empty($tags) || !is_numeric($quantity) || !is_numeric($price) || $quantity < 0 || $price < 0){
            return false;
         }
         return true;
      
   }
   public function addProduct()
   {

      $name = $_POST['name'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $quantity = $_POST['quantity'];
      $tags = $_POST['tag'];
      if(!$this->validateForm( $name, $description, $price, $quantity, $tags)){
         echo   "Fill all information";
      }
      elseif (!$this->checkName($name)) {
         echo "The product name was already existed";
      } elseif (!$this->validateFile()) {
         echo "File has error : ";
      } else {
         $sql = "INSERT INTO products (name,price,description,quantity,image) VALUES ('$name','$price','$description','$quantity','$this->imageFile')";
         $result = $this->getData($sql);
         if ($result) {
            foreach ($tags as $tag) {
               $sql = "INSERT INTO product_tag(product_id,tag_id) VALUES((SELECT id FROM products ORDER BY id DESC LIMIT 1),(SELECT id FROM tags WHERE id='$tag'))";
               $result = $this->getData($sql);
            }
            echo("<script>location.href = './home.php';</script>");
         } else {
            echo "Some error occur when insert data";
         }
      }
      
   }
   public function getTags()
   {
      $sql = "SELECT * FROM tags";
      $result = $this->getData($sql);
      $tags = [];
      while ($row = $result->fetch_assoc()) {
         $tags[] = $row;
      }
      return $tags;
   }
   public function getTagsById(){

   }
   public function editProduct()
   {
      $id = $_GET['id'];
      $sql = "SELECT * FROM products WHERE id = $id";
      $result = $this->getData($sql);
      $product = $result->fetch_assoc();
      return $product;
   }

   public function updateProduct()
   {
      if (isset($_POST['update'])) {
         $id = $_POST['id'];
         $name = $_POST['name'];
         $price = $_POST['price'];
         $description = $_POST['description'];
         $sql = "UPDATE products SET name = '$name', price = '$price', description = '$description' WHERE id = $id";
         $this->getData($sql);
      }
   }

   public function deleteProduct()
   {
      $id = $_GET['id'];
      $sql = "UPDATE products SET is_deleted=1 WHERE id = $id";
      $result = $this->getData($sql);
      header("Location: index.php?view=listProduct");
   }
}
