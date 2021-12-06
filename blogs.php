<?php  
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }

    $createdby = $_SESSION['username'];
    
    include 'partials/_dbconnect.php';

    $sql = "SELECT `blogid`, `subject`, `createdby` FROM blogs" ;
    $viewblogs = mysqli_query($conn, $sql);
    if (!$viewblogs) {
        printf("Error: %s\n", mysqli_error($conn));
        exit();
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Blogs</title>
</head>
<body>
    <?php include 'partials/_nav.php' ?>
    <h1>Hello <?php echo $_SESSION['username']; ?>!</h1>
    <h3>Here are a few blogs to read...</h3> 

    <div class="blogList">
        <ul class='list'>
            <?php
                while($row = mysqli_fetch_array($viewblogs)){
                    echo "<li class='list'> <a href='blogPage.php?bid=". $row['blogid'] ."'> <b> Subject: </b>" . $row['subject'] . "<b> posted by </b>" . $row['createdby'] . "</a> </li>";
                } 
            ?>
        </ul>
    </div>
    
</body>
</html>