<?php

    include 'partials/_dbconnect.php';
    include 'partials/_nav.php';

    $query = "SELECT DISTINCT created_by
              FROM blogs
              WHERE blogs.created_by IN (SELECT created_by FROM blogs WHERE blogid NOT IN (SELECT blogid FROM comments WHERE sentiment IN ('Negative')))
              AND blogs.created_by NOT IN (SELECT created_by FROM blogs WHERE blogid IN (SELECT blogid FROM comments WHERE sentiment IN ('Negative')));";
    
    $result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Users who posted blogs with no negative comments</title>
</head>
<body>

    <div class="container col-md-6">
        <h1>6. Display those users such that all the blogs they posted so far never received any negative comments.</h1>
        
        <div>
            <ul>
                <?php
                    while($row=$result->fetch_assoc())
                    { ?>
                    <h4><?php echo $row['created_by'];?></h4>
                    <?php
                    }
                ?>
            </ul>
        </div>
    </div>
    

</body>
</html>