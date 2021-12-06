



<?php
    session_start();

    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: login.php");
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $subject = isset($_POST['subject']) ? $_POST['subject'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $tags = isset($_POST['tags']) ? $_POST['tags'] : '';

        //store each tag in array
        $newtags = explode(",", $tags);
        $TagArray = array_map('trim',$newtags);

        $postdate = date("Y-m-d");
        $createdby = $_SESSION['username'];

        $data = $_POST;

        if (empty($data['subject']) ||
            empty($data['description'])  ||
            empty($data['tags'])) {
            $_SESSION['messages'][] = 'Please fill all required fields';
            header('Location:user_home.php');
            exit;
        }

        //connect to server
        include 'partials/_dbconnect.php';

        //Cannot post of count > 2
        $blogCount = "SELECT COUNT(*) from blogs WHERE createdby = '$createdby' AND postdate = '$postdate';" ;
        $count = mysqli_query($conn, $blogCount);
            
        while($row = mysqli_fetch_array($count)) {
            if($row['COUNT(*)'] >= 2){
            $_SESSION['messages'][] = 'Your daily limit of posting blog is exceeded';
            header('Location:user_home.php');
            exit();
            }
        }

        //Insert 
        //insert into blogs
        $insertBlog = "INSERT INTO blogs (`subject`, `description`, `postdate`, `createdby`) VALUES ('$subject', '$description', '$postdate', '$createdby');";
        $result = mysqli_query($conn, $insertBlog);

        if(!$result)
        {
            echo mysqli_error();
        }
        else
        {
            //get blogid
            $insertedBlogId = mysqli_insert_id($conn);
            //insert tags        
            for($i = 0; $i <= count($TagArray)-1; $i++ ){
                $insertTags = "INSERT INTO blogtags(`blogid`, `tag`) VALUES ('$insertedBlogId', '$TagArray[$i]');" ;
                $tagResult = mysqli_query($conn, $insertTags);
                if(!$tagResult){
                    echo mysqli_error();
                }
            }
            $_SESSION['messages'][] = 'Blog posted';
            header('Location:user_home.php');
        }

        $conn->close();
    }

    
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
        function iButtonClicked()
        {
            window.location.href="initialize.php";
        }
          function init() 
        {
            initButton.addEventListener("click", iButtonClicked);
        }
          window.addEventListener("DOMContentLoaded", init);
    </script>
</head>
<body>
    <?php require 'partials/_nav.php' ?>

    <!-- <form method="post" action="initialize.php"> -->
    <?php  if (isset($_SESSION['username'])) : ?>
            <h1>Welcome <strong><?php echo $_SESSION['username']; ?></strong></h1>
        <?php endif ?>

        <div class="container col-md-6">
            <h1 class="text-center">Wanna post a blog?</h1>

            <form action="/comp440_login_page/user_home.php" method="post">

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="tags" class="form-label">Tags</label>
                    <input type="text" class="form-control" id="tags" name="tags">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="description" name="description"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Post</button>
                
            </form>
        </div>

        <!-- <div class="input-group">
            <button type="submit" class="btn" id="initButton" name="initialize">Initialize Database</button>
        </div>
    
   </form>  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>