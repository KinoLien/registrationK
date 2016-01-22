<?php
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");
  //選擇會員
  $query_RecMember = "SELECT * FROM `member` WHERE `m_account`='".$_SESSION["loginMember"]."'";
    $RecMember = mysqli_query($conn, $query_RecMember); 
    $row_RecMember=mysqli_fetch_assoc($RecMember);
    //選擇主治醫生
    $doctor = $row_RecMember["m_name"];
    if($row_RecMember["m_level"] == 'assistent'){
      $query_RecManager = "SELECT * FROM `member` WHERE `m_sn`='".$row_RecMember["m_manager"]."'";
      $RecManager = mysqli_query($conn, $query_RecManager);
      $row_RecManager=mysqli_fetch_assoc($RecManager);
      $doctor = $row_RecManager["m_name"];
    }

    /* 單選(radio)欄位有包含"其他" */
    //居住地
    if ($_POST["location"] == 'other') {
      $location = $_POST["location1"];
    }else{
      $location = $_POST["location"];
    }
    //職業
    if ($_POST["job"] == 'other') {
      $job = $_POST["job1"];
    }else{
      $job = $_POST["job"];
    }
    //婚姻狀況
    if ($_POST["marriage"] == 'other') {
      $marriage = $_POST["marriage1"];
    }else{
      $marriage = $_POST["marriage"];
    }
    //併存疾病
    /*
    //使用方式
    if($_POST["ketamine_method"] == 'other'){
      $ketamine_method = $_POST["ketamine_method1"];
    }else{
      $ketamine_method = $_POST["ketamine_method"];
    }*/
    //合併使用其他種類藥物
    if($_POST["combined_drug"] == 'other'){
      $combined_drug = $_POST["combined_drug1"];
    }else{
      $combined_drug = $_POST["combined_drug"];
    }
    //Urine Culture
    if($_POST["Urine_culture"] == 'other'){
      $Urine_culture = $_POST["Urine_culture1"];
    }else{
      $Urine_culture = $_POST["Urine_culture"];
    }

    /* 複選(checkbox)欄位有包含"其他" 
    //併存疾病欄位有其他
    if ($_POST["comor_other"] == 'other'){
      $_POST["comor_other"] = $_POST["comorbidity1"];
      //echo $_POST["comor_other"];
    }
    //濫用藥物原因
    if($_POST["drugreason_other"] == '1'){
      $_POST["drugreason_other"] = $_POST["drug_reason1"];

      echo $_POST["drugreason_other"];
    }
    //取得藥物場所
    if($_POST["drugplace_other"] == '1'){
      $_POST["drugplace_other"] = $_POST["drug_place1"];
    }
    //取得藥物來源對象
    if($_POST["drugsource_other"] == '1'){
      $_POST["drugsource_other"] = $_POST["drug_source1"];
    }*/
    /* ketamine 使用期間換算月份 */
    $ketamine_history = $_POST["ketamine_history_year"]*12 + $_POST["ketamine_history_month"];
    if($ketamine_history == 0){
      $ketamine_history = "9999";
    }
    /* 戒除Ketamine幾個月*/
    $stop_ketamine_month  = $_POST["stop_ketamine_year"]*12 + $_POST["stop_ketamine_month"];
    if($stop_ketamine_month == 0){
      $stop_ketamine_month = "9999";
    }
    /* 個案別轉換99 */
    if ($_POST["casetype1"] == 0 && $_POST["casetype2"] == 0 && $_POST["casetype3"] == 0 && $_POST["casetype4"] == 0 &&
        $_POST["casetype5"] == 0 && $_POST["casetype6"] == 0 && $_POST["casetype7"] == 0 && $_POST["casetype8"] == 0) {
          $_POST["casetype1"] = "99";
          $_POST["casetype2"] = "99";
          $_POST["casetype3"] = "99";
          $_POST["casetype4"] = "99";
          $_POST["casetype5"] = "99";
          $_POST["casetype6"] = "99";
          $_POST["casetype7"] = "99";
          $_POST["casetype8"] = "99";
    }
    /* 併存疾病轉換99 */
    if($_POST["comor"] == 0 && $_POST["comor1"] == 0 && $_POST["comor2"] == 0 && $_POST["comor3"] == 0 && 
       $_POST["comor4"] == 0 && $_POST["comor5"] == 0 && $_POST["comor6"] == 0 && $_POST["comor7"] == 0 && 
       $_POST["comor8"] == 0 && $_POST["comor9"] == 0 && $_POST["comor10"] == 0 && $_POST["comor11"] == 0 && 
       $_POST["comor12"] == 0 && $_POST["comor13"] == 0 && $_POST["comor14"] == 0 && $_POST["comor15"] == 0) {

        $_POST["comor1"] = "99";
        $_POST["comor2"] = "99";
        $_POST["comor3"] = "99";
        $_POST["comor4"] = "99";
        $_POST["comor5"] = "99";
        $_POST["comor6"] = "99";
        $_POST["comor7"] = "99";
        $_POST["comor8"] = "99";
        $_POST["comor9"] = "99";
        $_POST["comor10"] = "99";
        $_POST["comor11"] = "99";
        $_POST["comor12"] = "99";
        $_POST["comor13"] = "99";
        $_POST["comor14"] = "99";
        $_POST["comor15"] = "99";
        $_POST["comor_other"] = "NA";
    }
    /* 濫用藥物原因轉換99 */
    if($_POST["drugreason1"] == 0 && $_POST["drugreason2"] == 0 && $_POST["drugreason3"] == 0 && $_POST["drugreason4"] == 0 &&
       $_POST["drugreason5"] == 0 && $_POST["drugreason6"] == 0 && $_POST["drugreason7"] == 0 && $_POST["drugreason8"] == 0 &&
       $_POST["drugreason9"] == 0 && $_POST["drugreason10"] == 0 && $_POST["drugreason11"] == 0 && $_POST["drugreason12"] == 0 && 
       $_POST["drugreason13"] == 0 && $_POST["drugreason14"] == 0 && $_POST["drugreason15"] == 0){

        $_POST["drugreason1"] = "99";
        $_POST["drugreason2"] = "99";
        $_POST["drugreason3"] = "99";
        $_POST["drugreason4"] = "99";
        $_POST["drugreason5"] = "99";
        $_POST["drugreason6"] = "99";
        $_POST["drugreason7"] = "99";
        $_POST["drugreason8"] = "99";
        $_POST["drugreason9"] = "99";
        $_POST["drugreason10"] = "99";
        $_POST["drugreason11"] = "99";
        $_POST["drugreason12"] = "99";
        $_POST["drugreason13"] = "99";
        $_POST["drugreason14"] = "99";
        $_POST["drugreason15"] = "99";
        $_POST["drugreason_other"] = "NA";
    }
    /* 濫用藥物地點轉換99 */
    if($_POST["drugplace1"] == 0 && $_POST["drugplace2"] == 0 && $_POST["drugplace3"] == 0 && $_POST["drugplace4"] == 0 &&
       $_POST["drugplace5"] == 0 && $_POST["drugplace6"] == 0 && $_POST["drugplace7"] == 0 && $_POST["drugplace8"] == 0 &&
       $_POST["drugplace9"] == 0 && $_POST["drugplace10"] == 0 && $_POST["drugplace11"] == 0 && $_POST["drugplace12"] == 0 &&
       $_POST["drugplace13"] == 0 && $_POST["drugplace14"] == 0 && $_POST["drugplace15"] == 0 && $_POST["drugplace16"] == 0 &&
       $_POST["drugplace17"] == 0 && $_POST["drugplace18"] == 0 && $_POST["drugplace19"] == 0){

        $_POST["drugplace1"] = "99";
        $_POST["drugplace2"] = "99";
        $_POST["drugplace3"] = "99";
        $_POST["drugplace4"] = "99";
        $_POST["drugplace5"] = "99";
        $_POST["drugplace6"] = "99";
        $_POST["drugplace7"] = "99";
        $_POST["drugplace8"] = "99";
        $_POST["drugplace9"] = "99";
        $_POST["drugplace10"] = "99";
        $_POST["drugplace11"] = "99";
        $_POST["drugplace12"] = "99";
        $_POST["drugplace13"] = "99";
        $_POST["drugplace14"] = "99";
        $_POST["drugplace15"] = "99";
        $_POST["drugplace16"] = "99";
        $_POST["drugplace17"] = "99";
        $_POST["drugplace18"] = "99";
        $_POST["drugplace19"] = "99";
        $_POST["drugplace_other"] = "NA";

    }
    /* 濫用藥物地點轉換99 */
    if($_POST["drugsource1"] == 0 && $_POST["drugsource2"] == 0 && $_POST["drugsource3"] == 0 && 
       $_POST["drugsource4"] == 0 && $_POST["drugsource5"] == 0 && $_POST["drugsource6"] == 0 &&
       $_POST["drugsource7"] == 0 && $_POST["drugsource8"] == 0 && $_POST["drugsource9"] == 0){

        $_POST["drugsource1"] = "99";
        $_POST["drugsource2"] = "99";
        $_POST["drugsource3"] = "99";
        $_POST["drugsource4"] = "99";
        $_POST["drugsource5"] = "99";
        $_POST["drugsource6"] = "99";
        $_POST["drugsource7"] = "99";
        $_POST["drugsource8"] = "99";
        $_POST["drugsource9"] = "99";
        $_POST["drugsource_other"] = "NA";

    }
    /* 主要使用毒品方式轉換99 */
    if($_POST["ketamine_method1"] == 0 && $_POST["ketamine_method2"] == 0 && $_POST["ketamine_method3"] == 0 &&
       $_POST["ketamine_method4"] == 0 && $_POST["ketamine_method5"] == 0 && $_POST["ketamine_method6"] == 0) {
       
       $_POST["ketamine_method1"] = "99";
       $_POST["ketamine_method2"] = "99"; 
       $_POST["ketamine_method3"] = "99"; 
       $_POST["ketamine_method4"] = "99"; 
       $_POST["ketamine_method5"] = "99"; 
       $_POST["ketamine_method6"] = "99"; 
       $_POST["ketamine_method_other"] = "NA";  
    }
    //轉換 NA and 999 type=text
    if($_POST["first_ketamine_age"] ==''){
      $_POST["first_ketamine_age"] = "NA";
    }
    if($_POST["firstmedical"] ==''){
      $_POST["firstmedical"] = "NA";
    }
    if($_POST["tx_other"] ==''){
      $_POST["tx_other"] = "0";
    }
    if($_POST["systolic_pressure"] ==''){
      $_POST["systolic_pressure"] = "999";
    }
    if($_POST["diastolic_pressure"] ==''){
      $_POST["diastolic_pressure"] = "999";
    }
    if($_POST["other_symptoms"] ==''){
      $_POST["other_symptoms"] = "NA";
    }
    if($_POST["Diary_1D"] ==''){
      $_POST["Diary_1D"] = "99";
    }
    if($_POST["Diary_1N"] ==''){
      $_POST["Diary_1N"] = "99";
    }
    if($_POST["Diary_2D"] ==''){
      $_POST["Diary_2D"] = "99";
    }
    if($_POST["Diary_2N"] ==''){
      $_POST["Diary_2N"] = "99";
    }
    if($_POST["Diary_3D"] ==''){
      $_POST["Diary_3D"] = "99";
    }
    if($_POST["Diary_3N"] ==''){
      $_POST["Diary_3N"] = "99";
    }
    if($_POST["Diary_Max_VV"] ==''){
      $_POST["Diary_Max_VV"] = "999";
    }
    if($_POST["Urine_routine_WBC_HPF"] ==''){
      $_POST["Urine_routine_WBC_HPF"] = "NA";
    }
    if($_POST["Urine_routine_RBC_HPF"] ==''){
      $_POST["Urine_routine_RBC_HPF"] = "NA";
    }
    if($_POST["Urine_routine_Nit"] ==''){
      $_POST["Urine_routine_Nit"] = "NA";
    }
    if($_POST["Urine_routine_LEU"] ==''){
      $_POST["Urine_routine_LEU"] = "NA";
    }
    if($_POST["Urine_routine_Bact"] ==''){
      $_POST["Urine_routine_Bact"] = "NA";
    }
    if($_POST["Renal_function_BUN"] ==''){
      $_POST["Renal_function_BUN"] = "999";
    }
    if($_POST["Renal_function_Cr"] ==''){
      $_POST["Renal_function_Cr"] = "999";
    }
    if($_POST["Liver_function_GOT"] ==''){
      $_POST["Liver_function_GOT"] = "999";
    }
    if($_POST["Liver_function_GPT"] ==''){
      $_POST["Liver_function_GPT"] = "999";
    }
    if($_POST["Liver_function_ALB"] ==''){
      $_POST["Liver_function_ALB"] = "999";
    }
    if($_POST["Liver_function_BIL"] ==''){
      $_POST["Liver_function_BIL"] = "999";
    }
    if($_POST["Hematology_WBC"] ==''){
      $_POST["Hematology_WBC"] = "999";
    }
    if($_POST["Hematology_Hgb"] ==''){
      $_POST["Hematology_Hgb"] = "999";
    }
    if($_POST["Hematology_Pl"] ==''){
      $_POST["Hematology_Pl"] = "999";
    }
    if($_POST["Hematology_eosinophil"] ==''){
      $_POST["Hematology_eosinophil"] = "999";
    }
    if($_POST["Immune_IgE"] ==''){
      $_POST["Immune_IgE"] = "999";
    }
    if($_POST["PVR"] ==''){
      $_POST["PVR"] = "999";
    }
    if($_POST["bladder_echo_BW_thickness"] ==''){
      $_POST["bladder_echo_BW_thickness"] = "999";
    }
    if($_POST["Uroflowmetry_Qmax"] ==''){
      $_POST["Uroflowmetry_Qmax"] = "999";
    }
    if($_POST["Uroflowmetry_VV"] ==''){
      $_POST["Uroflowmetry_VV"] = "999";
    }
    if($_POST["urodynamic_study_FD"] ==''){
      $_POST["urodynamic_study_FD"] = "999";
    }
    if($_POST["urodynamic_study_MCC"] ==''){
      $_POST["urodynamic_study_MCC"] = "999";
    }
    if($_POST["urodynamic_study_MP"] ==''){
      $_POST["urodynamic_study_MP"] = "999";
    }
    if($_POST["US_DO_amplitude"] ==''){
      $_POST["US_DO_amplitude"] = "999";
    }
    if($_POST["US_DO_amplitude_at"] ==''){
      $_POST["US_DO_amplitude_at"] = "999";
    }
    if($_POST["description"] ==''){
      $_POST["description"] = "NA";
    }

    if($_POST["IVP_na"] == 'NA'){
      $_POST["IVP_right_cortical_thinning"] = "99";
      $_POST["IVP_right_hydro_RK"] = "99";
      $_POST["IVP_right_UrStricture_up"] = "99";
      $_POST["IVP_right_UrStricture_middle"] = "99";
      $_POST["IVP_right_UrStricture_down"] = "99";

      $_POST["IVP_left_cortical_thinning"] = "99";
      $_POST["IVP_left_hydro_LK"] = "99";
      $_POST["IVP_left_UrStricture_up"] = "99";
      $_POST["IVP_left_UrStricture_middle"] = "99";
      $_POST["IVP_left_UrStricture_down"] = "99";
    }
    if ($_POST["ivp_right"] == "0" && $_POST["IVP_right_cortical_thinning"] == "0" && 
        $_POST["IVP_right_hydro_RK"] == "0" && $_POST["IVP_right_UrStricture_up"] == "0" && 
        $_POST["IVP_right_UrStricture_middle"] == "0" && $_POST["IVP_right_UrStricture_down"] == "0" &&
        $_POST["ivp_left"] == "0" && $_POST["IVP_left_cortical_thinning"] == "0" && 
        $_POST["IVP_left_hydro_LK"] == "0" && $_POST["IVP_left_UrStricture_up"] == "0" && 
        $_POST["IVP_left_UrStricture_middle"] == "0" && $_POST["IVP_left_UrStricture_down"] == "0") {
      $_POST["IVP_right_cortical_thinning"] = "99";
      $_POST["IVP_right_hydro_RK"] = "99";
      $_POST["IVP_right_UrStricture_up"] = "99";
      $_POST["IVP_right_UrStricture_middle"] = "99";
      $_POST["IVP_right_UrStricture_down"] = "99";

      $_POST["IVP_left_cortical_thinning"] = "99";
      $_POST["IVP_left_hydro_LK"] = "99";
      $_POST["IVP_left_UrStricture_up"] = "99";
      $_POST["IVP_left_UrStricture_middle"] = "99";
      $_POST["IVP_left_UrStricture_down"] = "99";
    }
    if($_POST["CT_na"] == 'NA'){
      $_POST["CT_right_cortical_thinning"] = "99";
      $_POST["CT_right_hydro_RK"] = "99";
      $_POST["CT_right_UrStricture_up"] = "99";
      $_POST["CT_right_UrStricture_middle"] = "99";
      $_POST["CT_right_UrStricture_down"] = "99";

      $_POST["CT_left_cortical_thinning"] = "99";
      $_POST["CT_left_hydro_LK"] = "99";
      $_POST["CT_left_UrStricture_up"] = "99";
      $_POST["CT_left_UrStricture_middle"] = "99";
      $_POST["CT_left_UrStricture_down"] = "99";
    }
    if ($_POST["ct_right"] == "0" && $_POST["CT_right_cortical_thinning"] == "0" && 
        $_POST["CT_right_hydro_RK"] == "0" && $_POST["CT_right_UrStricture_up"] == "0" && 
        $_POST["CT_right_UrStricture_middle"] == "0" && $_POST["CT_right_UrStricture_down"] == "0" &&
        $_POST["ct_left"] == "0" && $_POST["CT_left_cortical_thinning"] == "0" && 
        $_POST["CT_left_hydro_LK"] == "0" && $_POST["CT_left_UrStricture_up"] == "0" && 
        $_POST["CT_left_UrStricture_middle"] == "0" && $_POST["CT_left_UrStricture_down"] == "0") {
      
      $_POST["CT_right_cortical_thinning"] = "99";
      $_POST["CT_right_hydro_RK"] = "99";
      $_POST["CT_right_UrStricture_up"] = "99";
      $_POST["CT_right_UrStricture_middle"] = "99";
      $_POST["CT_right_UrStricture_down"] = "99";

      $_POST["CT_left_cortical_thinning"] = "99";
      $_POST["CT_left_hydro_LK"] = "99";
      $_POST["CT_left_UrStricture_up"] = "99";
      $_POST["CT_left_UrStricture_middle"] = "99";
      $_POST["CT_left_UrStricture_down"] = "99";
    }

    /* 第一次收案 treatment 轉換99*/
    if($_POST["firstmedical"] == "1"){
      $_POST["tx_nsaid"] = "99";
      $_POST["tx_cox2"] = "99";
      $_POST["tx_opioid"] = "99";
      $_POST["tx_morphin"] = "99";
      $_POST["tx_antim"] = "99";
      $_POST["tx_double_antim"] = "99";
      $_POST["tx_mucosa_op"] = "99";
      $_POST["tx_mucosa_ic"] = "99";
      $_POST["tx_hydrodistention"] = "99";
      $_POST["tx_botox_id100u"] = "99";
      $_POST["tx_botox_it100u"] = "99";
      $_POST["tx_botox_idit100u"] = "99";
      $_POST["tx_ewithout"] = "99";
      $_POST["tx_epartial"] = "99";
      $_POST["tx_ewhole"] = "99";
      $_POST["tx_dj_one"] = "99";
      $_POST["tx_dj_both"] = "99";
      $_POST["tx_pcnd_one"] = "99";
      $_POST["tx_pcnd_both"] = "99";
      $_POST["tx_other"] = "NA";

    }
    $_POST["description"] = str_replace( chr(13).chr(10), "  ",$_POST["description"]);
    //echo "string";
    //exit();
    //將問卷且入資料庫
  if(isset($_POST["action"])&&($_POST["action"]=="update")){

    
    //新增病歷
    $query_insert = "UPDATE 
                        `medical` 
                     SET 
                        `height` = '".$_POST["height"]."',
                        `weight` = '".$_POST["weight"]."',
                        `location` = '".$location."',
                        `casetype1` = '".$_POST["casetype1"]."',
                        `casetype2` = '".$_POST["casetype2"]."',
                        `casetype3` = '".$_POST["casetype3"]."',
                        `casetype4` = '".$_POST["casetype4"]."',
                        `casetype5` = '".$_POST["casetype5"]."',
                        `casetype6` = '".$_POST["casetype6"]."',
                        `casetype7` = '".$_POST["casetype7"]."',
                        `casetype8` = '".$_POST["casetype8"]."',
                        `job` = '".$job."',
                        `edu` = '".$_POST["edu"]."',
                        `marriage` = '".$marriage."',
                        `comor1` = '".$_POST["comor1"]."',
                        `comor2` = '".$_POST["comor2"]."',
                        `comor3` = '".$_POST["comor3"]."',
                        `comor4` = '".$_POST["comor4"]."',
                        `comor5` = '".$_POST["comor5"]."',
                        `comor6` = '".$_POST["comor6"]."',
                        `comor7` = '".$_POST["comor7"]."',
                        `comor8` = '".$_POST["comor8"]."',
                        `comor9` = '".$_POST["comor9"]."',
                        `comor10` = '".$_POST["comor10"]."',
                        `comor11` = '".$_POST["comor11"]."',
                        `comor12` = '".$_POST["comor12"]."',
                        `comor13` = '".$_POST["comor13"]."',
                        `comor14` = '".$_POST["comor14"]."',
                        `comor15` = '".$_POST["comor15"]."',
                        `comor_other` = '".$_POST["comor_other"]."',
                        `regular_sex_partner` = '".$_POST["regular_sex_partner"]."',
                        `smoking` = '".$_POST["smoking"]."',
                        `drinking` = '".$_POST["drinking"]."',
                        `betel_nut` = '".$_POST["betel_nut"]."',
                        `drugreason1` = '".$_POST["drugreason1"]."',
                        `drugreason2` = '".$_POST["drugreason2"]."',
                        `drugreason3` = '".$_POST["drugreason3"]."',
                        `drugreason4` = '".$_POST["drugreason4"]."',
                        `drugreason5` = '".$_POST["drugreason5"]."',
                        `drugreason6` = '".$_POST["drugreason6"]."',
                        `drugreason7` = '".$_POST["drugreason7"]."',
                        `drugreason8` = '".$_POST["drugreason8"]."',
                        `drugreason9` = '".$_POST["drugreason9"]."',
                        `drugreason10` = '".$_POST["drugreason10"]."',
                        `drugreason11` = '".$_POST["drugreason11"]."',
                        `drugreason12` = '".$_POST["drugreason12"]."',
                        `drugreason13` = '".$_POST["drugreason13"]."',
                        `drugreason14` = '".$_POST["drugreason14"]."',
                        `drugreason15` = '".$_POST["drugreason15"]."',
                        `drugreason_other` = '".$_POST["drugreason_other"]."',
                        `drugplace1` = '".$_POST["drugplace1"]."',
                        `drugplace2` = '".$_POST["drugplace2"]."',
                        `drugplace3` = '".$_POST["drugplace3"]."',
                        `drugplace4` = '".$_POST["drugplace4"]."',
                        `drugplace5` = '".$_POST["drugplace5"]."',
                        `drugplace6` = '".$_POST["drugplace6"]."',
                        `drugplace7` = '".$_POST["drugplace7"]."',
                        `drugplace8` = '".$_POST["drugplace8"]."',
                        `drugplace9` = '".$_POST["drugplace9"]."',
                        `drugplace10` = '".$_POST["drugplace10"]."',
                        `drugplace11` = '".$_POST["drugplace11"]."',
                        `drugplace12` = '".$_POST["drugplace12"]."',
                        `drugplace13` = '".$_POST["drugplace13"]."',
                        `drugplace14` = '".$_POST["drugplace14"]."',
                        `drugplace15` = '".$_POST["drugplace15"]."',
                        `drugplace16` = '".$_POST["drugplace16"]."',
                        `drugplace17` = '".$_POST["drugplace17"]."',
                        `drugplace18` = '".$_POST["drugplace18"]."',
                        `drugplace19` = '".$_POST["drugplace19"]."',
                        `drugplace_other` = '".$_POST["drugplace_other"]."',
                        `drugsource1` = '".$_POST["drugsource1"]."',
                        `drugsource2` = '".$_POST["drugsource2"]."',
                        `drugsource3` = '".$_POST["drugsource3"]."',
                        `drugsource4` = '".$_POST["drugsource4"]."',
                        `drugsource5` = '".$_POST["drugsource5"]."',
                        `drugsource6` = '".$_POST["drugsource6"]."',
                        `drugsource7` = '".$_POST["drugsource7"]."',
                        `drugsource8` = '".$_POST["drugsource8"]."',
                        `drugsource9` = '".$_POST["drugsource9"]."',
                        `drugsource_other` = '".$_POST["drugsource_other"]."',
                        `first_ketamine_age` = '".$_POST["first_ketamine_age"]."',
                        `ketamine_history` = '".$ketamine_history."',
                        `ketamine_ave` = '".$_POST["ketamine_ave"]."',
                        `ketamine_method1` = '".$_POST["ketamine_method1"]."',
                        `ketamine_method2` = '".$_POST["ketamine_method2"]."',
                        `ketamine_method3` = '".$_POST["ketamine_method3"]."',
                        `ketamine_method4` = '".$_POST["ketamine_method4"]."',
                        `ketamine_method5` = '".$_POST["ketamine_method5"]."',
                        `ketamine_method6` = '".$_POST["ketamine_method6"]."',
                        `ketamine_method_other` = '".$_POST["ketamine_method_other"]."',
                        `combined_drug` = '".$combined_drug."',
                        `symptom_starting_date` = '".$_POST["symptom_starting_date"]."',
                        `stop_ketamine` = '".$_POST["stop_ketamine"]."',
                        `stop_ketamine_month` = '".$stop_ketamine_month."',
                        `IPSS_score1` = '".$_POST["IPSS_score1"]."',
                        `IPSS_score2` = '".$_POST["IPSS_score2"]."',
                        `IPSS_score3` = '".$_POST["IPSS_score3"]."',
                        `IPSS_score4` = '".$_POST["IPSS_score4"]."',
                        `IPSS_score5` = '".$_POST["IPSS_score5"]."',
                        `IPSS_score6` = '".$_POST["IPSS_score6"]."',
                        `IPSS_score7` = '".$_POST["IPSS_score7"]."',
                        `urinary_quality_life` = '".$_POST["urinary_quality_life"]."',
                        `IC_symptom1` = '".$_POST["IC_symptom1"]."',
                        `IC_symptom2` = '".$_POST["IC_symptom2"]."',
                        `IC_symptom3` = '".$_POST["IC_symptom3"]."',
                        `IC_symptom4` = '".$_POST["IC_symptom4"]."',
                        `IC_question1` = '".$_POST["IC_question1"]."',
                        `IC_question2` = '".$_POST["IC_question2"]."',
                        `IC_question3` = '".$_POST["IC_question3"]."',
                        `IC_question4` = '".$_POST["IC_question4"]."',
                        `VAS` = '".$_POST["VAS"]."',
                        `BSRS1` = '".$_POST["BSRS1"]."',
                        `BSRS2` = '".$_POST["BSRS2"]."',
                        `BSRS3` = '".$_POST["BSRS3"]."',
                        `BSRS4` = '".$_POST["BSRS4"]."',
                        `BSRS5` = '".$_POST["BSRS5"]."',
                        `FSFI1` = '".$_POST["FSFI1"]."',
                        `FSFI2` = '".$_POST["FSFI2"]."',
                        `FSFI3` = '".$_POST["FSFI3"]."',
                        `FSFI4` = '".$_POST["FSFI4"]."',
                        `FSFI5` = '".$_POST["FSFI5"]."',
                        `FSFI6` = '".$_POST["FSFI6"]."',
                        `FSFI7` = '".$_POST["FSFI7"]."',
                        `FSFI8` = '".$_POST["FSFI8"]."',
                        `FSFI9` = '".$_POST["FSFI9"]."',
                        `FSFI10` = '".$_POST["FSFI10"]."',
                        `FSFI11` = '".$_POST["FSFI11"]."',
                        `FSFI12` = '".$_POST["FSFI12"]."',
                        `FSFI13` = '".$_POST["FSFI13"]."',
                        `FSFI14` = '".$_POST["FSFI14"]."',
                        `FSFI15` = '".$_POST["FSFI15"]."',
                        `FSFI16` = '".$_POST["FSFI16"]."',
                        `FSFI17` = '".$_POST["FSFI17"]."',
                        `FSFI18` = '".$_POST["FSFI18"]."',
                        `FSFI19` = '".$_POST["FSFI19"]."',
                        `IIEF1` = '".$_POST["IIEF1"]."',
                        `IIEF2` = '".$_POST["IIEF2"]."',
                        `IIEF3` = '".$_POST["IIEF3"]."',
                        `IIEF4` = '".$_POST["IIEF4"]."',
                        `IIEF5` = '".$_POST["IIEF5"]."',
                        `register_date` = '".$_POST["register_date"]."',
                        `firstmedical` = '".$_POST["firstmedical"]."',
                        `tx_date` = '".$_POST["tx_date"]."',
                        `tx_nsaid` = '".$_POST["tx_nsaid"]."',
                        `tx_cox2` = '".$_POST["tx_cox2"]."',
                        `tx_opioid` = '".$_POST["tx_opioid"]."',
                        `tx_morphin` = '".$_POST["tx_morphin"]."',
                        `tx_antim` = '".$_POST["tx_antim"]."',
                        `tx_double_antim` = '".$_POST["tx_double_antim"]."',
                        `tx_mucosa_op` = '".$_POST["tx_mucosa_op"]."',
                        `tx_mucosa_ic` = '".$_POST["tx_mucosa_ic"]."',
                        `tx_hydrodistention` = '".$_POST["tx_hydrodistention"]."',
                        `tx_botox_id100u` = '".$_POST["tx_botox_id100u"]."',
                        `tx_botox_it100u` = '".$_POST["tx_botox_it100u"]."',
                        `tx_botox_idit100u` = '".$_POST["tx_botox_idit100u"]."',
                        `tx_ewithout` = '".$_POST["tx_ewithout"]."',
                        `tx_epartial` = '".$_POST["tx_epartial"]."',
                        `tx_ewhole` = '".$_POST["tx_ewhole"]."',
                        `tx_dj_one` = '".$_POST["tx_dj_one"]."',
                        `tx_dj_both` = '".$_POST["tx_dj_both"]."',
                        `tx_pcnd_one` = '".$_POST["tx_pcnd_one"]."',
                        `tx_pcnd_both` = '".$_POST["tx_pcnd_both"]."',
                        `tx_other` = '".$_POST["tx_other"]."',
                        `systolic_pressure` = '".$_POST["systolic_pressure"]."',
                        `diastolic_pressure` = '".$_POST["diastolic_pressure"]."',
                        `gross_hematuria` = '".$_POST["gross_hematuria"]."',
                        `other_symptoms` = '".$_POST["other_symptoms"]."',
                        `Diary_1D` = '".$_POST["Diary_1D"]."',
                        `Diary_1N` = '".$_POST["Diary_1N"]."',
                        `Diary_2D` = '".$_POST["Diary_2D"]."',
                        `Diary_2N` = '".$_POST["Diary_2N"]."',
                        `Diary_3D` = '".$_POST["Diary_3D"]."',
                        `Diary_3N` = '".$_POST["Diary_3N"]."',
                        `Diary_Max_VV` = '".$_POST["Diary_Max_VV"]."',
                        `Urine_routine_WBC_HPF` = '".$_POST["Urine_routine_WBC_HPF"]."',
                        `Urine_routine_RBC_HPF` = '".$_POST["Urine_routine_RBC_HPF"]."',
                        `Urine_routine_Nit` = '".$_POST["Urine_routine_Nit"]."',
                        `Urine_routine_LEU` = '".$_POST["Urine_routine_LEU"]."',
                        `Urine_routine_Bact` = '".$_POST["Urine_routine_Bact"]."',
                        `Urine_culture` = '".$Urine_culture."',
                        `cytology` = '".$_POST["cytology"]."',
                        `STD_HIV` = '".$_POST["STD_HIV"]."',
                        `STD_VDRL` = '".$_POST["STD_VDRL"]."',
                        `STD_TPHA` = '".$_POST["STD_TPHA"]."',
                        `Renal_function_BUN` = '".$_POST["Renal_function_BUN"]."',
                        `Renal_function_Cr` = '".$_POST["Renal_function_Cr"]."',
                        `Liver_function_GOT` = '".$_POST["Liver_function_GOT"]."',
                        `Liver_function_GPT` = '".$_POST["Liver_function_GPT"]."',
                        `Liver_function_ALB` = '".$_POST["Liver_function_ALB"]."',
                        `Liver_function_BIL` = '".$_POST["Liver_function_BIL"]."',
                        `Hematology_WBC` = '".$_POST["Hematology_WBC"]."',
                        `Hematology_Hgb` = '".$_POST["Hematology_Hgb"]."',
                        `Hematology_Pl` = '".$_POST["Hematology_Pl"]."',
                        `Hematology_eosinophil` = '".$_POST["Hematology_eosinophil"]."',
                        `Immune_IgE` = '".$_POST["Immune_IgE"]."',
                        `renal_echo_right_echogenicity` = '".$_POST["renal_echo_right_echogenicity"]."',
                        `renal_echo_right_kidney` = '".$_POST["renal_echo_right_kidney"]."',
                        `renal_echo_left_echogenicity` = '".$_POST["renal_echo_left_echogenicity"]."',
                        `renal_echo_left_kidney` = '".$_POST["renal_echo_left_kidney"]."',
                        `IVP_right_cortical_thinning` = '".$_POST["IVP_right_cortical_thinning"]."',
                        `IVP_right_hydro_RK` = '".$_POST["IVP_right_hydro_RK"]."',
                        `IVP_right_UrStricture_up` = '".$_POST["IVP_right_UrStricture_up"]."',
                        `IVP_right_UrStricture_middle` = '".$_POST["IVP_right_UrStricture_middle"]."',
                        `IVP_right_UrStricture_down` = '".$_POST["IVP_right_UrStricture_down"]."',
                        `IVP_left_cortical_thinning` = '".$_POST["IVP_left_cortical_thinning"]."',
                        `IVP_left_hydro_LK` = '".$_POST["IVP_left_hydro_LK"]."',
                        `IVP_left_UrStricture_up` = '".$_POST["IVP_left_UrStricture_up"]."',
                        `IVP_left_UrStricture_middle` = '".$_POST["IVP_left_UrStricture_middle"]."',
                        `IVP_left_UrStricture_down` = '".$_POST["IVP_left_UrStricture_down"]."',
                        `CT_right_cortical_thinning` = '".$_POST["CT_right_cortical_thinning"]."',
                        `CT_right_hydro_RK` = '".$_POST["CT_right_hydro_RK"]."',
                        `CT_right_UrStricture_up` = '".$_POST["CT_right_UrStricture_up"]."',
                        `CT_right_UrStricture_middle` = '".$_POST["CT_right_UrStricture_middle"]."',
                        `CT_right_UrStricture_down` = '".$_POST["CT_right_UrStricture_down"]."',
                        `CT_left_cortical_thinning` = '".$_POST["CT_left_cortical_thinning"]."',
                        `CT_left_hydro_LK` = '".$_POST["CT_left_hydro_LK"]."',
                        `CT_left_UrStricture_up` = '".$_POST["CT_left_UrStricture_up"]."',
                        `CT_left_UrStricture_middle` = '".$_POST["CT_left_UrStricture_middle"]."',
                        `CT_left_UrStricture_down` = '".$_POST["CT_left_UrStricture_down"]."',
                        `PVR` = '".$_POST["PVR"]."',
                        `bladder_echo_BW_thickness` = '".$_POST["bladder_echo_BW_thickness"]."',
                        `Uroflowmetry_Qmax` = '".$_POST["Uroflowmetry_Qmax"]."',
                        `Uroflowmetry_VV` = '".$_POST["Uroflowmetry_VV"]."',
                        `Uroflowmetry_Pattern` = '".$_POST["Uroflowmetry_Pattern"]."',
                        `VCUG_trabeculation` = '".$_POST["VCUG_trabeculation"]."',
                        `VCUG_VUR_left` = '".$_POST["VCUG_VUR_left"]."',
                        `VCUG_VUR_right` = '".$_POST["VCUG_VUR_right"]."',
                        `VCUG_DSD` = '".$_POST["VCUG_DSD"]."',
                        `cystoscopy_ulcer` = '".$_POST["cystoscopy_ulcer"]."',
                        `cystoscopy_glomerulation` = '".$_POST["cystoscopy_glomerulation"]."',
                        `cystoscopy_trabeculation` = '".$_POST["cystoscopy_trabeculation"]."',
                        `urodynamic_study_FD` = '".$_POST["urodynamic_study_FD"]."',
                        `urodynamic_study_MCC` = '".$_POST["urodynamic_study_MCC"]."',
                        `urodynamic_study_MP` = '".$_POST["urodynamic_study_MP"]."',
                        `urodynamic_study_DO` = '".$_POST["urodynamic_study_DO"]."',
                        `US_DO_amplitude` = '".$_POST["US_DO_amplitude"]."',
                        `US_DO_amplitude_at` = '".$_POST["US_DO_amplitude_at"]."',
                        `urodynamic_study_DSD` = '".$_POST["urodynamic_study_DSD"]."',
                        `urodynamic_study_compliance` = '".$_POST["urodynamic_study_compliance"]."',
                        `biopsy_denuded_epi` = '".$_POST["biopsy_denuded_epi"]."',
                        `biopsy_granulation` = '".$_POST["biopsy_granulation"]."',
                        `biopsy_fibronoid_necrosis` = '".$_POST["biopsy_fibronoid_necrosis"]."',
                        `biopsy_eosinophil_infiltration` = '".$_POST["biopsy_eosinophil_infiltration"]."',
                        `psychi` = '".$_POST["psychi"]."',
                        `bile_duct_expand` = '".$_POST["bile_duct_expand"]."',
                        `gastroscopy` = '".$_POST["gastroscopy"]."',
                        `HP_examination` = '".$_POST["HP_examination"]."',
                        `description` = '".$_POST["description"]."',
                        `update_member` = '".$row_RecMember["m_name"]."',
                        `update_time` = NOW()
                     WHERE 
                        `sn`='".$_POST["sn"]."'";
    
    //echo "<br>";
    //echo $query_insert;
    //exit();
    mysqli_query($conn, $query_insert);
    header("Location: medical_list.php?loginStats=1");
  }
?>