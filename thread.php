<?php
include 'partials/_dbconnect.php';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

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

        $threds_sql  = "SELECT * FROM threads WHERE thread_id  = $id";
        $threads_result = mysqli_query($conn, $threds_sql);

        while ($threads_row = mysqli_fetch_assoc($threads_result)) {
            $thread_id = $threads_row['thread_id'];
            $thread_title = $threads_row['thread_title'];
            $thread_desc = $threads_row['thread_desc'];

        ?>
            <div class="p-5 mb-4 bg-body-secondary rounded-3  mx-auto w-75">
                <div class="container-fulid">
                    <h1 class="display-6"><?php echo $thread_title; ?></h1>
                    <p class=" "><?php echo $thread_desc; ?></p>
                    <hr>
                    <div>
                        <p class="mb-0">some rules to use in chat. / Be respectful: No insults, personal attacks, or harassment. / Stay on topic: Keep posts relevant to the thread's subject. / No spam: Do not post ads, promotional links, or repetitive content. / No illegal content: Do not share pirated material, NSFW content, or private data. </p>

                    </div>
                    <h5>Powerd by Navneet</h5>
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

                $ques = "INSERT INTO comments (comment_content, 	thread_id , comment_by) VALUES ('$comment','$thread_id', '0')";
                $ques_result = mysqli_query($conn, $ques);
                if ($ques_result) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success !</strong> Your Question submited  .
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
                }
            }
            ?>
            <form action="" method="post">

                <h1>Post a Comment</h1>
                <div class="mb-3">
                    <label for="comment_content" class="form-label">type your comment</label>
                    <textarea class="form-control" name="comment_content" id="comment_content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="commentSubmit">Submit</button>
            </form>
        </div>
        <h1>Browse Questions</h1>


        <?php
        $comment_show  = "SELECT *  FROM comments WHERE 	thread_id   = $thread_id";
        $comment_result = mysqli_query($conn, $comment_show);
        $noresult = true;
        while ($threads_row = mysqli_fetch_assoc($comment_result)) {
            $noresult = false;
            $comment = $threads_row['comment_content'];
            $comment_time = $threads_row['comment_time'];
            $date = date_create($comment_time);



        ?>
            <div class="d-flex my-3">
                <div class="flex-shrink-0">
                    <img src="images/user-profile.avif" alt="..." style="width: 50px;">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5><?php echo "Navneet at ". date_format($date, 'Y/m/d ')." "; ?></h5>
                    <p><?php echo $comment; ?></p>
                </div>
            </div>

        <?php    }

        if ($noresult) {
            echo '<div class="alert alert-primary" role="alert">

  <h3>No thread found</h3>
  <p>Be the first person to ask a question</p>
</div>';
        } ?>

    </div>
</div>

<?php include 'partials/_footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>