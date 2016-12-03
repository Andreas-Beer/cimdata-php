<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Template für ein filmgesellschafts navigations Button
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 22.11.2016
# Version: Basisversion für Schulungszwecke

include_once PATH_FILE_FUNCTIONS;
?>

<?php
$href  = $_SERVER['PHP_SELF'] . '?c=' . $data['id'];
$name  = $data['Name'];
$class = '';

if ($siteData['type'] === 'c') {
  $class = isActive($siteData['id'], $data['id']);
}
?>

<li class="<?php echo $class; ?>">
  <a href = "<?php echo $href; ?>"><?php echo $name; ?></a>
</li>