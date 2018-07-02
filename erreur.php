<?php
$racine = $_SERVER['DOCUMENT_ROOT'];
require_once $racine .'/borabora/include/connexion.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <title>Connexion - Le Bora-Bora</title>
    <?php include_once $racine .'/borabora/include/head.php' ?>
    <link rel="stylesheet" type="text/css" media="screen" href="/borabora/css/co.css" />
    </head>
  <body>
  <?php include_once $racine .'/borabora/include/header.php' ?>
  </body>



<h1 id="erreur">Identifiant ou mot de passe incorrect !</h1>

<div class="login-page">
  <div class="form">
    </form>
      <form class="login-form" action="iden-co.php" method="post">
      <input type="text" name="login" placeholder="login"/>
      <input type="password" name="mdp" placeholder="Mot de passe"/>
      <p><input id="butco" type="submit" value="Connexion"></p>
    </form>
  </div>
</div>
<div id"bas">
  <!--==============================footer=================================-->
 <?php include_once $racine .'/borabora/include/footer.php' ?>
</div>
</html>