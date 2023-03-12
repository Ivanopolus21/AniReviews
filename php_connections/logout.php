<?php
/**
 * Starts a new session or resumes an existing one
 */
session_start();
/**
 * Unsets all session variables
 */
session_unset();
/**
 * Destroys the current session
 */
session_destroy();
/**
 * Redirects to the main page
 */
header("Location: ../index/index.php");