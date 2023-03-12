<?php
    /**
    * Starts a new session or resumes an existing one
    */
    session_start();
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
    * for PHP form validation
    * @var $nameErr
     */
    $nameErr = $emailErr = $birthErr = $passErr = "";
    /**
    * Validates form input and processes form submission
    */
    if (isset($_POST['submit'])) {
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
        * Username value from the submission form
        * @var string $username
        */
        $username = $_POST['username'];
        /**
        * Birthday value from the submission form
        * @var string $birthday
        */
        $birthday = $_POST['birthday'];
        /**
        * Variable that stores result of the function "string to time"
        * @var string $timestamp
        */
        $timestamp = strtotime($birthday);
        /**
        * Validates that the birthday is not in the future
        */
        if ($timestamp > time()) {
            $birthErr = "Birthday cannot be in the future";
        } else {
            $birthday = explode(".", $birthday);
            $birthday = $birthday[0];
        }
        /**
        * Email value from the submission form
        * @var string $email
        */
        $email = $_POST['email'];
        /**
        * Password value from the submission form
        * @var string $password
        */
        $password = $_POST['password'];
        /**
         * Random salt creation
         * @var $salt
         */
        $salt = bin2hex(random_bytes(32));
        /**
         * Hashes password with the salt
         * @var $hashed_password
         */
        $hashed_password = md5($password . $salt);
        /**
         * Validates form input when the request method is POST
         */
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (empty($username)) {
                $nameErr = "username is required";
            } else {
                if (strlen($username) < 8) {
                    $nameErr = "Username must contain more than 8 characters";
                }
                if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                    $nameErr = "Username can contain only letters and numbers!";
                }
                $username = testInput($username);
            }

            if (empty($birthday)) {
                $birthErr = "Birthday is required";
            } else {
                $birthday=testInput($birthday);
            }

            if (empty($email)) {
                $emailErr = "Email is required";
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                }
                $email = testInput($email);
            }

            if (empty($password)) {
                $passErr="Password is required";
            } else {
                if(strlen($password)<8) {
                    $passErr = "Password must contain more than 8 characters";
                }
                if (!preg_match('/^[a-zA-Z0-9_]+$/', $password)) {
                    $passErr = "Password can contain only letters and numbers!";
                }
                $password = testInput($password);
            }
        }
        /**
        * Inserts form data into the database if all input is valid
        */
        if($nameErr === "" && $birthErr === "" && $emailErr === "" && $passErr === "") {
            /**
            * Connects to the database
            * @var $conn
             */
//            $conn = new mysqli('localhost', 'root', '', 'login_db');
                        $conn=new mysqli('localhost', 'yeremiva', 'webove aplikace', 'yeremiva');
            /**
            * Check for connection errors
            */
            if ($conn->connect_error) {
                die("Connection error: " . $conn->connect_error);
            } else {
                /**
                 * Check if the user with this username or email is already in database
                 */
                /**
                 * Attempts to register the user by checking if there is not any other users with the
                 * provided username in the database
                 * @var $sql_u
                 */
                $sql_u = "SELECT*FROM `registration` WHERE username = '$username' ";
                $res_u = mysqli_query($conn, $sql_u) or die(mysqli_error($conn));
                /**
                 * Attempts to register the user by checking if there is not any other users with the
                 * provided email in the database
                 * @var $sql_e
                 */
                $sql_e = "SELECT*FROM `registration` WHERE email = '$email' ";
                $res_e = mysqli_query($conn, $sql_e) or die(mysqli_error($conn));
                /**
                 * Forcing user to take another nickname or email, because those one already exists in the database
                 */
                if (mysqli_num_rows($res_u) > 0) {
                    $nameErr = "Username is already taken. Please write another one!";
                } elseif (mysqli_num_rows($res_e) > 0) {
                    $emailErr = "Email is already taken. Please write another one!";
                } else {
                    /**
                     * If it is new user, inserts the values to the database
                     * @var $sql
                     */
                    $sql = "INSERT INTO `registration`(`username`, `email`, `birthday`, `salt`, `password`)
                    VALUES ('$username', '$email', '$birthday', '$salt', '$hashed_password')";
                    /**
                     * If registration was successfull, redirects user to login page
                     */
                    if (mysqli_query($conn, $sql)) {
                        header("location: login.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
        }
    }