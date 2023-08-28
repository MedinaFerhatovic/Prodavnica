<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>IZMJENA RADNIKA</title>
</head>
<body>
    <?php 
        if(!isset($_GET['id'])){
            echo "Doslo je do greske.";
            die();
        }
    
        $id = $_GET['id'];
    
        $conn = new mysqli("localhost", "root", "", "projekat");
    
        $query = "SELECT * FROM `radnici` 
                WHERE `RadnikId` = $id";
    
        $resRadnik = $conn->query($query);

        if($resRadnik->num_rows == 0){
            echo "Radnik ne postoji!";
            die();
        }

        $radnik = $resRadnik->fetch_assoc();
    ?>

   <div class="container">
    <form class="container mt-5" action="radnik_izmjena_request.php" method="post">
    <input type="hidden" name="id" value="<?php echo $radnik['RadnikId']; ?>">

        <div class="form-group">
             <input  class="form-control" id="ime" type="text" name="ime" value="<?php echo $radnik['Ime'] ?>" placeholder="Unesite ime..." required>
        </div>

        <div class="form-group">
             <input  class="form-control" id="prezime" type="text" name="prezime" value="<?php echo $radnik['Prezime'] ?>" placeholder="Unesite prezime..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="brojTelefona" type="text" name="brojTelefona" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3,}" value="<?php echo $radnik['BrojTelefona'] ?>" placeholder="Unesite broj telefona..." required>
        </div>
       
        <div class="form-group">
            <input  class="form-control" id="adresa" type="text" name="adresa" value="<?php echo $radnik['Adresa'] ?>" placeholder="Unesite adresu..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="grad" type="text" name="grad" value="<?php echo $radnik['Grad'] ?>" placeholder="Unesite grad..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="email" type="email" name="email" value="<?php echo $radnik['Email'] ?>" placeholder="Unesite email..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="jmbg" type="text" name="jmbg" pattern="[0-9]{13}" value="<?php echo $radnik['JMBG'] ?>" placeholder="Unesite jmbg..." required>
        </div>

        <div class="form-group">
        <label for="korisnik">Korisnik/Korisnicko ime</label>
            <select id="korisnik" name="korisnikId" class="form-control" required>
                <?php 
                   $query = "SELECT 
                              `k`.* 
                            FROM `korisnici` as `k`
                            LEFT JOIN `radnici` as `r` ON `r`.KorisnikId = `k`.KorisnikId
                            WHERE `r`.RadnikId IS NULL
                           ";
                    $resKorisnici = $conn->query($query);

                    while ($korisnik = $resKorisnici->fetch_assoc()) {
                    ?>
                       <option value="<?php echo $korisnik['KorisnikId'] ?>" <?php if($korisnik['KorisnikId'] == $radnik['RadnikId']) echo 'selected'; ?>><?php echo $korisnik['KorisnickoIme'] ?></option>
                    <?php
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <input id="submitBtn" class="btn btn-primary" type="submit" value="IZMJENI">
        </div>
    </form>

    <a href="radnici.php" class="btn btn-secondary">Vrati se na pocetnu stranicu!</a>

</body>
</html>