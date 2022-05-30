<?php
// $db = new PDO('mysql:host=localhost;dbname=todolist', 'root', 'root');

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $data = $_POST['toAdd'];
//     $db->exec("INSERT INTO info (taches) VALUES('$data')"); // On insère la tâche dans la base de donnée

//     $response = $db->query('SELECT * FROM info');
//     $data = $response->fetchAll(PDO::FETCH_OBJ);
//     echo json_encode($data);
//     exit;
// } else {
//     $responseAll = $db->query('SELECT * FROM info');
//     $dataAll = $responseAll->fetchAll(PDO::FETCH_OBJ);
//     echo json_encode($dataAll);
//     exit;
// }

// if ($_POST["toAdd"]) {
//     $data = array(
//         ':toAdd'  => $_POST['toAdd']
//     );

//     $query = "
//      DELETE FROM task_list
//      WHERE toAdd = :toAdd
//      ";

//     $statement = $connect->prepare($query);

//     if ($statement->execute($data)) {
//         echo 'done';
//     }
// }

    // initialize errors variable
	$errors = "";

	// connect to database
    $db = new mysqli('mysql:host=localhost;dbname=todolist', 'root', 'root');
	// insert a quote if submit button is clicked
	if (isset($_POST['submit'])) {
        echo "cd";
		if (empty($_POST['task'])) {
			$errors = "You must fill in the task";
		}else{
			$task = $_POST['task'];
			$sql = "INSERT INTO info (taches) VALUES ('$task')";
			mysqli_query($db, $sql);
			header('location: index.php');
		}
	}

	// ...


?>