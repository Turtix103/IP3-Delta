<?php
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $room_id = $_POST['room_id'];

    $stmt = $pdo->prepare('DELETE FROM rooms WHERE room_id = ?');
    $stmt->execute([$room_id]);

    header('Location: RoomsList.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $room_id = $_GET['id'];

    $stmt = $pdo->prepare('SELECT * FROM rooms WHERE room_id = ?');
    $stmt->execute([$room_id]);

    if ($stmt->rowCount() == 0) {
        throwError(404);
    }

    $room = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Smazat zeměstnance</title>
</head>
<body>
    <h1>Smazat zeměstnance</h1>
    <p>Jste si jistu že chcete smazat zaměstnance "<?php echo $room['name']; ?>"?</p>
    <form method="post">
        <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
        <input type="submit" value="Delete">
        <a href="RoomCard.php?id=<?php echo $room['room_id']; ?>">Zrušit</a>
    </form>
</body>
</html>