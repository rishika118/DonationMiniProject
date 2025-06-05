<?php
// Database connection
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = "Rishika@1"; // Your database password
$dbname = "ngo_donors"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get data from form
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Password hashing

// SQL query to insert data
$sql = "INSERT INTO donors (first_name, last_name, email, phone, address, password) 
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$address', '$password')";

if ($conn->query($sql) === TRUE) {
  echo "<center><h2>New Donor Registered Successfully!</h2></center>";
  echo "<center><a href='donor_login.html'><button style='padding:10px 20px; font-size:16px; background-color:#4CAF50; color:white; border:none; border-radius:5px; cursor:pointer;'>Login</button></a></center>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
