<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./table.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
<style>
    body{
        background: linear-gradient(to right, #4E342E, #8D6E63);
    }
    nav {
    background-color: #3b2f23 !important;
    z-index: 999;
    margin-top: 0rem !important;
}

nav a {
    color: white !important;
}

nav a:hover {
    color: #d2ab86 !important;
}
</style>

</head>

<body>
<nav class="navbar navbar-expand-lg  py-3" >
        <div class="container">
            <a class="navbar-brand text-uppercase fs-4" href="#">Coffee <span class="fs-4 display-5">Blend</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-5 d-flex justify-content-end w-100">
                    <a class="nav-link active" aria-current="page" href="./admin.php">Home</a>
                    <a class="nav-link" href="./VIewProducts.php">Products</a>
                    <a class="nav-link" href="./list.php">Users</a>
                    <a class="nav-link" href="./orders.php">Manual Order</a>
                    <a class="nav-link" href="./check.php">Checks</a>
                    <li class="nav-item "><a class=" nav-link  d-flex align-items-center" id="logoutBtn" href="logout.php"><i class="bi bi-box-arrow-left text-end  fw-bolder mx-1"></i>Logout</a></li>
                        </div>
            </div>
        </div>
    </nav>
    <!-- ********************************************************************************************************** -->
    <!-- ********************************************************************************************************** -->
    <div class="table-container">
        
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="text-center mb-3">All Products</h2>
            <a href="AddProduct.php" class="btn btn-outline-primary fs-5"><i class="bi bi-plus-lg me-3"></i>Add Product</a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Category</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $connection = new pdo("mysql:host=localhost;dbname=php project", "root", "Root@123");
                try {
                    $stm = $connection->query("select * from products");
                    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $category) {
                        echo "<tr>";
                        echo "<td>{$category['id']}</td>";
                        echo "<td>{$category['name']}</td>";
                        echo "<td>{$category['price']}</td>";
                            $stm = $connection->query("select * from categories");
                            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                            foreach($result as $Cat){
                                if($category['category_id'] == $Cat['id']){
                                    echo "<td>{$Cat['name']}</td>";
                                }
                            }
                        echo "<td><img src='img/{$category['image']}' class='user-img' alt=''></td>";
                        echo "<td class='action-buttons'>";
                        echo "<button type='submit' name='view' class='btn btn-sm btn-view' data-bs-toggle='modal' data-bs-target='#userModal{$category['id']}' ><i class='bi bi-eye-fill'></i> View</button>";
                        echo "<button type='submit' name='edit' class='btn btn-sm btn-edit' data-bs-toggle='modal' data-bs-target='#editModal{$category['id']}' ><i class='bi bi-pen-fill'></i> Edit</button>";
                        echo "<form action='deleteProduct.php' method='POST' style='display: inline !important;'>";
                        echo "<input type='hidden' name='productId' value={$category['id']}>";
                        echo "<button type='submit' name='delete' class='btn btn-sm btn-delete'><i class='bi bi-trash-fill'></i> Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                                                /************************************************************/                         /************************************************************/                         /************************************************************/ 
                        echo "<div class='modal fade' id='userModal{$category['id']}' tabindex='-1' aria-labelledby='userModalLabel' aria-hidden='true'>";
                            echo "<div class='modal-dialog modal-dialog-centered'>";
                                echo "<div class='modal-content'>";
                                    echo "<div class='modal-header'>";
                                        echo "<h5 class='modal-title' id='userModalLabel'>Product Details</h5>";
                                        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                                    echo "</div>";
                                    echo "<div class='modal-body text-center'>";
                                        echo "<img src='img/{$category['image']}' alt='Product Image' class=' border border-warning rounded-circle' width='150'>";
                                        echo "<ul class='list-group mt-3'>";
                                            echo "<li class='list-group-item'><strong>ID:</strong> <span id='productId'>{$category['id']}</span></li>";
                                            echo "<li class='list-group-item'><strong>Username:</strong> <span id='productName'>{$category['name']}</span></li>";
                                            echo "<li class='list-group-item'><strong>PRICE:</strong> <span id='productPrice'>{$category['price']}</span></li>";
                                        echo "</ul>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                        /************************************************************/ 
                        /************************************************************/ 
                        echo "<div class='modal fade' id='editModal{$category['id']}' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>";
                            echo "<div class='modal-dialog modal-dialog-centered'>";
                                echo "<div class='modal-content'>";
                                    echo "<div class='modal-header'>";
                                        echo "<h5 class='modal-title'>Edit Product</h5>";
                                        echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                                    echo "</div>";
                                    echo "<div class='modal-body'>";
                                        echo "<form action='updateProduct.php' method='post' enctype='multipart/form-data'>";
                                            echo "<input type='hidden' name='productId' value='{$category['id']}'>";
                                            echo "<div class='mb-3'>";
                                                echo "<label class='form-label'>Product Name</label>";
                                                echo "<input type='text' class='form-control' name='productName' value='{$category['name']}' required>";
                                            echo "</div>";
                                            echo "<div class='mb-3'>";
                                                echo "<label class='form-label'>Price</label>";
                                                echo "<input type='number' min='10' class='form-control' name='productPrice' value='{$category['price']}' required>";
                                            echo "</div>";
                                            echo "<div class='mb-3'>";
                                                echo "<label class='form-label'>Category</label>";
                                                echo "<select class='form-select form-control ' name='productCategory' aria-label='Default select example'>";
                                                echo "<option selected disabled>Open this select menu</option>";
                                                    try{
                                                        $stm = $connection->query("select * from categories");
                                                        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach($result as $Cat){
                                                            if($category['category_id'] == $Cat['id']){
                                                                echo "<option selected value={$Cat['id']} >{$Cat['name']}</option>";
                                                            } else{
                                                                echo "<option value={$Cat['id']} >{$Cat['name']}</option>";
                                                            }
                                                            
                                                        }
                                                    } catch(PDOException $e){
                                                        echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
                                                    } 
                                            echo "</select>";
                                            echo "</div>";
                                            echo "<div class='mb-3'>";
                                            echo "<label for='formFile' class='form-label'>Product Image</label>";
                                            echo "<input class='form-control' name='Image'  accept='image/*' type='file' id='formFile'>";
                                            echo "</div>";
                                            echo "<button type='submit' name='update' class='btn btn-primary'>Update</button>";
                                        echo "</form>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                        /***************************************************************/ 
                    }
                } catch (PDOException $e) {
                    echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
                }

                

                ?>

                <!-- echo "<td><img src='./assets' class='user-img' alt=''></td>"; -->
            </tbody>
        </table>
    </div>
    <!-- ********************************************************************************************************** -->
    <!-- ********************************************************************************************************** -->
    
    <script src="./main.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>