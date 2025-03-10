





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    <style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        margin-top: 40px;
        background-color: #FFF8E1 !important;
        color:#6D4C41;
    }


    .content {
        flex: 1;
        background-color: rgba(255, 255, 255, 0.2);
        padding: 20px;
        margin-top: 40px;
    }


    nav {
        background-color: #6b4f3b !important;
        z-index: 999;
    }

    nav a {
        color: white !important;
    }

    nav a:hover {
        color: #d2ab86 !important;
    }



    .content {
        margin-top: 5rem;
        flex: 1;
    }

#IMG{
    height: 600px;
}
#IMGmenu{
    /* background: #6D4C41; */
    background: #6B4F3B;
    /* background: #d2ab98; */
    border-radius: 10px;
    color: white;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

.btncard{
    background-color: white;
    color: black;
    border: none;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    width: 100%;
    cursor: pointer;
    transition: background 0.3s;
    text-decoration: none;

}
/* about */
.btncard:hover{
    background-color:rgb(0, 0, 0);
    color: white;
}

.about {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            padding: 50px;
            background-color: #6b4f3b;
            color: white;
            max-width: 900px;
            margin: auto;
            border-radius: 12px;
            margin-top:15%;
            
        }
        .about-img{
            margin-left:-15%;
            margin-top:2%;
        }
        .about-img img {
            max-width: 100%;
            border-radius: 8px;
           
        }
        .about-content {
            flex: 1;
            width: 100%;
        }
        .about-cap h2 {
            font-size: 32px;
            margin-bottom: 10px;
            
            font-weight:900;
           
        }
        .about-cap p {
            font-size: 16px;
            line-height: 1.6;
        }
        .about-cap button {
            background: white;
            color: #6b4f3b;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.3s;
        }
        .about-cap button:hover {
            background: #ddd;
        }

        /* servicse */

        .service{
    position: relative;
    width :90%;
    margin: 7rem auto;
    height: 500px;
    /* padding: 100px 0px; */
  }
  .service .service-header{
    position: absolute;
    text-align: center;
    width: 50%;
    height: 40px;
    left: 25%;
    
  }
  .service .service-header h2{
    font-size: 53px;
    color: var(--first-color);
  }
  .service .service-header p{
    font-weight: 500;
    font-size: 18px;
    color: #808086;
    margin-top: 1rem;
  }
  .service .main-content{
    display: flex;
    top: 4rem;
    position: absolute;
    left: 5%;
    justify-content: center;
    
  }
  .service .main-content i{
    color: var(--first-color);
    font-size: 50px;
    margin-top: 1rem;
    margin-left: 4.3rem ;
  }
  .service .main-content h3{
    font-size: 25px;
    color: rgb(114, 82, 59);
    margin-left: 1.3rem;
  }
  .service .main-content p{
    font-size: 18px;
    color: #808086;
    line-height: 60px;
  }


  /* footer */
  .footer{
                background-color: #6b4f3b !important;
                width: 100%;
            } 
            
            .footer .btn.btn-social {
                margin-right: 5px;
                width: 35px;
                height: 35px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--HEading);
                border: 1px solid rgba(14, 13, 13, 0.5);
                border-radius: 35px;
                transition: .3s;
            }
            
            .footer .btn.btn-social:hover {
                color: var(--primary);
                border-color: var(--light);
            }
            
            .footer .btn.btn-link {
                display: block;
                margin-bottom: 5px;
                padding: 0;
                text-align: left;
                font-size: 15px;
                font-weight: normal;
                text-transform: capitalize;
                transition: .3s;
            }
            
            .footer .btn.btn-link::before {
                position: relative;
                content: "\f105";
                font-family: "Font Awesome 5 Free";
                font-weight: 900;
                margin-right: 10px;
            }
            
            .footer .btn.btn-link:hover {
                letter-spacing: 1px;
                box-shadow: none;
            }
            
            .footer .form-control {
                border-color: rgba(255,255,255,0.5);
            }
            
            .footer .copyright {
                padding: 25px 0;
                font-size: 15px;
                border-top: 1px solid rgba(256, 256, 256, .1);
            }
            
            .footer .copyright a {
                color: var(--light);
            }
            
            .footer .footer-menu a {
                margin-right: 15px;
                padding-right: 15px;
                border-right: 1px solid rgba(255, 255, 255, .1);
            }
.CardImg{
    object-fit: cover !important;
}
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="margin-top:-40px;">
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
                    <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartCanvas">
                <i class="bi bi-cart"></i> View Cart
            </button>
            <!-- <form action="logout.php">
                </form> -->
                <!-- <a href="logout.php" class="nav-link p-3"><i class="bi bi-box-arrow-left"></i>Log Out</a> -->
                <li class="nav-item "><a class=" nav-link  d-flex align-items-center" id="logoutBtn" href="logout.php"><i class="bi bi-box-arrow-left text-end  fw-bolder mx-1"></i>Logout</a></li>
                        </div>
            </div>
        </div>
    </nav>



<div id="carouselExampleCaptions" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img  id="IMG" src="./assets/images/slider1.jpg" class="d-block w-100" alt="...">
     
    </div>
    <div class="carousel-item">
      <img  id="IMG" src="./assets/images/slider2.jpg" class="d-block w-100" alt="...">
     
    </div>
    <div class="carousel-item">
      <img  id="IMG" src="./assets/images/slider3.jpg" class="d-block w-100" alt="...">
     
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>




<?php
$host = 'localhost';
$dbname = 'php project';
$username = 'root';
$password = 'Root@123';

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

// استعلام لجلب user_id من جدول users
$sql = "SELECT id, username FROM users";
$result = $connection->query($sql);
?>

<div  class="dropdown-container mt-5" style="margin-left: 20rem;">
        <label for="userDropdown" class="for-lable fs-5 lead">Choose user:</label>
        <br>
        <select id="userDropdown" class="form-select w-25" name="user_id">
            <option value="" selected disabled>Select a user</option>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['username'] . " (ID: " . $row['id'] . ")</option>";
                }
            } else {
                echo "<option value=''>No users found</option>";
            }

            ?>
        </select>
</div>



<div class= "menu" style="margin-top:60px;">
    
    <div class="container">
        
        <div class="menu-contain">
        <div data-aos="fade-up">
            <h2 class="text-center w-60" style="width:300px; margin: auto;">OUR CAFE MENU </h2>
        </div>
        </div>

        <div class="container-fluid text-center">
  <div class="row mt-5">

  <?php








$connection = new pdo("mysql:host=localhost;dbname=php project", "root", "Root@123");
try {
    $stm = $connection->query("select * from products");
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $category) {
        echo "<div class='col-4 mt-5' style='display: flex; justify-content: space-evenly !important; '>";
        echo "<div data-aos='zoom-in'>";
            echo "<div id='IMGmenu' class='card' style='width: 18rem !important;'>";
              echo "<img  src='./img/{$category['image']}' class='card-img-top CardImg' style='width: 18rem !important; height: 14rem;' alt=''>";
               echo " <div class='card-body'>";
               echo "<h5 class='card-title' data-id='{$category['name']}'>{$category['name']}</h5>";
               echo "<p class='card-text' data-id='{$category['price']}'>Price: {$category['price']}</p>";
                    echo "<a href='#' class='btncard AddToCart' data-id='{$category['id']}' data-name='{$category['name']}' data-price='{$category['price']}'> <i class='bi bi-plus-lg ' id='plus'> </i> Add to cart</a>";

                echo "</div>";
            echo "</div>";
        echo "</div>";
        echo "</div>";
    }
}
catch (PDOException $e) {
    echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
}

?>

<div data-aos="flip-up" data-aos-duration="3000">
 <div class="about" id="about">
        <section class="about-img">
          <img src="./assets/images/cafe.jpg" alt="" style="width: 600px;">
        </section>
        <section class="about-content" >
          <section class="about-cap">
            <h2>
              About our Cafe</h2>
              <p class="first-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.</p>
              <p class="second-p">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique. Duis cursus, mi quis viverra ornare.</p>
              <button>more about us</button>
          </section>
        </section>
      </div>
      </div>

      <div data-aos="fade-up"
     data-aos-duration="3000">


      <section class="service" id="services">
        <section class="service-header ">
        <h2> our service </h2>
        <p>We offer you all drinks and sweets made with special ingredients...</p>
        </section>
        <section class="main-content">
            <section class="service">
                <h3 class="mt-5">Hot Drinks</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in</p>
            </section>
            <section class="service">
                <h3 class="mt-5">Cold Drinks</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in</p>
            </section>
            <section class="service">
                <h3 class="mt-5">Dessert</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in</p>
            </section>
            <section class="service">
                <h3 class="mt-5">Breakfast</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in</p>
            </section>
            
        </section>
        
</section>

</div>



<!-- Contact Us  -->
 <div data-aos="fade-up"
     data-aos-duration="3000">

 <section class="contact-section m-5 rounded overflow-hidden" id="contact" style="background-color:#fff;">
      <div class="row g-3 align-items-stretch" style="min-height: 500px;">
          <!-- Left: Image -->
          <div class="col-md-6">
              <img src="./assets/images/contact.jpg" alt="Contact Us" class="img-fluid w-100 h-100" style="object-fit: cover; min-height: 100%;">
          </div>
  
          <!-- Right: Contact Form -->
          <div class="col-md-6 d-flex align-items-center p-5 bg-white">
              <div class="w-100">
                  <h3 class="mb-4 " style="color:#493628;">Contact with us</h3>
                  <p class="fs-5">Contact us and we're avilable daily from 10:00AM to 12:00AM.</p>
  
                  <form>
                      <div class="row g-3">
                          <div class="col-md-6">
                              <input type="text" class="form-control" id="name" placeholder="Enter your name">
                          </div>
                          <div class="col-md-6">
                              <input type="email" class="form-control" id="email" placeholder="Enter your email">
                          </div>
                      </div>
                      <div class="my-3">
                          <textarea class="form-control" id="query" rows="4" placeholder="Write your message"></textarea>
                      </div>
                      <div class="text-end">
                          <button type="submit" class="btn px-4 fw-bold" style="background-color:#493628; color:#fff;">Send</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </section>
</div>


<section class="footer mt-5" style="width:2000px;">
          <div class="container-fluid  text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
              <div class="container py-5" >
                  <div class="row g-5">
                      <div class="col-lg-3 col-md-6">
                          <h5 class="text-white mb-4">COFFEE BLEND</h5>
                          <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, Menofia, Egypt</p>
                          <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                          <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                          <div class="d-flex pt-2">
                              <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                              <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                              <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                              <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-6">
                          <h5 class="text-white mb-4">Quick Links</h5>
                          <a class="btn btn-link text-white-50" href="">About Us</a>
                          <a class="btn btn-link text-white-50" href="">Contact Us</a>
                          <a class="btn btn-link text-white-50" href="">Our Services</a>
                          <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                          <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                      </div>
                      <div class="col-lg-3 col-md-6">
                          <h5 class="text-white mb-4">Photo Gallery</h5>
                          <div class="row g-2 pt-2">
                              <div class="col-4">
                                  <img class="img-fluid rounded bg-light p-1" src="https://images.pexels.com/photos/414630/pexels-photo-414630.jpeg?auto=compress&cs=tinysrgb&w=600" alt="">
                              </div>
                              <div class="col-4">
                                  <img class="img-fluid rounded bg-light p-1" src="https://images.pexels.com/photos/773958/pexels-photo-773958.jpeg?auto=compress&cs=tinysrgb&w=600" alt="">
                              </div>
                              <div class="col-4">
                                  <img class="img-fluid rounded bg-light p-1" src="https://images.pexels.com/photos/302902/pexels-photo-302902.jpeg?auto=compress&cs=tinysrgb&w=600" alt="">
                              </div>
                              <div class="col-4">
                                  <img class="img-fluid rounded bg-light p-1" src="https://images.pexels.com/photos/1749303/pexels-photo-1749303.jpeg?auto=compress&cs=tinysrgb&w=600" alt="">
                              </div>
                              <div class="col-4">
                                  <img class="img-fluid rounded bg-light p-1" src="https://images.pexels.com/photos/414628/pexels-photo-414628.jpeg?auto=compress&cs=tinysrgb&w=600" alt="">
                              </div>
                              <div class="col-4">
                                  <img class="img-fluid rounded bg-light p-1" src="https://images.pexels.com/photos/1727123/pexels-photo-1727123.jpeg?auto=compress&cs=tinysrgb&w=600" alt="">
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-6">
                          <h5 class="text-white mb-4">Get in touch</h5>
                          <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                          <div class="position-relative mx-auto" style="max-width: 400px;">
                              <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                              <button type="button" class="btn bg-light py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                          </div>
                      </div>
                  </div>
              </div>
              
      </section> 
    


<!-- offcanvascart -->

<div class="offcanvas offcanvas-end bg-dark text-white" id="cartCanvas">
    <form action="ConfirmOrder.php" method="post">
    <div class="offcanvas-header">
        <h5>Shopping Cart</h5>
        <button type="button" class="btn btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body text-start">

        <div id="cart-items"></div>

            <p class="mt-3">Notes</p>
            <input class="form-control" type="text" placeholder="Add your comment"/>
            <input type="hidden" name="UserId" id="UserId" value="">
            <?php
            echo "<div class='mb-3'>";
            echo "<label class='form-label mt-3'>Room</label>";
            echo "<select class='form-select form-control ' name='Room' aria-label='Default select example'>";
            echo "<option selected disabled>Select Room</option>";
                try{
                    $stm = $connection->query("select * from rooms");
                    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                    foreach($result as $Cat){

                            echo "<option value={$Cat['room_number']} >{$Cat['room_number']}</option>";
                    }
                } catch(PDOException $e){
                    echo "<div class='alert alert-danger' role='alert'> A simple danger alert—check it out!</div>";
                } 
                echo "</select>";


            ?>
            <hr>
            <p class="mt-3" id="cart-total">Total: 0 LE</p>

                <button class="btncard" type="submit" class="btn btn-success w-100 mt-3" id="checkout-btn">Confirm</button>
        </form>
        </div>
    </div>


    <!-- JS -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
   
<script>
document.addEventListener("DOMContentLoaded", function () {
    let cart = JSON.parse(sessionStorage.getItem("cart")) || [];
    updateCartDisplay();

    document.querySelectorAll(".AddToCart").forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const product = {
                ID: parseInt(this.dataset.id),
                name: this.dataset.name,
                price: parseInt(this.dataset.price),
                quantity: 1
            };
            addToCart(product);
        });
    });

    function addToCart(product) {
        const existingItem = cart.find(item => item.ID === product.ID);
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            cart.push(product);
        }
        sessionStorage.setItem("cart", JSON.stringify(cart));
        updateCartDisplay();
    }

    function updateCartDisplay() {
        const cartList = document.getElementById("cart-items");
        const cartTotal = document.getElementById("cart-total");
        cartList.innerHTML = "";
        let total = 0;
        cart.forEach(item => {
            total += item.price * item.quantity;
            cartList.innerHTML += `
                <div class='d-flex justify-content-between border-bottom p-2'>
                    <span>${item.name} x${item.quantity}</span>
                    <div>
                        <button class='btn btn-sm btn-outline-secondary' onclick='changeQuantity(${item.ID}, -1)'>-</button>
                        <button class='btn btn-sm btn-outline-secondary' onclick='changeQuantity(${item.ID}, 1)'>+</button>
                        <button class='btn btn-sm btn-danger' onclick='removeItem(${item.ID})'>x</button>
                    </div>
                </div>`;
        });
        cartTotal.textContent = `Total: ${total} LE`;
    }

    window.changeQuantity = function (id, change) {
        const item = cart.find(p => p.ID === id);
        if (item) {
            item.quantity += change;
            if (item.quantity <= 0) {
                cart = cart.filter(p => p.ID !== id);
            }
        }
        sessionStorage.setItem("cart", JSON.stringify(cart));
        updateCartDisplay();
    };

    window.removeItem = function (id) {
        cart = cart.filter(p => p.ID !== id);
        sessionStorage.setItem("cart", JSON.stringify(cart));
        updateCartDisplay();
    };

    let selectedValue;
    let UserId = document.getElementById("UserId");
    console.log(UserId);
        document.getElementById("userDropdown").addEventListener("change", function() {
        selectedValue = parseInt(this.value);
        UserId.value = selectedValue;
        console.log(UserId)
});
    document.getElementById("checkout-btn").addEventListener("click", function () {
        let cartData = sessionStorage.getItem("cart");
        
        fetch("ConfirmOrder.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ cart: cartData })
        })
        .then(response => response.json())
        .then(data => console.log(data)) // Debug response
        .catch(error => console.error("Error:", error));
        sessionStorage.removeItem("cart");
        updateCartDisplay();
    });
});



</script>



<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
</body>

</html>