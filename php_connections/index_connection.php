<?php
    /**
     * Connects to the database
     * @var $conn
     */
//    $conn = new mysqli('localhost', 'root', '', 'login_db');
    $conn=new mysqli('localhost', 'yeremiva', 'webove aplikace', 'yeremiva');
    /**
     * Check for connection errors
     */
    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    } else {
        /**
         * Number of reviews to display per page
         * @var $num_per_page
         */
        $num_per_page=4;
        /**
         * Current page number
         * @var int|null $page
         */
        $page = $_GET["page"] ?? 1;
        $sql_war="SELECT*FROM reviews";
        $rs_result_war=mysqli_query($conn, $sql_war);
        /**
         * Total number of reviews in the database
         * @var int $total_records
         */
        $total_records=mysqli_num_rows($rs_result_war);
        /**
         * Total number of pages needed to display all reviews
         * @var float $total_pages
         */
        $total_pages=ceil($total_records/$num_per_page);
        /**
         * Validates the page number
         */
        if (!is_numeric($page) || $page <= 0 || $page > $total_pages) {
            exit("You have written bad location, turn back and try again");
        }
        /**
         * The index of the first review to display on the current page
         * @var int $start_from
         */
        $start_from = ($page - 1) * $num_per_page;
        $sql= "SELECT * FROM reviews limit $start_from, $num_per_page";
        /**
         * Result set for the SELECT query
         * @var mysqli_result $result
         */
        $result = mysqli_query($conn, $sql);
        /**
         * Array of reviews
         * @var $reviews
         */
        $reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);
        /**
         * Reversed array of reviews
         * @var $reversed_reviews
         */
        $reversed_reviews = array_reverse($reviews);
    }