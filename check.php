<?php
	include "connect.php";
	session_start();
	header("Content-Type: text/html; charset=utf-8");
	
	//檢查是否經過登入
	if(!isset($_SESSION["loginMember"]) || ($_SESSION["loginMember"]=="")){
		header("Location: index.php");
	}

	$query_RecMember = "SELECT * FROM `member` WHERE `m_account`='" . $_SESSION["loginMember"] . "'";
  	$RecMember = mysqli_query($conn, $query_RecMember); 
  	$row_RecMember = mysqli_fetch_assoc($RecMember);

?>