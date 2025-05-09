<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statement of Account - Main Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
            font-size: 14px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }

        .button-container button {
            padding: 15px 30px;
            font-size: 16px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #0056b3;
        }

        .footer {
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <h1>Welcome to the Statement of Account System</h1>

    <div class="button-container">
        <form action="in_patient.php" method="get">
            <button type="submit">Form 1: Patient Statement</button>
        </form>

        <form action="out_patient.php" method="get">
            <button type="submit">Form 2: Patient Billing</button>
        </form>

        <form action="with_pf.php" method="get">
            <button type="submit">Form 3: Payment History</button>
        </form>
    </div>

    <div class="footer">
        <p>&copy; 2025 Salcedo Doctors Hospital, Inc. | All Rights Reserved</p>
    </div>

</body>
</html>
