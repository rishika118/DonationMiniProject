<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch donors
$donors = $conn->query("SELECT id, first_name, email, phone FROM donors");

// Fetch campaigns
$campaigns = $conn->query("SELECT id, name FROM campaigns");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Donation Details</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f4f8;
      margin: 0;
      padding: 50px;
    }

    .container {
      width: 90%;
      max-width: 900px;
      margin: auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #fbc02d;
      color: #fff;
      font-weight: bold;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .btn-approve {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-reject {
      background-color: #f44336;
      color: white;
      border: none;
      padding: 8px 12px;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-approve:hover {
      background-color: #45a049;
    }

    .btn-reject:hover {
      background-color: #e53935;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Donation Details</h2>


<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Select Campaign</th>
        <th>Action</th>
    </tr>
    <?php while($donor = $donors->fetch_assoc()): ?>
    <tr>
        <td><?= $donor['id'] ?></td>
        <td><?= htmlspecialchars($donor['first_name']) ?></td>
        <td><?= htmlspecialchars($donor['email']) ?></td>
        <td><?= htmlspecialchars($donor['phone']) ?></td>
        <td>
            <form method="post" action="send_request.php">
                <input type="hidden" name="donor_id" value="<?= $donor['id'] ?>">
                <select name="campaign_id" required>
                    <?php
                    // Reset campaign result pointer
                    $campaigns->data_seek(0);
                    while($campaign = $campaigns->fetch_assoc()):
                    ?>
                        <option value="<?= $campaign['id'] ?>"><?= htmlspecialchars($campaign['name']) ?></option>
                    <?php endwhile; ?>
                </select>
        </td>
        <td>
                <button type="submit">REQUEST</button>
            </form>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
