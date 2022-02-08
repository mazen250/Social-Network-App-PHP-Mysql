<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="./styles//home.css">
<title>Home</title>
</head>
<body>

<div class="header">
        <a href="home.php" style="font-size: 1.5rem; text-decoration:none; color:black">The Social Network</a> 
        
        <!-- logout start -->

        <!-- <a href="notify.php" class="logout">
        notification

        </a> -->
        <a href="profile.php" class="profileLink">Your Profile</a>
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


    <!-- add post function start -->

     <?php 

    include("./includes/connection.php");

    session_start();

    
    $name = $_SESSION['user_name'];
    $userQuery = "SELECT * FROM user WHERE user_name = '$name'";
    // $id = $_SESSION['user_id'];
    // $userQuery = "SELECT * FROM user WHERE user_id = '$id'";
    $query = mysqli_query($conn, $userQuery);
    $row = mysqli_fetch_array($query);
    $user_id = $row['user_id'];


    // echo "welcome ya $name";
    // echo "<br>";
    // echo "your id is $user_id";
    ?>
    <?php 
    if(isset($_POST['submitPost']) ){
        $content = $_POST['content'];
        $post_image = $_FILES["post_image"]["name"];
        $image_temp = $_FILES["post_image"]["tmp_name"];  
        $randumImageNumber = rand(0,99999999);
        $post_id = $randumImageNumber;
        //$date = date('d-m-y h:i:s');
    
        
        $post_image_name = $randumImageNumber.$post_image;
        // echo "post test";
        // echo "<br>";
        // echo "$content";
        // echo "<br>";
        // echo "$name";
        // echo "<br>";
        // echo "$post_image";
    

        move_uploaded_file($image_temp, "images/".$post_id.$post_image);

        $insertPostQuery = "INSERT INTO posts (post_id ,user_id , post_text, post_image) VALUES ('$post_id','$user_id','$content', '$post_image_name')";
        
        $query = mysqli_query($conn, $insertPostQuery);

        if($query){
            // echo "<script>alert('post added')</script>";
            // echo "<script>alert($user_id)</script>";

            echo "<script>window.open('home.php','_self')</script>";
           
        }
        
        else{
            echo "<script>alert('post not added please try again ')</script>";
            echo "<script>window.open('home.php','_self')</script>";
        }
        exit();
    }
    ?> 


    <!-- add post function end -->

    <!-- add post form start -->
    <!-- <h1 id="new">new post</h1> -->
    <?php echo "<h2 class='name'>welcome back $name </h2>"; ?>
    <form action="" method="POST" enctype="multipart/form-data" class="postForm">
        <textarea name="content"  cols="30" rows="5" placeholder="enter your content please"></textarea>
        <br>
        <input type="file" name="post_image" value="choose image"  class="imageSelect"/>
        <input type="submit" name="submitPost" value="post" class="submitPost">
    </form>

    <!-- add post form end -->

  


    <!-- post display start -->

    <?php
    function getPosts(){
        include("./includes/connection.php");
        $query = "SELECT * FROM posts ORDER BY create_date DESC";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)){
            // $post_id = $row['post_id'];
            $post_text = $row['post_text'];
            $post_image = $row['post_image'];
            $user_id = $row['user_id'];
            $like = $row['likes'];
            $post_id =$row['post_id'];
            $create_date = $row['create_date'];

            $userQuery = "SELECT * FROM user WHERE user_id = '$user_id'";
            $userResult = mysqli_query($conn, $userQuery);
            $userRow = mysqli_fetch_array($userResult);
            $user_name = $userRow['user_name'];
            $user_profile = $userRow['user_profile'];


            echo "<div class='posts'>";
            echo "<img src='./images/$user_profile' class='profilePic''>";
            echo "<h3>$user_name</h3>";
            echo "<p>$post_text</p>";
            // echo "<br />";
            // echo "$post_id" ;
            echo "<img src='images/$post_image' class='postImage''>";
            echo "<p>likes : $like</p>";
            // echo "<p>posted date is : $create_date</p>";
            // ECHO "<P>POST ID : $post_id </P>";
            echo "<a href='like.php?post_id=$post_id' class='logout'>like</a>";
            echo "<a href='comment.php?post_id=$post_id' class='logout'>comment</a>";
            echo "<a href='home.php?post_id=$post_id' class='logout' class='modalshow'>chat with $user_name</a>";
            // echo "<button onclick={getModal($post_id)}>chat</button>";
            echo "<br>";
            
            // echo " <form action='like.php?post_id=$post_id' method='POST'>
            // <input type='submit' name='like' value='like' class='logout'>";

            // echo "<h1>$post_id</h1>";
            echo "</div>";
        }
    }

    
    ?>
    <?php 
    
    // if(isset($_POST['like'])){
        
    //     $query = "SELECT * FROM posts WHERE post_id='$post_id'";
    //     $result = mysqli_query($conn, $query);
    //     $row = mysqli_fetch_array($result);
    //     $post_id=$row['post_id'];
    //     $like = $row['likes'];
    //     $newLike = $like+1;
    //     echo "<script>alert('likes = $post_id') </script>";
    //     $likeQ = "UPDATE posts SET likes=$newLike WHERE post_id='$post_id'";
    //     $q_exec = mysqli_query($conn,$likeQ);
    //     if ($q_exec){
    //         echo "<script>alert('like added')</script>";
    //         echo "<script>window.open('home.php','_self')</script>";
    //     }

    // }

    // if(isset($_POST['like'])){
    //     // $post_id = $_POST['post_id'];
    //     echo "<script>alert('like added post id is = $post_id')</script>";
    // }



    ?>

    <!-- post display end -->
    <?php getPosts(); ?>

        <!-- <script>
           let modelbtn= document.querySelector('body > div.modal > button')
           let modal = document.querySelector('.modal')
            let modal = ()=>{
                // modal.className='modalNon'
                alert('hello')
            }

            alert('hello')

        </script> -->
 
 
    <div class="modal">
        <button class='modalbtn' onclick='modal()'>close</button>
        <?php echo "<h2 class='name'>welcome back $name </h2>

        ";
        
        include("./modal.php") 
        ?>
        
       
    </div>
    <h3 style="font-weight: 400;">end of the feed page</h3>
    <div class="footer">
        <p>&copy; social network team</p>
    </div>
    <script src="./modal.js"></script>
</body>
</html>