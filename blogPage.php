<?php 

    session_start();
    //connect db
    include 'partials/_dbconnect.php';
    //got blog id
    $blogid =  $_GET['bid'];
    $_SESSION['blogid'] = $blogid;

    $sql = "SELECT * FROM blogs WHERE blogid = '$blogid';" ;
    $viewBlogs = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($viewBlogs);

    $tagSQL = "SELECT tag FROM blogtags WHERE blogid = '$blogid';" ;
    $tagResult = mysqli_query($conn, $tagSQL);

    $commentSQL = "SELECT `description`, `postedBy` FROM comments WHERE blogid = '$blogid';" ;
    $commentResult = mysqli_query($conn, $commentSQL);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles.css">
    <title>Blog Page</title>
</head>
<body>
    <?php include "partials/_nav.php" ?>

    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
            <h1 class="display-4 fst-italic"><?php echo $row['subject']; ?></h1>
            <p class="lead my-3"><?php echo $row['description']; ?></p>
            <!--<p class="lead mb-0"><a href="#" class="text-white fw-bold">Continue reading...</a></p>-->
        </div>
    </div>

    <div class="comment">
        <div class="blog-sub">Leave a comment:</div>

        <form action="comment.php" method="post">
            <select name="sentiment" required>
                <option value="" disabled selected hidden>Choose a sentiment</option>
                <option value="Positive">Positive</option>
                <option value="Negative">Negative</option>
            </select>
            <textarea class="textarea" name="comment" rows="2" cols="72" placeholder="Type your comment here" required></textarea>
            <button class="commentbtn" type="submit" name="submit" value="choose sentiment">Post Comment</button>
        </form>

    </div> 
    
</body>
</html>