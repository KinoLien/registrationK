<?php 
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  include_once("check.php");

  $query_RecHospital = "SELECT * FROM `hospital` ";
  $RecHospital = mysqli_query($conn, $query_RecHospital);
?>

<!DOCTYPE html>
  <head>
  <meta charset="utf-8">
  <meta content='1440; url=logout.php' http-equiv='refresh'>
  <title>National Registration of Ketamine Uropathy</title>
  <link href="jquery-ui/jquery-ui.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/jumbotron.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <!-- <link href="css/theme.css" rel="stylesheet"> -->
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  </head>
  <body>
     
      <?php require_once('navbar.php');  ?>
      
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