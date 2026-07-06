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
    <!-- Category content section  -->
    <?php include 'partials/_header.php'; ?>
    <div class="container my-3">
        <?php
        $category_id = $_GET['category_id'];

        $sql  = "SELECT *  FROM categories WHERE category_id  = $category_id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $category_name = $row['category_name'];
            $category_description = $row['category_description'];
        ?>
            <div class="p-5 mb-4 bg-body-secondary rounded-3  mx-auto w-75">
                <div class="container-fulid">
                    <h1 class="display-5 fw-bold"><?php echo $category_name; ?></h1>
                    <p class=" "><?php echo $category_description; ?></p>
                    <hr>
                    <div>
                        <p class="mb-0">some rules to use in chat. / Be respectful: No insults, personal attacks, or harassment. / Stay on topic: Keep posts relevant to the thread's subject. / No spam: Do not post ads, promotional links, or repetitive content. / No illegal content: Do not share pirated material, NSFW content, or private data. </p>
                    </div>
                    <button class="btn btn-success btn-lg mt-3" type="button">Learn More</button>
                </div>
            </div>
    </div>
<?php
        }
?>

<div class="container my-5 " id="ques">
    <div class="mx-auto w-75">

        <!-- discuss  form  -->
        <div>
            <?php
            if (isset($_POST['ques'])) {
                $thread_title = $_POST['thread_title'];
                $desc = $_POST['desc'];

                $ques = "INSERT INTO threads (thread_title, thread_desc ,thread_user_id,thread_category_id) VALUES ('$thread_title','$desc', '0' , '$category_id' )";
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
                <div class="mb-3">
                    <label for="thread_title" class="form-label">Problem Title </label>
                    <input type="text" class="form-control" name="thread_title" id="thread_title">
                    <div id="emailHelp" class="form-text">keep yout title as short and crisp as possible.</div>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Example textarea</label>
                    <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="ques">Submit</button>
            </form>
        </div>


        <!-- Browse Questions Section  -->

        <h1>Browse Questions</h1>

        <?php
        $threds_sql  = "SELECT *  FROM threads WHERE 	thread_category_id  = $category_id";
        $threads_result = mysqli_query($conn, $threds_sql);
        $noresult = true;
        while ($threads_row = mysqli_fetch_assoc($threads_result)) {
            $noresult = false;
            $thread_id = $threads_row['thread_id'];
            $thread_title = $threads_row['thread_title'];
            $thread_desc = $threads_row['thread_desc'];
            $thread_time = $threads_row['timestamp'];
            $date = date_create($thread_time);


        ?>
            <div class="d-flex my-3">
                <div class="flex-shrink-0">
                    <img src="images/user-profile.avif" alt="..." style="width: 50px;">
                </div>
                <div class="flex-grow-1 ms-3">
                                        <h6><?php echo "Navneet at ". date_format($date, 'Y/m/d ')." "; ?></h6>

                    <h4><a href="thread.php?thread_id=<?php echo $thread_id; ?> " class="text-decoration-none"><?php echo $thread_title; ?></a></h4>
                    <p><?php echo $thread_desc; ?></p>
                </div>
            </div>

        <?php    }

        if ($noresult) {
            echo '<div class="alert alert-primary" role="alert">

  <h3>No thread found</h3>
  <p>Be the first person to ask a question</p>
</div>';
        } ?>

        <!-- <div class="d-flex my-3">
                <div class="flex-shrink-0">
                    <img src="images/user-profile.avif" alt="..." style="width: 50px;">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h4>Lorem ipsum dolor sit, amet consectetur !</h4>
                    This is some content from a media component. You can replace this with any content and adjust it as needed.
                </div>
            </div> -->


    </div>
</div>

<?php include 'partials/_footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>