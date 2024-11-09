<?php
    session_start();

    if (isset($_SESSION['errorMessage'])) {
        echo '<p style="color: red;">' . $_SESSION['errorMessage'] . '</p>';
        unset($_SESSION['errorMessage']); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css"> 
</head>
<body>

<?php
    session_start();
?>
<form action = "login-submit.php" method = "POST">
    <fieldset>
        <h1>Sign in!</h1>
        <label for = "username"><strong>Username:</strong></label>
        <input type = "text" placeholder="Username" size = "16" name = "Username" required></br>
        <label for = "password"><strong>Password:</strong></label>
        <input type = "password" placeholder="Password" size = "16" name = "Password" required></br>
        <input type = "submit" name="Submit" value = "Login"/>
        <p>Don't have an account? <a href = "register.php">Register Now!</a></p>
    </fieldset>
            
</form>

</body>
</html>