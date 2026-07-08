<?php

session_start();

?>
<header>
  <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="./">Discuss</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./about.php">about</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="./category.php" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Category
            </a>

            <ul class="dropdown-menu">
              <?php

              $sql = "SELECT * FROM categories";
              $result = mysqli_query($conn, $sql);

              while ($row = mysqli_fetch_assoc($result)) {
                $category_name = $row['category_name'];
                $category_id = $row['category_id'];
                echo '
                <li><a class="dropdown-item" href="threadslist.php?category_id='.$category_id.'">'.$category_name.'</a></li>';
              }
              ?>

            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link " href="./contact.php">Contact</a>
          </li>
        </ul>
        <form class="d-flex " role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-success" type="submit">Search</button>
        </form>
        <div class="ms-3">
          <?php
          if (!isset($_SESSION['username'])) {

            echo '<button class="btn btn-outline-primary me-3" data-bs-toggle="modal" data-bs-target="#loginModal">log in</button>
            <button class="btn btn-outline-success me-3" data-bs-toggle="modal" data-bs-target="#signinModel">sign in</button> ';
          } else {
            $username = $_SESSION['username'];
            echo "<p class='d-inline px-3 text-light text-decoration-underline fs-4'>" . strtoupper($username) . "</p>";
            echo '  <a href="partials/_logout.php" class=" btn btn-outline-primary">log out </a> ';
          } ?>
        </div>
      </div>
    </div>
  </nav>
</header>


<?php
include '_loginModel.php';
include '_signinModel.php';
?>