<?php
# Filmkatalog, Website mit Verbindung zur MySQL-Datenbank
# Die Adminbar um zwischen Backend und Frontend zu naviegieren.
# 
# basierien auf einem Layout von Michael Hassel(hassel@mediakontur.de)
#
# Autor: Andreas Beer
# Email: andreasbeer@gmx.com
# Stand: 19.09.2016
# Version: Basisversion für Schulungszwecke
?>

<?php
//session starten
session_start();

// defaultwert setzen...
$user = '';

// wenn ein user in der session steht, user setzen
if (isset($_SESSION['user'])) {
   $user = $_SESSION['user'];
}
// wenn ein user mit post übergeben wurde, user setzen.
if (!empty($_POST['user'])) {
   $user = $_POST['user']; 
}

$pass = '';

// wenn ein user in der session steht, user setzen
if (isset($_SESSION['pass'])) {
   $pass = $_SESSION['pass'];
}
// wenn ein user mit post übergeben wurde, user setzen.
if (!empty($_POST['pass'])) {
   $pass = $_POST['pass']; 
}
  
$salt = 'sods/&$)?-=su3d2nso"§?';
$correct_user = 'root';
$correct_pass = hash('sha1', 'cimdata2016' . $salt);

$isLogedIn = false;
if ($user === $correct_user && hash('sha1', $pass . $salt) === $correct_pass) {
    
   $isLogedIn = true; 
      
   $_SESSION['user']  = $user;
   $_SESSION['pass']  = $pass;
   $_SESSION['login'] = true;
}

if (!empty($_POST['logout'])) {
    
    // die seesion zerstören
    session_destroy();
    
    // den cookie löschen
    setcookie(session_name(), '', 0, '/');
    
    header('Location:' . $_SERVER['PHP_SELF']);    
}

?>

<nav class="adminbar navbar navbar-default navbar-fixed-top">
        
    <div class="container-fluid">
        <!-- Überschrift -->
        <div class="navbar-header hidden-xs">
            <span class="navbar-brand">Adminbar</span>
        </div>

        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="navbar-form">

            <!-- NICHT angemeldet ABER Admin -->
            <?php if (!$isLogedIn): ?>

                <!-- benutzer -->
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></div>
                    <input class="form-control" name="user" maxlength="20" type="text" placeholder="Benutzer">
                </div>

                <!-- password -->
                <div class="input-group">
                    <div class="input-group-addon"><span class="fa fa-unlock-alt" aria-hidden="true"></span></div>
                    <input class="form-control" name="pass" maxlength="30" type="password" placeholder="Password">
                </div>

                <!-- Login button -->
                <button type="submit" name="login" class="btn btn-default">Login</button>


                <!-- angemeldet -->
            <?php else: ?>

                <button type="submit" formaction="<?php echo PATH_FILE_MAIN; ?>" name="website" class="btn btn-default">Zur Webseite</button>
                <button type="submit" formaction="<?php echo PATH_FILE_DASHBOARD; ?>" name="dashboard" class="btn btn-default">Dashboard</button>
                <button type="submit" name="logout" value="logout" class="btn btn-default navbar-right">Logout</button>

            <?php endif; ?>

        </form>
    </div>
    
</nav>