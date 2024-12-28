<?php
// calculator.php
require_once 'config.php';
require_once 'functions.php';
require_once 'auth.php';

requireLogin();

$bill_details = null;

function calculateDetailedBill($units) {
    // Define the tier rates and fixed charges
    $fixed_charge = 50;
    $tier1_rate = 3; // Up to 100 units
    $tier2_rate = 5; // 101 to 200 units
    $tier3_rate = 8; // Above 200 units

    $amount = 0;
    if ($units <= 100) {
        $amount = $units * $tier1_rate;
    } elseif ($units <= 200) {
        $amount = (100 * $tier1_rate) + (($units - 100) * $tier2_rate);
    } else {
        $amount = (100 * $tier1_rate) + (100 * $tier2_rate) + (($units - 200) * $tier3_rate);
    }

    $total_amount = $amount + $fixed_charge;
    return [
        'units' => $units,
        'fixed_charge' => $fixed_charge,
        'variable_charge' => $amount,
        'total_amount' => $total_amount
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $units = $_POST['units'];
    $bill_details = calculateDetailedBill($units);
    saveConsumption($conn, $_SESSION['user_id'], $units, $bill_details['total_amount']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator - Energy Saver</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        .form-container {
            max-width: 50%;
            width: 100%;
        }
        footer {
            margin-top: auto;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        label, input, button {
            font-size: 1.25rem;
        }
        input {
            height: 3rem;
        }
        .title {
            font-size: 2.5rem; /* Increasing the font size for the title */
        }
        .label {
            font-size: 1.5rem; /* Increasing the font size for the label */
        }
        .result {
            margin-top: 2rem;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            background-color: #f7fafc;
        }
        .result h3 {
            font-size: 1.75rem; /* Increasing the font size for the result title */
        }
        .result p {
            font-size: 1.25rem; /* Increasing the font size for the result text */
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php include 'includes/header.php'; ?>

    <div class="container mx-auto px-4 py-8 content">
        <div class="bg-white rounded-lg shadow-lg p-10 form-container">
            <h2 class="text-3xl font-bold mb-8 text-center title">Energy Consumption Calculator</h2>
            <form action="" method="POST">
                <div>
                    <label for="units" class="block text-sm font-medium text-gray-700 label">Enter units consumed</label>
                    <input type="number" id="units" name="units" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Calculate Bill</button>
            </form>

            <?php if ($bill_details !== null): ?>
                <div class="result">
                    <h3 class="text-xl font-bold mb-4">Your Bill Details</h3>
                    <p>Units Consumed: <span class="font-semibold"><?php echo number_format($bill_details['units'], 2); ?> units</span></p>
                    <p>Fixed Charges: <span class="font-semibold">₹<?php echo number_format($bill_details['fixed_charge'], 2); ?></span></p>
                    <p>Variable Charges: <span class="font-semibold">₹<?php echo number_format($bill_details['variable_charge'], 2); ?></span></p>
                    <p>Total Amount: <span class="font-semibold">₹<?php echo number_format($bill_details['total_amount'], 2); ?></span></p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
