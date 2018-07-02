<?php
$racine = $_SERVER['DOCUMENT_ROOT'];
require_once $racine .'/borabora/include/connexion.php';



?><!DOCTYPE html>
<html lang="fr">
<head>
  <title>Connexion - Le Bora-Bora</title>

  <?php include_once $racine .'/borabora/include/head.php' ?>
  <?php include_once $racine .'/borabora/include/connexion.php' ?>
  <link rel="stylesheet" type="text/css" media="screen" href="/borabora/css/co.css" />
</head>
<body>
  <?php include_once $racine .'/borabora/include/header.php' ?>



<?php 
$login=$_POST['login'];

$reqe = $db->prepare('SELECT id_emp, mdp FROM employe WHERE login = :login');
$reqe->execute(array(
    'login' => $login));
$resultat = $reqe->fetch();

$isPasswordCorrect = password_verify($_POST['mdp'], $resultat['mdp']);

if (!$resultat)
{
    header("Location: coemplo.php?erreur=1");
}
else
{
    if ($isPasswordCorrect) {
        
        $_SESSION['id_emp'] = $resultat['id_emp'];
        $_SESSION['login'] = $login;
        header("Location: calendrier.php");
    }
    else {
        header("Location: coemplo.php?erreur=1");
    }
}

?>

