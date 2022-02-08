<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/comment.css">
    <link rel="stylesheet" href="./styles/messages.css">
    <title>Messages</title>
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
    <!-- the one we choose to chat with -->
    <form action="" method="POST">
            <input type="text" name="msg" placeholder="enter your message here">
            <input type="submit" name="send" value="send" class="send">
        </form> 
    <?php
    $current_user = $_SESSION['user_name'];
    $currentuserq = "SELECT * FROM user WHERE user_name = '$current_user'";
    $currentuserquery = mysqli_query($conn, $currentuserq);
    $currentUserRow = mysqli_fetch_array($currentuserquery);
    $currentUserId = $currentUserRow['user_id'];
    echo "<h1>Welcome to messenger $current_user</h1>";

    
    $user_id = $_GET['user_id'];  
    // echo "you are chatting with $user_id";
    $anotheruserQery = "SELECT * FROM user WHERE user_id = '$user_id'";
    $anotherquery = mysqli_query($conn, $anotheruserQery);
    $anotheruserRow = mysqli_fetch_array($anotherquery);
    $anotheruserName = $anotheruserRow['user_name'];
    echo "<h1>now you are chatting with $anotheruserName</h1>";



    if(isset($_POST['send'])){

        $msg = $_POST['msg'];
        if($msg ==""){
            echo '<script>alert("please enter a message")</script>';
        }else{
        
        
        $id = rand(1,9999999999);
        $msgQuery = "INSERT INTO messages (id, content, sender,receiver) VALUES('$id', '$msg', '$currentUserId', '$user_id')";
        $msgQueryResult = mysqli_query($conn, $msgQuery);
        
        if($msgQueryResult){
            header("Location:messages.php?user_id=$user_id");
            
            // echo '<script>alert("message sent")</script>';
            
            //echo "<script>window.open('messages.php?user_id=$user_id','_self')</script>";
        }
        else{
            echo "kindly wait 5 second or more and then refresh the page";
        }
    }}
    ?>
    
  

    <!-- <div class="messageSection">
        <div class="sender">
            <?php 
            // $current_user = $_SESSION['user_name'];
            // $currentuserq = "SELECT * FROM user WHERE user_name = '$current_user'";
            // $currentuserquery = mysqli_query($conn, $currentuserq);
            // $currentUserRow = mysqli_fetch_array($currentuserquery);
            // $currentUserId = $currentUserRow['user_id'];
        
            // $user_id = $_GET['user_id'];  
            // echo "<h1>$current_user section of messages</h1>";
            // echo "you are chatting with $user_id";
            // $anotheruserQery = "SELECT * FROM user WHERE user_id = '$user_id'";
            // $anotherquery = mysqli_query($conn, $anotheruserQery);
            // $anotheruserRow = mysqli_fetch_array($anotherquery);
            // $anotheruserName = $anotheruserRow['user_name'];
            // echo "<h1>now you are chatting with $anotheruserName</h1>"

            ?>

        </div>
        <div class="receiver">

        <?php
        
    //     $user_id = $_GET['user_id'];  

    // // echo "you are chatting with $user_id";
    // $anotheruserQery = "SELECT * FROM user WHERE user_id = '$user_id'";
    // $anotherquery = mysqli_query($conn, $anotheruserQery);
    // $anotheruserRow = mysqli_fetch_array($anotherquery);
    // $anotheruserName = $anotheruserRow['user_name'];
    // echo "<h1>$anotheruserName section</h1>";
        
        ?>
        </div>
    </div> -->

        <!-- messages section -->
        <?php
            $current_user = $_SESSION['user_name'];
            //fetch all data of current user
            $currentuserq = "SELECT * FROM user WHERE user_name = '$current_user'";
            $currentuserquery = mysqli_query($conn, $currentuserq);
            $currentUserRow = mysqli_fetch_array($currentuserquery);
            $currentuserProfile = $currentUserRow['user_profile'];
            $currentUserId = $currentUserRow['user_id'];

            //fetch all data of another user

        $user_id = $_GET['user_id'];
        $anotheruserQery = "SELECT * FROM user WHERE user_id = '$user_id'";
        $anotherquery = mysqli_query($conn, $anotheruserQery);
        $anotheruserRow = mysqli_fetch_array($anotherquery);
        $anotheruserProfile = $anotheruserRow['user_profile'];
        $anotheruserName = $anotheruserRow['user_name'];






        $msgQuery = "SELECT * FROM messages WHERE sender = '$currentUserId' AND receiver = '$user_id' OR sender = '$user_id' AND receiver = '$currentUserId' ORDER BY date DESC";
        $msgQueryResult = mysqli_query($conn, $msgQuery);
        while($row = mysqli_fetch_array($msgQueryResult)){
            $sender = $row['sender'];
            $receiver = $row['receiver'];
            $content = $row['content'];
            $id = $row['id'];
            echo "<div class='messageSection'>";
            if($sender == $currentUserId){
                echo "<div class='sender'>
                <img src='./images/$currentuserProfile' alt='profile' class='profile'>
                <p>   $current_user : $content</p>
                
                </div>";
            }else{
                echo "<div class='receiver'>
                <img src='./images/$anotheruserProfile' alt='profile' class='profile'>
                <p>   $anotheruserName : $content</p>
           
                </div>";
            }
            echo "</div>";
        }
        
        ?>



    <div class="footer">
        <p>&copy; social network team</p>
    </div>


    

</body>
</html>