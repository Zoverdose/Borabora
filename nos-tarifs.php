<?php
$racine = $_SERVER['DOCUMENT_ROOT'];

// Création de la connexion à la base de données
$serveur = "localhost";
$nom_de_la_base = "borabora";
$utilisateur = "root";
$mot_de_passe = "";
$cnx = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $nom_de_la_base);

// Test du succès de la tentative de connexion
if (!$cnx) {
  die('Erreur de connexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
}

// Passage de la connexion en utf8
mysqli_set_charset($cnx, 'utf8');


//LE SPA
$req = "select spa.lib_spa, spa.prix_spa, spa.desc_spa, spa.duree, lib_cat from spa inner join cat_spa on cat_spa.cat = spa.cat;";

  $resultat_spa = mysqli_query($cnx, $req) or die(mysqli_error($cnx));
  $prix_par_categorie_spa = array();
  while ($enregistrement_spa = mysqli_fetch_assoc($resultat_spa)) {
    $prix_par_categorie_spa[$enregistrement_spa['lib_cat']][] = array(
      'libelle' => $enregistrement_spa['lib_spa'],
      'prix' => $enregistrement_spa['prix_spa']
    );
  }

$nb_categories_spa = count($prix_par_categorie_spa);


// Exécution d'une requête, on récupère toues les consommations de disponibles
$requete = "select cc.lib_cat, c.lib_cons, c.prix_cons from consommation c inner join cat_cons cc on cc.cat = c.cat;";
$resultat = mysqli_query($cnx, $requete) or die(mysqli_error($cnx)); // or die() est pour la détection des erreurs

// On rempli un tableau à deux dimensions à partir du résultat de la requête
$prix_par_categorie = array();
while ($enregistrement = mysqli_fetch_assoc($resultat)) {
  $prix_par_categorie[$enregistrement['lib_cat']][] = array(
    'libelle' => $enregistrement['lib_cons'],
    'prix' => $enregistrement['prix_cons']
  );
}

// On récupère le nombre de catégories pour gérer l'affichage par colonnes
$nb_categories = count($prix_par_categorie);

?><!DOCTYPE html>
<html lang="fr">
<head>
  <title>Nos prestations - Le Bora-Bora</title>
  <?php include_once $racine .'/borabora/include/head.php' ?>
</head>
<body>
  <?php include_once $racine .'/borabora/include/header.php' ?>
  
  <!--==============================Méthode 1================================-->
  <section id="content">
    <div class="container_12 top">
    
      
     

      
      <!--==============================Méthode 2================================-->
      <div class="grid_12 box-2 pad-1">
        <div>
          <p class="text-3">LE BAR</p>
        </div>
      </div>
      
      <div class="grid_6">
        <ul class="list-2 top-5">
          <?php
          $moitie = ceil($nb_categories / 2);
          reset($prix_par_categorie);

          for ($cpt=0; $cpt<$moitie; $cpt++) {
          ?>
          <li>
            <?php echo key($prix_par_categorie); ?>
            <ul>
              <?php foreach (current($prix_par_categorie) as $consommation) { ?>
              <li><?php echo $consommation['libelle'] .' => '. $consommation['prix'] ?></li>
              <?php } ?>
            </ul>
          </li>
          <?php next($prix_par_categorie); } ?>
        </ul>
      </div>

      <div class="grid_6">
        <ul class="list-2 top-5">
          <?php for (; $cpt<$nb_categories; $cpt++) { ?>
          <li>
            <?php echo key($prix_par_categorie); ?>
            <ul>
              <?php foreach (current($prix_par_categorie) as $consommation) { ?>
              <li><?php echo $consommation['libelle'] .' => '. $consommation['prix'] ?></li>
              <?php } ?>
            </ul>
          </li>
          <?php next($prix_par_categorie); } ?>
        </ul>
      </div>
      
    <div class="grid_12 box-2 pad-1">
        <div>
          <p class="text-3">LE SPA</p>
        </div>
      </div>
      
      <div class="grid_12">
        <ul class="list-2 top-5">
          <?php
          $moitie = ceil($nb_categories_spa / 2);
          reset($prix_par_categorie_spa);

          for ($cpt=0; $cpt<$moitie; $cpt++) {
          ?>
          <li> Les soins
            
            <ul>
              <?php foreach (current($prix_par_categorie_spa) as $spa) { ?>
              <li><?php echo $spa['libelle'] .' => '. $spa['prix'] ?></li>
              <?php } ?>
            </ul>
          </li>
            <?php next($prix_par_categorie_spa); } ?>
            
        </ul>
        	  <a href="calendrier_client.php" class="link-2">voir le calendrier de réservation</a> 
      </div>
    </div>
      
      <div class="clear"></div>
    </div>
  </section>

  
<!--==============================footer=================================-->
  <?php include_once $racine .'/borabora/include/footer.php' ?>
</body>
</html>