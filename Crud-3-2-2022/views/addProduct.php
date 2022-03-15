<?php
require "../controller/productController.php";
$productController = new ProductController();
$tags = $productController->getTags();
if(isset($_POST['addProduct'])){
    $productController->addProduct();
    
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1">Product name</label>
        <input type="text" class="form-control" name="name" id="name" aria-describedby="productName">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <input type="text" class="form-control" name="description" id="description">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Price</label>
        <input type="number" class="form-control" name="price" id="price">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Quantity</label>
        <input type="number" class="form-control" name="quantity" id="quantity">
    </div>
    <div class="form-group">
        <label for="file">thêm ảnh</label>
        <input type="file" class="form-control-file" name="image" id="image">
    </div>
    <div class="form-group">
        <div class="form-check form-check-inline">
            <?php foreach($tags as $tag) { ?>
                <input class="form-check-input" type="checkbox" name="tag[]" id="tag" value="<?php echo $tag['id']; ?>">
                <label class="form-check-label" ><?php echo $tag['name'];?></label>"
           <?php }; ?>
            
        </div>
    </div>

    <button type="submit" name="addProduct" class="btn btn-primary">Save</button>
</form>