<?php
	include "connect.php";
	session_start();
	header("Content-Type: text/html; charset=utf-8");
	
	//檢查是否經過登入
	if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
		header("Location: index.php");
	}
?>