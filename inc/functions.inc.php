<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Sammlung nützlicher allgemeiner Funktionen
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 19.09.2016
# Version: Basisversion für Schulungszwecke
?>

<?php

function reorderTitle ($title) {
  $split = explode(', ',$title);
  return $split[1] . ' ' . $split[0];
}

function mysqldate_to_german ($mysqldate) {
  return strftime("%d.%m.%Y", strtotime($mysqldate));
}

function testImage($image, $dir = 'bilder/', $default = 'default2.jpg') {
  $image   = $dir . $image;
  $default = $dir . $default;
  
  if (is_file($image) && getimagesize($image)) {
    return $image;
  } else {
    return $default;
  }
}

function isActive ($p1, $p2, $class = 'active') {
    if ($p1 == $p2) {
        return $class;
    } else {
        return '';
   }
};

function decimalPoint_to_comma ($str) {
    return str_replace('.', ',', $str);
}