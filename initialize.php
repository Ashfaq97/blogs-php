<?php 
    
    include 'partials/_dbconnect.php';

    # MySQL with PDO_MYSQL  
    $db = new PDO("mysql:host=$server;dbname=$database", $username, $password);

    $query = file_get_contents("university.sql");

    $result = mysqli_query($conn, $query);

    if ($result){
         echo "Success";
    }else{ 
         echo "Fail";
    }
?>

<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

    <div class="container">
        <div class="home-style">
        <label id="welcome-sign">Welcome to the Home Page!</label>
    <div style='color: purple;'> Success </div>
        <input type="button" class="btn" id="initButton" value="Initialize DB">
        </div>
    </div>
    
</body>
</html>
-->