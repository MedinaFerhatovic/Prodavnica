<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>NOVI ARTIKAL</title>
</head>
<body>
    <form class="container mt-5" action="dodaj_artikle_request.php" method="post">
        <div class="form-group">
            <input id="sifra" class="form-control" type="text" name="sifra" placeholder="Unesite sifru artikla..." required>
        </div>

        <div class="form-group">
            <input id="naziv" class="form-control" type="text" name="naziv" placeholder="Unesite naziv artikla..." required>
        </div>

        <div class="form-group">
            <input id="cijena" class="form-control" type="number" min="0,01" name="cijena" placeholder="Unesite cijenu artikla..." required>
        </div>

        <div class="form-group">
            <input disabled id="submitBtn" class="btn btn-primary" type="submit" value="DODAJ">
        </div>
    </form>

    <a href="pocetnaStranica.php" class="btn btn-secondary">Vrati se na pocetnu</a>
    
    <script>
        const sifraInput = document.getElementById("sifra");
        const nazivInput = document.getElementById("naziv");
        const cijenaInput = document.getElementById("cijena");
        const submitBtn = document.getElementById("submitBtn");
        
        function enableSubmit() {
            const sifraValue = sifraInput.value;
            const nazivValue = nazivInput.value;
            const cijenaValue = cijenaInput.value;

            if (sifraValue.length > 0 && nazivValue.length > 0 && cijenaValue > 0) {
                submitBtn.removeAttribute("disabled");
            } else {
                submitBtn.setAttribute("disabled", "disabled");
            }
        }

        sifraInput.addEventListener("input", enableSubmit);
        nazivInput.addEventListener("input", enableSubmit);
        cijenaInput.addEventListener("input", enableSubmit);
    </script>
</body>
</html>