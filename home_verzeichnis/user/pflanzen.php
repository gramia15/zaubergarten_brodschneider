<?php
$db = mysqli_connect("localhost", "zaubergarten_zaubergarten", "ciscodisco", "zaubergarten_zaubergartendb");
$db->set_charset("utf8");

if(!$db)
{
    exit("Verbindungsfehler: ".mysqli_connect_error());
}

$id = $_GET['id'];

if($id !== null)
{
    $sql = "SELECT * FROM PflanzenView WHERE PflanzenID = " . $id;

    $db_erg = mysqli_query( $db, $sql);
    if ( ! $db_erg)
    {
        die('Ungültige Abfrage: ' . mysqli_error());
    }
    $zeile = $db_erg->fetch_row();

    $sql = "SELECT COUNT(*) FROM Pflanzenpfad WHERE PflanzenID = " . $id;

    $db_erg = mysqli_query( $db, $sql);
    if ( ! $db_erg)
    {
        die('Ungültige Abfrage: ' . mysqli_error());
    }
    $length = $db_erg->fetch_row();
}
else
{
    $zeile = "";
}



?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zaubergarten</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link href="../css/zaubergarten_css.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<?php
  $botanischerName = $zeile[6];
  $deutscherName = $zeile[7];

  $volksmund = $zeile[8];
  $volksmund = trim($volksmund);

  $wuchs = $zeile[10];
  $wuchs = trim($wuchs);

  $hoheMin = $zeile[11];
  $hoheMax = $zeile[12];
  $breite = $zeile[13];

  $rinde = $zeile[14];
  $rinde = trim($rinde);

  $blaetter = $zeile[15];
  $blaetter= trim($blaetter);

  $blueten = $zeile[16];
  $blueten = trim($blueten);

  $fruechte = $zeile[17];
  $fruechte = trim($fruechte);

  $wurzel = $zeile[18];
  $wurzel = trim($wurzel);

  $standort = $zeile[19];
  $standort = trim($standort);

  $boden = $zeile[20];
  $boden = trim($boden);

  $eigenschaften = $zeile[21];
  $eigenschaften = trim($eigenschaften);

  $herkunft = $zeile[22];
  $herkunft = trim($herkunft);

  $schnitt = $zeile[24];
  $schnitt = trim($schnitt);

  $schadbilder = $zeile[25];
  $schadbilder = trim($schadbilder);

  $hilfe = $zeile[26];
  $hilfe = trim($hilfe);

  $rezept = $zeile[29];
  $rezept = trim($rezept);
?>

<div style="text-align: center">

    <h1 style="margin-top: 2%"><?php
        if($id !== null) {
            echo $botanischerName . " - " . $deutscherName;
        }
        ?></h1>
    <!-- Bilder Carusell --->

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 70%; margin: 0 auto" >
        <ol class="carousel-indicators">
            <?php
            if($id !== null)
            {
                if($length[0]>0)
                {
                    echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"0\" class=\"active\"></li>";
                    $i = 1;
                    while ($i < $length[0])
                    {
                        echo "<li data-target=\"#carouselExampleIndicators\" data-slide-to=\"" . $i . "\"></li>\n";
                        $i = $i + 1;
                    }
                }
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            if($id !== null)
            {

                $sql = "SELECT * FROM Pflanzenpfad WHERE PflanzenID = " . $id;

                $db_erg = mysqli_query( $db, $sql);
                if ( ! $db_erg)
                {
                    die('Ungültige Abfrage: ' . mysqli_error());
                }

                $i = 0;
                while($row = mysqli_fetch_array($db_erg, MYSQLI_NUM))
                {
                    $row_picuture_path = $row[1];
                    $url = '../addPlants/';
                    $size = strlen($row_picuture_path);
                    $subs = substr($row_picuture_path, 1);
                    $i = $i + 1;
                    if ($i == 1)
                    {
                        echo "<div class=\"carousel-item active\">\n<img id='imageresource' class=\"d-block w-100\" src=\"" . $url.$subs . "\">\n</div>\n";
                    }
                    else
                    {
                        echo "<div class=\"carousel-item\">\n<img id='imageresource' class=\"d-block w-100\" src=\"" . $url.$subs . "\">\n</div>\n";
                    }
                }
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Zurück</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Weiter</span>
        </a>
    </div>

    <?php

    if(isset($volksmund) === true && $volksmund !== '')
    {
        echo "<h3 style=\"margin-top: 3%\">Volksmund</h3>";
        echo "<p>".$volksmund."</p>";
    }
    if(isset($wuchs) === true && $wuchs !== '')
    {
        echo "<h3>Wuchs</h3>";
        echo "<p>".$wuchs."</p>";
    }
    if ($hoheMin !== null && $hoheMin !== '0')
    {
        echo "<h3>Mindesthöhe</h3>";
        echo "<p>".$hoheMin."cm</p>";
    }
    if ($hoheMax !== null && $hoheMax !== '0')
    {
        echo "<h3>Maximalhöhe</h3>";
        echo "<p>".$hoheMax."cm</p>";
    }
    if ($breite !== null && $breite !== '0')
    {
        echo "<h3>Breite</h3>";
        echo "<p>".$breite."</p>";
    }
    if(isset($rinde) === true && $rinde !== '')
    {
        echo "<h3>Rinde</h3>";
        echo "<p>".$rinde."</p>";
    }
    if(isset($blaetter) === true && $blaetter !== '')
    {
        echo "<h3>Blätter</h3>";
        echo "<p>".$blaetter."</p>";
    }
    if(isset($blueten) === true && $blueten !== '')
    {
        echo "<h3>Blütten</h3>";
        echo "<p>".$blueten."</p>";
    }
    if(isset($fruechte) === true && $fruechte !== '')
    {
        echo "<h3>Früchte</h3>";
        echo "<p>".$fruechte."</p>";
    }
    if(isset($wurzel) === true && $wurzel !== '')
    {
        echo "<h3>Wurzel</h3>";
        echo "<p>".$wurzel."</p>";
    }
    if(isset($standort) === true && $standort !== '')
    {
        echo "<h3>Standort</h3>";
        echo "<p>".$standort."</p>";
    }
    if(isset($boden) === true && $boden !== '')
    {
        echo "<h3>Boden</h3>";
        echo "<p>".$boden."</p>";
    }
    if(isset($eigenschaften) === true && $eigenschaften !== '')
    {
        echo "<h3>Eigenschaften</h3>";
        echo "<p>".$eigenschaften."</p>";
    }
    if(isset($herkunft) === true && $herkunft !== '')
    {
        echo "<h3>Herkunft</h3>";
        echo "<p>".$herkunft."</p>";
    }
    if(isset($schnitt) === true && $schnitt !== '')
    {
        echo "<h3>Schnitt</h3>";
        echo "<p>".$schnitt."</p>";
    }
    if(isset($schadbilder) === true && $schadbilder !== '')
    {
        echo "<h3>Schadbilder</h3>";
        echo "<p>".$schadbilder."</p>";
    }
    if(isset($hilfe) === true && $hilfe !== '')
    {
        echo "<h3>Abhilfe</h3>";
        echo "<p>".$hilfe."</p>";
    }
    if(isset($rezept) === true && $rezept !== '')
    {
        echo "<h3>Rezept</h3>";
        echo "<p>".$rezept."</p>";
    }
    ?>

</div>
<footer class="page-footer font-small">

    <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a class="text-secondary" href="http://www.brodschneider.at/"> Brodschneider</a>
    </div>

</footer>
</body>
</html>
