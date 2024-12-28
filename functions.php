<?php
// functions.php
require_once 'config.php';

function calculateBill($units) {
    $total = 0;
    
    // Calculate based on slabs
    if ($units <= 100) {
        $total = $units * SLAB_RATES['0-100'];
    } elseif ($units <= 300) {
        $total = (100 * SLAB_RATES['0-100']) + 
                (($units - 100) * SLAB_RATES['101-300']);
    } elseif ($units <= 500) {
        $total = (100 * SLAB_RATES['0-100']) + 
                (200 * SLAB_RATES['101-300']) + 
                (($units - 300) * SLAB_RATES['301-500']);
    } else {
        $total = (100 * SLAB_RATES['0-100']) + 
                (200 * SLAB_RATES['101-300']) + 
                (200 * SLAB_RATES['301-500']) + 
                (($units - 500) * SLAB_RATES['501+']);
    }
    
    // Add fixed charge
    $total += FIXED_CHARGE;
    
    // Add tax
    $total += ($total * TAX_RATE);
    
    return round($total, 2);
}

function getEnergyTips($conn) {
    $tips = [];
    $result = $conn->query("SELECT * FROM energy_tips ORDER BY potential_savings DESC");
    
    while ($row = $result->fetch_assoc()) {
        $tips[] = $row;
    }
    
    return $tips;
}

function saveConsumption($conn, $userId, $units, $amount) {
    $month = date('n');
    $year = date('Y');
    
    $stmt = $conn->prepare("INSERT INTO consumption_history (user_id, units_consumed, bill_amount, month, year) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("idiis", $userId, $units, $amount, $month, $year);
    
    return $stmt->execute();
}

function getConsumptionHistory($conn, $userId) {
    $history = [];
    $stmt = $conn->prepare("SELECT * FROM consumption_history WHERE user_id = ? ORDER BY year DESC, month DESC LIMIT 12");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }
    
    return $history;
}