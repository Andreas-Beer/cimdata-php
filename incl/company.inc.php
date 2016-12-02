<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Template für die filmgesellschafts navigation
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 22.11.2016
# Version: Basisversion für Schulungszwecke
?>

<?php
include_once PATH_FILE_FUNCTIONS;
?>

<nav>

  <!-- Suche -->
  <form class="navbar-form" role="search">
    <div class="form-group">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="<?php echo TEXT_MAIN_GUI_SEARCH_PLACEHOLDER;?>">
        <span class="input-group-btn">
          <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
        </span>
      </div>
    </div>
  </form>

  <!-- Navigation -->
  <ul class="nav nav-pills nav-stacked">

    <?php
//        <li class = "active"><a href = "#">###FILMGESELLSCHAFT1###</a></li>

    foreach ($dbCompanies as $data) {

      $href = $_SERVER['PHP_SELF'] . '?c=' . $data['id'];

      echo '<li class="' . isActive($siteData['id'], $data['id']) . '">';
      echo '<a href = "' . $href . '">' . $data['Name'] . '</a>';
      echo '</li>';
    }
    ?>
  </ul>

</nav>
