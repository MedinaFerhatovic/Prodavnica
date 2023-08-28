<?php
session_start();
if ($_SESSION['rola'] != 'Admin') {
    echo json_encode(['error' => 'Nemate pravo pristupa za brisanje lagera.']);
    die();
}

if (!isset($_POST['id'])) {
    echo json_encode(['error' => 'Doslo je do greske.']);
    die();
}

$id = htmlspecialchars($_POST['id']);

$conn = new mysqli("localhost", "root", "", "projekat");

$query = "DELETE FROM `lageri` WHERE `LagerId` = $id";

$res = $conn->query($query);

if ($res) {
    if ($conn->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Lager ne postoji ili je već obrisan.']);
    }
} else {
    echo json_encode(['error' => 'Doslo je do greske prilikom brisanja lagera.']);
}
?>

