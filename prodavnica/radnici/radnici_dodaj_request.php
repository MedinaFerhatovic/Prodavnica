<?php
session_start();
if ($_SESSION['rola'] != 'Admin') {
    echo "Nemate pravo pristupa za dodavanje radnika.";
    die();
}

if (
    !isset($_POST['ime']) ||
    !isset($_POST['prezime']) ||
    !isset($_POST['brojTelefona']) ||
    !isset($_POST['adresa']) ||
    !isset($_POST['grad']) ||
    !isset($_POST['email']) ||
    !isset($_POST['jmbg']) ||
    !isset($_POST['korisnikId'])
) {
    echo "Nesto nije setovano.";
    die();
}

$conn = new mysqli("localhost", "root", "", "projekat");

$ime = mysqli_real_escape_string($conn, htmlspecialchars($_POST['ime']));
$prezime = mysqli_real_escape_string($conn, htmlspecialchars($_POST['prezime']));
$brojTelefona = mysqli_real_escape_string($conn, htmlspecialchars($_POST['brojTelefona']));
$adresa = mysqli_real_escape_string($conn, htmlspecialchars($_POST['adresa']));
$grad = mysqli_real_escape_string($conn, htmlspecialchars($_POST['grad']));
$email = mysqli_real_escape_string($conn, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$jmbg = mysqli_real_escape_string($conn, filter_var($_POST['jmbg'], FILTER_SANITIZE_NUMBER_INT));
$korisnikId = mysqli_real_escape_string($conn, filter_var(htmlspecialchars($_POST['korisnikId']), FILTER_SANITIZE_NUMBER_INT));

$query =
    "INSERT INTO `radnici` 
        (`Ime`, `Prezime`, `BrojTelefona`, `Adresa`, `Grad`, `Email`, `JMBG`, `KorisnikId`)
    VALUES
        ('$ime', '$prezime', '$brojTelefona', '$adresa', '$grad', '$email', '$jmbg', '$korisnikId')
    ";

$res = $conn->query($query);

if ($res) {
    header("Location: radnici.php");
} else {
    echo "Doslo je do greske prilikom dodavanja radnika.";
    die();
}
?>