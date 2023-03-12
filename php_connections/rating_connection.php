<?php
    /**
     * Starts a new session or resumes an existing one
     */
    session_start();
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
         * SELECT query to retrieve the first 10 reviews from the database
         * @var $sql
         */
        $sql = "SELECT*FROM reviews limit 0,10";
        /**
         * Result set for the SELECT query
         * @var mysqli_result $result
         */
        $result = mysqli_query($conn, $sql);
    }