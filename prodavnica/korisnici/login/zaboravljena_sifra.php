<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>PROMJENI LOZINKU</title>
</head>
<body>
<div class="container">
        <div class="form-container">
    <form action="zaboravljena_sifra_request.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="korisnickoIme" placeholder="Unesite korisničko ime..." required>
        </div>
        
        <div class="form-group">
            <input id="sifra" type="password" class="form-control" name="sifra" placeholder="Unesi sifru..." required>
        </div>

        <div class="form-group">
            <input id="sifraPotvrda" class="form-control" type="password" name="sifraPotvrda" placeholder="Unesite ponovo sifru..." required>
        </div>

        <div class="form-group">
            <input id="submitBtn" class="btn btn-primary"  type="submit" value="POTVRDI">
        </div>
    </form>
    </div>
    </div>
</body>

<script>
        $(document).ready(function() {
            $('#sifra, #sifraPotvrda').on('keyup', function() {
                var korisnickoIme = $('#korisnickoIme').val();
                var sifra = $('#sifra').val();
                var sifraPotvrda = $('#sifraPotvrda').val();

                if (korisnickoIme !== '' && sifra !== '' && sifraPotvrda !== '' && sifra === sifraPotvrda && sifra.length >= 8 && (sifra.match(/\d/g) || []).length >= 2) {
                    $('#submitBtn').prop('disabled', false);
                } else {
                    $('#submitBtn').prop('disabled', true);
                }
            });
        });
    </script>
    <style>
        .container{
            margin-top: 30px;
        }

        .form-container {
            max-width: 350px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            background-color: #ffffff;
        }

        .form-container input {
            margin-bottom: 10px;
        }
    </style>
</html>