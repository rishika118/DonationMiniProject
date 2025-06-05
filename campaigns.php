<?php
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "
  SELECT c.id, c.name, c.description, 
         COALESCE(SUM(d.amount), 0) AS amount_collected
  FROM campaigns c
  LEFT JOIN donations d ON c.id = d.campaign_id
  GROUP BY c.id, c.name, c.description
";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
  <title>Campaigns</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f4f4; }
    .navbar {
      display: flex; justify-content: space-between; align-items: center;
      background-color: #ffcc00; padding: 15px 30px;
    }
    .logo { font-weight: bold; font-size: 24px; color: #333; }
    .menu a {
      margin-left: 20px; text-decoration: none; color: #333; font-weight: bold;
    }
    table {
      width: 80%; margin: 40px auto; border-collapse: collapse;
      background: #fff;
    }
    th, td {
      padding: 15px; border: 1px solid #ccc; text-align: center;
    }
    th { background-color: #f2f2f2; }
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

  <table>
    <tr>
      <th>ID</th>
      <th>Campaign Name</th>
      <th>Description</th>
      
    </tr>
    <?php while($row = $result->fetch_assoc()) { ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['name'] ?></td>
      <td><?= $row['description'] ?></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
<?php $conn->close(); ?>
