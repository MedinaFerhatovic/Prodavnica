<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>NOVI RADNICI</title>
</head>
<body>
    <form class="container mt-5" action="radnici_dodaj_request.php" method="post">

        <div class="form-group">
            <input  class="form-control" id="ime" type="text" name="ime" placeholder="Unesite ime..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="prezime" type="text" name="prezime" placeholder="Unesite prezime..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="brojTelefona" type="text" name="brojTelefona" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3,}" placeholder="Unesite broj telefona..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="adresa" type="text" name="adresa" placeholder="Unesite adresu..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="grad" type="text" name="grad" placeholder="Unesite grad..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="email" type="email" name="email" placeholder="Unesite email..." required>
        </div>

        <div class="form-group">
            <input  class="form-control" id="jmbg" type="text" name="jmbg" pattern="[0-9]{13}" placeholder="Unesite jmbg..." required>
        </div>

        <div class="form-group">
        <label for="korisnik">Korisnik/Korisnicko Ime</label>
            <select id="korisnik" name="korisnikId" class="form-control" required>
                <?php 
                    $conn = new mysqli("localhost", "root", "", "projekat");
                    $query = "SELECT 
                                    `k`.* 
                                FROM `korisnici` as `k`
                                LEFT JOIN `radnici` as `r` ON `r`.KorisnikId = `k`.KorisnikId
                                WHERE `r`.RadnikId IS NULL
                                ";
                    $res = $conn->query($query);

                    while ($radnik = $res->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $radnik['KorisnikId'] ?>"><?php echo $radnik['KorisnickoIme'] ?></option>
                    <?php
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <input disabled id="submitBtn" class="btn btn-primary" type="submit" value="DODAJ">
        </div>
    </form>

    <a href="radnici.php" class="btn btn-secondary">Vrati se na pocetnu stranicu!</a>
    
    <script>
        const imeInput = document.getElementById("ime");
        const prezimeInput = document.getElementById("prezime");
        const brojTelefonaInput = document.getElementById("brojTelefona");
        const adresaInput = document.getElementById("adresa");
        const gradInput = document.getElementById("grad");
        const emailInput = document.getElementById("email");
        const jmbgInput = document.getElementById("jmbg");
        const submitBtn = document.getElementById("submitBtn");
        
        function enableSubmit() {
            const imeValue = imeInput.value;
            const prezimeValue = prezimeInput.value;
            const brojTelefonaValue = brojTelefonaInput.value;
            const adresaValue = adresaInput.value;
            const gradValue = gradInput.value;
            const emailValue = emailInput.value;
            const jmbgValue = jmbgInput.value;


            if (
              imeValue.length > 0 &&
              prezimeValue.length > 0 &&
              brojTelefonaValue.length > 0 &&
              adresaValue.length > 0 &&
              gradValue.length > 0 &&
              emailValue.length > 0 &&
              jmbgValue.length > 0
            ) {
             submitBtn.removeAttribute("disabled");
            } else {
             submitBtn.setAttribute("disabled", "disabled");
            }
        }  

    imeInput.addEventListener("input", enableSubmit);
    prezimeInput.addEventListener("input", enableSubmit);
    brojTelefonaInput.addEventListener("input", enableSubmit);
    adresaInput.addEventListener("input", enableSubmit);
    gradInput.addEventListener("input", enableSubmit);
    emailInput.addEventListener("input", enableSubmit);
    jmbgInput.addEventListener("input", enableSubmit);
    </script>
</body>
</html>