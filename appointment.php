<?php

// Database connection settings
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "doctor_appointments"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from POST request
$data = json_decode(file_get_contents('php://input'), true);
$date = $conn->real_escape_string($data['date']);
$time = $conn->real_escape_string($data['time']);
$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);
$doctor = $conn->real_escape_string($data['doctor']);

// Insert data into database
$sql = "INSERT INTO appointments (date, time, name, email, doctor)
        VALUES ('$date', '$time', '$name', '$email', '$doctor')";

if ($conn->query($sql) === TRUE) {
    http_response_code(200);
} else {
    http_response_code(500);
}

$conn->close();

?>
