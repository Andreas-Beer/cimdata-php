<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Verbindung zum MySQL-System herstellen und Datenbank auswählen
#
# Autor: Michael Hassel
# Email: hassel@mediakontur.de
# Stand: 03.12.2013
# Version: Basisversion
# für Schulungszwecke
?>

<?php
# PHP-Warnungen und Fehler ausblenden
//error_reporting(0);
# PHP-Notizen ausblenden
error_reporting( E_ALL ^ E_NOTICE );

######## Datenbankverbindung herstellen ########

// Angaben zur Datenbankverbindung
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "cimdata2016";
const DB_BASE = "filmwebsite";

// Verbindung zum Datenbankserver herstellen
// was nach or die steht, wird allein ausgegeben, falls davor ein Fehler auftritt.
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE) or die("<h1>Verbindungsfehler</h1>");

mysqli_set_charset( $conn, "utf8" );

// Pfade

// SQL - Parts
const PART_MOVIE_SELECT = "
    SELECT
        f.id,
        f.Titel,
        f.Beschreibung,
        f.DauerInMinuten,
        f.Erscheinungsdatum,
        f.Bild,
        f.Preis,
        fg.Name AS Filmgesellschaft,
        g.Name AS Genre
    FROM film AS f
    JOIN filmgesellschaft AS fg ON fg.id = f.Filmgesellschaft_id
    JOIN genre AS g ON g.id = f.Genre_id";


// SQL - Queries
$sql_select_genres = "
    SELECT *
    FROM genre
    ORDER BY Name;";

$sql_select_companies = "
    SELECT *
    FROM filmgesellschaft
    ORDER BY Name;";

$sql_select_movieByCompanyId = function ($companyId) {
    
    return PART_MOVIE_SELECT . "
        WHERE fg.id = $companyId AND f.Freigabe = 1
        ORDER BY f.Titel;";
};

$sql_select_movieByGenreId = function ($genreId) {
    
    return PART_MOVIE_SELECT . "
        WHERE g.id = $genreId AND f.Freigabe = 1
        ORDER BY f.Titel;";
};