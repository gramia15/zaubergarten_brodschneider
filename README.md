# Zaubergarten - Brodschneider

Mittels QR-Code werden dem User einzelne Pflanzen und Materialdetails angezeigt.

## Installation

Zuerst muss die Datenbankstruktur auf Ihre MySQL Datenbank geladen werden. Dazu bitte mittels eines Datenbank Tools eine neue Datenbank erstellen und dann das .sql File importieren. Wir haben Ihnen ein paar Testdaten bereits eingefügt, damit Sie einen kurzen Einblick bekommen, wie was zum Einfügen ist.

Im Folder "home_verzeichnis", sind alle Files, die sich auf dem Web Server ebenfalls im Home Verzeichnis befinden sollen. Bitte die index.html dann mit ihrer neuen Webpage ersetzen. 

## Changes
Da wir bis jetzt nichts von Ihnen gehört haben, sind hier die einzelnen Files wo etwas geändert werden muss:

addMaterial/addMatieral.php

```
$content = '{your domain}/user/material.php?id='.$itemID;
```
addPlants/addPlant.php

```
$content = '{your domain}/user/pflanzen.php?id='.$itemID;
```
in jedem .php File
```
$db = mysqli_connect("{url}", "{nutzer}", "{passwort}", "{datenbank}");
```
PS: bitte alles ohne '{' bzw. '}' einsetzten.
## Login
Bitte kontaktieren Sie mich für die neune Logindaten.

Der Login wurde nun auf ```{url}/login``` ausgelagert!


Leider war es uns nicht möglich die Url zu verbergen.
## Kontakt
Bei Fragen, bitte melden Sie sich einfach telefonisch bei mir!

