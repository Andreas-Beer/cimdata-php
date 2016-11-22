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

<nav class="adminbar navbar navbar-default navbar-fixed-top">

  <!-- Überschrift -->
  <div class="navbar-header">
    <span class="navbar-brand">Adminbar</span>
  </div>



  <form action="###ZIEL1###" method="post" class="navbar-form">

    <!-- NICHT angemeldet -->

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

    <button type="submit" formaction="###ZIEL2###" name="website" class="btn btn-default">Zur Webseite</button>
    <button type="submit" name="dashboard" class="btn btn-default">Dashboard</button>
    <button type="submit" formaction="###ZIEL3###" name="logout" class="btn btn-default navbar-right">Logout</button>


  </form>

</nav>