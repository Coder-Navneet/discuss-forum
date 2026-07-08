<?php
include 'partials/_dbconnect.php';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <style>
        #ques {
            min-height: 443px;
        }
    </style>
</head>

<body>
    <?php include 'partials/_header.php'; ?>
    <div class="container my-3">
        <?php

        $id = $_GET['thread_id'];

        $threds_sql = "SELECT * FROM threads WHERE thread_id  = $id";
        $threads_result = mysqli_query($conn, $threds_sql);

        while ($threads_row = mysqli_fetch_assoc($threads_result)) {
            $thread_id = $threads_row['thread_id'];
            $thread_title = $threads_row['thread_title'];
            $thread_desc = $threads_row['thread_desc'];
            $user_id = $threads_row['thread_user_id'];

            $user_query = "SELECT * FROM users WHERE user_id = '$user_id' ";
            $user_result = mysqli_query($conn, $user_query);
            $user_row = mysqli_fetch_assoc($user_result);
            $user_name = $user_row['username'];


        ?>
            <div class="p-5 mb-4 bg-body-secondary rounded-3  mx-auto w-75">
                <div class="container-fulid">
                    <h1 class="display-6"><?php echo $thread_title; ?></h1>
                    <p class=" "><?php echo $thread_desc; ?></p>
                    <hr>
                    <div>
                        <p class="mb-0">some rules to use in chat. / Be respectful: No insults, personal attacks, or
                            harassment. / Stay on topic: Keep posts relevant to the thread's subject. / No spam: Do not post
                            ads, promotional links, or repetitive content. / No illegal content: Do not share pirated
                            material, NSFW content, or private data. </p>

                    </div>
                    <div>
                        <p class="pt-2">powerd by - <strong> <?php echo $user_name; ?></strong></p>
                    </div>
                </div>
            </div>
    </div>
<?php
        }
?>
<div class="container my-5 " id="ques">
    <div class="mx-auto w-75">
        <div>
            <?php
            $thread_id = $_GET['thread_id'];
            if (isset($_POST['commentSubmit'])) {
                $comment = $_POST['comment_content'];
                $comment = str_replace(">", "&gt", $comment);
                $comment = str_replace("<", "&lt", $comment);

                $user_id = $_POST['user_id'];



                if ($comment != "") {
                    $ques = "INSERT INTO comments (comment_content,thread_id , comment_by) VALUES ('$comment','$thread_id','$user_id')";
                    $ques_result = mysqli_query($conn, $ques);
                    if ($ques_result) {
                        echo '  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Success !</strong> Your Question submited  .
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                    }
                } else {

                    echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>please !</strong>  fill comment after submit  .
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                }
            }
            ?>
            <h1>Post a Comment</h1>

            <?php
            if (isset($_SESSION['username'])) { ?>
                <form action="" method="post">


                    <div class="mb-3">
                        <label for="comment_content" class="form-label">type your comment</label>
                        <textarea class="form-control" name="comment_content" id="comment_content" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                    <button type="submit" class="btn btn-primary" name="commentSubmit">Submit</button>
                </form>
            <?php } else {
                echo "<p class='display-6 fs-2'>you are not logged in please login to be able to start a Discussion </p>";
            } ?>
        </div>
        <h1>Browse Questions</h1>


        <?php
        $comment_show = "SELECT *  FROM comments WHERE 	thread_id   = $thread_id";
        $comment_result = mysqli_query($conn, $comment_show);
        $noresult = true;
        while ($threads_row = mysqli_fetch_assoc($comment_result)) {
            $noresult = false;
            $comment = $threads_row['comment_content'];
            $comment_time = $threads_row['comment_time'];
            $comment_by = $threads_row['comment_by'];
            $date = date_create($comment_time);

            $user_query = "SELECT * FROM users WHERE user_id = '$comment_by' ";
            $user_result = mysqli_query($conn, $user_query);
            $user_row = mysqli_fetch_assoc($user_result);
            $user_name = $user_row['username'];


        ?>
            <div>

                <div class="d-flex my-3">
                    <div class="flex-shrink-0">
                        <img src="images/user-profile.avif" alt="..." style="width: 50px;">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5><?php echo "$user_name at " . date_format($date, 'Y/m/d ') . " "; ?></h5>
                        <p class="my-0"> <?php echo $comment; ?></p>
                    </div>
                </div>
                <div class=" ">
                    <h6 class="text-end my-0">Asked by - <?php echo "$user_name at " . date_format($date, 'Y/m/d ') . " "; ?></h6>
                </div>
            </div>

        <?php }

        if ($noresult) {
            echo '<div class="alert alert-primary" role="alert">

  <h3>No thread found</h3>
  <p>Be the first person to ask a question</p>
</div>';
        } ?>

    </div>
</div>

<?php include 'partials/_footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>