<?php
        try {
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
              );
            $db = new PDO('mysql:host=localhost;dbname=borabora', 'root', '', $options);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    ?>

