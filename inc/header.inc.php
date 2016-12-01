<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Template für den Header
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 19.09.2016
# Version: Basisversion für Schulungszwecke
?>

<?php
include_once PATH_FILE_FUNCTIONS;

// Daten abfragen 
$handle_genreAll = mysqli_query($conn, $sql_select_genres);
?>

<header>
    <div class="container">
        <h1><?php echo $title; ?></h1>
    </div>

    <!-- ### Navigation Genre ### -->
    <nav class="navbar navbar gradient">
        <div class="container">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#genres" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <div id="genres" class="collapse navbar-collapse">
                <ul class="genres nav navbar-nav">

                    <?php
                    //<li class = "active"><a href = "#">###GENRE1###</a></li>

                    while (($data = mysqli_fetch_assoc($handle_genreAll)) != NULL) {

                        $href = $_SERVER['PHP_SELF'] . '?g=' . $data['id'];

                        echo '<li class="' . isActive($data['id'], $curr_genreID) . '">';
                        echo '<a href = "' . $href . '">' . $data['Name'] . '</a>';
                        echo '</li>';
                    }
                    ?>

                </ul>  
            </div>

        </div>
    </nav>
</header>

<?php
// Daten freigeben.
mysqli_free_result($handle_genreAll);
?>