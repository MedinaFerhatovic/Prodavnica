<?php 
    if(!isset($_POST['korisnickoIme']) ||
    !isset($_POST['sifra']) ||
    !isset($_POST['sifraPotvrda'])){
        echo "Korisnicko ime ili sifra ili sifra za potvrdu nisu setovani.";
        die();
    }

    $conn = new mysqli("localhost", "root", "", "projekat");

    $korisnickoIme = mysqli_real_escape_string($conn, htmlspecialchars($_POST['korisnickoIme']));
    $sifra = mysqli_real_escape_string($conn, htmlspecialchars($_POST['sifra']));
    $sifra_potvrda = mysqli_real_escape_string($conn, htmlspecialchars($_POST['sifraPotvrda']));

    if($sifra !== $sifra_potvrda){
        echo "Sifre nisu iste.";
        die();
    }

    $query = "SELECT * FROM `korisnici` WHERE `KorisnickoIme` = '$korisnickoIme'";

    $res = $conn->query($query);

    if($res->num_rows == 1){

        $hashSifra = password_hash($sifra, PASSWORD_DEFAULT);
        
        $query = 
        "UPDATE `korisnici` 
        SET
            `Sifra` = '$hashSifra'
        WHERE `KorisnickoIme` = '$korisnickoIme'
        ";

        $res = $conn->query($query);

        if($res){
            header("Location: login.php");
        }
        else {
            echo "Doslo je do greske na serveru.";
            die();
        }
    }
    else {
        echo "Korisnicko ime ne postoji.";
        die();
    }

?>