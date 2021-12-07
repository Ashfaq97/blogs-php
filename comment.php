<?php

session_start();
//db connect
include 'partials/_dbconnect.php';
//get blogid from blogPage.php
$blogid = $_SESSION['blogid'];

    if(isset($_POST['submit'])){
        if(!empty($_POST['sentiment'])) {
            $selected = $_POST['sentiment'];
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Please select the value
          </div>';
        }
        if(!empty($_POST['description'])){
            $commdesc = $_POST['description'];
        } else {
            $_SESSION['messages'][] = 'Please type your comment';
            header('Location:blogs.php');
        }
    }

    $cdate = date("Y-m-d");
    $posted_by = $_SESSION['username'];

    //Cannot post of count > 3
    $cCount = "SELECT COUNT(*) from comments WHERE cdate = '$cdate' AND posted_by = '$posted_by';" ;
    $count = mysqli_query($conn, $cCount);
        
    while($row = mysqli_fetch_array($count)) {
        if($row['COUNT(*)'] >= 3){
         $_SESSION['messages'][] = 'You cannot comment as you have exceeded the daily limit';
         echo '<div class="alert alert-danger" role="alert">
                You cannot comment as you have exceeded the daily limit!
                </div>'; 
         header('Location:blogs.php');
         exit();
        }
    }

    //Cannot post more than one comment for each blog 
    $bComment = "SELECT COUNT(*) from comments INNER JOIN blogs ON comments.blogid = blogs.blogid WHERE comments.posted_by = '$posted_by' and blogs.blogid = '$blogid'; ";
    $bComCount = mysqli_query($conn, $bComment);

    while($row = mysqli_fetch_array($bComCount)) {
        if($row['COUNT(*)'] >= 1){
         $_SESSION['messages'][] = 'You cannot comment as you have already commented on this blog';
         echo '<div class="alert alert-danger" role="alert">
         You cannot comment as you have already commented on this blog!
         </div>';
         header('Location:blogs.php');
         exit();
        }
    }

    $sql = "INSERT INTO `comments`(`sentiment`, `description`, `cdate`, `blogid`, `posted_by`) VALUES ('$selected', '$commdesc', '$cdate', '$blogid', '$posted_by');" ;
    $result = mysqli_query($conn, $sql);

    if($result){
        $_SESSION['messages'][] = 'Comment posted';
        echo '<div class="alert alert-success" role="alert">
        Comment posted!
        </div>';
        header('Location:blogs.php');
    } else {
        echo mysqli_error($conn);
    }
?>

