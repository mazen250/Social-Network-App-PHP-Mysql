<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles/edit.css">
    <title>Edit Your Profile</title>
</head>
<body>

<div class="header">
      
      <a href="home.php" style="text-decoration:none; color:black">
  
          <h1 style="font-size: 1.5rem;">The Social Network</h1> 
      </a>
          
      <a href="profile.php" class="profileLink">Your Profile</a>

          <!-- logout start -->
        
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
  
          <!-- change password
          <a href="edit.php" style="text-decoration:none; color:black">edit profile </a>
          
  
          <?php ?> -->
  
  
      </div>

<?php
 include("includes/connection.php");
 session_start();

 $name = $_SESSION['user_name'];

 $userQuery = "SELECT * FROM user WHERE user_name = '$name'";
    $query = mysqli_query($conn, $userQuery);
    $row = mysqli_fetch_array($query);
    $user_id = $row['user_id'];
    $password = $row['password'];
    $profilePic = $row['user_profile'];
    echo "<br>";
    // echo "real user password is $password";
    echo "<br>";
    if(isset($_POST['submitNewPassword'])){
        $old_password = $_POST['oldPassword'];
        $new_password = $_POST['newPassword'];
        echo "<br>";
        // echo "old password : $old_password";
        // echo " new password : $new_password";
        // echo "<script>window.open('edit.php','_self') </script>";

        if($old_password===$password){
            echo "<script>alert('password matched!!')</script>";
            // echo "<script>window.open('edit.php','_self') </script>";
            $update = "UPDATE user SET password='$new_password' WHERE user_id='$user_id' ";
           $update_exec = mysqli_query($conn,$update);
           if($update_exec){
               echo "record upadted!!";
               session_destroy();
        echo "<script>window.open('login.php','_self') </script>";
           }
           else{
               echo "<script>alert('record couldnot update')</script>";
               echo "<script>window.open('edit.php','_self') </script>";
            }
        }
        else {
            echo "<script>alert('password not matched')</script>";
            // echo "<script>window.open('edit.php','_self') </>";
        }
    }

?>

<!-- start of change username function -->

<?php

 if(isset($_POST['submitNewUserName'])){
     $newUserName = $_POST['newUserName'];
     echo "$newUserName";
     echo "$user_id";
     $usernameQ = "UPDATE user SET user_name='$newUserName' WHERE user_id='$user_id'";

     $nameQ_exec = mysqli_query($conn,$usernameQ);

    if("$nameQ_exec"){
        echo "alert('record upadted!!')";
        // echo "$newUserName";
        // echo "$user_id";
        session_destroy();
        echo "<script>window.open('login.php','_self') </script>";
        
    }
    else {
        echo "<script>alert('password not matched')</script>";
        echo "<script>window.open('edit.php','_self') </>";
    }
    exit();
 }

?>
<!-- end of change username function -->

<!-- form for change the password start -->
 <h1>Change Password</h1>
<form action="" method="POST" class="form">
            <input type="text" placeholder="enter your old password" name="oldPassword">
            <input type="text" name="newPassword" placeholder="enter your new password">
            <input type="submit" name="submitNewPassword">
        </form>
        <!-- form for change the password end -->
        
<!-- form for change the usernam start -->
<h1>Change Username</h1>
<form action="" method="POST" class="form">
            <input type="text" placeholder="enter your new username" name="newUserName">
         
            <input type="submit" name="submitNewUserName">
        </form>
        <!-- form for change the username end -->
        <h1>Change Profile Picture</h1>
        <form action="" method="POST" enctype="multipart/form-data" class="form">
            <label for="">choose a new profile picture </label>
            <input type="file" name="profilePic" >
            <input type="submit" name="submitProfilePic">
        </form>

        <?php 
        // echo "<br>";
        // echo "user id is $user_id";
        // echo "<br>";
        // echo "user name is $name";
        // echo "<br>";
        // echo "user profile is $profilePic";
        if(isset($_POST['submitProfilePic'])){
            $profilePic = $_FILES['profilePic']['name'];
            $profilePic_temp = $_FILES['profilePic']['tmp_name'];

     move_uploaded_file($profilePic_temp,"images/".$profilePic);
            $update_profile = "UPDATE user SET user_profile='$profilePic' WHERE user_id='$user_id'";
            $update_profile_exec = mysqli_query($conn,$update_profile);
            if($update_profile_exec){
                echo "profile pic updated";
                echo "<script>window.open('profile.php','_self') </script>";
            }
            else{
                echo "profile pic not updated";
                // echo "<script>window.open('profile.php','_self') </script>";
            }
        }
        ?>
        
    <div class="footer">
        <p>&copy; social network team</p>
    </div>
</body>
</html>


