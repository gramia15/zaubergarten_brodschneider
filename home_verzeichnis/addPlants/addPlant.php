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

    $a = "";
    $b = "";
    $c = "";
    $d = "";

    $a = $_GET["SorteID"];
    $b = $_GET["PflegeID"];
    $c = $_GET["WissenswertID"];
    $d = $_GET["BeschreibungID"];

    if($a != "" && $b != "" && $c != "" && $d != ""){

    }

    /*
     * Creating variables
     */
    $botanName = "";
    /*
     * Checking if necessary variables are set, the script can not continue without.
     */
    if(isset($_POST["botanName"])){
        $botanName = $_POST["botanName"];
    }
    else{
        die("Missing variable!");
    }

    $deutschName =$_POST["deutschName"];
    $volksmund = $_POST["volksmund"];
    $schnitt = $_POST["schnitt"];
    $schadbild = $_POST["schadbild"];
    $hilfe = $_POST["hilfe"];
    $herkunft = $_POST["herkunft"];
    $wuchs = $_POST["wuchs"];
    $breite = $_POST["breite"];
    $groesseVon = $_POST["groesseVon"];
    $groesseBis = $_POST["groesseBis"];
    $fruechte = $_POST["fruechte"];
    $wurzel = $_POST["wurzel"];
    $standort = $_POST["standort"];
    $rinde = $_POST["rinde"];
    $blaetter = $_POST["blaetter"];
    $blueten = $_POST["blueten"];
    $boden = $_POST["boden"];
    $eigenschaften = $_POST["eigenschaften"];
    $baumKreis = $_POST["baumKreis"];
    $rezept = $_POST["rezept"];
    $SorteID = $_POST["idSorte"];
    $BeschreibungID = $_POST["idBeschreibung"];
    $PflegeID = $_POST["idPflege"];
    $WissenswertID = $_POST["idWissenswert"];
    //echo "Variables: schnitt: $schnitt, schadbild: $schadbild, hilfe: $hilfe";



     // Checking if picture is legitimate, then saves to server

    $pictures = array();
    $new_path  = "";
    echo($_FILES['plantPicture']['name'][0]);
    $total = count($_FILES['plantPicture']['name']);
    echo($total);
    if ($_FILES['plantPicture']['name'][0] != "") {
        $upload_folder = './plantPictures/'; //Upload Directory
        for ($i = 0; $i < $total; $i++) {
            $filename = pathinfo($_FILES['plantPicture']['name'][$i], PATHINFO_FILENAME);
            $extension = strtolower(pathinfo($_FILES['plantPicture']['name'][$i], PATHINFO_EXTENSION));
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

            move_uploaded_file($_FILES['plantPicture']['tmp_name'][$i], $new_path);
            $pictures[$i] = $new_path;
            echo($new_path);

        }
    }else{
        $new_path = null;
    }

    $servername = "p2f.at";
    $username = "pfat_zaubergarte";
    $password = "Ss5GHOOJ2F4Z";
    $dbname = "pfat_zaubergarten";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    /*
     * Temporary SQL-Statement for PreparedStatement
     */
    $conn->query("SET NAMES 'utf8'");


if ($_POST["id"] !== null)
{

    $sql = "UPDATE Sorte SET BotanischerName = '". $botanName . "', DeutscherName = '" . $deutschName . "', Volksmund = '".$volksmund. "' WHERE SorteID = " . $SorteID;

    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "UPDATE Pflege SET Schnitt = '". $schnitt . "', Schadbilder = '" . $schadbild . "', Hilfe = '".$hilfe. "' WHERE PflegeID = " . $PflegeID;

    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "UPDATE Pflanzenbeschreibung SET herkunft = '". $herkunft . "', wuchs = '" . $wuchs . "', hoehemin = '".$groesseVon. "', hoehemax = '". $groesseBis . "', breite = '"
        . $breite . "', fruechte = '".$fruechte. "', wurzel = '".$wurzel. "', standort = '".$standort. "', rinde = '".$rinde. "', blaetter = '".$blaetter. "', blueten = '".$blueten
            . "', boden = '".$boden. "', eigenschaften = '".$eigenschaften.  "' WHERE BeschreibungsID = " . $BeschreibungID;


    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "UPDATE Wissenswertes SET Baumkreis = '". $baumKreis . "', Rezept = '" . $rezept . "' WHERE WissenswertID = " . $WissenswertID;


    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "UPDATE Pflanze SET Sorte = '". $SorteID . "', Pflege = '" . $PflegeID . "', Beschreibung = '" . $BeschreibungID . "', Wissenswert = '" . $WissenswertID ."' WHERE PflanzenID = " . $_POST["id"];


    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if($_FILES['plantPicture']['name'][0] != "") {
        $sql = "DELETE FROM Pflanzenpfad WHERE PflanzenID = " . $_POST["id"];


        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $temp = $_POST["id"];

        foreach ($pictures as $currentPicture) {
            $sql = "INSERT INTO Pflanzenpfad (PflanzenID, Bildpfad) VALUES ('$temp', '$currentPicture');";


            if ($conn->query($sql) === TRUE) {

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
else
{
    $sql = "INSERT INTO Sorte (BotanischerName, DeutscherName, Volksmund) values ('$botanName', '$deutschName', '$volksmund');";
    $SorteID = -1;

    if ($conn->query($sql) === TRUE) {
        $SorteID = $conn->insert_id;

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO Pflege (Schnitt, Schadbilder, Hilfe) VALUES ('$schnitt', '$schadbild', '$hilfe');";
    $PflegeID = -1;

    if ($conn->query($sql) === TRUE) {
        $PflegeID = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO Pflanzenbeschreibung (herkunft, wuchs, hoehemin, hoehemax, breite, fruechte ,wurzel, standort, rinde, blaetter, blueten, boden, eigenschaften) VALUES ('$herkunft', '$wuchs', '$groesseVon', '$groesseBis', '$breite', '$fruechte', '$wurzel', '$standort', '$rinde', '$blaetter', '$blueten', '$boden', '$eigenschaften');";
    $BeschreibungID = $conn->insert_id;

    if ($conn->query($sql) === TRUE) {
        $BeschreibungID = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO Wissenswertes (Baumkreis, Rezept) VALUES ('$baumKreis', '$rezept');";
    $WissenswertID = -1;

    if ($conn->query($sql) === TRUE) {
        $WissenswertID = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO Pflanze (Sorte, Pflege, Beschreibung, Wissenswert) VALUES ('$SorteID', '$PflegeID', '$BeschreibungID', '$WissenswertID');";
    $PflanzeID = -1;

    if ($conn->query($sql) === TRUE) {
        $PflanzeID = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if($total != 0) {
        foreach ($pictures as $currentPicture) {
            $sql = "INSERT INTO Pflanzenpfad (PflanzenID, Bildpfad) VALUES ('$PflanzeID', '$currentPicture');";


            if ($conn->query($sql) === TRUE) {

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}


$itemID = $PflanzeID;
$size          = '300';
$content       = 'www.p2f.at/kaingratzdorf/user/pflanzen.php?id='.$itemID;
$correction    = 'L';
$encoding      = 'encoding';

$rootUrl = "https://chart.googleapis.com/chart?cht=qr&chs=$size&chl=$content&choe=$encoding&chld=$correction";

$image = file_get_contents($rootUrl);
file_put_contents('../qr/pflanzen_qr'.$itemID.'.png', $image);

echo '<a download="pflanzen'.$itemID.'.png" href="../qr/pflanzen_qr'.$itemID.'.png" title="'.$itemID.'">';
echo '<img alt="'.$itemID.'" src="../qr/pflanzen_qr'.$itemID.'.png">';
echo '</a>';


    echo "<div style='margin-top: 10%;'>";
    echo "Datensatz wurde erfolgreich hinzugefügt/geupdated!";
    echo "<a href=\"../landing.php\"><button type=\"button\" class=\"btn btn-outline-success waves-effect\" style=\"float: right;\">Zurück zur Hauptseite</button></a>";
    echo "</div>";




/*
$sql = "SELECT * FROM Pflanze p INNER JOIN Pflanzenbeschreibung b ON p.Beschreibung = b.BeschreibungsID";

$sql = "SELECT LAST_INSERT_ID();";
$result = $conn->query($sql);

$lastKey;

if($result->num_rows > 0){
while($row = $result->fetch_assoc()){
    foreach ($row as $key => $value) {
        $lastKey = $value;
    }
}
}
else{
echo "No Rows for whatever reason";
}

echo "LastKey: $lastKey <br>";

$sql = "SELECT * FROM Pflege WHERE PflegeID = " . $lastKey . ";";
$result = $conn->query($sql);

if($result->num_rows > 0){
while($row = $result->fetch_assoc()){
    foreach ($row as $key => $value) {
        echo "Key: $key, value: $value <br>";
    }
}
}
else {
echo "There are no rows bitch.<br>";
}*/

    /*
     * Closing the connection when finished
     */
    $conn->close();
?>
</div>
</body>
</html>
