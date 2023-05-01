<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Commenti</title>
</head>
<body>
    <?php 
    
    if (!isset($_GET['titolo'])){
        header('location: libro.php');
    }

    else if (isset($_GET['titolo'])){
        

    $dbconn = pg_connect("host=localhost user=username password=password 
    port=5432 dbname=novelgram")
    or die('Errore di connessione: ' . pg_last_error());

    $query = "select com.titolo,com.email,com.testocomm,u.username
    from commento com join utente u on com.email = u.email
    where com.titolo = $1";
    $result = pg_query_params($dbconn, $query, array($_GET['titolo']));

    while ($line = pg_fetch_array($result)) {
    
        echo $line['username'];
        echo "<br>";
        echo $line['testocomm'];
        echo "<br>";
        echo "<br>";
    }



    }


    ?>
</body>