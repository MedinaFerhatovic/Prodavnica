<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>RADNICI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../artikli/style.css">
</head>
<body>
    <div class="content-menu-container">
        <?php include('../menu/menu.html'); ?>

        <div>
            <?php session_start(); ?>
            <?php if($_SESSION['rola'] == 'Admin'){ ?>
                    <a href="dodaj_radnike.php" class="btn btn-primary" id="dugme">Dodaj novog radnika</a>
            <?php } ?>
            <table class="table">
              <thead class="thead-dark">
                <tr>
                    <th scope="col">Ime</th>
                    <th scope="col">Prezime</th>
                    <th scope="col">Broj telefona</th>
                    <th scope="col">Adresa</th>
                    <th scope="col">Grad</th>
                    <th scope="col">Email</th>
                    <th scope="col">JMBG</th>
                    <?php 
                    if($_SESSION['rola'] == 'Admin'){
                        echo "<th></th>";
                        echo "<th></th>";
                    }?>
                </tr>
                </thead>
                <?php 
                    $conn = new mysqli("localhost", "root", "", "projekat");
                    $query = "SELECT * FROM `radnici`";
                    $res = $conn->query($query);

                    while ($radnik = $res->fetch_assoc()) {
                    ?>
                    <tbody>
                       <tr>
                            <input type="hidden" value="<?php echo $radnik['RadnikId'] ?>">
                            <td><?php echo $radnik['Ime'] ?></td>
                            <td><?php echo $radnik['Prezime'] ?></td>
                            <td><?php echo $radnik['BrojTelefona'] ?></td>
                            <td><?php echo $radnik['Adresa'] ?></td>
                            <td><?php echo $radnik['Grad'] ?></td>
                            <td><?php echo $radnik['Email'] ?></td>
                            <td><?php echo $radnik['JMBG'] ?></td>

                            <?php if($_SESSION['rola'] == 'Admin'){ ?>
                                <td><button class="btn btn-primary" onclick="radnik_izmjena(<?php echo $radnik['RadnikId'] ?>)">Izmjeni</button></td>
                                <td><button class="btn btn-danger" onclick="radnik_brisanje(<?php echo $radnik['RadnikId'] ?>)">Izbrisi</button></td>
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
        function radnik_izmjena(id) {
            window.location.href = "radnik_izmjena.php?id=" + id;
        }

        function radnik_brisanje(idRadnika) {
            if (confirm("Jeste li sigurni da želite izbrisati radnika?")) {
                $.ajax({
                    url: 'radnik_brisanje.php',
                    method: 'POST',
                    data: {
                        id: idRadnika
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
                        alert('Došlo je do greške prilikom brisanja radnika.');
                    }
                });
            }
        }
    </script>

</body>
</html>