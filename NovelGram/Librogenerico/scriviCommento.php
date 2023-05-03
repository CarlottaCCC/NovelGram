<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserimento commento nella base di dati</title>


</head>
<body>

<?php
if (!isset($_GET['titolo'])){
    header('location: home.php');
}

else if (isset($_GET['titolo'])){
    echo "<h1>".$_GET['titolo']."</h1>";
}
$titolo = $_GET['titolo'];
    $dbconn = pg_connect("host=localhost user=username password=password 
     port=5432 dbname=novelgram")
     or die('Errore di connessione: ' . pg_last_error());

     if ($dbconn) {

        session_start();

        $commento = $_POST["inputCommento"];
        /*$testo = file_get_contents($_POST["inputFile"]);*/
        

        if (isset($_SESSION["email"])){
        $email = $_SESSION["email"];
        }

        if(empty($commento)) {
            echo "Non puoi Inserire un commento vuoto!!! <a href='../home.php'>Torna alla Home</a>"; 
            pg_close($dbconn);
        }
       
        
        $query2 = "insert into commento values ($1,$2,$3)";
        $result = pg_query_params($dbconn, $query2, array($email,$titolo,$commento));
        if ($result) {
            echo "Il tuo commento è stato inserito correttamente nel database! <a href='libro.php?titolo=$titolo'>Torna alla Storia</a>";
        }
        else {
            echo "Qualcosa è andato storto!!! <a href='../home.php'>Torna alla Home</a>";
        }

        pg_close($dbconn);
     }



?>
    
</body>
</html>