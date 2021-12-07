<?php
    include 'partials/_nav.php';

    include 'partials/_dbconnect.php';

    $positiveComments = "SELECT created_by
                         FROM blogs 
                         WHERE pdate='2020-04-12'
                         GROUP BY created_by
                         HAVING COUNT(*)=(
                             SELECT MAX(counts)
                             FROM (SELECT created_by, COUNT(*) AS counts 
                                 FROM blogs 
                                 WHERE pdate='2020-04-12'
                                 GROUP BY created_by) AS a
                                 );";
    $result = mysqli_query($conn, $positiveComments);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Users with Most Blogs</title>
</head>
<body>

    <div class="container col-md-6">
        <h1>2. List the users who posted the most number of blogs on 10/10/2021; if there is a tie, list all the users who have a tie. </h1>
        <div>
            <ul>
                <?php
                    while($row = mysqli_fetch_array($result)){ ?>
                        <h4><?php echo "<li class='list'>" . $row['created_by'] . "</li>";?></h4>
                    <?php }  
                ?>
            </ul>
        </div>
    </div>
    
</body>
</html>