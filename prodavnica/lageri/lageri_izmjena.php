<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>IZMJENA LAGERA</title>
</head>
<body>
    <?php 
        if(!isset($_GET['id'])){
            echo "Doslo je do greske.";
            die();
        }
    
        $id = $_GET['id'];
    
        $conn = new mysqli("localhost", "root", "", "projekat");
    
        $query = "SELECT * FROM `lageri` 
                WHERE `LagerId` = $id";
    
        $resLager = $conn->query($query);

        if($resLager->num_rows == 0){
            echo "Lager ne postoji!";
            die();
        }

        $lager = $resLager->fetch_assoc();
    ?>

   <div class="container">
    <form class="container mt-5" action="lageri_izmjena_request.php" method="post">
    <input type="hidden" name="id" value="<?php echo $lager['LagerId']; ?>">
    <div class="form-group">
        <label for="artikal">Artikal</label>
            <select id="artikal" name="artikalId" class="form-control" required>
                <?php 
                    $query = "SELECT 
                                    `a`.* 
                                FROM `artikli` as `a`
                                LEFT JOIN `lageri` as `l` ON `l`.ArtikalId = `a`.ArtikalId
                                WHERE `l`.LagerId IS NULL
                                ";
                    $resArtikli = $conn->query($query);

                    while ($artikal = $resArtikli->fetch_assoc()) {
                    ?>
                       <option value="<?php echo $artikal['ArtikalId'] ?>" <?php if($artikal['ArtikalId'] == $lager['ArtikalId']) echo 'selected'; ?>><?php echo $artikal['Naziv'] ?></option>
                    <?php
                    }
                ?>
            </select>

        <div class="form-group">
            <input id="kolicina" class="form-control" type="number" min="1" name="kolicina" value="<?php echo $lager['RaspolozivaKolicina'] ?>" placeholder="Unesite kolicinu..." required>
        </div>

        <div class="form-group">
            <input id="lokacija" class="form-control" type="text" name="lokacija" value="<?php echo $lager['Lokacija'] ?>" placeholder="Unesite lokaciju..." required>
        </div>

        <div class="form-group">
            <input id="submitBtn" class="btn btn-primary" type="submit" value="IZMJENI">
        </div>
    </form>

    <a href="lageri.php" class="btn btn-secondary">Vrati se na pocetnu stranicu!</a>

</body>
</html>