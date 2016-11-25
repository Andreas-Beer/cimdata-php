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
        $bild           = '',
        $beschreibung   = '',
        $preis          = ''        
        ) {
    
    global $conn;

    // Der Anfang des SQL-Strings
    $sql = "INSERT INTO film ( Genre_id, Filmgesellschaft_id, Erscheinungsdatum, Freigabe, Titel";
    
    /*
     * Dynamisch die Abfrage zusammensetzen.
     * (Die Spalten auflisten)
     */
    if(!empty($dauerInMinuten)) { $sql .= ', DauerInMinuten'; } //wenn dauerInMinuten gesetzt wurde
    if(!empty($bild))           { $sql .= ', Bild';           } //wenn Bild gesetzt wurde
    if(!empty($beschreibung))   { $sql .= ', Beschreibung';   } //wenn Beschreibung gesetzt wurde
    if(!empty($preis))          { $sql .= ', Preis';          } //wenn Preis gesetzt wurde

    // Der Mittelteil des SQL-Strings
    $sql .= " ) VALUES ( $genre_id, $filmgesellschaft_id, '$erscheinugsdatum', $freigabe,";
    
    // Der Titel mit entschärften Sonderzeichen.
    $sql .= "'" . mysqli_real_escape_string($conn, $titel) . "'";
            
    /*
     * Dynamisch die Abfrage zusammensetzen.
     * (Die Werte auflisten)
     */
    if(!empty($dauerInMinuten)) { $sql .= ", $dauerInMinuten"; } //wenn dauerInMinuten gesetzt wurde
    if(!empty($preis))          { $sql .= ", $preis";          } //wenn Preis gesetzt wurde
    
    if(!empty($bild))           { $sql .= ", '" . mysqli_real_escape_string($conn, $bild)          . "'"; } //wenn Bild gesetzt wurde
    if(!empty($beschreibung))   { $sql .= ", '" . mysqli_real_escape_string($conn, $beschreibung)  . "'"; } //wenn Beschreibung gesetzt wurde
    
    // Der Schlussteil des SQL-Strings.
    $sql .= ");";
            
    return $sql;
};

// updates
$sql_update_film = function (
        $film_id,
        $genre_id,
        $filmgesellschaft_id,
        $titel,
        $erscheinugsdatum,
        $freigabe,
        
        $dauerInMinuten = '',
        $bild           = '',
        $beschreibung   = '',
        $preis          = ''
        ) {
    
        global $conn;

    // Die Strings Für die Datenbank vorbereiten.
    $titel          = mysqli_real_escape_string($conn, $titel);
    
    $bild           = !empty($bild)           ? "'" . mysqli_real_escape_string($conn, $bild)         . "'" : 'NULL';
    $beschreibung   = !empty($beschreibung)   ? "'" . mysqli_real_escape_string($conn, $beschreibung) . "'" : 'NULL';
    
    $dauerInMinuten = !empty($dauerInMinuten) ? $dauerInMinuten   : 'NULL';
    $preis          = !empty($preis)          ? $preis            : 'NULL';

        
    return "
        UPDATE film
        SET 
            Genre_id = $genre_id,
            Filmgesellschaft_id = $filmgesellschaft_id,
            Titel = '$titel',
            Erscheinungsdatum = '$erscheinugsdatum',
            DauerInMinuten = $dauerInMinuten,
            Bild = $bild,
            Beschreibung = $beschreibung,
            Preis = $preis,
            Freigabe = $freigabe
        WHERE id = $film_id;";
};

$sql_update_filmImage = function ($image_name, $id) {
  
    return "
        UPDATE film
        SET Bild = '$image_name'
        WHERE id = $id;
        ";
    
};

// Deletes
$sql_delete_filmById = function ($filmId) {
  
    return "
        DELETE
        FROM film
        WHERE id = $filmId;";
};
