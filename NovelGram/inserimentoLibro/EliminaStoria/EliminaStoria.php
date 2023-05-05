<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elimina Storia</title>
</head>
<body>

<?php



session_start();


if (!isset($_GET['titolo'])){
    header('location: home.php');
}

else if (isset($_GET['titolo'])){
    $dbconn = pg_connect("host=localhost user=username password=password 
    port=5432 dbname=novelgram")
    or die('Errore di connessione: ' . pg_last_error());

    $query = "delete from libro where titolo=$1";
    $result = pg_query_params($dbconn, $query, array($_GET['titolo']));
    if ($result) {
    $query = "delete from commento where titolo=$1";
    $result = pg_query_params($dbconn, $query, array($_GET['titolo']));
    if ($result) {
        
        echo "Eliminazione della storia ".$_GET['titolo']." avvenuta con successo <br> Torna al tuo 
        <a href=../../profilo/paginaprofilo.php>profilo</a>";

        $q2 = "delete from likes where titolo = $1";
        $result = pg_query_params($dbconn, $q2, array($_GET['titolo']));
        if (!$result) {
            echo "Errore eliminazione riga dalla tabella likes";
        }


        
    }
    else {
        echo "Ops...qualcosa è andato storto<br>
        torna al tuo <a href=../paginaprofilo.php>profilo</a>";
    }
    }
    else {
        echo "Ops...qualcosa è andato storto<br>
        torna al tuo <a href=../paginaprofilo.php>profilo</a>";
    }
}

?>
    
</body>
</html>