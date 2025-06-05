<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Rishika@1";
$dbname = "ngo_donors"; // Replace with your actual DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$charity_name = $_POST['charity_name'];
$charity_cause = $_POST['charity_cause'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure hash

// Insert into database
$sql = "INSERT INTO charities (charity_name, charity_cause, email, phone, address, password)
        VALUES ('$charity_name', '$charity_cause', '$email', '$phone', '$address', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "<div style='text-align: center; font-family: Arial; margin-top: 100px;'>
            <h2>Charity registered successfully!</h2>
            <a href='charity_login.html'>
              <button style='padding: 10px 20px; font-size: 16px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;'>
                Go to Login
              </button>
            </a>
          </div>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
