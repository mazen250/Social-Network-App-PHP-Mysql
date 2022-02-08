<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="styles/signUp.css"/>
    <title>Sign Up</title>
</head>
<body>
<div class="header">
        <h1 style="font-size: 1.5rem;">the social network</h1> 
    </div>



    <form action="addUser.php" method="POST">
        <input type="text" name="Name" placeholder="Enter your Name">
        <input type="text" name="email" placeholder="Enter your Email">
        <input type="text" name="password" placeholder="Enter your  Password">
        <input type="date" name="date" >
        <input type="text" name="lives" placeholder="Enter where you Live">
        <input type="text" name="work" placeholder="Enter where you Work">
        <input type="text" name="gender" placeholder="enter your gender">
        <input type="tel" name="phone" placeholder="enter your phone">
        <input type="submit" name="submit" value="Sign Up" style="width: 70%; margin:auto; cursor:pointer">
    </form>
    
    <div class="footer">
        <p>&copy; Mazen-Hania</p>
    </div>
</body>
</html>