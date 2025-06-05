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
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
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
