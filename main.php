<!-- A questa pagina si può accedere solo mettendo come USERNAME: main e PASSWORD: main
è una pagina dove si possono visualizzare i messaggi inviati dagli utenti nell apagina contactus e creare un nuovo post -->
<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>mhw1-main</title>
    <link rel="stylesheet" href="./style/home.css" />
    <script src="./scripts/load_main.js" defer="true"></script>
    <script src="./scripts/main.js" defer="true"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100&family=Roboto:wght@100&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <nav>
          <div id="logo">
            Watch blog
          </div>
          <div id="benvenuto">
             Ciao Alessandro
           </div>
          <div id="links">
            <a href="new_post.php">Inserisci post</a>
            <a href="logout.php">Logout</a>
          </div>
        </nav>
    </header>
    
    <section>
      <div id="main">
      </div>
      
    </section>

</body>
</html>