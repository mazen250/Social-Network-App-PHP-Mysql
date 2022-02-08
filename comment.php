<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/comment.css">
    <title>comment a post</title>
</head>
<body> 
    <?php 
        include("./includes/connection.php");
        session_start();
    ?>
<div class="header">
        <a href="home.php" class="homeLink">
        <h1 style="font-size: 1.5rem;">The Social Network</h1> 
        </a> 
        
        <!-- logout start -->

        <a href="notify.php" class="logout">
        notification

        </a>
        <a href="profile.php" class="profileLink">Profile</a>
    <form action="" method="post">
        <input type="submit" name="logout" value="logout" class="logout">
        <?php 
        if(isset($_POST['logout'])){
            session_destroy();
            echo "<script>window.open('login.php','_self')</script>";
        }
        ?>
    </form>



    <!-- logout end -->
    </div>

        <form action="" method="POST" class="commentForm">
            <input type="text" name="commentText" placeholder="enter your comment here ">
            <input type="submit" name="submitComment" value="comment" class="submitComment"> 
        </form>

        <!-- add comment section start -->

        <?php
            // include("./includes/connection.php");
  
                $name = $_SESSION['user_name'];
                // echo "name is $name";
                $userQuery = "SELECT * FROM user WHERE user_name = '$name'";
                $query = mysqli_query($conn, $userQuery);
                $row = mysqli_fetch_array($query);
                $user_id = $row['user_id'];


                
                $post_id = $_GET['post_id'];
                // echo "post id is $post_id";
            if(isset($_POST['submitComment'])){
                $comment = $_POST['commentText'];
                $comment_id = rand(0,99999999);

                // echo "" . $comment . "";
                $commentQuery = "INSERT INTO `post-comment` (comment_text,post_id, commenter_id) VALUES ('$comment', '$post_id', '$user_id')";
                $query = mysqli_query($conn, $commentQuery);
                if($query){
                    echo "comment added";
                    echo "<script>window.open('home.php','_self')</script>";
                }
            
            }

        ?>

        <!-- add comment section end -->
    
    <?php 
    // include("./includes/connection.php");
    // session_start();
    $name = $_SESSION['user_name'];
    
    $post_id = $_GET['post_id'];
            echo "<br>";
    //  echo "post id is $post_id";
    $query = "SELECT * FROM posts WHERE post_id='$post_id'";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    $post_text = $row['post_text'];
    $post_image = $row['post_image'];
    $user_id = $row['user_id'];
    $like = $row['likes'];
    $post_id =$row['post_id'];
    $create_date = $row['create_date'];
    $userquery = "SELECT * FROM user WHERE user_id = '$user_id'";
    $userresult = mysqli_query($conn, $userquery);
    $userrow = mysqli_fetch_array($userresult);
    $user_name = $userrow['user_name'];
    $user_profile = $userrow['user_profile'];
    echo "<br>";
    // echo "post id is $post_id";
    // echo "<br>";
    // echo "post owner is $user_name";
    // echo "<br>";
    // echo "post text is $post_text";
    // echo "<br>";
    echo "<div class='posts'>";
    // echo "<img src='images/$post_image' width='100px' height='100px' class='profile'>";
    echo "<img src='./images/$user_profile' class='profilePic''>";
            echo "<h3>$user_name</h3>";
            echo "<p>$post_text</p>";
            // echo "<br />";
            // echo "$post_id" ;
            echo "<img src='images/$post_image' class='postImage''>";
            echo "<p>likes : $like</p>";
            echo "<p>posted date is : $create_date</p>";
            // ECHO "<P>POST ID : $post_id </P>";
            echo "<a href='like.php?post_id=$post_id' class='logout'>like</a>";
            // echo "<a href='comment.php?post_id=$post_id' class='logout'>comment</a>";
            echo "<br>";
            echo "</div>";

?>
        <div class="comment">
         
            
            <?php 
            // echo "post id is $post_id";
            $query = "SELECT * FROM `post-comment` WHERE post_id='$post_id'";
            $result = mysqli_query($conn, $query);
            
            echo "<br>";
            echo "<br>";
            echo "post owner is $user_name";
            echo "<br>";
            

            while($row = mysqli_fetch_array($result)){
                $comment_text = $row['comment_text'];
                $comment_id = $row['commenter_id'];
                $commenter_id = $row['commenter_id'];
                echo "<br>";
                // echo "commenter id is $comment_id";
                $userquery = "SELECT * FROM user WHERE user_id = '$commenter_id'";
                
                $userresult = mysqli_query($conn, $userquery);
                $userrow = mysqli_fetch_array($userresult);
                $user_name = $userrow['user_name'];
                $user_profile = $userrow['user_profile'];
                echo "<br>";
                echo "<div class='comments'>";
                echo "<img src='./images/$user_profile' class='profilePic''>";
                echo "<h3>$user_name</h3>";
                echo "<p>$comment_text</p>";
                
                echo "</div>";
            }


            ?>

        </div>
    <div class="footer">
        <p>&copy; social network team</p>
    </div>


</body>
</html>