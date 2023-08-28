<?php
session_start();
if ($_SESSION['rola'] != 'Admin') {
    echo "Nemate pravo pristupa za dodavanje artikla.";
    die();
}

if (
    !isset($_POST['artikalId']) ||
    !isset($_POST['kolicina']) ||
    !isset($_POST['lokacija'])
) {
    echo "Artikal ili kolicina ili lokacija nisu setovani.";
    die();
}

$conn = new mysqli("localhost", "root", "", "projekat");

$artikalId = mysqli_real_escape_string($conn, filter_var(htmlspecialchars($_POST['artikalId']), FILTER_SANITIZE_NUMBER_INT));
$kolicina = mysqli_real_escape_string($conn, filter_var(htmlspecialchars($_POST['kolicina']), FILTER_SANITIZE_NUMBER_FLOAT));
$lokacija = mysqli_real_escape_string($conn, htmlspecialchars($_POST['lokacija']));

$query =
    "INSERT INTO `lageri` 
        (`ArtikalId`, `RaspolozivaKolicina`, `Lokacija`)
    VALUES
        ('$artikalId', '$kolicina', '$lokacija')
    ";


$res = $conn->query($query);

if ($res) {
    header("Location: lageri.php");
} else {
    echo "Doslo je do greske na serveru.";
    die();
}

?>