<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Frontend: Ausgabe der Filmtitel
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 19.09.2016
# Version: Basisversion für Schulungszwecke

include_once './config.inc.php';
require_once PATH_FILE_DBCONNECT;


function getData() {

  $type = '';
  $id   = '';

  $data = array();

  if (!empty($_GET['g']) && is_numeric($_GET['g'])) {
    $id        = $_GET['g'];
    $title_arr = getDBData(sql_select_genreByID($id)); 
    
    if (!$title_arr)  {
      header('Location:' . $_SERVER['SCRIPT_NAME']);
    }
    
    $category  = $title_arr[0]['name'];

    $data['type']  = 'g';
    $data['id']    = $id;
    $data['title'] = sprintf(TEXT_MAIN_GUI_HEADLINE_GENRE, $category);
    $data['data']  = getDBData(sql_select_moviesByGenreId($id));
  }
  
  elseif (!empty($_GET['c']) && is_numeric($_GET['c'])) {
    $id        = $_GET['c'];
    $title_arr = getDBData(sql_select_companyByID($id));
    
    if (!$title_arr)  {
      header('Location:' . $_SERVER['SCRIPT_NAME']);
    }
    
    $category  = $title_arr[0]['name'];

    $data['type']  = 'c';
    $data['id']    = $id;
    $data['title'] = sprintf(TEXT_MAIN_GUI_HEADLINE_COMPANY, $category);
    $data['data']  = getDBData(sql_select_moviesByCompanyId($id));    
  }
  
  else {
    $data['type']  = false;
    $data['id']    = $id;
    $data['title'] = TEXT_MAIN_GUI_HEADLINE_DEFAULT;
    $data['data']  = getDBData(sql_select_moviesNew10());
  }

  return $data;
}

$dbCompanies = getDBData(sql_select_companies());
$dbGenres    = getDBData(sql_select_genres());
$siteData    = getData();

$title = htmlspecialchars($siteData['title']);
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo PATH_FILE_STYLE_MAIN; ?>" />
  </head>

  <body>

    <?php
    session_start();

    if (isset($_GET['adminbar']) || !empty($_SESSION['login']) == true) {
      include PATH_FILE_ADMINBAR;
    }
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
              foreach ($dbGenres as $data) {
                include PATH_FILE_GENRE;
              }
              ?>

            </ul>  
          </div>

        </div>
      </nav>
    </header>

    <main class="main container">
      <div class="row">

        <div class="col-sm-4 col-md-3 sidebar">

          <nav>

            <!-- Suche -->
            <form class="navbar-form" role="search">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="<?php echo TEXT_MAIN_GUI_SEARCH_PLACEHOLDER; ?>">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                  </span>
                </div>
              </div>
            </form>

            <!-- Navigation -->
            <ul class="nav nav-pills nav-stacked">
              <?php
              foreach ($dbCompanies as $data) {
                include PATH_FILE_COMPANY;
              }
              ?>
            </ul>

          </nav>

        </div>

        <div class="col-sm-8 col-md-9">

          <div class="well well-sm">
            <?php
            echo sprintf(TEXT_MAIN_GUI_MSG_FILMFOUND, count($siteData['data']));
            ?>
          </div>

          <?php
                    
          foreach ($siteData['data'] as $data) {
            include PATH_FILE_FILM_MAIN;
          }
          ?>

        </div>

      </div>
    </main>

    <?php include PATH_FILE_FOOTER; ?>

    <script src="<?php echo PATH_FILE_JS_JQUERY; ?>" type="text/javascript"></script>
    <script src="<?php echo PATH_FILE_JS_BOOTSTRAP; ?>" type="text/javascript"></script>

  </body>
</html>