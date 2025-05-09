<!-- form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SOA Entry - Salcedo Doctors Hospital</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        h3 {
            margin-top: 30px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            color: #444;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="datetime-local"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 60px;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Statement of Account Form</h2>
        <form method="POST" action="submit.php">
            <div class="form-group">
                <label>SOA Reference No:</label>
                <input type="text" name="soa_reference_no" required>
            </div>

            <div class="form-group">
                <label>Patient Name:</label>
                <input type="text" name="patient_name" required>
            </div>

            <div class="form-group">
                <label>Age:</label>
                <input type="text" name="p_age" required>
            </div>

            <div class="form-group">
                <label>Address:</label>
                <textarea name="p_address" required></textarea>
            </div>

            <div class="form-group">
                <label>Diagnosis:</label>
                <textarea name="diagnosis" required></textarea>
            </div>

            <div class="form-group">
                <label>Date Admitted:</label>
                <input type="datetime-local" name="date_admitted" required>
            </div>

            <div class="form-group">
                <label>Date Discharged:</label>
                <input type="datetime-local" name="date_discharged" required>
            </div>

            <div class="form-group">
                <label>First Case Rate:</label>
                <input type="text" name="first_case_rate">
            </div>

            <div class="form-group">
                <label>Second Case Rate:</label>
                <input type="text" name="second_case_rate">
            </div>

            <h3>Fees</h3>
            <div class="form-group">
                <label>Drugs & Medicine:</label>
                <input type="number" step="0.01" name="drugs_and_meds">
            </div>

            <div class="form-group">
                <label>Laboratory & Diagnostic:</label>
                <input type="number" step="0.01" name="lab_and_diag">
            </div>

            <div class="form-group">
                <label>Miscellaneous:</label>
                <input type="number" step="0.01" name="misc">
            </div>

            <div class="form-group">
                <label>Room & Board:</label>
                <input type="number" step="0.01" name="room_and_board">
            </div>

            <div class="form-group">
                <label>Supplies:</label>
                <input type="number" step="0.01" name="supplies">
            </div>

            <div class="form-group">
                <label>Total HCI Fees:</label>
                <input type="number" step="0.01" name="total_hci_fees">
            </div>

            <h3>Professional Fees</h3>
            <div class="form-group">
                <label>Prof Fee:</label>
                <input type="number" step="0.01" name="prof_fee">
            </div>

            <div class="form-group">
                <label>Total Prof Fee:</label>
                <input type="number" step="0.01" name="total_pro_fee">
            </div>

            <div class="form-group">
                <label>PhilHealth Benefit:</label>
                <input type="number" step="0.01" name="philhealth_benefit">
            </div>

            <div class="form-group">
                <label>Total Payables:</label>
                <input type="number" step="0.01" name="total_payables">
            </div>

            <div class="form-group">
                <label>Billed By:</label>
                <input type="text" name="billed_by">
            </div>

            <button type="submit">Save Record</button>
        </form>
    </div>
</body>
</html>
