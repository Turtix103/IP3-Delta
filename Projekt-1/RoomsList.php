<!DOCTYPE html>
<?php
require_once 'Database.php';
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