<?php
if (isset($_POST['signup'])) {
  $signup_Confirm = "false";
  include __DIR__ . '/_dbconnect.php';
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $cpassword = $_POST['cpassword'];
  $image = $_FILES['image']['name'];
  $temp_image = $_FILES['image']['tmp_name'];

  if ($password === $cpassword) {
    if ($username != "" && $email != "" && $password != "" && $image != "") {

      $sql = "SELECT * FROM users ";
      $result_sql = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result_sql);
      if ($username != $row['username'] && $email != $row['email']) {

        move_uploaded_file($temp_image, "images/user_images/$image");
        $insert = "INSERT INTO users (username ,email ,	password,image ) VALUES ('$username' ,'$email' , '$hash','$image')";
        $result = mysqli_query($conn, $insert);
        if ($result) {

          $signup_Confirm = "true";
          header("location:index.php?signup_Confirm=true");
        }
      } else {
        $signup_success = "false";
        header("location:index.php?signup_success=false");
      }
    } else {
      $showAlert = "true";
      header("location:index.php?showAlert=true");
    }
  } else {
    $matchPassword = "true";
    header("location:index.php?matchPassword=true");
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