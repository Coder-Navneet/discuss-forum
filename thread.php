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
        <h1>Browse Questions</h1>


        <div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="images/user-profile.avif" alt="..." style="width: 50px;">
            </div>
            <div class="flex-grow-1 ms-3">
                <h4><a href="thread.php?thread_id=" class="text-decoration-none"></a></h4>
                <p></p>
            </div>
        </div>

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