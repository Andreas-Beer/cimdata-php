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

// Empfangen der Variablen.
$curr_genreID   = !empty($_GET['g']) ? $_GET['g'] : '';
$curr_companyID = !empty($_GET['c']) ? $_GET['c'] : '';


/*
 * Den default-falls peichern (die 10 neustern Filme)
 * Er wird nur überschrieben, falls eine andere ID übergeben wurde.
 */
$sql_select_movie = $sql_select_moviesNew10;

/*
 * wenn eine genreID übergeben wurde
 * nimm die genre sql;
 */
if (!empty($curr_genreID)) {
    $sql_select_movie = $sql_select_moviesByGenreId($curr_genreID);
}

/*
 * wenn keine genreID übergeben wurde, und stattdessen eine companyID,
 * nimm die company sql;
 */
elseif (!empty($curr_companyID)) {
    $sql_select_movie = $sql_select_moviesByCompanyId($curr_companyID);
}

$handle_movies = mysqli_query($conn, $sql_select_movie);
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title>###Seitentitel###</title><!-- TODO: Dynamisieren -->
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
                        <?php echo $handle_movies->num_rows; ?> Filme Gefunden
                    </div>
                    
                    <?php
                    while (($data = mysqli_fetch_assoc($handle_movies)) !== NULL) {
                        include './inc/film.inc.php';
                    }
                    ?>

                </div>

            </div>
        </main>

        <?php include './inc/footer.inc.php'; ?>

    </body>
</html>