<?php
// tips.php
require_once 'config.php';
require_once 'functions.php';

$tips = getEnergyTips($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Energy Saving Tips - Energy Saver</title>
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
            padding: 2rem;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php include 'includes/header.php'; ?>

    <div class="container mx-auto px-4 py-8 content">
        <div class="text-center">
            <h2 class="text-3xl font-bold mb-8 title">Energy Saving Tips</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            <?php foreach ($tips as $tip): ?>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-xl font-semibold mb-3"><?php echo htmlspecialchars($tip['title']); ?></h3>
                <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($tip['description']); ?></p>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500">Potential Savings:</span>
                    <span class="text-lg font-bold text-green-600"><?php echo $tip['potential_savings']; ?>%</span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
