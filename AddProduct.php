<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddProduct</title>
    <link rel="stylesheet" href="./AddProduct.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #FFF8E1 !important;
            box-sizing: border-box !important;
            font-family: 'Arial', sans-serif;
        }

        #addProduct {
            background: #5D4037 !important;
            border-radius: 15px !important;
            padding: 30px !important;
            margin: 50px auto !important;
            width: 40% !important;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1) !important;
        }

        .footer {
            width: 100%;
            background-color: #3b2f23 !important;
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        html,
        body {
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        section {
            flex: 1;
        }

        .navbar {
            background-color: #3b2f23;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: white !important;
        }

        .navbar-brand:hover,
        .navbar-nav .nav-link:hover {
            color: #FFC107 !important;
        }

        #addProduct h3 {
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: bold;
            font-size: 1.1rem;
        }

        .form-control {
            border-radius: 10px !important;
        }

        .form-btns button {
            width: 48%;
            margin: 10px 1%;
        }

        .form-btns button:first-child {
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .form-btns button:last-child {
            background-color: #f44336;
            border-color: #f44336;
        }

        .footer a {
            color: #FFC107;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .select-category {
            width: 75% !important;
        }

        .category-link {
            color: #FFC107;
            text-decoration: none;
        }

        .category-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand text-uppercase fs-4" href="#">Coffee <span class="fs-4 display-5">Blend</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-5 d-flex justify-content-end w-100">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    <a class="nav-link" href="./VIewProducts.php">Products</a>
                    <a class="nav-link" href="#">Users</a>
                    <a class="nav-link" href="#">Manual Order</a>
                    <a class="nav-link" href="screen10.php">Checks</a>
                    <a class="nav-link" href="#" aria-disabled="true">Admin</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- ********************************************************************************************************** -->
    <!-- ********************************************************************************************************** -->
    <section id="addProduct" class="p-4 text-light w-50">
        <h3 class="text-center">Add Product</h3>
        <form action="AddProductConnection.php" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label lead">Product</label>
                <input type="text" class="form-control w-75" name="productName" id="exampleFormControlInput1" placeholder="Product Name">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label lead">Price</label>
                <input type="number" min="10" value="10" name="productPrice" class="form-control w-75" id="exampleFormControlInput1" placeholder="10">
            </div>
            <label for="exampleFormControlInput1" class="form-label lead">Category</label>
            <div class="mb-3 d-flex justify-content-start">
                <select class="form-select form-control select-category" name="productCategory" aria-label="Default select example">
                    <option selected disabled>Open this select menu</option>
                    <?php
                    $connection = new pdo("mysql:host=localhost;dbname=cafeteriaa", "root", "01158353178");
                    try {
                        $stm = $connection->query("select * from categories");
                        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $category) {
                            echo "<option value={$category['id']} >{$category['name']}</option>";
                        }
                    } catch (PDOException $e) {
                        echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
                    }
                    ?>
                </select>
                <a class="category-link ms-3" href="addCategory.php" style="cursor: pointer;"><u>Add Category</u></a>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Product Image</label>
                <input class="form-control w-75" name="productImage" accept="image/*" type="file" id="formFile">
            </div>
            <div class="form-btns d-flex justify-content-between">
                <button type="submit" name="AddSubmit" class="btn btn-success btn-md w-25">Submit</button>
                <button type="reset" class="btn btn-danger btn-md w-25">Reset</button>
            </div>
        </form>
    </section>
    <!-- ********************************************************************************************************** -->
    <!-- ********************************************************************************************************** -->
    <footer class="footer text-white mt-5 py-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Customer service</h5>
                    <a class="text-warning" href="tel:+2010000952" target="_blank">Phone</a><br />
                    <a class="text-warning" href="mailto:coffee.cofee1190002911@gmail.com" target="_blank">Email</a><br />
                    <a class="text-warning" href="https://wa.me//+2010000952" target="_blank" id="whatsapp">Whatsapp</a><br />
                </div>
                <div class="col-sm-6">
                    <h5>Our stores</h5>
                    <a class="text-warning" href="https://www.google.com/maps?q=Cairo,Egypt" target="_blank">Cairo</a><br />
                    <a class="text-warning" href="https://www.google.com/maps?q=Alex,Egypt" target="_blank">Alex</a><br />
                    <a class="text-warning" href="https://www.google.com/maps?q=Menofia,Egypt" target="_blank">Menofia</a><br />
                </div>
            </div>
            <hr class="my-3" />
            <h6>&copy; All rights reserved to Coffee</h6>
        </div>
    </footer>
    <script src="./main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>