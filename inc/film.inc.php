<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Template für einen Filmtitel
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 19.09.2016
# Version: Basisversion für Schulungszwecke
?>
<?php

// Übername der Variablen zum weiteren Vararbeiten.
$title    = reorderTitle($data['Titel']);
$date     = mysqldate_to_german($data['Erscheinungsdatum']);
$duration = $data['DauerInMinuten'];
$genre    = $data['Genre'];
$company  = $data['Filmgesellschaft'];

?>

<article class="well well-lg film row">

    <div class="col-md-12">
        <h2>
            <?php echo $title ?><br />
            <small><?php echo $date; ?></small>
        </h2>
    </div>
    
    <div class="col-xs-4 col-lg-4  center-block text-center">
        <img class="thumbnail center-block img-responsive" src="bilder/default.jpg" alt="##ALT##" title="##TITLE##"/>
        <h3 class="text-center">Preis: 35,95 €</h3>
    </div>

    <div class="data col-xs-8 col-lg-8">
        <ul>
            <li><?php echo $duration; ?> min</li>
            <li><?php echo $genre; ?></li>
            <li><?php echo $company; ?></li>
        </ul>
        <p>
            ###Beschreibung...###
        </p>
    </div>

</article>