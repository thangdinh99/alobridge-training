<?php
require "../controller/productController.php";
$productController = new ProductController();
$tags = $productController->getTags();
if (isset($_POST['addProduct'])) {
    $productController->addProduct();
    if (!$productController->addProduct()) {
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1">Product name</label>
        <input type="text" class="form-control" value="<?php if (isset($_SESSION['name'])) {
                                                            echo $_SESSION['name'];
                                                        }; ?>" name="name" id="name" aria-describedby="productName">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <input type="text" class="form-control" value="<?php if (isset($_SESSION['description'])) {
                                                            echo $_SESSION['description'];
                                                        }; ?>" name="description" id="description">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Price</label>
        <input type="number" class="form-control" value="<?php if (isset($_SESSION['price'])) {
                                                                echo $_SESSION['price'];
                                                            }; ?>" name="price" id="price">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Quantity</label>
        <input type="number" class="form-control" value="<?php if (isset($_SESSION['quantity'])) {
                                                                echo $_SESSION['quantity'];
                                                            }; ?>" name="quantity" id="quantity">
    </div>
    <div class="form-group">
        <label for="file">Thêm ảnh</label>
        <input type="file" class="form-control-file" name="image" id="image" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
        <img id="preview" alt="Preview" width="100" height="100" />
    </div>
    <div class="form-group">
        <div class="form-check form-check-inline">
            <?php foreach ($tags as $tag) { ?>
                <input class="form-check-input" type="checkbox" name="tag[]" id="tag" value="<?php echo $tag['id']; ?>" <?php if (isset($_SESSION['tags'])) {
                                                                                                                            foreach ($_SESSION['tags'] as $tagById) {
                                                                                                                                if ($tag['id'] == $tagById[0]) {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                            }
                                                                                                                        } ?>>
                <label class="form-check-label"><?php echo $tag['name']; ?></label>"
            <?php }; ?>

        </div>
    </div>

    <button type="submit" name="addProduct" class="btn btn-primary">Save</button>
</form>
<script>

</script>