<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>NOVI LAGERI</title>
</head>
<body>
    <form class="container mt-5" action="lageri_dodaj_request.php" method="post">
        <div class="form-group">
        <label for="artikal">Artikal</label>
            <select id="artikal" name="artikalId" class="form-control" required>
                <?php 
                    $conn = new mysqli("localhost", "root", "", "projekat");
                    $query = "SELECT 
                                    `a`.* 
                                FROM `artikli` as `a`
                                LEFT JOIN `lageri` as `l` ON `l`.ArtikalId = `a`.ArtikalId
                                WHERE `l`.LagerId IS NULL
                                ";
                    $res = $conn->query($query);

                    while ($artikal = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $artikal['ArtikalId'] ?>"><?php echo $artikal['Naziv'] ?></option>
                    <?php
                    }
                ?>
            </select>

        <div class="form-group">
            <input id="kolicina" type="number" min="1" name="kolicina" placeholder="Unesite kolicinu..." required>
        </div>

        <div class="form-group">
            <input id="lokacija" type="text" name="lokacija" placeholder="Unesite lokaciju..." required>
        </div>

        <div class="form-group">
            <input disabled id="submitBtn" class="btn btn-primary" type="submit" value="DODAJ">
        </div>
    </form>

    <a href="lageri.php" class="btn btn-secondary">Vrati se na pocetnu stranicu!</a>
    
    <script>
        const kolicinaInput = document.getElementById("kolicina");
        const lokacijaInput = document.getElementById("lokacija");
        const submitBtn = document.getElementById("submitBtn");
        
        function enableSubmit() {
            const kolicinaValue = kolicinaInput.value;
            const lokacijaValue = lokacijaInput.value;

            if (kolicinaValue > 0 && lokacijaValue.length > 0) {
                submitBtn.removeAttribute("disabled");
            } else {
                submitBtn.setAttribute("disabled", "disabled");
            }
        }

        kolicinaInput.addEventListener("input", enableSubmit);
        lokacijaInput.addEventListener("input", enableSubmit);
    </script>
</body>
</html>