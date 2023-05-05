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
          </div>
      </nav>

       <?php

       session_start();

        if (!isset($_SESSION["username"])) {
          echo "Per accedere al tuo profilo fai login 
          <a href=../login/login.html>qui</a>";
        }

        else if (isset($_SESSION["username"])): 
        $username = $_SESSION['username']; ?>

<header class = "head-banner text-white text-center">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1><?php echo "Pagina profilo di ".$_SESSION["username"]; ?></h1>

                </div>
            </div>
        </div>

              
       <br>

       <br>

       <p>
          <a href="../inserimentoLibro/inserisciLibro.html" class="btn btn-primary my-2" style="color:black">Inserisci un Libro</a>
        </p>

       <section>
       <h1 style = "color:#848484">Storie pubblicate</h1>
      </section>


  <!-- <div class="album py-5 bg-light">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="75%" height="100" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
            <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Trama</text></svg>
      -->


        <?php


        $dbconn = pg_connect("host=localhost user=username password=password 
        port=5432 dbname=novelgram")
        or die('Errore di connessione: ' . pg_last_error());

        $mail = $_SESSION["email"];
        $user = $_SESSION["username"];

        $query = "select l.email,u.username,l.titolo,l.testo,l.trama,l.mipiace
        from libro l join utente u on l.email = u.email
        where l.email = $1 and u.username= $2";

        $result = pg_query_params($dbconn,$query,array($mail,$user));

        while ($line = pg_fetch_array($result)) : 
          $titolo = $line["titolo"];
          $trama = $line["trama"];
          ?>
              


        <div class="card">
          <div class="card-body">
          <h5 class="card-title" style = "color:black"><?php echo $titolo; ?></h5>
          <h6 class="card-subtitle mb-2 text-muted"><?php echo "by ".$line['username']?></h6>
       <p class="card-text" style = "color:black"><?php echo $line['trama']?></p>
    <?php echo "<a href='../Librogenerico/libro.php?titolo=$titolo' class='btn btn-primary'>Leggi</a>";?>
    <?php echo "<a href='../inserimentoLibro/ModificaStoria.php?titolo=$titolo&trama=$trama' class='btn btn-primary'>Modifica</a>";?>
    <?php echo "<a href='EliminaStoria/EliminaStoria.php?titolo=$titolo' class='btn btn-primary'>Elimina</a>";?>
  </div>
</div>
         

           
        <?php 
         endwhile; 
         pg_close($dbconn); 
         ?>

        </br>
        </br>
        </br>

        <?php echo "<a href = 'Disconnetti.php?email=$mail' style = 'color:black'>Disconnetti profilo</a>"; ?>
        <br>
        <?php echo "<a href='EliminaProfilo/EliminaProfilo.php?email=$mail' class='btn btn-primary my-2' style='color:black'>Elimina Profilo</a>"; ?>

         <?php endif; ?>

         </section>

  
  
</div>

      </header>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="jquery-3.6.4.min.js"></script> -->

    


        </body>
        </html>

