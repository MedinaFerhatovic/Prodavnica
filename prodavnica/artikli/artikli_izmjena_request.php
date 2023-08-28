<?php 
    session_start();
    if ($_SESSION['rola'] != 'Admin') {
        echo "Nemate pravo pristupa za izmjenu artikla.";
        die();
    }

   if (
    !isset($_POST['id']) ||
    !isset($_POST['sifra']) ||
    !isset($_POST['naziv']) ||
    !isset($_POST['cijena'])
  ) {
    echo "Sifra ili naziv ili cijena nisu setovani.";
    die();
  }

  $conn = new mysqli("localhost", "root", "", "projekat");

  $id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['id']));
  $sifra = mysqli_real_escape_string($conn, htmlspecialchars($_POST['sifra']));
  $naziv = mysqli_real_escape_string($conn, htmlspecialchars($_POST['naziv']));
  $cijena = mysqli_real_escape_string($conn, filter_var(htmlspecialchars($_POST['cijena']), FILTER_SANITIZE_NUMBER_FLOAT));

    $query = "
        UPDATE `artikli`
        SET
            `Sifra` = '$sifra',
            `Naziv` = '$naziv',
            `Cijena` = $cijena
        WHERE
            `ArtikalId` = $id
    ";

    $res = $conn->query($query);

    if($res){
        header("Location: pocetnaStranica.php");
    }
    else{
        echo "Doslo je do greske prilikom izmjene.";
        var_dump($query);
    }
?>