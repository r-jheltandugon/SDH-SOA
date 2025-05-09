<?php
// Connect to MySQL
$mysqli = new mysqli("soa_db", "soa_user", "soa_pass", "soa_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Validate and sanitize inputs
$soa_reference_no   = $_POST['soa_reference_no'] ?? '';
$patient_name       = $_POST['patient_name'] ?? '';
$p_address            = $_POST['p_address'] ?? '';
$diagnosis          = $_POST['diagnosis'] ?? '';
$date_admitted      = $_POST['date_admitted'] ?? '';
$date_discharged    = $_POST['date_discharged'] ?? '';
$drugs_and_meds     = floatval($_POST['drugs_and_meds'] ?? 0);
$lab_and_diag       = floatval($_POST['lab_and_diag'] ?? 0);
$total_hci_fees     = floatval($_POST['total_hci_fees'] ?? 0);
$philhealth_benefit = floatval($_POST['philhealth_benefit'] ?? 0);
$total_payables     = floatval($_POST['total_payables'] ?? 0);
$billed_by          = $_POST['billed_by'] ?? '';

// Prepare statement
$stmt = $mysqli->prepare("INSERT INTO statements (
    soa_reference_no, patient_name, p_address, diagnosis, date_admitted, date_discharged, 
    drugs_and_meds, lab_and_diag, total_hci_fees, philhealth_benefit, total_payables, billed_by
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

// Bind parameters
$stmt->bind_param("sssssssdddds",
    $soa_reference_no,
    $patient_name,
    $p_address,
    $diagnosis,
    $date_admitted,
    $date_discharged,
    $drugs_and_meds,
    $lab_and_diag,
    $total_hci_fees,
    $philhealth_benefit,
    $total_payables,
    $billed_by
);

// Execute and redirect
if ($stmt->execute()) {
    $last_id = $stmt->insert_id;
    $stmt->close();
    $mysqli->close();
    header("Location: print.php?id=$last_id");
    exit;
} else {
    echo "Error saving data: " . $stmt->error;
    $stmt->close();
    $mysqli->close();
}
?>
