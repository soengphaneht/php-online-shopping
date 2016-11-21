<?php
	session_start();
	if (empty($_GET["lang"]) || !isset($_GET["lang"])){
		header("location:index.php");
	}
	else{
		$_SESSION["lang"]=$_GET["lang"];
		header('Location: ' .$_SERVER['HTTP_REFERER']);
	}
?>
