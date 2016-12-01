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

<?php
include_once '../config.inc.php';

include_once PATH_FILE_DBCONNECT;
include_once PATH_FILE_FUNCTIONS;
include_once PATH_FILE_LOGINVERIFY;
?>

<?php
$link_delete   = PATH_FILE_FILMDELETE;
$link_filmEdit = PATH_FILE_FILMEDIT;
$link_image    = PATH_FILE_FILMIMAGE;

$handle_films_all = mysqli_query($conn, $sql_select_films('id'));
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Liste aller Filmtitel</title>
        <link rel="stylesheet" type="text/css" href="<?php echo PATH_FILE_STYLE_MAIN; ?>">  
    </head>
    <body>

        <?php include PATH_FILE_ADMINBAR; ?>

        <div class="container film-list">

            <div class="page-header">
                <h1><?php echo TEXT_DASHBOARD_GUI_HEADLINE; ?></h1>
            </div>

            <h2><a class="btn btn-primary" href="<?php echo $link_filmEdit; ?>?f=neu"><?php echo TEXT_DASHBOARD_BUTTON_FILM_NEW; ?></a></h2>

            <table class="table table-condensed table-striped table-responsive">
                <tr>
                    <th></th>
                    <th>#</th>
                    <th><?php echo TEXT_DASHBOARD_GUI_THEAD_TITLE; ?></th>
                    <th><?php echo TEXT_DASHBOARD_GUI_THEAD_GENRE; ?></th>
                    <th><?php echo TEXT_DASHBOARD_GUI_THEAD_COMPANY; ?></th>
                    <th><?php echo TEXT_DASHBOARD_GUI_THEAD_PRICE; ?></th>
                    <th><?php echo TEXT_DASHBOARD_GUI_THEAD_VISIBLE; ?></th>
                    <th><?php echo TEXT_DASHBOARD_GUI_THEAD_IMAGE; ?></th>
                    <th></th>
                </tr>  

                <?php

                while (($data = mysqli_fetch_assoc($handle_films_all)) != NULL) {

                  // Daten empangen und bearbeiten

                  $id       = $data['id'];
                  $title    = $data['Titel'];
                  $genre    = $data['Genre'];
                  $company  = $data['Filmgesellschaft'];
                  $preis    = decimalPoint_to_comma($data['Preis']);
                  $freigabe = $data['Freigabe'] === '1' ? 'JA' : 'NEIN';

                  $btn_edi = TEXT_DASHBOARD_BUTTON_FILM_EDIT;
                  $btn_img = $data['Bild'] !== NULL ? TEXT_DASHBOARD_BUTTON_IMAGE_EDIT : TEXT_DASHBOARD_BUTTON_IMAGE_NEW;
                  $btn_del = TEXT_DASHBOARD_BUTTON_DELETE_FILM;

                  $class_vis = $freigabe === 'JA' ? 'true' : 'false';

                  echo <<<HTML
                <tr>
                    <td class="text-center"><a class="btn btn-sm btn-info" href="$link_filmEdit?f=$id">$btn_edi</a></td>
                    <td class="text-right">$id</td>
                    <td>$title</td>
                    <td>$genre</td>
                    <td>$company</td>
                    <td class="price">$preis</td>
                    <td class="text-center"><p class="vis $class_vis">$freigabe</p></th>
                    <td class="text-center"><a class="btn btn-sm btn-success" href="$link_image?f=$id">$btn_img</a></td>
                    <td class="text-center">
                        <form action="$link_delete?f=$id" method="post">
                            <button name="delete" value="$id" class="btn btn-sm btn-danger">$btn_del</button>
                        </form>
                    </td>
                </tr>                           
HTML;
                }
                ?>
            </table>

        </div>
    </body>
</html>
