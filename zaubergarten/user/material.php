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
    $sql = "SELECT * FROM Material WHERE MaterialID = " . $id;

    $db_erg = mysqli_query( $db, $sql);
    if ( ! $db_erg)
    {
        die('Ungültige Abfrage: ' . mysqli_error());
    }
    $zeile = $db_erg->fetch_row();

    $sql = "SELECT COUNT(*) FROM Materialpfad WHERE MaterialID = " . $id;

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
$grosse = $zeile[1];
$rezept = trim($rezept);

$einheit = $zeile[2];
$name = $zeile[3];

$menge = $zeile[4];
$menge = trim($menge);

$zusammensetzung = $zeile[5];
$zusammensetzung = trim($zusammensetzung);

$anwendung = $zeile[6];
$anwendung = trim($anwendung);

$rubrikName = $zeile[7];
$rubrikName = trim($rubrikName);

$rubrikBeschreibung = $zeile[8];
?>

<div style="text-align: center">
    <h1 style="margin-top: 1%"><?php
        echo $name;
        ?></h1>

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

                $sql = "SELECT * FROM Materialpfad WHERE MaterialID = " . $id;

                $db_erg = mysqli_query( $db, $sql);
                if ( ! $db_erg)
                {
                    die('Ungültige Abfrage: ' . mysqli_error());
                }

                $i = 0;
                while($row = mysqli_fetch_array($db_erg, MYSQLI_NUM))
                {
                    $row_picuture_path = $row[1];
                    $url = '../addMaterial/';
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
    if(isset($zusammensetzung) === true && $zusammensetzung !== '')
    {
        echo "<h3>Zusammensetzung</h3>";
        echo "<p>".$zusammensetzung."</p>";
    }
    if(isset($anwendung) === true && $anwendung !== '')
    {
        echo "<h3>Anwendung</h3>";
        echo "<p>".$anwendung."</p>";
    }
    if(isset($grosse) === true && $grosse !== '' && $menge !== '0')
    {
        echo "<h3>Größe</h3>";
        echo "<p>".$grosse."cm</p>";
    }
    if(isset($menge) === true && $menge !== '' && $menge !== '0')
    {
        echo "<h3>Menge</h3>";
        $einheitsHelper = "";

        switch($einheit)
        {
            case 'liter': $einheitsHelper = "Liter";
            break;
            case 'stuck': $einheitsHelper = "Stück";
            break;
            case 'quadratMeter': $einheitsHelper = "m²";
            break;
            case 'kilo': $einheitsHelper = "kg";
            break;
        }

        echo "<p>".$menge.$einheitsHelper."</p>";
    }
    if(isset($rubrikName) === true && $rubrikName !== '')
    {
        echo "<h3>".$rubrikName."</h3>";
        echo "<p>".$rubrikBeschreibung."</p>";
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
