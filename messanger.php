<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/comment.css">
    <link rel="stylesheet" href="./styles/messanger.css">
    <title>Messenger</title>
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
</div>
        <?php
        $name = $_SESSION['user_name'];
        echo "<h1>Welcome to messenger $name</h1>";
        $allUserQery = "SELECT * FROM user";
        $allquery = mysqli_query($conn, $allUserQery);
        while($row = mysqli_fetch_array($allquery)){
            $user_name = $row['user_name'];
            $user_id = $row['user_id'];
            $user_profile = $row['user_profile'];
            echo "<div class='user'>
            <img src='./images/$user_profile' alt='profile picture' class='profile'>
            <h3>$user_name</h3>
            <P>$user_id</P>
            <a href='messages.php?user_id=$user_id' class='logout2'>Chat with $user_name</a>";
            echo "</div>";
        }
        
        
        ?>
         <div class="footer">
        <p>&copy; social network team</p>
    </div>
</body>
</html>