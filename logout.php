<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");
	include "connect.php";
	//執行登出動作
	
		unset($_SESSION["loginMember"]);
		unset($_SESSION["memberLevel"]);
		header("Location: index.php");
	
?>