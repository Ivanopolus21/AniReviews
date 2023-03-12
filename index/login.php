<?php
    session_start();
    include_once('../php_connections/login_connection.php');
    global $nameErr;
    global $csrf_token;
    global $passErr;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content= "width=device-width, initial-scale=1.0">
    <link rel="icon" href="../ania_icon.ico" type="image/x-icon">
    <link rel = 'stylesheet' href = '../login/login.css'>
    <script defer src = '../login/login.js'></script>
    <title>Login</title>
</head>
<body>
    <nav>
        <ul>
          <li class = 'nav_border_top'>
            <a href='index.php'>
              <h3>Main Page</h3>
            </a>
          </li>
          <li class = 'nav_border_bot'>
            <a href='rating.php' >
              <h3>Rating</h3>
            </a>
          </li>
        </ul>
    </nav>
    <form method = 'POST' id = 'form' name="login">
        <fieldset id='login' >
            <h3>Log in</h3>
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div class = 'validation'>
                <label for="username">Username</label>
                <input type='text' name = 'username' id="username" placeholder="Your username" pattern = '.{3,}' title = 'Your username must contain at least 3 characters' value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>" required>
                <div class = 'error'></div>
                <div class="error"> <?php echo htmlspecialchars($nameErr); ?> </div>
            </div>
            <br>
            <div class = 'validation'>
                <label for="password">Password</label>
                <input type='password' name = 'password' id="password" placeholder="Your password" required>
                <div id = 'low_things'>
                    <label for = 'passwordToggle' class="show_pass" >Click to show your password:</label>
                    <input type = 'checkbox' id = 'passwordToggle'>
                </div>
                <div class = 'error'></div>
                <div class="error"> <?php echo htmlspecialchars($passErr); ?> </div>
            </div>
            <hr>
            <button type = 'submit'  id = 'button' name = 'login'>LOGIN</button> <br>
            <p>Don't have an account yet? <br> <a href = 'registration.php' title="Register now!">Register now! </a></p>
            <!-- <a href = '/Main_page/index.php' title = 'Return to the main page' id = 'link-to-return'>Return to the main page</a> -->
        </fieldset>
    </form>
</body>
</html>