<?php 

session_start();
include("./includes/connection.php");

// echo "mazen";
   
// $username = strtolower($_POST['username']) ;
// $password = strtolower($_POST['pass']);

// echo $username;
// echo $password;

if(isset($_POST['submit'])){
    
    
     $username = strtolower($_POST['username']) ;
    //$email = strtolower($_POST['email']) ;
    $password = $_POST['pass'];
    
      $user_query = "SELECT * FROM user WHERE user_name = '$username' AND password = '$password'";
    //$user_query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    
     $query = mysqli_query($conn, $user_query);
        $check = mysqli_num_rows($query);
    
        if($check ==1){
            // echo "<script>alert('Successfully logged in')</script>";
          echo "<script>window.open('home.php','_self')</script>";
            $_SESSION['user_name'] = $username;
            // $_SESSION['password'] = $password;
            // $_SESSION['user_id'] = $user_id;
            // $_SESSION['user_profile'] = $user_profile;
            // $_SESSION['posts'] = $posts;
            // $_SESSION['lives_in'] = $lives_in;
            // $_SESSION['works_at'] = $works_at;
            
        }
        else{
            echo "<script>alert('username or password is not matched please try again.')</script>";
            echo "<script>window.open('login.php','_self')</script>";
            // echo "<script>alert($username)</script>";
            // echo "<script>alert($password)</script>";
        }
}
?>