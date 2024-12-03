<?php
session_start(); // Start the session

// Debugging: Check if session exists before unset
if (isset($_SESSION)) {
    echo "Session exists before unsetting:<br>";
    var_dump($_SESSION);
}

// Unset all session variables
$_SESSION = array();

// Check if session uses cookies and delete session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]
    );
}

// Finally, destroy the session
// session_destroy();

// // Debugging: Check if session is destroyed
// if (!isset($_SESSION)) {
//     echo "Session successfully destroyed.<br>";
// } else {
//     echo "Session still exists:<br>";
//     var_dump($_SESSION);
// }

// Redirect to the login page or homepage
header("Location: log.php");
exit();
?>
