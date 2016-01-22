<?php
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");

  $query_RecHospital = "SELECT * FROM `hospital` ";
  $RecHospital = mysqli_query($conn, $query_RecHospital);

  function MakePass($length){
    $possible = "0123456789!@#$%^&*()_+abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $str = "";
    while (strlen($str) < $length) {
      $str .= substr($possible, rand(0, strlen($possible)), 1);
    }
    return($str);
  }

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

  if (isset($_POST["username"])) {
    $query_RecFindUser = "SELECT * FROM `member` WHERE `m_account` = '".$_POST["username"]."'";
    $RecFindUser = mysqli_query($conn, $query_RecFindUser);
    if (mysqli_num_rows($RecFindUser) == 0) {
      header("Location: index.php?errMsg=4");
    }else{
      $row_RecFindUser = mysqli_fetch_assoc($RecFindUser);
      $account = $row_RecFindUser["m_account"];
      $useremail = $row_RecFindUser["m_email"];

      $newpasswd = MakePass(10);
      $query_update = "UPDATE `member` SET `m_pwd` = '".md5($newpasswd)."' WHERE `m_account` = '".$account."'";
      mysqli_query($conn, $query_update);

      $mailcontent = "您好，\n\n您的帳號為：$account\n您的新密碼為：$newpasswd\n\n登入後請您儘速更改密碼！";
      $mailFrom = "From: National Registration of Ketamine Uropathy <no-reply@140.117.169.138>";
      $mailto = $useremail;
      $mailsubject = "NRKU 密碼協助";
      mail("$mailto", "$mailsubject", "$mailcontent", "$mailFrom");
      header("Location: index.php?mailStats=1");
    }

  }

?>

<!DOCTYPE html>
<!-- saved from url=(0038)https://kkbruce.tw/bs3/Examples/signin -->
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>National Registration of Ketamine Uropathy</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/signin.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
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
      alert('密碼輸入錯誤！\n');
      window.location.href='index.php';
    </script>
    <?php } ?>
    <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"] == "2")){ ?>
    <script language="javascript">
      alert('帳號尚未驗證！\n');
      window.location.href='index.php';
    </script>
    <?php } ?>
    <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"] == "3")){ ?>
    <script language="javascript">
      alert('此帳號已使用過。\n');
      window.location.href='index.php';
    </script>
    <?php } ?>
    <?php if(isset($_GET["errMsg"]) && ($_GET["errMsg"] == "4")){ ?>
    <script language="javascript">
      alert('系統查無此帳號。\n');
      window.location.href='index.php';
    </script>
    <?php } ?>
    <?php if(isset($_GET["mailStats"]) && ($_GET["mailStats"] == "1")){ ?>
    <script language="javascript">
      alert('新密碼已寄至您的信箱。\n');
      window.location.href='index.php';
    </script>
    <?php } ?>
  <div class="container">
    <form method="post" action="login.php" class="form-signin" role="form">
      <h3 class="form-signin-heading">National Registration of Ketamine Uropathy</h3>
      <label for="inputEmail" class="sr-only">Account</label>
      <input name="account" type="" id="inputEmail" class="form-control" placeholder="Account" required="" autofocus=""> 
      <label for="inputPassword" class="sr-only">Password</label>
      <input name="pwd" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Log in</button>
      <div class="login-help">
              <a  id="btn1" href="#toregister" data-toggle="modal" data-target="#myModal">Register</a> • <a href="#" data-toggle="modal" data-target="#myModal1">Forgot Password</a>
          </div>
    </form>

    <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
        
              <!-- Modal content-->
              <div class="modal-content">
                <form action="register.php" method="post" name="formJoin" id="formJoin" onSubmit="return checkForm();">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h1 class="modal-title">Sign Up</h1>
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
                            <strong>Phone</strong><br>
                            <input type="text" name="m_phone" placeholder="type your phone number">
                        </p> 
                        <p>
                            <strong>Hospital</strong><br>
                            <select name="h_id">
                              <option>請選擇</option>
                              <?php while ($row_RecHospital=mysqli_fetch_assoc($RecHospital)) { ?>
                              <option value=<?php echo $row_RecHospital["h_id"]; ?>><?php echo $row_RecHospital["h_id"];?>、<?php echo $row_RecHospital["h_name"];?></option>
                              <?php } ?>
                            </select>
                        </p> 
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input name="action" type="hidden" id="action" value="join">
                      <input type="submit" name="register" class="register register-submit" value="Create account">
                  </div>
                </form>
              </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal1" role="dialog">
          <div class="modal-dialog">
        
              <!-- Modal content-->
              <div class="modal-content">
                <form action="" method="post" name="formJoin" id="formJoin" onSubmit="">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h1 class="modal-title">Please Enter your Account</h1>
                  </div>
                  <div class="modal-body">
                      <div class="register-card">
                        <p>
                            <strong>Account</strong><br>
                            <input type="text" name="username" placeholder="5 to 12 characters">
                        </p>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input name="action" type="hidden" id="action" value="join">
                      <button type="submit" class="btn btn-primary">確認</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
  </div>
</body>
</html>
