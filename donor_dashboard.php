<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form input
$email = $_POST['email'];
$password = $_POST['password'];

// Validate credentials
$sql = "SELECT * FROM donors WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Check hashed password
    if (password_verify($password, $row['password'])) {
        $_SESSION['donor_name'] = $row['first_name'];
        header("Location: donor_home.html");
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "No user found with that email.";
}

$conn->close();
?>
