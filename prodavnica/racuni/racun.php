<!DOCTYPE html>
<html>
<head>
    <title>Račun</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Račun</h1>
        <?php
            $imeOsobe = $_GET["ime"];
            $datumVrijeme = $_GET["datum"];
            $stavke = explode("\n", $_GET["stavke"]);
            $ukupnaCijena = $_GET["ukupnaCijena"];
        ?>
        <p><strong>Ime osobe:</strong> <?php echo $imeOsobe; ?></p>
        <p><strong>Datum i vrijeme:</strong> <?php echo $datumVrijeme; ?></p>
        <h2 class="mt-4">Stavke na računu</h2>
        <ul class="list-group">
            <?php
                foreach ($stavke as $stavka) {
                    echo "<li class='list-group-item'>$stavka</li>";
                }
            ?>
        </ul>
        <p class="mt-3"><strong>Ukupna cijena:</strong> <?php echo $ukupnaCijena; ?></p>

        <button class="btn btn-danger mt-3" onclick="odustaniOdRacuna()">Odustani od računa</button>

        <button class="btn btn-success mt-3" onclick="potvrdiRacun()">Potvrdi račun</button>
    </div>

    <script>
        function odustaniOdRacuna() {
            window.location.href = "../artikli/pocetnaStranica.php"; 
        }

        function potvrdiRacun() {
            alert("Račun je uspješno kreiran!");
            window.location.href = "../artikli/pocetnaStranica.php";
        }
    </script>
</body>
</html>
