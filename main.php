<?php
	session_start();
	
	require_once __DIR__ . '/vendor/autoload.php';
	use Google\Cloud\Datastore\DatastoreClient;

	$projectId = "login-app-272512";
	$projectDatastore = new DatastoreClient(["projectId" => $projectId]);
	
	$userName = getName($_SESSION["id"], $projectDatastore);
	echo sprintf("Your name is %s.", $userName);

	function getName($id, $datastore) {
		$key = $datastore->key("User", $id);
		$user = $datastore->lookup($key);
		return $user["name"];
	}
?>

<html>
	<head>
		<title>Main Page</title>
	</head>
	<body>
    	<form action="name.php">
    		<br><input type="submit" value="Change Name">
		</form>
		<form action="password.php">
    		<input type="submit" value="Change Password">
		</form>
	</body>
</html>