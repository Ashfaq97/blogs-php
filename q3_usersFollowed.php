<?php
    include 'partials/_nav.php';

    include 'partials/_dbconnect.php';

    $userX = $_POST['userX'];
    $userY = $_POST['userY'];

    $query = "SELECT X.leadername
    FROM (SELECT DISTINCT leadername FROM follows WHERE followername in ('$userX')) as X, 
    (SELECT DISTINCT leadername FROM follows WHERE followername in ('$userY')) as Y
    WHERE X.leadername=Y.leadername;";
    
    $result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Users Followed</title>
</head>
<body>
    
        <h1>3. List the users who are followed by both X and Y. Usernames X and Y are inputs from the user.</h1>

        <form action="q3_usersFollowed.php" method="post">
            <label class="input-label">Enter the username for X:</label>
            <input type="text" id="userX" name="userX" placeholder="Username" class="input">
                
            <label class="input-label">Enter the username for Y:</label>
            <input type="text" id="userY" name="userY" placeholder="Username" class="input">
                
            <input type="submit" id="submit" value="Submit">
        </form>


        <div>
            <ul>
                <?php
                    while($row=$result->fetch_assoc())
                    { ?>
                    <h4><?php echo $row['leadername'];?></h4>
                    <?php
                    }
                ?>
            </ul>
        </div>
    
    

</body>
</html>