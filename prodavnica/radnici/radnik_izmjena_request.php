<?php 
    session_start();
    if ($_SESSION['rola'] != 'Admin') {
        echo "Nemate pravo pristupa za izmjenu radnika.";
        die();
    }

    if (
        !isset($_POST['id']) ||
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

  $id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['id']));
  $ime = mysqli_real_escape_string($conn, htmlspecialchars($_POST['ime']));
  $prezime = mysqli_real_escape_string($conn, htmlspecialchars($_POST['prezime']));
  $brojTelefona = mysqli_real_escape_string($conn, htmlspecialchars($_POST['brojTelefona']));
  $adresa = mysqli_real_escape_string($conn, htmlspecialchars($_POST['adresa']));
  $grad = mysqli_real_escape_string($conn, htmlspecialchars($_POST['grad']));
  $email = mysqli_real_escape_string($conn, filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $jmbg = mysqli_real_escape_string($conn, filter_var($_POST['jmbg'], FILTER_SANITIZE_NUMBER_INT));
  $korisnikId = mysqli_real_escape_string($conn, filter_var(htmlspecialchars($_POST['korisnikId']), FILTER_SANITIZE_NUMBER_INT));

    $query = "
        UPDATE `radnici`
        SET
            `Ime` = '$ime',
            `Prezime` = '$prezime',
            `BrojTelefona` = '$brojTelefona',
            `Adresa` = '$adresa',
            `Grad` = '$grad',
            `Email` = '$email',
            `JMBG` = '$jmbg',
            `KorisnikId` = '$korisnikId'
        WHERE
            `RadnikId` = $id
    ";

    $res = $conn->query($query);

    if($res){
        header("Location: radnici.php");
    }
    else{
        echo "Doslo je do greske prilikom izmjene.";
        var_dump($query);
    }
?>