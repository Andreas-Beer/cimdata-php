<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Ausgabe der Filmtitel
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 19.09.2016
# Version: Basisversion für Schulungszwecke
?>

<?php

// Die Datenbankverbindung einbinden
require_once './inc/dbconn.php';

?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title>###Seitentitel###</title>
        <link rel="stylesheet" href="css/main.css" />
    </head>

    <body>

        <!-- ###ADMINBAR### -->

        <?php include './inc/header.inc.php'; ?>

        <main class="main container">
            <div class="row">

                <div class="col-sm-4 col-md-3 sidebar">

                    <?php include './inc/company.inc.php'; ?>

                    <!-- Container für weitere Links -->
<!--                    <aside class="links panel panel-default hidden-xs">
                        <div class="panel-heading">
                            Weitere Links
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled">
                                <li><a href="">###Link###</a></li>
                            </ul>
                        </div>
                    </aside>-->

                </div>

                <div class="col-sm-8 col-md-9">


                    <div class="well well-sm">
                        ###ANZAHL_FILME_GEFUNDEN###
                    </div>

                    <?php include './inc/film.inc.php'; ?>

                </div>

            </div>
        </main>

        <?php include './inc/footer.inc.php'; ?>

    </body>
</html>