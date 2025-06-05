<?php
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$donor_id = 1; // Replace with logged-in donor ID logic

// Fetch transactions of logged-in donor
$sql = "SELECT * FROM transactions WHERE donor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $donor_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Charity Name</th>
            <th>Campaign Name</th>
            <th>Payment Mode</th>
            <th>Donation Amount</th>
            <th>Paid On</th>
            <th>Receipt</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['transaction_id']) ?></td>
                <td><?= htmlspecialchars($row['charity_name']) ?></td>
                <td><?= htmlspecialchars($row['campaign_name']) ?></td>
                <td><?= htmlspecialchars($row['payment_mode']) ?></td>
                <td>₹<?= number_format($row['donation_amount'], 2) ?></td>
                <td><?= htmlspecialchars($row['paid_on']) ?></td>
                <td>
                    <form method="post" action="generate_receipt.php" target="_blank">
                        <input type="hidden" name="transaction_id" value="<?= htmlspecialchars($row['transaction_id']) ?>">
                        <button type="submit" style="background-color:green; color:white; border:none; padding:5px 10px; border-radius:4px; cursor:pointer;">
                            Generate Receipt
                        </button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
