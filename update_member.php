<?php 
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  require_once("check.php");

  $query_RecMember = "SELECT * FROM `member` WHERE `m_account`='".$_SESSION["loginMember"]."'";
  $RecMember = mysqli_query($conn, $query_RecMember); 
  $row_RecMember=mysqli_fetch_assoc($RecMember);

?>

<!DOCTYPE html>
  <head>
  <meta charset="utf-8">
  <title>National Registration of Ketamine Uropathy</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/jumbotron.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" type="text/css">
    
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
            <a class="navbar-brand" href="member_center.php">National Registration of Ketamine Uropathy</a>
          </div>
          <div id="myNavbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" method="post" action="">
              <div class="form-group">
                <font color="white"><?php echo $row_RecMember["m_name"];?>&nbsp;Welcome ! &nbsp;&nbsp;
                  <a style="color:white;" href="patient_join.php">新增病人資料</a> |
                  <a style="color:white;" href="#">新增病歷</a> |
                  <a style="color:white;" href="#">病人資料</a> |
                  <a style="color:white;" href="#">瀏覽病歷</a>&nbsp;&nbsp;
                </font>
              </div>  
                <button  type="submit" class="btn btn-success" formaction="logout.php">Log Out</button>
              </form>
          </div>
        </div>
      </nav>

      <div class="container">
        <form method="post" action="">
          <div id="register" class="update_register-card">
            <h1>Update</h1>
                <strong>Account</strong>
                <input type="text" name="m_account" value=<?php echo $row_RecMember["m_account"];?> disabled>
                <strong>Password</strong>
                <input type="password" name="m_pwd" placeholder="8 to 12 characters">
                <input type="password" name="m_passwordrecheck" placeholder="confirm password">
                <strong>Real Name</strong>
                <input type="text" name="m_name" value=<?php echo $row_RecMember["m_name"];?>>
                <strong>E-mail</strong>
                <input type="text" name="m_email" value=<?php echo $row_RecMember["m_email"];?>>
                <strong>Office Phone</strong>
                <input type="text" name="m_phone" value=<?php echo $row_RecMember["m_phone"];?>>
                <strong>Hospital</strong>
                <input type="text" name="m_hospital" value=<?php echo $row_RecMember["m_hospital"];?>>
                <input name="action" type="hidden" id="action" value="join">
                <input type="submit" name="register" class="update_register update_register-submit" value="Update">
          </div>
        </form>
      </div>
  </body>
</html>