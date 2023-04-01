<?php

if (isset($_POST['username']) && isset($_POST['password'])) {
    require_once 'Database.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM employees WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: MainMenu.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>