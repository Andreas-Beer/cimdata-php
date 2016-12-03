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

$button_img = $data['Bild'] !== NULL ? TEXT_DASHBOARD_BUTTON_IMAGE_EDIT : TEXT_DASHBOARD_BUTTON_IMAGE_NEW;
$class_vis  = $freigabe === 'JA' ? 'true' : 'false';
?>
<tr>
  <td class="text-center"><a class="btn btn-sm btn-info" href="<?php echo $link_filmEdit; ?>?f=$id"><?php echo $button_edi; ?></a></td>
  <td class="text-right"><?php echo $id; ?></td>
  <td><?php echo $title; ?></td>
  <td><?php echo $genre; ?></td>
  <td><?php echo $company; ?></td>
  <td class="price"><?php echo $preis; ?></td>
  <td class="text-center"><p class="vis <?php echo $class_vis; ?>"><?php echo $freigabe; ?></p></th>
<td class="text-center"><a class="btn btn-sm btn-success" href="<?php echo $link_image; ?>?f=$id"><?php echo $button_img; ?></a></td>
<td class="text-center">
  <form action="<?php echo $link_delete; ?>?f=$id" method="post">
    <button name="delete" value="<?php echo $id; ?>" class="btn btn-sm btn-danger"><?php echo $button_del; ?></button>
  </form>
</td>
</tr>