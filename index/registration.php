<?php
    include_once('../php_connections/registration_connection.php');
    global $nameErr;
    global $birthErr;
    global $emailErr;
    global $passErr;
    global $csrf_token;
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../ania_icon.ico" type="image/x-icon">
    <link rel = 'stylesheet' href = '../login/registration.css'>
    <script defer src = '../login/registration.js'></script>
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
    <form method = 'POST' id = 'form'>
        <fieldset id='login'>
            <h3>Register</h3>
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div class = 'validation'>
                <label for="username">Username<span title = 'required' class = 'required'>*</span></label>
                <input type='text' name = 'username' id="username" placeholder="Your username" pattern = '.{3,}' title = 'Your username must contain at least 3 characters' value = "<?php if(isset($_POST['username'])) echo htmlspecialchars($_POST['username'], ENT_QUOTES); ?>" required>
                <div class = 'error'></div>
                <div class = "error"> <?php echo htmlspecialchars($nameErr); ?> </div>

            </div>
            <br>
            <div class = 'validation'>
                <label for="birthday">Birthday<span title = 'required' class = 'required'>*</span></label>
                <input type='date' name = 'birthday' id="birthday" title = 'You must type your birth date' value="<?php if(isset($_POST['birthday'])) echo $_POST['birthday']; ?>"  max="<?php echo date('Y-m-d'); ?>" required>
                <div class = 'error'></div>
                <div class="error"> <?php echo htmlspecialchars($birthErr); ?> </div>
            </div>
            <br>
            <div class="validation">
                <label for="email">Email<span title = 'required' class = 'required'>*</span></label>
                <input type='text' name = 'email' id="email" placeholder="Your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title = 'Example: ukraine@gmail.com' value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>" required>
                <div class = 'error'></div>
                <div class="error"> <?php echo htmlspecialchars($emailErr); ?> </div>
            </div>
            <br>
            <div class = "validation">
                <label for="password">Password<span title = 'required' class = 'required'>*</span></label>
                <input type='password' name = 'password' id="password" placeholder="Your password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php if(isset($_POST['password'])) echo ""; ?>" required>
                <div class="error"> <?php echo htmlspecialchars($passErr); ?> </div>
                <div id = 'low_things'>
                    <label for = 'passwordToggle' class="show_pass" >Click to show your password:</label>
                    <input type = 'checkbox' id = 'passwordToggle'>
                 </div>
                <span class = 'means_required'>* — means required</span>
                <div class = 'error'></div>
            </div>
            <hr>
            <button type = 'submit' name = 'submit' id = 'button'>REGISTER</button> <br>
            <p>Already have an account? <br><a href = 'login.php' title="Log in now!">Log in now! </a></p>
        </fieldset>
    </form>
</body>
</html>