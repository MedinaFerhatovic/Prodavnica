<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>ARTIKLI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content-menu-container">
        <?php include('../menu/menu.html'); ?>

        <div>
            <?php session_start(); ?>
            <?php if($_SESSION['rola'] == 'Admin'){ ?>
                    <a href="dodaj_artikle.php" class="btn btn-primary" id="dugme">Dodaj novi artikal</a>
            <?php } ?>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                    <th scope="col">Sifra</th>
                    <th scope="col">Naziv</th>
                    <th scope="col">Cijena</th>
                    <?php 
                    if($_SESSION['rola'] == 'Admin'){
                        echo "<th></th>";
                        echo "<th></th>";
                    }?>
                </tr>
                </thead>
                <?php 
                    $conn = new mysqli("localhost", "root", "", "projekat");
                    $query = "SELECT * FROM `artikli`";
                    $res = $conn->query($query);

                    while ($artikl = $res->fetch_assoc()) {
                    ?>
                    <tbody>
                       <tr>
                            <input type="hidden" value="<?php echo $artikl['ArtikalId'] ?>">
                            <td><?php echo $artikl['Sifra'] ?></td>
                            <td><?php echo $artikl['Naziv'] ?></td>
                            <td><?php echo $artikl['Cijena'] ?></td>

                            <?php if($_SESSION['rola'] == 'Admin'){ ?>
                                <td><button class="btn btn-primary" onclick="artikli_izmjena(<?php echo $artikl['ArtikalId'] ?>)">Izmjeni</button></td>
                                <td><button class="btn btn-danger" onclick="artikli_brisanje(<?php echo $artikl['ArtikalId'] ?>)">Izbrisi</button></td>
                            <?php } ?>
                        </tr>
                        </tbody>
                    <?php
                    }
                ?>
            </table>
        </div>
    </div>
    <script>
        function artikli_izmjena(id) {
            window.location.href = "artikli_izmjena.php?id=" + id;
        }

        function artikli_brisanje(idArtikla) {
            if (confirm("Jeste li sigurni da želite izbrisati artikal?")) {
                $.ajax({
                    url: 'artikli_brisanje.php',
                    method: 'POST',
                    data: {
                        id: idArtikla
                    },
                    success: function (response) {
                        if (response.success) {
                           location.reload();
                        } else {
                            if (response.error) {
                                alert('Došlo je do greške prilikom brisanja lagera: ' + response.error);
                           } else {
                                location.reload();
                           }
                    },
                    error: function () {
                        alert('Došlo je do greške prilikom brisanja artikla.');
                    }
                });
            }
        }
    </script>

</body>
</html>