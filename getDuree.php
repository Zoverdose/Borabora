<?php 
    $options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    );
    try {
        $db = new PDO('mysql:host=localhost;dbname=borabora', 'root', '',$options);
    }
    catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $result2 = $db->prepare("SELECT duree from spa where lib_spa = ?");
    $result2->execute(array($_POST['soin']));
    while ($data = $result2->fetch()) {
        echo($data['duree']);
    }

?>