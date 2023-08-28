
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Izmjena artikla</title>
</head>
<body>
    <?php 
        if(!isset($_GET['id'])){
            echo "Doslo je do greske.";
            die();
        }
    
        $id = $_GET['id'];
    
        $conn = new mysqli("localhost", "root", "", "projekat");
    
        $query = "SELECT * FROM `artikli` 
                WHERE `ArtikalId` = $id";
    
        $res = $conn->query($query);

        if($res->num_rows == 0){
            echo "Artikl ne postoji!";
            die();
        }

        $artikl = $res->fetch_assoc();
    ?>

   <div class="container">
    <form class="container mt-5" action="artikli_izmjena_request.php" method="post">
        <input type="hidden" name="id" value="<?php echo $artikl['ArtikalId']; ?>">

        <div class="form-group">
            <input id="sifra" class="form-control" type="text" name="sifra" value="<?php echo $artikl['Sifra'] ?>" placeholder="Unesite sifru artikla..." required>
        </div>

        <div class="form-group">
            <input id="naziv" class="form-control" type="text" name="naziv" value="<?php echo $artikl['Naziv'] ?>" placeholder="Unesite naziv artikla..." required>
        </div>

        <div class="form-group">
            <input id="cijena" class="form-control" type="number" min="0,01" name="cijena" value="<?php echo $artikl['Cijena'] ?>" placeholder="Unesite cijenu artikla..." required>
        </div>

        <div class="form-group">
            <input id="submitBtn" class="btn btn-primary" type="submit" value="IZMJENI">
        </div>
    </form>

    <a href="pocetnaStranica.php" class="btn btn-secondary">Vrati se na pocetnu stranicu!</a>

</body>
</html>