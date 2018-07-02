<?php
require_once '..\include\connexion.php';

$delete = "DELETE FROM events where id = :id";

$stmt = $db->prepare($delete);

$stmt->bindParam(':id', $_POST['id']);

$stmt->execute();

class Result {}



header('Content-Type: application/json');
echo json_encode($response);

?>
