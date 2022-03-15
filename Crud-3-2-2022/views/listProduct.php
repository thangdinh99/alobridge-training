<?php
require "../controller/productController.php";
$productController = new ProductController();
$productController->pagination();
$currentPage = $productController->currentPage;
$totalPage = $productController->totalPage;
$listResult = $productController->listResult;

?>
<table class="table table-hover table-border">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Tags</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $listResult->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['tagsname']; ?></td>
                <td><img src="../images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100px" height="100px"></td>
                <td>
                    <a href="index.php?view=editProduct&id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                    <a href="index.php?view=deleteProduct&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php
        if ($currentPage > 1 && $totalPage > 1) {
            echo '<li class="page-item"><a class="page-link" href="./home.php?page=' . ($currentPage - 1) . '">Previous</a></li>';
        }
        for ($i = 1; $i <= $totalPage; $i++) {

            if ($i == $currentPage) {
                echo '<li class="page-item"><a style="color : black;" class="page-link" href="#">' . $i . '</a></li>';
            } else {

                echo '<li class="page-item"><a class="page-link" href="./home.php?page=' . $i . '">' . $i . '</a></li>';
            }
        }

        if ($currentPage < $totalPage && $totalPage > 1) {
            echo '<li class="page-item"><a class="page-link" href="./home.php?page=' . ($currentPage + 1) . '">Next</a></li>';
        }
        ?>
    </ul>
</nav>