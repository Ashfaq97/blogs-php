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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Initialize</title>
    <!--
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
    -->
</head>
<body>

    <h1 style={'text-align': center;}>Database Initialized</h1>
    
    <input type="button" class="btn" id="initButton" value="Initialize DB">
    
</body>
</html>
