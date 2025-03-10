<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="./AddProduct.css">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
    background-color: #FFF8E1 !important;
    box-sizing: border-box !important;
}
#addCategory{
    background: #5D4037 !important;
    border-radius: 10px !important;
    padding: 20px !important;
    margin: 50px auto !important;
    max-width: 900px !important;
    box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3) !important;
    
}
.back-btn {
    position: fixed;
    bottom: 20px;
    left: 20px;
    padding: 10px 20px;
}
body{
        background: linear-gradient(to right, #4E342E, #8D6E63);
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
<section id="addCategory" style="margin-top: 15rem !important;" class="p-4 text-light w-50">
        <a href="AddProduct.php" class="btn btn-danger text-start" style="position: absolute;"><i class="bi bi-arrow-left me-3"></i>Back</a>
        <h2 class="text-center mb-4">Add Category</h2>
        
        <form action="AddCategoryConnection.php" class="" method="post">
            <div class="mb-3">
                <label for="exampleFormControlInput12" class="form-label lead">Product</label>
                <input type="text" class="form-control w-75" name="CategoryName" id="exampleFormControlInput12" placeholder="Category Name">
            </div>
            <div class="" id="formBtns">
            <button type="submit" class="btn btn-success btn-md w-25">Submit</button>
            <button type="reset" class="btn btn-danger btn-md w-25">Reset</button>
           </div>
        </form>
    </section>
<!-- ********************************************************************************************************** -->
<!-- ********************************************************************************************************** -->

    <script src="./main.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>