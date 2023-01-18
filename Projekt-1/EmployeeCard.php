<!DOCTYPE html>
<?php
require_once 'Database.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT,["options" => ["min_range" => 1]]);

if(!$id) {
    throwError(400);
}

$stmt = $pdo->query("SELECT * FROM employee WHERE employee_id = $id");
$keystmt = $pdo->query("SELECT * FROM ip_3.key WHERE employee = $id ORDER BY key_id");

if($stmt->rowCount() == 0) {
    throwError(404);
}

$employee = $stmt->fetch();
$key = $keystmt->fetchAll();
?>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Eployee Card</title>
</head>
</html>