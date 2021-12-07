<?php
    include 'partials/_nav.php';

    include 'partials/_dbconnect.php';

    $positiveComments = "SELECT subject, blogs.description FROM blogs, comments
                         WHERE blogs.created_by = 'batman' 
                         AND blogs.blogid = comments.blogid 
                         AND sentiment = 'Positive';";
    $result = mysqli_query($conn, $positiveComments);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>User with most blogs</title>
</head>
<body>

    <div class="container col-md-6">
        <h1>1. List all the blogs of user X, such that all the comments are positive for these blogs.</h1>
        <div class="blogListBox">
            <ul class='list'>
                <?php
                    while($row = mysqli_fetch_array($result)){ ?>
                        <h3>Subject: <?php echo $row['subject'];?></h3>
                        <?php
                    } 
                ?>
            </ul>
        </div>
    </div>
    

</body>
</html>