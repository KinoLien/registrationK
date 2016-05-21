<?php 
	header("Content-Type: text/html; charset=utf-8");
	session_start();
	include_once("connect.php");

	if(isset($_POST["action"])&&($_POST["action"]=="join")){
		//找尋帳號是否已經註冊
		$query_RecFindUser = "SELECT `m_account` FROM `member` WHERE `m_account`='".$_POST["m_account"]."'";
		$RecFindUser=mysqli_query($conn, $query_RecFindUser);
		if (mysqli_num_rows($RecFindUser)>0){
			header("Location: index.php?errMsg=3&username=".$_POST["m_account"]);
		}else{
			//if(!@mysql_select_db("order_system")) die("died!!");
			//若沒有執行新增的動作	
			$md5Pwd = md5($_POST["m_pwd"]);
			$query_insert = "INSERT INTO `member` (`m_account` ,`m_pwd`, `m_name`, `m_phone`, `m_email`, `h_id`, `m_jointime`) VALUES (";
			$query_insert .= "'".$_POST["m_account"]."',";
			$query_insert .= "'".$md5Pwd."',";
			$query_insert .= "'".$_POST["m_name"]."',";
			$query_insert .= "'".$_POST["m_phone"]."',";
			$query_insert .= "'".$_POST["m_email"]."',";
			$query_insert .= "'".$_POST["h_id"]."',";	
			$query_insert .= "NOW())";
		
			mysqli_query($conn, $query_insert);
			
			// 自動寄送信件通知助理
			$queryRecMemberMail = "SELECT `m_email` FROM `member` WHERE `h_id` = 1 AND `m_level` = 'assistant' ORDER BY `m_sn`";
		    $RecMemberMail = mysqli_query($conn, $queryRecMemberMail);
		    $row_RecMemberMail = mysqli_fetch_assoc($RecMemberMail);
		    if(!empty($row_RecMemberMail)){
		    	$RecHospital = mysqli_query($conn, "SELECT * FROM `hospital` WHERE `h_id` = ".$_POST["h_id"]);
		    	$row_RecHospital = mysqli_fetch_assoc($RecHospital);
		    	$mailcontent = "您好，\n\n新的註冊成員為：\n 帳號：".$_POST["m_account"]."\n 名稱：".$_POST["m_name"].
		    		"\n 醫院：".$row_RecHospital['h_name']."\n\n請驗證該成員是否無誤，謝謝。";
				$mailFrom = "From: National Registration of Ketamine Uropathy <no-reply@140.117.169.138>";
				$mailto = $row_RecMemberMail['m_email'];
				$mailsubject = "NRKU 新成員註冊通知";
				mail("$mailto", "$mailsubject", "$mailcontent", "$mailFrom");
		    }
		    
			header("Location: index.php?loginStats=1");

		}
	}
?>
