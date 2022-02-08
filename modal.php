<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="./styles/modal.css">
</head>
<body>


<?php

include("./includes/connection.php");

if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];
// echo "test modal";
// echo "test 2";
// echo "test 3";

$query = "SELECT * FROM posts WHERE post_id='$post_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

$another_userid = $row['user_id'];

// echo "you are cahtting with user id : $another_userid";

$query2 = "SELECT * FROM user WHERE user_id='$another_userid'";
$result2 = mysqli_query($conn, $query2);
$row2 = mysqli_fetch_array($result2);
$username2 = $row2['user_name'];
echo "chatting with $username2";

}



$current_user = $_SESSION['user_name'];
//fetch all data of current user
$currentuserq = "SELECT * FROM user WHERE user_name = '$current_user'";
$currentuserquery = mysqli_query($conn, $currentuserq);
$currentUserRow = mysqli_fetch_array($currentuserquery);
$currentuserProfile = $currentUserRow['user_profile'];
$currentUserId = $currentUserRow['user_id'];
// echo "<br>";
// echo "current user is : $current_user";
//fetch all data of another user

$another_userid = $row['user_id'];
$anotheruserQery = "SELECT * FROM user WHERE user_id = '$another_userid'";
$anotherquery = mysqli_query($conn, $anotheruserQery);
$anotheruserRow = mysqli_fetch_array($anotherquery);
$anotheruserProfile = $anotheruserRow['user_profile'];
$anotheruserName = $anotheruserRow['user_name'];
// echo "<br>";
// echo "another user is : $anotheruserName";




// echo "<br>";
// echo "current user id is : $currentUserId";
// echo "<br>";
// echo "another user id is : $another_userid";


$msgQuery = "SELECT * FROM messages WHERE sender = '$currentUserId' AND receiver = '$another_userid' OR sender = '$another_userid' AND receiver = '$currentUserId' ORDER BY date DESC";
$msgQueryResult = mysqli_query($conn, $msgQuery);
echo "<div class='msgContainer'>";
while($row = mysqli_fetch_array($msgQueryResult)){
    // echo "<h1>test</h1>";
$sender = $row['sender'];
$receiver = $row['receiver'];
$content = $row['content'];
$id = $row['id'];
echo "<div class='messageModal'>";
if($sender == $currentUserId){
    //<img src='./images/$currentuserProfile' alt='profile' class='profile'>
    echo "<div class='sender'>
    <p>   $current_user : $content</p>
    
    </div>";
}else{
    //<img src='./images/$anotheruserProfile' alt='profile' class='profile'>
    echo "<div class='receiver'>
    <p>   $anotheruserName : $content</p>

    </div>";
}
echo "</div>";
}
echo "</div>";
echo '<form action="" method="POST">
<input type="text" name="msg" placeholder="enter your message here">
<input type="submit" name="send" value="send" class="send">
</form> ';
if(isset($_POST['send'])){

    $msg = $_POST['msg'];
    if($msg ==""){
        echo '<script>alert("please enter a message")</script>';
    }else{
    
    
    $id = rand(1,9999999999);
    $msgQuery = "INSERT INTO messages (id, content, sender,receiver) VALUES('$id', '$msg', '$currentUserId', '$another_userid')";
    $msgQueryResult = mysqli_query($conn, $msgQuery);
    
    if($msgQueryResult){
        
        
        // echo '<script>alert("message sent")</script>';
        
        echo "<script>window.open('home.php?post_id=$post_id','_self')</script>";
    }
    else{
        echo "kindly wait 5 second or more and then refresh the page";
    }
}}




?>
    
    </body>
</html>