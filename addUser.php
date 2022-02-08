<?php
include("./includes/connection.php");

// if($_POST['submit']){
//     $name = $_POST['Name'];
//     $email = $_POST['email'];
//     $password = $_POST['password'];
//     $date = $_POST['date'];
//     $query = "INSERT INTO users (name, email, password, date) VALUES ('$name', '$email', '$password', '$date')";
//     $result = mysqli_query($conn, $query);
//     if($result){
//         echo "Successfully registered";
//     }else{
//         echo "Error";
//     }
// }

    if($_POST['submit']){
        $userid = rand(0,1111111);
        $name = strtolower($_POST['Name']) ;
        $email = strtolower($_POST['email']);
        $password = $_POST['password'];
        $date = $_POST['date'];
        $lives = $_POST['lives'];
        $work = $_POST['work'];
        $gender =$_POST['gender'];
        $phone = $_POST['phone'];
        $posts="no";
        // $newid = sprintf("%05d",rand(0,999999));
        $user_profile = "profile.png";

        $query = "INSERT INTO user (user_id,user_name, email, password, born_at,lives_in, works_at, gender, mobile, user_profile , posts) VALUES ('$userid','$name', '$email', '$password', '$date' , '$lives' ,'$work' ,' $gender', '$phone' , '$user_profile', '$posts')";
        $result = mysqli_query($conn, $query);
        if($result){
            echo "<script>alert('Successfully registered')</script>";
            echo "<script>window.open('login.php','_self')</script>";

        }else{
            echo "coudn't register - please try again";
        }

    }

?>