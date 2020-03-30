<?php
	session_start();

	require_once __DIR__ . '/vendor/autoload.php';
	use Google\Cloud\Datastore\DatastoreClient;

	$projectId = "login-app-272512";
	$projectDatastore = new DatastoreClient(["projectId" => $projectId]);

	if (isset($_POST["submit"])) {
		
		if (isset($_POST["newName"]) && !empty($_POST["newName"])) {

			$newUserName = $_POST["newName"];
			updateName($_SESSION["id"], $newUserName, $projectDatastore);
			$_SESSION["name"] = $newUserName;

			header("location: main.php");
			exit;

		}
		
		else {
			echo "User name cannot be empty.";
		}
	}

	function updateName($userId, $newName, $datastore) {
		
		$transaction = $datastore->transaction();
		$key = $datastore->key("User", $userId);
		$user = $transaction->lookup($key);
		
		$user["name"] = $newName;
		$transaction->update($user);
		$transaction->commit();

	}

?>

<html>
<head>
	<title>Change Name</title>
</head>
<body bgcolor="white">
	<form action="" method="post">
		New name: 
		<input type="text" name="newName">
		<br><input type="submit" name="submit" value="Change">
	</form>
</body>
</html>