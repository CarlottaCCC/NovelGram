<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Libro</title>
</head>
<body>
    <a href="../home.php">Torna alla Home</a>

    <?php

    if (!isset($_GET['titolo'])){
        header('location: home.php');
    }

    else if (isset($_GET['titolo'])){
        echo "<h1>".$_GET['titolo']."</h1>";
    }

    $dbconn = pg_connect("host=localhost user=username password=password 
    port=5432 dbname=novelgram")
    or die('Errore di connessione: ' . pg_last_error());

    $query = "select * from libro where titolo = $1";
    $result = pg_query_params($dbconn, $query, array($_GET['titolo']));
    if (($line = pg_fetch_array($result))) {

        echo $line['testo'];
    }
    ?>

    <br>
    <br>
    <br>

    <?php session_start();
    if (isset($_SESSION["username"])) :
    ?>

    <form method="POST" action="commenti.php">
    <button type="button" class="btn btn-sm btn-outline-secondary">Commenta!</button>
    </form>

    <?php endif; ?>

    <form method="POST" action="commenti.php">
    <button type="button" class="btn btn-sm btn-outline-secondary">Visualizza i commenti</button>
    </form>




</body>
<html>