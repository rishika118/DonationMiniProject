<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Charity Dashboard</title>
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
    }

    .content img {
      margin-top: 30px;
      width: 80%;
      max-width: 1000px;
      border-radius: 10px;
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
    <h1>Charity Home</h1>
    <img src="./assets/charity.jpg" alt="Charity Banner Image" />
  </div>
</body>
</html>
