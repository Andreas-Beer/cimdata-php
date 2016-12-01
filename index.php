<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Frontend: Ausgabe der Filmtitel
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 19.09.2016
# Version: Basisversion für Schulungszwecke
?>

<?php
include_once './config.inc.php';
require_once PATH_FILE_DBCONNECT;
?>

<?php

function getTitle($currType = '', $currSubType = '') {
    
    switch ($currType) {
        case 'c': return sprintf(TEXT_MAIN_GUI_HEADLINE_COMPANY, $currSubType);
        case 'g': return sprintf(TEXT_MAIN_GUI_HEADLINE_GENRE, $currSubType);
        default : return TEXT_MAIN_GUI_HEADLINE_DEFAULT;
    }
}

function getSubtype ($currType, $currID = 0) {

    // Die Abfragen global machen
    global $sql_select_companyByID;
    global $sql_select_genreByID;
    global $conn;
    
    /*
     * Eine Variable anlegen, die zum Schluss,
     * die gewählte sql Anweisung beinhaltet
     */
    $sql = '';
    
    switch ($currType) {
        case 'c': $sql = $sql_select_companyByID($currID); break;
        case 'g': $sql = $sql_select_genreByID($currID);   break;
        default : return '';
    }
    
    $hander = mysqli_query($conn, $sql);
    $data   = mysqli_fetch_assoc($hander);
    return $data['name'];
}

// Den Defaultwert der Variablen setzen.
$siteType       = '';
$subtype        = '';
$curr_genreID   = '';
$curr_companyID = '';

/*
 * Den default-fall speichern (die 10 neustern Filme)
 * Er wird nur überschrieben, falls eine andere ID übergeben wurde.
 */
$sql_select_movie = $sql_select_moviesNew10;

/*
 * Empfangen und überprüfen der Variablen.
 */

/*
 * Wenn ein g übergeben wurde, die Auswahl also ein Genre ist.
 */
if (!empty($_GET['g'])) {
    $siteType = 'g';
    $curr_genreID = $_GET['g'];
    $sql_select_movie = $sql_select_moviesByGenreId($curr_genreID);
    
    $subtype = getSubtype($siteType, $curr_genreID);
}

/*
 * Wenn ein c übergeben wurde, die Auswahl also eine Filmgesellschaft ist.
 */
if (!empty($_GET['c'])) {
    $siteType = 'c';
    $curr_companyID = $_GET['c'];
    $sql_select_movie = $sql_select_moviesByCompanyId($curr_companyID);
    
    $subtype = getSubtype($siteType, $curr_companyID);
}

$title = getTitle($siteType) . $subtype;

$handle_movies = mysqli_query($conn, $sql_select_movie);
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="<?php echo PATH_FILE_STYLE_MAIN; ?>" />
    </head>

    <body>

        <?php
        session_start();
        
        if (isset($_GET['adminbar']) || $_SESSION['login'] == 'true') {
            include PATH_FILE_ADMINBAR;
        }
        ?>

        <?php include PATH_FILE_HEADER; ?>

        <main class="main container">
            <div class="row">

                <div class="col-sm-4 col-md-3 sidebar">

                    <?php include PATH_FILE_COMPANY; ?>

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
                        <?php echo sprintf(TEXT_MAIN_GUI_MSG_FILMFOUND, $handle_movies->num_rows); ?>
                    </div>
                    
                    <?php
                    while (($data = mysqli_fetch_assoc($handle_movies)) !== NULL) {
                        include PATH_FILE_FILM;
                    }
                    ?>

                </div>

            </div>
        </main>
        <?php include PATH_FILE_FOOTER; ?>
        
        <script src="<?php echo PATH_FILE_JS_JQUERY; ?>" type="text/javascript"></script>
        <script src="<?php echo PATH_FILE_JS_BOOTSTRAP; ?>" type="text/javascript"></script>

    </body>
</html>