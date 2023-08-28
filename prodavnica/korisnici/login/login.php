<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>LOG IN</title>
</head>
<body>
<div>
    <form action="login_request.php" method="post">
        <div>
            <input class="tekst" type="text" name="korisnickoIme" required placeholder="Unesite korisnicko ime...">
        </div>

        <div>
            <input class="tekst" type="password" name="sifra" required placeholder="Unesite sifru...">
        </div>

        <div>
            <input class="submit" type="submit" value="LOG IN">
        </div>

        <div class="forgot-password">
            <a class="tekst" href="zaboravljena_sifra.php">Zaboravili ste sifru?</a>
        </div>
    </form>
 </div>
</body>
</html>