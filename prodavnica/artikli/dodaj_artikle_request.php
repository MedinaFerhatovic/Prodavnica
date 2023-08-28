<?php
session_start();
if ($_SESSION['rola'] != 'Admin') {
    echo "Nemate pravo pristupa za dodavanje artikla.";
    die();
}

if (
    !isset($_POST['sifra']) ||
    !isset($_POST['naziv']) ||
    !isset($_POST['cijena'])
) {
    echo "Sifra ili naziv ili cijena nisu setovani.";
    die();
}

$conn = new mysqli("localhost", "root", "", "projekat");

$sifra = mysqli_real_escape_string($conn, htmlspecialchars($_POST['sifra']));
$naziv = mysqli_real_escape_string($conn, htmlspecialchars($_POST['naziv']));
$cijena = mysqli_real_escape_string($conn, filter_var(htmlspecialchars($_POST['cijena']), FILTER_SANITIZE_NUMBER_FLOAT));

$query =
    "INSERT INTO `artikli` 
        (`Sifra`, `Naziv`, `Cijena`)
    VALUES
        ('$sifra', '$naziv', $cijena)
    ";

$res = $conn->query($query);

if ($res) {
    header("Location: pocetnaStranica.php");
} else {
    echo "Doslo je do greske na serveru.";
    die();
}

?>