<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Commenti</title>
</head>
<body>
    <?php 
    
    if (!isset($_GET['titolo'])){
        header('location: libro.php');
    }

    else if (isset($_GET['titolo'])) :
        

    $dbconn = pg_connect("host=localhost user=username password=password 
    port=5432 dbname=novelgram")
    or die('Errore di connessione: ' . pg_last_error());
    $mipiace = 0;
    $query = "select mipiace from libro where titolo=$1";
    $result = pg_query_params($dbconn, $query, array($_GET['titolo']));
if($result) {
    $line = pg_fetch_array($result);
    $mipiace= $line['mipiace'];
echo"Hey bello sono $mipiace mipiace hai capito? :D";
}
else {
    echo"Hey bello sono $mipiace mipiace hai capito? :D";
}


    endif; ?>




</body>
</html>