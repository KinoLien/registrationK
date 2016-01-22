<?php 
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  require_once("check.php");

  $query_RecMember = "SELECT * FROM `member` WHERE `m_account`='".$_SESSION["loginMember"]."'";
  $RecMember = mysqli_query($conn, $query_RecMember); 
  $row_RecMember=mysqli_fetch_assoc($RecMember);

  $query_RecHospital = "SELECT * FROM `hospital` WHERE `h_id`='".$row_RecMember["h_id"]."'";
  $RecHospital = mysqli_query($conn, $query_RecHospital);
  $row_RecHospital = mysqli_fetch_assoc($RecHospital);

  $query_RecHospital = "SELECT * FROM `hospital` ";
  $RecHospital = mysqli_query($conn, $query_RecHospital);

  if(isset($_POST["action"])&&($_POST["action"]=="update")){
    
    if (md5($_POST["pwd"]) != $row_RecMember["m_pwd"]){
      header("Location: assistant_center.php?errMsg=1");
    }else{  
      if ($_POST["m_pwd"] == '' && $_POST["m_passwordrecheck"] == '') {
        $query_insert = "UPDATE `member` SET `m_pwd` = '".md5($_POST["pwd"])."', `m_phone`= '".$_POST["m_phone"]."', `m_email` = '".$_POST["m_email"]."' WHERE `m_sn` = '".$row_RecMember["m_sn"]."' ";
        mysqli_query($conn, $query_insert);
        header("Location: assistant_center.php?loginStats=1");
      }else{
        $query_insert = "UPDATE `member` SET `m_pwd` = '".md5($_POST["m_pwd"])."', `m_phone`= '".$_POST["m_phone"]."', `m_email` = '".$_POST["m_email"]."' WHERE `m_sn` = '".$row_RecMember["m_sn"]."' ";
        mysqli_query($conn, $query_insert);
        header("Location: assistant_center.php?loginStats=1");
      }
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
  <link href="css/jquery-ui.css" rel="stylesheet" >
  <link href="css/theme.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script language="javascript">
      function makesure(){
        if (confirm('\n您確定要更新？\n')) return true;
        return false;
      }
      function checkForm(){
        var pwd = document.formJoin.pwd.value;
        var old = "<?php echo $row_RecMember["m_pwd"] ?>"
        if (pwd != old) {
          //alert("密碼錯誤！");
          //document.formJoin.pwd.focus();
          //return false;
        };
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
    <script type="text/javascript">
      $(document).ready(function() {
        var hospital = "<?php echo $row_RecHospital["h_id"] ?>";
        $("[name=h_id]").val(hospital);
      });
    </script>
  </head>
  <body>
    <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"] == "1")){ ?>
    <script language="javascript">
      alert('The old password is incorrect.\n');
      window.location.href='assistant_center.php';
    </script>
    <?php } ?>
    <?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"] == "1")){ ?>
    <script language="javascript">
      alert('更新資料成功。\n');
      window.location.href='assistant_center.php';
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
          <h2>Assistant Center</h2>
        </div>
        <ul class="nav nav-tabs">
          <li class="active">
            <a href="#">Profile</a>
          </li>
        </ul>
        
        <div class="page-header">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Name：</label>
              <div class="col-sm-10">
                <i><h4><?php echo $row_RecMember["m_name"];?></h4></i>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Account：</label>
              <div class="col-sm-10">
                <h4><?php echo $row_RecMember["m_account"];?></h4>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">E-mail：</label>
              <div class="col-sm-10">
                <h4><?php echo $row_RecMember["m_email"];?></h4>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Office Phone：</label>
              <div class="col-sm-10">
                <h4><?php echo $row_RecMember["m_phone"];?></h4>
              </div>
            </div>
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Hospital：</label>
              <div class="col-sm-10">
                <h4><?php echo $row_RecHospital["h_name"];?></h4>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">修改</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
        
              <!-- Modal content-->
              <div class="modal-content">
                <form action="" method="post" name="formJoin" id="formJoin" onSubmit="return checkForm();">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h1 class="modal-title">Update your Information</h1>
                  </div>
                  <div class="modal-body">
                      <div class="register-card">
                        <p>
                            <h4><strong>Account：<?php echo $row_RecMember["m_account"]; ?></strong></h4>
                        </p>
                        <p>
                            <h4><strong>Real Name：<?php echo $row_RecMember["m_name"]; ?></strong></h4>
                        </p>
                        <p>
                          <strong>Old Password</strong>
                          <input type="password" name="pwd">
                        </p>
                        <p>
                            <strong>New Password</strong>
                            <input type="password" name="m_pwd" placeholder="8 to 12 characters">
                            <input type="password" name="m_passwordrecheck" placeholder="confirm password">
                        </p> 
                        <p>
                            <strong>E-mail</strong><br>
                            <input type="text" name="m_email" placeholder="type your e-mail" value=<?php echo $row_RecMember["m_email"]; ?>>
                        </p> 
                        <p>
                            <strong>Office Phone</strong><br>
                            <input type="text" name="m_phone" placeholder="type your office phone" value=<?php echo $row_RecMember["m_phone"]; ?>>
                        </p> 
                        <p>
                            <h4><strong>Hospital：<?php echo $row_RecHospital["h_name"]; ?></strong></h4>
                        </p> 
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input name="action" type="hidden" id="action" value="update">
                      <button type="submit" class="btn btn-primary" onClick="return makesure();">Update</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
    </div>
  </body>
</html>