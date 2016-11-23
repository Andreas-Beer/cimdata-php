<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Backend: Ausgabe der Filmtitel
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 19.09.2016
# Version: Basisversion für Schulungszwecke
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Liste aller Filmtitel</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">  
    </head>
    <body>

        <?php //include './inc/adminbar.inc.php'; ?>

        <div class="container film-list">

            <div class="page-header">
                <h1>Alle Filme</h1>
            </div>

            <h2><a class="btn btn-primary" href="./filmfrom.php?fid=neu">Film hinzufügen</a></h2>

            <table class="table table-striped">
                <tr>
                    <th>#</th>
                    <th>Titel</th>
                    <th>Genre</th>
                    <th>Filmgesellschaft</th>
                    <th>Preis €</th>
                    <th>Sichtbar</th>
                    <th></th>
                </tr>  

                <tr>
                    <td>###ID###</td>
                    <td>###TITEL###</td>
                    <td>###GENRE###</td>
                    <td>###FILM_GESELLSCHAFT###</td>
                    <td class="price">###PREIS###</td>
                    <td>###FREIGABE###</th>
                    <td><a href="$link" class="btn btn-info">Bearbeiten</a></td>
                </tr>

            </table>

        </div>
    </body>
</html>
