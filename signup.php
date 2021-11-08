<?php 
    $showError = false;
    $showAlert = false;
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'partials/_dbconnect.php';
        

        $username = $_POST["username"];
        $password = $_POST["password"];
        $confpass = $_POST["confpass"];
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $exists = false;

        if(($password == $confpass) && ($exists == false)){
            $sql = "INSERT INTO `user` (`username`, `password`, `firstName`, `lastName`, `email`) VALUES ('$username', '$password', '$firstname', '$lastname', '$email');";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match!";
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Signup</title>
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    <?php 
        if($showAlert){
            echo '<div class="alert alert-success" role="alert">
                  Successfully created account! you can now login.
                </div>';
        }

        if($showError){
            echo '<div class="alert alert-danger" role="alert">
                  Passwords do not match!
                </div>';
        }
    ?>
    
    <div class="container col-md-6">
        <h1 class="text-center">Signup</h1>

        <form action="/comp440_login_page/signup.php" method="post">

        <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confpass" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confpass" name="confpass">
            </div>
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div> 
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>