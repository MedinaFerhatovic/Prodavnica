<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["artikalId"])) {
    $artikalId = $_POST["artikalId"];

    
    $conn = new mysqli("localhost", "root", "", "projekat");

    if ($conn->connect_error) {
        die("Greška pri povezivanju sa bazom podataka: " . $conn->connect_error);
    }

    $sql = "SELECT Naziv, Cijena FROM artikli WHERE ArtikalId = $artikalId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $naziv = $row["Naziv"];
        $cijena = $row["Cijena"];

        echo json_encode(array("naziv" => $naziv, "cijena" => $cijena));
    } else {
        echo "Artikal sa ID $artikalId nije pronađen.";
    }

    $conn->close();
}
?>

