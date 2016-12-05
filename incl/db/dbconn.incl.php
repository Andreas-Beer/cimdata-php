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
// Angaben zur Datenbankverbindung
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_BASE = "filmwebsite";

function getDBData ($query) {
  
  // Datenbank Verbindungsversuch
  if (!$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_BASE)) {
    die("Verbindungsfehler");
  }
  
  // Den Zeichensatz umstellen
  mysqli_set_charset( $conn, "utf8" );
  
  // Datenbank Abfrageversuch
  if (!$result = mysqli_query($conn, $query)) {
    die("Abfragefehler");
  }
  
  // Versuch 
  if(!$data = mysqli_fetch_all($result, MYSQLI_ASSOC)) {
    return False;
  }
   
  return $data;
}

/*
 * Vorbereitete SQL-Abfragen.
 */

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


// selects
function sql_select_films ($orderBy = 'Titel'){
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
}

function sql_select_genres () {
  return "
    SELECT *
    FROM genre
    ORDER BY Name;";
}

function sql_select_companies () {
  return "
    SELECT *
    FROM filmgesellschaft
    ORDER BY Name;";
}

function sql_select_moviesByCompanyId ($companyId) {
    return PART_MOVIES_SELECT . "
        WHERE fg.id = $companyId AND f.Freigabe = 1
        ORDER BY f.Titel;";
}

function sql_select_moviesByGenreId ($genreId) {
    return PART_MOVIES_SELECT . "
        WHERE g.id = $genreId AND f.Freigabe = 1
        ORDER BY f.Titel;";
}

function sql_select_movieByMovieId ($movieId) {
    return PART_MOVIES_SELECT . "
        WHERE f.id = $movieId
        ORDER BY f.Titel;";
}

function sql_select_moviesNew10 () {
  return PART_MOVIES_SELECT . "
    WHERE f.Freigabe = 1
    ORDER BY f.Erscheinungsdatum DESC
    LIMIT 10;";
}

function sql_select_genreByID ($genreId) {
    return "
      SELECT name
        FROM genre
        WHERE id = $genreId;";
}

function sql_select_companyByID ($companyId) {
    return "
        SELECT name
        FROM filmgesellschaft
        WHERE id = $companyId;";
}

// inserts
function sql_insert_newFilm (
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
}

// updates
function sql_update_film (
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
}

function sql_update_filmImage ($image_name, $id) {
  
    return "
        UPDATE film
        SET Bild = '$image_name'
        WHERE id = $id;
        ";
    
}

// Deletes
function sql_delete_filmById ($filmId) {
  
    return "
        DELETE
        FROM film
        WHERE id = $filmId;";
}
