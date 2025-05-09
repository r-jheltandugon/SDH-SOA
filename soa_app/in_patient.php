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
                <label>Other Diagnosis:</label>
                <textarea name="other-diagnosis"></textarea>
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
                <label>Other:</label>
                <input type="number" step="0.01" name="other">
            </div>

            <div class="form-group">
                <label>Service:</label>
                <input type="number" step="0.01" name="service">
            </div>

            <div class="form-group">
                <label>Supplies:</label>
                <input type="number" step="0.01" name="supplies">
            </div>

            <div class="form-group">
                <label>Total HCI Fees:</label>
                <input type="number" step="0.01" name="total_hci_fees" readonly>
            </div>

            <div class="form-group">
                <label>1. First Case Rate Amount:</label>
                <input type="number" step="0.01" name="1first_case_rate_amount">
            </div>

            <div class="form-group">
                <label>2. First Case Rate Amount:</label>
                <input type="number" step="0.01" name="2first_case_rate_amount">
            </div>

            <div class="form-group">
                <label>Total First Case Rate Amount:</label>
                <input type="number" step="0.01" name="total_first_case_rate_amount" readonly>
            </div>

            <div class="form-group">
                <label>1. Second Case Rate Amount:</label>
                <input type="number" step="0.01" name="1second_case_rate_amount">
            </div>

            <div class="form-group">
                <label>2. Second Case Rate Amount:</label>
                <input type="number" step="0.01" name="2second_case_rate_amount">
            </div>

            <div class="form-group">
                <label>Total Second Case Rate Amount:</label>
                <input type="number" step="0.01" name="total_second_case_rate_amount" readonly>
            </div>

            <h3>Professional Fees</h3>

            <div id="prof-fee-container">
                <div class="form-group prof-fee-entry">
                    <label>Doctor & Fee:</label>
                    <select name="doctor_name[]" required>
                        <option value="">Select Doctor</option>
                        <option value="Dr. Gilbert Ian S. Apilado, Accred.# 1100-1638545-2">Dr. Gilbert Ian S. Apilado, Accred.# 1100-1638545-2</option>
                        <option value="Dr. Rubelle R. Apilado, Accred.# 1202-2258602-2">Dr. Rubelle R. Apilado, Accred.# 1202-2258602-2</option>
                        <option value="Dr. Antonia B. Sabalberino, Accred.# 11-001947918-0">Dr. Antonia B. Sabalberino, Accred.# 11-001947918-0</option>
                        <option value="Dr. Amille Joy S. Ty-Luistro, Accred.# 1100-2152792-4">Dr. Amille Joy S. Ty-Luistro, Accred.# 1100-2152792-4</option>
                        <option value="Dr. Joash A. Luistro, Accred.# 15012256486-5">Dr. Joash A. Luistro, Accred.# 15012256486-5</option>
                        <option value="Dr. Christian Jude Uyvico, Accred.# 1100-2051288-4">Dr. Christian Jude Uyvico, Accred.# 1100-2051288-4</option>
                        <option value="Dr. Katrina Carmel Rapada, Accred.# 1501-1740941-0">Dr. Katrina Carmel Rapada, Accred.# 1501-1740941-0</option>
                    </select>
                    <input type="number" step="0.01" name="doctor_fee[]" placeholder="Fee" class="doctor-fee-input">
                </div>
            </div>

            <button type="button" onclick="addDoctorFee()">+ Add Doctor Fee</button>

            <div class="form-group">
                <label>Total Prof Fee:</label>
                <input type="number" step="0.01" name="total_pro_fee" id="total_pro_fee" readonly>
            </div>

            <button type="submit">Save Record</button>
        </form>
    </div>
</body>
<script>
    function calculateTotalHCI() {
        const drugs = parseFloat(document.querySelector('[name="drugs_and_meds"]').value) || 0;
        const lab = parseFloat(document.querySelector('[name="lab_and_diag"]').value) || 0;
        const misc = parseFloat(document.querySelector('[name="misc"]').value) || 0;
        const room = parseFloat(document.querySelector('[name="room_and_board"]').value) || 0;
        const other = parseFloat(document.querySelector('[name="other"]').value) || 0;
        const service = parseFloat(document.querySelector('[name="service"]').value) || 0;
        const supplies = parseFloat(document.querySelector('[name="supplies"]').value) || 0;

        const total = drugs + lab + misc + room + other + service + supplies;
        document.querySelector('[name="total_hci_fees"]').value = total.toFixed(2);
    }

    const fields = ['drugs_and_meds', 'lab_and_diag', 'misc', 'room_and_board', 'other', 'service', 'supplies'];

    fields.forEach(fieldName => {
        document.querySelector(`[name="${fieldName}"]`).addEventListener('input', calculateTotalHCI);
    });

    function calculateTotalFirstCaseRate() {
        const firstCaseRate1 = parseFloat(document.querySelector('[name="1first_case_rate_amount"]').value) || 0;
        const firstCaseRate2 = parseFloat(document.querySelector('[name="2first_case_rate_amount"]').value) || 0;

        const totalFirstCaseRate = firstCaseRate1 + firstCaseRate2;
        document.querySelector('[name="total_first_case_rate_amount"]').value = totalFirstCaseRate.toFixed(2);
    }
    const firstCaseRateFields = ['1first_case_rate_amount', '2first_case_rate_amount'];

    firstCaseRateFields.forEach(fieldName => {
        document.querySelector(`[name="${fieldName}"]`).addEventListener('input', calculateTotalFirstCaseRate);
    });

    function calculateTotalSecondCaseRate() {
        const secondCaseRate1 = parseFloat(document.querySelector('[name="1second_case_rate_amount"]').value) || 0;
        const secondCaseRate2 = parseFloat(document.querySelector('[name="2second_case_rate_amount"]').value) || 0;

        const totalSecondCaseRate = secondCaseRate1 + secondCaseRate2;
        document.querySelector('[name="total_second_case_rate_amount"]').value = totalSecondCaseRate.toFixed(2);
    }

    const secondCaseRateFields = ['1second_case_rate_amount', '2second_case_rate_amount'];

    secondCaseRateFields.forEach(fieldName => {
        document.querySelector(`[name="${fieldName}"]`).addEventListener('input', calculateTotalSecondCaseRate);
    });

    function addDoctorFee() {
        const container = document.getElementById('prof-fee-container');
        const newEntry = document.createElement('div');
        newEntry.classList.add('form-group', 'prof-fee-entry');
        newEntry.innerHTML = `
            <label>Doctor & Fee:</label>
            <select name="doctor_name[]" required>
                <option value="Professional Fee/s">Select Doctor</option>
                <option value="Dr. Gilbert Ian S. Apilado, Accred.# 1100-1638545-2">Dr. Gilbert Ian S. Apilado, Accred.# 1100-1638545-2</option>
                <option value="Dr. Rubelle R. Apilado, Accred.# 1202-2258602-2">Dr. Rubelle R. Apilado, Accred.# 1202-2258602-2</option>
                <option value="Dr. Antonia B. Sabalberino, Accred.# 11-001947918-0">Dr. Antonia B. Sabalberino, Accred.# 11-001947918-0</option>
                <option value="Dr. Amille Joy S. Ty-Luistro, Accred.# 1100-2152792-4">Dr. Amille Joy S. Ty-Luistro, Accred.# 1100-2152792-4</option>
                <option value="Dr. Joash A. Luistro, Accred.# 15012256486-5">Dr. Joash A. Luistro, Accred.# 15012256486-5</option>
                <option value="Dr. Christian Jude Uyvico, Accred.# 1100-2051288-4">Dr. Christian Jude Uyvico, Accred.# 1100-2051288-4</option>
                <option value="Dr. Katrina Carmel Rapada, Accred.# 1501-1740941-0">Dr. Katrina Carmel Rapada, Accred.# 1501-1740941-0</option>
            </select>
            <input type="number" step="0.01" name="doctor_fee[]" placeholder="Fee" class="doctor-fee-input">
        `;
        container.appendChild(newEntry);
        newEntry.querySelector('.doctor-fee-input').addEventListener('input', calculateTotalProfFee);
    }

    function calculateTotalProfFee() {
        const feeInputs = document.querySelectorAll('.doctor-fee-input');
        let total = 0;
        feeInputs.forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('total_pro_fee').value = total.toFixed(2);
    }

    // Initial binding for first fee input
    document.querySelector('.doctor-fee-input').addEventListener('input', calculateTotalProfFee);
</script>
</html>
