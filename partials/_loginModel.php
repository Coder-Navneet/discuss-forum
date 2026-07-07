<?php
if (isset($_POST['login'])) {
                    $login_success = 'false';

    include './partials/_dbconnect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];


    if ($username != "" && $password != "") {

        $sql = "SELECT * FROM  users WHERE  username = '$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if (($num > 0) == true) {
            $row = mysqli_fetch_assoc($result);
            $pass = $row['password'];
            if (password_verify($password, $row['password'])) {
                // echo "connection successfull";
                session_start();
                $_SESSION['username']  = $username ;
                $_SESSION['username']  = $username ;
                $login_success = 'true';
                header('location:index.php?login_success=true');
            }else{
                $matchPassword = 'true';
                header('location:index.php?matchPassword=true');
                }
                } else {
                    $user_not_found = 'true' ;
                    header('location:index.php?user_not_found=true');
                    }
                    } else {
        $showAlert = 'true' ;
        header('location:index.php?showAlert=true');
    }
}

?>




<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">x
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