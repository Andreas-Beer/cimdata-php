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

include_once '../config.inc.php';

include_once PATH_FILE_LOGINVERIFY;
include_once PATH_FILE_DBCONNECT;
include_once PATH_FILE_FUNCTIONS;

/**
 * Hilfs-Funktionen
 */
function locationBack() {
  $back = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH_FILE_DASHBOARD;
  header('Location: ' . $back);
}

//Testen ob ein Fehler aufgetreten ist
function getError ($error) {

  switch ($error) {
    case UPLOAD_ERR_OK         : return false;
    case UPLOAD_ERR_INI_SIZE   : return MSG_IMAGEUPLOAD_ERR_TOBIG_INI;
    case UPLOAD_ERR_FORM_SIZE  : return MSG_IMAGEUPLOAD_ERR_TOBIG_FORM;
    case UPLOAD_ERR_PARTIAL    : return MSG_IMAGEUPLOAD_ERR_PARTIAL;
    case UPLOAD_ERR_NO_FILE    : return MSG_IMAGEUPLOAD_ERR_MISSING_FILE;
    case UPLOAD_ERR_CANT_WRITE : return MSG_IMAGEUPLOAD_ERR_RESTRICT_WRITE;
    case UPLOAD_ERR_EXTENSION  : return MSG_IMAGEUPLOAD_ERR_WRONG_EXTENSION;
    default                    : return MSG_IMAGEUPLOAD_ERR_OTHER;
  }
}

function checkFileSize ($fileSize) {

  if ($fileSize < SIZE_MAX_IMAGE) {
    return false;
  } else {

    echo $fileSize;

    return MSG_IMAGEUPLOAD_ERR_TOBIG_FORM;
  }
}

function checkFileType ($type, $types = ['jpeg', 'jpg', 'pjpeg']) {

  if (!$type) {
    return MSG_IMAGEUPLOAD_ERR_WRONG_EXTENSION;
  }

  for ($i = 0; $i < count($types); $i++) {
    if ($type === 'image/' . $types[$i]) {
      return false;
    }
  }

  return MSG_IMAGEUPLOAD_ERR_WRONG_EXTENSION . "($type)";
}


/*
 * Die Übergebene ID
 */
$id   = !empty($_GET['f']) ? $_GET['f'] : false;
$data = getDBData(sql_select_movieByMovieId($id));

// Wenn keine id oder eine flasche übergeben wurde
if(!$id || !$data) {
  locationBack();
}

// der datensatz liegt an erster Stele im Array
$data = $data[0];


/*
 * Bild Hochladen
 */

/*
 * Auswertung
 */

$uploaded_file = !empty($_FILES['uploaded_file']) ? $_FILES['uploaded_file'] : false;

// Das Fehlerarray anlegen
$msgErrors = array();

// Ist ein Fehler beim Upload aufgetreten
$msgErrors[] = getError($uploaded_file['error']);

// Ist die Datei größer als erlaubt.
$msgErrors[] = checkFileSize($uploaded_file['size']);

// Hat die Datei die richtige Endung?
$msgErrors[] = checkFileType($uploaded_file['type']);

$has_error = (Boolean)implode('', $msgErrors);

// Wenn bis hierher kein Fehler aufgetreten ist, das Bild speichern.
if ($uploaded_file !== false && !$has_error) {

  // 1. Den alten Pfad merken
  $name_old = $data['Bild'];
  $path_old = PATH_DIR_IMAGE . $name_old;

  // 2. Den Neuen Pfad erzeugen.
  $filmId   = $data['id'];
  $name_new = $filmId . '_' . $uploaded_file['name'];
  $path_new = PATH_DIR_IMAGE . $name_new;

  // 3. Den Temporären Pfad auslesen.
  $path_temp = $uploaded_file['tmp_name'];

  // Bild hochladen.
  move_uploaded_file($path_temp, $path_new);

  // Bild in der Datenbank eintragen.
  mysqli_query($conn, sql_update_filmImage($name_new, $filmId));

  // Das alte Bild löschen. (Wenn es auch ein altes gibt.)
  if ($name_old !== NULL) {
    unlink($path_old);
  }

  header('Location: ' . PATH_FILE_DASHBOARD);
}
?>


<!DOCTYPE html>
<html lang="de">
  <head>
    
    <meta charset="utf-8">
    <title><?php echo TEXT_IMAGEEDIT_GUI_HEADLINE ?> (<?php echo $data['Titel']?>)</title>
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_FILE_STYLE_MAIN;?>">  

  </head>
  <body>

    <?php include PATH_FILE_ADMINBAR; ?>

    <div class="film-form container">

      <div class="page-header">
        <h1><?php echo TEXT_IMAGEEDIT_GUI_HEADLINE ?><br/><small>(<?php echo $data['Titel']?>)</small></h1>
      </div>

      <?php
      if ($has_error) {
        echo implode(',', $msgErrors);
      }
      ?>

      <div class="well">

        <img class="img-responsive img-thumbnail" src="<?php echo testImage($data['Bild'], PATH_DIR_IMAGE);?>" />
        <p><?php echo $data['Bild']?></p>

        <form method="post" action="" enctype="multipart/form-data">

          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo SIZE_MAX_IMAGE;?>" />
          <input name="uploaded_file" type="file">

          <button class="btn btn-info">
            <?php echo TEXT_IMAGEEDIT_BUTTON_SAVE ?>
          </button>
          
          <a href="<?php echo PATH_FILE_DASHBOARD;?>" class="btn btn-warning pull-right">
            <?php echo TEXT_IMAGEEDIT_BUTTON_CANCEL ?>
          </a>

        </form>

      </div>

    </div>

  </body>
</html>