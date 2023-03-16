<?php
session_start();

// Check if user is already logged in
if(isset($_SESSION['username'])) {
    header("Location: profile.php"); 
    exit(); 
} 

// Connect to MySQL server
$mysql_conn = mysqli_connect("localhost", "root", "", "testdb");

// Check if the form is submitted
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the user exists in the MySQL database
    $stmt = mysqli_prepare($mysql_conn, "SELECT password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashed_password);
    mysqli_stmt_fetch($stmt);

    // Verify password and set session variables
    if(password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = true;

        // Set Redis session variables
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->setex($_SESSION['username'], 3600, session_id());

        header("Location: profile.php");
        exit();
    } else {
        echo "Invalid username or password";
    }

    // Close MySQL statement
    mysqli_stmt_close($stmt);
}

// Close MySQL connection
mysqli_close($mysql_conn);

// Check if logout is requested
if(isset($_GET['logout'])) {
    session_unset();
    session_destroy();

    // Remove Redis session variable
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $redis->del($_SESSION['username']);

    header("Location: login.php");
    exit();
}
?>

