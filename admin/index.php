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
include_once '../inc/dbconn.php';
include_once '../inc/functions.inc.php';
?>

<?php

$link = './filmfrom.php';

$handle_films_all = mysqli_query($conn, $sql_select_films('id'));

?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <title>Liste aller Filmtitel</title>
        <link rel="stylesheet" type="text/css" href="../css/main.css">  
    </head>
    <body>

        <?php
            $isLogedIn = TRUE;
            include './inc/adminbar.inc.php';
        ?>

        <div class="container film-list">

            <div class="page-header">
                <h1>Alle Filme</h1>
            </div>

            <h2><a class="btn btn-primary" href="<?php echo $link; ?>?f=neu">Film hinzufügen</a></h2>

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

                <?php
//                    <tr>
//                    <td>###ID###</td>
//                    <td>###TITEL###</td>
//                    <td>###GENRE###</td>
//                    <td>###FILM_GESELLSCHAFT###</td>
//                    <td class="price">###PREIS###</td>
//                    <td>###FREIGABE###</th>
//                    <td><a href="$link" class="btn btn-info">Bearbeiten</a></td>
//                    </tr>
                
                while (($data = mysqli_fetch_assoc($handle_films_all)) != NULL ) {

                    // Daten empangen und bearbeiten

                    $id       = $data['id'];
                    $title    = $data['Titel'];
                    $genre    = $data['Genre'];
                    $company  = $data['Filmgesellschaft'];
                    $preis    = decimalPoint_to_comma($data['Preis']);
                    $freigabe = $data['Freigabe'] === '1' ? 'JA' : 'NEIN';
                    
                    $class_vis = $freigabe === 'JA' ? 'true' : 'false';
                    
                    echo <<<HTML
                <tr>
                    <td>$id</td>
                    <td>$title</td>
                    <td>$genre</td>
                    <td>$company</td>
                    <td class="price">$preis</td>
                    <td class="vis $class_vis">$freigabe</th>
                    <td><a href="$link?f=$id" class="btn btn-info">Bearbeiten</a></td>
                </tr>                           
HTML;
                    
                }
                
                ?>
            </table>

        </div>
    </body>
</html>
