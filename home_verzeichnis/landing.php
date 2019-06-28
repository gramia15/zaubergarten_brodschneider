<?php

    $db = mysqli_connect("localhost", "zaubergarten_zaubergarten", "ciscodisco", "zaubergarten_zaubergartendb");
    $db->set_charset("utf8");

    if(!$db)
    {
        exit("Verbindungsfehler: ".mysqli_connect_error());
    }

    session_start();

    try {
        $salt = "SELECT salt FROM User WHERE User = " . $_POST['username'];
        $db_erg_salt = mysqli_query($db, $salt);

        while ($row = $db_erg_salt->fetch_row()) {
            $salt = $row[0];
        }

        $hash = "SELECT password FROM User WHERE User = " . $_POST['username'];
        $db_erg_hash = mysqli_query($db, $hash);

        while ($row = $db_erg_hash->fetch_row()) {
            $hash = $row[0];
        }

        if ($_SESSION['login'] == true || hash("sha256",  $_POST['password'] . $salt) == $hash) {
            echo "Login successful";
            $_SESSION['login'] = true;
        } else {
            $_SESSION['login'] = false;
            echo "Login invalid";
            die();
        }
    }catch(Exception $e){
        $_SESSION['login'] = false;
        echo "Login invalid";
        die();
    }

    $id = $_GET['remove'];
    $art = $_GET['art'];


    if (strcmp($art, 'pflanze') == 0)
    {
        $db_erg = mysqli_query($db, "SELECT * FROM Pflanze WHERE PflanzenID = " . $id);
        $zeile = $db_erg->fetch_row();
        $db->query("DELETE FROM Pflanze WHERE PflanzenID = " . $id);
        $db->query("DELETE FROM Sorte WHERE SorteID = " . $zeile[1]);
        $db->query("DELETE FROM Pflanzenbeschreibung WHERE BeschreibungsID = " . $zeile[2]);
        $db->query("DELETE FROM Pflege WHERE PflegeID = " . $zeile[3]);
        $db->query("DELETE FROM Wissenwertes WHERE WissenwertID = " . $zeile[4]);

    }
    else if (strcmp($art, 'material') == 0)
    {
        $sql_remove = "DELETE FROM Material WHERE MaterialID = " . $id;
        $db->query($sql_remove);
    }

    $sql_pflanzen = "SELECT * FROM PflanzenView";

    $db_erg_pflanzen = mysqli_query( $db, $sql_pflanzen );
    if ( ! $db_erg_pflanzen )
    {
        die('Ungültige Abfrage: ' . mysqli_error());
    }

    $sql_material = "SELECT * FROM Material";

    $db_erg_material = mysqli_query( $db, $sql_material );
    if ( ! $db_erg_material )
    {
        die('Ungültige Abfrage: ' . mysqli_error());
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Zaubergarten</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link href="css/zaubergarten_css.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
<body>
<div class="standardCenter">
    <div>
        <h1 style="margin-top: 2%">Item hinzufügen</h1>
        <form action="addPlants/index.php" style="display: inline;">
            <button type="submit" class="btn btn-outline-success waves-effect btn-xl">Pflanzen</button>
        </form>
        <form action="addMaterial/index.php" style="display: inline;">
            <button type="submit" class="btn btn-outline-primary waves-effect btn-xl">Material</button>
        </form>
    </div>
    <div>
        <h1 style="margin-top: 5%">Pflanzen verwalten</h1>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Botanischer Name</th>
                <th scope="col">Deutscher Name</th>
                <th scope="col"> </th>
                <th scope="col"> </th>
				<th scope="col"> </th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($zeile = $db_erg_pflanzen->fetch_row()) {
                echo "<tr>";
                echo "<td>" . $zeile[6] . "</td>\n";
                echo "<td>" . $zeile[7] . "</td>\n";

                echo "<td><a class=\"text-secondary\" href='". "addPlants/index.php?edit=" . $zeile[0]. "'><i class=\"fas fa-edit\"></i></a></td>";
                echo "<td><a class=\"text-danger\" href='". "landing.php?remove=" . $zeile[0]. "&art=pflanze" ."'><i class=\"fas fa-trash-alt\"></i></a></td>";
				echo "<td><a download=\"pflanzen_qr".$zeile[0].".png\" class=\"text-secondary\" href=\"../qr/pflanzen_qr".$zeile[0].".png\"><i class=\"fas fa-qrcode\"></i></a></td>";
				
				
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div>
        <h1 style="margin-top: 5%">Material verwalten</h1>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Menge</th>
                <th scope="col">Einheit</th>
                <th scope="col"> </th>
                <th scope="col"> </th>
				<th scope="col"> </th>
            </tr>
            </thead>
            <tbody>
            <?php
                while ($zeile = $db_erg_material->fetch_row()) {
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
            ?>
            </tbody>
        </table>
    </div>

    <footer class="page-footer font-small">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2019 Copyright:
            <a class="text-secondary" href="http://www.brodschneider.at/"> Brodschneider</a>
        </div>
        <!-- Copyright -->

    </footer>


</div>
</body>
</html>