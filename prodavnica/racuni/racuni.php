<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Dodavanje na racun</title>
</head>
<body>
    <h1>Dodavanje na račun</h1>
    
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Sifra</th>
                <th scope="col">Naziv</th>
                <th scope="col">Cijena</th>
                <th scope="col">Dodaj na račun</th> 
            </tr>
        </thead>
        <tbody> 
            <?php 
                $conn = new mysqli("localhost", "root", "", "projekat");
                $query = "SELECT * FROM `artikli`";
                $res = $conn->query($query);

                while ($artikl = $res->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $artikl['Sifra'] ?></td>
                <td><?php echo $artikl['Naziv'] ?></td>
                <td><?php echo $artikl['Cijena'] ?></td>
                <td>
                    <button class="btn btn-success" onclick="dodajNaRacun(<?php echo $artikl['ArtikalId'] ?>)">Dodaj na račun</button>
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    
    <div id="racun">
    <h2>Stavke na računu</h2>
    <ul id="stavke-lista"></ul>
    <p>Ukupna cijena: <span id="ukupna-cijena">0</span></p>
    </div>

    <button id="zavrsiBtn" class="btn btn-success" onclick="zavrsiRacun()">Završi račun</button>

    <script>
        
    var ukupnaCijena = 0;
    var stavkeNaRacunu = []; 
    function dodajNaRacun(artikalId) {
    $.ajax({
        type: "POST",
        url: "dodaj_na_racun_request.php",
        data: { artikalId: artikalId },
        success: function(response) {
            var data = JSON.parse(response);

            if (data.naziv && data.cijena) {
                var postojiStavka = false;

                for (var i = 0; i < stavkeNaRacunu.length; i++) {
                    if (stavkeNaRacunu[i].artikalId === artikalId) {
                        stavkeNaRacunu[i].kolicina++;
                        stavkeNaRacunu[i].ukupnaCijena += parseFloat(data.cijena);
                        postojiStavka = true;
                        break;
                    }
                }

                if (!postojiStavka) {
                    stavkeNaRacunu.push({
                        artikalId: artikalId,
                        naziv: data.naziv,
                        cijena: parseFloat(data.cijena),
                        kolicina: 1,
                        ukupnaCijena: parseFloat(data.cijena)
                    });
                }

                azurirajPrikazStavki();
            } else {
                console.log("Artikal sa ID " + artikalId + " nije pronađen.");
            }
        },
        error: function(xhr, status, error) {
            console.error(error); 
        }
    });
}
function azurirajPrikazStavki() {
    $("#stavke-lista").empty();

    for (var i = 0; i < stavkeNaRacunu.length; i++) {
        var stavka = stavkeNaRacunu[i];
        var prikaz = stavka.naziv + " - " + stavka.kolicina + "x " + stavka.cijena.toFixed(2) + " KM";
        $("#stavke-lista").append("<li>" + prikaz + "</li>");
    }

    ukupnaCijena = 0;
    for (var i = 0; i < stavkeNaRacunu.length; i++) {
        ukupnaCijena += stavkeNaRacunu[i].ukupnaCijena;
    }
    $("#ukupna-cijena").text(ukupnaCijena.toFixed(2) + " KM");
}



    function zavrsiRacun() {
    var imeOsobe = "Medina"; 
    var datumVrijeme = new Date().toLocaleString();
    var stavke = [];

    $("#stavke-lista li").each(function() {
        stavke.push($(this).text());
    });

    var ukupnaCijenaTekst = $("#ukupna-cijena").text();

    var url = "racun.php?" +
              "ime=" + encodeURIComponent(imeOsobe) +
              "&datum=" + encodeURIComponent(datumVrijeme) +
              "&stavke=" + encodeURIComponent(stavke.join("\n")) +
              "&ukupnaCijena=" + encodeURIComponent(ukupnaCijenaTekst);

    window.location.href = url;
}

</script>


</body>
</html>
