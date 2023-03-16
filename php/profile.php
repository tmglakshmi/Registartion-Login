<?php
session_start();
if(isset($_SESSION['username'])) {
    echo "<p>Welcome " . $_SESSION['username'] . "!</p>";
    echo "<p>Your Name: " . $_SESSION['name'] . "</p>";
    echo "<p>Your Date of Birth: " . $_SESSION['dob'] . "</p>";
    echo "<p>Your Email ID: " . $_SESSION['email'] . "</p>";
    echo "<p>Your Contact: " . $_SESSION['contact'] . "</p>";
    echo "<p>Your Address: " . $_SESSION['address'] . "</p>";
    echo "<p>Your Work: " . $_SESSION['work'] . "</p>";
} 
else {
    header('Location: ../php/login.php');
}
?>
