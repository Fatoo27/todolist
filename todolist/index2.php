<?php
 
 $erreurs = "";
 $db = new PDO('mysql:host=localhost;dbname=mytodolist;charset=utf8', 'root', 'root');
  
 if (isset($_POST['creer_tache'])) { // On vérifie que la variable POST existe
     if (empty($_POST['creer_tache'])) {  // On vérifie qu'elle as une valeure
         $erreurs = 'Vous devez indiquer la valeure de la tâche';
     } else {
         $tache = $_POST['creer_tache'];
         $db->exec("INSERT INTO todolist(taches) VALUES('$tache')"); // On insère la tâche dans la base de donnée
     }
 }
  
 if(isset($_GET['supprimer_tache'])) {
     $id = $_GET['supprimer_tache'];
     $db->exec("DELETE FROM todolist WHERE id=$id");
 }
  
 ?>
  
 <link rel="stylesheet" href="index.css"/>
  
 <div class="header">
     <p class="header_titre">Ma super Todo List ! </p>
 </div>
  
  
 <form class="taches_input" method="post" action="index.php">
  
  
     <input id="inserer" type="text" name="creer_tache"/>
     <button id="envoyer">Créer</button>
 </form>
 <?php
 if (isset($erreurs)) {
     ?>
     <p><?php echo $erreurs ?></p>
     <?php
 }
 ?>
  
  
 <table class="taches">
     <tr>
         <th>
             N
         </th>
         <th>
             Nom
         </th>
         <th>
             Action
         </th>
     </tr>
     <?php
     $reponse = $db->query('Select * from todolist'); // On exécute une requête visant à récupérer les tâches
     while ($taches = $reponse->fetch()) { // On initialise une boucle
         ?>
         <tr>
             <td><?php echo $taches['id'] ?></td>
             <td><?php echo $taches['taches'] ?></td>
             <td><a class="suppr" href="index.php?supprimer_tache=<?php echo $taches['id'] ?>"> X</a></td>
         </tr>
         <?php
     }
  
  
     ?>
  
  
 </table>