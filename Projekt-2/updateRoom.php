<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $employee_id = $_POST['employee_id'];
    
    $stmt = $pdo->prepare('SELECT * FROM employees WHERE employee_id = ?');
    $stmt->execute([$employee_id]);
    $current_employee = $stmt->fetch();
    
    $name = $_POST['name'] ?: $current_employee['name'];
    $po = $_POST['po'] ?: $current_employee['po'];
    $phone = $_POST['phone'] ?: $current_employee['phone'];
    
    // Prepare and execute the SQL query
    $stmt = $pdo->prepare('UPDATE employees SET name = ?, no = ?, phone = ? WHERE employee_id = ?');
    $stmt->execute([$name, $no, $phone, $employee_id]);

    header('Location: employee_details.php?id=' . $employee_id);
    exit;
} ?>