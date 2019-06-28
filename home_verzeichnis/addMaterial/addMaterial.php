<?php
    session_start();
    if ($_SESSION['login']==true) {
        $_SESSION['login']=true;
    }else{
        $_SESSION['login']=false;
        echo "Not logged in";
        die();
    }
?>

<!DOCTYPE html>
<html lang="de">
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
<body>
<div class="container">
    <?php

    $pictures = array();
    $new_path  = "";
    $total = count($_FILES['materialPicture']['name']);
    echo($total);
    $upload_folder = './materialPicture/'; //Upload Directory
    if($_FILES['materialPicture']['name'][0] != "") {
        for ($i = 0; $i < $total; $i++) {
            $filename = pathinfo($_FILES['materialPicture']['name'][$i], PATHINFO_FILENAME);
            $extension = strtolower(pathinfo($_FILES['materialPicture']['name'][$i], PATHINFO_EXTENSION));
            $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
            if (!in_array($extension, $allowed_extensions)) {
                die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
            }


            $new_path = $upload_folder . $filename . '.' . $extension;

            if (file_exists($new_path)) {
                $id = 1;
                do {
                    $new_path = $upload_folder . $filename . '_' . $id . '.' . $extension;
                    $id++;
                } while (file_exists($new_path));
            }

            move_uploaded_file($_FILES['materialPicture']['tmp_name'][$i], $new_path);
            $pictures[$i] = $new_path;
            echo($new_path);

        }
    }

    $servername = "p2f.at";
    $username = "pfat_zaubergarte";
    $password = "Ss5GHOOJ2F4Z";
    $dbname = "pfat_zaubergarten";

    $name = $_POST["name"];
    $menge = $_POST["menge"];
    $zusammensetzung = $_POST["zusammensetzung"];
    $anwendung = $_POST["anwendung"];
    $rubrik = $_POST["rubrik"];
    $rubrikBeschreibung = $_POST["rubrikbeschreibung"];
    $groesse = $_POST["groesse"];
    $einheit = $_POST["einheit"];




    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->query("SET NAMES 'utf8'");


    if ($_POST["id"] !== null)
    {
        $sql = "UPDATE Material SET name = '" . $name . "', menge = '" . $menge . "', zusammensetzung = '" . $zusammensetzung . "', anwendung = '" . $zusammensetzung . "', rubrikname = '" . $rubrik. "', rubrikbeschreibung = '" . $rubrikBeschreibung . "', groesse = '" . $groesse . "', einheit = '" . $einheit ."' WHERE MaterialID = " . $_POST["id"];
    }
    else
    {
        $sql = "INSERT INTO Material (name, menge, zusammensetzung, anwendung, rubrikname, rubrikbeschreibung, groesse, einheit) 
                  VALUES ('$name', '$menge', '$zusammensetzung', '$anwendung', '$rubrik', '$rubrikBeschreibung', '$groesse', '$einheit');";

    }

    if ($conn->query($sql) === TRUE) {

        if ($_POST["id"] !== null)
        {
            $itemID = $_POST["id"];
        }
        else
        {
            $itemID = $conn->insert_id;


            $size          = '300';
            $content       = 'www.p2f.at/kaingratzdorf/user/material.php?id='.$itemID;
            $correction    = 'L';
            $encoding      = 'encoding';

            $rootUrl = "https://chart.googleapis.com/chart?cht=qr&chs=$size&chl=$content&choe=$encoding&chld=$correction";

            $image = file_get_contents($rootUrl);
            $qrPath = '../qr/material_qr'.$itemID.'.png';
            file_put_contents($qrPath, $image);


            $updateQrToMaterial = "UPDATE Material SET qr = '" . $qrPath . "' WHERE MaterialID = " . $itemID;
            $conn->query($updateQrToMaterial);

        }

        echo "<div style='margin-top: 10%;'>";
        echo "Datensatz wurde erfolgreich hinzugefügt/geupdated!";
        echo "<a href=\"../landing.php\"><button type=\"button\" class=\"btn btn-outline-primary waves-effect\" style=\"float: right;\">Zurück zur Hauptseite</button></a>";
        echo "</div>";

        echo "<div>";
        echo '<a download="material_qr'.$itemID.'.png" href="../qr/material'.$itemID.'.png" title="'.$itemID.'">';
        echo '<img alt="'.$itemID.'" src="../qr/material_qr'.$itemID.'.png">';
        echo '</a>';
        echo "</div>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "DELETE FROM Materialpfad WHERE MaterialID = " . $itemID;


    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    foreach ($pictures as $currentPicture) {
        $sql = "INSERT INTO Materialpfad (MaterialID, Bildpfad) VALUES ('$itemID', '$currentPicture');";


        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }


    /*
    if($materialid > -1){

        $result = $conn->query("SELECT materialid, name, menge, einheit FROM Material ORDER BY einheit;");

        echo "<table class=\"table\">";
        while($row = $result->fetch_assoc()) {
            $mName = $row["name"];
            $id = $row["materialid"];
            echo "$mName";
            $mMenge = $row["menge"];
            $mEinheit = $row["einheit"];
            if($id == $materialid){
                echo "<tr style=\"background-color: #b1dfbb\">";
            }
            else{
                echo "<tr>";
            }
            echo "<td>$mName</td><td>$mMenge</td><td>$mEinheit</td>";
            echo "</tr>";
        }
        echo "</table>";

    }
    */
    ?>
</div>
</body>
</html>