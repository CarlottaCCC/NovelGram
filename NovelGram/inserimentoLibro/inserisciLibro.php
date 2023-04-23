<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento libro nella bdd</title>


</head>
<body>

<?php

    $dbconn = pg_connect("host=localhost user=username password=password 
     port=5432 dbname=novelgram")
     or die('Errore di connessione: ' . pg_last_error());

     if ($dbconn) {

        session_start();

        $titolo = $_POST["inputTitolo"];
        $testo = file_get_contents($_POST["inputFile"]);
        $like = 0;
        $trama = $_POST["inputTrama"];

        if (isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        }
       
        
        $query2 = "insert into libro values ($1,$2,$3,$4,$5)";
        $result = pg_query_params($dbconn, $query2, array($titolo,$testo,$like,$trama,$email));
        if ($result) {
            echo "Il tuo libro è stato inserito correttamente nel database!";
        }
        else {
            "Qualcosa è andato storto";
        }

        pg_close($dbconn);
     }



?>
    
</body>
</html>