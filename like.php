<?php 

include("./includes/connection.php");
session_start();

        $post_id = $_GET['post_id'];

        
        $query = "SELECT * FROM posts WHERE post_id='$post_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $post_id=$row['post_id'];
        $like = $row['likes'];
        $newLike = $like+1;
        // echo "<script>alert('likes = $post_id') </script>";
        $likeQ = "UPDATE posts SET likes=$newLike WHERE post_id='$post_id'";
        $q_exec = mysqli_query($conn,$likeQ);
        if ($q_exec){
            // echo "<script>alert('like added')</script>";
            echo "<script>window.open('home.php','_self')</script>";
        }

    
?>