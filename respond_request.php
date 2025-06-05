<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['request_id'], $_POST['action'])) {
    $request_id = intval($_POST['request_id']);
    $action = $_POST['action'];

    if ($action === 'rejected') {
        // Delete the donation request
        $stmt = $conn->prepare("DELETE FROM donation_requests WHERE id = ?");
        $stmt->bind_param("i", $request_id);

        if ($stmt->execute()) {
            // Redirect back to donation_requests.php
            header("Location: donation_requests.php?deleted=1");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>
