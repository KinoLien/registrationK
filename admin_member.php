<?php 
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  include_once("check_admin.php");


  $query_RecAdmin = "SELECT * FROM `member` WHERE `m_account`='".$_SESSION["loginMember"]."'";
  $RecAdmin = mysqli_query($conn, $query_RecAdmin); 
  $row_RecAdmin=mysqli_fetch_assoc($RecAdmin);

  $query_RecMember = "SELECT c.*, `hospital`.`h_nickname` FROM(SELECT a.*, b.m_name AS manager FROM `member` AS a, `member` AS b WHERE b.m_sn = a.m_manager) AS c LEFT JOIN `hospital` ON c.h_id = `hospital`.`h_id`";
  $RecMember = mysqli_query($conn, $query_RecMember);

  if(isset($_GET["action"])&&($_GET["action"]=="confirm")){	
		
		$confirm_RecMember = "UPDATE `member` SET `m_approve`='yes' WHERE `m_sn`='".$_GET["id"]."' OR `m_manager`='".$_GET["id"]."'";
		mysqli_query($conn, $confirm_RecMember);

		//重新導向回到主畫面
		header("Location: admin_member.php");
	}

	if(isset($_GET["action"])&&($_GET["action"]=="cancel")){	
		
		$confirm_RecMember = "UPDATE `member` SET `m_approve`='no' WHERE `m_sn`='".$_GET["id"]."' OR `m_manager`='".$_GET["id"]."'";
		mysqli_query($conn, $confirm_RecMember);

		//重新導向回到主畫面
		header("Location: admin_member.php");
	}

  //刪除會員
  if(isset($_GET["action"])&&($_GET["action"]=="delete")){  
    $query_delAssistant = "DELETE FROM `member` WHERE `m_sn`=".$_GET["id"];
    mysqli_query($conn, $query_delAssistant); 
    //重新導向回到主畫面
    header("Location: admin_member.php");
  }
?>

<!DOCTYPE html>
  <head>
  <meta charset="utf-8">
  <meta content='1440; url=logout.php' http-equiv='refresh'>
  <title>National Registration of Ketamine Uropathy</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/jumbotron.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link href="css/jquery-ui.css" rel="stylesheet">
  <link href="css/theme.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function deletesure(){
      if (confirm('\n您確定要刪除?\n刪除後無法恢復!\n')) return true;
      return false;
    }
  </script>
  </head>
  <body>
     <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="login.php">National Registration of Ketamine Uropathy</a>
          </div>

          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
              <li><a href="first_visit.php">新增病歷</a></li>
              <li><a href="medical_list.php">瀏覽病歷</a></li>
              <li><a href="hospital.php">參與醫院</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="login.php"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $row_RecAdmin["m_name"];?></a></li>
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="container theme-showcase" role="main">
        <div class="jumbotron">
          <div class="page-header">
            <h2>Admin Center</h2>
          </div>
          <ul class="nav nav-tabs">
            <li>
              <a href="admin.php">Profile</a>
            </li>
            <li>
              <a href="admin_assistant.php">Assistant</a>
            </li>
            <li  class="active">
                <a href="admin_member.php">Manage Member</a>
            </li>
            <li>
              <a href="admin_hospital.php">Manage Hospital</a>
            </li>
          </ul>
          
          <div class="page-header">
            <table class="table table-hover" align="center" style="">
              <thead>
                  <tr>
                    <th style="text-align:center;">Delete</th>
                    <th></th>
                    <th style="text-align:center;">驗證</th>
                    <th style="text-align:center;">姓名</th>
                    <th style="text-align:center;">帳號</th>
                    <th style="text-align:center;">電子郵件</th>
                    <th style="text-align:center;">等級</th>
                    <th style="text-align:center;">所屬醫院</th>
                    <th style="text-align:center;">主管</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row_RecMember=mysqli_fetch_assoc($RecMember)) { ?>
                  <tr>
                    <td align="center">
                      <a href="?action=delete&id=<?php echo $row_RecMember["m_sn"];?>" onClick="return deletesure();">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                      </a>
                    </td>
                    <td align="center">
                      <?php if($row_RecMember["m_approve"]=='no'){ ?>
                    <a href="?action=confirm&id=<?php echo $row_RecMember["m_sn"];?>" >驗證</a>
                    <?php }else{ ?>
                      <a href="?action=cancel&id=<?php echo $row_RecMember["m_sn"];?>" >取消驗證</a>
                    <?php } ?>
                    </td>
                    <td align="center">
                      <?php if($row_RecMember["m_approve"]=='no'){ ?>
                      未驗證
                    <?php }else{ ?>
                      已驗證
                    <?php } ?>
                    </td>
                    
                    <td align="center"><?php echo $row_RecMember["m_name"];?></td>
                    <td align="center"><?php echo $row_RecMember["m_account"];?></td>
                    <td align="center"><?php echo $row_RecMember["m_email"];?></td>
                    <td align="center"><?php echo $row_RecMember["m_level"];?></td>
                    <td align="center"><?php echo $row_RecMember["h_nickname"];?></td>
                    <td align="center"><?php echo $row_RecMember["manager"];?></td>
                  </tr>
                  <?php } ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
  </body>
</html>