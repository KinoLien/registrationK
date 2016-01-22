<?php 
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  include_once("check_admin.php");


  $query_RecMember = "SELECT * FROM `member` WHERE `m_account`='".$_SESSION["loginMember"]."'";
  $RecMember = mysqli_query($conn, $query_RecMember); 
  $row_RecMember=mysqli_fetch_assoc($RecMember);

  $query_RecAssistant = "SELECT * FROM `member` WHERE `m_manager`='".$row_RecMember["m_sn"]."' AND `m_level`='assistant'";
  $RecAssistant = mysqli_query($conn, $query_RecAssistant);
  $countAssistant = mysqli_num_rows($RecAssistant);
  //刪除助理
  if(isset($_GET["action"])&&($_GET["action"]=="delete")){  
    $query_delAssistant = "DELETE FROM `member` WHERE `m_sn`=".$_GET["id"];
    mysqli_query($conn, $query_delAssistant); 
    //重新導向回到主畫面
    header("Location: admin_assistant.php");
  }

  if(isset($_POST["action"])&&($_POST["action"]=="join")){
    //找尋帳號是否已經註冊
    $query_RecFindUser = "SELECT `m_account` FROM `member` WHERE `m_account`='".$_POST["m_account"]."'";
    $RecFindUser=mysqli_query($conn, $query_RecFindUser);
    if (mysqli_num_rows($RecFindUser)>0){
      header("Location: admin_assistant.php?errMsg=1");
    }else{
      //if(!@mysql_select_db("order_system")) die("died!!");
      //若沒有執行新增的動作  
      $md5Pwd = md5($_POST["m_pwd"]);
      $query_insert = "INSERT INTO `member` (`m_account` ,`m_pwd`, `m_name`, `m_level`, `m_phone`, `m_email`, `h_id`, `m_manager`, `m_approve`, `m_jointime`) VALUES (";
      $query_insert .= "'".$_POST["m_account"]."',";
      $query_insert .= "'".$md5Pwd."',";
      $query_insert .= "'".$_POST["m_name"]."',";
      $query_insert .= "'assistant',";
      $query_insert .= "'".$_POST["m_phone"]."',";
      $query_insert .= "'".$_POST["m_email"]."',";
      $query_insert .= "'".$row_RecMember["h_id"]."',"; 
      $query_insert .= "'".$row_RecMember["m_sn"]."',";
      $query_insert .= "'yes',";
      $query_insert .= "NOW())";
    
      mysqli_query($conn, $query_insert);
      header("Location: admin_assistant.php?loginStats=1");

    }
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
  <script language="javascript">
      function checkForm(){
        if(document.formJoin.m_account.value==""){    
          alert("Please enter a account!");
          document.formJoin.m_account.focus();
          return false;
        }else{
          uid=document.formJoin.m_account.value;
          if(uid.length<5 || uid.length>12){
            alert( "Your username length can only be 5-12 letters!" );
            document.formJoin.m_account.focus();
            return false;
          }
          for(idx=0;idx<uid.length;idx++){
            if(!(( uid.charAt(idx)>='a'&&uid.charAt(idx)<='z')||(uid.charAt(idx)>='0'&& uid.charAt(idx)<='9')||(uid.charAt(idx)>='A'&&uid.charAt(idx)<='Z')||( uid.charAt(idx)=='_'))){
              alert( "Your username can only be a number, letters and sign, the other characters are not allowed!" );
              document.formJoin.m_account.focus();
              return false;
            }
            if(uid.charAt(idx)=='_'&&uid.charAt(idx-1)=='_'){
              alert( "Symbols can not connected! !\n" );
              document.formJoin.m_account.focus();
              return false;       
            }
          }
        }
        if(!check_passwd(document.formJoin.m_pwd.value,document.formJoin.m_passwordrecheck.value)){
          document.formJoin.m_pwd.focus();
          return false;
        } 
        if(document.formJoin.m_name.value==""){
          alert("Please enter your real name!");
          document.formJoin.m_name.focus();
          return false;
        }
        if(document.formJoin.m_email.value==""){
          alert("Please enter your E-mail!");
          document.formJoin.m_email.focus();
          return false;
        }
        if(!checkmail(document.formJoin.m_email)){
          document.formJoin.m_email.focus();
          return false;
        }
        if(document.formJoin.m_phone.value==""){
          alert("Please enter your Phone Number!");
          document.formJoin.m_phone.focus();
          return false;
        }
        return confirm('You sure everything are correct？');
      }
      function check_passwd(pw1,pw2){
        if(pw1==''){
          alert("Passwaord cannot be blank!");
          return false;
        }
        for(var idx=0;idx<pw1.length;idx++){
          if(pw1.charAt(idx) == ' ' || pw1.charAt(idx) == '\"'){
            alert("The password can not contain spaces or double quotes !\n");
            return false;
          }
          if(pw1.length<8 || pw1.length>12){
            alert( "The password can only be 8-12 letters !\n" );
            return false;
          }
          if(pw1!= pw2){
            alert("Enter the password is not the same as the second, please re-enter !\n");
            return false;
          }
        }
        return true;
      }
      function checkmail(myEmail) {
        var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(filter.test(myEmail.value)){
          return true;
        }
        alert("Email format is incorrect.");
        return false;
      }    
    </script>
  </head>
  <body>
    <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"] == "1")){ ?>
    <script language="javascript">
      alert('此帳號已使用過。\n');
      window.location.href='admin_assistant.php';
    </script>
    <?php } ?>
    <?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"] == "1")){ ?>
    <script language="javascript">
      alert('新增助理成功。\n');
      window.location.href='admin_assistant.php';
    </script>
    <?php } ?>
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
              <li><a href="login.php"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $row_RecMember["m_name"];?></a></li>
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
            <li class="active">
              <a href="admin_assistant.php">Assistant</a>
            </li>
            <li>
                <a href="admin_member.php">Manage Member</a>
            </li>
            <li>
              <a href="admin_hospital.php">Manage Hospital</a>
            </li>
          </ul>
          
          <div class="page-header">
            <div class="form-group">
              <div class="col-sm-offset-0 col-sm-10">
                <?php if ($countAssistant < 5) {?>
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Assistant
                </button>
                <?php } ?>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="post" action="">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h3 class="modal-title" id="myModalLabel">New Assistant</h3>
                    </div>
                    <div class="modal-body">
                       <div class="register-card">
                        <p>
                            <strong>Account</strong><br>
                            <input type="text" name="m_account" placeholder="5 to 12 characters">
                        </p>
                        <p>
                            <strong>Password</strong>
                            <input type="password" name="m_pwd" placeholder="8 to 12 characters">
                            <input type="password" name="m_passwordrecheck" placeholder="confirm password">
                        </p> 
                        <p>
                            <strong>Real Name</strong><br>
                            <input type="text" name="m_name" placeholder="type your real name">
                        </p>
                        <p>
                            <strong>E-mail</strong><br>
                            <input type="text" name="m_email" placeholder="type your e-mail">
                        </p> 
                        <p>
                            <strong>Office Phone</strong><br>
                            <input type="text" name="m_phone" placeholder="type your office phone">
                        </p>  
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input name="action" type="hidden" id="action" value="join">
                      <button type="submit" class="btn btn-primary" onClick="return makesure();">ADD</button>
                    </div>
                  </form> 
                </div>
              </div>
            </div>
            <table class="table table-hover" align="center" style="">
              <thead>
                <tr>
                  <th style="text-align:center;">Delete</th>
                  <th style="text-align:center;">姓名</th>
                  <th style="text-align:center;">帳號</th>
                  <th style="text-align:center;">電話</th>
                  <th style="text-align:center;">信箱</th>
                  <th style="text-align:center;">加入日期</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row_RecAssistant=mysqli_fetch_assoc($RecAssistant)) { ?>
                <tr>
                  <td align="center">
                    <a href="?action=delete&id=<?php echo $row_RecAssistant["m_sn"];?>" onClick="return deletesure();">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                  </td>
                  <td align="center"><?php echo $row_RecAssistant["m_name"];?></td>
                  <td align="center"><?php echo $row_RecAssistant["m_account"];?></td>
                  <td align="center"><?php echo $row_RecAssistant["m_phone"];?></td>
                  <td align="center"><?php echo $row_RecAssistant["m_email"];?></td>
                  <td align="center"><?php echo $row_RecAssistant["m_jointime"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </body>
</html>