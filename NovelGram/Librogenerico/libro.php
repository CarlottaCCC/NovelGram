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

    session_start();

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
        $titolo = $line["titolo"];
    }

    ?>

    <br>
    <br>
    <br>

   
    <?php

if (isset($_SESSION['email'])) {
   
     echo "<form name='myForm' action='scriviCommento.php?titolo=$titolo' method='POST'> 
        <h1>Inserisci il tuo commento!</h1>
        <div class='form-group'>
            <label for='inputCommento'>Commento</label>
            <input type='text' class='form-control' name='inputCommento' id='inputCommento' placeholder='Scrivere un commento'>
          </div>
        <button type='submit' class='btn btn-primary'>Invia!</button>
      </form>";


  echo  "<a href='commenti.php?titolo=$titolo'>Visualizza i commenti qui </a> ";
}

?>


</body>
<html>