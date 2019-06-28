<?php

    $db = mysqli_connect("p2f.at", "pfat_zaubergarten", "Ss5GHOOJ2F4Z", "pfat_zaubergarten");
    $db->set_charset("utf8");

    if(!$db)
    {
		echo "DB error";
        exit("Verbindungsfehler: ".mysqli_connect_error());
    }
	
	$db_erg = mysqli_query($db, "SELECT * FROM Pflanze");
    $zeile = $db_erg->fetch_row();
	
	echo "it worked" . $zeile[0];
	echo $zeile[1];
	echo $zeile[2];
	
?>