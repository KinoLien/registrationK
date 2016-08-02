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
    // if($row_RecMedical["doctor"] != $row_RecMember["m_name"]){
    //   header("Location: medical_list.php");
    // }
  }elseif ($row_RecMember["m_level"] == 'assistant'){
    $query_RecMedical = "SELECT * FROM `medical` WHERE `sn`='".$_GET["id"]."'";
    $RecMedical = mysqli_query($conn, $query_RecMedical);
    $row_RecMedical = mysqli_fetch_assoc($RecMedical);
    if($row_RecMedical["m_sn"] != $row_RecMember["m_sn"]){
      header("Location: medical_list.php");
    }
  }
  $time = date("Y-m-d H:i:s");
  $temp = (strtotime($time)- strtotime($row_RecMedical["joindatetime"]))/(60*60*24);
  if($temp > 10){
    header("Location: medical_list.php");
  }

  

  $query_RecHospital = "SELECT * FROM `hospital` ";
  $RecHospital = mysqli_query($conn, $query_RecHospital);

?>
<!DOCTYPE html>
  <head>
  <meta charset="utf-8">
  <meta content='1440; url=logout.php' http-equiv='refresh'>
  <title>National Registration of Ketamine Uropathy</title>
  <link href="jquery-ui/jquery-ui.css"rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/jumbotron.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/ketaminejq.js"></script>
  <script language="javascript">
    function makesure(){
        if (confirm('\n您確定此初診病例資料無誤？\n')) return true;
        return false;
    }
  </script>
  <script type="text/javascript">
      $(document).ready(function() {
        var sex = "<?php echo $row_RecMedical["sex"]; ?>";
        if(sex == "Female"){
          $(".fsfi_info").show();
          $(".iief_info").hide();
        }else{
          $(".fsfi_info").hide();
          $(".iief_info").show();
        }
        /*下拉式default*/
        //身高
        var height = "<?php echo $row_RecMedical["height"]; ?>";
        $("[name=height]").val(height);
        //體重
        var weight = "<?php echo $row_RecMedical["weight"]; ?>";
        $("[name=weight]").val(weight);
        //個案現居地
        var location= "<?php echo $row_RecMedical["location"]; ?>"; 
        $("[name=location]").val(location);
        //Ｋ他命使用時間
        var ketamine_history = "<?php echo $row_RecMedical["ketamine_history"]; ?>"
        if (ketamine_history == 9999) {
          $("[name=ketamine_history_year]").val(0);
          $("[name=ketamine_history_month]").val(0); 
        }else{
          var ketamine_history_year = parseInt(ketamine_history / 12);
          var ketamine_history_month = ketamine_history % 12;
          $("[name=ketamine_history_year]").val(ketamine_history_year);
          $("[name=ketamine_history_month]").val(ketamine_history_month); 
        }
        
        /*多選 default*/
        //個案別
        /*
        var casetype1 = <?php echo $row_RecMedical["casetype1"]; ?>;
        if (casetype1 == 1) {
          $("[name=casetype1][type=checkbox]").prop('checked', true);
        };*/
        $("[name=casetype1][type=checkbox]").filter('[value="<?php echo $row_RecMedical["casetype1"]; ?>"]').prop('checked', true);
        $("[name=casetype2][type=checkbox]").filter('[value="<?php echo $row_RecMedical["casetype2"]; ?>"]').prop('checked', true);
        $("[name=casetype3][type=checkbox]").filter('[value="<?php echo $row_RecMedical["casetype3"]; ?>"]').prop('checked', true);
        $("[name=casetype4][type=checkbox]").filter('[value="<?php echo $row_RecMedical["casetype4"]; ?>"]').prop('checked', true);
        $("[name=casetype5][type=checkbox]").filter('[value="<?php echo $row_RecMedical["casetype5"]; ?>"]').prop('checked', true);
        $("[name=casetype6][type=checkbox]").filter('[value="<?php echo $row_RecMedical["casetype6"]; ?>"]').prop('checked', true);
        $("[name=casetype7][type=checkbox]").filter('[value="<?php echo $row_RecMedical["casetype7"]; ?>"]').prop('checked', true);
        $("[name=casetype8][type=checkbox]").filter('[value="<?php echo $row_RecMedical["casetype8"]; ?>"]').prop('checked', true);
        //併存疾病
        var comor1 = "<?php echo $row_RecMedical["comor1"]; ?>";
        var comor2 = "<?php echo $row_RecMedical["comor2"]; ?>";
        var comor3 = "<?php echo $row_RecMedical["comor3"]; ?>";
        var comor4 = "<?php echo $row_RecMedical["comor4"]; ?>";
        var comor5 = "<?php echo $row_RecMedical["comor5"]; ?>";
        var comor6 = "<?php echo $row_RecMedical["comor6"]; ?>";
        var comor7 = "<?php echo $row_RecMedical["comor7"]; ?>";
        var comor8 = "<?php echo $row_RecMedical["comor8"]; ?>";
        var comor9 = "<?php echo $row_RecMedical["comor9"]; ?>";
        var comor10 = "<?php echo $row_RecMedical["comor10"]; ?>";
        var comor11 = "<?php echo $row_RecMedical["comor11"]; ?>";
        var comor12 = "<?php echo $row_RecMedical["comor12"]; ?>";
        var comor13 = "<?php echo $row_RecMedical["comor13"]; ?>";
        var comor14 = "<?php echo $row_RecMedical["comor14"]; ?>";
        var comor15 = "<?php echo $row_RecMedical["comor15"]; ?>";
        var comor_other = "<?php echo $row_RecMedical["comor_other"]; ?>";
        if(comor1 == 0 && comor2 == 0 && comor3 == 0 && comor4 == 0 && comor5 == 0 && comor6 == 0 && comor7 == 0 && comor8 == 0 &&
           comor9 == 0 && comor10 == 0 && comor11 == 0 && comor12 == 0 && comor13 == 0 && comor14 == 0 && comor15 == 0){
          $("[name=comor][type=checkbox]").filter('[value="1"]').prop('checked', true);
        }
        $("[name=comor1][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor1"]; ?>"]').prop('checked', true);
        $("[name=comor2][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor2"]; ?>"]').prop('checked', true);
        $("[name=comor3][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor3"]; ?>"]').prop('checked', true);
        $("[name=comor4][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor4"]; ?>"]').prop('checked', true);
        $("[name=comor5][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor5"]; ?>"]').prop('checked', true);
        $("[name=comor6][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor6"]; ?>"]').prop('checked', true);
        $("[name=comor7][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor7"]; ?>"]').prop('checked', true);
        $("[name=comor8][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor8"]; ?>"]').prop('checked', true);
        $("[name=comor9][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor9"]; ?>"]').prop('checked', true);
        $("[name=comor10][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor10"]; ?>"]').prop('checked', true);
        $("[name=comor11][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor11"]; ?>"]').prop('checked', true);
        $("[name=comor12][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor12"]; ?>"]').prop('checked', true);
        $("[name=comor13][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor13"]; ?>"]').prop('checked', true);
        $("[name=comor14][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor14"]; ?>"]').prop('checked', true);
        $("[name=comor15][type=checkbox]").filter('[value="<?php echo $row_RecMedical["comor15"]; ?>"]').prop('checked', true);
        //var comor_other = "<?php echo $row_RecMedical["comor_other"]; ?>";
        if(comor_other != "" && comor_other != "NA"){
          $("[name=comor15][type=checkbox]").filter('[value="1"]').prop('checked', true);
          $("#comor").show();
          $("[name=comor_other]").val(comor_other);
        }
        //濫用藥物原因
        $("[name=drugreason1][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason1"]; ?>"]').prop('checked', true);
        $("[name=drugreason2][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason2"]; ?>"]').prop('checked', true);
        $("[name=drugreason3][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason3"]; ?>"]').prop('checked', true);
        $("[name=drugreason4][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason4"]; ?>"]').prop('checked', true);
        $("[name=drugreason5][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason5"]; ?>"]').prop('checked', true);
        $("[name=drugreason6][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason6"]; ?>"]').prop('checked', true);
        $("[name=drugreason7][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason7"]; ?>"]').prop('checked', true);
        $("[name=drugreason8][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason8"]; ?>"]').prop('checked', true);
        $("[name=drugreason9][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason9"]; ?>"]').prop('checked', true);
        $("[name=drugreason10][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason10"]; ?>"]').prop('checked', true);
        $("[name=drugreason11][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason11"]; ?>"]').prop('checked', true);
        $("[name=drugreason12][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason12"]; ?>"]').prop('checked', true);
        $("[name=drugreason13][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason13"]; ?>"]').prop('checked', true);
        $("[name=drugreason14][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason14"]; ?>"]').prop('checked', true);
        $("[name=drugreason15][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugreason15"]; ?>"]').prop('checked', true);
        var drugreason_other = "<?php echo $row_RecMedical["drugreason_other"]; ?>";
        if(drugreason_other != "" && drugreason_other != "NA"){
          $("[name=drugreason_other][type=checkbox]").filter('[value="1"]').prop('checked', true);
          $("#drug_reason0").show();
          $("[name=drugreason_other]").val(drugreason_other);
        }
        //取的藥物場所
        $("[name=drugplace1][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace1"]; ?>"]').prop('checked', true);
        $("[name=drugplace2][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace2"]; ?>"]').prop('checked', true);
        $("[name=drugplace3][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace3"]; ?>"]').prop('checked', true);
        $("[name=drugplace4][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace4"]; ?>"]').prop('checked', true);
        $("[name=drugplace5][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace5"]; ?>"]').prop('checked', true);
        $("[name=drugplace6][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace6"]; ?>"]').prop('checked', true);
        $("[name=drugplace7][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace7"]; ?>"]').prop('checked', true);
        $("[name=drugplace8][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace8"]; ?>"]').prop('checked', true);
        $("[name=drugplace9][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace9"]; ?>"]').prop('checked', true);
        $("[name=drugplace10][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace10"]; ?>"]').prop('checked', true);
        $("[name=drugplace11][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace11"]; ?>"]').prop('checked', true);
        $("[name=drugplace12][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace12"]; ?>"]').prop('checked', true);
        $("[name=drugplace13][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace13"]; ?>"]').prop('checked', true);
        $("[name=drugplace14][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace14"]; ?>"]').prop('checked', true);
        $("[name=drugplace15][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace15"]; ?>"]').prop('checked', true);
        $("[name=drugplace16][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace16"]; ?>"]').prop('checked', true);
        $("[name=drugplace17][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace17"]; ?>"]').prop('checked', true);
        $("[name=drugplace18][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace18"]; ?>"]').prop('checked', true);
        $("[name=drugplace19][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace19"]; ?>"]').prop('checked', true);
        var drugplace_other = "<?php echo $row_RecMedical["drugplace_other"]; ?>";
        if(drugplace_other != "" && drugplace_other != "NA"){
          $("[name=drugplace19][type=checkbox]").filter('[value="1"]').prop('checked', true);
          $("#drug_place0").show();
          $("[name=drugplace_other]").val(drugplace_other);
        }
        //藥物來源對象
        $("[name=drugsource1][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugsource1"]; ?>"]').prop('checked', true);
        $("[name=drugsource2][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugsource2"]; ?>"]').prop('checked', true);
        $("[name=drugsource3][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugsource3"]; ?>"]').prop('checked', true);
        $("[name=drugsource4][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugsource4"]; ?>"]').prop('checked', true);
        $("[name=drugsource5][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugsource5"]; ?>"]').prop('checked', true);
        $("[name=drugsource6][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugsource6"]; ?>"]').prop('checked', true);
        $("[name=drugsource7][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugsource7"]; ?>"]').prop('checked', true);
        $("[name=drugsource8][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugsource8"]; ?>"]').prop('checked', true);
        $("[name=drugsource9][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugsource9"]; ?>"]').prop('checked', true);
        var drugsource_other = "<?php echo $row_RecMedical["drugsource_other"]; ?>";
        if(drugsource_other != "" && drugsource_other != "NA"){
          $("[name=drugsource9][type=checkbox]").filter('[value="1"]').prop('checked', true);
          $("#drug_source0").show();
          $("[name=drugsource_other]").val(drugsource_other);
        }
        //主要使用方式
        $("[name=ketamine_method1][type=checkbox]").filter('[value="<?php echo $row_RecMedical["ketamine_method1"]; ?>"]').prop('checked', true);
        $("[name=ketamine_method2][type=checkbox]").filter('[value="<?php echo $row_RecMedical["ketamine_method2"]; ?>"]').prop('checked', true);
        $("[name=ketamine_method3][type=checkbox]").filter('[value="<?php echo $row_RecMedical["ketamine_method3"]; ?>"]').prop('checked', true);
        $("[name=ketamine_method4][type=checkbox]").filter('[value="<?php echo $row_RecMedical["ketamine_method4"]; ?>"]').prop('checked', true);
        $("[name=ketamine_method5][type=checkbox]").filter('[value="<?php echo $row_RecMedical["ketamine_method5"]; ?>"]').prop('checked', true);
        $("[name=ketamine_method6][type=checkbox]").filter('[value="<?php echo $row_RecMedical["ketamine_method6"]; ?>"]').prop('checked', true);
        var ketamine_method_other = "<?php echo $row_RecMedical["ketamine_method_other"]; ?>";
        if(ketamine_method_other != "" && ketamine_method_other != "NA"){
          $("[name=ketamine_method6][type=checkbox]").filter('[value="1"]').prop('checked', true);
          $("#ketamine_method0").show();
          $("[name=ketamine_method_other]").val(ketamine_method_other);
        }
        //醫師登記表是否第一次收案
        var firstmedical ="<?php echo $row_RecMedical["firstmedical"]; ?>";
        if(firstmedical == 1){
          $("[name=firstmedical][type=checkbox]").filter('[value="<?php echo $row_RecMedical["firstmedical"]; ?>"]').prop('checked', true);
        }else if(firstmedical == 0){
          $("#treatment").show();
          var tx_date = "<?php echo $row_RecMedical["tx_date"]; ?>";
          $("[name=tx_date]").val(tx_date);
          $("[name=tx_nsaid][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_nsaid"]; ?>"]').prop('checked', true);
          $("[name=tx_cox2][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_cox2"]; ?>"]').prop('checked', true);
          $("[name=tx_opioid][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_opioid"]; ?>"]').prop('checked', true);
          $("[name=tx_morphin][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_morphin"]; ?>"]').prop('checked', true);

          $("[name=tx_antim][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_antim"]; ?>"]').prop('checked', true);
          $("[name=tx_double_antim][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_double_antim"]; ?>"]').prop('checked', true);
          $("[name=tx_mucosa_op][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_mucosa_op"]; ?>"]').prop('checked', true);
          $("[name=tx_mucosa_ic][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_mucosa_ic"]; ?>"]').prop('checked', true);
          $("[name=tx_hydrodistention][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_hydrodistention"]; ?>"]').prop('checked', true);
          $("[name=tx_botox_id100u][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_botox_id100u"]; ?>"]').prop('checked', true);
          $("[name=tx_botox_it100u][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_botox_it100u"]; ?>"]').prop('checked', true);
          $("[name=tx_botox_idit100u][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_botox_idit100u"]; ?>"]').prop('checked', true);
          $("[name=tx_ewithout][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_ewithout"]; ?>"]').prop('checked', true);
          $("[name=tx_epartial][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_epartial"]; ?>"]').prop('checked', true);
          $("[name=tx_ewhole][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_ewhole"]; ?>"]').prop('checked', true);

          $("[name=tx_dj_one][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_dj_one"]; ?>"]').prop('checked', true);
          $("[name=tx_dj_both][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_dj_both"]; ?>"]').prop('checked', true);
          $("[name=tx_pcnd_one][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_pcnd_one"]; ?>"]').prop('checked', true);
          $("[name=tx_pcnd_both][type=checkbox]").filter('[value="<?php echo $row_RecMedical["tx_pcnd_both"]; ?>"]').prop('checked', true);
          var tx_other = "<?php echo $row_RecMedical["tx_other"]; ?>";
          if (tx_other != "NA") {$("[name=tx_other]").val(tx_other);};
        }
        


        /*單選 default*/
        //職業
        var job = "<?php echo $row_RecMedical["job"]; ?>";
        if(job != "無" && job != "學生" && job != "軍警" && job != "公教" && job != "商" && job != "農漁" && job != "工" && job != "服務業" && job != "自由業" &&
           job != "家庭主婦" && job != "NA"){
          $("[name=job][type=radio]").filter('[value="other"]').prop('checked', true);
          $("#job0").show();
          $("[name=job1]").val(job);
        }else{
          $("[name=job][type=radio]").filter('[value="<?php echo $row_RecMedical["job"]; ?>"]').prop('checked', true);
        } 
        //教育
        $("[name=edu][type=radio]").filter('[value="<?php echo $row_RecMedical["edu"]; ?>"]').prop('checked', true);
        //婚姻狀況
        var marriage = "<?php echo $row_RecMedical["marriage"]; ?>";
        if (marriage != "未婚" && marriage != "已婚" && marriage != "同居" && marriage != "離婚" && marriage != "喪偶" && marriage != "NA") {
          $("[name=marriage][type=radio]").filter('[value="other"]').prop('checked', true);
          $("#marriage0").show();
          $("[name=marriage1]").val(marriage);
        }else{
          $("[name=marriage][type=radio]").filter('[value="<?php echo $row_RecMedical["marriage"]; ?>"]').prop('checked', true);
        }
        //性生活情形
        $("[name=regular_sex_partner][type=radio]").filter('[value="<?php echo $row_RecMedical["regular_sex_partner"]; ?>"]').prop('checked', true);
        //是否抽菸
        $("[name=smoking][type=radio]").filter('[value="<?php echo $row_RecMedical["smoking"]; ?>"]').prop('checked', true);
        //是否喝酒
        $("[name=drinking][type=radio]").filter('[value="<?php echo $row_RecMedical["drinking"]; ?>"]').prop('checked', true);
        //是否嚼檳榔
        $("[name=betel_nut][type=radio]").filter('[value="<?php echo $row_RecMedical["betel_nut"]; ?>"]').prop('checked', true);
        //首次使用k他命年齡
        $("[name=first_ketamine_age][type=radio]").filter('[value="<?php echo $row_RecMedical["first_ketamine_age"]; ?>"]').prop('checked', true);
        //每天平均K他命的量
        $("[name=ketamine_ave][type=radio]").filter('[value="<?php echo $row_RecMedical["ketamine_ave"]; ?>"]').prop('checked', true);
        /*主要使用方式
        var ketamine_method = "<?php echo $row_RecMedical["ketamine_method"]; ?>";
        if(ketamine_method != "口服" && ketamine_method != "以香菸或煙管方式吸食" && ketamine_method != "加熱成煙霧後鼻吸" && 
           ketamine_method != "藥物直接鼻吸" && ketamine_method != "嗅吸蒸發之氣體" && ketamine_method != "NA"){
          $("[name=ketamine_method][type=radio]").filter('[value="other"]').prop('checked', true);
          $("#ketamine_method0").show();
          $("[name=ketamine_method1]").val(ketamine_method);
        }else{
          $("[name=ketamine_method][type=radio]").filter('[value="<?php echo $row_RecMedical["ketamine_method"]; ?>"]').prop('checked', true);
        }*/
        //合併使用其他藥物
        var combined_drug = "<?php echo $row_RecMedical["combined_drug"]; ?>";
        if(combined_drug != "無" && combined_drug != "NA"){
          $("[name=combined_drug][type=radio]").filter('[value="other"]').prop('checked', true);
          $("#combined_drug0").show();
          $("[name=combined_drug1]").val(combined_drug);
        }else{
          $("[name=combined_drug][type=radio]").filter('[value="<?php echo $row_RecMedical["combined_drug"]; ?>"]').prop('checked', true);
        }
        //膀胱症狀有多久
        $("[name=symptom_starting_date][type=radio]").filter('[value="<?php echo $row_RecMedical["symptom_starting_date"]; ?>"]').prop('checked', true);
        //是否已戒除K他命
        var stop_ketamine = "<?php echo $row_RecMedical["stop_ketamine"]; ?>";
        if(stop_ketamine == 1){
          $("[name=stop_ketamine][type=radio]").filter('[value=1]').prop('checked', true);
          $("#stopK").show();
          var stop_ketamine_month = "<?php echo $row_RecMedical["stop_ketamine_month"]; ?>";
          if (stop_ketamine_month == 9999) {
            $("[name=stop_ketamine_year]").val(0);
            $("[name=stop_ketamine_month]").val(0);
          }else{
            var stop_ketamine_year = parseInt(stop_ketamine_month /12);
            stop_ketamine_month = stop_ketamine_month % 12;
            $("[name=stop_ketamine_year]").val(stop_ketamine_year);
            $("[name=stop_ketamine_month]").val(stop_ketamine_month);
          }
        }else{
          $("[name=stop_ketamine][type=radio]").filter('[value="<?php echo $row_RecMedical["stop_ketamine"]; ?>"]').prop('checked', true);
        }
        //IPSS
        $("[name=IPSS_score1][type=radio]").filter('[value="<?php echo $row_RecMedical["IPSS_score1"]; ?>"]').prop('checked', true);
        $("[name=IPSS_score2][type=radio]").filter('[value="<?php echo $row_RecMedical["IPSS_score2"]; ?>"]').prop('checked', true);
        $("[name=IPSS_score3][type=radio]").filter('[value="<?php echo $row_RecMedical["IPSS_score3"]; ?>"]').prop('checked', true);
        $("[name=IPSS_score4][type=radio]").filter('[value="<?php echo $row_RecMedical["IPSS_score4"]; ?>"]').prop('checked', true);
        $("[name=IPSS_score5][type=radio]").filter('[value="<?php echo $row_RecMedical["IPSS_score5"]; ?>"]').prop('checked', true);
        $("[name=IPSS_score6][type=radio]").filter('[value="<?php echo $row_RecMedical["IPSS_score6"]; ?>"]').prop('checked', true);
        $("[name=IPSS_score7][type=radio]").filter('[value="<?php echo $row_RecMedical["IPSS_score7"]; ?>"]').prop('checked', true);
        $("[name=urinary_quality_life][type=radio]").filter('[value="<?php echo $row_RecMedical["urinary_quality_life"]; ?>"]').prop('checked', true);
        //間質性膀胱炎症狀指標
        $("[name=IC_symptom1][type=radio]").filter('[value="<?php echo $row_RecMedical["IC_symptom1"]; ?>"]').prop('checked', true);
        $("[name=IC_symptom2][type=radio]").filter('[value="<?php echo $row_RecMedical["IC_symptom2"]; ?>"]').prop('checked', true);
        $("[name=IC_symptom3][type=radio]").filter('[value="<?php echo $row_RecMedical["IC_symptom3"]; ?>"]').prop('checked', true);
        $("[name=IC_symptom4][type=radio]").filter('[value="<?php echo $row_RecMedical["IC_symptom4"]; ?>"]').prop('checked', true);
        //間質性膀胱炎問題指標
        $("[name=IC_question1][type=radio]").filter('[value="<?php echo $row_RecMedical["IC_question1"]; ?>"]').prop('checked', true);
        $("[name=IC_question2][type=radio]").filter('[value="<?php echo $row_RecMedical["IC_question2"]; ?>"]').prop('checked', true);
        $("[name=IC_question3][type=radio]").filter('[value="<?php echo $row_RecMedical["IC_question3"]; ?>"]').prop('checked', true);
        $("[name=IC_question4][type=radio]").filter('[value="<?php echo $row_RecMedical["IC_question4"]; ?>"]').prop('checked', true);
        //疼痛指數
        $("[name=VAS][type=radio]").filter('[value="<?php echo $row_RecMedical["VAS"]; ?>"]').prop('checked', true);
        //BSRS
        $("[name=BSRS1][type=radio]").filter('[value="<?php echo $row_RecMedical["BSRS1"]; ?>"]').prop('checked', true);
        $("[name=BSRS2][type=radio]").filter('[value="<?php echo $row_RecMedical["BSRS2"]; ?>"]').prop('checked', true);
        $("[name=BSRS3][type=radio]").filter('[value="<?php echo $row_RecMedical["BSRS3"]; ?>"]').prop('checked', true);
        $("[name=BSRS4][type=radio]").filter('[value="<?php echo $row_RecMedical["BSRS4"]; ?>"]').prop('checked', true);
        $("[name=BSRS5][type=radio]").filter('[value="<?php echo $row_RecMedical["BSRS5"]; ?>"]').prop('checked', true);
        //FSFI
        $("[name=FSFI1][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI1"]; ?>"]').prop('checked', true);
        $("[name=FSFI2][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI2"]; ?>"]').prop('checked', true);
        $("[name=FSFI3][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI3"]; ?>"]').prop('checked', true);
        $("[name=FSFI4][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI4"]; ?>"]').prop('checked', true);
        $("[name=FSFI5][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI5"]; ?>"]').prop('checked', true);
        $("[name=FSFI6][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI6"]; ?>"]').prop('checked', true);
        $("[name=FSFI7][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI7"]; ?>"]').prop('checked', true);
        $("[name=FSFI8][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI8"]; ?>"]').prop('checked', true);
        $("[name=FSFI9][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI9"]; ?>"]').prop('checked', true);
        $("[name=FSFI10][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI10"]; ?>"]').prop('checked', true);
        $("[name=FSFI11][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI11"]; ?>"]').prop('checked', true);
        $("[name=FSFI12][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI12"]; ?>"]').prop('checked', true);
        $("[name=FSFI13][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI13"]; ?>"]').prop('checked', true);
        $("[name=FSFI14][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI14"]; ?>"]').prop('checked', true);
        $("[name=FSFI15][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI15"]; ?>"]').prop('checked', true);
        $("[name=FSFI16][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI16"]; ?>"]').prop('checked', true);
        $("[name=FSFI17][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI17"]; ?>"]').prop('checked', true);
        $("[name=FSFI18][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI18"]; ?>"]').prop('checked', true);
        $("[name=FSFI19][type=radio]").filter('[value="<?php echo $row_RecMedical["FSFI19"]; ?>"]').prop('checked', true);
        //IIEF
        $("[name=IIEF1][type=radio]").filter('[value="<?php echo $row_RecMedical["IIEF1"]; ?>"]').prop('checked', true);
        $("[name=IIEF2][type=radio]").filter('[value="<?php echo $row_RecMedical["IIEF2"]; ?>"]').prop('checked', true);
        $("[name=IIEF3][type=radio]").filter('[value="<?php echo $row_RecMedical["IIEF3"]; ?>"]').prop('checked', true);
        $("[name=IIEF4][type=radio]").filter('[value="<?php echo $row_RecMedical["IIEF4"]; ?>"]').prop('checked', true);
        $("[name=IIEF5][type=radio]").filter('[value="<?php echo $row_RecMedical["IIEF5"]; ?>"]').prop('checked', true);


        /*醫師登記表*/
        //醫師評估日期
        var register_date = "<?php echo $row_RecMedical["register_date"]; ?>";
        if (register_date != "0000-00-00") {$("[name=register_date]").val(register_date);};
        var systolic_pressure = "<?php echo $row_RecMedical["systolic_pressure"]; ?>";
        if (systolic_pressure != 999) {$("[name=systolic_pressure]").val(systolic_pressure);};
        var diastolic_pressure = "<?php echo $row_RecMedical["diastolic_pressure"]; ?>";
        if (diastolic_pressure != 999) {$("[name=diastolic_pressure]").val(diastolic_pressure);};
        $("[name=gross_hematuria][type=radio]").filter('[value="<?php echo $row_RecMedical["gross_hematuria"]; ?>"]').prop('checked', true);
        var other_symptoms = "<?php echo $row_RecMedical["other_symptoms"]; ?>";
        if (other_symptoms != "NA") {$("[name=other_symptoms]").val(other_symptoms);};
        var Diary_1D = "<?php echo $row_RecMedical["Diary_1D"]; ?>";
        if (Diary_1D != "99") {$("[name=Diary_1D]").val(Diary_1D);};
        var Diary_1N = "<?php echo $row_RecMedical["Diary_1N"]; ?>";
        if (Diary_1N != "99") {$("[name=Diary_1N]").val(Diary_1N);};
        var Diary_2D = "<?php echo $row_RecMedical["Diary_2D"]; ?>";
        if (Diary_2D != "99") {$("[name=Diary_2D]").val(Diary_2D);};
        var Diary_2N = "<?php echo $row_RecMedical["Diary_2N"]; ?>";
        if (Diary_2N != "99") {$("[name=Diary_2N]").val(Diary_2N);};
        var Diary_Max_VV = "<?php echo $row_RecMedical["Diary_Max_VV"]; ?>";
        if (Diary_Max_VV != "999") {$("[name=Diary_Max_VV]").val(Diary_Max_VV);};

        /*Urine Tests*/
        //Urinalysis
        var Urine_routine_WBC_HPF = "<?php echo $row_RecMedical["Urine_routine_WBC_HPF"]; ?>";
        var Urine_routine_RBC_HPF = "<?php echo $row_RecMedical["Urine_routine_RBC_HPF"]; ?>";
        var Urine_routine_Nit = "<?php echo $row_RecMedical["Urine_routine_Nit"]; ?>";
        var Urine_routine_LEU = "<?php echo $row_RecMedical["Urine_routine_LEU"]; ?>";
        var Urine_routine_Bact = "<?php echo $row_RecMedical["Urine_routine_Bact"]; ?>";
        if (Urine_routine_WBC_HPF == "NA" && Urine_routine_RBC_HPF == "NA" && Urine_routine_Nit == "NA" &&
            Urine_routine_LEU == "NA" && Urine_routine_Bact == "NA") {
          $("[name=urinalysis_na][type=checkbox]").prop('checked', true);
          $("[name=Urine_routine_WBC_HPF][type=radio]").prop("disabled", true);
          $("[name=Urine_routine_RBC_HPF][type=radio]").prop("disabled", true);
          $("[name=Urine_routine_Nit][type=radio]").prop("disabled", true);
          $("[name=Urine_routine_LEU][type=radio]").prop("disabled", true);
          $("[name=Urine_routine_Bact][type=radio]").prop("disabled", true);
          $("[name=Urine_routine_WBC_HPF][type=radio]").attr('checked', false);
          $("[name=Urine_routine_RBC_HPF][type=radio]").attr('checked', false);
          $("[name=Urine_routine_Nit][type=radio]").attr('checked', false);
          $("[name=Urine_routine_LEU][type=radio]").attr('checked', false);
          $("[name=Urine_routine_Bact][type=radio]").attr('checked', false);
        };
        $("[name=Urine_routine_WBC_HPF][type=radio]").filter('[value="<?php echo $row_RecMedical["Urine_routine_WBC_HPF"]; ?>"]').prop('checked', true);
        $("[name=Urine_routine_RBC_HPF][type=radio]").filter('[value="<?php echo $row_RecMedical["Urine_routine_RBC_HPF"]; ?>"]').prop('checked', true);
        $("[name=Urine_routine_Nit][type=radio]").filter('[value="<?php echo $row_RecMedical["Urine_routine_Nit"]; ?>"]').prop('checked', true);
        $("[name=Urine_routine_LEU][type=radio]").filter('[value="<?php echo $row_RecMedical["Urine_routine_LEU"]; ?>"]').prop('checked', true);
        $("[name=Urine_routine_Bact][type=radio]").filter('[value="<?php echo $row_RecMedical["Urine_routine_Bact"]; ?>"]').prop('checked', true);
        //Urine Culture
        var Urine_culture = "<?php echo $row_RecMedical["Urine_culture"]; ?>";
        if (Urine_culture == "NA") {
          $("[name=Urine_culture][type=checkbox]").prop('checked', true);
          $("[name=Urine_culture][type=radio]").prop("disabled", true);
          $("[name=Urine_culture][type=radio]").attr('checked', false);
          $("[name=Urine_culture1][type=text]").val(null);
        };
        if (Urine_culture != "no growth" && Urine_culture != "E coli" && Urine_culture != "K.pneumonia" &&
            Urine_culture != "P.mirabis" && Urine_culture != "NA") {
          $("[name=Urine_culture][type=radio]").filter('[value="other"]').prop('checked', true);
          $("#UCulture0").show();
          $("[name=Urine_culture1]").val(Urine_culture);
        }else{
          $("[name=Urine_culture][type=radio]").filter('[value="<?php echo $row_RecMedical["Urine_culture"]; ?>"]').prop('checked', true);
        }
        //Urine Cytology
        var cytology = "<?php echo $row_RecMedical["cytology"]; ?>";
        if (cytology == "NA") {
          $("[name=cytology][type=checkbox]").prop('checked', true);
          $("[name=cytology][type=radio]").prop("disabled", true);
          $("[name=cytology][type=radio]").attr('checked', false);
        };
        $("[name=cytology][type=radio]").filter('[value="<?php echo $row_RecMedical["cytology"]; ?>"]').prop('checked', true);
        /*Blood Tests*/
        //HIV
        var STD_HIV = "<?php echo $row_RecMedical["STD_HIV"]; ?>";
        if (STD_HIV == "99") {
          $("[name=STD_HIV_na][type=checkbox]").prop('checked', true);
          $("[name=STD_HIV][type=radio]").prop("disabled", true);
          $("[name=STD_HIV][type=radio]").attr('checked', false);
        };
        $("[name=STD_HIV][type=radio]").filter('[value="<?php echo $row_RecMedical["STD_HIV"]; ?>"]').prop('checked', true);
        //VDRL
        var STD_VDRL = "<?php echo $row_RecMedical["STD_VDRL"]; ?>";
        if (STD_VDRL == "99") {
          $("[name=STD_VDRL_na][type=checkbox]").prop('checked', true);
          $("[name=STD_VDRL][type=radio]").prop("disabled", true);
          $("[name=STD_VDRL][type=radio]").attr('checked', false);
        };
        $("[name=STD_VDRL][type=radio]").filter('[value="<?php echo $row_RecMedical["STD_VDRL"]; ?>"]').prop('checked', true);
        //TPHA
        var STD_TPHA = "<?php echo $row_RecMedical["STD_TPHA"]; ?>";
        if (STD_TPHA == "99") {
          $("[name=STD_TPHA_na][type=checkbox]").prop('checked', true);
          $("[name=STD_TPHA][type=radio]").prop("disabled", true);
          $("[name=STD_TPHA][type=radio]").attr('checked', false);
        };
        $("[name=STD_TPHA][type=radio]").filter('[value="<?php echo $row_RecMedical["STD_TPHA"]; ?>"]').prop('checked', true);
        
        //Renal function
        var Renal_function_BUN = "<?php echo $row_RecMedical["Renal_function_BUN"]; ?>";
        var Renal_function_Cr = "<?php echo $row_RecMedical["Renal_function_Cr"]; ?>";
        if (Renal_function_BUN == "999" && Renal_function_Cr == "999") {
          $("[name=RF_na][type=checkbox]").prop('checked', true);
          $("[name=Renal_function_BUN]").prop("disabled", true);
          $("[name=Renal_function_Cr]").prop("disabled", true);
          $("[name=Renal_function_BUN]").val(null);
          $("[name=Renal_function_Cr]").val(null);
        };
        if (Renal_function_BUN != "999") {$("[name=Renal_function_BUN]").val(Renal_function_BUN);};
        if (Renal_function_Cr != "999") {$("[name=Renal_function_Cr]").val(Renal_function_Cr);};
        //Liver function
        var Liver_function_GPT = "<?php echo $row_RecMedical["Liver_function_GPT"]; ?>";
        var Liver_function_GOT = "<?php echo $row_RecMedical["Liver_function_GOT"]; ?>";
        var Liver_function_ALB = "<?php echo $row_RecMedical["Liver_function_ALB"]; ?>";
        var Liver_function_BIL = "<?php echo $row_RecMedical["Liver_function_BIL"]; ?>";
        if (Liver_function_GPT == "999" && Liver_function_GOT == "999" && Liver_function_ALB == "999" && Liver_function_BIL == "999") {
          $("[name=LF_na][type=checkbox]").prop('checked', true);
          $("[name=Liver_function_GOT]").prop("disabled", true);
          $("[name=Liver_function_GPT]").prop("disabled", true);
          $("[name=Liver_function_ALB]").prop("disabled", true);
          $("[name=Liver_function_BIL]").prop("disabled", true);
          $("[name=Liver_function_GOT]").val(null);
          $("[name=Liver_function_GPT]").val(null);
          $("[name=Liver_function_ALB]").val(null);
          $("[name=Liver_function_BIL]").val(null);
        };
        if (Liver_function_GOT != "999") {$("[name=Liver_function_GOT]").val(Liver_function_GOT);};
        if (Liver_function_GPT != "999") {$("[name=Liver_function_GPT]").val(Liver_function_GPT);};
        if (Liver_function_ALB != "999") {$("[name=Liver_function_ALB]").val(Liver_function_ALB);};
        if (Liver_function_BIL != "999") {$("[name=Liver_function_BIL]").val(Liver_function_BIL);};
        //Hematology
        var Hematology_WBC = "<?php echo $row_RecMedical["Hematology_WBC"]; ?>";
        var Hematology_Hgb = "<?php echo $row_RecMedical["Hematology_Hgb"]; ?>";
        var Hematology_Pl = "<?php echo $row_RecMedical["Hematology_Pl"]; ?>";
        var Hematology_eosinophil = "<?php echo $row_RecMedical["Hematology_eosinophil"]; ?>";
        if (Hematology_WBC == "999" && Hematology_Hgb == "999" && Hematology_Pl == "999" && Hematology_eosinophil == "999") {
          $("[name=hematology_na][type=checkbox]").prop('checked', true);
          $("[name=Hematology_WBC]").prop("disabled", true);
          $("[name=Hematology_Hgb]").prop("disabled", true);
          $("[name=Hematology_Pl]").prop("disabled", true);
          $("[name=Hematology_eosinophil]").prop("disabled", true);
          $("[name=Hematology_WBC]").val(null);
          $("[name=Hematology_Hgb]").val(null);
          $("[name=Hematology_Pl]").val(null);
          $("[name=Hematology_eosinophil]").val(null);
        };
        if (Hematology_WBC != "999") {$("[name=Hematology_WBC]").val(Hematology_WBC);};
        if (Hematology_Hgb != "999") {$("[name=Hematology_Hgb]").val(Hematology_Hgb);};
        if (Hematology_Pl != "999") {$("[name=Hematology_Pl]").val(Hematology_Pl);};
        if (Hematology_eosinophil != "999") {$("[name=Hematology_eosinophil]").val(Hematology_eosinophil);};
        //Immunology
        var Immune_IgE = "<?php echo $row_RecMedical["Immune_IgE"]; ?>";
        if (Immune_IgE == "999") {
          $("[name=immunology_na][type=checkbox]").prop('checked', true);
          $("[name=Immune_IgE]").prop("disabled", true);
          $("[name=Immune_IgE]").val(null);
        };
        if (Immune_IgE != "999") {$("[name=Immune_IgE]").val(Immune_IgE);};
        /*Renal Sonography*/
        var renal_echo_right_echogenicity= "<?php echo $row_RecMedical["renal_echo_right_echogenicity"]; ?>";
        var renal_echo_right_kidney= "<?php echo $row_RecMedical["renal_echo_right_kidney"]; ?>";
        var renal_echo_left_echogenicity= "<?php echo $row_RecMedical["renal_echo_left_echogenicity"]; ?>";
        var renal_echo_left_kidney= "<?php echo $row_RecMedical["renal_echo_left_kidney"]; ?>";
        if (renal_echo_right_echogenicity == "NA" && renal_echo_right_kidney == "NA" && 
            renal_echo_left_echogenicity == "NA" && renal_echo_left_kidney == "NA") {
          $("[name=RS_na][type=checkbox]").prop('checked', true);
          $("[name=renal_echo_right_echogenicity][type=radio]").prop("disabled", true);
          $("[name=renal_echo_right_kidney][type=radio]").prop("disabled", true);
          $("[name=renal_echo_right_echogenicity][type=radio]").attr('checked', false);
          $("[name=renal_echo_right_kidney][type=radio]").attr('checked', false);

          $("[name=renal_echo_left_echogenicity][type=radio]").prop("disabled", true);
          $("[name=renal_echo_left_kidney][type=radio]").prop("disabled", true);
          $("[name=renal_echo_left_echogenicity][type=radio]").attr('checked', false);
          $("[name=renal_echo_left_kidney][type=radio]").attr('checked', false);
        };
        $("[name=renal_echo_right_echogenicity][type=radio]").filter('[value="<?php echo $row_RecMedical["renal_echo_right_echogenicity"]; ?>"]').prop('checked', true);
        $("[name=renal_echo_right_kidney][type=radio]").filter('[value="<?php echo $row_RecMedical["renal_echo_right_kidney"]; ?>"]').prop('checked', true);
        $("[name=renal_echo_left_echogenicity][type=radio]").filter('[value="<?php echo $row_RecMedical["renal_echo_left_echogenicity"]; ?>"]').prop('checked', true);
        $("[name=renal_echo_left_kidney][type=radio]").filter('[value="<?php echo $row_RecMedical["renal_echo_left_kidney"]; ?>"]').prop('checked', true);
        /*IVP*/
        var IVP_right_cortical_thinning = "<?php echo $row_RecMedical["IVP_right_cortical_thinning"]; ?>";
        var IVP_right_hydro_RK = "<?php echo $row_RecMedical["IVP_right_hydro_RK"]; ?>";
        var IVP_right_UrStricture_up = "<?php echo $row_RecMedical["IVP_right_UrStricture_up"]; ?>";
        var IVP_right_UrStricture_middle = "<?php echo $row_RecMedical["IVP_right_UrStricture_middle"]; ?>";
        var IVP_right_UrStricture_down = "<?php echo $row_RecMedical["IVP_right_UrStricture_down"]; ?>";

        var IVP_left_cortical_thinning = "<?php echo $row_RecMedical["IVP_left_cortical_thinning"]; ?>";
        var IVP_left_hydro_LK = "<?php echo $row_RecMedical["IVP_left_hydro_LK"]; ?>";
        var IVP_left_UrStricture_up = "<?php echo $row_RecMedical["IVP_left_UrStricture_up"]; ?>";
        var IVP_left_UrStricture_middle = "<?php echo $row_RecMedical["IVP_left_UrStricture_middle"]; ?>";
        var IVP_left_UrStricture_down = "<?php echo $row_RecMedical["IVP_left_UrStricture_down"]; ?>";
        if (IVP_right_cortical_thinning == "99") {
          $("[name=IVP_na][type=checkbox]").prop('checked', true);
          $("[name=ivp_right]").prop("disabled", true);
          $("[name=IVP_right_cortical_thinning]").prop("disabled", true);
          $("[name=IVP_right_hydro_RK]").prop("disabled", true);
          $("[name=IVP_right_UrStricture_up]").prop("disabled", true);
          $("[name=IVP_right_UrStricture_middle]").prop("disabled", true);
          $("[name=IVP_right_UrStricture_down]").prop("disabled", true);
          $("[name=ivp_right]").attr('checked', false);
          $("[name=IVP_right_cortical_thinning]").attr('checked', false);
          $("[name=IVP_right_hydro_RK]").attr('checked', false);
          $("[name=IVP_right_UrStricture_up]").attr('checked', false);
          $("[name=IVP_right_UrStricture_middle]").attr('checked', false);
          $("[name=IVP_right_UrStricture_down]").attr('checked', false);

          $("[name=ivp_left]").prop("disabled", true);
          $("[name=IVP_left_cortical_thinning]").prop("disabled", true);
          $("[name=IVP_left_hydro_LK]").prop("disabled", true);
          $("[name=IVP_left_UrStricture_up]").prop("disabled", true);
          $("[name=IVP_left_UrStricture_middle]").prop("disabled", true);
          $("[name=IVP_left_UrStricture_down]").prop("disabled", true);
          $("[name=ivp_left]").attr('checked', false);
          $("[name=IVP_left_cortical_thinning]").attr('checked', false);
          $("[name=IVP_left_hydro_LK]").attr('checked', false);
          $("[name=IVP_left_UrStricture_up]").attr('checked', false);
          $("[name=IVP_left_UrStricture_middle]").attr('checked', false);
          $("[name=IVP_left_UrStricture_down]").attr('checked', false);
        };
        if (IVP_right_cortical_thinning == "0" && IVP_right_hydro_RK == "0" && IVP_right_UrStricture_up == "0" &&
            IVP_right_UrStricture_middle == "0" && IVP_right_UrStricture_down == "0") {
          $("[name=ivp_right][type=checkbox]").prop('checked', true);
          $('#R_ivp2').attr('checked', false);
          $('#R_ivp3').attr('checked', false);
          $('#R_ivp4').attr('checked', false);
          $('#R_ivp5').attr('checked', false);
          $('#R_ivp6').attr('checked', false);
          $('#R_ivp2').prop("disabled", true);
          $('#R_ivp3').prop("disabled", true);
          $('#R_ivp4').prop("disabled", true);
          $('#R_ivp5').prop("disabled", true);
          $('#R_ivp6').prop("disabled", true);
        };
        $("[name=IVP_right_cortical_thinning][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_right_cortical_thinning"]; ?>"]').prop('checked', true);
        $("[name=IVP_right_hydro_RK][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_right_hydro_RK"]; ?>"]').prop('checked', true);
        $("[name=IVP_right_UrStricture_up][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_right_UrStricture_up"]; ?>"]').prop('checked', true);
        $("[name=IVP_right_UrStricture_middle][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_right_UrStricture_middle"]; ?>"]').prop('checked', true);
        $("[name=IVP_right_UrStricture_down][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_right_UrStricture_down"]; ?>"]').prop('checked', true);
        if (IVP_left_cortical_thinning == "0" && IVP_left_hydro_LK == "0" && IVP_left_UrStricture_up == "0" &&
            IVP_left_UrStricture_middle == "0" && IVP_left_UrStricture_down == "0") {
          $("[name=ivp_left][type=checkbox]").prop('checked', true);
          $('#L_ivp2').attr('checked', false);
          $('#L_ivp3').attr('checked', false);
          $('#L_ivp4').attr('checked', false);
          $('#L_ivp5').attr('checked', false);
          $('#L_ivp6').attr('checked', false);
          $('#L_ivp2').prop("disabled", true);
          $('#L_ivp3').prop("disabled", true);
          $('#L_ivp4').prop("disabled", true);
          $('#L_ivp5').prop("disabled", true);
          $('#L_ivp6').prop("disabled", true);
        };
        $("[name=IVP_left_cortical_thinning][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_left_cortical_thinning"]; ?>"]').prop('checked', true);
        $("[name=IVP_left_hydro_LK][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_left_hydro_LK"]; ?>"]').prop('checked', true);
        $("[name=IVP_left_UrStricture_up][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_left_UrStricture_up"]; ?>"]').prop('checked', true);
        $("[name=IVP_left_UrStricture_middle][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_left_UrStricture_middle"]; ?>"]').prop('checked', true);
        $("[name=IVP_left_UrStricture_down][type=checkbox]").filter('[value="<?php echo $row_RecMedical["IVP_left_UrStricture_down"]; ?>"]').prop('checked', true);

        /*CT*/
        var CT_right_cortical_thinning = "<?php echo $row_RecMedical["CT_right_cortical_thinning"]; ?>";
        var CT_right_hydro_RK = "<?php echo $row_RecMedical["CT_right_hydro_RK"]; ?>";
        var CT_right_UrStricture_up = "<?php echo $row_RecMedical["CT_right_UrStricture_up"]; ?>";
        var CT_right_UrStricture_middle = "<?php echo $row_RecMedical["CT_right_UrStricture_middle"]; ?>";
        var CT_right_UrStricture_down = "<?php echo $row_RecMedical["CT_right_UrStricture_down"]; ?>";

        var CT_left_cortical_thinning = "<?php echo $row_RecMedical["CT_left_cortical_thinning"]; ?>";
        var CT_left_hydro_LK = "<?php echo $row_RecMedical["CT_left_hydro_LK"]; ?>";
        var CT_left_UrStricture_up = "<?php echo $row_RecMedical["CT_left_UrStricture_up"]; ?>";
        var CT_left_UrStricture_middle = "<?php echo $row_RecMedical["CT_left_UrStricture_middle"]; ?>";
        var CT_left_UrStricture_down = "<?php echo $row_RecMedical["CT_left_UrStricture_middle"]; ?>";
        if (CT_right_cortical_thinning == "99") {
          $("[name=CT_na][type=checkbox]").prop('checked', true);
          $("[name=CT_right_cortical_thinning]").prop("disabled", true);
          $("[name=CT_right_hydro_RK]").prop("disabled", true);
          $("[name=CT_right_UrStricture_up]").prop("disabled", true);
          $("[name=CT_right_UrStricture_middle]").prop("disabled", true);
          $("[name=CT_right_UrStricture_down]").prop("disabled", true);
          $("[name=ct_right]").attr('checked', false);
          $("[name=CT_right_cortical_thinning]").attr('checked', false);
          $("[name=CT_right_hydro_RK]").attr('checked', false);
          $("[name=CT_right_UrStricture_up]").attr('checked', false);
          $("[name=CT_right_UrStricture_middle]").attr('checked', false);
          $("[name=CT_right_UrStricture_down]").attr('checked', false);

          $("[name=ct_left]").prop("disabled", true);
          $("[name=CT_left_cortical_thinning]").prop("disabled", true);
          $("[name=CT_left_hydro_LK]").prop("disabled", true);
          $("[name=CT_left_UrStricture_up]").prop("disabled", true);
          $("[name=CT_left_UrStricture_middle]").prop("disabled", true);
          $("[name=CT_left_UrStricture_down]").prop("disabled", true);
          $("[name=CT_left]").attr('checked', false);
          $("[name=CT_left_cortical_thinning]").attr('checked', false);
          $("[name=CT_left_hydro_LK]").attr('checked', false);
          $("[name=CT_left_UrStricture_up]").attr('checked', false);
          $("[name=CT_left_UrStricture_middle]").attr('checked', false);
          $("[name=CT_left_UrStricture_down]").attr('checked', false);
        };
        if (CT_right_cortical_thinning == "0" && CT_right_hydro_RK == "0" && CT_right_UrStricture_up == "0" &&
            CT_right_UrStricture_middle == "0" && CT_right_UrStricture_down == "0") {
          $("[name=ct_right][type=checkbox]").prop('checked', true);
          $('#R_ct2').attr('checked', false);
          $('#R_ct3').attr('checked', false);
          $('#R_ct4').attr('checked', false);
          $('#R_ct5').attr('checked', false);
          $('#R_ct6').attr('checked', false);
          $('#R_ct2').prop("disabled", true);
          $('#R_ct3').prop("disabled", true);
          $('#R_ct4').prop("disabled", true);
          $('#R_ct5').prop("disabled", true);
          $('#R_ct6').prop("disabled", true);
        };
        $("[name=CT_right_cortical_thinning][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_right_cortical_thinning"]; ?>"]').prop('checked', true);
        $("[name=CT_right_hydro_RK][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_right_hydro_RK"]; ?>"]').prop('checked', true);
        $("[name=CT_right_UrStricture_up][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_right_UrStricture_up"]; ?>"]').prop('checked', true);
        $("[name=CT_right_UrStricture_middle][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_right_UrStricture_middle"]; ?>"]').prop('checked', true);
        $("[name=CT_right_UrStricture_down][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_right_UrStricture_down"]; ?>"]').prop('checked', true);
        if (CT_left_cortical_thinning == "0" && CT_left_hydro_LK == "0" && CT_left_UrStricture_up == "0" &&
            CT_left_UrStricture_middle == "0" && CT_left_UrStricture_down == "0") {
          $("[name=ct_left][type=checkbox]").prop('checked', true);
          $('#L_ct2').attr('checked', false);
          $('#L_ct3').attr('checked', false);
          $('#L_ct4').attr('checked', false);
          $('#L_ct5').attr('checked', false);
          $('#L_ct6').attr('checked', false);
          $('#L_ct2').prop("disabled", true);
          $('#L_ct3').prop("disabled", true);
          $('#L_ct4').prop("disabled", true);
          $('#L_ct5').prop("disabled", true);
          $('#L_ct6').prop("disabled", true);
        };
        $("[name=CT_left_cortical_thinning][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_left_cortical_thinning"]; ?>"]').prop('checked', true);
        $("[name=CT_left_hydro_LK][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_left_hydro_LK"]; ?>"]').prop('checked', true);
        $("[name=CT_left_UrStricture_up][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_left_UrStricture_up"]; ?>"]').prop('checked', true);
        $("[name=CT_left_UrStricture_middle][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_left_UrStricture_middle"]; ?>"]').prop('checked', true);
        $("[name=CT_left_UrStricture_down][type=checkbox]").filter('[value="<?php echo $row_RecMedical["CT_left_UrStricture_down"]; ?>"]').prop('checked', true);

        /*Ultrasound of Bladder*/
        var PVR = "<?php echo $row_RecMedical["PVR"]; ?>";
        var bladder_echo_BW_thickness = "<?php echo $row_RecMedical["bladder_echo_BW_thickness"]; ?>";
        if (PVR == "999" && bladder_echo_BW_thickness == "999") {
          $("[name=UB_na][type=checkbox]").prop('checked', true);
          $("[name=PVR]").prop("disabled", true);
          $("[name=bladder_echo_BW_thickness]").prop("disabled", true);
          $("[name=PVR]").val(null);
          $("[name=bladder_echo_BW_thickness]").val(null);
        };
        if (PVR != "999") {$("[name=PVR]").val(PVR);};
        if (bladder_echo_BW_thickness != "999") {$("[name=bladder_echo_BW_thickness]").val(bladder_echo_BW_thickness);};
        /*Uroflowmetry*/
        var Uroflowmetry_Qmax = "<?php echo $row_RecMedical["Uroflowmetry_Qmax"]; ?>";
        var Uroflowmetry_VV = "<?php echo $row_RecMedical["Uroflowmetry_VV"]; ?>";
        var Uroflowmetry_Pattern = "<?php echo $row_RecMedical["Uroflowmetry_Pattern"]; ?>";
        if (Uroflowmetry_Qmax == "999" && Uroflowmetry_VV == "999" && Uroflowmetry_Pattern == "999") {
          $("[name=uroflowmetry_na][type=checkbox]").prop('checked', true);
          $("[name=Uroflowmetry_Qmax]").prop("disabled", true);
          $("[name=Uroflowmetry_VV]").prop("disabled", true);
          $("[name=Uroflowmetry_Pattern][type=radio]").prop("disabled", true);
          $("[name=Uroflowmetry_Qmax]").val(null);
          $("[name=Uroflowmetry_VV]").val(null);
          $("[name=Uroflowmetry_Pattern][type=radio]").attr('checked', false);
        };
        if (Uroflowmetry_Qmax != "999") {$("[name=Uroflowmetry_Qmax]").val(Uroflowmetry_Qmax);};
        if (Uroflowmetry_VV != "999") {$("[name=Uroflowmetry_VV]").val(Uroflowmetry_VV);};
        $("[name=Uroflowmetry_Pattern][type=radio]").filter('[value="<?php echo $row_RecMedical["Uroflowmetry_Pattern"]; ?>"]').prop('checked', true);
        /*VCUG*/
        var VCUG_trabeculation = "<?php echo $row_RecMedical["VCUG_trabeculation"]; ?>";
        var VCUG_VUR_left = "<?php echo $row_RecMedical["VCUG_VUR_left"]; ?>";
        var VCUG_VUR_right = "<?php echo $row_RecMedical["VCUG_VUR_right"]; ?>";
        var VCUG_DSD = "<?php echo $row_RecMedical["VCUG_DSD"]; ?>";
        if (VCUG_trabeculation == "99" && VCUG_VUR_left == "99" && VCUG_VUR_right == "99" && VCUG_DSD =="NA") {
          $("[name=vcug_na][type=checkbox]").prop('checked', true);
          $("[name=VCUG_trabeculation][type=radio]").prop("disabled", true);
          $("[name=VCUG_VUR_left][type=radio]").prop("disabled", true);
          $("[name=VCUG_VUR_right][type=radio]").prop("disabled", true);
          $("[name=VCUG_DSD][type=radio]").prop("disabled", true);
          $("[name=VCUG_trabeculation][type=radio]").attr('checked', false);
          $("[name=VCUG_VUR_left][type=radio]").attr('checked', false);
          $("[name=VCUG_VUR_right][type=radio]").attr('checked', false);
          $("[name=VCUG_DSD][type=radio]").attr('checked', false);
        };
        $("[name=VCUG_trabeculation][type=radio]").filter('[value="<?php echo $row_RecMedical["VCUG_trabeculation"]; ?>"]').prop('checked', true);
        $("[name=VCUG_VUR_left][type=radio]").filter('[value="<?php echo $row_RecMedical["VCUG_VUR_left"]; ?>"]').prop('checked', true);
        $("[name=VCUG_VUR_right][type=radio]").filter('[value="<?php echo $row_RecMedical["VCUG_VUR_right"]; ?>"]').prop('checked', true);
        $("[name=VCUG_DSD][type=radio]").filter('[value="<?php echo $row_RecMedical["VCUG_DSD"]; ?>"]').prop('checked', true);
        /*Cystoscopy*/
        var cystoscopy_ulcer = "<?php echo $row_RecMedical["cystoscopy_ulcer"]; ?>";
        var cystoscopy_glomerulation = "<?php echo $row_RecMedical["cystoscopy_glomerulation"]; ?>";
        var cystoscopy_trabeculation = "<?php echo $row_RecMedical["cystoscopy_trabeculation"]; ?>";
        if (cystoscopy_ulcer == "99" && cystoscopy_glomerulation == "99" && cystoscopy_trabeculation == "99") {
          $("[name=cystoscopy_na][type=checkbox]").prop('checked', true);
          $("[name=cystoscopy_normal][type=checkbox]").prop("disabled", true);
          $("[name=cystoscopy_ulcer][type=radio]").prop("disabled", true);
          $("[name=cystoscopy_glomerulation][type=radio]").prop("disabled", true);
          $("[name=cystoscopy_trabeculation][type=radio]").prop("disabled", true);
          $("[name=cystoscopy_normal][type=checkbox]").attr('checked', false);
          $("[name=cystoscopy_ulcer][type=radio]").attr('checked', false);
          $("[name=cystoscopy_glomerulation][type=radio]").attr('checked', false);
          $("[name=cystoscopy_trabeculation][type=radio]").attr('checked', false);
        };
        if (cystoscopy_ulcer == "0" && cystoscopy_glomerulation == "0" && cystoscopy_trabeculation == "0") {
          $("[name=cystoscopy_normal][type=checkbox]").prop('checked', true);
          $("[name=cystoscopy_ulcer]").prop("disabled", true);
          $("[name=cystoscopy_glomerulation]").prop("disabled", true);
          $("[name=cystoscopy_trabeculation]").prop("disabled", true);
          $("[name=cystoscopy_ulcer]").attr('checked', false);
          $("[name=cystoscopy_glomerulation]").attr('checked', false);
          $("[name=cystoscopy_trabeculation]").attr('checked', false);
          $("[name=cystoscopy_ulcer][id=Cystoscopy_U1]").prop('checked', true);
          $("#Cystoscopy_G1").prop('checked', true);
          $("#Cystoscopy_T1").prop('checked', true);
        };
        $("[name=cystoscopy_ulcer][type=radio]").filter('[value="<?php echo $row_RecMedical["cystoscopy_ulcer"]; ?>"]').prop('checked', true);
        $("[name=cystoscopy_glomerulation][type=radio]").filter('[value="<?php echo $row_RecMedical["cystoscopy_glomerulation"]; ?>"]').prop('checked', true);
        $("[name=cystoscopy_trabeculation][type=radio]").filter('[value="<?php echo $row_RecMedical["cystoscopy_trabeculation"]; ?>"]').prop('checked', true);
        /*Urodynamic Study*/
        var urodynamic_study_FD = "<?php echo $row_RecMedical["urodynamic_study_FD"]; ?>";
        var urodynamic_study_MCC = "<?php echo $row_RecMedical["urodynamic_study_MCC"]; ?>";
        var urodynamic_study_MP = "<?php echo $row_RecMedical["urodynamic_study_MP"]; ?>";
        var urodynamic_study_DO = "<?php echo $row_RecMedical["urodynamic_study_DO"]; ?>";
        var US_DO_amplitude = "<?php echo $row_RecMedical["US_DO_amplitude"]; ?>";
        var US_DO_amplitude_at = "<?php echo $row_RecMedical["US_DO_amplitude_at"]; ?>";
        var urodynamic_study_DSD = "<?php echo $row_RecMedical["urodynamic_study_DSD"]; ?>";
        var urodynamic_study_compliance = "<?php echo $row_RecMedical["urodynamic_study_compliance"]; ?>";
        if (urodynamic_study_FD == "999" && urodynamic_study_MCC == "999" && urodynamic_study_MP == "999" &&
            urodynamic_study_DO == "99" && urodynamic_study_DSD == "99" && urodynamic_study_compliance == "NA") {
          $("[name=US_na][type=checkbox]").prop('checked', true);
          $("[name=urodynamic_study_FD]").prop("disabled", true);
          $("[name=urodynamic_study_MCC]").prop("disabled", true);
          $("[name=urodynamic_study_MP]").prop("disabled", true);
          $("[name=urodynamic_study_DO][type=radio]").prop("disabled", true);
          $("[name=US_DO_amplitude]").prop("disabled", true);
          $("[name=US_DO_amplitude_at]").prop("disabled", true);
          $("[name=urodynamic_study_DSD][type=radio]").prop("disabled", true);
          $("[name=urodynamic_study_compliance][type=radio]").prop("disabled", true);

          $("[name=urodynamic_study_FD]").val(null);
          $("[name=urodynamic_study_MCC]").val(null);
          $("[name=urodynamic_study_MP]").val(null);
          $("[name=urodynamic_study_DO][type=radio]").attr('checked', false);
          $("[name=US_DO_amplitude]").val(null);
          $("[name=US_DO_amplitude_at]").val(null);
          $("[name=urodynamic_study_DSD][type=radio]").attr('checked', false);
          $("[name=urodynamic_study_compliance][type=radio]").attr('checked', false);
        };
        if (urodynamic_study_FD != "999") {$("[name=urodynamic_study_FD]").val(urodynamic_study_FD);};
        if (urodynamic_study_MCC != "999") {$("[name=urodynamic_study_MCC]").val(urodynamic_study_MCC);};
        if (urodynamic_study_MP != "999") {$("[name=urodynamic_study_MP]").val(urodynamic_study_MP);};
        $("[name=urodynamic_study_DO][type=radio]").filter('[value="<?php echo $row_RecMedical["urodynamic_study_DO"]; ?>"]').prop('checked', true);
        if (urodynamic_study_DO == "1") {
          $("#urodynamic_do0").show();
          if (US_DO_amplitude != "999") {$("[name=US_DO_amplitude]").val(US_DO_amplitude);};
          if (US_DO_amplitude_at != "999") {$("[name=US_DO_amplitude_at]").val(US_DO_amplitude_at);};
        };
        $("[name=urodynamic_study_DSD][type=radio]").filter('[value="<?php echo $row_RecMedical["urodynamic_study_DSD"]; ?>"]').prop('checked', true);
        $("[name=urodynamic_study_compliance][type=radio]").filter('[value="<?php echo $row_RecMedical["urodynamic_study_compliance"]; ?>"]').prop('checked', true);
        /*Biopsy*/
        var biopsy_denuded_epi = "<?php echo $row_RecMedical["biopsy_denuded_epi"]; ?>";
        var biopsy_granulation = "<?php echo $row_RecMedical["biopsy_granulation"]; ?>";
        var biopsy_fibronoid_necrosis = "<?php echo $row_RecMedical["biopsy_fibronoid_necrosis"]; ?>";
        var biopsy_eosinophil_infiltration = "<?php echo $row_RecMedical["biopsy_eosinophil_infiltration"]; ?>";
        if (biopsy_denuded_epi == "99" && biopsy_granulation == "99" && biopsy_fibronoid_necrosis == "99" && biopsy_eosinophil_infiltration == "99") {
          $("[name=biopsy_na][type=checkbox]").prop('checked', true);
          $("[name=biopsy_denuded_epi][type=radio]").prop("disabled", true);
          $("[name=biopsy_granulation][type=radio]").prop("disabled", true);
          $("[name=biopsy_fibronoid_necrosis][type=radio]").prop("disabled", true);
          $("[name=biopsy_eosinophil_infiltration][type=radio]").prop("disabled", true);
          $("[name=biopsy_denuded_epi][type=radio]").attr('checked', false);
          $("[name=biopsy_granulation][type=radio]").attr('checked', false);
          $("[name=biopsy_fibronoid_necrosis][type=radio]").attr('checked', false);
          $("[name=biopsy_eosinophil_infiltration][type=radio]").attr('checked', false);
        };
        $("[name=biopsy_denuded_epi][type=radio]").filter('[value="<?php echo $row_RecMedical["biopsy_denuded_epi"]; ?>"]').prop('checked', true);
        $("[name=biopsy_granulation][type=radio]").filter('[value="<?php echo $row_RecMedical["biopsy_granulation"]; ?>"]').prop('checked', true);
        $("[name=biopsy_fibronoid_necrosis][type=radio]").filter('[value="<?php echo $row_RecMedical["biopsy_fibronoid_necrosis"]; ?>"]').prop('checked', true);
        $("[name=biopsy_eosinophil_infiltration][type=radio]").filter('[value="<?php echo $row_RecMedical["biopsy_eosinophil_infiltration"]; ?>"]').prop('checked', true);
        /*其他*/
        // psychiatric consultation
        var psychi = "<?php echo $row_RecMedical["psychi"]; ?>";
        if (psychi == "NA") {
          $("[name=PC_na][type=checkbox]").prop('checked', true);
          $("[name=psychi][type=radio]").prop("disabled", true);
          $("[name=psychi][type=radio]").attr('checked', false);
        };
        $("[name=psychi][type=radio]").filter('[value="<?php echo $row_RecMedical["psychi"]; ?>"]').prop('checked', true);
        // abdominal echo : Bile duct dilatation
        var bile_duct_expand = "<?php echo $row_RecMedical["bile_duct_expand"]; ?>";
        if (bile_duct_expand == "99") {
          $("[name=BDD_na][type=checkbox]").prop('checked', true);
          $("[name=bile_duct_expand][type=radio]").prop("disabled", true);
          $("[name=bile_duct_expand][type=radio]").attr('checked', false);
        };
        $("[name=bile_duct_expand][type=radio]").filter('[value="<?php echo $row_RecMedical["bile_duct_expand"]; ?>"]').prop('checked', true);
        //Esohagealgastroscopy
        var gastroscopy = "<?php echo $row_RecMedical["gastroscopy"]; ?>";
        var HP_examination = "<?php echo $row_RecMedical["HP_examination"]; ?>";
        if (gastroscopy == "99" && HP_examination == "99") {
          $("[name=ulceration_na][type=checkbox]").prop('checked', true);
          $("[name=gastroscopy][type=radio]").prop("disabled", true);
          $("[name=gastroscopy][type=radio]").attr('checked', false);
          $("[name=HP_examination][type=radio]").prop("disabled", true);
          $("[name=HP_examination][type=radio]").attr('checked', false);
          $("[name=HP_na][type=checkbox]").prop("disabled", true);
          $("[name=HP_na][type=checkbox]").attr('checked', false);
        };
        $("[name=gastroscopy][type=radio]").filter('[value="<?php echo $row_RecMedical["gastroscopy"]; ?>"]').prop('checked', true);
        if (HP_examination == "99") {
          $("[name=HP_na][type=checkbox]").prop('checked', true);
          $("[name=HP_examination][type=radio]").prop("disabled", true);
          $("[name=HP_examination][type=radio]").attr('checked', false);
        };
        $("[name=HP_examination][type=radio]").filter('[value="<?php echo $row_RecMedical["HP_examination"]; ?>"]').prop('checked', true);
        //other studies
        var description = "<?php echo $row_RecMedical["description"]; ?>";
        if (description != "NA") {$("[name=description]").val(description);};
    });
  </script>
  </head>
  <body>
     
      <?php require_once('navbar.php');  ?>
      
      <div class="container">
      	<form method="post" action="update.php">
      	<div class="basic_info">
      		<h2>基本資料</h2>
          <input name="sn" type="hidden" value=<?php echo $row_RecMedical["sn"];?>>
          <p>
            <strong>Key in 人員</strong>：
            <?php echo $row_RecMedical["keyName"]; ?>
          </p>
          <p>
            <strong>Key in 日期</strong>：
            <?php echo $row_RecMedical["joindatetime"]; ?>
          </p>
          <p>
            <strong>最後修改人員</strong>：
            <?php echo $row_RecMedical["update_member"]; ?>
          </p>
          <p>
            <strong>最後修改時間</strong>：
            <?php echo $row_RecMedical["update_time"]; ?>
          </p>
          <hr>
      		<p>
      			<strong>就診日期</strong>：
      			<?php echo $row_RecMedical["date"];?>
      			<br>
      		</p>
      		<p>
      			<strong>就診醫療院所</strong>：
      			<?php echo $row_RecMedical["h_name"]; ?>
      			<br>
      		</p>
          <p>
            <strong>主治醫師</strong>：
            <?php echo $row_RecMedical["doctorName"]; ?>
          </p>
          
      		<p>
      			<strong>個案識別碼</strong>：
      			<?php echo $row_RecMedical["id"]; ?>
      			<br>
      		</p>
      		<p>
      			<strong>性別</strong>：
      			<?php echo $row_RecMedical["sex"]; ?>
            <br>
      		</p>
          <p>
            <strong>出生年月</strong>：
            <?php echo $row_RecMedical["birth_year"]; ?>年
            <?php echo $row_RecMedical["birth_month"]; ?>月
          </p>
          <hr>
      		<p>
            <strong>身高</strong>：
            <select name="height">
              <option value="999">請選擇</option>
              <?php for ($i=100; $i <= 250 ; $i++) { ?>
              <option value=<?php echo $i ?>><?php echo $i ?></option>
              <?php } ?>
            </select>CM
            <br>
          </p>
          <p>
            <strong>體重</strong>：
            <select name="weight">
              <option value="999">請選擇</option>
              <?php for ($i=10; $i <= 200 ; $i++) { ?>
              <option value=<?php echo $i ?>><?php echo $i ?></option>
              <?php } ?>
            </select>KG
            <br>
          </p>
      		<p>
      			<strong>個案現居地</strong>：
      			<select name="location">
                <option value="NA">請選擇</option>
		            <option value="基隆市">基隆市</option><option value="臺北市">臺北市</option><option value="新北市">新北市</option>
		            <option value="桃園市">桃園市</option><option value="新竹市">新竹市</option><option value="新竹縣">新竹縣</option>
		            <option value="苗栗縣">苗栗縣</option><option value="臺中市">臺中市</option><option value="彰化縣">彰化縣</option>
		            <option value="南投縣">南投縣</option><option value="雲林縣">雲林縣</option><option value="嘉義市">嘉義市</option>
		            <option value="嘉義縣">嘉義縣</option><option value="台南市">台南市</option><option value="高雄市">高雄市</option>
		            <option value="屏東縣">屏東縣</option><option value="台東縣">台東縣</option><option value="花蓮縣">花蓮縣</option>
		            <option value="宜蘭縣">宜蘭縣</option><option value="澎湖縣">澎湖縣</option><option value="金門縣">金門縣</option>
		            <option value="連江縣">連江縣</option><option value="other">其他</option>
		        </select>&nbsp;
		        <span id="location_other" style="display:none">
		            <input name="location1"  type="text" size="10" class="normalinput" placeholder="輸入地點">
		        </span>
		        <br>
      		</p>
      		<p>
      			<strong>您的身份為（可複選）</strong>：
            <input name="casetype1" type="hidden" value="0">
      			<input name="casetype1" type="checkbox" id="case_type1" value="1"><label for="case_type1">一般</label>&nbsp;
            <input name="casetype2" type="hidden" value="0">
      			<input name="casetype2" type="checkbox" id="case_type2" value="1"><label for="case_type2">原住民</label>&nbsp;
            <input name="casetype3" type="hidden" value="0">
      			<input name="casetype3" type="checkbox" id="case_type3" value="1"><label for="case_type3">榮民</label>&nbsp;
            <input name="casetype4" type="hidden" value="0">
      			<input name="casetype4" type="checkbox" id="case_type4" value="1"><label for="case_type4">合併精神疾患</label>&nbsp;
            <input name="casetype5" type="hidden" value="0">
      			<input name="casetype5" type="checkbox" id="case_type5" value="1"><label for="case_type5">性工作者</label>&nbsp;
            <input name="casetype6" type="hidden" value="0">
      			<input name="casetype6" type="checkbox" id="case_type6" value="1"><label for="case_type6">中輟生</label>&nbsp;
            <input name="casetype7" type="hidden" value="0">
      			<input name="casetype7" type="checkbox" id="case_type7" value="1"><label for="case_type7">監所受刑人</label>&nbsp;
            <input name="casetype8" type="hidden" value="0">
      			<input name="casetype8" type="checkbox" id="case_type8" value="1"><label for="case_type8">外籍人士</label>
      			<br>
      		</p>
      		<p>
      			<strong>職業</strong>：
            <input name="job" type="hidden" value="NA">
      			<input name="job" type="radio" id="job1" value="無"><label for="job1">無</label>&nbsp;
      			<input name="job" type="radio" id="job2" value="學生"><label for="job2">學生</label>&nbsp;
      			<input name="job" type="radio" id="job3" value="軍警"><label for="job3">軍警</label>&nbsp;
      			<input name="job" type="radio" id="job4" value="公教"><label for="job4">公教</label>&nbsp;
      			<input name="job" type="radio" id="job5" value="商"><label for="job5">商</label>&nbsp;
      			<input name="job" type="radio" id="job6" value="農漁"><label for="job6">農漁</label>&nbsp;
      			<input name="job" type="radio" id="job7" value="工"><label for="job7">工</label>&nbsp;
      			<input name="job" type="radio" id="job8" value="服務業"><label for="job8">服務業</label>&nbsp;
      			<input name="job" type="radio" id="job9" value="自由業"><label for="job9">自由業</label>&nbsp;
      			<input name="job" type="radio" id="job10" value="家庭主婦"><label for="job10">家庭主婦</label>&nbsp;
      			<input name="job" type="radio" id="job11" value="other"><label for="job11">其他</label>
            <span id="job0" style="display:none">
              <input name="job1" type="text" placeholder="請說明">
            </span>
      			<br>
      		</p>
      		<p>
      			<strong>教育程度</strong>：
            <input name="edu" type="hidden" value="NA">
      			<input name="edu" type="radio" id="edu1" value="小學及以下"><label for="edu1">小學及以下</label>&nbsp;
      			<input name="edu" type="radio" id="edu2" value="國中"><label for="edu2">國中</label>&nbsp;
      			<input name="edu" type="radio" id="edu3" value="高中職"><label for="edu3">高中職</label>&nbsp;
      			<input name="edu" type="radio" id="edu4" value="大專/大學"><label for="edu4">大專/大學</label>&nbsp;
      			<input name="edu" type="radio" id="edu5" value="研究所以上"><label for="edu5">研究所以上</label>
      			<br>
      		</p>
      		<p>
      			<strong>婚姻狀況</strong>：
            <input name="marriage" type="hidden" value="NA">
      			<input name="marriage" type="radio" id="marriage1" value="未婚"><label for="marriage1">未婚</label>&nbsp;
      			<input name="marriage" type="radio" id="marriage2" value="已婚"><label for="marriage2">已婚</label>&nbsp;
      			<input name="marriage" type="radio" id="marriage3" value="同居"><label for="marriage3">同居</label>&nbsp;
      			<input name="marriage" type="radio" id="marriage4" value="離婚"><label for="marriage4">離婚</label>&nbsp;
      			<input name="marriage" type="radio" id="marriage5" value="喪偶"><label for="marriage5">喪偶</label>&nbsp;
      			<input name="marriage" type="radio" id="marriage6" value="other"><label for="marriage6">其他</label>
            <span id="marriage0" style="display:none">
              <input name="marriage1" type="text" placeholder="請說明">
            </span>
      			<br>
      		</p>
      		<p>
      			<strong>併存疾病</strong>：
            <input name="comor" type="hidden" value="0">
      			<input name="comor" type="checkbox" id="comorbidity1" value="1"><label for="comorbidity1">無</label>&nbsp;

            <input name="comor1" type="hidden" value="0">
      			<input name="comor1" type="checkbox" id="comorbidity2" value="1"><label for="comorbidity2">AIDS</label>&nbsp;
            <input name="comor2" type="hidden" value="0">
      			<input name="comor2" type="checkbox" id="comorbidity3" value="1"><label for="comorbidity3">B型肝炎</label>&nbsp;
            <input name="comor3" type="hidden" value="0">
      			<input name="comor3" type="checkbox" id="comorbidity4" value="1"><label for="comorbidity4">C型肝炎</label>&nbsp;
            <input name="comor4" type="hidden" value="0">
      			<input name="comor4" type="checkbox" id="comorbidity5" value="1"><label for="comorbidity5">膀胱炎</label>&nbsp;
            <input name="comor5" type="hidden" value="0">
      			<input name="comor5" type="checkbox" id="comorbidity6" value="1"><label for="comorbidity6">胃痛</label>&nbsp;
            <input name="comor6" type="hidden" value="0">
      			<input name="comor6" type="checkbox" id="comorbidity7" value="1"><label for="comorbidity7">下腹痛</label>&nbsp;
            <input name="comor7" type="hidden" value="0">
      			<input name="comor7" type="checkbox" id="comorbidity8" value="1"><label for="comorbidity8">梅毒</label>&nbsp;
            <input name="comor8" type="hidden" value="0">
      			<input name="comor8" type="checkbox" id="comorbidity9" value="1"><label for="comorbidity9">精神疾病</label>&nbsp;
            <input name="comor9" type="hidden" value="0">
      			<input name="comor9" type="checkbox" id="comorbidity10" value="1"><label for="comorbidity10">結核病</label>&nbsp;
            <input name="comor10" type="hidden" value="0">
      			<input name="comor10" type="checkbox" id="comorbidity11" value="1"><label for="comorbidity11">腦血管疾病</label>&nbsp;
            <input name="comor11" type="hidden" value="0">
      			<input name="comor11" type="checkbox" id="comorbidity12" value="1"><label for="comorbidity12">癌症</label>&nbsp;
            <input name="comor12" type="hidden" value="0">
      			<input name="comor12" type="checkbox" id="comorbidity13" value="1"><label for="comorbidity13">糖尿病</label>&nbsp;
            <input name="comor13" type="hidden" value="0">
      			<input name="comor13" type="checkbox" id="comorbidity14" value="1"><label for="comorbidity14">鼻穿孔</label>&nbsp;
            <input name="comor14" type="hidden" value="0">
            <input name="comor14" type="checkbox" id="comorbidity15" value="1"><label for="comorbidity15">憂鬱症</label>&nbsp;
            <input name="comor15" type="hidden" value="0">
            <input name="comor15" type="checkbox" id="comorbidity16" value="1"><label for="comorbidity16">其他</label>&nbsp;
      			<span id="comor" style="display:none">
      				<input name="comor_other" type="text" placeholder="請說明">
      			</span>
      			<br>
      		</p>
      		<p>
      			<strong>最近三個月性生活情形？</strong>
            <input name="regular_sex_partner" type="hidden" value="NA">
      			<input name="regular_sex_partner" type="radio" id="sex_partner1" value="無性生活"><label for="sex_partner1">無性生活</label>&nbsp;
            <input name="regular_sex_partner" type="radio" id="sex_partner2" value="單一固定性伴侶"><label for="sex_partner2">有, 單一固定性伴侶</label>&nbsp;
            <input name="regular_sex_partner" type="radio" id="sex_partner3" value="多重性伴侶"><label for="sex_partner3">有, 多重性伴侶</label>&nbsp;
      			<input name="regular_sex_partner" type="radio" id="sex_partner4" value="不知道"><label for="sex_partner4">不知道</label>
      			<br>
      		</p>
      		<p>
      			<strong>是否抽菸？</strong>
            <input name="smoking" type="hidden" value="NA">
      			<input name="smoking" type="radio" id="smoking1" value="否"><label for="smoking1">否</label>&nbsp;
      			<input name="smoking" type="radio" id="smoking2" value="是"><label for="smoking2">是</label>
      			<br>
      		</p>
      		<p>
      			<strong>是否喝酒？</strong>
            <input name="drinking" type="hidden" value="NA">
      			<input name="drinking" type="radio" id="drinking1" value="否"><label for="drinking1">否</label>&nbsp;
      			<input name="drinking" type="radio" id="drinking2" value="是"><label for="drinking2">是</label>
      			<br>
      		</p>
      		<p>
      			<strong>是否嚼檳榔？</strong>
            <input name="betel_nut" type="hidden" value="NA">
      			<input name="betel_nut" type="radio" id="betel_nut1" value="否"><label for="betel_nut1">否</label>&nbsp;
      			<input name="betel_nut" type="radio" id="betel_nut2" value="是"><label for="betel_nut2">是</label>
      			<br>
      		</p>
      	</div>
      	<div class="drug_info">
      		<h2>藥物濫用資料</h2>
      		<p>
      			<strong>一、目前您濫用藥物的原因（可複選）</strong>：<br>
            <input name="drugreason1" type="hidden" value="0">
      			<input name="drugreason1" type="checkbox" id="drug_reason1" value="1"><label for="drug_reason1">無聊</label>&nbsp;
            <input name="drugreason2" type="hidden" value="0">
      			<input name="drugreason2" type="checkbox" id="drug_reason2" value="1"><label for="drug_reason2">好奇</label>&nbsp;
            <input name="drugreason3" type="hidden" value="0">
      			<input name="drugreason3" type="checkbox" id="drug_reason3" value="1"><label for="drug_reason3">找刺激</label>&nbsp;
            <input name="drugreason4" type="hidden" value="0">
      			<input name="drugreason4" type="checkbox" id="drug_reason4" value="1"><label for="drug_reason4">自殺</label>&nbsp;
            <input name="drugreason5" type="hidden" value="0">
      			<input name="drugreason5" type="checkbox" id="drug_reason5" value="1"><label for="drug_reason5">紓解壓力</label>&nbsp;
            <input name="drugreason6" type="hidden" value="0">
      			<input name="drugreason6" type="checkbox" id="drug_reason6" value="1"><label for="drug_reason6">受同儕團體影響</label>&nbsp;
            <input name="drugreason7" type="hidden" value="0">
      			<input name="drugreason7" type="checkbox" id="drug_reason7" value="1"><label for="drug_reason7">提神</label>&nbsp;
            <input name="drugreason8" type="hidden" value="0">
      			<input name="drugreason8" type="checkbox" id="drug_reason8" value="1"><label for="drug_reason8">治療疾病</label>&nbsp;
            <input name="drugreason9" type="hidden" value="0">
      			<input name="drugreason9" type="checkbox" id="drug_reason9" value="1"><label for="drug_reason9">安眠</label>&nbsp;
            <input name="drugreason10" type="hidden" value="0">
      			<input name="drugreason10" type="checkbox" id="drug_reason10" value="1"><label for="drug_reason10">藥物依賴</label>&nbsp;
            <input name="drugreason11" type="hidden" value="0">
      			<input name="drugreason11" type="checkbox" id="drug_reason11" value="1"><label for="drug_reason11">減肥</label>&nbsp;
            <input name="drugreason12" type="hidden" value="0">
            <input name="drugreason12" type="checkbox" id="drug_reason12" value="1"><label for="drug_reason12">失戀</label>&nbsp;
            <input name="drugreason13" type="hidden" value="0">
            <input name="drugreason13" type="checkbox" id="drug_reason13" value="1"><label for="drug_reason113">失業</label>&nbsp;
            <input name="drugreason14" type="hidden" value="0">
            <input name="drugreason14" type="checkbox" id="drug_reason14" value="1"><label for="drug_reason14">憂鬱</label>&nbsp;
            <input name="drugreason15" type="hidden" value="0">
      			<input name="drugreason15" type="checkbox" id="drug_reason15" value="1"><label for="drug_reason15">其他</label>
            <span id="drug_reason0" style="display:none">
              <input name="drugreason_other" type="text" placeholder="請說明">
            </span>
      			<br>
      		</p>
      		<p>
      			<strong>二、目前您取得藥物的場所（可複選）</strong>：<br>
            <input name="drugplace1" type="hidden" value="0">
      			<input name="drugplace1" type="checkbox" id="drug_place1" value="1"><label for="drug_place1">醫院</label>&nbsp;
            <input name="drugplace2" type="hidden" value="0">
      			<input name="drugplace2" type="checkbox" id="drug_place2" value="1"><label for="drug_place2">藥局(房)</label>&nbsp;
            <input name="drugplace3" type="hidden" value="0">
      			<input name="drugplace3" type="checkbox" id="drug_place3" value="1"><label for="drug_place3">學校</label>&nbsp;
            <input name="drugplace4" type="hidden" value="0">
      			<input name="drugplace4" type="checkbox" id="drug_place4" value="1"><label for="drug_place4">舞廳/PUB/酒店</label>&nbsp;
            <input name="drugplace5" type="hidden" value="0">
      			<input name="drugplace5" type="checkbox" id="drug_place5" value="1"><label for="drug_place5">KTV/MTV/網咖</label>&nbsp;
            <input name="drugplace6" type="hidden" value="0">
      			<input name="drugplace6" type="checkbox" id="drug_place6" value="1"><label for="drug_place6">賭場</label>&nbsp;
            <input name="drugplace7" type="hidden" value="0">
      			<input name="drugplace7" type="checkbox" id="drug_place7" value="1"><label for="drug_place7">電動玩具店/遊樂場</label>&nbsp;
            <input name="drugplace8" type="hidden" value="0">
      			<input name="drugplace8" type="checkbox" id="drug_place8" value="1"><label for="drug_place8">色情場所</label>&nbsp;
            <input name="drugplace9" type="hidden" value="0">
      			<input name="drugplace9" type="checkbox" id="drug_place9" value="1"><label for="drug_place9">旅館</label>&nbsp;
            <input name="drugplace10" type="hidden" value="0">
      			<input name="drugplace10" type="checkbox" id="drug_place10" value="1"><label for="drug_place10">檳榔攤</label>&nbsp;
            <input name="drugplace11" type="hidden" value="0">
      			<input name="drugplace11" type="checkbox" id="drug_place11" value="1"><label for="drug_place11">書局/商店/五金行</label>&nbsp;
            <input name="drugplace12" type="hidden" value="0">
      			<input name="drugplace12" type="checkbox" id="drug_place12" value="1"><label for="drug_place12">網路</label>&nbsp;
            <input name="drugplace13" type="hidden" value="0">
      			<input name="drugplace13" type="checkbox" id="drug_place13" value="1"><label for="drug_place13">雜誌/報紙/廣告</label>&nbsp;
            <input name="drugplace14" type="hidden" value="0">
      			<input name="drugplace14" type="checkbox" id="drug_place14" value="1"><label for="drug_place14">車上</label>&nbsp;
            <input name="drugplace15" type="hidden" value="0">
      			<input name="drugplace15" type="checkbox" id="drug_place15" value="1"><label for="drug_place15">路邊</label>&nbsp;
            <input name="drugplace16" type="hidden" value="0">
      			<input name="drugplace16" type="checkbox" id="drug_place16" value="1"><label for="drug_place16">朋友住處</label>&nbsp;
            <input name="drugplace17" type="hidden" value="0">
      			<input name="drugplace17" type="checkbox" id="drug_place17" value="1"><label for="drug_place17">藥癮戒治機構附近</label>&nbsp;
            <input name="drugplace18" type="hidden" value="0">
      			<input name="drugplace18" type="checkbox" id="drug_place18" value="1"><label for="drug_place18">國外</label>&nbsp;
            <input name="drugplace19" type="hidden" value="0">
      			<input name="drugplace19" type="checkbox" id="drug_place19" value="1"><label for="drug_place19">其他</label>
            <span id="drug_place0" style="display:none">
              <input name="drugplace_other" type="text" placeholder="請說明">
            </span>
      			<br>
      		</p>
      		<p>
      			<strong>三、目前取得藥物的來源對象（可複選）</strong>：<br>
            <input name="drugsource1" type="hidden" value="0">
      			<input name="drugsource1" type="checkbox" id="drug_source1" value="1"><label for="drug_source1">醫師</label>&nbsp;
            <input name="drugsource2" type="hidden" value="0">
      			<input name="drugsource2" type="checkbox" id="drug_source2" value="1"><label for="drug_source2">藥師</label>&nbsp;
            <input name="drugsource3" type="hidden" value="0">
      			<input name="drugsource3" type="checkbox" id="drug_source3" value="1"><label for="drug_source3">朋友</label>&nbsp;
            <input name="drugsource4" type="hidden" value="0">
      			<input name="drugsource4" type="checkbox" id="drug_source4" value="1"><label for="drug_source4">同學</label>&nbsp;
            <input name="drugsource5" type="hidden" value="0">
      			<input name="drugsource5" type="checkbox" id="drug_source5" value="1"><label for="drug_source5">親人</label>&nbsp;
            <input name="drugsource6" type="hidden" value="0">
      			<input name="drugsource6" type="checkbox" id="drug_source6" value="1"><label for="drug_source6">藥頭/毒販</label>&nbsp;
            <input name="drugsource7" type="hidden" value="0">
      			<input name="drugsource7" type="checkbox" id="drug_source7" value="1"><label for="drug_source7">自己販賣</label>&nbsp;
            <input name="drugsource8" type="hidden" value="0">
      			<input name="drugsource8" type="checkbox" id="drug_source8" value="1"><label for="drug_source8">書局/商店/五金行老闆</label>&nbsp;
            <input name="drugsource9" type="hidden" value="0">
      			<input name="drugsource9" type="checkbox" id="drug_source9" value="1"><label for="drug_source9">其他</label>
            <span id="drug_source0" style="display:none">
              <input name="drugsource_other" type="text" placeholder="請說明">
            </span>
      			<br>
      		</p>
      		<p>
      			<strong>四、K他命使用情形</strong>：<br>
      		</p>
      		<p>
      			<strong>首次使用K他命的年齡</strong>：
            <input name="first_ketamine_age" type="radio" id="FKA1" value="7-12"><label for="FKA1">小學(7-12歲)</label>&nbsp;
            <input name="first_ketamine_age" type="radio" id="FKA2" value="13-15"><label for="FKA2">國中(13-15歲)</label>&nbsp;
            <input name="first_ketamine_age" type="radio" id="FKA3" value="16-18"><label for="FKA3">高中(16-18歲)</label>&nbsp;
            <input name="first_ketamine_age" type="radio" id="FKA4" value="19-22"><label for="FKA4">大學(19-22歲)</label>&nbsp;
            <input name="first_ketamine_age" type="radio" id="FKA5" value="23-30"><label for="FKA5">23-30歲</label>&nbsp;
            <input name="first_ketamine_age" type="radio" id="FKA6" value="31-35"><label for="FKA6">31-35歲</label>&nbsp;
            <input name="first_ketamine_age" type="radio" id="FKA7" value="36-40"><label for="FKA7">36-40歲</label>&nbsp;
            <input name="first_ketamine_age" type="radio" id="FKA8" value="41-45"><label for="FKA8">41-45歲</label>&nbsp;
            <input name="first_ketamine_age" type="radio" id="FKA9" value="46-98"><label for="FKA9">46歲以後</label>
      			<br>
      		</p>
      		<p>
      			<strong>使用期間</strong>：
      			<select name="ketamine_history_year">
      				<?php for ($i=0; $i < 100; $i++) { ?>
      				<option value=<?php echo $i; ?>><?php echo $i;?></option>
      				<?php } ?>
      			</select>年&nbsp;
      			<select name="ketamine_history_month">
      				<?php for ($i=0; $i < 12; $i++) { ?>
      				<option value=<?php echo $i; ?>><?php echo $i;?></option>
      				<?php } ?>
      			</select>月
      			<br>
      		</p>
      		<p>
      			<strong>每天平均K他命的量</strong>：
            <input name="ketamine_ave" type="hidden" value="NA">
            <input name="ketamine_ave" type="radio" id="kave1" value="0.1-1.0"><label for="kave1">0.1-1.0公克</label>&nbsp;
            <input name="ketamine_ave" type="radio" id="kave2" value="1.1-1.9"><label for="kave2">1.1-1.9公克</label>&nbsp;
            <input name="ketamine_ave" type="radio" id="kave3" value="2.0-4.9"><label for="kave3">2.0-4.9公克</label>&nbsp;
            <input name="ketamine_ave" type="radio" id="kave4" value="5.0-9.9"><label for="kave4">5.0-9.9公克</label>&nbsp;
            <input name="ketamine_ave" type="radio" id="kave5" value="10.0-14.9"><label for="kave5">10.0-14.9公克</label>&nbsp;
            <input name="ketamine_ave" type="radio" id="kave6" value="15.0up"><label for="kave6">15公克以上</label>
      			<br>
      		</p>
      		<p>
            <strong>主要使用方式</strong>：
            <input name="ketamine_method1" type="hidden" value="0">
            <input name="ketamine_method1" type="checkbox" id="ketaminemethod1" value="1"><label for="ketaminemethod1">口服</label>&nbsp;
            <input name="ketamine_method2" type="hidden" value="0">
            <input name="ketamine_method2" type="checkbox" id="ketaminemethod2" value="1"><label for="ketaminemethod2">以香菸或煙管方式吸食</label>&nbsp;
            <input name="ketamine_method3" type="hidden" value="0">
            <input name="ketamine_method3" type="checkbox" id="ketaminemethod3" value="1"><label for="ketaminemethod3">加熱成煙霧後鼻吸</label>&nbsp;
            <input name="ketamine_method4" type="hidden" value="0">
            <input name="ketamine_method4" type="checkbox" id="ketaminemethod4" value="1"><label for="ketaminemethod4">藥物直接鼻吸</label>&nbsp;
            <input name="ketamine_method5" type="hidden" value="0">
            <input name="ketamine_method5" type="checkbox" id="ketaminemethod5" value="1"><label for="ketaminemethod5">嗅吸蒸發之氣體</label>&nbsp;
            <input name="ketamine_method6" type="hidden" value="0">
            <input name="ketamine_method6" type="checkbox" id="ketaminemethod6" value="1"><label for="ketaminemethod6">其他吸食方式</label>
            <span id="ketamine_method0" style="display:none">
              <input name="ketamine_method_other" type="text" placeholder="請說明">
            </span>
            <br>
          </p>
      		<p>
      			<strong>有合併使用其他種類之藥物嗎？</strong>
            <input name="combined_drug" type="hidden" value="NA">
      			<input name="combined_drug" type="radio" id="combined_drug1" value="無"><label for="combined_drug1">無</label>
      			<input name="combined_drug" type="radio" id="combined_drug2" value="other"><label for="combined_drug2">有</label>
            <span id="combined_drug0" style="display:none">
              <input name="combined_drug1" type="text" placeholder="請說明">
            </span>
      		</p>
      		<p>
      			<strong>膀胱症狀已經有多久的時間，約為</strong>：
            <input name="symptom_starting_date" type="hidden" value="NA">
            <input name="symptom_starting_date" type="radio" id="SSD0" value="無"><label for="SSD0">無</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD1" value="1-3個月"><label for="SSD1">1-3個月</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD2" value="4-6個月"><label for="SSD2">4-6個月</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD3" value="7-11個月"><label for="SSD3">7-11個月</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD4" value="1年"><label for="SSD4">1年</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD5" value="2年"><label for="SSD5">2年</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD6" value="3-5年"><label for="SSD6">3-5年</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD7" value="6-10年"><label for="SSD7">6-10年</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD8" value="11-15年"><label for="SSD8">11-15年</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD9" value="16-20年"><label for="SSD9">16-20年</label>&nbsp;
            <input name="symptom_starting_date" type="radio" id="SSD10" value="20年以上"><label for="SSD10">20年以上</label>
      		</p>
          <p>
            <strong>是否已戒除Ｋ他命？</strong>
            <input name="stop_ketamine" type="hidden" value="99">
            <input name="stop_ketamine" type="radio" id="stopK1" value="0"><label for="stopK1">否</label>&nbsp;
            <input name="stop_ketamine" type="radio" id="stopK2" value="1"><label for="stopK2">是</label>&nbsp;
            <span id="stopK" style="display:none;">
              ,&nbsp;已經戒多久？
              <select name="stop_ketamine_year">
                <?php for ($i=0; $i < 100; $i++) { ?>
                <option value=<?php echo $i; ?>><?php echo $i;?></option>
                <?php } ?>
              </select>年&nbsp;
              <select name="stop_ketamine_month">
                <?php for ($i=0; $i < 12; $i++) { ?>
                <option value=<?php echo $i; ?>><?php echo $i;?></option>
                <?php } ?>
              </select>月
            </span>
          </p>
      	</div>
      	<div class="ipss_info ipad">
          <h2>下泌尿道症狀評分表（IPSS）<span class="ipad-qs">，請依據您自身狀況點選：</span></h2>
          <p>
            <strong>
              <span>IPSS得分-1：</span>
              <span>1. 在過去一個月內，您是否有小便解不乾淨的感覺？</span>
            </strong>
            <input name="IPSS_score1" type="hidden" value="99">
            <input name="IPSS_score1" type="radio" id="IPSS1_1" value="0"><label for="IPSS1_1">0、完全沒有</label>&nbsp;
            <input name="IPSS_score1" type="radio" id="IPSS1_2" value="1"><label for="IPSS1_2">1、偶爾</label>&nbsp;
            <input name="IPSS_score1" type="radio" id="IPSS1_3" value="2"><label for="IPSS1_3">2、三不五時</label>&nbsp;
            <input name="IPSS_score1" type="radio" id="IPSS1_4" value="3"><label for="IPSS1_4">3、一半一半</label>&nbsp;
            <input name="IPSS_score1" type="radio" id="IPSS1_5" value="4"><label for="IPSS1_5">4、經常</label>&nbsp;
            <input name="IPSS_score1" type="radio" id="IPSS1_6" value="5"><label for="IPSS1_6">5、總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IPSS得分-2：</span>
              <span>2. 在過去一個月內，您是否不到兩小時就要再去小便一次？</span>
            </strong>
            <input name="IPSS_score2" type="hidden" value="99">
            <input name="IPSS_score2" type="radio" id="IPSS2_1" value="0"><label for="IPSS2_1">0、完全沒有</label>&nbsp;
            <input name="IPSS_score2" type="radio" id="IPSS2_2" value="1"><label for="IPSS2_2">1、偶爾</label>&nbsp;
            <input name="IPSS_score2" type="radio" id="IPSS2_3" value="2"><label for="IPSS2_3">2、三不五時</label>&nbsp;
            <input name="IPSS_score2" type="radio" id="IPSS2_4" value="3"><label for="IPSS2_4">3、一半一半</label>&nbsp;
            <input name="IPSS_score2" type="radio" id="IPSS2_5" value="4"><label for="IPSS2_5">4、經常</label>&nbsp;
            <input name="IPSS_score2" type="radio" id="IPSS2_6" value="5"><label for="IPSS2_6">5、總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IPSS得分-3：</span>
              <span>3. 在過去一個月內，您是否有小便斷斷續續的現象？</span>
            </strong>
            <input name="IPSS_score3" type="hidden" value="99">
            <input name="IPSS_score3" type="radio" id="IPSS3_1" value="0"><label for="IPSS3_1">0、完全沒有</label>&nbsp;
            <input name="IPSS_score3" type="radio" id="IPSS3_2" value="1"><label for="IPSS3_2">1、偶爾</label>&nbsp;
            <input name="IPSS_score3" type="radio" id="IPSS3_3" value="2"><label for="IPSS3_3">2、三不五時</label>&nbsp;
            <input name="IPSS_score3" type="radio" id="IPSS3_4" value="3"><label for="IPSS3_4">3、一半一半</label>&nbsp;
            <input name="IPSS_score3" type="radio" id="IPSS3_5" value="4"><label for="IPSS3_5">4、經常</label>&nbsp;
            <input name="IPSS_score3" type="radio" id="IPSS3_6" value="5"><label for="IPSS3_6">5、總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IPSS得分-4：</span>
              <span>4. 在過去一個月內，您是否有憋不住尿的感覺(尿急就憋不住)？</span>
            </strong>
            <input name="IPSS_score4" type="hidden" value="99">
            <input name="IPSS_score4" type="radio" id="IPSS4_1" value="0"><label for="IPSS4_1">0、完全沒有</label>&nbsp;
            <input name="IPSS_score4" type="radio" id="IPSS4_2" value="1"><label for="IPSS4_2">1、偶爾</label>&nbsp;
            <input name="IPSS_score4" type="radio" id="IPSS4_3" value="2"><label for="IPSS4_3">2、三不五時</label>&nbsp;
            <input name="IPSS_score4" type="radio" id="IPSS4_4" value="3"><label for="IPSS4_4">3、一半一半</label>&nbsp;
            <input name="IPSS_score4" type="radio" id="IPSS4_5" value="4"><label for="IPSS4_5">4、經常</label>&nbsp;
            <input name="IPSS_score4" type="radio" id="IPSS4_6" value="5"><label for="IPSS4_6">5、總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IPSS得分-5：</span>
              <span>5. 在過去一個月內，您是否有小便無力尿流變細的感覺？</span>
            </strong>
            <input name="IPSS_score5" type="hidden" value="99">
            <input name="IPSS_score5" type="radio" id="IPSS5_1" value="0"><label for="IPSS5_1">0、完全沒有</label>&nbsp;
            <input name="IPSS_score5" type="radio" id="IPSS5_2" value="1"><label for="IPSS5_2">1、偶爾</label>&nbsp;
            <input name="IPSS_score5" type="radio" id="IPSS5_3" value="2"><label for="IPSS5_3">2、三不五時</label>&nbsp;
            <input name="IPSS_score5" type="radio" id="IPSS5_4" value="3"><label for="IPSS5_4">3、一半一半</label>&nbsp;
            <input name="IPSS_score5" type="radio" id="IPSS5_5" value="4"><label for="IPSS5_5">4、經常</label>&nbsp;
            <input name="IPSS_score5" type="radio" id="IPSS5_6" value="5"><label for="IPSS5_6">5、總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IPSS得分-6：</span>
              <span>6. 在過一個月內，您是否有需要用力才能排解出小便？</span>
            </strong>
            <input name="IPSS_score6" type="hidden" value="99">
            <input name="IPSS_score6" type="radio" id="IPSS6_1" value="0"><label for="IPSS6_1">0、完全沒有</label>&nbsp;
            <input name="IPSS_score6" type="radio" id="IPSS6_2" value="1"><label for="IPSS6_2">1、偶爾</label>&nbsp;
            <input name="IPSS_score6" type="radio" id="IPSS6_3" value="2"><label for="IPSS6_3">2、三不五時</label>&nbsp;
            <input name="IPSS_score6" type="radio" id="IPSS6_4" value="3"><label for="IPSS6_4">3、一半一半</label>&nbsp;
            <input name="IPSS_score6" type="radio" id="IPSS6_5" value="4"><label for="IPSS6_5">4、經常</label>&nbsp;
            <input name="IPSS_score6" type="radio" id="IPSS6_6" value="5"><label for="IPSS6_6">5、總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IPSS得分-7：</span>
              <span>7. 在過去一個月內，晚上睡覺到早上睡醒您一般需要起床小便幾次？</span>
            </strong>
            <input name="IPSS_score7" type="hidden" value="99">
            <input name="IPSS_score7" type="radio" id="IPSS7_1" value="0"><label for="IPSS7_1">0、完全沒有</label>&nbsp;
            <input name="IPSS_score7" type="radio" id="IPSS7_2" value="1"><label for="IPSS7_2">1、一次</label>&nbsp;
            <input name="IPSS_score7" type="radio" id="IPSS7_3" value="2"><label for="IPSS7_3">2、二次</label>&nbsp;
            <input name="IPSS_score7" type="radio" id="IPSS7_4" value="3"><label for="IPSS7_4">3、三次</label>&nbsp;
            <input name="IPSS_score7" type="radio" id="IPSS7_5" value="4"><label for="IPSS7_5">4、四次</label>&nbsp;
            <input name="IPSS_score7" type="radio" id="IPSS7_6" value="5"><label for="IPSS7_6">5、五次或以上</label>
            <br>
          </p>
          <p>
            <strong>
              <span>因泌尿系統疾病的症狀而影響了生活的素質</span>
              <span>如果您以後的小便情形都和現在一樣，您會覺得如何？</span>
            </strong>
            <input name="urinary_quality_life" type="hidden" value="99">
            <input name="urinary_quality_life" type="radio" id="uql1" value="0"><label for="uql1">0、非常滿意</label>&nbsp;
            <input name="urinary_quality_life" type="radio" id="uql2" value="1"><label for="uql2">1、滿意</label>&nbsp;
            <input name="urinary_quality_life" type="radio" id="uql3" value="2"><label for="uql3">2、還算滿意</label>&nbsp;
            <input name="urinary_quality_life" type="radio" id="uql4" value="3"><label for="uql4">3、無所謂</label>&nbsp;
            <input name="urinary_quality_life" type="radio" id="uql5" value="4"><label for="uql5">4、不太滿意</label>&nbsp;
            <input name="urinary_quality_life" type="radio" id="uql6" value="5"><label for="uql6">5、不滿意</label>&nbsp;
            <input name="urinary_quality_life" type="radio" id="uql7" value="6"><label for="uql7">6、非常不滿意</label>
            <br>
          </p>
        </div>
        <div class="ic_symptom_info ipad">
          <h2>間質性膀胱炎症狀指標<span class="ipad-qs">，請依據您自身狀況點選：</span></h2>
          <p>
            <strong>
              <span>間質性膀胱炎症狀指標-1：</span>
              <span>1. 會有無預警而強烈想解尿的感覺，一個月佔多少百分比？</span>
            </strong>
            <input name="IC_symptom1" type="hidden" value="99">
            <input name="IC_symptom1" type="radio" id="ICS1_1" value="0"><label for="ICS1_1">0、完全沒有</label>&nbsp;
            <input name="IC_symptom1" type="radio" id="ICS1_2" value="1"><label for="ICS1_2">1、不到20%</label>&nbsp;
            <input name="IC_symptom1" type="radio" id="ICS1_3" value="2"><label for="ICS1_3">2、不到50%</label>&nbsp;
            <input name="IC_symptom1" type="radio" id="ICS1_4" value="3"><label for="ICS1_4">3、將近50%</label>&nbsp;
            <input name="IC_symptom1" type="radio" id="ICS1_5" value="4"><label for="ICS1_5">4、超過50%</label>&nbsp;
            <input name="IC_symptom1" type="radio" id="ICS1_6" value="5"><label for="ICS1_6">5、幾乎每次</label>
            <br>
          </p>
          <p>
            <strong>
              <span>間質性膀胱炎症狀指標-2：</span>
              <span>2. 解尿後是否在不到 2 小時內無法忍受而必須再解尿的次數？</span>
            </strong>
            <input name="IC_symptom2" type="hidden" value="99">
            <input name="IC_symptom2" type="radio" id="ICS2_1" value="0"><label for="ICS2_1">0、完全沒有</label>&nbsp;
            <input name="IC_symptom2" type="radio" id="ICS2_2" value="1"><label for="ICS2_2">1、很少有</label>&nbsp;
            <input name="IC_symptom2" type="radio" id="ICS2_3" value="2"><label for="ICS2_3">2、不到一半次數</label>&nbsp;
            <input name="IC_symptom2" type="radio" id="ICS2_4" value="3"><label for="ICS2_4">3、接近一半次數</label>&nbsp;
            <input name="IC_symptom2" type="radio" id="ICS2_5" value="4"><label for="ICS2_5">4、超過一半次數</label>&nbsp;
            <input name="IC_symptom2" type="radio" id="ICS2_6" value="5"><label for="ICS2_6">5、幾乎每次</label>
            <br>
          </p>
          <p>
            <strong>
              <span>間質性膀胱炎症狀指標-3：</span>
              <span>3. 平均每天在夜間起床解尿的次數？</span>
            </strong>
            <input name="IC_symptom3" type="hidden" value="99">
            <input name="IC_symptom3" type="radio" id="ICS3_1" value="0"><label for="ICS3_1">0、完全沒有</label>&nbsp;
            <input name="IC_symptom3" type="radio" id="ICS3_2" value="1"><label for="ICS3_2">1、一次</label>&nbsp;
            <input name="IC_symptom3" type="radio" id="ICS3_3" value="2"><label for="ICS3_3">2、二次</label>&nbsp;
            <input name="IC_symptom3" type="radio" id="ICS3_4" value="3"><label for="ICS3_4">3、三次</label>&nbsp;
            <input name="IC_symptom3" type="radio" id="ICS3_5" value="4"><label for="ICS3_5">4、四次</label>&nbsp;
            <input name="IC_symptom3" type="radio" id="ICS3_6" value="5"><label for="ICS3_6">5、五次含以上</label>
            <br>
          </p>
          <p>
            <strong>
              <span>間質性膀胱炎症狀指標-4：</span>
              <span>4. 是否有膀胱疼痛或下腹痛或灼熱的情形？</span>
            </strong>
            <input name="IC_symptom4" type="hidden" value="99">
            <input name="IC_symptom4" type="radio" id="ICS4_1" value="0"><label for="ICS4_1">0、完全沒有</label>&nbsp;
            <input name="IC_symptom4" type="radio" id="ICS4_2" value="1"><label for="ICS4_2">1、很少有</label>&nbsp;
            <input name="IC_symptom4" type="radio" id="ICS4_3" value="2"><label for="ICS4_3">2、不到一半時間</label>&nbsp;
            <input name="IC_symptom4" type="radio" id="ICS4_4" value="3"><label for="ICS4_4">3、半數時間</label>&nbsp;
            <input name="IC_symptom4" type="radio" id="ICS4_5" value="4"><label for="ICS4_5">4、超過半數時間</label>&nbsp;
            <input name="IC_symptom4" type="radio" id="ICS4_6" value="5"><label for="ICS4_6">5、總是如此</label>
            <br>
          </p>
        </div>
        <div class="ic_question_info ipad">
          <h2>間質性膀胱炎問題指標<span class="ipad-qs">，請依據您自身狀況點選：</span></h2>
          <p>
            <strong>
              <span>間質性膀胱炎問題指標-1：</span>
              <span>1. 用藥期間，<u>日間頻尿</u>對您是否造成很大的困擾？</span>
            </strong>
            <input name="IC_question1" type="hidden" value="99">
            <input name="IC_question1" type="radio" id="ICQ1_1" value="0"><label for="ICQ1_1">0、沒有困擾</label>&nbsp;
            <input name="IC_question1" type="radio" id="ICQ1_2" value="1"><label for="ICQ1_2">1、極小困擾</label>&nbsp;
            <input name="IC_question1" type="radio" id="ICQ1_3" value="2"><label for="ICQ1_3">2、小困擾</label>&nbsp;
            <input name="IC_question1" type="radio" id="ICQ1_4" value="3"><label for="ICQ1_4">3、中等困擾</label>&nbsp;
            <input name="IC_question1" type="radio" id="ICQ1_5" value="4"><label for="ICQ1_5">4、大困擾</label>
            <br>
          </p>
          <p>
            <strong>
              <span>間質性膀胱炎問題指標-2：</span>
              <span>2. 用藥期間，<u>夜間起床解尿</u>對您是否造成很大的困擾？</span>
            </strong>
            <input name="IC_question2" type="hidden" value="99">
            <input name="IC_question2" type="radio" id="ICQ2_1" value="0"><label for="ICQ2_1">0、沒有困擾</label>&nbsp;
            <input name="IC_question2" type="radio" id="ICQ2_2" value="1"><label for="ICQ2_2">1、極小困擾</label>&nbsp;
            <input name="IC_question2" type="radio" id="ICQ2_3" value="2"><label for="ICQ2_3">2、小困擾</label>&nbsp;
            <input name="IC_question2" type="radio" id="ICQ2_4" value="3"><label for="ICQ2_4">3、中等困擾</label>&nbsp;
            <input name="IC_question2" type="radio" id="ICQ2_5" value="4"><label for="ICQ2_5">4、大困擾</label>
            <br>
          </p>
          <p>
            <strong>
              <span>間質性膀胱炎問題指標-3：</span>
              <span>3. 用藥期間，<u>無預警解尿</u>對您是否造成很大的困擾？</span>
            </strong>
            <input name="IC_question3" type="hidden" value="99">
            <input name="IC_question3" type="radio" id="ICQ3_1" value="0"><label for="ICQ3_1">0、沒有困擾</label>&nbsp;
            <input name="IC_question3" type="radio" id="ICQ3_2" value="1"><label for="ICQ3_2">1、極小困擾</label>&nbsp;
            <input name="IC_question3" type="radio" id="ICQ3_3" value="2"><label for="ICQ3_3">2、小困擾</label>&nbsp;
            <input name="IC_question3" type="radio" id="ICQ3_4" value="3"><label for="ICQ3_4">3、中等困擾</label>&nbsp;
            <input name="IC_question3" type="radio" id="ICQ3_5" value="4"><label for="ICQ3_5">4、大困擾</label>
            <br>
          </p>
          <p>
            <strong>
              <span>間質性膀胱炎問題指標-4：</span>
              <span>4. 用藥期間，<u>膀胱疼痛</u>、<u>灼熱</u>、<u>不舒服或壓迫</u>對您造成的困擾有多大？</span>
            </strong>
            <input name="IC_question4" type="hidden" value="99">
            <input name="IC_question4" type="radio" id="ICQ4_1" value="0"><label for="ICQ4_1">0、沒有困擾</label>&nbsp;
            <input name="IC_question4" type="radio" id="ICQ4_2" value="1"><label for="ICQ4_2">1、極小困擾</label>&nbsp;
            <input name="IC_question4" type="radio" id="ICQ4_3" value="2"><label for="ICQ4_3">2、小困擾</label>&nbsp;
            <input name="IC_question4" type="radio" id="ICQ4_4" value="3"><label for="ICQ4_4">3、中等困擾</label>&nbsp;
            <input name="IC_question4" type="radio" id="ICQ4_5" value="4"><label for="ICQ4_5">4、大困擾</label>
            <br>
          </p>
        </div>
        <div class="vas_info ipad">
          <h2>膀胱疼痛指數</h2>
          <p>
            <strong>
              <span>疼痛指數：</span>
              <span class="pain-index">
                請依照下圖形容一下您膀胱或下腹疼痛的程度：
                <img src="images/pain_index.jpg" width="100%" />
              </span>
            </strong>
            <input name="VAS" type="hidden" value="99">
            <input name="VAS" type="radio" id="vas1" value="0"><label for="vas1">0</label>&nbsp;
            <input name="VAS" type="radio" id="vas2" value="1"><label for="vas2">1</label>&nbsp;
            <input name="VAS" type="radio" id="vas3" value="2"><label for="vas3">2</label>&nbsp;
            <input name="VAS" type="radio" id="vas4" value="3"><label for="vas4">3</label>&nbsp;
            <input name="VAS" type="radio" id="vas5" value="4"><label for="vas5">4</label>&nbsp;
            <input name="VAS" type="radio" id="vas6" value="5"><label for="vas6">5</label>&nbsp;
            <input name="VAS" type="radio" id="vas7" value="6"><label for="vas7">6</label>&nbsp;
            <input name="VAS" type="radio" id="vas8" value="7"><label for="vas8">7</label>&nbsp;
            <input name="VAS" type="radio" id="vas9" value="8"><label for="vas9">8</label>&nbsp;
            <input name="VAS" type="radio" id="vas10" value="9"><label for="vas10">9</label>&nbsp;
            <input name="VAS" type="radio" id="vas11" value="10"><label for="vas11">10</label>
            <br>
          </p>
        </div>
        <div class="bsrs_info ipad">
          <h2>簡式健康表（BSRS）<span class="ipad-qs">：最近一週感到困擾或苦惱的程度，請依據您自身狀況點選。</span></h2>
          <p>
            <strong>
              <span>BSRS-1：</span>
              <span>1. 睡眠困難，譬如難以入睡，易醒或早醒</span>
            </strong>
            <input name="BSRS1" type="hidden" value="99">
            <input name="BSRS1" type="radio" id="bsrs1_1" value="0"><label for="bsrs1_1">0、完全沒有</label>&nbsp;
            <input name="BSRS1" type="radio" id="bsrs1_2" value="1"><label for="bsrs1_2">1、輕微</label>&nbsp;
            <input name="BSRS1" type="radio" id="bsrs1_3" value="2"><label for="bsrs1_3">2、中等程度</label>&nbsp;
            <input name="BSRS1" type="radio" id="bsrs1_4" value="3"><label for="bsrs1_4">3、厲害</label>&nbsp;
            <input name="BSRS1" type="radio" id="bsrs1_5" value="4"><label for="bsrs1_5">4、非常厲害</label>
            <br>
          </p>
          <p>
            <strong>
              <span>BSRS-2：</span>
              <span>2. 感覺緊張不安</span>
            </strong>
            <input name="BSRS2" type="hidden" value="99">
            <input name="BSRS2" type="radio" id="bsrs2_1" value="0"><label for="bsrs2_1">0、完全沒有</label>&nbsp;
            <input name="BSRS2" type="radio" id="bsrs2_2" value="1"><label for="bsrs2_2">1、輕微</label>&nbsp;
            <input name="BSRS2" type="radio" id="bsrs2_3" value="2"><label for="bsrs2_3">2、中等程度</label>&nbsp;
            <input name="BSRS2" type="radio" id="bsrs2_4" value="3"><label for="bsrs2_4">3、厲害</label>&nbsp;
            <input name="BSRS2" type="radio" id="bsrs2_5" value="4"><label for="bsrs2_5">4、非常厲害</label>
            <br>
          </p>
          <p>
            <strong>
              <span>BSRS-3：</span>
              <span>3. 覺得容易苦惱或動怒</span>
            </strong>
            <input name="BSRS3" type="hidden" value="99">
            <input name="BSRS3" type="radio" id="bsrs3_1" value="0"><label for="bsrs3_1">0、完全沒有</label>&nbsp;
            <input name="BSRS3" type="radio" id="bsrs3_2" value="1"><label for="bsrs3_2">1、輕微</label>&nbsp;
            <input name="BSRS3" type="radio" id="bsrs3_3" value="2"><label for="bsrs3_3">2、中等程度</label>&nbsp;
            <input name="BSRS3" type="radio" id="bsrs3_4" value="3"><label for="bsrs3_4">3、厲害</label>&nbsp;
            <input name="BSRS3" type="radio" id="bsrs3_5" value="4"><label for="bsrs3_5">4、非常厲害</label>
            <br>
          </p>
          <p>
            <strong>
              <span>BSRS-4：</span>
              <span>4. 感覺憂鬱，心情低落</span>
            </strong>
            <input name="BSRS4" type="hidden" value="99">
            <input name="BSRS4" type="radio" id="bsrs4_1" value="0"><label for="bsrs4_1">0、完全沒有</label>&nbsp;
            <input name="BSRS4" type="radio" id="bsrs4_2" value="1"><label for="bsrs4_2">1、輕微</label>&nbsp;
            <input name="BSRS4" type="radio" id="bsrs4_3" value="2"><label for="bsrs4_3">2、中等程度</label>&nbsp;
            <input name="BSRS4" type="radio" id="bsrs4_4" value="3"><label for="bsrs4_4">3、厲害</label>&nbsp;
            <input name="BSRS4" type="radio" id="bsrs4_5" value="4"><label for="bsrs4_5">4、非常厲害</label>
            <br>
          </p>
          <p>
            <strong>
              <span>BSRS-5：</span>
              <span>5. 覺得比不上別人</span>
            </strong>
            <input name="BSRS5" type="hidden" value="99">
            <input name="BSRS5" type="radio" id="bsrs5_1" value="0"><label for="bsrs5_1">0、完全沒有</label>&nbsp;
            <input name="BSRS5" type="radio" id="bsrs5_2" value="1"><label for="bsrs5_2">1、輕微</label>&nbsp;
            <input name="BSRS5" type="radio" id="bsrs5_3" value="2"><label for="bsrs5_3">2、中等程度</label>&nbsp;
            <input name="BSRS5" type="radio" id="bsrs5_4" value="3"><label for="bsrs5_4">3、厲害</label>&nbsp;
            <input name="BSRS5" type="radio" id="bsrs5_5" value="4"><label for="bsrs5_5">4、非常厲害</label>
            <br>
          </p>
        </div>
        <div class="fsfi_info ipad">
          <h2>國際女性性功能指標（FSFI）調查<span class="ipad-qs">：請依據您<span class="double-underline">過去四週</span>的自身狀況圈選。</span></h2>
          <p>
            <strong>
              <span>FSFI-1：</span>
              <span>1. 您有性欲望或對與性相關的事務產生興趣的頻率是多少？</span>
            </strong>
            <input name="FSFI1" type="hidden" value="99">
            <input name="FSFI1" type="radio" id="fsfi1_1" value="1"><label for="fsfi1_1">1、沒有或幾乎沒有</label>&nbsp;
            <input name="FSFI1" type="radio" id="fsfi1_2" value="2"><label for="fsfi1_2">2、偶而</label>&nbsp;
            <input name="FSFI1" type="radio" id="fsfi1_3" value="3"><label for="fsfi1_3">3、有時候</label>&nbsp;
            <input name="FSFI1" type="radio" id="fsfi1_4" value="4"><label for="fsfi1_4">4、經常</label>&nbsp;
            <input name="FSFI1" type="radio" id="fsfi1_5" value="5"><label for="fsfi1_5">5、總是或幾乎總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-2：</span>
              <span>2. 您有性欲望的程度是？</span>
            </strong>
            <input name="FSFI2" type="hidden" value="99">
            <input name="FSFI2" type="radio" id="fsfi2_1" value="1"><label for="fsfi2_1">1、很低或完全沒有</label>&nbsp;
            <input name="FSFI2" type="radio" id="fsfi2_2" value="2"><label for="fsfi2_2">2、低</label>&nbsp;
            <input name="FSFI2" type="radio" id="fsfi2_3" value="3"><label for="fsfi2_3">3、普通</label>&nbsp;
            <input name="FSFI2" type="radio" id="fsfi2_4" value="4"><label for="fsfi2_4">4、高</label>&nbsp;
            <input name="FSFI2" type="radio" id="fsfi2_5" value="5"><label for="fsfi2_5">5、很高</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-3：</span>
              <span>3. 您在性活動中或性交中被激起性渴望的比率是多少？</span>
            </strong>
            <input name="FSFI3" type="hidden" value="99">
            <input name="FSFI3" type="radio" id="fsfi3_1" value="0"><label for="fsfi3_1">0、無性活動</label>&nbsp;
            <input name="FSFI3" type="radio" id="fsfi3_2" value="1"><label for="fsfi3_2">1、沒有或幾乎沒有</label>&nbsp;
            <input name="FSFI3" type="radio" id="fsfi3_3" value="2"><label for="fsfi3_3">2、偶而</label>&nbsp;
            <input name="FSFI3" type="radio" id="fsfi3_4" value="3"><label for="fsfi3_4">3、有時候</label>&nbsp;
            <input name="FSFI3" type="radio" id="fsfi3_5" value="4"><label for="fsfi3_5">4、經常</label>&nbsp;
            <input name="FSFI3" type="radio" id="fsfi3_6" value="5"><label for="fsfi3_6">5、總是或經常總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-4：</span>
              <span>4. 您在性活動中或性交中被激起性渴望的程度是？</span>
            </strong>
            <input name="FSFI4" type="hidden" value="99">
            <input name="FSFI4" type="radio" id="fsfi4_1" value="0"><label for="fsfi4_1">0、無性活動</label>&nbsp;
            <input name="FSFI4" type="radio" id="fsfi4_2" value="1"><label for="fsfi4_2">1、很低或完全沒有</label>&nbsp;
            <input name="FSFI4" type="radio" id="fsfi4_3" value="2"><label for="fsfi4_3">2、低</label>&nbsp;
            <input name="FSFI4" type="radio" id="fsfi4_4" value="3"><label for="fsfi4_4">3、普通</label>&nbsp;
            <input name="FSFI4" type="radio" id="fsfi4_5" value="4"><label for="fsfi4_5">4、高</label>&nbsp;
            <input name="FSFI4" type="radio" id="fsfi4_6" value="5"><label for="fsfi4_6">5、很高</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-5：</span>
              <span>5. 您在性活動中或性交中興奮起來的信心是？</span>
            </strong>
            <input name="FSFI5" type="hidden" value="99">
            <input name="FSFI5" type="radio" id="fsfi5_1" value="0"><label for="fsfi5_1">0、無性活動</label>&nbsp;
            <input name="FSFI5" type="radio" id="fsfi5_2" value="1"><label for="fsfi5_2">1、沒有或幾乎沒有</label>&nbsp;
            <input name="FSFI5" type="radio" id="fsfi5_3" value="2"><label for="fsfi5_3">2、偶而</label>&nbsp;
            <input name="FSFI5" type="radio" id="fsfi5_4" value="3"><label for="fsfi5_4">3、有時候</label>&nbsp;
            <input name="FSFI5" type="radio" id="fsfi5_5" value="4"><label for="fsfi5_5">4、經常</label>&nbsp;
            <input name="FSFI5" type="radio" id="fsfi5_6" value="5"><label for="fsfi5_6">5、總是或幾乎總是</label>
            <br>
          </p>
          <hr>
          <p>
            <strong>
              <span>FSFI-6：</span>
              <span>6. 您在性活動中或性交中性興奮滿意的比率是？</span>
            </strong>
            <input name="FSFI6" type="hidden" value="99">
            <input name="FSFI6" type="radio" id="fsfi6_1" value="0"><label for="fsfi6_1">0、無性活動</label>&nbsp;
            <input name="FSFI6" type="radio" id="fsfi6_2" value="1"><label for="fsfi6_2">1、沒有或幾乎沒有</label>&nbsp;
            <input name="FSFI6" type="radio" id="fsfi6_3" value="2"><label for="fsfi6_3">2、偶而</label>&nbsp;
            <input name="FSFI6" type="radio" id="fsfi6_4" value="3"><label for="fsfi6_4">3、有時候</label>&nbsp;
            <input name="FSFI6" type="radio" id="fsfi6_5" value="4"><label for="fsfi6_5">4、經常</label>&nbsp;
            <input name="FSFI6" type="radio" id="fsfi6_6" value="5"><label for="fsfi6_6">5、總是或幾乎總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-7：</span>
              <span>7. 您在性活動中或性交中陰道濕潤的比率是？</span>
            </strong>
            <input name="FSFI7" type="hidden" value="99">
            <input name="FSFI7" type="radio" id="fsfi7_1" value="0"><label for="fsfi7_1">0、無性活動</label>&nbsp;
            <input name="FSFI7" type="radio" id="fsfi7_2" value="1"><label for="fsfi7_2">1、沒有或幾乎沒有</label>&nbsp;
            <input name="FSFI7" type="radio" id="fsfi7_3" value="2"><label for="fsfi7_3">2、偶而</label>&nbsp;
            <input name="FSFI7" type="radio" id="fsfi7_4" value="3"><label for="fsfi7_4">3、有時候</label>&nbsp;
            <input name="FSFI7" type="radio" id="fsfi7_5" value="4"><label for="fsfi7_5">4、經常</label>&nbsp;
            <input name="FSFI7" type="radio" id="fsfi7_6" value="5"><label for="fsfi7_6">5、總是或幾乎總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-8：</span>
              <span>8. 您在性活動中或性交中陰道濕潤的困難程度？</span>
            </strong>
            <input name="FSFI8" type="hidden" value="99">
            <input name="FSFI8" type="radio" id="fsfi8_1" value="0"><label for="fsfi8_1">0、無性活動</label>&nbsp;
            <input name="FSFI8" type="radio" id="fsfi8_2" value="1"><label for="fsfi8_2">1、沒有困難</label>&nbsp;
            <input name="FSFI8" type="radio" id="fsfi8_3" value="2"><label for="fsfi8_3">2、有一點難</label>&nbsp;
            <input name="FSFI8" type="radio" id="fsfi8_4" value="3"><label for="fsfi8_4">3、有時候</label>&nbsp;
            <input name="FSFI8" type="radio" id="fsfi8_5" value="4"><label for="fsfi8_5">4、非常困難</label>&nbsp;
            <input name="FSFI8" type="radio" id="fsfi8_6" value="5"><label for="fsfi8_6">5、極度困難或完全不可能</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-9：</span>
              <span>9. 您在性活動中或性交中保持濕潤的比率？</span>
            </strong>
            <input name="FSFI9" type="hidden" value="99">
            <input name="FSFI9" type="radio" id="fsfi9_1" value="0"><label for="fsfi9_1">0、無性活動</label>&nbsp;
            <input name="FSFI9" type="radio" id="fsfi9_2" value="1"><label for="fsfi9_2">1、沒有或幾乎沒有</label>&nbsp;
            <input name="FSFI9" type="radio" id="fsfi9_3" value="2"><label for="fsfi9_3">2、偶而</label>&nbsp;
            <input name="FSFI9" type="radio" id="fsfi9_4" value="3"><label for="fsfi9_4">3、有時候</label>&nbsp;
            <input name="FSFI9" type="radio" id="fsfi9_5" value="4"><label for="fsfi9_5">4、經常</label>&nbsp;
            <input name="FSFI9" type="radio" id="fsfi9_6" value="5"><label for="fsfi9_6">5、總是或幾乎總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-10：</span>
              <span>10. 您在性活動中或性交中保持濕潤的困難程度？</span>
            </strong>
            <input name="FSFI10" type="hidden" value="99">
            <input name="FSFI10" type="radio" id="fsfi10_1" value="0"><label for="fsfi10_1">0、無性活動</label> &nbsp;
            <input name="FSFI10" type="radio" id="fsfi10_2" value="1"><label for="fsfi10_2">1、沒有困難</label>&nbsp;
            <input name="FSFI10" type="radio" id="fsfi10_3" value="2"><label for="fsfi10_3">2、有一點難</label>&nbsp;
            <input name="FSFI10" type="radio" id="fsfi10_4" value="3"><label for="fsfi10_4">3、有時候</label>&nbsp;
            <input name="FSFI10" type="radio" id="fsfi10_5" value="4"><label for="fsfi10_5">4、非常困難</label>&nbsp;
            <input name="FSFI10" type="radio" id="fsfi10_6" value="5"><label for="fsfi10_6">5、極度困難或完全不可能</label>
            <br>
          </p>
          <hr>
          <p>
            <strong>
              <span>FSFI-11：</span>
              <span>11. 當您有性刺激或性交時您達到高潮的比率？</span>
            </strong>
            <input name="FSFI11" type="hidden" value="99">
            <input name="FSFI11" type="radio" id="fsfi11_1" value="0"><label for="fsfi11_1">0、無性活動</label>&nbsp;
            <input name="FSFI11" type="radio" id="fsfi11_2" value="1"><label for="fsfi11_2">1、沒有或幾乎沒有</label>&nbsp;
            <input name="FSFI11" type="radio" id="fsfi11_3" value="2"><label for="fsfi11_3">2、偶而</label>&nbsp;
            <input name="FSFI11" type="radio" id="fsfi11_4" value="3"><label for="fsfi11_4">3、有時候</label>&nbsp;
            <input name="FSFI11" type="radio" id="fsfi11_5" value="4"><label for="fsfi11_5">4、經常</label>&nbsp;
            <input name="FSFI11" type="radio" id="fsfi11_6" value="5"><label for="fsfi11_6">5、總是或幾乎總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-12：</span>
              <span>12. 當您有性刺激或性交時您達到高潮的困難程度？</span>
            </strong>
            <input name="FSFI12" type="hidden" value="99">
            <input name="FSFI12" type="radio" id="fsfi12_1" value="0"><label for="fsfi12_1">0、無性活動</label>&nbsp;
            <input name="FSFI12" type="radio" id="fsfi12_2" value="1"><label for="fsfi12_2">1、沒有困難</label>&nbsp;
            <input name="FSFI12" type="radio" id="fsfi12_3" value="2"><label for="fsfi12_3">2、有一點難</label>&nbsp;
            <input name="FSFI12" type="radio" id="fsfi12_4" value="3"><label for="fsfi12_4">3、有時候</label>&nbsp;
            <input name="FSFI12" type="radio" id="fsfi12_5" value="4"><label for="fsfi12_5">4、非常困難</label>&nbsp;
            <input name="FSFI12" type="radio" id="fsfi12_6" value="5"><label for="fsfi12_6">5、極度困難或完全不可能</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-13：</span>
              <span>13. 您在性活動中或性交中對於能夠達到高潮的滿意程度是？</span>
            </strong>
            <input name="FSFI13" type="hidden" value="99">
            <input name="FSFI13" type="radio" id="fsfi13_1" value="0"><label for="fsfi13_1">0、無性活動</label>&nbsp;
            <input name="FSFI13" type="radio" id="fsfi13_2" value="1"><label for="fsfi13_2">1、非常不滿意</label>&nbsp;
            <input name="FSFI13" type="radio" id="fsfi13_3" value="2"><label for="fsfi13_3">2、不滿意</label>&nbsp;
            <input name="FSFI13" type="radio" id="fsfi13_4" value="3"><label for="fsfi13_4">3、普通</label>&nbsp;
            <input name="FSFI13" type="radio" id="fsfi13_5" value="4"><label for="fsfi13_5">4、滿意</label>&nbsp;
            <input name="FSFI13" type="radio" id="fsfi13_6" value="5"><label for="fsfi13_6">5、非常滿意</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-14：</span>
              <span>14. 您在性活動中與伴侶的親密度，您的滿意程度是？</span>
            </strong>
            <input name="FSFI14" type="hidden" value="99">
            <input name="FSFI14" type="radio" id="fsfi14_1" value="0"><label for="fsfi14_1">0、無性活動</label>&nbsp;
            <input name="FSFI14" type="radio" id="fsfi14_2" value="1"><label for="fsfi14_2">1、非常不滿意</label>&nbsp;
            <input name="FSFI14" type="radio" id="fsfi14_3" value="2"><label for="fsfi14_3">2、不滿意</label>&nbsp;
            <input name="FSFI14" type="radio" id="fsfi14_4" value="3"><label for="fsfi14_4">3、普通</label>&nbsp;
            <input name="FSFI14" type="radio" id="fsfi14_5" value="4"><label for="fsfi14_5">4、滿意</label>&nbsp;
            <input name="FSFI14" type="radio" id="fsfi14_6" value="5"><label for="fsfi14_6">5、非常滿意</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-15：</span>
              <span>15. 您對於與伴侶的性關係滿意嗎？</span>
            </strong>
            <input name="FSFI15" type="hidden" value="99">
            <input name="FSFI15" type="radio" id="fsfi15_1" value="0"><label for="fsfi15_1">0、無性活動</label>&nbsp;
            <input name="FSFI15" type="radio" id="fsfi15_2" value="1"><label for="fsfi15_2">1、非常不滿意</label>&nbsp;
            <input name="FSFI15" type="radio" id="fsfi15_3" value="2"><label for="fsfi15_3">2、不滿意</label>&nbsp;
            <input name="FSFI15" type="radio" id="fsfi15_4" value="3"><label for="fsfi15_4">3、普通</label>&nbsp;
            <input name="FSFI15" type="radio" id="fsfi15_5" value="4"><label for="fsfi15_5">4、滿意</label>&nbsp;
            <input name="FSFI15" type="radio" id="fsfi15_6" value="5"><label for="fsfi15_6">5、非常滿意</label>
            <br>
          </p>
          <hr>
          <p>
            <strong>
              <span>FSFI-16：</span>
              <span>16. 您對您整體性生活滿意嗎？</span>
            </strong>
            <input name="FSFI16" type="hidden" value="99">
            <input name="FSFI16" type="radio" id="fsfi16_1" value="0"><label for="fsfi16_1">0、無性活動</label>&nbsp;
            <input name="FSFI16" type="radio" id="fsfi16_2" value="1"><label for="fsfi16_2">1、非常不滿意</label>&nbsp;
            <input name="FSFI16" type="radio" id="fsfi16_3" value="2"><label for="fsfi16_3">2、不滿意</label>&nbsp;
            <input name="FSFI16" type="radio" id="fsfi16_4" value="3"><label for="fsfi16_4">3、普通</label>&nbsp;
            <input name="FSFI16" type="radio" id="fsfi16_5" value="4"><label for="fsfi16_5">4、滿意</label>&nbsp;
            <input name="FSFI16" type="radio" id="fsfi16_6" value="5"><label for="fsfi16_6">5、非常滿意</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-17：</span>
              <span>17. 您對於陰道插入時感到不舒服或疼痛的比率是？</span>
            </strong>
            <input name="FSFI17" type="hidden" value="99">
            <input name="FSFI17" type="radio" id="fsfi17_1" value="0"><label for="fsfi17_1">0、無性活動</label>&nbsp;
            <input name="FSFI17" type="radio" id="fsfi17_2" value="1"><label for="fsfi17_2">1、沒有或幾乎沒有</label>&nbsp;
            <input name="FSFI17" type="radio" id="fsfi17_3" value="2"><label for="fsfi17_3">2、偶而</label>&nbsp;
            <input name="FSFI17" type="radio" id="fsfi17_4" value="3"><label for="fsfi17_4">3、有時候</label>&nbsp;
            <input name="FSFI17" type="radio" id="fsfi17_5" value="4"><label for="fsfi17_5">4、經常</label>&nbsp;
            <input name="FSFI17" type="radio" id="fsfi17_6" value="5"><label for="fsfi17_6">5、總是或幾乎總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-18：</span>
              <span>18. 您對於陰道插入後感到不舒服或疼痛的比率是？</span>
            </strong>
            <input name="FSFI18" type="hidden" value="99">
            <input name="FSFI18" type="radio" id="fsfi18_1" value="0"><label for="fsfi18_1">0、無性活動</label>&nbsp;
            <input name="FSFI18" type="radio" id="fsfi18_2" value="1"><label for="fsfi18_2">1、沒有或幾乎沒有</label>&nbsp;
            <input name="FSFI18" type="radio" id="fsfi18_3" value="2"><label for="fsfi18_3">2、偶而</label>&nbsp;
            <input name="FSFI18" type="radio" id="fsfi18_4" value="3"><label for="fsfi18_4">3、有時候</label>&nbsp;
            <input name="FSFI18" type="radio" id="fsfi18_5" value="4"><label for="fsfi18_5">4、經常</label>&nbsp;
            <input name="FSFI18" type="radio" id="fsfi18_6" value="5"><label for="fsfi18_6">5、總是或幾乎總是</label>
            <br>
          </p>
          <p>
            <strong>
              <span>FSFI-19：</span>
              <span>19. 您對於陰道插入時或插入後感到不舒服或疼痛的程度？</span>
            </strong>
            <input name="FSFI19" type="hidden" value="99">
            <input name="FSFI19" type="radio" id="fsfi19_1" value="0"><label for="fsfi19_1">0、無性活動</label>&nbsp;
            <input name="FSFI19" type="radio" id="fsfi19_2" value="1"><label for="fsfi19_2">1、很低或完全沒有</label>&nbsp;
            <input name="FSFI19" type="radio" id="fsfi19_3" value="2"><label for="fsfi19_3">2、低</label>&nbsp;
            <input name="FSFI19" type="radio" id="fsfi19_4" value="3"><label for="fsfi19_4">3、普通</label>&nbsp;
            <input name="FSFI19" type="radio" id="fsfi19_5" value="4"><label for="fsfi19_5">4、高</label>&nbsp;
            <input name="FSFI19" type="radio" id="fsfi19_6" value="5"><label for="fsfi19_6">5、很高</label>
            <br>
          </p>
        </div>
        <div class="iief_info ipad" style="display:none;">
          <h2>國際男性性功能指標（IIEF）調查<span class="ipad-qs">：請依據您自身狀況點選。</span></h2>
          <p>
            <strong>
              <span>IIEF-1：</span>
              <span>1. 您對於自己能勃起且能維持勃起狀態有多大信心？</span>
            </strong>
            <input name="IIEF1" type="hidden" value="99">
            <input name="IIEF1" type="radio" id="iief1_1" value="1"><label for="iief1_1">1、非常低</label>&nbsp;
            <input name="IIEF1" type="radio" id="iief1_2" value="2"><label for="iief1_2">2、低</label>&nbsp;
            <input name="IIEF1" type="radio" id="iief1_3" value="3"><label for="iief1_3">3、中度</label>&nbsp;
            <input name="IIEF1" type="radio" id="iief1_4" value="4"><label for="iief1_4">4、有信心</label>&nbsp;
            <input name="IIEF1" type="radio" id="iief1_5" value="5"><label for="iief1_5">5、信心滿滿</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IIEF-2：</span>
              <span>2. 您嘗試性交時，陰莖勃起的堅硬度可您順利進入女性陰道嗎？</span>
            </strong>
            <input name="IIEF2" type="hidden" value="99">
            <input name="IIEF2" type="radio" id="iief2_1" value="1"><label for="iief2_1">1、完全或幾乎不可以</label>&nbsp;
            <input name="IIEF2" type="radio" id="iief2_2" value="2"><label for="iief2_2">2、少數幾次可以</label>&nbsp;
            <input name="IIEF2" type="radio" id="iief2_3" value="3"><label for="iief2_3">3、一半左右可以</label>&nbsp;
            <input name="IIEF2" type="radio" id="iief2_4" value="4"><label for="iief2_4">4、多數可以</label>&nbsp;
            <input name="IIEF2" type="radio" id="iief2_5" value="5"><label for="iief2_5">5、幾乎每次都可以</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IIEF-3：</span>
              <span>3. 性交中，陰莖置入伴侶陰道中未射精前您可以維持陰莖的堅硬度嗎？</span>
            </strong>
            <input name="IIEF3" type="hidden" value="99">
            <input name="IIEF3" type="radio" id="iief3_1" value="1"><label for="iief3_1">1、完全或幾乎不可以</label>&nbsp;
            <input name="IIEF3" type="radio" id="iief3_2" value="2"><label for="iief3_2">2、少數幾次可以</label>&nbsp;
            <input name="IIEF3" type="radio" id="iief3_3" value="3"><label for="iief3_3">3、一半左右可以</label>&nbsp;
            <input name="IIEF3" type="radio" id="iief3_4" value="4"><label for="iief3_4">4、多數可以</label>&nbsp;
            <input name="IIEF3" type="radio" id="iief3_5" value="5"><label for="iief3_5">5、幾乎每次都可以</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IIEF-4：</span>
              <span>4. 在性交完成前，您覺得維持陰莖勃起很困難嗎？</span>
            </strong>
            <input name="IIEF4" type="hidden" value="99">
            <input name="IIEF4" type="radio" id="iief4_1" value="1"><label for="iief4_1">1、極度困難</label>&nbsp;
            <input name="IIEF4" type="radio" id="iief4_2" value="2"><label for="iief4_2">2、非常困難</label>&nbsp;
            <input name="IIEF4" type="radio" id="iief4_3" value="3"><label for="iief4_3">3、困難</label>&nbsp;
            <input name="IIEF4" type="radio" id="iief4_4" value="4"><label for="iief4_4">4、有點困難</label>&nbsp;
            <input name="IIEF4" type="radio" id="iief4_5" value="5"><label for="iief4_5">5、完全不困難</label>
            <br>
          </p>
          <p>
            <strong>
              <span>IIEF-5：</span>
              <span>5. 當您嘗試性交時，您對整體表現覺得滿意嗎？</span>
            </strong>
            <input name="IIEF5" type="hidden" value="99">
            <input name="IIEF5" type="radio" id="iief5_1" value="1"><label for="iief5_1">1、極度不滿意</label>&nbsp;
            <input name="IIEF5" type="radio" id="iief5_2" value="2"><label for="iief5_2">2、只有少數幾次滿意</label>&nbsp;
            <input name="IIEF5" type="radio" id="iief5_3" value="3"><label for="iief5_3">3、一半左右滿意</label>&nbsp;
            <input name="IIEF5" type="radio" id="iief5_4" value="4"><label for="iief5_4">4、大多數滿意</label>&nbsp;
            <input name="IIEF5" type="radio" id="iief5_5" value="5"><label for="iief5_5">5、幾乎每次都很滿意</label>
            <br>
          </p>
        </div>
      	<div class="doctor_registration">
      		<h2>醫師登記表</h2>
          <p>
            <input name="firstmedical" type="hidden" value="0">
            <input name="firstmedical" type="checkbox" id="fm1" value="1"><label for="fm1">第一次收案</label>
          </p>
          <span id="treatment" style="display:none;">
            <h2>Treatment</h2>
            <p>
              <strong>治療日期</strong>
              <input name="tx_date" type="text" id="datepicker2">
            </p>
            <h3>止痛</h3>
            <p>
              <input name="tx_nsaid" type="hidden" value="0">
              <input name="tx_nsaid" type="checkbox" id="tx1" value="1"><label for="tx1">NSAID 例如 Diclofenca</label><br>
              <input name="tx_cox2" type="hidden" value="0">
              <input name="tx_cox2" type="checkbox" id="tx2" value="1"><label for="tx2">Cox-2 I  例如 Celebrex</label><br>
              <input name="tx_opioid" type="hidden" value="0">
              <input name="tx_opioid" type="checkbox" id="tx3" value="1"><label for="tx3">Opioid 例如 Tramadol</label><br>
              <input name="tx_morphin" type="hidden" value="0">
              <input name="tx_morphin" type="checkbox" id="tx4" value="1"><label for="tx4">Morphin</label>
            </p>
            <h3>膀胱</h3>
            <p>
              <input name="tx_antim" type="hidden" value="0">
              <input name="tx_antim" type="checkbox" id="tx5" value="1"><label for="tx5">Anti-M 例如 oxbu, vesicare, detrusitol, urotrol, etc.</label><br>
              <input name="tx_double_antim" type="hidden" value="0">
              <input name="tx_double_antim" type="checkbox" id="tx6" value="1"><label for="tx6">Double Anti-M</label><br>
              <input name="tx_mucosa_op" type="hidden" value="0">
              <input name="tx_mucosa_op" type="checkbox" id="tx7" value="1"><label for="tx7">Mucosa: oral pentosan</label><br>
              <input name="tx_mucosa_ic" type="hidden" value="0">
              <input name="tx_mucosa_ic" type="checkbox" id="tx8" value="1"><label for="tx8">Mucosa: intravesical cystistat</label><br>
              <input name="tx_hydrodistention" type="hidden" value="0">
              <input name="tx_hydrodistention" type="checkbox" id="tx9" value="1"><label for="tx9">Hydrodistention</label><br>
              <input name="tx_botox_id100u" type="hidden" value="0">
              <input name="tx_botox_id100u" type="checkbox" id="tx10" value="1"><label for="tx10">Botox intradetrusor: 100U</label><br>
              <input name="tx_botox_it100u" type="hidden" value="0">
              <input name="tx_botox_it100u" type="checkbox" id="tx11" value="1"><label for="tx11">Botox intratrigone: 100U</label><br>
              <input name="tx_botox_idit100u" type="hidden" value="0">
              <input name="tx_botox_idit100u" type="checkbox" id="tx12" value="1"><label for="tx12">Botox intradetrusor + intratrigone 100U</label><br>
              <input name="tx_ewithout" type="hidden" value="0">
              <input name="tx_ewithout" type="checkbox" id="tx13" value="1"><label for="tx13">Enterocystoplasty without resection of bladder</label><br>
              <input name="tx_epartial" type="hidden" value="0">
              <input name="tx_epartial" type="checkbox" id="tx14" value="1"><label for="tx14">Enterocystoplasty with partial  resection of bladder</label><br>
              <input name="tx_ewhole" type="hidden" value="0">
              <input name="tx_ewhole" type="checkbox" id="tx15" value="1"><label for="tx15">Enterocystoplasty with resection of whole bladder</label><br>
            </p>
            <h3>輸尿管</h3>
            <p>
              <input name="tx_dj_one" type="hidden" value="0">
              <input name="tx_dj_one" type="checkbox" id="tx16" value="1"><label for="tx16">DJ one side</label><br>
              <input name="tx_dj_both" type="hidden" value="0">
              <input name="tx_dj_both" type="checkbox" id="tx17" value="1"><label for="tx17">DJ both sides</label><br>
              <input name="tx_pcnd_one" type="hidden" value="0">
              <input name="tx_pcnd_one" type="checkbox" id="tx18" value="1"><label for="tx18">PCND one side</label><br>
              <input name="tx_pcnd_both" type="hidden" value="0">
              <input name="tx_pcnd_both" type="checkbox" id="tx19" value="1"><label for="tx19">PCND both sides</label><br>
            </p>
            <p>
              <strong>其他治療方式</strong>：
              <input name="tx_other" type="text">
            </p>
            <hr>
          </span>

          <p>
            <strong>醫師評估日期</strong>：
            <input name="register_date" type="text" id="datepicker1">
          </p>
          <p>
            <strong>BP</strong>：
            <input name="systolic_pressure" type="text" placeholder="收縮壓">mmHg. /
            <input name="diastolic_pressure" type="text" placeholder="舒張壓">mmHg.
          </p>
          <p>
            <strong>Hematuria</strong>：
            <input name="gross_hematuria" type="hidden" value="99">
            <input name="gross_hematuria" type="radio" id="hematuria1" value="0"><label for="hematuria1">無</label>&nbsp;
            <input name="gross_hematuria" type="radio" id="hematuria2" value="1"><label for="hematuria2">有</label>
            <br>
          </p>
          <p>
            <strong>Other Symptoms</strong>：
            <input name="other_symptoms" type="text" size="35" placeholder="例如：頭暈、腹痛、流鼻血等">
            <br>
          </p>
          <p>
            <strong>Voiding Diary</strong>：<br>
            <p>
              1<sup>st</sup> Day: Day time <input name="Diary_1D" type="text">次;&nbsp;
              Night <input name="Diary_1N" type="text">次
              <br>
            </p>
            <p>
              2<sup>nd</sup> Day: Day time <input name="Diary_2D" type="text">次;&nbsp;
              Night <input name="Diary_2N" type="text">次
              <br>
            </p>
            <p>
              3<sup>rd</sup> Day: Day time <input name="Diary_3D" type="text">次;&nbsp;
              Night <input name="Diary_3N" type="text">次
              <br>
            </p>
            <p>
              Maximal voided volme <input name="Diary_Max_VV" type="text">ml
            </p> 
          </p>
      	</div>
        <div class="urine_tests">
          <h2>Urine Tests</h2>
          <p><strong>Urinalysis</strong>：
            <input name="urinalysis_na" type=checkbox id="na1"><label for="na1">NA</label><br>
            WBC：
            <input name="Urine_routine_WBC_HPF" type="radio" id="wbc1" value="0-5"><label for="wbc1">0-5</label>&nbsp;
            <input name="Urine_routine_WBC_HPF" type="radio" id="wbc2" value="5-10"><label for="wbc2">5-10</label>&nbsp;
            <input name="Urine_routine_WBC_HPF" type="radio" id="wbc3" value="10up"><label for="wbc3">10以上</label>&nbsp;
            /HPF,<br>
            RBC：
            <input name="Urine_routine_RBC_HPF" type="radio" id="rbc1" value="0-5"><label for="rbc1">0-5</label>&nbsp;
            <input name="Urine_routine_RBC_HPF" type="radio" id="rbc2" value="5-10"><label for="rbc2">5-10</label>&nbsp;
            <input name="Urine_routine_RBC_HPF" type="radio" id="rbc3" value="10up"><label for="rbc3">10以上</label>&nbsp;
            /HPF,<br>
            Nit：
            <input name="Urine_routine_Nit" type="radio" id="nit1" value="neg"><label for="nit1">neg</label>&nbsp;
            <input name="Urine_routine_Nit" type="radio" id="nit2" value="1+"><label for="nit2">1+</label>&nbsp;
            <input name="Urine_routine_Nit" type="radio" id="nit3" value="2+"><label for="nit3">2+</label>&nbsp;
            <input name="Urine_routine_Nit" type="radio" id="nit4" value="3+"><label for="nit4">3+</label>&nbsp;
            <input name="Urine_routine_Nit" type="radio" id="nit5" value="4+"><label for="nit5">4+</label>,
            <br>
            LEU：
            <input name="Urine_routine_LEU" type="radio" id="leu1" value="neg"><label for="leu1">neg</label>&nbsp;
            <input name="Urine_routine_LEU" type="radio" id="leu2" value="1+"><label for="leu2">1+</label>&nbsp;
            <input name="Urine_routine_LEU" type="radio" id="leu3" value="2+"><label for="leu3">2+</label>&nbsp;
            <input name="Urine_routine_LEU" type="radio" id="leu4" value="3+"><label for="leu4">3+</label>&nbsp;
            <input name="Urine_routine_LEU" type="radio" id="leu5" value="4+"><label for="leu5">4+</label>,
            <br>
            Bact：
            <input name="Urine_routine_Bact" type="radio" id="bact1" value="neg"><label for="bact1">neg</label>&nbsp;
            <input name="Urine_routine_Bact" type="radio" id="bact2" value="1+"><label for="bact2">1+</label>&nbsp;
            <input name="Urine_routine_Bact" type="radio" id="bact3" value="2+"><label for="bact3">2+</label>&nbsp;
            <input name="Urine_routine_Bact" type="radio" id="bact4" value="3+"><label for="bact4">3+</label>&nbsp;
            <input name="Urine_routine_Bact" type="radio" id="bact5" value="4+"><label for="bact5">4+</label>
            <br>
          </p>
          <p>
            <strong>Urine Culture</strong>：
            <input name="Urine_culture" type=checkbox id="na2" value="NA"><label for="na2">NA</label><br>
            <input name="Urine_culture" type=hidden value="NA">
            <input name="Urine_culture" type="radio" id="UCulture1" value="no growth"><label for="UCulture1">no growth</label>&nbsp;
            <input name="Urine_culture" type="radio" id="UCulture2" value="E coli"><label for="UCulture2">E coli</label>&nbsp;
            <input name="Urine_culture" type="radio" id="UCulture3" value="K.pneumonia"><label for="UCulture3">K.pneumonia</label>&nbsp;
            <input name="Urine_culture" type="radio" id="UCulture4" value="P.mirabis"><label for="UCulture4">P.mirabis</label>&nbsp;
            <input name="Urine_culture" type="radio" id="UCulture5" value="other"><label for="UCulture5">Other</label>&nbsp;
            <span id="UCulture0" style="display:none">
              <input name="Urine_culture1" type="text" placeholder="請說明">
            </span>
          </p>
          <p>
            <strong>Urine Cytology</strong>：
            <input name="cytology" type=checkbox id="na3" value="NA"><label for="na3">NA</label><br>
            <input name="cytology" type=hidden value="NA">
            <input name="cytology" type="radio" id="UCytology1" value="negative"><label for="UCytology1">negative</label>&nbsp;
            <input name="cytology" type="radio" id="UCytology2" value="dysplasia"><label for="UCytology2">dysplasia</label>&nbsp;
            <input name="cytology" type="radio" id="UCytology3" value="atypia"><label for="UCytology3">atypia</label>&nbsp;
            <input name="cytology" type="radio" id="UCytology4" value="Urothelial carcinoma"><label for="UCytology4">Urothelial carcinoma</label>&nbsp;
            <input name="cytology" type="radio" id="UCytology5" value="Eosinophilia"><label for="UCytology5">Eosinophilia</label>
          </p>
        </div>
        <div class="blood_tests">
          <h2>Blood Tests</h2>
          <p>
            <strong>Sexually transmitted disease</strong>：<br>
            <strong>HIV</strong>：
            <input name="STD_HIV" type="hidden" value="NA">
            <input name="STD_HIV" type="radio" id="HIV1" value="0"><label for="HIV1">Negative</label>&nbsp;
            <input name="STD_HIV" type="radio" id="HIV2" value="1"><label for="HIV2">Positive</label>&nbsp;
            <input name="STD_HIV_na" type="checkbox" id="HIV_na" value="NA"><label for="HIV_na">NA</label><br>
            <strong>VDRL/STS</strong>：
            <input name="STD_VDRL" type="hidden" value="NA">
            <input name="STD_VDRL" type="radio" id="VDRL1" value="0"><label for="VDRL1">Negative</label>&nbsp;
            <input name="STD_VDRL" type="radio" id="VDRL2" value="1"><label for="VDRL2">Positive</label>&nbsp;
            <input name="STD_VDRL_na" type="checkbox" id="VDRL_na" value="NA"><label for="VDRL_na">NA</label><br>
            <strong>TPHA</strong>：
            <input name="STD_TPHA" type="hidden" value="NA">
            <input name="STD_TPHA" type="radio" id="TPHA1" value="0"><label for="TPHA1">Negative</label>&nbsp;
            <input name="STD_TPHA" type="radio" id="TPHA2" value="1"><label for="TPHA2">Positive</label>&nbsp;
            <input name="STD_TPHA_na" type="checkbox" id="TPHA_na" value="NA"><label for="TPHA_na">NA</label><br>
          </p>
          <p>
            <strong>Renal function</strong>：
            <input name="RF_na" type=checkbox id="na5"><label for="na5">NA</label><br> 
            BUN:<input name="Renal_function_BUN" type="text">mg/dL,&nbsp;
            Cr:<input name="Renal_function_Cr" type="text">mg/dL
          </p>
          <p>
            <strong>Liver function</strong>：
            <input name="LF_na" type=checkbox id="na6"><label for="na6">NA</label><br>
            GOT(AST):<input name="Liver_function_GOT" type="text">IU/L,&nbsp;
            GPT(ALT):<input name="Liver_function_GPT" type="text">IU/L,&nbsp;
            Albumin:<input name="Liver_function_ALB" type="text">,&nbsp;
            BIL:<input name="Liver_function_BIL" type="text">
          </p>
          <p>
            <strong>Hematology</strong>：
            <input name="hematology_na" type=checkbox id="na7"><label for="na7">NA</label><br>
            WBC:<input name="Hematology_WBC" type="text" placeholder="ex:6.3">10<sup>3</sup>/uL,&nbsp;
            Hgb:<input name="Hematology_Hgb" type="text" placeholder="ex:12.1">g/dL,&nbsp;
            Platelet:<input name="Hematology_Pl" type="text" placeholder="ex:250">10<sup>3</sup>/uL,&nbsp;
            eosinophil:<input name="Hematology_eosinophil" type="text">%
          </p>
          <p>
            <strong>Immunology</strong>：
            <input name="immunology_na" type=checkbox id="na8"><label for="na8">NA</label><br>
            IgE:<input name="Immune_IgE" type="text">IU/mL
          </p>
        </div>
        <div class="renal_sonography">
          <h2 style="display: inline;">Renal Sonography：</h2>
          <input name="RS_na" type=checkbox id="na9"><label for="na9">NA</label>
          <h3>Right</h3>
          <p>
            <strong>Grade of cortical Echogenicity (compared with liver)</strong>：
            <input name="renal_echo_right_echogenicity" type="hidden" value="NA">
            <input name="renal_echo_right_echogenicity" type="radio" id="rere1" value="正常"><label for="rere1">正常</label>&nbsp;
            <input name="renal_echo_right_echogenicity" type="radio" id="rere2" value="與肝臟差不多"><label for="rere2">與肝臟差不多</label>&nbsp;
            <input name="renal_echo_right_echogenicity" type="radio" id="rere3" value="比肝臟白"><label for="rere3">比肝臟白</label>
          </p>
          <p>
            <strong>Grade of hydronephrosis</strong>：
            <input name="renal_echo_right_kidney" type="hidden" value="NA">
            <input name="renal_echo_right_kidney" type="radio" id="rerk1" value="no hydro"><label for="rerk1">no hydro</label>&nbsp;
            <input name="renal_echo_right_kidney" type="radio" id="rerk2" value="APD>5mm"><label for="rerk2">APD > 5mm</label>&nbsp;
            <input name="renal_echo_right_kidney" type="radio" id="rerk3" value="calyx seen"><label for="rerk3">calyx seen</label>&nbsp;
            <input name="renal_echo_right_kidney" type="radio" id="rerk4" value="calyx blunting"><label for="rerk4">calyx bluting</label>&nbsp;
            <input name="renal_echo_right_kidney" type="radio" id="rerk5" value="cortical thinning"><label for="rerk5">cortical thinning</label>
          </p>
          <h3>Left</h3>
          <p>
            <strong>Grade of cortical Echogenicity (compared with liver)</strong>：
            <input name="renal_echo_left_echogenicity" type="hidden" value="NA">
            <input name="renal_echo_left_echogenicity" type="radio" id="rele1" value="正常"><label for="rele1">正常</label>&nbsp;
            <input name="renal_echo_left_echogenicity" type="radio" id="rele2" value="與肝臟差不多"><label for="rele2">與肝臟差不多</label>&nbsp;
            <input name="renal_echo_left_echogenicity" type="radio" id="rele3" value="比肝臟白"><label for="rele3">比肝臟白</label>
          </p>
          <p>
            <strong>Grade of hydronephrosis</strong>：
            <input name="renal_echo_left_kidney" type="hidden" value="NA">
            <input name="renal_echo_left_kidney" type="radio" id="relk1" value="no hydro"><label for="relk1">no hydro</label>&nbsp;
            <input name="renal_echo_left_kidney" type="radio" id="relk2" value="APD>5mm"><label for="relk2">APD > 5mm</label>&nbsp;
            <input name="renal_echo_left_kidney" type="radio" id="relk3" value="calyx seen"><label for="relk3">calyx seen</label>&nbsp;
            <input name="renal_echo_left_kidney" type="radio" id="relk4" value="calyx blunting"><label for="relk4">calyx bluting</label>&nbsp;
            <input name="renal_echo_left_kidney" type="radio" id="relk5" value="cortical thinning"><label for="relk5">cortical thinning</label>
          </p>
        </div>
        <div class="ivp">
          <h2 style="display: inline;">IVP：</h2>
          <input name="IVP_na" type=checkbox id="na10" value="NA"><label for="na10">NA</label>
          <h3>Right</h3>
          <p>
            <input name="ivp_right" type="hidden" value="0">
            <input name="ivp_right" type="checkbox" id="R_ivp1" value="normal"><label for="R_ivp1">normal</label><br>
            <input name="IVP_right_cortical_thinning" type="hidden" value="0">
            <input name="IVP_right_cortical_thinning" type="checkbox" id="R_ivp2" value="1"><label for="R_ivp2">Cortex thinning</label>&nbsp;
            <input name="IVP_right_hydro_RK" type="hidden" value="0">
            <input name="IVP_right_hydro_RK" type="checkbox" id="R_ivp3" value="1"><label for="R_ivp3">hydronephrosis</label>&nbsp;
            <input name="IVP_right_UrStricture_up" type="hidden" value="0">
            <input name="IVP_right_UrStricture_up" type="checkbox" id="R_ivp4" value="1"><label for="R_ivp4">ureteral stricture-Upper</label>&nbsp;
            <input name="IVP_right_UrStricture_middle" type="hidden" value="0">
            <input name="IVP_right_UrStricture_middle" type="checkbox" id="R_ivp5" value="1"><label for="R_ivp5">ureteral stricture-Middle</label>&nbsp;
            <input name="IVP_right_UrStricture_down" type="hidden" value="0">
            <input name="IVP_right_UrStricture_down" type="checkbox" id="R_ivp6" value="1"><label for="R_ivp6">ureteral stricture-Lower</label>
          </p>
          <h3>Left</h3>
          <p>
            <input name="ivp_left" type="hidden" value="0">
            <input name="ivp_left" type="checkbox" id="L_ivp1" value="normal"><label for="L_ivp1">normal</label><br>
            <input name="IVP_left_cortical_thinning" type="hidden" value="0">
            <input name="IVP_left_cortical_thinning" type="checkbox" id="L_ivp2" value="1"><label for="L_ivp2">Cortex thinning</label>&nbsp;
            <input name="IVP_left_hydro_LK" type="hidden" value="0">
            <input name="IVP_left_hydro_LK" type="checkbox" id="L_ivp3" value="1"><label for="L_ivp3">hydronephrosis</label>&nbsp;
            <input name="IVP_left_UrStricture_up" type="hidden" value="0">
            <input name="IVP_left_UrStricture_up" type="checkbox" id="L_ivp4" value="1"><label for="L_ivp4">ureteral stricture-Upper</label>&nbsp;
            <input name="IVP_left_UrStricture_middle" type="hidden" value="0">
            <input name="IVP_left_UrStricture_middle" type="checkbox" id="L_ivp5" value="1"><label for="L_ivp5">ureteral stricture-Middle</label>&nbsp;
            <input name="IVP_left_UrStricture_down" type="hidden" value="0">
            <input name="IVP_left_UrStricture_down" type="checkbox" id="L_ivp6" value="1"><label for="L_ivp6">ureteral stricture-Lower</label>
          </p>
        </div>
        <div class="ct">
          <h2 style="display: inline;">CT：</h2>
          <input name="CT_na" type=checkbox id="na11" value="NA"><label for="na11">NA</label>
          <h3>Right</h3>
          <p>
            <input name="ct_right" type="hidden" value="0">
            <input name="ct_right" type="checkbox" id="R_ct1" value="normal"><label for="R_ct1">normal</label><br>
            <input name="CT_right_cortical_thinning" type="hidden" value="0">
            <input name="CT_right_cortical_thinning" type="checkbox" id="R_ct2" value="1"><label for="R_ct2">Cortex thinning</label>&nbsp;
            <input name="CT_right_hydro_RK" type="hidden" value="0">
            <input name="CT_right_hydro_RK" type="checkbox" id="R_ct3" value="1"><label for="R_ct3">hydronephrosis</label>&nbsp;
            <input name="CT_right_UrStricture_up" type="hidden" value="0">
            <input name="CT_right_UrStricture_up" type="checkbox" id="R_ct4" value="1"><label for="R_ct4">ureteral stricture-Upper</label>&nbsp;
            <input name="CT_right_UrStricture_middle" type="hidden" value="0">
            <input name="CT_right_UrStricture_middle" type="checkbox" id="R_ct5" value="1"><label for="R_ct5">ureteral stricture-Middle</label>&nbsp;
            <input name="CT_right_UrStricture_down" type="hidden" value="0">
            <input name="CT_right_UrStricture_down" type="checkbox" id="R_ct6" value="1"><label for="R_ct6">ureteral stricture-Lower</label>
          </p>
          <h3>Left</h3>
          <p>
            <input name="ct_left" type="hidden" value="0">
            <input name="ct_left" type="checkbox" id="L_ct1" value="normal"><label for="L_ct1">normal</label><br>
            <input name="CT_left_cortical_thinning" type="hidden" value="0">
            <input name="CT_left_cortical_thinning" type="checkbox" id="L_ct2" value="1"><label for="L_ct2">Cortex thinning</label>&nbsp;
            <input name="CT_left_hydro_LK" type="hidden" value="0">
            <input name="CT_left_hydro_LK" type="checkbox" id="L_ct3" value="1"><label for="L_ct3">hydronephrosis</label>&nbsp;
            <input name="CT_left_UrStricture_up" type="hidden" value="0">
            <input name="CT_left_UrStricture_up" type="checkbox" id="L_ct4" value="1"><label for="L_ct4">ureteral stricture-Upper</label>&nbsp;
            <input name="CT_left_UrStricture_middle" type="hidden" value="0">
            <input name="CT_left_UrStricture_middle" type="checkbox" id="L_ct5" value="1"><label for="L_ct5">ureteral stricture-Middle</label>&nbsp;
            <input name="CT_left_UrStricture_down" type="hidden" value="0">
            <input name="CT_left_UrStricture_down" type="checkbox" id="L_ct6" value="1"><label for="L_ct6">ureteral stricture-Lower</label>
          </p>
        </div>
        <div class="ultrasound_bladder">
          <h2 style="display: inline;">Ultrasound of Bladder：</h2>
          <input name="UB_na" type=checkbox id="na12"><label for="na12">NA</label>
          <p>
            <strong>PVR</strong>：
            <input name="PVR" type="text">ml
          </p>
          <p>
            <strong>Wall thickness</strong>：
            <input name="bladder_echo_BW_thickness" type="text">mm
          </p>
        </div>
        <div class="uroflowmetry">
          <h2 style="display: inline;">Uroflowmetry：</h2>
          <input name="uroflowmetry_na" type=checkbox id="na13"><label for="na13">NA</label>
          <p>
            <strong>Qmax</strong>：
            <input name="Uroflowmetry_Qmax" type="text">ml/s
          </p>
          <p>
            <strong>Voided volume</strong>：
            <input name="Uroflowmetry_VV" type="text">ml
          </p>
          <p>
            <strong>Pattern</strong>：
            <input name="Uroflowmetry_Pattern" type="hidden" value="NA">
            <input name="Uroflowmetry_Pattern" type="radio" id="u_pattern1" value="Bell"><label for="u_pattern1">Bell</label>&nbsp;
            <input name="Uroflowmetry_Pattern" type="radio" id="u_pattern2" value="Tower"><label for="u_pattern2">Tower</label>&nbsp;
            <input name="Uroflowmetry_Pattern" type="radio" id="u_pattern3" value="Staccato"><label for="u_pattern3">Staccato</label>&nbsp;
            <input name="Uroflowmetry_Pattern" type="radio" id="u_pattern4" value="Interrupted"><label for="u_pattern4">Interrupted</label>&nbsp;
            <input name="Uroflowmetry_Pattern" type="radio" id="u_pattern5" value="Obstructive"><label for="u_pattern5">Obstructive</label>&nbsp;
            <input name="Uroflowmetry_Pattern" type="radio" id="u_pattern6" value="Plateau"><label for="u_pattern6">Plateau</label>&nbsp;
            <input name="Uroflowmetry_Pattern" type="radio" id="u_pattern7" value="Unclassified"><label for="u_pattern7">Unclassified abnormal</label>&nbsp;
          </p>
        </div>
        <div class="vcug">
          <h2 style="display: inline;">VCUG：</h2>
          <input name="vcug_na" type=checkbox id="na14"><label for="na14">NA</label>
          <p>
            <strong>Grade of trabeculation</strong>：
            <input name="VCUG_trabeculation" type="hidden" value="99">
            <input name="VCUG_trabeculation" type="radio" id="VCUG_T1" value="0"><label for="VCUG_T1">0</label>&nbsp;
            <input name="VCUG_trabeculation" type="radio" id="VCUG_T2" value="1"><label for="VCUG_T2">1</label>&nbsp;
            <input name="VCUG_trabeculation" type="radio" id="VCUG_T3" value="2"><label for="VCUG_T3">2</label>&nbsp;
            <input name="VCUG_trabeculation" type="radio" id="VCUG_T4" value="3"><label for="VCUG_T4">3</label>&nbsp;
          </p>
          <p>
            <strong>Left VUR (Grade)</strong>：
            <input name="VCUG_VUR_left" type="hidden" value="99">
            <input name="VCUG_VUR_left" type="radio" id="VCUG_VL1" value="0"><label for="VCUG_VL1">0</label>&nbsp;
            <input name="VCUG_VUR_left" type="radio" id="VCUG_VL2" value="1"><label for="VCUG_VL2">1</label>&nbsp;
            <input name="VCUG_VUR_left" type="radio" id="VCUG_VL3" value="2"><label for="VCUG_VL3">2</label>&nbsp;
            <input name="VCUG_VUR_left" type="radio" id="VCUG_VL4" value="3"><label for="VCUG_VL4">3</label>&nbsp;
            <input name="VCUG_VUR_left" type="radio" id="VCUG_VL5" value="4"><label for="VCUG_VL5">4</label>&nbsp;
            <input name="VCUG_VUR_left" type="radio" id="VCUG_VL6" value="5"><label for="VCUG_VL6">5</label>
          </p>
          <p>
            <strong>Right VUR (Grade)</strong>：
            <input name="VCUG_VUR_right" type="hidden" value="99">
            <input name="VCUG_VUR_right" type="radio" id="VCUG_VR1" value="0"><label for="VCUG_VR1">0</label>&nbsp;
            <input name="VCUG_VUR_right" type="radio" id="VCUG_VR2" value="1"><label for="VCUG_VR2">1</label>&nbsp;
            <input name="VCUG_VUR_right" type="radio" id="VCUG_VR3" value="2"><label for="VCUG_VR3">2</label>&nbsp;
            <input name="VCUG_VUR_right" type="radio" id="VCUG_VR4" value="3"><label for="VCUG_VR4">3</label>&nbsp;
            <input name="VCUG_VUR_right" type="radio" id="VCUG_VR5" value="4"><label for="VCUG_VR5">4</label>&nbsp;
            <input name="VCUG_VUR_right" type="radio" id="VCUG_VR6" value="5"><label for="VCUG_VR6">5</label>
          </p>
          <p>
            <strong>DSD</strong>：
            <input name="VCUG_DSD" type="hidden" value="NA">
            <input name="VCUG_DSD" type="radio" id="VCUG_dsd2" value="no"><label for="VCUG_dsd2">No</label>&nbsp;
            <input name="VCUG_DSD" type="radio" id="VCUG_dsd1" value="yes"><label for="VCUG_dsd1">Yes</label>&nbsp;
            <input name="VCUG_DSD" type="radio" id="VCUG_dsd3" value="undetermined"><label for="VCUG_dsd3">Undetermined</label>
          </p>
        </div>
        <div class="cystoscopy">
          <h2 style="display: inline;">Cystoscopy：</h2>
          <input name="cystoscopy_na" type=checkbox id="na15"><label for="na15">NA</label>
          <p>
            <input name="cystoscopy_normal" type="checkbox" id="cn" value="normal"><label for="cn">normal</label>
          </p>
          <p>
            <strong>Ulcer</strong>：
            <input name="cystoscopy_ulcer" type="hidden" value="99">
            <input name="cystoscopy_ulcer" type="radio" id="Cystoscopy_U1" value="0"><label for="Cystoscopy_U1">Negative</label>&nbsp;
            <input name="cystoscopy_ulcer" type="radio" id="Cystoscopy_U2" value="1"><label for="Cystoscopy_U2">Positive</label>&nbsp;
          </p>
          <p>
            <strong>Glomerulation</strong>：
            <input name="cystoscopy_glomerulation" type="hidden" value="99">
            <input name="cystoscopy_glomerulation" type="radio" id="Cystoscopy_G1" value="0"><label for="Cystoscopy_G1">0</label>&nbsp;
            <input name="cystoscopy_glomerulation" type="radio" id="Cystoscopy_G2" value="1"><label for="Cystoscopy_G2">1</label>&nbsp;
            <input name="cystoscopy_glomerulation" type="radio" id="Cystoscopy_G3" value="2"><label for="Cystoscopy_G3">2</label>&nbsp;
            <input name="cystoscopy_glomerulation" type="radio" id="Cystoscopy_G4" value="3"><label for="Cystoscopy_G4">3</label>&nbsp;
            <input name="cystoscopy_glomerulation" type="radio" id="Cystoscopy_G5" value="4"><label for="Cystoscopy_G5">4</label>
          </p>
          <p>
            <strong>Grade of trabeculation</strong>：
            <input name="cystoscopy_trabeculation" type="hidden" value="99">
            <input name="cystoscopy_trabeculation" type="radio" id="Cystoscopy_T1" value="0"><label for="Cystoscopy_T1">0</label>&nbsp;
            <input name="cystoscopy_trabeculation" type="radio" id="Cystoscopy_T2" value="1"><label for="Cystoscopy_T2">1</label>&nbsp;
            <input name="cystoscopy_trabeculation" type="radio" id="Cystoscopy_T3" value="2"><label for="Cystoscopy_T3">2</label>&nbsp;
            <input name="cystoscopy_trabeculation" type="radio" id="Cystoscopy_T4" value="3"><label for="Cystoscopy_T4">3</label>&nbsp;
          </p>
        </div>
        <div class="urodynamic_study">
          <h2 style="display: inline;">Urodynamic Study：</h2>
          <input name="US_na" type=checkbox id="na16"><label for="na16">NA</label>
          <p>
            <strong>First desire volume</strong>：
            <input name="urodynamic_study_FD" type="text">ml
          </p>
          <p>
            <strong>Maximal Cystometric capacity</strong>：
            <input name="urodynamic_study_MCC" type="text">ml
          </p>
          <p>
            <strong>Maximal Pdet</strong>：
            <input name="urodynamic_study_MP" type="text">cmH2O
          </p>
          <p>
            <strong>Detrusor overactivity (unstable detrusor contraction)</strong>：<br>
            <input name="urodynamic_study_DO" type="hidden" value="99">
            <input name="urodynamic_study_DO" type="radio" id="urodynamic_do1" value="0"><label for="urodynamic_do1">Negative</label>&nbsp;
            <input name="urodynamic_study_DO" type="radio" id="urodynamic_do2" value="1"><label for="urodynamic_do2">Positive</label>
            <span id="urodynamic_do0" style="display:none">：
              amplitude<input name="US_DO_amplitude" type="text">,&nbsp;
              at<input name="US_DO_amplitude_at" type="text">ml
            </span>
          </p>
          <p>
            <strong>DSD (Coordination of sphincter)</strong>：
            <input name="urodynamic_study_DSD" type="hidden" value="99">
            <input name="urodynamic_study_DSD" type="radio" id="urodynamic_dsd1" value="0"><label for="urodynamic_dsd1">Negative</label>&nbsp;
            <input name="urodynamic_study_DSD" type="radio" id="urodynamic_dsd2" value="1"><label for="urodynamic_dsd2">Positive</label>
          </p>
          <p>
            <strong>Compliance</strong>：
            <input name="urodynamic_study_compliance" type="hidden" value="NA">
            <input name="urodynamic_study_compliance" type="radio" id="urodynamic_C1" value="normal"><label for="urodynamic_C1">normal</label>&nbsp;
            <input name="urodynamic_study_compliance" type="radio" id="urodynamic_C2" value="fair"><label for="urodynamic_C2">fair</label>&nbsp;
            <input name="urodynamic_study_compliance" type="radio" id="urodynamic_C3" value="poor"><label for="urodynamic_C3">poor ( < 10ml/cmH2O)</label>&nbsp;
          </p>
        </div>
        <div class="biopsy">
          <h2 style="display: inline;">Biopsy：</h2>
          <input name="biopsy_na" type=checkbox id="na17"><label for="na17">NA</label>
          <p>
            <strong>Denuded epithelitum</strong>：
            <input name="biopsy_denuded_epi" type="hidden" value="99">
            <input name="biopsy_denuded_epi" type="radio" id="biopsy_DE1" value="0"><label for="biopsy_DE1">Negative</label>&nbsp;
            <input name="biopsy_denuded_epi" type="radio" id="biopsy_DE2" value="1"><label for="biopsy_DE2">Positive</label>
          </p>
          <p>
            <strong>Granulation</strong>：
            <input name="biopsy_granulation" type="hidden" value="99">
            <input name="biopsy_granulation" type="radio" id="biopsy_G1" value="0"><label for="biopsy_G1">Negative</label>&nbsp;
            <input name="biopsy_granulation" type="radio" id="biopsy_G2" value="1"><label for="biopsy_G2">Positive</label>
          </p>
          <p>
            <strong>Fibronoid necrosis</strong>：
            <input name="biopsy_fibronoid_necrosis" type="hidden" value="99">
            <input name="biopsy_fibronoid_necrosis" type="radio" id="biopsy_FN1" value="0"><label for="biopsy_FN1">Negative</label>&nbsp;
            <input name="biopsy_fibronoid_necrosis" type="radio" id="biopsy_FN2" value="1"><label for="biopsy_FN2">Positive</label>
          </p>
          <p>
            <strong>Eosinophil infiltration</strong>：
            <input name="biopsy_eosinophil_infiltration" type="hidden" value="99">
            <input name="biopsy_eosinophil_infiltration" type="radio" id="biopsy_EI1" value="0"><label for="biopsy_EI1">Negative</label>&nbsp;
            <input name="biopsy_eosinophil_infiltration" type="radio" id="biopsy_EI2" value="1"><label for="biopsy_EI2">Positive</label>
          </p>
        </div>
        <div class="other">
          <h2>其他</h2>
          <p>
            <strong>Psychiatric consultation</strong>：
            <input name="PC_na" type=checkbox id="na18"><label for="na18">NA</label><br>
            <input name="psychi" type="hidden" value="NA">
            <input name="psychi" type="radio" id="psychi2" value="not necessary"><label for="psychi2">Not necessary</label>&nbsp;
            <input name="psychi" type="radio" id="psychi1" value="yes"><label for="psychi1">Yes</label>
          </p>
          <p>
            <strong>Abdominal echo：Bile duct dilatation</strong>：
            <input name="BDD_na" type=checkbox id="na19"><label for="na19">NA</label><br>
            <input name="bile_duct_expand" type="hidden" value="99">
            <input name="bile_duct_expand" type="radio" id="bile2" value="0"><label for="bile2">Negative</label>&nbsp;
            <input name="bile_duct_expand" type="radio" id="bile1" value="1"><label for="bile1">Positive</label>
          </p>
          <p>
            <strong>Esophagealgastroscopy</strong>：
            <input name="ulceration_na" type=checkbox id="na20"><label for="na20">NA</label><br>
            <strong>Ulceration</strong>：
            <input name="gastroscopy" type="hidden" value="99">
            <input name="gastroscopy" type="radio" id="ulceration_G2" value="0"><label for="ulceration_G2">Negative</label>&nbsp;
            <input name="gastroscopy" type="radio" id="ulceration_G1" value="1"><label for="ulceration_G1">Positive</label><br>
            
            <strong>HP Stain</strong>：
            <input name="HP_na" type=checkbox id="na21"><label for="na21">NA</label><br>
            <input name="HP_examination" type="hidden" value="99">
            <input name="HP_examination" type="radio" id="HP_E2" value="0"><label for="HP_E2">Negative</label>&nbsp;
            <input name="HP_examination" type="radio" id="HP_E1" value="1"><label for="HP_E1">Positive</label>
          </p>
          <p>
            <strong>Other Studies</strong>：<br>
            <textarea name="description" rows="4" cols="50" maxlength="200"></textarea>
          </p>
        </div>
        <div class="col-sm-offset-4 col-sm-10">
          <input name="action" type="hidden" id="action" value="update">
          <button type="button" class="btn btn-primary btn-lg" onClick="window.history.back();">
            <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span>&nbsp;&nbsp;Back
          </button>&nbsp;&nbsp;
          <button type="reset" class="btn btn-danger btn-lg">
            <span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;&nbsp;Reset
          </button>&nbsp;&nbsp;
          <button type="submit" class="btn btn-success btn-lg" onClick="return makesure();">
            <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>&nbsp;&nbsp;Save
          </button>
        </div>
      	</form>
      </div>
  </body>
</html>