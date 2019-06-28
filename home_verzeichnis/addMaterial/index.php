<?php
    session_start();
    if ($_SESSION['login']==true) {
        $_SESSION['login']=true;
    }else{
        $_SESSION['login']=false;
        echo "Not logged in";
        die();
    }

$db = mysqli_connect("p2f.at", "pfat_zaubergarten", "Ss5GHOOJ2F4Z", "pfat_zaubergarten");
$db->set_charset("utf8");

if(!$db)
{
    exit("Verbindungsfehler: ".mysqli_connect_error());
}

$id = $_GET['edit'];

if($id !== null)
{
    $sql = "SELECT * FROM Material WHERE MaterialID = " . $id;

    $db_erg = mysqli_query( $db, $sql);
    if ( ! $db_erg)
    {
        die('Ungültige Abfrage: ' . mysqli_error());
    }
    $zeile = $db_erg->fetch_row();
}
else
{
    $zeile = "";
}

?>
<!DOCTYPE html>
<html lang="en">
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

    <?php
        if($id !== null)
        {
            echo "<title>Material bearbeiten</title>";
        }
        else
        {
            echo "<title>Material hinzufügen</title>";
        }
    ?>

</head>
<body>
<div class="container">
    <div style="margin-top: 5%" class="container border border-primary rounded p-3" style="border-color: #781416 !important;">
        <form action="addMaterial.php" method="post" enctype="multipart/form-data">

            <?php
        if($id !== null)
        {
            echo "<h1>Material bearbeiten</h1>";
            echo "<input type=\"text\" name=\"id\" class=\"form-control\" value=\"".$zeile[0]."\" style=\"display:none;\"/>";
        }
        else
        {
            echo "<h1>Material hinzufügen</h1>";
        }
        ?>
        <div class="row row-eq-height">

            <div class="col-md-6">


                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" value="<?php echo $zeile[3];?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Größe [nur Zahlen]</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="groesse" class="form-control" value="<?php echo $zeile[1]; ?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Menge [nur Zahlen]</label>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="menge" class="form-control" value="<?php echo $zeile[4]; ?>"/>
                    </div>
                    <div class="col-md-3">
                        <select name="einheit" class="form-control">
                            <?php
                            switch ($zeile[2]) {
                                case 'liter':
                                    echo "<option value=\"quadratMeter\">m²</option>\n";
                                    echo "<option value=\"stuck\">Stück</option>\n";
                                    echo "<option value=\"liter\" selected>Liter</option>\n";
                                    echo "<option value=\"kilo\">kg</option>";
                                    break;
                                case 'quadratMeter':
                                    echo "<option value=\"quadratMeter\" selected>m²</option>\n";
                                    echo "<option value=\"stuck\">Stück</option>\n";
                                    echo "<option value=\"liter\">Liter</option>\n";
                                    echo "<option value=\"kilo\">kg</option>";
                                    break;
                                case 'stuck':
                                    echo "<option value=\"quadratMeter\">m²</option>\n";
                                    echo "<option value=\"stuck\" selected>Stück</option>\n";
                                    echo "<option value=\"liter\">Liter</option>\n";
                                    echo "<option value=\"kilo\">kg</option>";
                                    break;
                                case 'kilo':
                                    echo "<option value=\"quadratMeter\">m²</option>\n";
                                    echo "<option value=\"stuck\">Stück</option>\n";
                                    echo "<option value=\"liter\">Liter</option>\n";
                                    echo "<option value=\"kilo\" selected>kg</option>";
                                    break;
                                default:
                                    echo "<option value=\"quadratMeter\">m²</option>\n";
                                    echo "<option value=\"stuck\">Stück</option>\n";
                                    echo "<option value=\"liter\">Liter</option>\n";
                                    echo "<option value=\"kilo\">kg</option>";
                                    break;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Bilder</label>
                    </div>
                    <div class="col-md-8">
                        <input name="materialPicture[]" type="file" multiple/>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Zusammensetzung</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="zusammensetzung" class="form-control" value="<?php echo $zeile[5];?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Anwendung</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="anwendung" class="form-control" value="<?php echo $zeile[6];?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Rubrik Name</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="rubrik" class="form-control" value="<?php echo $zeile[7];?>"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Rubrik Beschreibung</label>
                    </div>
                    <div class="col-md-8">
                        <textarea name="rubrikbeschreibung" class="form-control"><?php echo $zeile[8];?></textarea>
                    </div>
                </div>
                <?php
                    if($id !== null)
                    {
                        echo "<button type=\"submit\" class=\"btn btn-outline-primary waves-effect\" name=\"materialSubmit\" style=\"float: right;\">Bearbeiten</button>";
                    }
                    else
                    {
                        echo "<button type=\"submit\" class=\"btn btn-outline-primary waves-effect\" name=\"materialSubmit\" style=\"float: right;\">Hinzufügen</button>";
                    }
                ?>
            </div>
        </div>
        </form>
    </div>
</div>
</div>
</body>
</html>