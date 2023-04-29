<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricerca autore e titolo</title>
</head>
<body>

<?php
session_start();

    $dbconn = pg_connect("host=localhost user=username password=password 
    port=5432 dbname=novelgram")
    or die('Errore di connessione: ' . pg_last_error());


   $titolo = $_POST["InputTitolo"];
   $query = "select * from libro where titolo = $1";
   $result = pg_query_params($dbconn, $query, array($titolo));
   if (!($line = pg_fetch_array($result))) {
    echo "Mh...Non abbiamo trovato niente.";
   }
   else {
    $_SESSION["TitoloCercato"] = $line["titolo"];
    echo "Cercavi questo?
    <a href = ../Librogenerico/libro.php >".$line["titolo"]."</a>";
   }

    pg_close($dbconn); 




?>
    
</body>
</html>