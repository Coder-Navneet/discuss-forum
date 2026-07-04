<?php
if (isset($_POST['signup'])) {

  include 'partials/_dbconnect.php';
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $image = $_FILES['image']['name'];
  $temp_image = $_FILES['image']['tmp_name'];

  if ($password === $cpassword) {
    if ($username != "" && $email != "" && $password != "" && $image != "") {

      $sql = "SELECT * FROM users ";
      $result_sql = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result_sql);
      if ($username !== $row['username']) {

        move_uploaded_file($temp_image, "images/user_images/$image");
        $insert = "INSERT INTO users (username ,email ,	password,image ) VALUES ('$username' ,'$email' , '$password','$image')";
        $result = mysqli_query($conn, $insert);
        if ($result) {
          echo "<script>alert('ragistration successfully .')</script>";
        }
      } else {
        echo "<script>alert('username already eixed please try another username .')</script>";
      }
    } else {
      echo "<script>alert('please fill all the fildes .')</script>";
    }
  } else {
    echo "<script>alert('password does not match ')</script>";
  }
}

?>



<!-- Modal -->
<div class="modal fade" id="signinModel" tabindex="-1" aria-labelledby="signinModelLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="signinModelLabel">Sign in </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="username" class="form-label">User Name</label>
            <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>
          <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword" id="cpassword">
          </div>
          <div class="mb-3">
            <label for="image" class="form-label">User Image</label>
            <input type="file" class="form-control" name="image" id="image">
          </div>

          <button type="submit" class="btn btn-primary ms-auto d-block" name="signup">Sign up</button>
        </form>
      </div>

    </div>
  </div>
</div>