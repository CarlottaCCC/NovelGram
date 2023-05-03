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
    session_start();
    if (!isset($_GET['titolo'])){
        header('location: libro.php');
    }

    else if (isset($_GET['titolo'])) :
        

    $dbconn = pg_connect("host=localhost user=username password=password 
    port=5432 dbname=novelgram")
    or die('Errore di connessione: ' . pg_last_error());

    $query = "select mipiace
    from likes 
    where titolo = $1 and email = $2";
    $result = pg_query_params($dbconn, $query, array($_GET['titolo'],$_SESSION['email']));
    if($line = pg_fetch_array($result)) {
    
        $mipiace = $line["mipiace"];
        if($mipiace == 1) {
            /* caso deve diventa false*/
            $query = "update likes set mipiace=0
            where titolo = $1 and email = $2";
            $result = pg_query_params($dbconn, $query, array($_GET['titolo'],$_SESSION['email']));
            if($result) {


                $query = "update libro set mipiace=mipiace-1
            where titolo = $1";
            $result = pg_query_params($dbconn, $query, array($_GET['titolo']));
            if($result) {
            }


            }
            else {}





        }

    
        else {
/* caso deve diventa true*/
$query = "update likes set mipiace=1
where titolo = $1 and email = $2";
            $result = pg_query_params($dbconn, $query, array($_GET['titolo'],$_SESSION['email']));
            if($result) {
                $query = "update libro set mipiace=mipiace+1
                where titolo = $1";
                $result = pg_query_params($dbconn, $query, array($_GET['titolo']));
                if($result) {
                }
            }
            else {}






        }










    }
    else {
/* inserire true nel database (tutta la tupla)*/
$query = "insert into likes values($1,$2,$3)";
            $result = pg_query_params($dbconn, $query, array($_SESSION['email'],$_GET['titolo'],1));
            if($result) {

                $query = "update libro set mipiace=mipiace+1
                where titolo = $1";
                $result = pg_query_params($dbconn, $query, array($_GET['titolo']));
                if($result) {
                }
                
            }
            else {}

    }

    










pg_close($dbconn);
    endif; ?>




</body>
</html>