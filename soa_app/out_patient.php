<!-- form.php -->
<!DOCTYPE html>
<html>
<head>
    <title>SOA Entry - Salcedo Doctors Hospital</title>
</head>
<body>
    <h2>Statement of Account Form</h2>
    <form method="POST" action="submit.php">
        <label>SOA Reference No:</label>
        <input type="text" name="soa_reference_no" required><br>

        <label>Patient Name:</label>
        <input type="text" name="patient_name" required><br>

        <label>Address:</label>
        <textarea name="address" required></textarea><br>

        <label>Diagnosis:</label>
        <textarea name="diagnosis" required></textarea><br>

        <label>Date Admitted:</label>
        <input type="datetime-local" name="date_admitted" required><br>

        <label>Date Discharged:</label>
        <input type="datetime-local" name="date_discharged" required><br>

        <label>First Case Rate:</label>
        <input type="text" name="first_case_rate"><br>

        <label>Second Case Rate:</label>
        <input type="text" name="second_case_rate"><br><br>

        <h3>Fees</h3>
        <label>Drugs & Medicine:</label>
        <input type="number" step="0.01" name="drugs_and_meds"><br>

        <label>Laboratory & Diagnostic:</label>
        <input type="number" step="0.01" name="lab_and_diag"><br>

        <label>Miscellaneous:</label>
        <input type="number" step="0.01" name="misc"><br>

        <label>Room & Board:</label>
        <input type="number" step="0.01" name="room_and_board"><br>

        <label>Supplies:</label>
        <input type="number" step="0.01" name="supplies"><br>

        <label>Total HCI Fees:</label>
        <input type="number" step="0.01" name="total_hci_fees"><br><br>

        <h3>Professional Fees</h3>
        <label>Prof Fee:</label>
        <input type="number" step="0.01" name="prof_fee"><br>

        <label>Total Prof Fee:</label>
        <input type="number" step="0.01" name="total_pro_fee"><br>

        <label>PhilHealth Benefit:</label>
        <input type="number" step="0.01" name="philhealth_benefit"><br>

        <label>Total Payables:</label>
        <input type="number" step="0.01" name="total_payables"><br>

        <label>Billed By:</label>
        <input type="text" name="billed_by"><br><br>

        <button type="submit">Save Record</button>
    </form>
</body>
</html>
