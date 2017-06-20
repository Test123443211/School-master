<?php
include("PDOConnection.php");
if($_POST["action"] == "add")
{	
	insertToken($cnn, $_POST["tokenid"]);
}
//Function insert new token to table tokenid
function insertToken($cnn, $token)
{
	if(isExistToken($cnn, $token))
	{
		echo("Token is exists");
		return;
	}
	$query = "INSERT INTO deviceinfo(tokenid) VALUES(?)";
	$stmt = $cnn->prepare($query);
	$stmt->bindParam(1, $token);
	$stmt->execute();
	echo("Insert success");
}
//Check exists token
function isExistToken($cnn, $token)
{
	$query = "SELECT * FROM deviceinfo WHERE tokenid = ?";
	$stmt = $cnn->prepare($query);
	$stmt->bindParam(1, $token);
	$stmt->execute();
	$rowcount = $stmt->rowCount();
	//for debug
	//var_dump($rowcount);
	return $rowcount;
}
?>