<?php 
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  require_once("check.php");

  if($row_RecMember["m_level"] == 'admin'){
    $query_RecMedical = "SELECT * FROM `medical` WHERE `sn`='".$_GET["id"]."'";
    $RecMedical = mysqli_query($conn, $query_RecMedical);
    $row_RecMedical = mysqli_fetch_assoc($RecMedical);
  }elseif ($row_RecMember["m_level"] == 'doctor') {
    $query_RecMedical = "SELECT * FROM `medical` WHERE `sn`='".$_GET["id"]."'";
    $RecMedical = mysqli_query($conn, $query_RecMedical);
    $row_RecMedical = mysqli_fetch_assoc($RecMedical);
    if($row_RecMedical["doctor"] != $row_RecMember["m_name"]){
      header("Location: medical_list.php");
    }
  }elseif ($row_RecMember["m_level"] == 'assistant'){
    $query_RecMedical = "SELECT * FROM `medical` WHERE `sn`='".$_GET["id"]."'";
    $RecMedical = mysqli_query($conn, $query_RecMedical);
    $row_RecMedical = mysqli_fetch_assoc($RecMedical);
    if($row_RecMedical["m_sn"] != $row_RecMember["m_name"]){
      header("Location: medical_list.php");
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
  </head>
  <body>
    
    <?php require_once('navbar.php');  ?>
      
    <div class="container theme-showcase" role="main">
      <!--基本資料-->
      <div class="jumbotron">
        <h2>基本資料</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>就診日期：</dt>
            <dd><?php echo $row_RecMedical["date"]; ?></dd>
            <dt>就診醫療院所：</dt>
            <dd><?php echo $row_RecMedical["h_name"]; ?></dd>
            <dt>個案識別碼：</dt>
            <dd><?php echo $row_RecMedical["id"]; ?></dd>
            <dt>性別：</dt>
            <dd><?php echo $row_RecMedical["sex"]; ?></dd>
            <dt>身高：</dt>
            <dd><?php echo $row_RecMedical["height"]; ?></dd>
            <dt>體重：</dt>
            <dd><?php echo $row_RecMedical["weight"]; ?></dd>
            <dt>生日：</dt>
            <dd><?php echo $row_RecMedical["birth_year"]; ?>年<?php echo $row_RecMedical["birth_month"]; ?>月</dd>
            <dt>個案現居地：</dt>
            <dd><?php echo $row_RecMedical["location"]; ?></dd>
            <dt>您的身份為：</dt>
            <dd>
              <?php
                if ($row_RecMedical["casetype1"] == 99) {
                   echo "99";
                }else{
                  $casetype = array();
                  if ($row_RecMedical["casetype1"] == 1) {
                    array_push($casetype, "一般");
                  }
                  if ($row_RecMedical["casetype2"] == 1) {
                    array_push($casetype, "原住民");
                  }
                  if ($row_RecMedical["casetype3"] == 1) {
                    array_push($casetype, "榮民");
                  }
                  if ($row_RecMedical["casetype4"] == 1) {
                    array_push($casetype, "合併精神病患");
                  }
                  if ($row_RecMedical["casetype5"] == 1) {
                    array_push($casetype, "性工作者");
                  }
                  if ($row_RecMedical["casetype6"] == 1) {
                    array_push($casetype, "中輟生");
                  }
                  if ($row_RecMedical["casetype7"] == 1) {
                    array_push($casetype, "監所受刑人");
                  }
                  if ($row_RecMedical["casetype8"] == 1) {
                    array_push($casetype, "外籍人士");
                  }
                  echo implode(",", $casetype);
                }
              ?>
            </dd>
            <dt>職業：</dt>
            <dd><?php echo $row_RecMedical["job"]; ?></dd>
            <dt>教育程度：</dt>
            <dd><?php echo $row_RecMedical["edu"]; ?></dd>
            <dt>婚姻狀況：</dt>
            <dd><?php echo $row_RecMedical["marriage"]; ?></dd>
            <dt>併存疾病：</dt>
            <dd>
              <?php
                if ($row_RecMedical["comor1"] == 99) {
                    echo "99";
                }elseif ($_POST["comor1"] == 0 && $_POST["comor2"] == 0 && $_POST["comor3"] == 0 && 
                         $_POST["comor4"] == 0 && $_POST["comor5"] == 0 && $_POST["comor6"] == 0 && 
                         $_POST["comor7"] == 0 && $_POST["comor8"] == 0 && $_POST["comor9"] == 0 && 
                         $_POST["comor10"] == 0 && $_POST["comor11"] == 0 && $_POST["comor12"] == 0 && 
                         $_POST["comor13"] == 0 && $_POST["comor14"] == 0 && $_POST["comor_other"] == "0") {
                  echo "無";
                
                }else{
                  $comor = array();
                  if ($row_RecMedical["comor1"] == 1) {
                    array_push($comor, "AIDS");
                  }
                  if ($row_RecMedical["comor2"] == 1) {
                    array_push($comor, "B型肝炎");
                  }
                  if ($row_RecMedical["comor3"] == 1) {
                    array_push($comor, "Ｃ型肝炎");
                  }
                  if ($row_RecMedical["comor4"] == 1) {
                    array_push($comor, "膀胱炎");
                  }
                  if ($row_RecMedical["comor5"] == 1) {
                    array_push($comor, "胃痛");
                  }
                  if ($row_RecMedical["comor6"] == 1) {
                    array_push($comor, "下腹痛");
                  }
                  if ($row_RecMedical["comor7"] == 1) {
                    array_push($comor, "梅毒");
                  }
                  if ($row_RecMedical["comor8"] == 1) {
                    array_push($comor, "精神疾病");
                  }
                  if ($row_RecMedical["comor9"] == 1) {
                    array_push($comor, "結核病");
                  }
                  if ($row_RecMedical["comor10"] == 1) {
                    array_push($comor, "腦血管疾病");
                  }
                  if ($row_RecMedical["comor11"] == 1) {
                    array_push($comor, "癌症");
                  }
                  if ($row_RecMedical["comor12"] == 1) {
                    array_push($comor, "糖尿病");
                  }
                  if ($row_RecMedical["comor13"] == 1) {
                    array_push($comor, "鼻穿孔");
                  }
                  if ($row_RecMedical["comor14"] == 1) {
                    array_push($comor, "憂鬱症");
                  }
                  if ($row_RecMedical["comor_other"] != "0" && $row_RecMedical["comor_other"] != "99") {
                    array_push($comor, $row_RecMedical["comor_other"]);
                  }
                  echo implode(",", $comor);
                }
              ?>
            </dd>
            <dt>最近三個月性生活情形：</dt>
            <dd><?php echo $row_RecMedical["regular_sex_partner"]; ?></dd>
            <dt>是否抽菸？</dt>
            <dd><?php echo $row_RecMedical["smoking"]; ?></dd>
            <dt>是否喝酒？</dt>
            <dd><?php echo $row_RecMedical["drinking"]; ?></dd>
            <dt>是否嚼檳榔？</dt>
            <dd><?php echo $row_RecMedical["betel_nut"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--藥物濫用資料-->
      <div class="jumbotron">
        <h2>藥物濫用資料</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>一、濫用藥物的原因：</dt>
            <dd>
              <?php
                if ($row_RecMedical["drugreason1"] == 99) {
                  echo "99";
                }else{
                  $drugreason = array();
                  if ($row_RecMedical["drugreason1"]) {
                    array_push($drugreason, "無聊");
                  }
                  if ($row_RecMedical["drugreason2"]) {
                    array_push($drugreason, "好奇");
                  }
                  if ($row_RecMedical["drugreason3"]) {
                    array_push($drugreason, "找刺激");
                  }
                  if ($row_RecMedical["drugreason4"]) {
                    array_push($drugreason, "自殺");
                  }
                  if ($row_RecMedical["drugreason5"]) {
                    array_push($drugreason, "紓解壓力");
                  }
                  if ($row_RecMedical["drugreason6"]) {
                    array_push($drugreason, "受同儕團體影響");
                  }
                  if ($row_RecMedical["drugreason7"]) {
                    array_push($drugreason, "提神");
                  }
                  if ($row_RecMedical["drugreason8"]) {
                    array_push($drugreason, "治療疾病");
                  }
                  if ($row_RecMedical["drugreason9"]) {
                    array_push($drugreason, "安眠");
                  }
                  if ($row_RecMedical["drugreason10"]) {
                    array_push($drugreason, "藥物依賴");
                  }
                  if ($row_RecMedical["drugreason11"]) {
                    array_push($drugreason, "減肥");
                  }
                  if ($row_RecMedical["drugreason12"]) {
                    array_push($drugreason, "失戀");
                  }
                  if ($row_RecMedical["drugreason13"]) {
                    array_push($drugreason, "失業");
                  }
                  if ($row_RecMedical["drugreason14"]) {
                    array_push($drugreason, "憂鬱");
                  }
                  if ($row_RecMedical["drugreason_other"] != "0" && $row_RecMedical["drugreason_other"] != "99") {
                    array_push($drugreason, $row_RecMedical["drugreason_other"]);
                  }
                  echo implode(",", $drugreason);
                }
              ?>
            </dd>
            <dt>二、取得藥物的場所：</dt>
            <dd>
              <?php
                if ($row_RecMedical["drugplace1"] == 99) {
                  echo "99";
                }else{
                  $drugplace = array();
                  if ($row_RecMedical["drugplace1"]) {
                    array_push($drugplace, "醫院");
                  }
                  if ($row_RecMedical["drugplace2"]) {
                    array_push($drugplace, "藥局(房)");
                  }
                  if ($row_RecMedical["drugplace3"]) {
                    array_push($drugplace, "學校");
                  }
                  if ($row_RecMedical["drugplace4"]) {
                    array_push($drugplace, "舞廳/PUB/酒店");
                  }
                  if ($row_RecMedical["drugplace5"]) {
                    array_push($drugplace, "KTV/MTV/網咖");
                  }
                  if ($row_RecMedical["drugplace6"]) {
                    array_push($drugplace, "賭場");
                  }
                  if ($row_RecMedical["drugplace7"]) {
                    array_push($drugplace, "電動玩具店/遊樂場");
                  }
                  if ($row_RecMedical["drugplace8"]) {
                    array_push($drugplace, "色情場所");
                  }
                  if ($row_RecMedical["drugplace9"]) {
                    array_push($drugplace, "旅館");
                  }
                  if ($row_RecMedical["drugplace10"]) {
                    array_push($drugplace, "檳榔攤");
                  }
                  if ($row_RecMedical["drugplace11"]) {
                    array_push($drugplace, "書局/商店/五金行");
                  }
                  if ($row_RecMedical["drugplace12"]) {
                    array_push($drugplace, "網路");
                  }
                  if ($row_RecMedical["drugplace13"]) {
                    array_push($drugplace, "雜誌/報紙/廣告");
                  }
                  if ($row_RecMedical["drugplace14"]) {
                    array_push($drugplace, "車上");
                  }
                  if ($row_RecMedical["drugplace15"]) {
                    array_push($drugplace, "路邊");
                  }
                  if ($row_RecMedical["drugplace16"]) {
                    array_push($drugplace, "朋友住處");
                  }
                  if ($row_RecMedical["drugplace17"]) {
                    array_push($drugplace, "藥癮戒治機構附近");
                  }
                  if ($row_RecMedical["drugplace18"]) {
                    array_push($drugplace, "國外");
                  }
                  if ($row_RecMedical["drugplace_other"] != "0" && $row_RecMedical["drugplace_other"] != "99") {
                    array_push($drugplace, $row_RecMedical["drugplace_other"]);
                  }
                  echo implode(",", $drugplace);
                }
              ?>
            </dd>
            <dt>三、取得藥物的來源：</dt>
            <dd>
              <?php
              if ($row_RecMedical["drugsource1"] == 99) {
                echo "99";
              }else{
                $drugsource = array();
                if ($row_RecMedical["drugsource1"] == 1) {
                  array_push($drugsource, "醫師");
                }
                if ($row_RecMedical["drugsource2"] == 1) {
                  array_push($drugsource, "藥師");
                }
                if ($row_RecMedical["drugsource3"] == 1) {
                  array_push($drugsource, "朋友");
                }
                if ($row_RecMedical["drugsource4"] == 1) {
                  array_push($drugsource, "同學");
                }
                if ($row_RecMedical["drugsource5"] == 1) {
                  array_push($drugsource, "親人");
                }
                if ($row_RecMedical["drugsource6"] == 1) {
                  array_push($drugsource, "藥頭/毒販");
                }
                if ($row_RecMedical["drugsource7"] == 1) {
                  array_push($drugsource, "自己販賣");
                }
                if ($row_RecMedical["drugsource8"] == 1) {
                  array_push($drugsource, "書局/商店/五金行老闆");
                }
                if ($row_RecMedical["drugsource_other"] != "0" && $row_RecMedical["drugsource_other"] != "99") {
                  array_push($drugsource, $row_RecMedical["drugsource_other"]);
                }

                echo implode(",", $drugsource);
              }
              ?>
            </dd>
            <dt>首次使用Ｋ他命年齡：</dt>
            <dd><?php echo $row_RecMedical["first_ketamine_age"]; ?>歲</dd>
            <dt>使用期間：</dt>
            <dd><?php echo $row_RecMedical["ketamine_history"]; ?>個月</dd>
            <dt>每天平均Ｋ他命的量：</dt>
            <dd><?php echo $row_RecMedical["ketamine_ave"]; ?>公克</dd>
            <dt>主要使用方式：</dt>
            <dd><?php echo $row_RecMedical["ketamine_method"]; ?></dd>
            <dt>有合併使用其他種類之藥物嗎？</dt>
            <dd><?php echo $row_RecMedical["combined_drug"]; ?></dd>
            <dt>膀胱症狀已經有多久的時間，約為：</dt>
            <dd><?php echo $row_RecMedical["symptom_starting_date"]; ?></dd>
            <dt>是否已戒除Ｋ他命？</dt>
            <dd>
              <?php
                if ($row_RecMedical["stop_ketamine"] == 0) {
                  echo "否";
                }else{
                  echo "是,已戒除";
                  echo $row_RecMedical["stop_ketamine_month"];
                  echo "個月";
                } 
              ?>
            </dd>
          </dl>
        </div>
      </div>
      <!--下泌尿道症狀評分表IPSS-->
      <div class="jumbotron">
        <h2>下泌尿道症狀評分表(IPSS)</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>IPSS-1：</dt>
            <dd><?php echo $row_RecMedical["IPSS_score1"]; ?></dd>
            <dt>IPSS-2：</dt>
            <dd><?php echo $row_RecMedical["IPSS_score2"]; ?></dd>
            <dt>IPSS-3：</dt>
            <dd><?php echo $row_RecMedical["IPSS_score3"]; ?></dd>
            <dt>IPSS-4：</dt>
            <dd><?php echo $row_RecMedical["IPSS_score4"]; ?></dd>
            <dt>IPSS-5：</dt>
            <dd><?php echo $row_RecMedical["IPSS_score5"]; ?></dd>
            <dt>IPSS-6：</dt>
            <dd><?php echo $row_RecMedical["IPSS_score6"]; ?></dd>
            <dt>IPSS-7：</dt>
            <dd><?php echo $row_RecMedical["IPSS_score7"]; ?></dd>
            <dt>泌尿症狀影響生活素質：</dt>
            <dd><?php echo $row_RecMedical["urinary_quality_life"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--間質性膀胱炎症狀指標-->
      <div class="jumbotron">
        <h2>間質性膀胱炎症狀指標</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>間質性膀胱炎症狀指標1：</dt>
            <dd><?php echo $row_RecMedical["IC_symptom1"]; ?></dd>
            <dt>間質性膀胱炎症狀指標2：</dt>
            <dd><?php echo $row_RecMedical["IC_symptom2"]; ?></dd>
            <dt>間質性膀胱炎症狀指標3：</dt>
            <dd><?php echo $row_RecMedical["IC_symptom3"]; ?></dd>
            <dt>間質性膀胱炎症狀指標4：</dt>
            <dd><?php echo $row_RecMedical["IC_symptom4"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--間質性膀胱炎問題指標-->
      <div class="jumbotron">
        <h2>間質性膀胱炎問題指標</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>間質性膀胱炎問題指標1：</dt>
            <dd><?php echo $row_RecMedical["IC_question1"]; ?></dd>
            <dt>間質性膀胱炎問題指標2：</dt>
            <dd><?php echo $row_RecMedical["IC_question2"]; ?></dd>
            <dt>間質性膀胱炎問題指標3：</dt>
            <dd><?php echo $row_RecMedical["IC_question3"]; ?></dd>
            <dt>間質性膀胱炎問題指標4：</dt>
            <dd><?php echo $row_RecMedical["IC_question4"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--膀胱疼痛指數-->
      <div class="jumbotron">
        <h2>膀胱疼痛指數</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>疼痛指數：</dt>
            <dd><?php echo $row_RecMedical["VAS"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--簡式健康表（BSRS）-->
      <div class="jumbotron">
        <h2>簡式健康表(BSRS)</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>BSRS-1：</dt>
            <dd><?php echo $row_RecMedical["BSRS1"]; ?></dd>
            <dt>BSRS-2：</dt>
            <dd><?php echo $row_RecMedical["BSRS2"]; ?></dd>
            <dt>BSRS-3：</dt>
            <dd><?php echo $row_RecMedical["BSRS3"]; ?></dd>
            <dt>BSRS-4：</dt>
            <dd><?php echo $row_RecMedical["BSRS4"]; ?></dd>
            <dt>BSRS-5：</dt>
            <dd><?php echo $row_RecMedical["BSRS5"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--國際女性性功能指標(FSFI)調查-->
      <div class="jumbotron">
        <h2>國際女性性功能指標(FSFI)調查</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>FSFI-1：</dt>
            <dd><?php echo $row_RecMedical["FSFI1"]; ?></dd>
            <dt>FSFI-2：</dt>
            <dd><?php echo $row_RecMedical["FSFI2"]; ?></dd>
            <dt>FSFI-3：</dt>
            <dd><?php echo $row_RecMedical["FSFI3"]; ?></dd>
            <dt>FSFI-4：</dt>
            <dd><?php echo $row_RecMedical["FSFI4"]; ?></dd>
            <dt>FSFI-5：</dt>
            <dd><?php echo $row_RecMedical["FSFI5"]; ?></dd>
            <dt>FSFI-6：</dt>
            <dd><?php echo $row_RecMedical["FSFI6"]; ?></dd>
            <dt>FSFI-7：</dt>
            <dd><?php echo $row_RecMedical["FSFI7"]; ?></dd>
            <dt>FSFI-8：</dt>
            <dd><?php echo $row_RecMedical["FSFI8"]; ?></dd>
            <dt>FSFI-9：</dt>
            <dd><?php echo $row_RecMedical["FSFI9"]; ?></dd>
            <dt>FSFI-10：</dt>
            <dd><?php echo $row_RecMedical["FSFI10"]; ?></dd>
            <dt>FSFI-11：</dt>
            <dd><?php echo $row_RecMedical["FSFI11"]; ?></dd>
            <dt>FSFI-12：</dt>
            <dd><?php echo $row_RecMedical["FSFI12"]; ?></dd>
            <dt>FSFI-13：</dt>
            <dd><?php echo $row_RecMedical["FSFI13"]; ?></dd>
            <dt>FSFI-14：</dt>
            <dd><?php echo $row_RecMedical["FSFI14"]; ?></dd>
            <dt>FSFI-15：</dt>
            <dd><?php echo $row_RecMedical["FSFI15"]; ?></dd>
            <dt>FSFI-16：</dt>
            <dd><?php echo $row_RecMedical["FSFI16"]; ?></dd>
            <dt>FSFI-17：</dt>
            <dd><?php echo $row_RecMedical["FSFI17"]; ?></dd>
            <dt>FSFI-18：</dt>
            <dd><?php echo $row_RecMedical["FSFI18"]; ?></dd>
            <dt>FSFI-19：</dt>
            <dd><?php echo $row_RecMedical["FSFI19"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--國際男性性功能指標(IIEF)調查-->
      <div class="jumbotron">
        <h2>國際男性性功能指標(IIEF)調查</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>IIEF-1：</dt>
            <dd><?php echo $row_RecMedical["IIEF1"]; ?></dd>
            <dt>IIEF-2：</dt>
            <dd><?php echo $row_RecMedical["IIEF2"]; ?></dd>
            <dt>IIEF-3：</dt>
            <dd><?php echo $row_RecMedical["IIEF3"]; ?></dd>
            <dt>IIEF-4：</dt>
            <dd><?php echo $row_RecMedical["IIEF4"]; ?></dd>
            <dt>IIEF-5：</dt>
            <dd><?php echo $row_RecMedical["IIEF5"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--醫師登記表-->
      <div class="jumbotron">
        <h2>醫師登記表</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>第一次收案：</dt>
            <dd>
              <?php
                if ($row_RecMedical["firstmedical"] == 0) {
                  echo "否";
                }else{
                  echo "是";
                }
              ?>
            </dd>
          </dl>
          <h3>Treatment</h3>
          <dl class="dl-horizontal">
            <dt>治療日期：</dt>
            <dd><?php echo $row_RecMedical["tx_date"]; ?></dd>
          </dl>
          <h4>止痛</h4>
          <dl class="dl-horizontal">
            <dt>NSAID 例如 Diclofenca：</dt>
            <dd><?php echo $row_RecMedical["tx_nsaid"]; ?></dd>
            <dt>Cox-2 I 例如 Celebrex：</dt>
            <dd><?php echo $row_RecMedical["tx_cox2"]; ?></dd>
            <dt>Opioid 例如 Tramadol：</dt>
            <dd><?php echo $row_RecMedical["tx_opioid"]; ?></dd>
            <dt>Morphin：</dt>
            <dd><?php echo $row_RecMedical["tx_morphin"]; ?></dd>
          </dl>
          <h4>膀胱</h4>
          <dl class="dl-horizontal">
            <dt>Anti-M 例如 oxbu, vesicare, detrusitol, urotrol, etc.：</dt>
            <dd><?php echo $row_RecMedical["tx_antim"]; ?></dd><hr>
            <dt>Double Anti-M：</dt>
            <dd><?php echo $row_RecMedical["tx_double_antim"]; ?></dd><hr>
            <dt>Mucosa: oral pentosan：</dt>
            <dd><?php echo $row_RecMedical["tx_mucosa_op"]; ?></dd><hr>
            <dt>Mucosa: intravesical cystistat：</dt>
            <dd><?php echo $row_RecMedical["tx_mucosa_ic"]; ?></dd><hr>
            <dt>Hydrodistention：</dt>
            <dd><?php echo $row_RecMedical["tx_hydrodistention"]; ?></dd>
          </dl>
          <h5>Botox</h5>
          <dl class="dl-horizontal">
            <dt>intradetrusor:100U：</dt>
            <dd><?php echo $row_RecMedical["tx_botox_id100u"]; ?></dd><hr>
            <dt>intratrigone:100U：</dt>
            <dd><?php echo $row_RecMedical["tx_botox_it100u"]; ?></dd><hr>
            <dt>intradetrusor+intratrigone 100U：</dt>
            <dd><?php echo $row_RecMedical["tx_botox_idit100u"]; ?></dd>
          </dl>
          <h5>Enterocystoplasty</h5>
          <dl class="dl-horizontal">
            <dt>without resection of bladder：</dt>
            <dd><?php echo $row_RecMedical["tx_ewithout"]; ?></dd><hr>
            <dt>with partial resection of bladder：</dt>
            <dd><?php echo $row_RecMedical["tx_epartial"]; ?></dd><hr>
            <dt>with resection of whole bladder：</dt>
            <dd><?php echo $row_RecMedical["tx_ewhole"]; ?></dd>
          </dl>
          <h4>輸尿管</h4>
          <dl class="dl-horizontal">
            <dt>DJ one side：</dt>
            <dd><?php echo $row_RecMedical["tx_dj_one"]; ?></dd>
            <dt>DJ both sides：</dt>
            <dd><?php echo $row_RecMedical["tx_dj_both"]; ?></dd>
            <dt>PCND one side：</dt>
            <dd><?php echo $row_RecMedical["tx_pcnd_one"]; ?></dd>
            <dt>PCND both sides：</dt>
            <dd><?php echo $row_RecMedical["tx_pcnd_both"]; ?></dd>
            <dt>其他治療方式：</dt>
            <dd><?php echo $row_RecMedical["tx_other"]; ?></dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>醫師評估日期：</dt>
            <dd><?php echo $row_RecMedical["register_date"]; ?></dd>
            <dt>BP：</dt>
            <dd><?php echo $row_RecMedical["systolic_pressure"]; ?>/<?php echo $row_RecMedical["diastolic_pressure"]; ?></dd>
            <dt>Hematuria：</dt>
            <dd><?php echo $row_RecMedical["gross_hematuria"]; ?></dd>
            <dt>Other Symptoms：</dt>
            <dd><?php echo $row_RecMedical["other_symptoms"]; ?></dd>
          </dl>
          <h4>Voiding Diary</h4>
          <dl class="dl-horizontal">
            <dt>1<sup>st</sup>Day:Day/Night：</dt>
            <dd><?php echo $row_RecMedical["Diary_1D"]; ?>/<?php echo $row_RecMedical["Diary_1N"]; ?></dd>
            <dt>2<sup>nd</sup>Day:Day/Night：</dt>
            <dd><?php echo $row_RecMedical["Diary_2D"]; ?>/<?php echo $row_RecMedical["Diary_2N"]; ?></dd>
            <dt>Maximal voided volme:</dt>
            <dd><?php echo $row_RecMedical["Diary_Max_VV"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--Urine Tests-->
      <div class="jumbotron">
        <h2>Urine Tests</h2>
        <div class="page-header">
          <h4>Urinalysis</h4>
          <dl class="dl-horizontal">
            <dt>WBC：</dt>
            <dd><?php echo $row_RecMedical["Urine_routine_WBC_HPF"]; ?></dd>
            <dt>RBC：</dt>
            <dd><?php echo $row_RecMedical["Urine_routine_RBC_HPF"]; ?></dd>
            <dt>Nit：</dt>
            <dd><?php echo $row_RecMedical["Urine_routine_Nit"]; ?></dd>
            <dt>LEU：</dt>
            <dd><?php echo $row_RecMedical["Urine_routine_LEU"]; ?></dd>
            <dt>Bact：</dt>
            <dd><?php echo $row_RecMedical["Urine_routine_Bact"]; ?></dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>Urnie Culture：</dt>
            <dd><?php echo $row_RecMedical["Urine_culture"]; ?></dd>
          </dl>

          <dl class="dl-horizontal">
            <dt>Urine Cytology：</dt>
            <dd><?php echo $row_RecMedical["cytology"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--Blood Tests-->
      <div class="jumbotron">
        <h2>Blood Tests</h2>
        <div class="page-header">
          <h4>Sexually transmitted disease</h4>
          <dl class="dl-horizontal">
            <dt>HIV：</dt>
            <dd><?php echo $row_RecMedical["STD_HIV"]; ?></dd>
            <dt>VDRL/STS：</dt>
            <dd><?php echo $row_RecMedical["STD_VDRL"]; ?></dd>
            <dt>TPHA：</dt>
            <dd><?php echo $row_RecMedical["STD_TPHA"]; ?></dd>
          </dl>
          <h4>Renal function</h4>
          <dl class="dl-horizontal">
            <dt>BUN：</dt>
            <dd><?php echo $row_RecMedical["Renal_function_BUN"]; ?></dd>
            <dt>Cr：</dt>
            <dd><?php echo $row_RecMedical["Renal_function_Cr"]; ?></dd>
          </dl>
          <h4>Liver function</h4>
          <dl class="dl-horizontal">
            <dt>GOT(AST)：</dt>
            <dd><?php echo $row_RecMedical["Liver_function_GOT"]; ?></dd>
            <dt>GPT(ALT)：</dt>
            <dd><?php echo $row_RecMedical["Liver_function_GPT"]; ?></dd>
            <dt>Albumin：</dt>
            <dd><?php echo $row_RecMedical["Liver_function_ALB"]; ?></dd>
            <dt>BIL：</dt>
            <dd><?php echo $row_RecMedical["Liver_function_BIL"]; ?></dd>
          </dl>
          <h4>Hematology</h4>
          <dl class="dl-horizontal">
            <dt>WBC：</dt>
            <dd><?php echo $row_RecMedical["Hematology_WBC"]; ?></dd>
            <dt>Hgb：</dt>
            <dd><?php echo $row_RecMedical["Hematology_Hgb"]; ?></dd>
            <dt>Platelet：</dt>
            <dd><?php echo $row_RecMedical["Hematology_Pl"]; ?></dd>
            <dt>eosinophil：</dt>
            <dd><?php echo $row_RecMedical["Hematology_eosinophil"]; ?></dd>
          </dl>
          <h4>Immunology</h4>
          <dl class="dl-horizontal">
            <dt>IgE：</dt>
            <dd><?php echo $row_RecMedical["Immune_IgE"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--Renal Sonography-->
      <div class="jumbotron">
        <h2>Renal Sonography</h2>
        <div class="page-header">
          <h3>Right</h3>
          <dl class="dl-horizontal">
            <dt>Grade of cortical Echogenicity：</dt>
            <dd><?php echo $row_RecMedical["renal_echo_right_echogenicity"]; ?></dd>
            <dt>Grade of hydronephrosis：</dt>
            <dd><?php echo $row_RecMedical["renal_echo_right_kidney"]; ?></dd>
          </dl>
          <h3>Left</h3>
          <dl class="dl-horizontal">
            <dt>Grade of cortical Echogenicity：</dt>
            <dd><?php echo $row_RecMedical["renal_echo_left_echogenicity"]; ?></dd>
            <dt>Grade of hydronephrosis：</dt>
            <dd><?php echo $row_RecMedical["renal_echo_left_kidney"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--IVP-->
      <div class="jumbotron">
        <h2>IVP</h2>
        <div class="page-header">
          <h3>Right</h3>
          <dl class="dl-horizontal">
            <dt>normal：</dt>
            <dd></dd>
            <dt>Cortex thinning：</dt>
            <dd></dd>
            <dt>hydronephrosis：</dt>
            <dd></dd>
          </dl>
          <h4>Ureteral stricture</h4>
          <dl class="dl-horizontal">
            <dt>Upper：</dt>
            <dd></dd>
            <dt>Middle：</dt>
            <dd></dd>
            <dt>Lower：</dt>
            <dd></dd>
          </dl>
          <h3>Left</h3>
          <dl class="dl-horizontal">
            <dt>normal：</dt>
            <dd></dd>
            <dt>Cortex thinning：</dt>
            <dd></dd>
            <dt>hydronephrosis：</dt>
            <dd></dd>
          </dl>
          <h4>Ureteral stricture</h4>
          <dl class="dl-horizontal">
            <dt>Upper：</dt>
            <dd></dd>
            <dt>Middle：</dt>
            <dd></dd>
            <dt>Lower：</dt>
            <dd></dd>
          </dl>
        </div>
      </div>
      <!--CT-->
      <div class="jumbotron">
        <h2>CT</h2>
        <div class="page-header">
          <h3>Right</h3>
          <dl class="dl-horizontal">
            <dt>normal：</dt>
            <dd></dd>
            <dt>Cortex thinning：</dt>
            <dd></dd>
            <dt>hydronephrosis：</dt>
            <dd></dd>
          </dl>
          <h4>Ureteral stricture</h4>
          <dl class="dl-horizontal">
            <dt>Upper：</dt>
            <dd></dd>
            <dt>Middle：</dt>
            <dd></dd>
            <dt>Lower：</dt>
            <dd></dd>
          </dl>
          <h3>Left</h3>
          <dl class="dl-horizontal">
            <dt>normal：</dt>
            <dd></dd>
            <dt>Cortex thinning：</dt>
            <dd></dd>
            <dt>hydronephrosis：</dt>
            <dd></dd>
          </dl>
          <h4>Ureteral stricture</h4>
          <dl class="dl-horizontal">
            <dt>Upper：</dt>
            <dd></dd>
            <dt>Middle：</dt>
            <dd></dd>
            <dt>Lower：</dt>
            <dd></dd>
          </dl>
        </div>
      </div>
      <!--Ultrasound of Bladder-->
      <div class="jumbotron">
        <h2>Ultrasound of Bladder</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>PVR：</dt>
            <dd><?php echo $row_RecMedical["PVR"]; ?></dd>
            <dt>Wall thickness：</dt>
            <dd><?php echo $row_RecMedical["bladder_echo_BW_thickness"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--Uroflowmetry-->
      <div class="jumbotron">
        <h2>Uroflowmetry</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>Qmax：</dt>
            <dd><?php echo $row_RecMedical["Uroflowmetry_Qmax"]; ?></dd>
            <dt>Voided volume：</dt>
            <dd><?php echo $row_RecMedical["Uroflowmetry_VV"]; ?></dd>
            <dt>Pattern：</dt>
            <dd><?php echo $row_RecMedical["Uroflowmetry_Pattern"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--VCUG-->
      <div class="jumbotron">
        <h2>VCUG</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>Grade of trabeculation：</dt>
            <dd><?php echo $row_RecMedical["VCUG_trabeculation"]; ?></dd>
            <dt>Left VUR(Grade)：</dt>
            <dd><?php echo $row_RecMedical["VCUG_VUR_left"]; ?></dd>
            <dt>Right VUR(Grade)：</dt>
            <dd><?php echo $row_RecMedical["VCUG_VUR_right"]; ?></dd>
            <dt>DSD：</dt>
            <dd><?php echo $row_RecMedical["VCUG_DSD"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--Cystoscopy-->
      <div class="jumbotron">
        <h2>Cystoscopy</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>normal：</dt>
            <dd></dd>
            <dt>Ulcer：</dt>
            <dd><?php echo $row_RecMedical["cystoscopy_ulcer"]; ?></dd>
            <dt>Glomerulation：</dt>
            <dd><?php echo $row_RecMedical["cystoscopy_glomerulation"]; ?></dd>
            <dt>Grade of trabeculation：</dt>
            <dd><?php echo $row_RecMedical["cystoscopy_trabeculation"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--Urodynamic Study-->
      <div class="jumbotron">
        <h2>Urodynamic Study</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>First desire volume：</dt>
            <dd><?php echo $row_RecMedical["urodynamic_study_FD"]; ?></dd>
            <dt>Maximal Cystometric capacity：</dt>
            <dd><?php echo $row_RecMedical["urodynamic_study_MCC"]; ?></dd>
            <dt>Maximal Pdet：</dt>
            <dd><?php echo $row_RecMedical["urodynamic_study_MP"]; ?></dd>
            <dt>Detrusor overactivity：</dt>
            <dd><?php echo $row_RecMedical["urodynamic_study_DO"]; ?></dd>
            <dt>DSD：</dt>
            <dd><?php echo $row_RecMedical["urodynamic_study_DSD"]; ?>,<?php echo $row_RecMedical["US_DO_amplitude"]; ?>, <?php echo $row_RecMedical["US_DO_amplitude_at"]; ?></dd>
            <dt>Comliance：</dt>
            <dd><?php echo $row_RecMedical["urodynamic_study_compliance"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--Biopsy-->
      <div class="jumbotron">
        <h2>Biopsy</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>Denuded epithelitum：</dt>
            <dd><?php echo $row_RecMedical["biopsy_denuded_epi"]; ?></dd>
            <dt>Granulation：</dt>
            <dd><?php echo $row_RecMedical["biopsy_granulation"]; ?></dd>
            <dt>Fibronoid necrosis：</dt>
            <dd><?php echo $row_RecMedical["biopsy_fibronoid_necrosis"]; ?></dd>
            <dt>Eosinophil infiltration：</dt>
            <dd><?php echo $row_RecMedical["biopsy_eosinophil_infiltration"]; ?></dd>
          </dl>
        </div>
      </div>
      <!--其他-->
      <div class="jumbotron">
        <h2>其他</h2>
        <div class="page-header">
          <dl class="dl-horizontal">
            <dt>Psychiatric consultation：</dt>
            <dd><?php echo $row_RecMedical["psychi"]; ?></dd>
          </dl>
          <h4>Abdominal echo</h4>
          <dl class="dl-horizontal">
            <dt>Bile duct dilatation：</dt>
            <dd><?php echo $row_RecMedical["bile_duct_expand"]; ?></dd>
          </dl>
          <h4>Esophagealgastroscopy</h4>
          <dl class="dl-horizontal">
            <dt>Ulceration：</dt>
            <dd><?php echo $row_RecMedical["gastroscopy"]; ?></dd>
            <dt>HP Stain：</dt>
            <dd><?php echo $row_RecMedical["HP_examination"]; ?></dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>Other studies：</dt>
            <dd><?php echo $row_RecMedical["description"]; ?></dd>
          </dl>
        </div>
      </div>
      <div class="col-sm-offset-4 col-sm-10">
        <input name="action" type="hidden" id="action" value="join">
        <button type="button" class="btn btn-primary btn-lg" onClick="window.history.back();">
          <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;&nbsp;Back
        </button>&nbsp;&nbsp;
        <button type="button" class="btn btn-success btn-lg" onclick="location.href='medical_update.php?id=<?php echo $row_RecMedical["sn"]; ?>'">
          <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>&nbsp;&nbsp;Edit
        </button>
      </div>
    </div>
  </body>
</html>