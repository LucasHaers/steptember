<?php
include "sessie.php";
include "gebruiker.php";
include "stappen.php";

$sessie = Sessie::vindActieveSessie();

if (!$sessie) {
    header("Location: index.php");
    exit();
}

$gebruiker = Gebruiker::vindGebruikerOpID($sessie->userID);

if (!$gebruiker) {
    header("Location: index.php");
    exit();
}

$stappen = Stap::vindStappen($gebruiker->id);

$total_steps = 0;
foreach ($stappen as $stap) {
    $total_steps += $stap->steps;
}
$average_steps = count($stappen) > 0 ? $total_steps / count($stappen) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Steps Overview</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Welkom, <?php echo $gebruiker->firstname . ' ' . $gebruiker->lastname; ?></h1>
        <div class="card mt-4">
            <div class="card-header">Jouw stappen</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Stappen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stappen as $stap): ?>
                        <tr>
                            <td><?php echo $stap->date; ?></td>
                            <td><?php echo $stap->steps; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center mt-3">
            <p>Totaal aantal stappen: <strong><?php echo $total_steps; ?></strong></p>
            <p>Gemiddeld aantal stappen per dag: <strong><?php echo round($average_steps, 2); ?></strong></p>
        </div>
    </div>
</body>
</html>



