<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
     <title>Notification</title>
</head>
<body>
 


<?php
    function getPosts(){
        include("./includes/connection.php");
        $query = "SELECT * FROM posts";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)){
            // $post_id = $row['post_id'];
            
            $user_id = $row['user_id'];
            

            $userQuery = "SELECT * FROM user WHERE user_id = '$user_id'";
            $userResult = mysqli_query($conn, $userQuery);
            $userRow = mysqli_fetch_array($userResult);
            $user_name = $userRow['user_name'];
            

            echo "<h1>$user_name posted a post</h1>";
        }
    }

    
    ?>
   
    <?php getPosts(); ?>


</body>
</html>