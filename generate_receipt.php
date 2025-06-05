<?php
ob_start();
require('fpdf/fpdf.php');
$conn = new mysqli("localhost", "root", "Rishika@1", "ngo_donors");

$transaction_id = isset($_POST['transaction_id']) ? (int)$_POST['transaction_id'] : 0;

if ($transaction_id <= 0) {
    die("Invalid or missing transaction ID.");
}


$stmt = $conn->prepare("SELECT 
    t.donation_amount, 
    t.payment_mode, 
    t.paid_on, 
    t.charity_name, 
    t.campaign_name,
    d.first_name AS donor_name, 
    d.address, 
    d.phone 
FROM transactions t
JOIN donors d ON t.donor_id = d.id
WHERE t.transaction_id = ?");



$stmt->bind_param("i", $transaction_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
if (!$data) {
    die("No transaction found for ID: $transaction_id");
}


class PDF extends FPDF {
    function Header() {
        // Dark grey banner
        $this->SetFillColor(60, 60, 60);
        $this->Rect(0, 0, 210, 35, 'F');
        
        // Text color white
        $this->SetTextColor(255,255,255);
        
        // Hand2Hope left
        $this->SetFont('Arial', 'B', 25);
        $this->SetXY(10, 10);
        $this->Cell(0, 10, 'Hand2Hope', 0, 1);

        // Phone & Email center
        $this->SetFont('Arial', '', 11);
        $this->SetXY(20, 10);
        $this->Cell(0, 6, '+91-9876543210', 0, 1, 'C');
        $this->SetXY(20, 16);
        $this->Cell(0, 6, 'hand2hope@ngo.org', 0, 1, 'C');

        // Charity, Campaign, Status right
        global $data;
        $this->SetXY(140, 10);
        $this->Cell(0, 6, 'Charity: ' . $data['charity_name'], 0, 1);
        $this->SetXY(140, 16);
        $this->Cell(0, 6, 'Campaign: ' . $data['campaign_name'], 0, 1);
        $this->SetXY(140, 22);
        $this->Cell(0, 6, 'Status: Approved', 0, 1);

        // Red line below banner
        $this->SetDrawColor(255, 0, 0);
        $this->Line(10, 38, 200, 38);

        // Reset text color black for body
        $this->SetTextColor(0,0,0);
    }
}

// Create PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Invoice details section
$pdf->SetXY(10, 45);
$pdf->Cell(0, 8, 'Invoiced to:', 0, 1);

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(40, 7, 'Name:', 0, 0);
$pdf->Cell(0, 7, $data['donor_name'], 0, 1);

$pdf->Cell(40, 7, 'Address:', 0, 0);
$pdf->Cell(0, 7, $data['address'], 0, 1);

$pdf->Cell(40, 7, 'Phone:', 0, 0);
$pdf->Cell(0, 7, $data['phone'], 0, 1);

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, 'Invoice number:', 0, 1);

// Generate random invoice number similar to format # 31F1AA4198
$invoice_number = '#' . strtoupper(substr(md5(uniqid()), 0, 10));
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 7, $invoice_number, 0, 1);

$pdf->Ln(5);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 7, 'Date & time of payment:', 0, 1);

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(0, 7, $data['paid_on'], 0, 1);

// Invoice total on right bottom
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetXY(150, 100);
$pdf->Cell(0, 10, 'Invoice Total', 0, 1);

$pdf->SetXY(150, 110);
$pdf->SetFont('Arial', 'B', 24);
$pdf->Cell(0, 12, number_format($data['donation_amount'], 2) . ' Rs', 0, 1);

$pdf->Output();
ob_end_flush();
?>
