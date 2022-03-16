<?php
require "../controller/productController.php";
$productController = new ProductController();
$product = $productController->getProductById();
if(isset($_POST['updateProduct'])){
    $productController->updateProduct();
}
?>
<h1>Update product</h1>
<form method="POST" enctype="multipart/form-data">
    <div class="col-12">
        <div class="form-horizontal">
            <div class="form-group">
                <div class="row">
                    <label for="title" class="control-label col-5">Name</label>
                    <div class="controls col-7">
                        <input type="text" name="name" class="form-control" value="<?php echo $product[0]['name'] ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="title" class="control-label col-5">Price</label>
                    <div class="controls col-7">
                        <input type="text" name="price" class="form-control" value="<?php echo $product[0]['price'] ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="title" class="control-label col-5">Quantity</label>
                    <div class="controls col-7">
                        <input type="text" name="quantity" class="form-control" value="<?php echo $product[0]['quantity'] ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="title" class="control-label col-5">Description</label>
                    <div class="controls col-7">
                        <textarea name="description" class="form-control"><?php echo $product[0]['description'] ?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="title" class="control-label col-5">Image</label>
                    <div class="controls col-7">
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label for="title" class="control-label col-5">Tags</label>
                    <div class="controls col-7">
                        
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="controls col-7">
                        <input type="submit" name="updateProduct" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>