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
    $sql = "SELECT * FROM PflanzenView WHERE PflanzenID = " . $id;

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
        echo "<title>Pflanze bearbeiten</title>";
    }
    else
    {
        echo "<title>Pflanze hinzufügen</title>";
    }
    ?>
</head>
<body>

<form action="addPlant.php" method="post" enctype="multipart/form-data">

    <div class="container">

        <div class="container border border-success rounded p-3">

            <?php
            if($id !== null)
            {
                echo "<h1>Pflanze bearbeiten</h1>";
                echo "<input type=\"text\" name=\"id\" class=\"form-control\" value=\"".$zeile[0]."\" style=\"display:none;\"/>";
                echo "<input type=\"text\" name=\"idSorte\" class=\"form-control\" value=\"".$zeile[5]."\" style=\"display:none;\"/>";
                echo "<input type=\"text\" name=\"idBeschreibung\" class=\"form-control\" value=\"".$zeile[9]."\" style=\"display:none;\"/>";
                echo "<input type=\"text\" name=\"idPflege\" class=\"form-control\" value=\"".$zeile[23]."\" style=\"display:none;\"/>";
                echo "<input type=\"text\" name=\"idWissenswert\" class=\"form-control\" value=\"".$zeile[27]."\" style=\"display:none;\"/>";
            }
            else
            {
                echo "<h1>Pflanze hinzufügen</h1>";
            }
            ?>

            <div class="row row-eq-height">

                <div class="col-md-6">

                    <h2>Benennung</h2>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">Botanischer-Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="botanName" class="form-control" value="<?php echo $zeile[6];?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">Deutscher-Name</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="deutschName" class="form-control" value="<?php echo $zeile[7];?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">Volksmund</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="volksmund" class="form-control" value="<?php echo $zeile[8];?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">Bilder</label>
                        </div>
                        <div class="col-md-8">
                            <input name="plantPicture[]" type="file" multiple/>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                    <h2>Pflege</h2>

                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">Schnitt</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="schnitt" class="form-control" value="<?php echo $zeile[24];?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">Schadbild</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="schadbild" class="form-control" value="<?php echo $zeile[25];?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label class="col-form-label">Hilfe</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="hilfe" class="form-control" value="<?php echo $zeile[26];?>">
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <br>

    <div class="container border border-success rounded p-3">

        <div class="row row-eq-height">

            <div class="col-md-6">

                <h2>Pflanzenbeschreibung</h2>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Herkunft</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="herkunft" class="form-control" value="<?php echo $zeile[22];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Wuchs</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="wuchs" class="form-control" value="<?php echo $zeile[10];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label class="col-form-label">Höhe von [cm]: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="groesseVon" class="form-control" value="<?php echo $zeile[11];?>">
                    </div>
                    <div class="col-md-3">
                        <label class="col-form-label" style="text-align: center"> bis: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="groesseBis" class="form-control" value="<?php echo $zeile[12];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Breite [nur Zahlen]</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="breite" class="form-control" value="<?php echo $zeile[13];?>">
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <h2>&nbsp</h2>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Rinde</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="rinde" class="form-control" value="<?php echo $zeile[14];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Blätter</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="blaetter" class="form-control" value="<?php echo $zeile[15];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Blüten</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="blueten" class="form-control" value="<?php echo $zeile[16];?>">
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <!--<h2>Pflege</h2>-->

                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Früchte</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="fruechte" class="form-control" value="<?php echo $zeile[17];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Wurzel</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="wurzel" class="form-control" value="<?php echo $zeile[18];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Standort</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="standort" class="form-control" value="<?php echo $zeile[19];?>">
                    </div>
                </div>

            </div>

            <div class="col-md-6">

                <!--<h2>Pflege</h2>-->

                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Boden</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="boden" class="form-control" value="<?php echo $zeile[20];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Eigenschaften</label>
                    </div>
                    <div class="col-md-8">
                        <textarea name="eigenschaften" class="form-control" rows="2"><?php echo $zeile[21];?></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-6">

                <h2>Wissenswertes</h2>

                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Baumkreis</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="baumKreis" class="form-control" value="<?php echo $zeile[28];?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label class="col-form-label">Rezept</label>
                    </div>
                    <div class="col-md-8">
                        <textarea name="rezept" class="form-control" rows="2"><?php echo $zeile[29];?></textarea>
                    </div>
                </div>
                <?php
                if($id !== null)
                {
                    echo "<button type=\"submit\" class=\"btn btn-outline-success waves-effect\" name=\"pflanzenSubmit\" style=\"float: right;\">Bearbeiten</button>";
                }
                else
                {
                    echo "<button type=\"submit\" class=\"btn btn-outline-success waves-effect\" name=\"pflanzenSubmit\" style=\"float: right;\">Hinzufügen</button>";
                }
                ?>
            </div>

        </div>

    </div>


    </div>

</form>

</body>
</html>