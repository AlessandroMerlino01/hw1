<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
<?php 
         require_once 'dbconfig.php';
        // Carico le informazioni dell'utente loggato
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query1 = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query1);
        $userinfo = mysqli_fetch_assoc($res_1);    
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>mhw1-preferiti</title>
    <link rel="stylesheet" href="./style/home.css" />
    <script src="./scripts/load_preferiti.js" defer="true"></script>
    <script src="./scripts/preferiti.js" defer="true"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100&family=Roboto:wght@100&display=swap" rel="stylesheet">

</head>
<body>
    <header>
        <nav>
          <div id="logo">
            Watch blog
          </div>
          <div id="benvenuto">
             <?php 
                echo "Benvenuto ". $userinfo['username'];
                ?>
           </div>
          <div id="links">
            <a href="home.php">Home</a>
            <a href="logout.php">Logout</a>
          </div>
        </nav>
    </header>
    
    <section>
      <div id="main">
        <h1>Non hai post preferiti</h1>
      </div> 
    </section>

    <footer>
      <p>Contatti: <br>
        info.watchblog@watchblog.com<br>
        +39 123 4567890<br>
        Alessandro Merlino 1000001212</p>
    </footer>
</body>
</html>