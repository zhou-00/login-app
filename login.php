<?php
	session_start();
	
	require_once __DIR__ . '/vendor/autoload.php';
	use Google\Cloud\Datastore\DatastoreClient;

	$projectId = "login-app-272512";
	$projectDatastore = new DatastoreClient(["projectId" => $projectId]);

	if (isset($_POST["userId"]) && isset($_POST["userPass"])) {

		checkCreds($_POST["userId"], $_POST["userPass"], $projectDatastore);

	}

	function checkCreds($id, $pass, $datastore) {
		
		$key = $datastore->key("User", $id);
		$user = $datastore->lookup($key);

		if (!is_null($user) && $user["password"]===$pass) {
			
			$_SESSION["id"] = $id;
			header("location: main.php");
			exit;
		
		}

		else {
			echo "User id or password is invalid.";
		}
	}

?>

<html>
<head>
	<title>Login Page</title>
</head>
<body bgcolor="white">
	<form action="" method="post">
		User ID: 
		<input type="text" name="userId">
		<br>Password: 
		<input type="text" name="userPass">
		<br><input type="submit" value="Log In">
	</form>
</body>
</html>