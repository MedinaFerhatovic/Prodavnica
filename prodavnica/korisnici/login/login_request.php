<?php 
    if(!isset($_POST['korisnickoIme']) ||
    !isset($_POST['sifra'])){
        echo "Korisnicko ime ili sifra nisu setovani.";
        die();
    }

    $conn = new mysqli("localhost", "root", "", "projekat");

    $korisnickoIme = mysqli_real_escape_string($conn, htmlspecialchars($_POST['korisnickoIme']));
    $sifra = mysqli_real_escape_string($conn, htmlspecialchars($_POST['sifra']));

    $query = "SELECT 
                    Sifra,
                    NazivRole
                FROM `korisnici` as `k`
                LEFT JOIN `role` as `r` on `k`.RolaId = `r`.RolaId
                WHERE `KorisnickoIme` = '$korisnickoIme'";

    $res = $conn->query($query);

    if($res->num_rows == 1){
        $korisnik = $res->fetch_assoc();
        $korisnikSifra = $korisnik['Sifra'];

        if(password_verify($sifra, $korisnikSifra)){
            session_start();
            $_SESSION['korisnickoIme'] = $korisnickoIme;
            $_SESSION['rola'] = $korisnik['NazivRole'];
            header("Location: ../../artikli/pocetnaStranica.php ");
        }
        else {
            echo "Sifra nije tacna.";
            die();
        }
    }
    else {
        echo "Korisnik ne postoji.";
        die();
    }
?>