<?php
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT id, first_name, email, phone, address, registered_datetime FROM donors";
$result = $conn->query($sql);
?>

<h2>Donor Details</h2>

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse; margin-top: 20px;">
  <thead style="background-color:#f2f2f2;">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Mail ID</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Registered Date & Time</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['first_name']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['phone']) . "</td>
                    <td>" . htmlspecialchars($row['address']) . "</td>
                    <td>" . htmlspecialchars($row['registered_datetime']) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No donors found</td></tr>";
    }
    ?>
  </tbody>
</table>
