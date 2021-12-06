<?php

session_start();
//db connect
include 'partials/_dbconnect.php';
//get blogid from viewblog.php
$blogid = $_SESSION['blogid'];

    if(isset($_POST['submit'])){
        if(!empty($_POST['sentiment'])) {
            $selected = $_POST['sentiment'];
        } else {
            echo "Please select the value.";
        }
        if(!empty($_POST['comment'])){
            $comment = $_POST['comment'];
        } else {
            $_SESSION['messages'][] = 'Please type your comment';
            header('Location:blogs.php');
        }
    }

    $cdate = date("Y-m-d");
    $postedBy = $_SESSION['username'];

    //Cannot post of count > 3
    $cCount = "SELECT COUNT(*) from comments WHERE cdate = '$cdate' AND postedBy = '$postedBy';" ;
    $count = mysqli_query($conn, $cCount);
        
    while($row = mysqli_fetch_array($count)) {
        if($row['COUNT(*)'] >= 3){
         $_SESSION['messages'][] = 'You cannot comment as you have exceeded the daily limit';
         echo "You cannot comment as you have exceeded the daily limit"; 
         header('Location:blogs.php');
         exit();
        }
    }

    //Cannot post more than one comment for each blog 
    $bComment = "SELECT COUNT(*) from comments INNER JOIN blogs ON comments.blogid = blogs.blogid WHERE comments.postedBy = '$postedBy' and blogs.blogid = '$blogid'; ";
    $bComCount = mysqli_query($conn, $bComment);

    while($row = mysqli_fetch_array($bComCount)) {
        if($row['COUNT(*)'] >= 1){
         $_SESSION['messages'][] = 'You cannot comment as you have already commented on this blog';
         echo "You cannot comment as you have already commented on this blog";
         header('Location:blogs.php');
         exit();
        }
    }

    $sql = "INSERT INTO `comments`(`sentiment`, `description`, `cdate`, `blogid`, `postedBy`) VALUES ('$selected', '$comment', '$cdate', '$blogid', '$postedBy');" ;
    $result = mysqli_query($conn, $sql);

    if($result){
        $_SESSION['messages'][] = 'Comment posted';
        echo "Comment posted";
        header('Location:blogs.php');
    } else {
        echo mysqli_error($conn);
    }
?>

