<!DOCTYPE html>
<?php
require_once 'Database.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT,["options" => ["min_range" => 1]]);

if(!$id) {
    throwError(400);
}

$stmt = $pdo->query("SELECT * FROM employee WHERE employee_id = $id");

if($stmt->rowCount() == 0) {
    throwError(404);
}

$room = $stmt->fetch();
?>