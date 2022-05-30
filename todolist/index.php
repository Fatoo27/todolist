<?php
// Initialiser la session
session_start();
// Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}




$erreurs = "";
$db = new PDO('mysql:host=localhost;dbname=todolist', 'root', 'root');
if (isset($_POST['task'])) { // On vérifie que la variable POST existe
    if (empty($_POST['task'])) {  // On vérifie qu'elle a une valeure
        $erreurs = 'Vous devez indiquer la valeure de la tâche';
    } else {
        $tache = $_POST['task'];
        $user = $_SESSION['username'];
        $db->exec("INSERT INTO info(taches, Utilisateurs) VALUES('$tache','$user')"); // On insère la tâche dans la base de donnée
        // mysqli_query($db, $sql);
        // header('location: index.php');
    }
}

if (isset($_GET['supprimer_tache'])) {
    $id = $_GET['supprimer_tache'];
    $db->exec("DELETE FROM info WHERE id=$id");
}


?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List | MyToTool</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="sucess">
        <h1>Bienvenue <?php echo $_SESSION['username']; ?>!</h1>
        <a href="logout.php">Déconnexion</a>
        <p>C'est votre tableau de bord.</p>
        <main>
            <div class="container">
                <h1 class="app-title">MyToTool</h1>
                <h2 class="description">Inscrivez dans cette liste les tâches que vous ne voulez pas oublier !</h2>

                <form class="js-form" method="post" action="index.php">
                    <input autofocus type="text" aria-label="Enter a new todo item" name="task" placeholder="Safrio to the moon ... &#128640;" class="js-todo-input">
                    <button id="ajouter" name="ajouter" type="submit">Ajouter</button>
                </form>
                <?php if (isset($erreurs)) { ?>
                    <p><?php echo $erreurs; ?></p>
                <?php } ?>

                <ul class="todo-list js-todo-list" name="new-task"></ul>


                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 10%;">N</th>
                            <th style="width: 20%;">Utilisateurs</th>
                            <th style="width: 60%;">Tasks</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        // Sélectionner toutes les tâches si la page est visitée ou rafraichie
                        $tasks = $db->query('SELECT * FROM info');
                        while ($row = $tasks->fetch()) {
                        ?>
                            <tr>
                                <td class="task"> <?php echo $row['id']; ?> </td>
                                <td class="user"> <?php echo $_SESSION['username']; ?> </td>
                                <td class="task"> <?php echo $row['taches']; ?> </td>
                                <td class="delete modifier">
                                    <a href="index.php?supprimer_tache=<?php echo $row['id'] ?>">x</a>
                                    <a href="index.php?supprimer_tache=<?php echo '' ?>">Modifier</a>
                                </td>

                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>

            </div>
        </main>

    </div>

</body>

</html>