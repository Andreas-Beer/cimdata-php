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
$image    = testImage($data['Bild']);
$price    = decimalPoint_to_comma($data['Preis']) . ' €';
$duration = $data['DauerInMinuten'];
$genre    = $data['Genre'];
$company  = $data['Filmgesellschaft'];
$desc     = $data['Beschreibung'];
?>

<article class="well well-lg film row">
    
    <div class="col-md-12">
        <h2>
            <?php echo $title ?>
            <br />
            <small><?php echo $date; ?></small>
        </h2>
    </div>
    
    <div class="col-xs-4 col-lg-4  center-block text-center">
        <img class="img-rounded img-responsive center-block" src="<?php echo $image ?>" alt="<?php echo $title ?> (Filmplakat)" title="<?php echo $title ?>"/>
        <h3 class="text-center">Preis: <?php echo $price; ?></h3>
    </div>

    <div class="data col-xs-8 col-lg-8">
        <ul>
            <li><?php echo $duration; ?> min</li>
            <li><?php echo $genre; ?></li>
            <li><?php echo $company; ?></li>
        </ul>
        
        <p><?php echo $desc; ?></p>
        
    </div>

</article>