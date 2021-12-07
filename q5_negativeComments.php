<?php

    include 'partials/_dbconnect.php';
    include 'partials/_nav.php';

    $query = "SELECT DISTINCT posted_by
              FROM comments
              WHERE posted_by IN (SELECT posted_by FROM comments WHERE sentiment IN ('Negative'))
              AND posted_by NOT IN (SELECT posted_by FROM comments WHERE sentiment IN ('Positive'));";
    
    $result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Users who never posted a blog</title>
</head>
<body>

    <div class="container col-md-6">
        <h1>5. Display all the users who posted some comments, but each of them is negative. </h1>
        
        <div>
            <ul>
                <?php
                    while($row=$result->fetch_assoc())
                    { ?>
                    <h4><?php echo $row['posted_by'];?></h4>
                    <?php
                    }
                ?>
            </ul>
        </div>
    </div>

    

</body>
</html>