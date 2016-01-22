<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");
	include "connect.php";
	
	if(isset($_SESSION["loginMember"]) && ($_SESSION["loginMember"]!="")){
		//若帳號等級為 member 則導向會員中心
		if($_SESSION["memberLevel"]=="admin")
		{
			header("Location: admin.php");
		}
		elseif ($_SESSION["memberLevel"]=="doctor") 
		{
			header("Location: member_center.php");
		}
		elseif ($_SESSION["memberLevel"]=="assistant") 
		{
			header("Location: assistant_center.php");
		}
	}

	if(isset($_POST["account"]) && isset($_POST["pwd"])){

		$query_RecLogin = "SELECT * FROM member WHERE m_account = '".$_POST["account"]."'";
		$RecLogin = mysqli_query($conn, $query_RecLogin);
		$row_RecLogin=mysqli_fetch_assoc($RecLogin);

		$account = $row_RecLogin["m_account"];
		$pwd = $row_RecLogin["m_pwd"];
		$level = $row_RecLogin["m_level"];
		$approve = $row_RecLogin["m_approve"];

		if(md5($_POST["pwd"])==$pwd){
			
			if ($approve == "yes") {
				$_SESSION["loginMember"] = $account;
				$_SESSION["memberLevel"] = $level;
				
				if($_SESSION["memberLevel"] == "admin"){
					header("Location: admin.php");
				}else if($_SESSION["memberLevel"] == "doctor"){
					header("Location: member_center.php");
				}else if($_SESSION["memberLevel"] == "assistant"){
					header("Location: assistant_center.php");
				}else{
					header("Location: index.php");
				}
			}else{
				header("Location: index.php?errMsg=2");
			}
			
		}else{
			header("Location: index.php?errMsg=1");
		}

	}
	
?>
