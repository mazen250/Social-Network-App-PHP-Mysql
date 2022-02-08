<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="./styles/profile.css">
   <title>User Profile</title>
</head>
<body>
    <div class="header">
      
    <a href="home.php" style="text-decoration:none; color:black">

        <h1 style="font-size: 1.5rem;">The Social Network</h1> 
    </a>
        
        <!-- logout start -->

    <form action="" method="post">
        <input type="submit" name="logout" value="logout" class="logout">
        <?php 
        if(isset($_POST['logout'])){
            
            echo "<script>window.open('login.php','_self')</script>";
            session_destroy();
        }
        ?>
    </form>
    <!-- logout end -->

        <!-- change password -->
        <a href="edit.php" style="text-decoration:none; color:black">edit profile </a>
        
        <a href="notify.php" class="logout">
        notification

        </a>
        <a href="messanger.php" class="logout">Messanger</a>
        <!-- <?php ?> -->


    </div>
        <?php
        
        include("./includes/connection.php");
        session_start();


        $name = $_SESSION['user_name'];
        
        
        
        $userQuery = "SELECT * FROM user WHERE user_name = '$name'";
        $query = mysqli_query($conn, $userQuery);
        $row = mysqli_fetch_array($query);
        $user_id = $row['user_id'];
        $work = $row['works_at'];
        $lives = $row['lives_in'];
        $email = $row['email'];
        $born = $row['born_at'];
        $mobile = $row['mobile'];
        $gender = $row['gender'];
        $password = $row['password'];
        $profile_pic = $row['user_profile'];
        // echo "<br>";
        // echo "lives in $lives";
        // echo "<br>";
        // echo "working at $work";
        // echo "<br>";
        $user_image = $row['user_profile'];
        // echo "<br>";

        echo "<div class='bio'>";
        echo "<h1>welcome back $name </h1>";
        
        
        echo "<img src='images/$profile_pic' width='100px' height='100px' class='profile'>
        
        <h2>lives in $lives</h2>
        <h2>work at $work</h2>
        <h2>email: $email</h2>
        <h2>born at $born</h2>
        <h2>phone number : $mobile</h2>
        <h2>gender $gender</h2>
        ";
        
        // <h2>password : $password</h2>
        // <p>user id : $user_id</p>

        echo "</div>";
        
        // fetch posts with the same userid
        $post_query = "SELECT * From posts WHERE user_id = '$user_id'";
        ;
        $post_query_exec = mysqli_query($conn,$post_query);
        echo "<br>";
        while( $post_row = mysqli_fetch_array($post_query_exec)){
            $post_text = $post_row['post_text'];
            $post_image = $post_row['post_image'];
            $post_id = $post_row['post_id'];
            $created_date = $post_row['create_date'];
            // echo " post text is $post_text";
            // echo"<br> ";
            echo "<div class='posts'>";
            // echo "<img src='./images/profile.png' class='profilePic''>";
            // echo "<h3>$user_name</h3>";
            echo "<p>$post_text</p>";
            // echo "<br />";
            // echo "$post_id" ;
            echo "<img src='images/$post_image' class='postImage''>";
            // echo "<h1>$post_id</h1>";
            echo "<a href='delete.php?post_id=$post_id' class='logout'>delete</a>";
            echo "<p>$created_date</p>";
            echo "</div>";
        }
        ?>




    <div class="footer">
        <p>&copy; social network team</p>
    </div>
</body>
</html>