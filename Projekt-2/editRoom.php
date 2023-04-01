<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Upravit místnosti</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2>Upravit místnost</h2>
                <form method="post" action="updateRoom.php">
                    <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $room['name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="no">no:</label>
                        <input type="text" class="form-control" id="no" name="no" value="<?php echo $room['no']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefon:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $room['phone']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Upravit</button>
                    <a href="RoomsList.php" class="btn btn-default">Zrušit</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>