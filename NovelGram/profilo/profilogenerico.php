<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">

    <title>Pagina Profilo</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="../home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/login/login.html">Accedi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/signin/registrazione.html">Non hai un account? Registrati!</a>
            </li>
          </ul>

             <!-- <br>


              <form class="form-inline my-2 my-lg-0" method = "POST" name = "InputTitolo">
              <input class="form-control mr-sm-2" type="search" placeholder="Cerca Titolo" aria-label="Search" name = "InputTitolo">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search-heart" viewBox="0 0 16 16">
                <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018Z"/>
                <path d="M13 6.5a6.471 6.471 0 0 1-1.258 3.844c.04.03.078.062.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1.007 1.007 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5ZM6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11Z"/>
              </svg>Cerca</button>
              </form> -->
        </div>
      </nav>

      <?php

       /*session_start();

       $autore = $_SESSION["AutoreCercato"];*/

       if (!isset($_GET['autore'])){
        header('location: home.php');
    }

    else if (isset($_GET['autore'])){
        $autore = $_GET['autore'];
    }
       ?>

      <header class = "head-banner text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1><?php echo "Pagina profilo di ".$autore; ?></h1>
                    <p class="lead text-muted">Descrizione</p>
                </div>
            </div>
        </div>
       <br>

       <br>
       <section>
       <h1 style = "color:#848484">Storie pubblicate</h1>
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

<div class="card">
  <div class="card-body">
    <h5 class="card-title" style = "color:black"><?php echo $titolo; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo "by ".$line['username']?></h6>
    <p class="card-text" style = "color:black"><?php echo $line['trama']?></p>
    <?php echo "<a href='../Librogenerico/libro.php?titolo=$titolo' class='btn btn-primary'>Leggi</a>";?>
  </div>
</div>
  
        <?php 
         endwhile; 
         pg_close($dbconn); 

        ?>


    
</section>

  
  
</div>

      </header>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>