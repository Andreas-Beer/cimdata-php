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
include_once 'functions.inc.php';

$curr_companyID = !empty($_GET['c']) ? $_GET['c'] : '';

// Daten abfragen 
$handle_companiesAll = mysqli_query($conn, $sql_select_companies);
?>

<nav>

    <!-- Suche -->
    <form class="navbar-form" role="search">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Suchen&hellip;">
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

        while (($data = mysqli_fetch_assoc($handle_companiesAll)) !== NULL) {

            $href = $_SERVER['PHP_SELF'] . '?c=' . $data['id'];

            echo '<li class="' . isActive($curr_companyID, $data['id']) . '">';
            echo '<a href = "' . $href . '">' . $data['Name'] . '</a>';
            echo '</li>';
        }
        ?>
    </ul>

</nav>
<?php
mysqli_free_result($handle_companiesAll);
?>