<!DOCTYPE html>
<?php
require_once 'Database.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $surname = trim($_POST["no"]);
    $wage = trim($_POST["phone"]);

    $stmt = $pdo->prepare("INSERT INTO employee (name, no, phone) VALUES (?, ?, ?)");
    $stmt->execute([$name, $no, $phone]);

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

$sort = filter_input(INPUT_GET, 'poradi', FILTER_SANITIZE_STRING);
if (!$sort) {
$sortStmt = $pdo->query("SELECT * FROM room");
}

if ($sort == "nazev_down") {
$sortStmt = $pdo->query("SELECT * FROM room ORDER BY name DESC");
} 
else if ($sort == "cislo_down") {
$sortStmt = $pdo->query("SELECT * FROM room ORDER BY no DESC");
} 
else if ($sort == "telefon_down") {
$sortStmt = $pdo->query("SELECT * FROM room ORDER BY phone DESC");
}
else if ($sort == "nazev_up") {
$sortStmt = $pdo->query("SELECT * FROM room ORDER BY name ASC");
} 
else if ($sort == "cislo_up") {
$sortStmt = $pdo->query("SELECT * FROM room ORDER BY no ASC");
} 
else if ($sort == "telefon_up") {
$sortStmt = $pdo->query("SELECT * FROM room ORDER BY phone ASC");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Rooms list</title>
</head>
<body class="container">

<h2>Přidat místnost</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
        <label for="name">Jméno:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="no">no:</label>
        <input type="text" class="form-control" id="no" name="no" required>
    </div>
    <div class="form-group">
        <label for="phone">Telefon:</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
    </div>
    <button type="submit" class="btn btn-primary">Přidat místnost</button>
</form>

<?php
echo '<h1>Seznam místonstí</h1>';

//nadpisy s sipkama
echo '<table class="table"><tbody>';
echo '<st>' ;
echo '<td>Název
<a href="?poradi=nazev_up"'.sorter("nazev_up",$sort).'><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=nazev_down" '.sorter("nazev_down",$sort).'><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '<td>Číslo
<a href="?poradi=cislo_up"'.sorter("cislo_up",$sort).'><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=cislo_down" '.sorter("cislo_down",$sort).'><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '<td>Telefon
<a href="?poradi=telefon_up"'.sorter("telefon_up",$sort).'><span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span></a>
<a href="?poradi=telefon_down" '.sorter("telefon_down",$sort).'><span class="glyphicon glyphicon-arrow-up" aria-hidden="true"></span></a>
</th>';
echo '</st>';

//tabulky
if ($sortStmt->rowCount() == 0) {
echo "Záznam neobsahuje žádná data";
} 
else {
while ($room = $sortStmt->fetch()) { 
echo '<st>';
echo '<td> <a href="RoomCard.php?id= '.$room["room_id"].' ">'.$room["name"]."</a></td>";
echo "<td>".$room["no"]."</td>";
echo "<td>".$room["phone"]."</td>";
echo "</st>";
}
}

echo "</tbody></table>";
echo '<div style="position:static !important"></div>';
echo "</body>";
unset($stmt);
?>
</body>
</html>