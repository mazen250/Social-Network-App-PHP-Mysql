<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/login.css"/>
    <title>Login</title>
</head>
<body>
    <div class="header">
        <h1 style="font-size: 1.5rem;">the social network</h1> 
    </div>
    <div class="container">
    <div class="left"></div>
    <div class="right">
    <!-- <div class="main"> 
        
    </div> -->
   
   <div class="form">
   <form action="userLogin.php" method="POST">
        <input type="text" name="username" placeholder="enter your username">
        <!-- <input type="text" name="email" placeholder="enter your email"> -->
        <input type="text" name="pass" placeholder="enter your password please">
        <input type="submit" value="login" 
        name="submit" class="submit"> 
        
        <p style="margin-top: 20px">don't have account yet?</p>
        <a href="./signUp.php" class="link">signup</a>
        
    </form>
   </div>
  
    </div>
    </div>
    
   
    <div class="footer">
        <p>&copy; social network team</p>
    </div>
    <?php 

    ?>
</body>
</html>