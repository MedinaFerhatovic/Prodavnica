<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../login/style2.css">
    <title>REGISTRACIJA</title>
</head>
<body>
    <form action="register_request.php" method="post">
        <div>
            <input class="tekst" type="text" name="korisnickoIme" placeholder="Unesite korisničko ime..." required>
        </div>

        <div>
            <input class="tekst" type="password" id="sifra" name="sifra" placeholder="Unesi sifru..." required>
        </div>

        <div>
            <input class="tekst" type="password" id="sifraPotvrda" name="sifraPotvrda" placeholder="Unesite ponovo sifru..." required>
        </div>

        <div>
            <input class="submit" id="submitBtn" disabled type="submit" value="POTVRDI">
        </div>
    </form>

    <script>
        const sifraInput = document.getElementById("sifra");
        const sifraPotvrdaInput = document.getElementById("sifraPotvrda");
        const submitBtn = document.getElementById("submitBtn");

        function enableSubmit() {
            const sifraValue = sifraInput.value;
            const sifraPotvrdaValue = sifraPotvrdaInput.value;

            if (sifraValue.length >= 8 && (sifraValue.match(/\d/g) || []).length >= 2 && sifraValue === sifraPotvrdaValue) {
                submitBtn.removeAttribute("disabled");
            } else {
                submitBtn.setAttribute("disabled", "disabled");
            }
        }

        sifraInput.addEventListener("input", enableSubmit);
        sifraPotvrdaInput.addEventListener("input", enableSubmit);
    </script>
</body>
</html>


<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>REGISTRACIJA</title>
</head>
<body>
    <form action="register_request.php" method="post">
        <div>
            <input type="text" id="korisnickoIme" required placeholder="Unesite korisnicko ime...">
        </div>

        <div>
            <input type="password" id="sifra" required placeholder="Unesite sifru...">
        </div>

        <div>
            <input type="password" id="sifraPotvrda" required placeholder="Unesite sifru ponovo...">
        </div>

        <div>
            <input type="submit" id="registerBtn" disabled value="REGISTER">
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $('#korisnickoIme, #sifra, #sifraPotvrda').on('keyup', function() {
                var korisnickoIme = $('#korisnickoIme').val();
                var sifra = $('#sifra').val();
                var sifraPotvrda = $('#sifraPotvrda').val();

                if (korisnickoIme !== '' && sifra !== '' && sifraPotvrda !== '' && sifra === sifraPotvrda && sifra.length >= 8 && (sifra.match(/\d/g) || []).length >= 2) {
                    $('#registerBtn').prop('disabled', false);
                } else {
                    $('#registerBtn').prop('disabled', true);
                }
            });
        });
    </script>
</body>
</html>
    -->