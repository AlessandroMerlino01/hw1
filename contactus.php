<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
    require_once 'dbconfig.php';
    // Carico le informazioni dell'utente loggato
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name'])or die(mysqli_error($conn));
        $userid = mysqli_real_escape_string($conn, $userid);
        $query1 = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query1);
        $userinfo = mysqli_fetch_assoc($res_1); 
    if (!empty($_POST["email"]) && !empty($_POST["testo"]))
    {
     
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $testo = mysqli_real_escape_string($conn, $_POST['testo']);
    
        $query = "INSERT INTO contactus(email, testo) VALUES('$email', '$testo')";
        mysqli_query($conn, $query);
        header("Location: home.php");
        mysqli_close($conn);
        exit;
    }
    else if (isset($_POST["email"]) || isset($_POST["testo"])) {
        $error1 = "Inserisci un' email valida e il testo";
    }
?>

<html>
    <head>
        <link rel='stylesheet' href='./style/signup.css'>
        <link rel='stylesheet' href='./style/contactus.css'>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Poppins:wght@100&family=Roboto:wght@100&display=swap" rel="stylesheet">

        <title>hw1-contactus</title>
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
        <main class= "login">
            <section>
                <h1>Lavora con noi</h1>
                <form name='contactus' method='post'>
                    <div class="email">
                        <div><label for='email'>email</label></div>
                        <div><input type='text' name='email' <?php echo "value=".$userinfo['email']; ?>></div>
                    </div>
                    <div class="testo">
                        <div><label for='testo'>Testo</label></div>
                        <div><input type='text' name='testo'></div>
                    </div>
                    <div>
                        <input type='submit' value="Invia">
                    </div>
                    <div>
                        <?php
                            if (isset($error1)) {
                                echo "<span class='error'>$error1</span>";
                            }

                        ?>
                    </div>
                </form>
            </section>
        </main>
    </body>
</html>