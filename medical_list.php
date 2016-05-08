<?php 
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  include_once("check.php");

  if($row_RecMember["m_level"] == 'admin'){
    $query_RecMedical = "SELECT * FROM `medical` ORDER BY `joindatetime` DESC";
    $RecMedical = mysqli_query($conn, $query_RecMedical);
  }elseif ($row_RecMember["m_level"] == 'doctor') {
    $query_RecMedical = "SELECT * FROM `medical` WHERE `doctor` ='".$row_RecMember["m_sn"]."' ORDER BY `joindatetime` DESC";
    $RecMedical = mysqli_query($conn, $query_RecMedical);
  }elseif ($row_RecMember["m_level"] == 'assistant'){
    $query_RecMedical = "SELECT * FROM `medical` WHERE `m_sn` ='".$row_RecMember["m_sn"]."' ORDER BY `joindatetime` DESC";
    $RecMedical = mysqli_query($conn, $query_RecMedical);
  }

  //刪除病歷
  if(isset($_GET["action"])&&($_GET["action"]=="delete")){  
    $query_delMedical = "DELETE FROM `medical` WHERE `sn`=".$_GET["id"];
    mysqli_query($conn, $query_delMedical); 
    //重新導向回到主畫面
    header("Location: medical_list.php");
  }

  //預設每頁筆數
  $pageRow_records = 12;
  //預設頁數
  $num_pages = 1;
  //若已經有翻頁，將頁數更新
  if (isset($_GET['page'])) {
    $num_pages = $_GET['page'];
  }
  //本頁開始記錄筆數 = (頁數-1)*每頁記錄筆數
  $startRow_records = ($num_pages -1) * $pageRow_records;
  //未加限制顯示筆數的SQL敘述句
  $query_RecMember = "SELECT * FROM `member` WHERE `m_level`<>'manager' AND NOT `m_name` LIKE 'table%' ORDER BY `m_id` ASC";
  //加上限制顯示筆數的SQL敘述句，由本頁開始記錄筆數開始，每頁顯示預設筆數
  $query_limit_RecMember = $query_RecMember." LIMIT ".$startRow_records.", ".$pageRow_records;
  //以加上限制顯示筆數的SQL敘述句查詢資料到 $resultMember 中
  $RecMember = mysql_query($query_limit_RecMember);
  //以未加上限制顯示筆數的SQL敘述句查詢資料到 $all_resultMember 中
  $all_RecMember = mysql_query($query_RecMember);
  //計算總筆數
  $total_records = mysql_num_rows($all_RecMember);
  //計算總頁數=(總筆數/每頁筆數)後無條件進位。
  $total_pages = ceil($total_records/$pageRow_records);

  
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
  <script>
    function submitForm(){
      $('#ff').submit();
    }
    function deletesure(){
      if (confirm('\n您確定要刪除?\n刪除後無法恢復!\n')) return true;
      return false;
    }
  </script>
  </head>
  <body>
    <?php if(isset($_GET["loginStats"]) && ($_GET["loginStats"] == "1")){ ?>
    <script language="javascript">
      alert('初診病歷新增成功。\n');
      window.location.href='medical_list.php';
    </script>
    <?php } ?>
     
      <?php require_once('navbar.php');  ?>

      <div class="container theme-showcase" role="main">
        <div class="jumbotron">
          <div class="page-header">
            <h2>瀏覽病歷</h2>
          </div>
          <div class="col-sm-offset-9 col-sm-10">
            <button type="button" class="btn btn-primary" onclick="location.href='first_visit.php'">
              <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>&nbsp;新增
            </button>
            <button type="button" class="btn btn-info" onclick="location.href='createfile.php?action=excel'">
              <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>&nbsp;Excel
            </button>
            <button type="button" class="btn btn-info" onclick="location.href='createfile.php?action=csv'">
              <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>&nbsp;CSV
            </button>
          </div>
            <table class="table table-hover" align="center" style="">
              <thead>
                <tr>
                  <th style="text-align:center;">刪除</th>
                  <th style="text-align:center;">編輯</th>
                  <th style="text-align:center;">就診日期</th>
                  <th style="text-align:center;">個案識別碼</th>
                  <th style="text-align:center;">性別</th>
                  <th style="text-align:center;">生日</th>
                  <?php if($row_RecMember["m_level"] == 'admin'){ ?>
                  <th style="text-align:center;">主治醫師</th>
                  <?php } ?>
                  <th style="text-align:center;">Key in 人員</th>
                  <th style="text-align:center;">登記日期時間</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row_RecMedical=mysqli_fetch_assoc($RecMedical)) { ?>
                <tr>
                  <td align="center">
                    <?php 
                      $time = date("Y-m-d H:i:s");
                      $temp = (strtotime($time)- strtotime($row_RecMedical["joindatetime"]))/(60*60*24);
                      if($temp < 10){
                    ?>
                    <a href="?action=delete&id=<?php echo $row_RecMedical["sn"];?>" onClick="return deletesure();">
                      <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>
                    <?php } ?>
                  </td>
                  <td align="center">
                    <?php 
                      $time = date("Y-m-d H:i:s");
                      $temp = (strtotime($time)- strtotime($row_RecMedical["joindatetime"]))/(60*60*24);
                      if($temp < 10){
                    ?>
                    <a href="medical_update.php?id=<?php echo $row_RecMedical["sn"];?>">Edit</a>
                    <?php } ?>
                  </td>
                  <td align="center"><?php echo $row_RecMedical["date"];?></td>
                  <td align="center">
                      <input name="sn[]" type="hidden" value=<?php echo $row_RecMedical["sn"]; ?>>
                      <!-- <a href="medical_detail.php?id=<?php echo $row_RecMedical["sn"];?>"> -->
                        <?php echo $row_RecMedical["id"];?>
                      <!-- </a> -->
                  </td>
                  <td align="center"><?php echo $row_RecMedical["sex"];?></td>
                  <td align="center"><?php echo $row_RecMedical["birth_year"];?>年<?php echo $row_RecMedical["birth_month"];?>月</td>
                  <?php if($row_RecMember["m_level"] == 'admin'){ ?>
                  <td align="center"><?php echo $row_RecMedical["doctorName"];?></td>
                  <?php } ?>
                  <td align="center"><?php echo $row_RecMedical["keyName"];?></td>
                  <td align="center"><?php echo $row_RecMedical["joindatetime"];?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <hr>
            <div class="col-sm-offset-5 col-sm-10">
                
            </div>
        </div>
      </div>
  </body>
</html>