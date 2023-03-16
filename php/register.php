<?php 
var_dump($_POST); 

// Connect to MongoDB server
$mongo_client = new MongoDB\Client('mongodb://localhost:27017'); 
$db = $mongo_client->testdb;

// Connect to MySQL server
$mysql_conn = mysqli_connect("localhost", "root", "", "testdb");

// Get form data
$name = $_POST['name'];
$dob = $_POST['dob'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$work = $_POST['work'];

// Insert data into MongoDB collection
$mongo_collection = $db->user_details;
$data = array(
	'name' => $name,
	'dob' => $dob,
	'email' => $email,
	'contact' => $contact,
	'address' => $address,
	'work' => $work
);
$mongo_collection->insert($data);

// Insert data into MySQL table using prepared statement
$stmt = mysqli_prepare($mysql_conn, "INSERT INTO users (username, password) VALUES (?, ?)");
mysqli_stmt_bind_param($stmt, "ss", $username, $password);

if (mysqli_stmt_execute($stmt)) {
    echo "Registration successful!";
} else {
    echo "Error: " . mysqli_stmt_error($stmt);
}

// Close database connections
mysqli_stmt_close($stmt);
mysqli_close($mysql_conn);
$mongo_client->close();
?>
