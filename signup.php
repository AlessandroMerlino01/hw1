<?php
    require_once 'dbconfig.php';
    require_once 'auth.php';

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    }   

    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["name"]) && 
    !empty($_POST["surname"]) && !empty($_POST["confirm_password"]) && !empty($_POST["allow"]))
    {
        $error = array();
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $_POST['username'])) {
            $error[] = "Username non valido";
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Username già utilizzato";
            }
        }

        if (strlen($_POST["password"]) < 8 ) {
            $error[] = "Caratteri password insufficienti";
        } 

        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Le password non coincidono";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già utilizzata";
            }
        }

        if (count($error) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $surname = mysqli_real_escape_string($conn, $_POST['surname']);

            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $password = password_hash($password, PASSWORD_BCRYPT); //cripta la password

            $query = "INSERT INTO users(username, password, name, surname, email) VALUES('$username', '$password', '$name', '$surname', '$email')";
            
            if (mysqli_query($conn, $query)) {
                $_SESSION["hw1_username"] = $_POST["username"];
                $_SESSION["hw1_user_id"] = mysqli_insert_id($conn);
                mysqli_close($conn);
                header("Location: home.php");
                exit;
            } else {
                $error[] = "Errore di connessione al Database";
            }
        }

        mysqli_close($conn);
    }
?>

<html>
    <head>
        <link rel='stylesheet' href='./style/signup.css'>
        <script src='./scripts/signup.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>hw1-signup</title>
    </head>
    <body>
        <main>
        <section>
            <h1>Inserisci i tuoi dati</h1>
            <form name='signup' method='post' enctype="multipart/form-data" autocomplete="off">
                <div class="names">
                    <div class="name">
                        <div><label for='name'>Nome</label></div>
                        <div><input type='text' name='name' placeholder='-Mario' ></div>
                        <span>Campo obligatorio</span> 
                    </div>
                    <div class="surname">
                        <div><label for='surname'>Cognome</label></div>
                        <div><input type='text' name='surname' placeholder='-Rossi' ></div>
                        <span>Campo obligatorio</span>
                    </div>
                </div>
                <div class="username">
                    <div><label for='username'>Nome utente</label></div>
                    <div><input type='text' name='username' placeholder='-supermariobross99'></div>
                    <span>aaaaaaaaaaaaaaaaa</span> <!-- così ho lo pazio nella pagina -->
                </div>
                <div class="email">
                    <div><label for='email'>Email</label></div>
                    <div><input type='text' name='email' placeholder='-supermario@gmail.com'></div>
                    <span>aaaaaaaaaaaaaaaaa</span>
                </div>
                <div class="password">
                    <div><label for='password'>Password</label></div>
                    <div><input type='password' name='password'></div>
                    <span>Devono esserci numeri simboli e lettere maiuscole. Min 8</span>
                </div>
                <div class="confirm_password">
                    <div><label for='confirm_password'>Conferma Password</label></div>
                    <div><input type='password' name='confirm_password'></div>
                    <span>Le password non coincidono</span>
                </div>
                <div class="allow"> 
                    <div><input type='checkbox' name='allow' value="1"></div>
                    <div><label for='allow'>Acconsento al trattamento dei dati personali</label></div>
                </div>
                <div class="submit">
                    <input type='submit' value="Registrati" id="submit" disabled>
                </div>
            </form>
            <div class="signup">Hai già creato un account? <a href="login.php">Accedi</a>
        </section>
        </main>
    </body>
</html>