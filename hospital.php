<?php 
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  include_once("check.php");


  $query_RecMember = "SELECT * FROM `member` WHERE `m_account`='".$_SESSION["loginMember"]."'";
  $RecMember = mysqli_query($conn, $query_RecMember); 
  $row_RecMember=mysqli_fetch_assoc($RecMember);

  $query_RecHospital = "SELECT * FROM `hospital` ";
  $RecHospital = mysqli_query($conn, $query_RecHospital);
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
  </head>
  <body>
     <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
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
            <h2>參與醫院</h2>
          </div>
          <hr>
            <table class="table table-striped" align="center" style="">
              <thead>
                <tr>
                  <th style="text-align:center;">編號</th>
                  <th style="text-align:center;">醫院名稱</th>
                  <th style="text-align:center;">醫院簡稱</th>
                  <th style="text-align:center;">加入日期</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row_RecHospital=mysqli_fetch_assoc($RecHospital)) { ?>
                <tr>
                  <td align="center"><?php echo $row_RecHospital["h_id"];?></td>
                  <td align="center"><?php echo $row_RecHospital["h_name"];?></td>
                  <td align="center"><?php echo $row_RecHospital["h_nickname"];?></td>
                  <td align="center"><?php echo $row_RecHospital["h_joindate"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
        </div>
      </div>
  </body>
</html>