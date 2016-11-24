<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Formular zum Einfügen und bearbeiten von Filmen
#
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 19.09.2016
# Version: Basisversion für Schulungszwecke
?>

<?php
include_once '../inc/config.inc.php';
include_once '../inc/dbconn.php';
include_once '../inc/functions.inc.php';
?>

<?php
$id = !empty($_GET['f']) ? $_GET['f'] : false;
$data = NULL;
$path_img = '../bilder/';

$file         = $_FILES['file'];
$image_loaded = empty($file['error']);
$msgErrors    = array();

// das Bild nur verarbeiten, wenn es KEINEN Fehler gab.

if ($image_loaded) {
    
    echo '<pre style="text-align: left;">';
    var_dump($file['size']);
    var_dump(SIZE_MAX_IMAGE);
    var_dump($file['size'] > SIZE_MAX_IMAGE);
    echo '</pre>';
    
    if ($_FILES['size'] > SIZE_MAX_IMAGE) {
        $msgErrors['size'] = MSG_IMAGEUPLOAD_SIZE;
    } 
    
    echo '<pre style="text-align: left;">';

    var_dump($_FILES);
    var_dump($msgErrors);

    echo '</pre>';
    
    
} else {
    echo 'Uploadfehler!';
}

if ($id) {
    // Wenn eine Id übergeben wurde, die Daten zu dem Film abfragen.
    $handle_film = mysqli_query($conn, $sql_select_moviesBymovieId($id));
    $data = mysqli_fetch_assoc($handle_film);
}

/*
 * Wenn keine ID übergeben wurde,
 * Oder eine nicht existente,
 * 
 * zurück zur letzten, bzw. der index Seite.
 */
if (!$id || $data === NULL) {
    $back = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : './index.php';
    header('Location: ' . $back);
}
?>


<!DOCTYPE html>
<html lang="de">
    <head>

        <meta charset="utf-8">
        <title>Bild bearbeiten</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">  

    </head>
    <body>

<?php
$isLogedIn = TRUE;
//    include './inc/adminbar.inc.php';
?>

        <div class="film-form container">

            <div class="page-header">
                <h1>Bild bearbeiten</h1>
            </div>

            <div class="well">

                <img src="<?php echo testImage($data['Bild'], $path_img); ?>" />
                <p><?php echo $data['Bild'] ?></p>

                <form method="post" action="" enctype="multipart/form-data">
                    
                    <!--
                        Wenn man in HTML direkt vor einem Uploadfeld
                        Ein verstecktes Feld mit dem namen 'MAX_FILE_SIZE'
                        setzt, wird diese Angabe als maximale Dateigröße (byte) für den
                        Upload gewertet.
                    -->
                    <!--<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo SIZE_MAX_IMAGE; ?>" />-->
                    <input name="file" type="file">
                    
                    <button class="btn btn-info">Bild Ändern</button>

                </form>
                
            </div>

        </div>

    </body>
</html>