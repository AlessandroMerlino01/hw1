<?php 

    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }

    require_once 'dbconfig.php';
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name'])or die(mysqli_error($conn));
    if (!empty($_POST["foto"]) && !empty($_POST["titolo"]) && !empty($_POST["descrizione"]))
    {
        // Preparazione 
        $foto = mysqli_real_escape_string($conn, $_POST['foto']);
        $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
        $descrizione = mysqli_real_escape_string($conn, $_POST['descrizione']);
        // inserimento nel DB
        $query = "INSERT INTO contenents(foto, titolo, descrizione) VALUES('$foto', '$titolo', '$descrizione')";
        mysqli_query($conn, $query);
        header("Location: main.php");
        mysqli_close($conn);
        exit;
    }
    else if (isset($_POST["foto"]) || isset($_POST["titolo"]) || isset($_POST["descrizione"])) {
        $error1 = "Inserisci tutti i campi";
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
                    Benvenuto ALessandro
               </div>
              <div id="links">
                <a href="main.php">Home</a>
                <a href="logout.php">Log out</a>
              </div>
            </nav>
        <main class= "login">
            <section>
                <h1>Inserisci tutti </br>i campi</h1>
                <form name='new_post' method='post'>
                    <div class="immagine">
                        <div><label for='foto'>Foto</label></div>
                        <div><input type='text' name='foto' value="./images/"></div>
                    </div>
                    <div class="testo">
                        <div><label for='titolo'>Titolo</label></div>
                        <div><input type='text' name='titolo'></div>
                    </div>
                    <div class="testo">
                        <div><label for='descrizione'>Descrizione</label></div>
                        <div><input type='text' name='descrizione'></div>
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