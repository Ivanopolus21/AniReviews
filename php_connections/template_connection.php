<?php
    /**
     * The ID of the review to display
     * @var int|null $id
     */
    $id = $_GET['id'];
    /**
     * Connects to the database
     * @var $conn
     */
//    $conn = new mysqli('localhost', 'root', '', 'login_db');
            $conn = new mysqli('localhost', 'yeremiva', 'webove aplikace', 'yeremiva');
    /**
     * Check for connection errors
     */
    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    } else {
        $sql="SELECT*FROM reviews";
        $rs_result=mysqli_query($conn, $sql);
        /**
         * Total number of reviews in the database
         * @var int $total_records
         */
        $total_records=mysqli_num_rows($rs_result);
        /**
         * Validates the review ID. If the ID was written using not ints or the number is greater
         * than the actual number of reviews, then it throws an error
         */
        if (!is_numeric($id) || $id <= 0 || $id> $total_records) {
            exit("You have written bad location, turn back and try again");
        }
        $sql = "SELECT*FROM reviews limit 0,10";
        $result = mysqli_query($conn, $sql);
        $result = mysqli_query($conn, "SELECT * FROM reviews WHERE id='$id' ");
        /**
         * Associative array of review data
         * @var array $resultArray
         */
        $resultArray = mysqli_fetch_assoc($result);
        /**
         * Title of the review
         * @var string $title
         */
        $title = $resultArray["title"];
        /**
         * Rating for the plot of the anime
         * @var int $plot_rate
         */
        $plot_rate = $resultArray["plot_rate"];
        /**
         * My opinion about the plot of the anime
         * @var string $plot_description
         */
        $plot_description = $resultArray["plot_description"];
        /**
         * Rating for the humour in the anime
         * @var int $humour_rate
         */
        $humour_rate = $resultArray["humour_rate"];
        /**
         * My opinion about the humour in the anime
         * @var string $humour_description
         */
        $humour_description = $resultArray["humour_description"];
        /**
         * Rating for the characters in the anime
         * @var int $characters_rate
         */
        $characters_rate = $resultArray["characters_rate"];
        /**
         * My opinion about the characters in the anime
         * @var string $characters_description
         */
        $characters_description = $resultArray["characters_description"];
        /**
         * Image of the characters in the anime
         * @var string $characters_img
         */
        $characters_img = $resultArray["characters_img"];
        /**
         * Rating for the music in the anime
         * @var int $music_rate
         */
        $music_rate = $resultArray["music_rate"];
        /**
         * My opinion about the music in the anime
         * @var string $music_description
         */
        $music_description = $resultArray["music_description"];
        /**
         * Rating for the animation in the anime
         * @var int $animation_rate
         */
        $animation_rate = $resultArray["animation_rate"];
        /**
         * My opinion about the animation in the anime
         * @var string $animation_description
         */
        $animation_description = $resultArray["animation_description"];
        /**
         * GIF of the animation in the anime
         * @var string $animation_gif
         */
        $animation_gif = $resultArray["animation_gif"];
        /**
         * Rating for the ending of the anime
         * @var int $ending_rate
         */
        $ending_rate = $resultArray["ending_rate"];
        /**
         * My opinion about the ending of the anime
         * @var string $ending_description
         */
        $ending_description = $resultArray["ending_description"];
        /**
        * /**
         * Total score for the anime
         * @var int $resultArray
         */
        $total = $resultArray["total"];
        /**
         * Some similar animes to the one that was reviewed
         * @var bool $recommended
         */
        $recommended = $resultArray["recommended"];
        /**
         * Additional thoughts about the anime
         * @var string $afterwords
         */
        $afterwords = $resultArray["afterwords"];
        /**
         * Citation from the anime
         * @var string $cite
         */
        $cite = $resultArray["cite"];
        /**
         * Image of the poster of the anime
         * @var string $poster
         */
        $poster = $resultArray["poster"];
        /**
         * Genre of the anime at the rating page
         * @var string $genre
         */
        $genre = $resultArray["genre"];
        /**
         * Additional information of the anime at the rating page
         * @var string $more
         */
        $more = $resultArray["more"];
        /**
         * Get the comments for the review
         * @var $query
         */
        $query = "SELECT * FROM comments WHERE review_id = $id ORDER BY id DESC";
        /**
         * Statement to prepare and execute the comment query
         * @var $stmt
         */
        $stmt = $conn->prepare($query);
        $stmt->execute();
        /**
         * Result set for the comment query
         * @var $result
         */
        $result = $stmt->get_result();
        /**
         * Array of all comments for the current review
         * @var $comments
         */
        $comments = $result->fetch_all(MYSQLI_ASSOC);
        /**
         * Post a comment when the request method is POST
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
            if ($post_token != $_SESSION['csrf_token']) {
                die('Invalid CSRF token');
            }
            /**
             * Filtered comment that was given through POST
             * @var $comment
             */
            $comment=$_POST['comment'];
//            $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
            /**
             * Comment validation for emptiness
             */
            if (empty($comment)) {
                $_SESSION['comment_error'] = 'Please enter a valid comment';
                /**
                 * Comment validation for its length (min - 1 char., max - 5000 char.)
                 */
            } elseif (preg_match('/^.{1,5000}$/', $comment)) {
                /**
                 * Gets the username of the person that leaves a comment
                 * @var $username
                 */
                $username = $_POST['name'];
                /**
                 * Statement to prepare and execute the insertion of a new comment
                 * @var mysqli_stmt $stmt
                 */
                $stmt = $conn->prepare("insert into comments (review_id, username, comment_description)
                                   values(?, ?, ?)");
                $stmt->bind_param("iss", $id, $username, $comment);
                $stmt->execute();
                $stmt->close();
                $conn->close();
                /**
                 * Generate a new CSRF token for the form
                 */
                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                /**
                 * Variable that keeps an url the same after adding a comment
                 * @var $url
                 */
                $url = "template.php?id=$id";
                header("Location: $url");
                exit();
            } else {
                /**
                 * Throw an error if the comment is too long
                 */
                $_SESSION['comment_error'] = 'Please enter a shorter comment';
                $_SESSION['comment_text'] = $comment;
            }

            if(!empty($_SESSION['comment_error'])){
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit();
            }
        }
        /**
         * If statement to DELETE button to interact
         */
        if (isset($_POST['delete'])) {
            /**
             * Gets the comment ID
             * @var $comment_id
             */
            $comment_id = mysqli_real_escape_string($conn, $_POST['comment_id']);
            /**
             * Delete the comment from the database comparing IDs
             * @var $sql
             */
            $sql = "DELETE FROM comments WHERE id=$comment_id";
            mysqli_query($conn, $sql);
            /**
             * Variable that keeps an url the same after deleting a comment
             * @var $url
             */
            $url = "template.php?id=$id";
            header("Location: $url");
            exit();
        }
    }







//    $id = $_GET['id'];
//
//    $conn = new mysqli('localhost', 'root', '', 'login_db');
////        $conn = new mysqli('localhost', 'yeremiva', 'webove aplikace', 'yeremiva');
//
//    if ($conn->connect_error) {
//        die("Connection error: " . $conn->connect_error);
//    } else {
//        //        find out the number of rows in db
//        $sql="SELECT*FROM reviews";
//        $rs_result=mysqli_query($conn, $sql);
//        $total_records=mysqli_num_rows($rs_result);
//        if (!is_numeric($id) || $id <= 0 || $id> $total_records) {
//            exit("You have written bad location, turn back and try again");
//        }
//        $sql = "SELECT*FROM reviews limit 0,10";
//        $result = mysqli_query($conn, $sql);
//        $result = mysqli_query($conn, "SELECT * FROM reviews WHERE id='$id' ");
//        $resultArray = mysqli_fetch_assoc($result);
//
//        $title = $resultArray["title"];
//        $plot_rate = $resultArray["plot_rate"];
//        $plot_description = $resultArray["plot_description"];
//        $humour_rate = $resultArray["humour_rate"];
//        $humour_description = $resultArray["humour_description"];
//        $characters_rate = $resultArray["characters_rate"];
//        $characters_description = $resultArray["characters_description"];
//        $characters_img = $resultArray["characters_img"];
//        $music_rate = $resultArray["music_rate"];
//        $music_description = $resultArray["music_description"];
//        $animation_rate = $resultArray["animation_rate"];
//        $animation_description = $resultArray["animation_description"];
//        $animation_gif = $resultArray["animation_gif"];
//        $ending_rate = $resultArray["ending_rate"];
//        $ending_description = $resultArray["ending_description"];
//        $total = $resultArray["total"];
//        $recommended = $resultArray["recommended"];
//        $afterwords = $resultArray["afterwords"];
//        $cite = $resultArray["cite"];
//        $poster = $resultArray["poster"];
//        $genre = $resultArray["genre"];
//        $more = $resultArray["more"];
//
//        $query = "SELECT * FROM comments WHERE review_id = $id ORDER BY id DESC";
//        $stmt = $conn->prepare($query);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        $comments = $result->fetch_all(MYSQLI_ASSOC);
//
//        if (isset($_POST['submit'])) {
//            // Validate the CSRF token
//            if ($_POST['csrf_token'] != $_SESSION['csrf_token']) {
//                die('Invalid CSRF token');
//            }
//
//            $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_STRING);
//            if (empty($comment)) {
//                $_SESSION['comment_error'] = 'Please enter a valid comment';
//            } elseif (preg_match('/^.{1,5000}$/', $comment)) {
//                $username = htmlspecialchars($_POST['name']);
//                //          $comment = htmlspecialchars($_POST['comment']);
//                // Insert the comment into the database
//                $stmt = $conn->prepare("insert into comments (review_id, username, comment_description)
//                               values(?, ?, ?)");
//                $stmt->bind_param("iss", $id, $username, $comment);
//                $stmt->execute();
//                $stmt->close();
//                $conn->close();
//                // Generate a new CSRF token for the form
//                $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
//                //reload the page
//                $url = "template.php?id=$id";
//                header("Location: $url");
//                exit();
//            } else {
//                $_SESSION['comment_error'] = 'Please enter a shorter comment';
//            }
//
//            if(!empty($_SESSION['comment_error'])){
//                header('Location: ' . $_SERVER['REQUEST_URI']);
//                exit;
//            }
//        }
//        if (isset($_POST['delete'])) {
//            // Get the comment ID from the form
//            $comment_id = mysqli_real_escape_string($conn, $_POST['comment_id']);
//            // Delete the comment from the database
//            $sql = "DELETE FROM comments WHERE id=$comment_id";
//            mysqli_query($conn, $sql);
//            //reload the page
//            $url = "template.php?id=$id";
//            header("Location: $url");
//            exit;
//        }
//    }