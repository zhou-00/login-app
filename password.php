<?php
	session_start();
	
	require_once __DIR__ . '/vendor/autoload.php';
	use Google\Cloud\Datastore\DatastoreClient;

	$projectId = "login-app-272512";
	$projectDatastore = new DatastoreClient(["projectId" => $projectId]);

	if (isset($_POST["submit"])) {
		
		updatePassword($_SESSION["id"], $_POST["newPass"], $projectDatastore);

	}

	function updatePassword($userId, $newPassword, $datastore) {
		
		$transaction = $datastore->transaction();
		$key = $datastore->key("User", $userId);
		$user = $transaction->lookup($key);

		if ($_POST["oldPass"]===$user["password"]) {
			
			$user["password"] = $newPassword;
			$transaction->update($user);
			$transaction->commit();

			header("Location: login.php");
			exit;
		}

		else {
			echo "User password is incorrect.";
		}		
	}
?>

<html>
<head>
	<title>Change Password</title>
</head>
<body bgcolor="white">
	<form action="" method="post">
		Old Password:
		<input type="text" name="oldPass">
		<br>New Password: 
		<input type="text" name="newPass">
		<br><input type="submit" name="submit" value="Change">
	</form>
</body>
</html>