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

<!DOCTYPE html>
<html lang="de">
  <head>

    <meta charset="utf-8">
    <title>Filmtitel bearbeiten</title>
    <link rel="stylesheet" type="text/css" href="../css/main.css">  

  </head>
  <body>

    <?php include './inc/adminbar.inc.php'; ?>

    <div class="film-form container">

      <div class="page-header">
        <h1>Filmtitel bearbeiten</h1>
      </div>

      <div>

        <p class="fehler"><?php // if ($meldung) echo implode($meldung, "<br>");      ?></p>

        <form method="post" class="well" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

          <!-- alle Filmgesellschaften -->
          <section class="section_select form-group">

            <div class="form-group">
              <label class="form_label" for="fc">Filmgesellschaften *</label>
              <select class="form_input_select form-control" name="fc" id="fc">
                <option class="form_option" value="0">Bitte auswählen</option>

                <option class="form_option">###FILMGESELLSCHAFT###</option>

              </select>
            </div>

            <!-- alle Genres -->

            <div class="form-group">
              <label class="form_label" for="fg">Genres *</label>
              <select class="form_input_select form-control" name="fg" id="fg">
                <option class="form_option" value="0">Bitte auswählen</option>

                <option class="form_option">###GENRE###</option>

              </select>
            </div>

            <div class="form-group">
              <label class="form_label" for="titel">Filmtitel *</label>
              <input class="form_input form-control" type="text" name="ft" id="titel" maxlength="150" value="###TITEL###">
            </div>

            <div class="form-group">
              <label class="form_label" for="beschreibung">Beschreibung</label>
              <textarea style="resize: vertical" class="form_text form-control" rows="3" name="dc" id="beschreibung">###BESCHREIBUNG###</textarea>
            </div>

            <div class="form-group">
              <label class="form_label" for="datum">Erscheinungsdatum *</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div>
                <input class="form_input form-control" type="date" name="dt" id="datum" maxlength="10" value="###DATUM###">
              </div>
            </div>

            <div class="form-group">
              <label class="form_label" for="dauer">Dauer in Minuten</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="fa fa-clock-o" aria-hidden="true"></span></div>
                <input class="form_input form-control" type="number"  min="1" max="9999" step="0.1" name="du" id="dauer" maxlength="3" value="###DAUER###">
                <div class="input-group-addon">min</div>
              </div>
            </div>

            <div class="form-group">
              <label class="form_label" for="preis">Preis</label>
              <div class="input-group">
                <div class="input-group-addon">€</div>
                <input class="form_input form-control" type="number" min="0" max="100" step="0.10" pattern="[0-9]+([\,|\.][0-9]+)?" name="pr" id="preis" maxlength="10" value="###PREIS###">
              </div>
            </div>

            <div class="form-group">
              <label class="form_label" for="bild">Bild</label>
              <div class="input-group">
                <div class="input-group-addon"><span class="fa fa-file-image-o" aria-hidden="true"></span></div>
                <input class="form_input form-control" type="text" name="bild" id="bild" maxlength="150" value="###BILD###">
              </div>
            </div>

            <div class="form-group">
              <input class="form_checkbox" type="checkbox" name="vi" id="freigabe" value="1">
              <label class="form_label_checkbox" for="freigabe">Freigabe</label>
            </div>

            <!-- versteckte Felder für ID -->
            <input type="hidden" name="fid" value="###ID###">
          </section>


          <section id="section_submit">

            <button class="btn btn-default" type="submit" name="button" value="speichern">###BUTTON_TEXT###</button>
            <button class="btn btn-default pull-right" type="button" name="button" value="abbrechen" onClick="window.location.href = 'index.php';">Abbrechen</button>

          </section>

        </form>

      </div>

    </div>

  </body>
</html>