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

$id       = (int) $data['id'];
$title    = htmlspecialchars($data['Titel']);
$genre    = htmlspecialchars($data['Genre']);
$company  = htmlspecialchars($data['Filmgesellschaft']);
$preis    = decimalPoint_to_comma($data['Preis']);
$freigabe = $data['Freigabe'] === '1' ? 'JA' : 'NEIN';

$class_vis  = $freigabe === 'JA' ? 'true' : 'false';


/*
 * Den Button zum Bearbeiten des Bildes Beschriften.
 * Wenn es ein Bild gibt, anzeigen dass es bearbeitet werden kann.
 * Wenn es kein bild gint, anzeigen, dass ein Neues angelegt werden kann.
 */
$button_img = TEXT_DASHBOARD_BUTTON_IMAGE_EDIT;


if ($data['Bild'] === NULL || $data['Bild'] === '' || testImage($data['Bild']) === PATH_DIR_DEFAULT_IMAGE) {
  $button_img = TEXT_DASHBOARD_BUTTON_IMAGE_NEW;
}

?>
<tr>
  <td class="text-center">
    <a class="btn btn-sm btn-primary" href="<?php echo $link_filmEdit; ?>?f=<?php echo $id; ?>"><?php echo $button_edi; ?></a>
  </td>

  <td class="text-right"><?php echo $id; ?></td>
  <td><?php echo $title; ?></td>
  <td><?php echo $genre; ?></td>
  <td><?php echo $company; ?></td>
  <td class="price"><?php echo $preis; ?></td>

  <td class="text-center">
    <p class="vis <?php echo $class_vis; ?>"><?php echo $freigabe; ?></p>
  </td>

  <td class="text-center">
    <a class="btn btn-sm btn-success" href="<?php echo $link_image; ?>?f=<?php echo $id; ?>"><?php echo $button_img; ?></a>
  </td>

  <td class="text-center">
    <form action="<?php echo $link_delete; ?>?f=<?php echo $id; ?>" method="post">
      <button name="delete" value="<?php echo $id; ?>" class="btn btn-sm btn-danger"><?php echo $button_del; ?></button>
    </form>
  </td>

</tr>