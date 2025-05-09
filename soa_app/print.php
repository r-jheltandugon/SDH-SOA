<?php
$mysqli = new mysqli("soa_db", "soa_user", "soa_pass", "soa_db");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$id = $_GET['id'] ?? 0;
$result = $mysqli->query("SELECT * FROM statements WHERE id = $id LIMIT 1");

if (!$result || $result->num_rows === 0) {
    die("SOA record not found.");
}

$data = $result->fetch_assoc();

$drugs_discount = $data['drugs_and_meds'] * 0.20; 
$labs_discount = $data['lab_and_diag'] * 0.20; 
$misc_discount = $data['misc'] * 0.20;
$room_discount = $data['room_and_board'] * 0.20;
$other_discount = $data['other'] * 0.20;
$service_discount = $data['service'] * 0.20;
$supplies_discount = $data['supplies'] * 0.20;
$discount = $drugs_discount + $labs_discount + $misc_discount + $room_discount + $other_discount + $service_discount + $supplies_discount;

$total_drugs_and_meds = $data['drugs_and_meds'] - $drugs_discount;
$total_lab_and_diag = $data['lab_and_diag'] - $labs_discount;
$total_misc = $data['misc'] - $misc_discount;
$total_room_and_board = $data['room_and_board'] - $room_discount;
$total_other = $data['other'] - $other_discount;
$total_service = $data['service'] - $service_discount;
$total_supplies = $data['supplies'] - $supplies_discount;

$case_rate_1a = $data['case_rate_1a'] ?? 0;
$case_rate_1b = $data['case_rate_1b'] ?? 0;

$subtotal_hci_fees = $data['total_hci_fees'] - $discount - $case_rate_1a;

$doctor_fees_result = $mysqli->query("SELECT * FROM doctor_fees WHERE statement_id = $id");

$doctor_fees = [];
if ($doctor_fees_result && $doctor_fees_result->num_rows > 0) {
    while ($row = $doctor_fees_result->fetch_assoc()) {
        $doctor_fees[] = $row;
    }
}

$total_doctor_fee = 0;
$doctor_fee_discount = 0;

foreach ($doctor_fees as $doc) {
    $total_doctor_fee += $doc['doctor_fee'];
    $doctor_fee_discount += $doc['doctor_fee'] * 0.20;
}

$pfsubtotal = max(0, $total_doctor_fee - $doctor_fee_discount - $case_rate_1b);

$total_discount = $discount + $doctor_fee_discount;

$total_case_1 = $case_rate_1a + $case_rate_1b;

$total_actual_charges = $data['total_hci_fees'] + $total_doctor_fee;

$total_doh = $total_actual_charges - $total_discount - $total_case_1;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Statement of Account</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 20px;
    font-size: 10px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    padding-bottom: 10px;
}

.logo img {
    width: 300px;
    height: 45px;
}

.title {
    flex: 1;
    text-align: center;
    font-size: 12px;
    font-weight: bold;
}

.ref-no {
    text-align: left;
    min-width: 200px;
}

.header-text {
    text-align: center;
    margin-top: 10px;
    margin-bottom: 15px;
    font-weight: bold;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    table-layout: fixed;
    word-wrap: break-word;
}

th, td {
    border: 1px solid #000;
    padding: 6px;
    vertical-align: top;
}

.no-border td {
    border: none;
}

.summary th, .summary td {
    font-size: 8px;
}

.right {
    text-align: right;
}
.center {
    text-align: center;
}

.right-align {
    text-align: right;
}

.footer {
    margin-top: 30px;
}

.print-btn {
    margin-top: 20px;
}

@media print {
    .title {
        font-size: 14px;
    }

    table {
        table-layout: auto;
    }
}

.logo-container {
    position: absolute;
    top: 40px;
    left: 50px;
    z-index: 10;
}

.logo-img {
    width: 80px; /* adjust freely */
    height: auto;
}

    </style>
</head>
<body>

<div class="title">STATEMENT OF ACCOUNT</div>

<div class="header">
    <div class="logo">
        <img src="sdh-logo.jpg" alt="Logo" class="logo-img">
    </div>

    <div class="ref-no">
        <strong>SOA Reference No:</strong>
        <span style="display: inline-block; min-width: 100px; border-bottom: 1px solid #000;">
            <?= htmlspecialchars($data['soa_reference_no']) ?>
        </span>
    </div>
</div>


<div class="header-text">
    SALCEDO DOCTORS HOSPITAL, INC.<br>
    Salcedo, Eastern Samar<br>
    Call No. 09224458879<br>
    <span style="color:rgb(255, 0, 157); font-style: italic;">At SDH.. you are in the PINK of Health</span>
</div>

<table class="no-border">
    <tr>
        <td style="width: 40%;"><strong>Patient Name:</strong> 
            <span style="display: inline-block; min-width: 150px; border-bottom: 1px solid #000;">
                <?= htmlspecialchars($data['patient_name']) ?>
            </span>
        </td>

        <td style="text-align: center; width: 20%;"><strong>Age:</strong> 
            <span style="display: inline-block; min-width: 30px; border-bottom: 1px solid #000;">
                <?= htmlspecialchars($data['p_age'] ?? '-') ?>
            </span>
        </td>

        <td style="text-align: right; width: 40%;"><strong>Date & Time Admitted:</strong> 
            <span style="display: inline-block; min-width: 130px; border-bottom: 1px solid #000;">
                <?= date('F j, Y g:i A', strtotime($data['date_admitted'])) ?>
            </span>
        </td>
    </tr>

    <tr>
        <td><strong>Address:</strong> 
            <span style="display: inline-block; min-width: 250px; border-bottom: 1px solid #000;">
                <?= htmlspecialchars($data['p_address'] ?? '-') ?>
            </span>
        </td>
        <td colspan="2" style="text-align: right;">
            <strong>Date & Time Discharged:</strong> 
            <span style="display: inline-block; min-width: 130px; border-bottom: 1px solid #000;">
                <?= date('F j, Y g:i A', strtotime($data['date_discharged'])) ?>
            </span>
        </td>
    </tr>
    <tr>
        <td colspan="2"><strong>Final Diagnosis:</strong> <span style="display: inline-block; min-width: 250px; border-bottom: 1px solid #000;"><?= nl2br(htmlspecialchars($data['diagnosis'])) ?></span></td>
        <td class="right-align" colspan="2"><strong>First Case Rate:</strong> <span style="display: inline-block; min-width: 100px; border-bottom: 1px solid #000; text-align: left;"><?= nl2br(htmlspecialchars($data['first_case_rate'])) ?></span></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Other Diagnosis:</strong> <span style="display: inline-block; min-width: 250px; border-bottom: 1px solid #000;"><?= nl2br(htmlspecialchars($data['other_diagnosis'])) ?></span></td> 
        <td class="right-align" colspan="2"><strong>Second Case Rate:</strong> <span style="display: inline-block; min-width: 100px; border-bottom: 1px solid #000; text-align: left;"><?= nl2br(htmlspecialchars($data['second_case_rate'])) ?></span></td>
    </tr>
</table>

<div class="title">SUMMARY OF FEES</div>

<table class="summary">
    <tr>
        <th colspan="2" rowspan="7">Particular</th>
        <th rowspan="7" class="center">Actual Charges</th>
        <th colspan="5" class="center">Amount of Discount</th>
        <th colspan="2" class="center">PhilHealth Benefits</th>
        <th rowspan="7" class="center">Out of Pocket of Patient</th>
    </tr>
    <tr>
        <td rowspan="6" class="center">VAT Exempt</td>
        <td rowspan="6" class="center">Senior Citizen/PWD</td>  
        <td colspan="2" class="center">Place</td>
        <td></td>
        <td rowspan="6" class="center">First Case Rate</td>
        <td rowspan="6" class="center">Second Case Rate</td>
    </tr>
    <tr>
        <td></td>
        <td class="left" colspan="3">PCSO</td>
    </tr>
    <tr>
        <td></td>
        <td class="left" colspan="3">DSWD</td>
    </tr>
    <tr>
        <td class="center">✔</td>
        <td class="left" colspan="2">DOH(MAIFIP)</td>
    </tr>
    <tr>
        <td></td>
        <td class="left" colspan="2">HMO</td>
    </tr>
    <tr>
        <td></td>
        <td class="left" colspan="2">Others:</td>
    </tr>
    <tr>
        <td colspan="2" style="background-color:rgb(235, 235, 235);"><strong>Drugs and Medicines</strong></td>
        <td><strong>₱ <span style="margin-left: 20px;"><?= number_format($data['drugs_and_meds'] ?? 0, 2) ?></span></strong></td>
        <td ></td>
        <td><strong>₱ <span style="margin-left: 20px;"><?= number_format($drugs_discount, 2) ?></span></strong></td>
        <td colspan="3"><strong>₱ <span style="margin-left: 20px;"><?= number_format($total_drugs_and_meds, 2) ?></span></strong></td> 
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>
    <tr>
        <td  colspan="2" style="background-color:rgb(235, 235, 235);"><strong>Laboratory and Diagnostics</strong></td>
        <td>₱ <span style="margin-left: 20px;"><?= number_format($data['lab_and_diag'] ?? 0, 2) ?></span></td>
        <td ></td>
        <td><strong>₱ <span style="margin-left: 20px;"><?= number_format($labs_discount, 2) ?></span></strong></td>
        <td colspan="3"><strong>₱ <span style="margin-left: 20px;"><?= number_format($total_lab_and_diag, 2) ?></span></strong></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="2" style="background-color:rgb(235, 235, 235);"><strong>Miscellaneous</strong></td>
        <td>₱ <span style="margin-left: 20px;"><?= number_format($data['misc'] ?? 0, 2) ?></span></td>
        <td ></td>
        <td><strong>₱ <span style="margin-left: 20px;"><?= number_format($misc_discount, 2) ?></span></strong></td>
        <td colspan="3"><strong>₱ <span style="margin-left: 20px;"><?= number_format($total_misc, 2) ?></span></strong></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="2" style="background-color:rgb(235, 235, 235);"><strong>Room and Board</strong></td>
        <td>₱ <span style="margin-left: 20px;"><?= number_format($data['room_and_board'] ?? 0, 2) ?></span></td>
        <td ></td>
        <td><strong>₱ <span style="margin-left: 20px;"><?= number_format($room_discount, 2) ?></span></strong></td>
        <td colspan="3"><strong>₱ <span style="margin-left: 20px;"><?= number_format($total_room_and_board, 2) ?></span></strong></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="2" style="background-color:rgb(235, 235, 235);"><strong>Other</strong></td>
        <td>₱ <span style="margin-left: 20px;"><?= number_format($data['other'] ?? 0, 2) ?></span></td>
        <td ></td>
        <td><strong>₱ <span style="margin-left: 20px;"><?= number_format($other_discount, 2) ?></span></strong></td>
        <td colspan="3"><strong>₱ <span style="margin-left: 20px;"><?= number_format($total_other, 2) ?></span></strong></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="2" style="background-color:rgb(235, 235, 235);"><strong>Service</strong></td>
        <td>₱ <span style="margin-left: 20px;"><?= number_format($data['service'] ?? 0, 2) ?></span></td>
        <td ></td>
        <td><strong>₱ <span style="margin-left: 20px;"><?= number_format($service_discount, 2) ?></span></strong></td>
        <td colspan="3"><strong>₱ <span style="margin-left: 20px;"><?= number_format($total_service, 2) ?></span></strong></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="2" style="background-color:rgb(235, 235, 235);"><strong>Supplies</strong></td>
        <td>₱ <span style="margin-left: 20px;"><?= number_format($data['supplies'] ?? 0, 2) ?></span></td>
        <td ></td>
        <td><strong>₱ <span style="margin-left: 20px;"><?= number_format($supplies_discount, 2) ?></span></strong></td>
        <td colspan="3"><strong>₱ <span style="margin-left: 20px;"><?= number_format($total_supplies, 2) ?></span></strong></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="2"><strong>HCI Subtotal</strong></td>
        <td><strong style="font-size: 14px;">₱ <span style="margin-left: 10px;"><?= number_format($data['total_hci_fees'] ?? 0, 2) ?></span></strong></td>
        <td ></td>
        <td><strong style="font-size: 14px;">₱ <span style="margin-left: 10px;"><?= number_format($discount, 2) ?></span></strong></td>
        <td colspan="3"><strong style="font-size: 14px;">₱ <span style="margin-left: 10px;"><?= number_format($subtotal_hci_fees, 2) ?></span></strong></td>
        <td style="vertical-align: middle;"><strong>₱ <span style="margin-left: 10px;"><?= number_format($data['case_rate_1a'] ?? 0, 2) ?></span></strong></td>
        <td style="vertical-align: middle;"><strong>₱ 0.00</strong></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="11" ><strong>Professional Fee/s</strong></td>
    </tr>
    <tr><?php foreach ($doctor_fees as $doc): ?>
        <td colspan="2" style="background-color:rgb(235, 235, 235);"><strong><?= htmlspecialchars($doc['doctor_name']) ?></strong></td>
        <td ><strong>₱ <?= htmlspecialchars($doc['doctor_fee']) ?></strong></td>
        <td ></td>
        <td style="vertical-align: middle;"><strong>₱ <?= number_format($doctor_fee_discount, 2) ?></strong></td>
        <td  colspan="3"></td>
        <td ></td>
        <td ></td>
        <td></td>
    </tr><?php endforeach; ?>
    <tr>
        <td colspan="2"><strong>PF Subtotal</strong></td>
        <td ><strong style="font-size: 14px">₱ <?= htmlspecialchars($doc['doctor_fee']) ?></strong></td>
        <td ></td>
        <td ><strong style="font-size: 14px">₱ <?= number_format($doctor_fee_discount, 2) ?></strong></td>
        <td style="vertical-align: middle;" colspan="3"><strong>₱ <?= number_format($pfsubtotal, 2) ?></strong></td>
        <td style="vertical-align: middle;"><strong>₱ <span style="margin-left: 10px;"><?= number_format($data['case_rate_1b'] ?? 0, 2) ?></span></strong></td>
        <td style="vertical-align: middle;"><strong>₱ 0.00</strong></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Totals</strong></td>
        <td><strong style="font-size: 14px">₱ <?= number_format($total_actual_charges, 2) ?></strong></td>
        <td ></td>
        <td ><strong style="font-size: 14px">₱ <?= number_format($total_discount, 2) ?></strong></td>
        <td style="vertical-align: middle;" colspan="3"><strong>₱ <?= number_format($total_doh, 2) ?></strong></td>
        <td style="vertical-align: middle;"><strong>₱ <span style="margin-left: 10px;"><?= number_format($total_case_1, 2) ?></span></strong></td>
        <td style="vertical-align: middle;"><strong>₱ 0.00</strong></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="2"><strong>DOH MAIP</strong></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td colspan="3"><strong style="font-size: 14px">₱ <?= number_format($total_doh, 2) ?></strong></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>
    <tr>
        <td colspan="10"><strong>Total Payable</strong></td>
        <td><strong style="font-size: 14px">₱ 0.00</strong></td>
    </tr>
</table>

<div class="footer">
    <table style="width: 100%;border: none;">
        <tr>
            <td style="border: none;">
                <strong>Prepared By:</strong><br><br>
                <div style="width: 250px;">
                    <div style="border-bottom: 1px solid #000; text-align: center;">
                        <strong>SHEENA JOY B. SABALBERINO</strong>
                    </div>
                    <div style="text-align: center;">
                        Billing Officer<br>
                        <span style="font-size: 10px">(Signature over Printed Name)</span>
                    </div>
                </div>
            </td>
        </tr>
    </table><br>

    <span>Date Printed: _________________________</span><br>
    <span>Date Signed: _________________________</span><br>
    <span>Contact No.: _________________________</span><br>

</div>

</body>
</html>

<?php
$mysqli->close();
?>
