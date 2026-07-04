<?php

if (isset($_POST['login'])) {
    include 'partials/_dbconnect.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['username'] = $username;
        echo "<script>alert('login successfully .')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    } else {
        echo "<script>alert('Invalid cartaintiol .')</script>";
    }
}

?>



<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 " id="loginModalLabel">Log in </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <button type="submit" class="btn btn-primary ms-auto d-block" name="login">Log in</button>
                </form>
            </div>

        </div>
    </div>
</div>