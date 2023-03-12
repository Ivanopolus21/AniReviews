<?php
    /**
     * Generates a new CSRF token if one does not already exist
     * in the current session
     */
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    /**
     * CSRF token that stores in the current session
     * @var string $csrf_token
     */
    $csrf_token = $_SESSION['csrf_token'];
    /**
     * Initializes variables used to store error messages
     * for form validation
     * @var string
     */
    $nameErr="";
    $passErr="";
    /**
     * Validates form input and processes form submission
     */
    if (isset($_POST['login'])) {
        /**
         * @var string $post_token CSRF token from the submission form
         */
        $post_token = $_POST['csrf_token'];
        /**
         * Verifies that the CSRF token in the form submission
         * matches the one stored in the current session
         */
        if ($post_token !== $csrf_token) {
            exit("Something went wrong... Try again");
        }
        /**
         * Username value from the submission form
         * @var string $username
         */
        $username = $_POST['username'];
        /**
         * Password value from the submission form
         * @var string $password
         */
        $password = $_POST['password'];
        /**
         * Sanitizes user input by removing leading and trailing
         * whitespace, and converting special characters to
         * HTML entities
         * @param string $data
         * @return string
         */
        function testInput($data): string
        {
            $data = trim($data);
            $data = stripslashes($data);
            return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
        }
        /**
         * Validates form input when the request method is POST
         */
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if (empty($username)) {
                $nameErr = "Username is required";
            } else {
                if (strlen($username) < 8) {
                    $nameErr = "Username must contain more than 8 characters";
                }
                if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                    $nameErr = "Username can contain only letters and numbers!";
                }
                $username = testInput($username);
            }

            if (empty($password)) {
                $passErr = "Password is required";
            } else {
                if (strlen($password) < 8) {
                    $passErr = "Password must contain more than 8 characters";
                }
                if (!preg_match('/^[a-zA-Z0-9_]+$/', $password)) {
                    $passErr = "Password can contain only letters and numbers!";
                }
                $password = testInput($password);
            }
        }
        /**
         * Attempts to log the user in if all input is valid
         */
        if ($nameErr === "" && $passErr === "") {
            /**
             * Connects to the database
             * @var mysqli
             */
//            $conn = new mysqli('localhost', 'root', '', 'login_db');
                $conn = new mysqli('localhost', 'yeremiva', 'webove aplikace', 'yeremiva');
            /**
             * Check for connection errors
             */
            if ($conn->connect_error) {
                die("Connection error: " . $conn->connect_error);
            } else {
                /**
                 * Retrieves the salt from the database for the user with the provided username
                 * @var mysqli_result
                 */
                $result = mysqli_query($conn, "SELECT salt FROM registration WHERE username='$username' ");
                $resultArray = mysqli_fetch_assoc($result);
                /**
                 * If no user with the provided username was found in the database,
                 * displays an error message
                 */
                if ($resultArray == null) {
                    $nameErr = "It seems like you don't have an account yet. Try to register!";
                } else {
                    /**
                     * Users' salt from the database
                     * @var string $salt
                     */
                    $salt = $resultArray["salt"];
                    /**
                     * Hashes password with a salt
                     * @var string $hashed_password
                     */
                    $hashed_password = md5($password . $salt);
                    /**
                     * Retrieves the value of the "admin" field for the user with the
                     * provided username
                     * @var mysqli_result
                     */
                    $new_result = mysqli_query($conn, "SELECT admin FROM registration WHERE username='$username' ");
                    $check_admin = mysqli_fetch_assoc($new_result);
                    $admin_value = $check_admin["admin"];
                    /**
                     * Attempts to log the user in by checking if there is a user with the
                     * provided username and hashed password in the database
                     * @var mysqli_result
                     */
                    $sql = "SELECT * FROM registration WHERE username='$username' && password='$hashed_password'";
                    $gry = mysqli_query($conn, $sql) or die("Login problems");
                    /**
                     * Number of rows with the same username and password in the database
                     * @var $count
                     */
                    $count = mysqli_num_rows($gry);
                    if ($count === 1) {
                        /**
                         * Sets session variables if the login was successful
                         */
                        $_SESSION['user'] = $username;
                        $_SESSION['admin'] = $admin_value;
                        header('Location: ../index/index.php');
                        exit();
                    } else {
                        /**
                         * Displays an error message if the login was unsuccessful
                         */
                        $nameErr = "Your username or password is incorrect. Please try again!";
                    }
                    $conn->close();
                }
            }
        }
    }








//
//
//    if (!isset($_SESSION['csrf_token'])) {
//        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
//    }
//    $csrf_token = $_SESSION['csrf_token'];
//
//    $nameErr="";
//    $passErr="";
//
//    if (isset($_POST['login'])) {
//
//        $post_token = $_POST['csrf_token'];
//        if ($post_token !== $csrf_token) {
//            exit("Something went wrong.... Try again");
//        }
//        $username = $_POST['username'];
//        $password = $_POST['password'];
//
//        function testInput($data): string
//        {
//            $data = trim($data);
//            $data = stripslashes($data);
////            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
//            return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
//        }
//
//        //        inputs validation
//        if ($_SERVER["REQUEST_METHOD"] === "POST") {
//
//            if (empty($username)) {
//                $nameErr = "Name is required";
//            } else {
//                if (strlen($username) < 8) {
//                    $nameErr = "Name is must contain more than 8 characters";
//                }
//                $username = testInput($username);
//            }
//            if (empty($password)) {
//                $passErr = "Password is required";
//            } else {
//                if (strlen($password) < 8) {
//                    $passErr = "Password is must contain more than 8 characters";
//                }
//                $password = testInput($password);
//            }
//        }
//
//        if ($nameErr === "" && $passErr === "") {
//
//            $conn = new mysqli('localhost', 'root', '', 'login_db');
////            $conn = new mysqli('localhost', 'yeremiva', 'webove aplikace', 'yeremiva');
//
//            if ($conn->connect_error) {
//                die("Connection error: " . $conn->connect_error);
//
//            } else {
//                $result = mysqli_query($conn, "SELECT salt FROM registration WHERE username='$username' ");
//                $resultArray = mysqli_fetch_assoc($result);
//                if ($resultArray == null) {
//                    $nameErr = "It seems like you don't have an account yet. Try to register!";
//                } else {
//                    $salt = $resultArray["salt"];
//                    $hashed_password = md5($password . $salt);
//                    //selecting admin from db
//                    $new_result = mysqli_query($conn, "SELECT admin FROM registration WHERE username='$username' ");
//                    $check_admin = mysqli_fetch_assoc($new_result);
//                    $admin_value = $check_admin["admin"];
//
//                    $sql = "SELECT * FROM registration WHERE username='$username' && password='$hashed_password'";
//                    $gry = mysqli_query($conn, $sql) or die("Login problems");
//                    $count = mysqli_num_rows($gry);
//                    if ($count === 1) {
//
//                        $_SESSION['user'] = $username;
//                        $_SESSION['admin'] = $admin_value;
//                        header('Location: ../index/index.php');
//                        exit();
//
//                    } else {
//                        $nameErr = "Your username or password is incorrect. Please try again!";
//                    }
//
//                    $conn->close();
//                }
//            }
//        }
//    }