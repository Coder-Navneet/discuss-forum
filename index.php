<?php
include "partials/_dbconnect.php";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Discuss - Codeing Forums</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .carousel-item>img {
            height: 60vh;
            width: 100vw;
        }
    </style>
</head>

<body>
    <?php include 'partials/_header.php';

    if (isset($_GET['signup_Confirm']) == "true") {
        echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
  <strong>registration successful </strong> now you can log in
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    
     else if (isset($_GET['signup_success']) == "false") {
        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
  <strong>username already exists </strong> please try another username
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }


  else  if (isset($_GET['showAlert']) == "true") {
        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
   please fill all the fields <strong>!</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

 else   if (isset($_GET['matchPassword']) == "true") {
        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
    password  not match <strong></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

   else if (isset($_GET['login_success']) == "true") {
        echo '<div class="alert alert-success m-0 alert-dismissible fade show" role="alert">
   <strong></strong> login successfully 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    } 
    
   else  if (isset($_GET['user_not_found']) == "false") {
        echo '<div class="alert alert-danger m-0 alert-dismissible fade show" role="alert">
   <strong></strong> Invalid cartaintiol 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }




    ?>

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/hero_image.jpg" class="d-block " alt="...">
            </div>

            <div class="carousel-item">
                <img src="images/hero_image_3.jpg" class="d-block " alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Categoru Container start here  -->
    <div class="container my-3">
        <h1 class="text-center">idiscuss Browse Category</h1>

        <div class="row my-5">
            <!-- fetch all the category  -->
            <?php

            $sql  = "SELECT *  FROM categories";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $category_id = $row['category_id'];
                $category_name = $row['category_name'];
                $category_description = $row['category_description'];


                echo '
                    <div class="col-4 my-3 ">

                <div class="card" style="width: 18rem;">
                    <img src="images/hero_image.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"> <a href="threadslist.php?category_id=' . $category_id . '"  class= "text-decoration-none">' . $category_name . '</a></h5>
                        <p class="card-text">' . substr($category_description, 0, 90) . '...</p>
                        <a href="threadslist.php?category_id=' . $category_id . '" class="btn btn-primary">View Treads</a>
                    </div>
                </div>
            </div>
                
                ';
            }

            ?>


        </div>
    </div>
    <?php include 'partials/_footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>