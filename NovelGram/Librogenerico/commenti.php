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

    $query = "select com.titolo,com.email,com.testocomm,u.username
    from commento com join utente u on com.email = u.email
    where com.titolo = $1";
    $result = pg_query_params($dbconn, $query, array($_GET['titolo']));

    while ($line = pg_fetch_array($result)) :?>

        <div class="coment-bottom bg-white p-2 px-4">
                    <div class="d-flex flex-row add-comment-section mt-4 mb-4"><img class="img-fluid img-responsive rounded-circle mr-2" src="../icona.png" width="38"></div>
                    <div class="commented-section mt-2">
                        <div class="d-flex flex-row align-items-center commented-user">
                        <h5 class="mr-2"><?php echo $line['username']; ?></h5><span class="dot mb-1"></span></div>
                        <div class="comment-text-sm"><span><?php echo $line['testocomm']; ?></span></div>
                    </div>
        </div>

    <?php endwhile; 
    endif; ?>




</body>
</html>