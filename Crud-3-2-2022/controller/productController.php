<?php
require "../config/myConfig.php";

class ProductController extends Database
{
   public $currentPage;
   public $totalPage;
   public $listResult;
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
   // public function listProduct()
   // {
   //    $sql = "SELECT * FROM products";
   //    $result = $this->getData($sql);
   //    $products = [];
   //    while ($row = $result->fetch_assoc()) {
   //       $products[] = $row;
   //    }
   //    return $products;
   // }

   public function addProduct()
   {
      $name = $_POST['name'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      $image = $_FILES['image']['name'];
      $image_tmp = $_FILES['image']['tmp_name'];
      $image_path = "../public/images/" . $image;
      move_uploaded_file($image_tmp, $image_path);
      $sql = "INSERT INTO products(name, price, description, image) VALUES ('$name', '$price', '$description', '$image')";
      $this->getData($sql);
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
      $sql = "UPDATE products SET is_deleted=true WHERE id = $id";
      $result = $this->getData($sql);
      header("Location: index.php?view=listProduct");
   }
}
