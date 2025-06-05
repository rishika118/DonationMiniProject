<?php
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");

$result = $conn->query("SELECT id, charity_name, email, phone, address, registered_datetime FROM charities");
?>

<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Charity Name</th>
    <th>Mail ID</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Registered Date & Time</th>
  </tr>

  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?= htmlspecialchars($row['id']) ?></td>
    <td><?= htmlspecialchars($row['charity_name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['phone']) ?></td>
    <td><?= htmlspecialchars($row['address']) ?></td>
    <td><?= htmlspecialchars($row['registered_datetime']) ?></td>
  </tr>
  <?php endwhile; ?>
</table>
