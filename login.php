<?php
    require_once 'dbconfig.php';
    include 'auth.php';
    if (checkAuth()) {
        header('Location: home.php');
        exit;
    }
    if (!empty($_POST["username"]) && !empty($_POST["password"]) )
    {
        
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        //non impedisco in signup.php di mettere queste credenziali perchè non si può mettere una password così
       //reindirizza ad una pagina che fa visualizzare i messaggi inviati con contact us
        if($_POST['username'] == 'main' && $_POST['password'] == 'main'){ 
            $query = "SELECT id, username, password FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
            $entry = mysqli_fetch_assoc($res);

            $_SESSION["hw1_username"] = $entry['username'];
            $_SESSION["hw1_user_id"] = $entry['id'];
            
               header("Location: main.php");
               exit;
        }
        $query = "SELECT id, username, password FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($res) > 0) {
            $entry = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $entry['password'])) {

                $_SESSION["hw1_username"] = $entry['username'];
                $_SESSION["hw1_user_id"] = $entry['id'];
                
                header("Location: home.php");
                
                mysqli_free_result($res);
                mysqli_close($conn);
                exit;
            }
        }
        $error = "Username e/o password errati.";
    }
    else if (isset($_POST["username"]) || isset($_POST["password"])) { //altrimenti appena si apre la pagina compare l' errore
        $error = "Inserisci username e password.";
    }

?>


<html>
    <head>
        <link rel='stylesheet' href='./style/signup.css'>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>hw1-login</title>
    </head>
    <body>
        <main class="login">
        <section>
            <h1>Benvenuto!</h1>
            <form name='login' method='post'>
                <div class="username">
                    <div><label for='username'>Nome utente</label></div>
                    <div><input type='text' name='username'></div>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password'></div>
                </div>
                <div>
                    <input type='submit' value="Accedi">
                </div>
                <div>
                    <?php
                        if (isset($error)) {
                            echo "<span class='error'>$error</span>";
                        }

                    ?>
                </div>
            </form>
            <div class="signup">Non hai un account? <a href="signup.php">Iscriviti</a>
        </section>
        </main>
    </body>
</html>