<?php
require "../controller/productController.php";
$productController = new ProductController();
$product = $productController->getProductById();
if(isset($_POST['deleteProduct'])){
   $productController->deleteProduct();
}
?>
<h1>Bạn thực sự muốn xóa sản phẩm này ?</h1>
<form method="POST">
<div class="col-12">
    <div class="form-horizontal">
        <div class="form-group">
            <div class="row">
                <label for="title" class="control-label col-5">Name</label>
                <div class="controls col-7">
                    <p class="form-control-static"><?php echo $product[0]['name'] ?></p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="title" class="control-label col-5">Price</label>
                <div class="controls col-7">
                    <p class="form-control-static"><?php echo $product[0]['price'] ?></p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="title" class="control-label col-5">Quantity</label>
                <div class="controls col-7">
                    <p class="form-control-static"><?php echo $product[0]['quantity'] ?></p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="title" class="control-label col-5">Description</label>
                <div class="controls col-7">
                    <p class="form-control-static"><?php echo $product[0]['description'] ?></p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="title" class="control-label col-5">Image</label>
                <div class="controls col-7">
                    <img src="../images/<?php echo $product[0]['image'] ?>" width="100" height="100" alt="">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label for="title" class="control-label col-5">Tags</label>
                <div class="controls col-7">
                    <p class="form-control-static"><?php echo $product[0]['tagsname'] ?></p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-danger" name="deleteProduct" type="submit">Xóa</button>
        </div>
    </div>
</div>
</form>
