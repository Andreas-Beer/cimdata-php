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

include_once 'functions.inc.php';

// Daten abfragen 
$handle_genreAll = mysqli_query($conn, $sql_select_genres);
?>

<header>
  <div class="container">
    <h1>###SEITENTITEL###</h1><!-- TODO: Dynamisieren -->
  </div>

  <!-- ### Navigation Genre ### -->
  <nav class="navbar gradient">
      <div class="container">

          <ul class="nav navbar-nav nav-pills">

              <?php
              //<li class = "active"><a href = "#">###GENRE1###</a></li>
              
              while (($data = mysqli_fetch_assoc($handle_genreAll)) != NULL) {
                  
                  $href = $_SERVER['PHP_SELF'] . '?g=' . $data['id'];
                  
                  echo '<li class="' . isActive($data['id'], $curr_genreID) .  '">';
                  echo '<a href = "' . $href .'">' . $data['Name'] . '</a>';
                  echo '</li>';
                  
              }             
                      
              ?>

          </ul>  

      </div>
  </nav>
</header>

<?php
// Daten freigeben.
mysqli_free_result($handle_genreAll);
?>