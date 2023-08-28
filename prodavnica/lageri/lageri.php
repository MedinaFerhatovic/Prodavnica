<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>LAGERI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../artikli/style.css">
</head>
<body>
    <div class="content-menu-container">
        <?php include('../menu/menu.html'); ?>

        <div>
            <?php session_start(); ?>
            <?php if($_SESSION['rola'] == 'Admin'){ ?>
                    <a href="dodaj_lagere.php" class="btn btn-primary" id="dugme">Dodaj nove lagere</a>
            <?php } ?>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                    <th scope="col">Sifra artikla</th>
                    <th scope="col">Naziv artikla</th>
                    <th  scope="col">Raspoloziva kolicina</th>
                    <th  scope="col">Lokacija</th>
                    <?php 
                    if($_SESSION['rola'] == 'Admin'){
                        echo "<th></th>";
                        echo "<th></th>";
                    }?>
                </tr>
                </thead>
                <?php 
                    $conn = new mysqli("localhost", "root", "", "projekat");
                    $query = "SELECT * 
                     FROM `lageri` as `l`
                     LEFT JOIN `artikli` as `a` ON `l`.ArtikalId = `a`.ArtikalId";
                    $res = $conn->query($query);

                    while ($artikl = $res->fetch_assoc()) {
                    ?>
                    <tbody>
                       <tr>
                            <input type="hidden" value="<?php echo $artikl['LagerId'] ?>">
                            <td><?php echo $artikl['Sifra'] ?></td>
                            <td><?php echo $artikl['Naziv'] ?></td>
                            <td><?php echo $artikl['RaspolozivaKolicina'] ?></td>
                            <td><?php echo $artikl['Lokacija'] ?></td>


                            <?php if($_SESSION['rola'] == 'Admin'){ ?>
                                <td><button class="btn btn-primary" onclick="lageri_izmjena(<?php echo $artikl['LagerId'] ?>)">Izmjeni</button></td>
                                <td><button class="btn btn-danger" onclick="lageri_brisanje(<?php echo $artikl['LagerId'] ?>)">Izbrisi</button></td>
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
        function lageri_izmjena(id) {
            window.location.href = "lageri_izmjena.php?id=" + id;
        }

        function lageri_brisanje(idLagera) {
            if (confirm("Jeste li sigurni da želite izbrisati lager?")) {
                $.ajax({
                    url: 'lageri_brisanje.php',
                    method: 'POST',
                    data: {
                        id: idLagera
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
    }
                    },
                    error: function () {
                        alert('Došlo je do greške prilikom brisanja lagera.');
                    }
                });
            }
        }
    </script>

</body>
</html>