<html>

<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <title>Material hinzufügen</title>
</head>

<form action="/search/index.php" method="get">
    <label>Suche: </label>
    <input type="text" name="search"/>
    <label>Pflanze</label>
    <input type="radio" name="choice" value="pflanze"/>
    <label>Material</label>
    <input type="radio" name="choice" value="material"/>
    <input type="submit" value="Suche">
</form>

<h1>Suchergebnis</h1>

<?php

$db = mysqli_connect("localhost", "zaubergarten_zaubergarten", "ciscodisco", "zaubergarten_zaubergartendb");
$db->set_charset("utf8");

if (!$db) {
    exit("Verbindungsfehler: " . mysqli_connect_error());
}

$search = $_GET["search"];
$choice = $_GET["choice"];

echo "<table>";
if (strcmp($choice, "pflanze") == 0) {
    $res = mysqli_query($db, "SELECT * FROM PflanzenView WHERE botanischerName LIKE '%$search%' OR deutschnerName LIKE '$search';");

    while ($zeile = $res->fetch_row()) {
        echo "<tr>";
        echo "<td>" . $zeile[6] . "</td>\n";
        echo "<td>" . $zeile[7] . "</td>\n";

        echo "<td><a class=\"text-secondary\" href='". "addPlants/index.php?edit=" . $zeile[0]. "'><i class=\"fas fa-edit\"></i></a></td>";
        echo "<td><a class=\"text-danger\" href='". "landing.php?remove=" . $zeile[0]. "&art=pflanze" ."'><i class=\"fas fa-trash-alt\"></i></a></td>";
        echo "<td><a download=\"pflanzen_qr".$zeile[0].".png\" class=\"text-secondary\" href=\"../qr/pflanzen_qr".$zeile[0].".png\"><i class=\"fas fa-qrcode\"></i></a></td>";

        echo "</tr>";
    }
} else {
    $res = mysqli_query($db, "SELECT * FROM Material WHERE Name LIKE '%$search%';");

    while ($zeile = $res->fetch_row()) {
        echo "<tr>";
        echo "<td>" . $zeile[3] . "</td>\n";
        echo "<td>" . $zeile[4] . "</td>\n";
        switch ($zeile[2]) {
            case 'liter':
                echo "<td>Liter</td>\n";
                break;
            case 'quadratMeter':
                echo "<td>m²</td>\n";
                break;
            case 'stuck':
                echo "<td>Stück</td>\n";
                break;
            case 'kilo':
                echo "<td>Kilogramm</td>\n";
                break;
            default:
                echo "<td>" . $zeile[2] . "</td>\n";
                break;
        }
        echo "<td><a class=\"text-secondary\" href='". "addMaterial/index.php?edit=" . $zeile[0]. "'><i class=\"fas fa-edit\"></i></a></td>";
        echo "<td><a class=\"text-danger\" href='". "landing.php?remove=" . $zeile[0]. "&art=material" ."'><i class=\"fas fa-trash-alt\"></i></a></td>";
        echo "<td><a download=\"material_qr".$zeile[0].".png\" class=\"text-secondary\" href=\"../qr/material_qr".$zeile[0].".png\"><i class=\"fas fa-qrcode\"></i></a></td>";
        echo "</tr>";
    }
}
echo "</table>";

?>

</html>
