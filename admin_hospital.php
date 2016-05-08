<?php 
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  include_once("check_admin.php");

  $query_RecHospital = "SELECT * FROM `hospital` ";
  $RecHospital = mysqli_query($conn, $query_RecHospital);

  //刪除病歷
  if(isset($_GET["action"])&&($_GET["action"]=="delete")){  
    $query_delHospital = "DELETE FROM `hospital` WHERE `h_id`=".$_GET["id"];
    mysqli_query($conn, $query_delHospital); 
    //重新導向回到主畫面
    header("Location: admin_hospital.php");
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
     
     <?php require_once('navbar.php'); ?>
     
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
            <li>
                <a href="admin_member.php">Manage Member</a>
            </li>
            <li class="active">
              <a href="admin_hospital.php">Manage Hospital</a>
            </li>
          </ul>
          
          <div class="page-header">
            <div class="form-group">
              <div class="col-sm-offset-0 col-sm-10">
                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>新增參與醫院
                </button>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <form method="post" action="add_hospital.php">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                      <h3 class="modal-title" id="myModalLabel">新增參與醫院</h3>
                    </div>
                    <div class="modal-body">
                       
                        <h4>醫院名稱：
                          <input name="h_name" type="text" size="40">
                        </h4>
                        <h4>醫院簡稱：
                          <input name="h_nickname" type="text">
                        </h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input name="action" type="hidden" id="action" value="join">
                      <button type="submit" class="btn btn-primary">ADD</button>
                    </div>
                  </form> 
                </div>
              </div>
            </div>
            <table class="table table-hover" align="center" style="">
              <thead>
                <tr>
                  <th style="text-align:center;">Delete</th>
                  <th style="text-align:center;">編號</th>
                  <th style="text-align:center;">醫院名稱</th>
                  <th style="text-align:center;">醫院簡稱</th>
                  <th style="text-align:center;">加入日期</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row_RecHospital=mysqli_fetch_assoc($RecHospital)) { ?>
                <tr>
                  <td align="center">
                    <a href="?action=delete&id=<?php echo $row_RecHospital["h_id"];?>" onClick="return deletesure();">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                  </td>
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
      </div>
  </body>
</html>