
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Campaign</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }

    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #ffcc00;
      padding: 15px 30px;
    }

    .navbar .logo {
      font-weight: bold;
      font-size: 24px;
      color: #333;
    }

    .navbar .menu a {
      margin-left: 20px;
      text-decoration: none;
      color: #333;
      font-weight: bold;
    }

    .content {
      text-align: center;
      margin-top: 50px;
    }

    .content h1 {
      font-size: 36px;
      color: #444;
      font-family: 'Georgia', serif;
    }

    form {
      max-width: 400px;
      margin: 30px auto;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input,
    textarea,
    button {
      width: 100%;
      margin-bottom: 15px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      background-color: #28a745;
      color: white;
      border: none;
      font-weight: bold;
    }

    button:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <div class="logo">Hand2Hope</div>
    <div class="menu">
      <a href="charity_dashboard.php">Home</a>
      <a href="add_campaign.php">Add Campaigns</a>
      <a href="campaigns.php">Campaigns</a>
      <a href="donors_campaigns.php">Request Donation</a>
      <a href="charity_transactions.php">Transactions</a>
      <a href="index.html">Logout</a>
    </div>
  </div>

  <div class="content">
    <h1>Campaign Details</h1>
    <form action="add_campaign.php" method="POST">
      <input type="text" name="campaign_name" placeholder="Campaign Name" required>
      <textarea name="description" placeholder="Campaign Description" required></textarea>
      <button type="submit">ADD</button>
    </form>
  </div>
</body>
  <?php
  $conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $name = $_POST['campaign_name'];
  $desc = $_POST['description'];

  $sql = "INSERT INTO campaigns (name, description) VALUES ('$name', '$desc')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Campaign registration Success'); window.location.href='add_campaign.html';</script>";
  } else {
    echo "Error: " . $conn->error;
  }

  $conn->close();
  ?>

</html>