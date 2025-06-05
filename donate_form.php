<?php
$charity = $_GET['charity'] ?? '';
$campaign = $_GET['campaign'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Donate Now</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 40px;
      text-align: center;
    }

    .container {
      background: white;
      padding: 40px;
      margin: auto;
      width: 60%;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    h2 {
      color: green;
      margin-bottom: 30px;
    }

    label {
      display: block;
      margin: 15px 0 5px;
      font-weight: bold;
      text-align: left;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .payment-logos {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin: 20px 0;
    }

    .payment-logos img {
      width: 60px;
      height: auto;
    }

    .radio-options {
      display: flex;
      justify-content: center;
      gap: 50px;
      font-weight: bold;
    }

    .donate-btn {
      background-color: #28a745;
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .donate-btn:hover {
      background-color: #218838;
    }
  </style>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
  }
  ?>
</head>

<body>
  <div class="container">
    <h2>THANK YOU FOR YOUR DONATION</h2>
    <form action="process_donation.php" method="post">
      <label>Charity Name</label>
      <input type="text" name="charity" value="Sankalp Foundation" readonly />

      <label>Campaign Name</label>
      <input type="text" name="campaign" value="Education & Training" readonly />

      <label>Payment Mode</label>
      <div class="payment-logos">
        <img src="./assets/visa.png" alt="Visa">
        <img src="./assets/amex.png" alt="American Express">
        <img src="./assets/mastercard.png" alt="MasterCard">
        <img src="./assets/paypal.png" alt="PayPal">
      </div>

      <div class="radio-options">
        <label><input type="radio" name="payment_mode" value="Net Banking" required> Net Banking</label>
        <label><input type="radio" name="payment_mode" value="Credit/Debit Card"> Credit/Debit Card</label>
      </div>

      <label>Donation Amount</label>
      <input type="number" name="amount" placeholder="Enter amount" required>

      <button type="submit" class="donate-btn">DONATE NOW</button>
    </form>
  </div>

  <script>
    document.querySelector('form').addEventListener('submit', function(event) {
      alert("Payment Success. Thank You for the donation.");
    });
  </script>
</body>

</html>