<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prova visualizza libro</title>
</head>
<body>
    <h1>Prova visualizzazione libro</h1>

    <?php

    $dbconn = pg_connect("host=localhost user=username password=password 
    port=5432 dbname=novelgram")
    or die('Errore di connessione: ' . pg_last_error());

    $query = "select * from libro";
    $result = pg_query($dbconn,$query);

    while ($line = pg_fetch_array($result)) {
        echo "<h1>".$line["titolo"]."</h1>"."<br>"."<br>";
        echo $line["testo"];
    };


    ?>
    
</body>
</html>