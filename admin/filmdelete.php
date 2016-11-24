<?php
include_once '../inc/dbconn.php';
?>

<?php

// Die ID annehmen
// Wenn die ID gesetzt und eine Nummer ist.
$id = !empty($_POST['delete']) && is_numeric($_POST['delete']) ? $_POST['delete'] : false;

// schauen, ob eine ID übergeben wurde
if ($id) {  
    
    // Den angegebenen Film löschen (unwiederrufbar!)
    mysqli_query($conn, $sql_delete_filmById($_POST['delete']));
}

// zurück auf die letzte Seite / oder die index seite.
$back = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : './index.php';
header('Location: ' . $back);