<?php
session_start();
// require "../controller/loginController.php";
// $loginController = new LoginController();
if (!isset($_COOKIE['userLogin'])&&!isset($_SESSION['userLogin'])) { //if login in session is not set
    header("Location: ../index.php");
}


?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="https://kit.fontawesome.com/eb816ba43e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/home.css">
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-2">
                <div class="sidebar">
                    <div class="sidebar-header">
                        <span class="sidebar-header-item">
                            <i class="fab fa-accusoft"></i>
                        </span>
                        <span class="sidebar-header-item" id="sidebar-header-text"> Menu</span>
                        <span class="sidebar-header-item">
                            <i class="fas fa-ellipsis-v"></i>
                        </span>
                    </div>
                    <div class="sidebar-main">
                        <span class="sidebar-main-header"> Navigation</span>
                        <a href="home.php">
                            <div class="sidebar-main-list-item <?php if (!isset($_GET['view'])) {
                                                                    echo "active";
                                                                }; ?> ">
                                <span class="sidebar-main-item">
                                    <i class="fas fa-archway"></i>
                                </span>
                                <span class="sidebar-main-item" id="sidebar-main-text"> Danh s??ch s???n ph???m</span>
                            </div>
                        </a>
                        <a href="home.php?view=add-product">
                            <div class="sidebar-main-list-item <?php if (isset($_GET['view'])) {
                                                                    if ($_GET['view'] == "add-product") echo "active";
                                                                }; ?>">
                                <span class="sidebar-main-item">
                                    <i class="fas fa-archway"></i>
                                </span>
                                <span class="sidebar-main-item" id="sidebar-main-text">Th??m s???n ph???m</span>
                            </div>
                        </a>
                        <a href="#">
                            <div class="sidebar-main-list-item">
                                <span class="sidebar-main-item">
                                    <i class="fas fa-exchange-alt"></i>
                                </span>
                                <span class="sidebar-main-item" id="sidebar-main-text"> Transfer</span>
                            </div>
                        </a>
                        <a href="#">
                            <div class="sidebar-main-list-item">
                                <span class="sidebar-main-item">
                                    <i class="fas fa-align-justify"></i>
                                </span>
                                <span class="sidebar-main-item" id="sidebar-main-text">Transfer</span>
                            </div>
                        </a>

                        <div class="sidebar-main-list-item">
                            <button class="btn btn-primary" onclick="logout()">Logout</button>
                        </div>
                    </div>
                    <div class="sidebar-footer">
                        <div class="change-mode">
                            <button class="btn-light">
                                <span>
                                    <i class="fas fa-sun"></i>
                                </span>
                                <span> Light</span>
                            </button>
                            <button class="btn-dark">
                                <span>
                                    <i class="fas fa-moon"></i>
                                </span>
                                <span> Dark</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Library</li>
                        <li class="breadcrumb-item" aria-current="page">Data</li>

                    </ol>

                </nav>
                <div class="page-content">
                    <?php
                    if (isset($_GET['view'])) {
                        $view = $_GET['view'];
                    } else {
                        $view = 'home';
                    }

                    switch ($view) {

                        case 'add-product':
                            include './addProduct.php';
                            break;

                        case 'home':
                            include './listProduct.php';
                            break;
                        case 'edit-product':
                            include './editProduct.php';
                            break;
                        case 'delete-product':
                            include './deleteProduct.php';
                            break;
                        default:
                            echo "<h4 style='color: red;'>ERROR 404, trang kh??ng t???n t???i <span><a href='index.php' style='color: blue;'>Quay l???i</a></span></h4>";
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        function logout() {
            var r = confirm("B???n c?? mu???n ????ng xu???t?");
            if (r == true) {
                document.cookie = "userLogin=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/alobridge-training/Crud-3-2-2022;";
                location.href="../index.php";
            }
        }
    </script>
</body>

</html>