<?php
    include 'partials/_nav.php';

    include 'partials/_dbconnect.php';

    $query = "SELECT DISTINCT username
              FROM users
              WHERE username NOT IN (SELECT created_by FROM blogs);";
    
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
        <h1>4. Display all the users who never posted a blog.</h1>
        
        <div>
            <ul>
                <?php
                    while($row=$result->fetch_assoc())
                    { ?>
                    <h4><?php echo $row['username'];?></h4>
                    <?php
                    }
                ?>
            </ul>
        </div>
    </div>
    

</body>
</html>