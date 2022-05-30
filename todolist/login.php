<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    require('config.php'); // Accède à la page config.php pour obtenir les informations d'identification
    session_start();

    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $query = "SELECT * FROM `connexion` WHERE username='$username' and password='" . hash('sha256', $password) . "'"; // vérifier et sélectionner dans la BDD l'username et le mdp associé et crée une clé de hachage pour le mot de passe 
        $result = mysqli_query($conn, $query) or die(mysql_error()); 
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Si l'username est correct, accès à la page index.php
        } else {
            $message = "Le nom d'utilisateur ou le mot de passe est incorrect."; // Si non, un message d'erreur s'affiche
        }
    }
    ?>
    <form class="box" action="" method="post" name="login">
        <h1 class="box-logo box-title">MyToTool</h1>
        <h1 class="box-title">Connexion</h1>
        <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur">
        <input type="password" class="box-input" name="password" placeholder="Mot de passe">
        <input type="submit" value="Connexion " name="submit" class="box-button">
        <p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
        <?php if (!empty($message)) { ?>
            <p class="errorMessage"><?php echo $message; ?></p>
        <?php } ?>
    </form>
</body>

</html>