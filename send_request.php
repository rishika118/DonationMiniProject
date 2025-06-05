<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$donor_id = $_POST['donor_id'];
$campaign_id = $_POST['campaign_id'];
$charity_id = 1; // Replace with actual logged-in charity ID
$request_date = date('Y-m-d H:i:s');
$status = 'pending';

// Insert donation request
$stmt = $conn->prepare("INSERT INTO donation_requests (donor_id, charity_id, campaign_id, request_date, status) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("iiiss", $donor_id, $charity_id, $campaign_id, $request_date, $status);

if ($stmt->execute()) {
    echo "<script>alert('Donation request sent.'); window.location.href='charity_dashboard.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
