<?php
$racine = $_SERVER['DOCUMENT_ROOT'];
require_once $racine .'/borabora/include/connexion.php';



?><!DOCTYPE html>
<html lang="fr">
<head>
  <title>Connexion - Le Bora-Bora</title>
  <?php include_once $racine .'/borabora/include/head.php' ?>
</head>
<body>
  <?php include_once $racine .'/borabora/include/header.php' ?>
  

<h1>Connexion</h1>
 <form action="ash.php" method="post">
<p>Mdp : <input type="password" name="pass" /></p>
 <p><input type="submit" value="Connexion"></p>
 </form>
   


</div>
  
<div class="popup" onclick="myFunction()">Click me!
  <span class="popuptext" id="myPopup">Popup text...</span>
</div>


<script>
// When the user clicks on div, open the popup
function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
}
</script>
  
<!--==============================footer=================================-->
  <?php include_once $racine .'/borabora/include/footer.php' ?>


</body>
</html>