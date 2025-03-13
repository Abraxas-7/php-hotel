<?php
$voteFilter = isset($_GET["vote"]) ? (int)$_GET["vote"] : 1;
$parkingFilter = isset($_GET["parking"]) ? true : false;

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Lista Hotels</title>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Lista Hotel</h1>

        <div class="mb-4">
            <form action="" method="get">
                <div class="row d-flex justify-content-center mb-3">
                    <label for="vote" class="col-sm-3 col-form-label">
                        Quante stelle deve avere l'hotel?
                    </label>
                    <div class="col-sm-1">
                        <input type="number" id="vote" class="form-control" min="1" max="5" name="vote" placeholder="1" value="<?= $voteFilter ?>">
                    </div>
                </div>

                <div class="row d-flex justify-content-center mb-3">
                    <label for="parking" class="col-sm-3 col-form-label">Deve avere un parcheggio?</label>
                    <div class="col-sm-1">
                        <input type="checkbox" id="parking" name="parking" <?= $parkingFilter ? 'checked' : '' ?>>
                        <label for="parking"> Si </label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Filtra</button>
                </div>
            </form>
        </div>

        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro (km)</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $found = false;

                foreach ($hotels as $hotel) {
                    if (!is_null($voteFilter) && $hotel['vote'] < $voteFilter) {
                        continue;
                    }
                    if ($parkingFilter && !$hotel['parking']) {
                        continue;
                    }

                    $found = true;
                    echo "<tr>";
                    echo "<td>" . $hotel['name'] . "</td>";
                    echo "<td>" . $hotel['description'] . "</td>";
                    echo "<td>" . ($hotel['parking'] ? '<span class="text-success">Sì</span>' : '<span class="text-danger">No</span>') . "</td>";

                    echo "<td>";
                    for ($i = 0; $i < $hotel['vote']; $i++) {
                        echo "<i class='fa-solid fa-star text-warning'></i> ";
                    }
                    echo "</td>";

                    echo "<td>" . $hotel['distance_to_center'] . " km</td>";
                    echo "</tr>";
                }

                if (!$found) {
                    echo "<tr><td colspan='5' class='text-danger'>Nessun hotel trovato con questi criteri.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>