<?php
// history.php
require_once 'config.php';
require_once 'functions.php';
require_once 'auth.php';

requireLogin();

$history = getConsumptionHistory($conn, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumption History - Energy Saver</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <?php include 'includes/header.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-8 text-center">Your Consumption History</h2>

        <?php if (empty($history)): ?>
            <div class="text-center text-gray-600">
                <p>No consumption history available yet.</p>
                <a href="calculator.php" class="text-blue-500 hover:underline">Calculate your first bill</a>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Units</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Change</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php 
                        $prev_units = null;
                        foreach ($history as $record): 
                            $change_class = '';
                            $change_text = '-';
                            
                            if ($prev_units !== null) {
                                $change = (($record['units_consumed'] - $prev_units) / $prev_units) * 100;
                                $change_text = number_format($change, 1) . '%';
                                $change_class = $change > 0 ? 'text-red-600' : 'text-green-600';
                            }
                            $prev_units = $record['units_consumed'];
                        ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo date('F Y', mktime(0, 0, 0, $record['month'], 1, $record['year'])); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php echo number_format($record['units_consumed'], 2); ?> units
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    ₹<?php echo number_format($record['bill_amount'], 2); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap <?php echo $change_class; ?>">
                                    <?php echo $change_text; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php
                $total_units = array_sum(array_column($history, 'units_consumed'));
                $total_amount = array_sum(array_column($history, 'bill_amount'));
                $avg_units = $total_units / count($history);
                $avg_amount = $total_amount / count($history);
                $max_units = max(array_column($history, 'units_consumed'));
                $min_units = min(array_column($history, 'units_consumed'));
                ?>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-sm font-medium text-gray-500">Average Monthly Usage</h3>
                    <p class="text-2xl font-bold text-blue-600"><?php echo number_format($avg_units, 2); ?> units</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-sm font-medium text-gray-500">Average Monthly Bill</h3>
                    <p class="text-2xl font-bold text-green-600">₹<?php echo number_format($avg_amount, 2); ?></p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-sm font-medium text-gray-500">Highest Usage</h3>
                    <p class="text-2xl font-bold text-red-600"><?php echo number_format($max_units, 2); ?> units</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-sm font-medium text-gray-500">Lowest Usage</h3>
                    <p class="text-2xl font-bold text-green-600"><?php echo number_format($min_units, 2); ?> units</p>
                </div>
            </div>

            <div class="mt-8 bg-blue-50 rounded-lg p-6">
                <h3 class="text-xl font-bold mb-4">Usage Insights</h3>
                <?php
                $latest_units = $history[0]['units_consumed'];
                $comparison = $latest_units - $avg_units;
                $percentage = ($comparison / $avg_units) * 100;
                ?>
                <p class="mb-2">
                    Your latest consumption (<?php echo number_format($latest_units, 2); ?> units) is 
                    <span class="font-bold <?php echo $percentage > 0 ? 'text-red-600' : 'text-green-600'; ?>">
                        <?php echo abs(number_format($percentage, 1)); ?>% 
                        <?php echo $percentage > 0 ? 'higher' : 'lower'; ?>
                    </span>
                    than your average monthly consumption.
                </p>
                <a href="tips.php" class="text-blue-600 hover:underline">View energy saving tips →</a>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>