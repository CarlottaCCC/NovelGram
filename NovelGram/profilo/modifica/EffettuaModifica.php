<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica libro nella bdd</title>


</head>
<body>
<!-- PROBLEMA ---- quando modifico il testo si cancella tutto.RISOLUZIONE, ELIMINARE STORIA E SOSTITUIRLA CON NUOVO FILE!-->
<?php

    $dbconn = pg_connect("host=localhost user=username password=password 
     port=5432 dbname=novelgram")
     or die('Errore di connessione: ' . pg_last_error());

     if ($dbconn) {

        session_start();

        $titolo = $_GET["titolo"];
        /*$testo = file_get_contents($_POST["inputFile"]);*/


        $handler = fopen($_POST['inputFile'], "r");
        
     
        if (false !== $handler) {
            while (false !== ($buffer = fgets($handler, 1000))) {
                
                $testo = $testo.$buffer."<br>";
            }
            if (!feof($handler)) {
                echo "Errore nella lettura tramite fgets()\n";
            }
            fclose($handler);
        }
        


           
        

        if (isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        }
       
        
        $query2 = "update libro set testo = $2 where titolo = $1";
        $result = pg_query_params($dbconn, $query2, array($titolo,$testo));
        if ($result) {
            echo "Il tuo libro è stato Modificato correttamente nel database! <a href='../paginaprofilo.php'>Torna al Profilo</a>";
        }
        else {
            echo "Qualcosa è andato storto <a href='../../home.php'>Torna alla Home</a>";
        }

        pg_close($dbconn);
     }
       
     



?>
    
</body>
</html>