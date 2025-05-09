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
    <span style="color:rgb(255, 0, 157); font-style: italic;"">At SDH.. you are in the PINK of Health</span>
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
                <?= htmlspecialchars($data['age'] ?? '-') ?>
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
        <td class="right-align" colspan="2"><strong>First Case Rate:</strong> <span style="display: inline-block; min-width: 100px; border-bottom: 1px solid #000;"></span></td>
    </tr>
    <tr>
        <td colspan="2"><strong>Other Diagnosis:</strong> <span style="display: inline-block; min-width: 250px; border-bottom: 1px solid #000;"><?= nl2br(htmlspecialchars($data['other_diagnosis'] ?? '-')) ?></span></td> 
        <td class="right-align" colspan="2"><strong>Second Case Rate:</strong> <span style="display: inline-block; min-width: 100px; border-bottom: 1px solid #000;"></span></td>
    </tr>
</table>

<div class="title">SUMMARY OF FEES</div>

<table class="summary">
    <tr>
        <th rowspan="7">Particular</th>
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
        <td class="left" colspan="2">PCSO</td>
    </tr>
    <tr>
        <td></td>
        <td class="left" colspan="2">DSWD</td>
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
        <td><strong>Drugs and Medicines</strong></td>
        <td class="center">₱ <?= number_format($data['services'] ?? 0, 2) ?></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center" colspan="3"></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td><strong>Laboratory and Diagnostics</strong></td>
        <td class="center">₱ <?= number_format($data['supplies'] ?? 0, 2) ?></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center" colspan="3"></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td><strong>Miscellaneous</strong></td>
        <td class="center">₱ <?= number_format($data['supplies'] ?? 0, 2) ?></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center" colspan="3"></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td><strong>Room and Board</strong></td>
        <td class="center">₱ <?= number_format($data['services'] ?? 0, 2) ?></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center" colspan="3"></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td><strong>Supplies</strong></td>
        <td class="center">₱ <?= number_format($data['supplies'] ?? 0, 2) ?></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center" colspan="3"></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td><strong>HCI Subtotal</strong></td>
        <td class="center"><strong style="font-size: 14px">₱ 0.00</strong></td>
        <td class="center"></td>
        <td class="center"><strong style="font-size: 14px">₱ 0.00</strong></td>
        <td class="center" colspan="3"><strong style="font-size: 14px">₱ 0.00</strong></td>
        <td class="center"><strong>₱ 0.00</strong></td>
        <td class="center"><strong>₱ 0.00</strong></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td colspan="10"><strong>Professional Fee/s</strong></td>
    </tr>
    <tr>
        <td><strong>Professional Fee/s</strong></td>
        <td class="center"><strong>₱ 0.00</strong></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center" colspan="3"></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td><strong>PF Subtotal</strong></td>
        <td class="center"><strong style="font-size: 14px">₱ 0.00</strong></td>
        <td class="center"></td>
        <td class="center"><strong style="font-size: 14px">₱ 0.00</strong></td>
        <td class="center" colspan="3"><strong>₱ 0.00</strong></td>
        <td class="center"><strong>₱ 0.00</strong></td>
        <td class="center"><strong>₱ 0.00</strong></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td><strong>Totals</strong></td>
        <td class="center"><strong style="font-size: 14px">₱ 0.00</strong></td>
        <td class="center"></td>
        <td class="center"><strong style="font-size: 14px">₱ 0.00</strong></td>
        <td class="center" colspan="3"><strong>₱ 0.00</strong></td>
        <td class="center"><strong>₱ 0.00</strong></td>
        <td class="center"><strong>₱ 0.00</strong></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td><strong>DOH MAIP</strong></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center" colspan="3"><strong style="font-size: 14px">₱ 0.00</strong></td>
        <td class="center"></td>
        <td class="center"></td>
        <td class="center"></td>
    </tr>
    <tr>
        <td colspan="9"><strong>Total Payable</strong></td>
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
