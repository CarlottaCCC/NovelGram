<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimina Profilo</title>
</head>
<body>

<?php

session_start();

$dbconn = pg_connect("host=localhost user=username password=password 
        port=5432 dbname=novelgram")
        or die('Errore di connessione: ' . pg_last_error());

        $query = "delete from utente where email = $1";
        $result = pg_query_params($dbconn,$query,array($_GET["email"]));

        if ($result) {
            session_unset();
            echo "Eliminazione avvenuta con successo."."<br>"."Torna alla
            <a href='../../home.php'>Home</a>";
        }

            else {
                echo "Ops... qualcosa è andato storto"."<br>"."Torna al tuo
                <a href=../paginaprofilo.php>profilo</a>";
            }


?>
    
</body>
</html>