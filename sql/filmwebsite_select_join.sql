# Alle Filmgesellschaften
SELECT * FROM filmgesellschaft ORDER BY Name;

# Alle Genres
SELECT * FROM genre ORDER BY Name;

# Alle Filme zu einer Filmgesellschaft(z.B. Warner)
SELECT f.id, f.Titel, f.Beschreibung, f.DauerInMinuten, f.Erscheinungsdatum, f.Bild, f.Preis, f.Freigabe, fg.Name Filmgesellschaft, g.Name Genre
FROM film AS f
JOIN filmgesellschaft AS fg ON fg.id = f.Filmgesellschaft_id
JOIN genre AS g ON g.id = f.Genre_id
WHERE fg.id = 8 AND f.Freigabe = 1
ORDER BY f.Titel;

# Alle Filme zu einem Genre(z.B. Action)
SELECT f.id, f.Titel, f.Beschreibung, f.DauerInMinuten, f.Erscheinungsdatum, f.Bild, f.Preis, f.Freigabe, fg.Name Filmgesellschaft, g.Name Genre
FROM film AS f
JOIN filmgesellschaft AS fg ON fg.id = f.Filmgesellschaft_id
JOIN genre AS g ON g.id = f.Genre_id
WHERE g.id = 2 AND f.Freigabe = 1
ORDER BY f.Titel;

# Die 10 neuesten Filme (Startseite)
SELECT f.id, f.Titel, f.Beschreibung, f.DauerInMinuten, f.Erscheinungsdatum, f.Bild, f.Preis, f.Freigabe, fg.Name Filmgesellschaft, g.Name Genre
FROM film AS f
JOIN filmgesellschaft AS fg ON fg.id = f.Filmgesellschaft_id
JOIN genre AS g ON g.id = f.Genre_id
WHERE f.Freigabe = 1
ORDER BY f.Erscheinungsdatum DESC
LIMIT 10;

# Alle Filmtitel nach Suchwort in Titel und Beschreibung
SELECT f.id, f.Titel, f.Beschreibung, f.DauerInMinuten, f.Erscheinungsdatum, f.Bild, f.Preis, f.Freigabe, fg.Name Filmgesellschaft, g.Name Genre
FROM film AS f
JOIN filmgesellschaft AS fg ON fg.id = f.Filmgesellschaft_id
JOIN genre AS g ON g.id = f.Genre_id
WHERE (f.Titel LIKE '%lord%' OR f.Beschreibung LIKE '%lord%') AND f.Freigabe = 1
ORDER BY f.Erscheinungsdatum DESC
LIMIT 10;

# Einen bestimmten Filmtitel holen
SELECT * FROM film WHERE id = 3;

# Einen Filmtitel anlegen
INSERT INTO film
(Genre_id, Filmgesellschaft_id, Titel, Erscheinungsdatum, DauerInMinuten, Bild, Beschreibung, Preis, Freigabe)
VALUES
(1, 1, 'Testtitel', '2007-12-04', 111, 'bild.jpg', 'Testbeschreibung', 99.99, 1);

# Einen Filmtitel verändern
UPDATE film SET Genre_id = 2, Filmgesellschaft_id = 2, Titel = 'Testtitel2', Erscheinungsdatum = '2008-12-04', DauerInMinuten = 222, Bild = 'bild2.jpg', Beschreibung = 'Testbeschreibung2', Preis = 88.88, Freigabe = 1
WHERE id = 19;

# Bild eines Filmtitel ändern
UPDATE film SET Bild = 'test.jpg' WHERE id = 19;
 
# einen zufälligen Titel
SELECT Titel
FROM film 
ORDER BY RAND()
LIMIT 1;