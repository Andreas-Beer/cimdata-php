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
include_once '../config.inc.php';

include_once PATH_FILE_DBCONNECT;
include_once PATH_FILE_FUNCTIONS;
include_once PATH_FILE_LOGINVERIFY;
?>

<?php

function getPostValue($name, $default = '') {
  return !empty($_POST[$name]) ? $_POST[$name] : $default;
}

/**
 * Gibt die Fehlermeldung zurück wenn, es für das Element eine gibt.
 * 
 * @global Array    $msgErrors  Das Array mit allen aufgetretenen Fehlern
 * @param String    $name       Der SChlüssel für das aktuelle Feld
 * @param Boolean   $glyphicon  Ob ein X angezeigt werden soll
 * @param String    $default    Der Default wert, der bei keinem Fehler ausgegeben wird
 * @return string               Der Fertige HTML Block, der die Fehlermeldung und das glyphicon beinhaltet
 */
function getError($name, $glyphicon = true, $default = '') {

  global $msgErrors;
  $msg = $default;

  if (isset($msgErrors[$name])) {

    if ($glyphicon === true) {
      $msg .= '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
    }
    $msg .= '<p class="validation_msg help-block">' . $msgErrors[$name] . '</p>';
  }

  return $msg;
}

// Die Variablen mit defaultwert
$msg_btn  = TEXT_FILMEDIT_BUTTON_SAVE;
$headline = TEXT_FILMEDIT_GUI_HEADLINE_NEW;

$id         = is_numeric($_GET['f']) ? $_GET['f'] : false;
$company_id = getPostValue('fc');
$genre_id   = getPostValue('fg');
$title      = getPostValue('ft');
$desc       = getPostValue('dc');
$date       = getPostValue('dt');
$duration   = getPostValue('du');
$price      = getPostValue('pr');
$image      = getPostValue('img');
$film_id    = getPostValue('fid');

$visible = getPostValue('vi', '0');

if ($id) {

  $handler_film = mysqli_query($conn, sql_select_movieByMovieId($id));
  $data = mysqli_fetch_assoc($handler_film);

  $company_id = $data['Filmgesellschaft_id'];
  $genre_id   = $data['Genre_id'];
  $title      = $data['Titel'];
  $desc       = $data['Beschreibung'];
  $date       = $data['Erscheinungsdatum'];
  $duration   = $data['DauerInMinuten'];
  $price      = $data['Preis'];
  $image      = $data['Bild'];
  $visible    = $data['Freigabe'];

  $headline   = sprintf(TEXT_FILMEDIT_GUI_HEADLINE_UPDATE, $title);
  $msg_btn    = TEXT_FILMEDIT_BUTTON_UPDATE;
}

$msgErrors = array();

// Wenn das formular einmal abgeschickt wurde.
if (!empty($_POST['button'])) {

  /*
   * Schauen ob die Pflichtfelder Belegt sind.
   */

  // Falsche (keine) Filmgesellschaft
  if (empty($company_id)) {
    $msgErrors['fc'] = MSG_FILMFORM_ERR_MISSING_COMPANY;
  }

  // Falsches (keins) Genre
  if (empty($genre_id)) {
    $msgErrors['fg'] = MSG_FILMFORM_ERR_MISSING_GENRE;
  }

  // Falscher Titel
  if (empty($title)) {
    $msgErrors['ft'] = MSG_FILMFORM_ERR_MISSING_TITLE;
  }

  // Falsches Datum
  if (empty($date)) {
    $msgErrors['dt'] = MSG_FILMFORM_ERR_MISSING_DATE;
  } elseif (date_parse(Date($date))['error_count'] > 0) {
    $msgErrors['dt'] = MSG_FILMFORM_ERR_WRONG_DATE;
  }
}

// Wenn es keine Fehler gab. und die Seite einmal abgeschickt wurde.
if (empty($msgErrors) && !isset($_GET['f'])) {

  $sql = false;

  /*
   *  Weiche, wie das Formular verarbeitet werden soll.
   */

  // Update (wenn eine FilmID mit übertragen wurde)
  if (!empty($film_id)) {

    $date = formatDateToMySql($date);

    $sql = sql_update_film($film_id, $genre_id, $company_id, $title, $date, $visible, $duration, $image, $desc, $price);
  }

  // Speichern (wenn KEINE FilmID mit übertragen wurde)
  else {

    $date = formatDateToMySql($date);

    $sql = sql_insert_newFilm(
        $genre_id, $company_id, $title, $date, $visible, $duration, $image, $desc, $price);
  }

  /*
   * wenn es eine sql-Anweisung gibt
   * (wenn das formular ohne Fehler abgeschickt wurde.)
   */
  if ($sql !== false) {

    echo $sql . "<hr/>";

    // Die Daten senden.
    if (mysqli_query($conn, $sql)) {
      header('Location: ' . PATH_FILE_DASHBOARD);
    } else {
      echo 'Der Film wurde NICHT gespeichert!';
    }
  }
}

// Daten um dei Seiten darzustellen
$genres    = getDBData(sql_select_genres());
$companies = getDBData(sql_select_companies());
?>

<!DOCTYPE html>
<html lang="de">
  <head>

    <meta charset="utf-8">
    <title><?php echo $headline; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo PATH_FILE_STYLE_MAIN; ?>">  

  </head>
  <body>

    <?php include PATH_FILE_ADMINBAR; ?>

    <div class="film-form container">

      <div class="page-header">
        <h1><?php echo $headline; ?></h1>
      </div>

      <div>

        <p class="fehler"><?php // if ($meldung) echo implode($meldung, "<br>");                ?></p>

        <form method="post" class="well" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

          <!-- Filmgesellschaften -->
          <section class="section_select form-group">

            <div class="form-group has-feedback <?php
            if (isset($msgErrors['fc'])) {
              echo 'has-error';
            }
            ?>">
              <label class="form_label" for="fc"><?php echo TEXT_FILMEDIT_GUI_COMPANIES; ?></label>
              <select class="form_input_select form-control" name="fc" id="fc">
                <option class="form_option" value="0"><?php echo TEXT_FILMEDIT_GUI_DROPDOWN_DEFAULT; ?></option>
                <?php
                
                foreach ($companies as $data) {
                  $checked = isActive($data['id'], $company_id, 'selected');
                  echo '<option ' . $checked . ' class="form_option" value="' . $data['id'] . '">';
                  echo $data['Name'];
                  echo '</option>';
                }

                ?>
              </select>
              <?php echo getError('fc', false) ?>
            </div>

            <!-- Genres -->
            <div class="form-group has-feedback <?php if (isset($msgErrors['fg'])) { echo 'has-error'; } ?>">
              <label class="form_label" for="fg"><?php echo TEXT_FILMEDIT_GUI_GENRES; ?></label>
              <select class="form_input_select form-control" name="fg" id="fg">
                <option class="form_option" value="0"><?php echo TEXT_FILMEDIT_GUI_DROPDOWN_DEFAULT; ?></option>
                <?php
                
                foreach ($genres as $data) {
                  $checked = isActive($data['id'], $genre_id, 'selected');
                  echo '<option ' . $checked . ' class="form_option" value="' . $data['id'] . '">';
                  echo $data['Name'];
                  echo '</option>';
                }
                
                ?>  
              </select>
              <?php echo getError('fg', false); ?>
            </div>

            <!-- Filmtitel -->
            <div class="form-group has-feedback <?php
            if (isset($msgErrors['ft'])) { echo 'has-error'; } ?>">
              <label class="form_label" for="titel"><?php echo TEXT_FILMEDIT_GUI_TITLE; ?></label>
              <input class="form_input form-control" type="text" name="ft" id="titel" maxlength="150" value="<?php echo $title; ?>">
              <?php echo getError('ft'); ?>
            </div>

            <!-- Beschreibung -->
            <div class="form-group">
              <label class="form_label" for="beschreibung"><?php echo TEXT_FILMEDIT_GUI_DESCRIPTION; ?></label>
              <textarea style="resize: vertical" class="form_text form-control" rows="3" name="dc" id="beschreibung"><?php echo $desc; ?></textarea>
            </div>

            <!-- Erscheinungsdatum -->
            <div class="form-group has-feedback <?php
            if (isset($msgErrors['dt'])) { echo 'has-error'; } ?>">
              
              <label class="form_label" for="datum"><?php echo TEXT_FILMEDIT_GUI_DATE; ?></label>
              <div class="input-group">
                <div class="input-group-addon"><?php echo TEXT_FILMEDIT_ICON_DATE ?></div>
                <input class="form_input form-control" type="date" name="dt" id="datum" maxlength="10" value="<?php echo $date; ?>">
              </div>
              
              <?php echo getError('dt'); ?>
              
            </div>

            <!-- Dauer in Minuten -->
            <div class="form-group">
              <label class="form_label" for="dauer"><?php echo TEXT_FILMEDIT_GUI_DURATION; ?></label>
              <div class="input-group">
                <div class="input-group-addon"><?php echo TEXT_FIMLEDIT_ICON_DURATION; ?></div>
                <input class="form_input form-control" type="number"  min="1" max="9999" step="0.1" name="du" id="dauer" maxlength="3" value="<?php echo $duration; ?>">
                <div class="input-group-addon">min</div>
              </div>
            </div>

            <!-- Preis -->
            <div class="form-group">
              <label class="form_label" for="preis"><?php echo TEXT_FILMEDIT_GUI_PRICE; ?></label>
              <div class="input-group">
                <div class="input-group-addon"><?php echo TEXT_FILMEDIT_ICON_CURRENCY; ?></div>
                <input class="form_input form-control" type="number" min="0" max="100" step="0.01" pattern="[0-9]+([\,|\.][0-9]+)?" name="pr" id="preis" maxlength="10" value="<?php echo $price; ?>">
              </div>
            </div>

            <!-- Bild -->
            <div class="form-group">
              <label class="form_label" for="img"><?php echo TEXT_FILMEDIT_GUI_IMAGE; ?></label>
              <div class="input-group">
                <div class="input-group-addon">
                  <?php echo TEXT_FILMEDIT_ICON_IMAGE ?>
                </div>
                <input class="form_input form-control" type="text" name="img" id="bild" maxlength="150" value="<?php echo $image; ?>">
              </div>
            </div>

            <!-- Freigegeben -->
            <div class="form-group">
              <input class="form_checkbox" type="checkbox" name="vi" id="freigabe" value="1" <?php echo $visible ? 'checked' : '' ?>>
              <label class="form_label_checkbox" for="freigabe"><?php echo TEXT_FILMEDIT_GUI_VISIBILITY; ?></label>
            </div>

            <!-- versteckte Felder für ID -->
            <input type="hidden" name="fid" value="<?php echo!empty($film_id) ? $film_id : $id; ?>">
          </section>


          <section id="section_submit">
            <button class="btn btn-default" type="submit" name="button" value="speichern"><?php echo $msg_btn ?></button>
            <a class="btn btn-default pull-right" href="<?php echo PATH_FILE_DASHBOARD; ?>"><?php echo TEXT_FILMEDIT_BUTTON_CANCEL; ?></a>
          </section>

        </form>

      </div>

    </div>

  </body>
</html>