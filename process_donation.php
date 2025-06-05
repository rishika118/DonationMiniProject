<?php
// Database connection
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data from donation form
$charity_name = $_POST['charity'];
$campaign_name = $_POST['campaign'];
$payment_mode = $_POST['payment_mode'];
$donation_amount = $_POST['amount'];
$donor_id = 1; // Replace with logged-in donor ID logic

// Get the corresponding charity_id using charity_name
$charity_id = null;
$charity_stmt = $conn->prepare("SELECT id FROM charities WHERE charity_name = ?");
$charity_stmt->bind_param("s", $charity_name);
$charity_stmt->execute();
$charity_result = $charity_stmt->get_result();

if ($charity_result->num_rows > 0) {
    $charity_row = $charity_result->fetch_assoc();
    $charity_id = $charity_row['id'];
} else {
    die("Charity not found.");
}

// Generate a random transaction ID (alphanumeric)
$transaction_id = strtoupper(bin2hex(random_bytes(5))); // 10 chars long

// Current datetime
$paid_on = date('Y-m-d H:i:s');

// Insert into transactions table
$stmt = $conn->prepare("INSERT INTO transactions (transaction_id, charity_id, charity_name, campaign_name, payment_mode, donation_amount, paid_on, donor_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sisssssi", $transaction_id, $charity_id, $charity_name, $campaign_name, $payment_mode, $donation_amount, $paid_on, $donor_id);

if ($stmt->execute()) {
    echo "<script>
        alert('Payment Success. Thank You for the donation.');
        window.location.href = 'donor_home.html';
    </script>";
    exit;
} else {
    echo "Failed to process donation.";
}
?>
