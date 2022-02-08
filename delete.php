<?php

include("./includes/connection.php");
session_start();
$post_id = $_GET['post_id'];

echo "delete post that have id = $post_id";
 
$query = "DELETE FROM posts WHERE post_id='$post_id'";
$result = mysqli_query($conn, $query);

if ($result){
    // echo "<script>alert('post deleted')</script>";
    echo "<script>window.open('home.php','_self')</script>";
}
else{
    echo "<script>alert('post not deleted')</script>";
    echo "<script>window.open('home.php','_self')</script>";
}
 
?>