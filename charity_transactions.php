<?php
session_start();
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");

$query = "
    SELECT 
        t.transaction_id,
        t.charity_name,
        t.campaign_name,
        
        t.payment_mode,
        t.donation_amount,
        t.paid_on
    FROM transactions t
    JOIN donors d ON t.donor_id = d.id
    ORDER BY t.paid_on DESC
";

$result = $conn->query($query);
?>

<h2>Transactions</h2>
<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>Transaction ID</th>
    <th>Charity Name</th>
    <th>Campaign Name</th>
    <th>Payment Mode</th>
    <th>Donation Amount</th>
    <th>Paid On</th>
  </tr>

  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= htmlspecialchars($row['transaction_id']) ?></td>
    <td><?= htmlspecialchars($row['charity_name']) ?></td>
    <td><?= htmlspecialchars($row['campaign_name']) ?></td>
    <td><?= htmlspecialchars($row['payment_mode']) ?></td>
    <td><?= htmlspecialchars($row['donation_amount']) ?></td>
    <td><?= htmlspecialchars($row['paid_on']) ?></td>
  </tr>
  <?php endwhile; ?>
</table>
