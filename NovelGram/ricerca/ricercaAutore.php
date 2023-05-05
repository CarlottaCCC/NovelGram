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
    $dbconn = pg_connect("host=localhost user=username password=password 
    port=5432 dbname=novelgram")
    or die('Errore di connessione: ' . pg_last_error());


   $autore = $_POST["InputAutore"];
   $query = "select * from utente where username = $1";
   $result = pg_query_params($dbconn, $query, array($autore));
   if (!($line = pg_fetch_array($result))) {
    echo "Mh...Non abbiamo trovato niente.";
   }
   else {
    session_start();
    $username = $line["username"];
    echo "Cercavi questo?
    <a href = ../profilo/profilogenerico.php?autore=$username>".$line["username"]."</a>";
   }

    pg_close($dbconn); 




?>
    
</body>
</html>