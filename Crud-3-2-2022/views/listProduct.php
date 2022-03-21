<?php
require "../controller/productController.php";
$productController = new ProductController();
$productController->pagination();
$currentPage = $productController->currentPage;
$totalPage = $productController->totalPage;
$listResult = $productController->listResult;
$listProduct = [];
while ($row = $listResult->fetch_assoc()) {
    $listProduct[] = $row;
}
?>
<script>
    var listProduct = <?php echo json_encode($listProduct); ?>;
</script>
<p id="alert"></p>
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
    <tbody id="productTable">
        <script>
            function loadTable() {
                listProduct.forEach(function(product) {
                    var html = `<tr>
                <td>${product.id}</td>
                <td>${product.name}</td>
                <td>${product.price}</td>
                <td>${product.description}</td>
                <td>${product.tagsname}</td>
                <td><img src="../images/${product.image}" width="100px" height="100px"></td>
                <td>
                    <a href="home.php?view=edit-product&id=${product.id}" class="btn btn-primary">Edit</a>
                    <button id="${product.id}" value="${product.id}" onclick="deleteProduct(${product.id})" class="btn btn-danger">Delete</button>
                </td>
                </tr>`;
                    document.getElementById('productTable').innerHTML += html;
                });
            }
            loadTable();
        </script>
    </tbody>
</table>

<nav aria-label="Page navigation" style="text-align: center;">
    <ul class="pagination" style="justify-content: center;display: flex;">
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


<script>
    function deleteProduct(id) {
        if (confirm('Are you sure to delete this product?')) {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                if (this.responseText == 1) {
                    listProduct.splice(listProduct.findIndex(function(i) {
                        return i.id == id;
                    }), 1);
                    document.getElementById('productTable').innerHTML = "";
                    loadTable();
                    window.alert("Delete Successfully");
                } else {
                    window.alert("Error!  Cannot delete");
                }
            }
            xmlhttp.open("GET", "deleteProduct.php?id=" + id, true);
            xmlhttp.send();
        }
    }
</script>