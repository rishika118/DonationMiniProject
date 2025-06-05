<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$donor_id = 1; // Replace with actual logged-in donor ID

// Fetch donation requests
$sql = "SELECT dr.id, ch.charity_name, ca.name AS campaign_name, dr.request_date, dr.status,
               dr.campaign_id, dr.charity_id
        FROM donation_requests dr
        JOIN charities ch ON dr.charity_id = ch.id
        JOIN campaigns ca ON dr.campaign_id = ca.id
        WHERE dr.donor_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $donor_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Donation Requests</title>
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
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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

    th,
    td {
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
    <h2>Donation Requests</h2>
    <?php if (isset($_GET['deleted'])): ?>
      <div style="background-color: #dff0d8; color: #3c763d; text-align: center; padding: 10px; margin-bottom: 20px; border-radius: 6px;">
        Donation request has been successfully rejected and removed.
      </div>
    <?php endif; ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Charity Name</th>
        <th>Campaign Name</th>
        <th>Requested Date & Time</th>
        <th>Action</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['charity_name']) ?></td>
          <td><?= htmlspecialchars($row['campaign_name']) ?></td>
          <td><?= $row['request_date'] ?></td>

          <td>
            <?php if ($row['status'] == 'pending'): ?>
              <form method="post" action="donate_form.php" style="display:inline;">
                <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="campaign_id" value="<?= $row['campaign_id'] ?>">
                <input type="hidden" name="charity_id" value="<?= $row['charity_id'] ?>">
                <input type="hidden" name="action" value="approved">
                <button type="submit" style="background-color:green;color:white;">APPROVE</button>
              </form>

              <form method="post" action="respond_request.php" style="display:inline;">
                <input type="hidden" name="request_id" value="<?= $row['id'] ?>">
                <input type="hidden" name="action" value="rejected">
                <a href="donation_requests.php"><button type="submit" style="background-color:red;color:white;">REJECT</button></a>
              </form>
            <?php else: ?>
              <?= ucfirst($row['status']) ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </table>
  </div>

</body>

</html>