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
const PART_MOVIES_SELECT = "
    SELECT
        f.id,
        f.Titel,
        f.Beschreibung,
        f.DauerInMinuten,
        f.Erscheinungsdatum,
        f.Bild,
        f.Preis,
        f.Freigabe,
        f.Filmgesellschaft_id,
        f.Genre_id,
        fg.Name AS Filmgesellschaft,
        g.Name  AS Genre
    FROM film   AS f
    JOIN filmgesellschaft AS fg ON fg.id = f.Filmgesellschaft_id
    JOIN genre AS g ON g.id = f.Genre_id";


/*
 *  SQL - Queries
 */

// selects
$sql_select_films = function ($orderBy = 'Titel'){
    return "
    SELECT
        f.id,
        f.Titel,
        f.Beschreibung,
        f.Bild,
        f.Preis,
        f.Freigabe,
        fg.Name AS Filmgesellschaft,
        g.Name  AS Genre
    FROM film   AS f
    JOIN filmgesellschaft AS fg ON fg.id = f.Filmgesellschaft_id
    JOIN genre AS g ON g.id = f.Genre_id
    ORDER BY $orderBy;";
};

$sql_select_genres = "
    SELECT *
    FROM genre
    ORDER BY Name;";

$sql_select_companies = "
    SELECT *
    FROM filmgesellschaft
    ORDER BY Name;";

$sql_select_moviesByCompanyId = function ($companyId) {
    return PART_MOVIES_SELECT . "
        WHERE fg.id = $companyId AND f.Freigabe = 1
        ORDER BY f.Titel;";
};

$sql_select_moviesByGenreId = function ($genreId) {
    return PART_MOVIES_SELECT . "
        WHERE g.id = $genreId AND f.Freigabe = 1
        ORDER BY f.Titel;";
};

$sql_select_moviesBymovieId = function ($movieId) {
    return PART_MOVIES_SELECT . "
        WHERE f.id = $movieId
        ORDER BY f.Titel;";
};

$sql_select_moviesNew10 = PART_MOVIES_SELECT . "
    WHERE f.Freigabe = 1
    ORDER BY f.Erscheinungsdatum DESC
    LIMIT 10;";

$sql_select_genreByID = function ($genreId) {
    return "
        SELECT name
        FROM genre
        WHERE id = $genreId;";
};

$sql_select_companyByID = function ($companyId) {
    return "
        SELECT name
        FROM filmgesellschaft
        WHERE id = $companyId;";
};

// inserts
$sql_insert_newFilm = function (
        $genre_id,
        $filmgesellschaft_id,
        $titel,
        $erscheinugsdatum,
        $freigabe,
        
        $dauerInMinuten = '',
        $bild = '',
        $beschreibung = '',
        $preis = ''        
        ) {
    
    return "
      INSERT
      INTO film 
      (
        Genre_id,
        Filmgesellschaft_id,
        Titel,
        Erscheinungsdatum,
        DauerInMinuten,
        Bild,
        Beschreibung,
        Preis,
        Freigabe
      )
      VALUES
      (
        $genre_id,
        $filmgesellschaft_id,
        '$titel',
        '$erscheinugsdatum',
        $dauerInMinuten,
        '$bild',
        '$beschreibung',
        $preis,
        $freigabe
      );";
};