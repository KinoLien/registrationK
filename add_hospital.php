<?php
	header("Content-Type: text/html; charset=utf-8");
	session_start();
	include_once("connect.php");
	
	if(isset($_POST["action"])&&($_POST["action"]=="join")){
	    //找尋帳號是否已經註冊
	    $query_RecFindHospital = "SELECT `h_name` FROM `hospital` WHERE `h_name`='".$_POST["h_name"]."'";
	    $RecFindHospital=mysqli_query($conn, $query_RecFindHospital);

	    if (mysqli_num_rows($RecFindHospital)>0){
	      header("Location: index.php?errMsg=1&username=".$_POST["h_name"]);

	    }else{
	      //if(!@mysql_select_db("order_system")) die("died!!");
	      //若沒有執行新增的動作  
	      
	      $query_insert = "INSERT INTO `hospital` (`h_name` ,`h_nickname`, `h_joindate`) VALUES (";
	      $query_insert .= "'".$_POST["h_name"]."',";
	      $query_insert .= "'".$_POST["h_nickname"]."',"; 
	      $query_insert .= "NOW())";
	    
	      mysqli_query($conn, $query_insert);
	      header("Location: admin_hospital.php");
	    }
	}
?>