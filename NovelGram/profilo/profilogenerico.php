<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Pagina Profilo</title>
    
</head>
<body>

<a href="../home.php">Torna alla Home</a>
       <br>

       <?php

       session_start();

       $autore = $_SESSION["AutoreCercato"];
       ?>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light"><?php echo "Pagina Profilo di ".$autore?></h1>
        <p class="lead text-muted">Descrizione</p>
</section>

<?php


        $dbconn = pg_connect("host=localhost user=username password=password 
        port=5432 dbname=novelgram")
        or die('Errore di connessione: ' . pg_last_error());

        $query = "select u.username,l.titolo,l.testo,l.trama,l.mipiace
        from libro l join utente u on l.email = u.email
        where u.username= $1";

        $result = pg_query_params($dbconn,$query,array($autore));

        while ($line = pg_fetch_array($result)) : 
          $titolo = $line["titolo"]; ?>

            <div class="card-body">
                <p class="card-text"><?php echo "<a href='../Librogenerico/libro.php?titolo=$titolo'>".$titolo."</a>"?></p>
                <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Leggi</button>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card shadow-sm">
              <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#55595c"></rect>
              <text y = 10% fill="#eceeef" dy=".3em"><?php echo $line["trama"]; ?></text>
              </svg>
  
        <?php 
         endwhile; 
         pg_close($dbconn); 

        ?>


    
</body>
</html>