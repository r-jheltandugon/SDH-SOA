<?php
// Connect to MySQL
$mysqli = new mysqli("soa_db", "soa_user", "soa_pass", "soa_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Validate and sanitize inputs
$soa_reference_no    = $_POST['soa_reference_no'] ?? '';
$patient_name        = $_POST['patient_name'] ?? '';
$p_age               = $_POST['p_age'] ?? '';
$p_address           = $_POST['p_address'] ?? '';
$diagnosis           = $_POST['diagnosis'] ?? '';
$other_diagnosis     = $_POST['other-diagnosis'] ?? '';
$date_admitted       = $_POST['date_admitted'] ?? '';
$date_discharged     = $_POST['date_discharged'] ?? '';
$first_case_rate     = $_POST['first_case_rate'] ?? '';
$second_case_rate    = $_POST['second_case_rate'] ?? '';

// HCI Fees
$drugs_and_meds      = floatval($_POST['drugs_and_meds'] ?? 0);
$lab_and_diag        = floatval($_POST['lab_and_diag'] ?? 0);
$misc                = floatval($_POST['misc'] ?? 0);
$room_and_board      = floatval($_POST['room_and_board'] ?? 0);
$other               = floatval($_POST['other'] ?? 0);
$service             = floatval($_POST['service'] ?? 0);
$supplies            = floatval($_POST['supplies'] ?? 0);
$total_hci_fees      = floatval($_POST['total_hci_fees'] ?? 0);

// Case Rate Amounts
$case_rate_1a        = floatval($_POST['1first_case_rate_amount'] ?? 0);
$case_rate_1b        = floatval($_POST['2first_case_rate_amount'] ?? 0);
$total_case_1        = floatval($_POST['total_first_case_rate_amount'] ?? 0);

$case_rate_2a        = floatval($_POST['1second_case_rate_amount'] ?? 0);
$case_rate_2b        = floatval($_POST['2second_case_rate_amount'] ?? 0);
$total_case_2        = floatval($_POST['total_second_case_rate_amount'] ?? 0);

// Prof Fees
$total_pro_fee       = floatval($_POST['total_pro_fee'] ?? 0);

// Insert into `statements` table
$stmt = $mysqli->prepare("INSERT INTO statements (
    soa_reference_no, patient_name, p_age, p_address, diagnosis, other_diagnosis,
    date_admitted, date_discharged, first_case_rate, second_case_rate,
    drugs_and_meds, lab_and_diag, misc, room_and_board, other, service, supplies, total_hci_fees,
    case_rate_1a, case_rate_1b, total_case_1,
    case_rate_2a, case_rate_2b, total_case_2,
    total_pro_fee
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Prepare failed: " . $mysqli->error);
}

// Bind main form parameters
$stmt->bind_param("ssssssssssddddddddddddddd",
    $soa_reference_no,
    $patient_name,
    $p_age,
    $p_address,
    $diagnosis,
    $other_diagnosis,
    $date_admitted,
    $date_discharged,
    $first_case_rate,
    $second_case_rate,
    $drugs_and_meds,
    $lab_and_diag,
    $misc,
    $room_and_board,
    $other,
    $service,
    $supplies,
    $total_hci_fees,
    $case_rate_1a,
    $case_rate_1b,
    $total_case_1,
    $case_rate_2a,
    $case_rate_2b,
    $total_case_2,
    $total_pro_fee
);

// Execute
if ($stmt->execute()) {
    $last_id = $stmt->insert_id;
    $stmt->close();

    // Insert into `doctor_fees` table
    if (!empty($_POST['doctor_name']) && !empty($_POST['doctor_fee'])) {
        $doctor_names = $_POST['doctor_name'];
        $doctor_fees = $_POST['doctor_fee'];

        $stmt_doc = $mysqli->prepare("INSERT INTO doctor_fees (statement_id, doctor_name, doctor_fee) VALUES (?, ?, ?)");

        if (!$stmt_doc) {
            die("Prepare failed for doctor_fees: " . $mysqli->error);
        }

        foreach ($doctor_names as $i => $doc_name) {
            $fee = floatval($doctor_fees[$i] ?? 0);
            if ($doc_name && $fee > 0) {
                $stmt_doc->bind_param("isd", $last_id, $doc_name, $fee);
                $stmt_doc->execute();
            }
        }

        $stmt_doc->close();
    }

    $mysqli->close();
    header("Location: print.php?id=$last_id");
    exit;
} else {
    echo "Error saving data: " . $stmt->error;
    $stmt->close();
    $mysqli->close();
}
?>
