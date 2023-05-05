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
if (!isset($_GET['email'])){
    header('location: home.php');
}

$dbconn = pg_connect("host=localhost user=username password=password 
        port=5432 dbname=novelgram")
        or die('Errore di connessione: ' . pg_last_error());

        $q2 = "select titolo from likes 
            where email = $1 and mipiace = 1";
            $result = pg_query_params($dbconn,$q2,array($_GET["email"]));
            
            while (($line = pg_fetch_array($result))) {
                $titolo = $line['titolo'];

                $q3 = "update libro set mipiace = mipiace-1 where titolo = $1";
                $result1 = pg_query_params($dbconn,$q3,array($titolo));


            }

            /*Eliminazione riga dalla tabella likes */

            $q4 = "delete from likes where email = $1";
            $result = pg_query_params($dbconn,$q4,array($_GET["email"]));

            if (!$result){
                echo "Errore eliminazione dalla tabella likes";
            }

            /*Eliminazione dei commenti */
            $q6 = "delete from commento where email = $1";
            $result = pg_query_params($dbconn,$q6,array($_GET["email"]));
            if (!$result){
               echo "Errore eliminazione dei commenti";
            }

            /*Eliminazione delle storie pubblicate */

            $q5 = "delete from libro where email = $1";
            $result = pg_query_params($dbconn,$q5,array($_GET["email"]));
            if (!$result){
                echo "Errore eliminazione dei libri";
            }


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