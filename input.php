<?php
  header("Content-Type: text/html; charset=utf-8");
  session_start();
  include_once("connect.php");

  // kino: check the id is duplicate or not
  if(isset($_GET["action"]) && $_GET["action"] == "id_validate" ){
    $strIdValue = $_GET["value"];
    $strHnameValue = $_GET["h_name"];
    $query_RecMedical = "SELECT * FROM `medical` WHERE `h_name` = '" . $strHnameValue . "'" .
      " AND `id`='" . md5($strIdValue) . "'" .
      " AND `birth_year`=".$_GET["birth_year"].
      " AND `birth_month`=".$_GET["birth_month"];
    $RecMedical = mysqli_query($conn, $query_RecMedical);
    $row_RecMedical = mysqli_fetch_assoc($RecMedical);
    if(empty($row_RecMedical)){
      echo 'YES';
    }else{
      echo 'NO';
    }
    exit;
  }

  //選擇會員
  $query_RecMember = "SELECT * FROM `member` WHERE `m_account`='".$_SESSION["loginMember"]."'";
    $RecMember = mysqli_query($conn, $query_RecMember); 
    $row_RecMember=mysqli_fetch_assoc($RecMember);
    //選擇主治醫生
    $doctorName = $row_RecMember["m_name"];
    $doctor = $row_RecMember["m_sn"];
    if($row_RecMember["m_level"] == 'assistant'){
      $query_RecManager = "SELECT * FROM `member` WHERE `m_sn`='".$row_RecMember["m_manager"]."'";
      $RecManager = mysqli_query($conn, $query_RecManager);
      $row_RecManager=mysqli_fetch_assoc($RecManager);
      $doctorName = $row_RecManager["m_name"];
      $doctor = $row_RecMember["m_manager"];
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
    //echo $_POST["description"];
    //exit();
    $md5id = md5($_POST["id"]);

    //echo "string";
    //echo $_POST["description"];
    //echo $_POST["tx_other"];
    //echo $_POST["firstmedical"];
    //echo $_POST["drugreason_other"];
    //echo $_POST["drugplace1"];
    //echo $_POST["drugplace_other"];
    //exit();
    //將問卷且入資料庫
  if(isset($_POST["action"])&&($_POST["action"]=="join")){

    
    //新增病歷
    $query_insert = "INSERT INTO `medical`(
                    `date`, `h_name`, `doctor`, `id`, `foreigner_id`, `sex`, `height`, `weight`, `birth_year`,
                    `birth_month`, `location`, `casetype1`, `casetype2`, `casetype3`, `casetype4`, 
                    `casetype5`, `casetype6`, `casetype7`, `casetype8`, `job`, `edu`, `marriage`, 
                    `comor1`, `comor2`, `comor3`, `comor4`, `comor5`, `comor6`, `comor7`, `comor8`, 
                    `comor9`, `comor10`, `comor11`, `comor12`, `comor13`, `comor14`, `comor15`, `comor_other`, 
                    `regular_sex_partner`, `smoking`, `drinking`, `betel_nut`, `drugreason1`, 
                    `drugreason2`, `drugreason3`, `drugreason4`, `drugreason5`, `drugreason6`, 
                    `drugreason7`, `drugreason8`, `drugreason9`, `drugreason10`, `drugreason11`, 
                    `drugreason12`, `drugreason13`, `drugreason14`, `drugreason15`, `drugreason_other`, `drugplace1`, 
                    `drugplace2`, `drugplace3`, `drugplace4`, `drugplace5`, `drugplace6`, `drugplace7`, 
                    `drugplace8`, `drugplace9`, `drugplace10`, `drugplace11`, `drugplace12`, `drugplace13`, 
                    `drugplace14`, `drugplace15`, `drugplace16`, `drugplace17`, `drugplace18`, `drugplace19`, `drugplace_other`, 
                    `drugsource1`, `drugsource2`, `drugsource3`, `drugsource4`, `drugsource5`, `drugsource6`, 
                    `drugsource7`, `drugsource8`, `drugsource9`, `drugsource_other`, `first_ketamine_age`, `ketamine_history`, 
                    `ketamine_ave`, `ketamine_method1`, `ketamine_method2`, `ketamine_method3`, `ketamine_method4`, `ketamine_method5`,
                    `ketamine_method6`, `ketamine_method_other`,`combined_drug`, `symptom_starting_date`, `stop_ketamine`, 
                    `stop_ketamine_month`, `IPSS_score1`, `IPSS_score2`, `IPSS_score3`, `IPSS_score4`, 
                    `IPSS_score5`, `IPSS_score6`, `IPSS_score7`, `urinary_quality_life`, `IC_symptom1`, 
                    `IC_symptom2`, `IC_symptom3`, `IC_symptom4`, `IC_question1`, `IC_question2`, `IC_question3`, 
                    `IC_question4`, `VAS`, `BSRS1`, `BSRS2`, `BSRS3`, `BSRS4`, `BSRS5`, `FSFI1`, `FSFI2`, 
                    `FSFI3`, `FSFI4`, `FSFI5`, `FSFI6`, `FSFI7`, `FSFI8`, `FSFI9`, `FSFI10`, `FSFI11`, `FSFI12`, 
                    `FSFI13`, `FSFI14`, `FSFI15`, `FSFI16`, `FSFI17`, `FSFI18`, `FSFI19`, `IIEF1`, `IIEF2`, 
                    `IIEF3`, `IIEF4`, `IIEF5`, `register_date`, `firstmedical`, `tx_date`, `tx_nsaid`, 
                    `tx_cox2`, `tx_opioid`, `tx_morphin`, `tx_antim`, `tx_double_antim`, `tx_mucosa_op`, 
                    `tx_mucosa_ic`, `tx_hydrodistention`, `tx_botox_id100u`, `tx_botox_it100u`, 
                    `tx_botox_idit100u`, `tx_ewithout`, `tx_epartial`, `tx_ewhole`, `tx_dj_one`, `tx_dj_both`, 
                    `tx_pcnd_one`, `tx_pcnd_both`, `tx_other`, `systolic_pressure`, `diastolic_pressure`, 
                    `gross_hematuria`, `other_symptoms`, `Diary_1D`, `Diary_1N`, `Diary_2D`, `Diary_2N`, `Diary_3D`, `Diary_3N`, 
                    `Diary_Max_VV`, `Urine_routine_WBC_HPF`, `Urine_routine_RBC_HPF`, `Urine_routine_Nit`, 
                    `Urine_routine_LEU`, `Urine_routine_Bact`, `Urine_culture`, `cytology`, `STD_HIV`, 
                    `STD_VDRL`, `STD_TPHA`, `Renal_function_BUN`, `Renal_function_Cr`, `Liver_function_GOT`, 
                    `Liver_function_GPT`, `Liver_function_ALB`, `Liver_function_BIL`, `Hematology_WBC`, 
                    `Hematology_Hgb`, `Hematology_Pl`, `Hematology_eosinophil`, `Immune_IgE`, 
                    `renal_echo_right_echogenicity`, `renal_echo_right_kidney`, `renal_echo_left_echogenicity`, 
                    `renal_echo_left_kidney`, `IVP_right_cortical_thinning`, `IVP_right_hydro_RK`, 
                    `IVP_right_UrStricture_up`, `IVP_right_UrStricture_middle`, `IVP_right_UrStricture_down`, 
                    `IVP_left_cortical_thinning`, `IVP_left_hydro_LK`, `IVP_left_UrStricture_up`, 
                    `IVP_left_UrStricture_middle`, `IVP_left_UrStricture_down`, `CT_right_cortical_thinning`, 
                    `CT_right_hydro_RK`, `CT_right_UrStricture_up`, `CT_right_UrStricture_middle`, 
                    `CT_right_UrStricture_down`, `CT_left_cortical_thinning`, `CT_left_hydro_LK`, 
                    `CT_left_UrStricture_up`, `CT_left_UrStricture_middle`, `CT_left_UrStricture_down`, `PVR`, 
                    `bladder_echo_BW_thickness`, `Uroflowmetry_Qmax`, `Uroflowmetry_VV`, `Uroflowmetry_Pattern`, 
                    `VCUG_trabeculation`, `VCUG_VUR_left`, `VCUG_VUR_right`, `VCUG_DSD`, `cystoscopy_ulcer`, 
                    `cystoscopy_glomerulation`, `cystoscopy_trabeculation`, `urodynamic_study_FD`, 
                    `urodynamic_study_MCC`, `urodynamic_study_MP`, `urodynamic_study_DO`, `US_DO_amplitude`, 
                    `US_DO_amplitude_at`, `urodynamic_study_DSD`, `urodynamic_study_compliance`, 
                    `biopsy_denuded_epi`, `biopsy_granulation`, `biopsy_fibronoid_necrosis`, 
                    `biopsy_eosinophil_infiltration`, `psychi`, `bile_duct_expand`, `gastroscopy`, 
                    `HP_examination`, `description`, `m_sn`, `keyName`, `doctorName`, `joindatetime`) VALUES (";
    $query_insert .= "'".$_POST["date"]."',";
    $query_insert .= "'".$_POST["h_name"]."',";
    $query_insert .= "'".$doctor."',";
    $query_insert .= "'".$md5id."',";
    $query_insert .= "'".$_POST["foreigner_id"]."',";
    $query_insert .= "'".$_POST["sex"]."',";
    $query_insert .= "'".$_POST["height"]."',";
    $query_insert .= "'".$_POST["weight"]."',";
    $query_insert .= "'".$_POST["birth_year"]."',";
    $query_insert .= "'".$_POST["birth_month"]."',";
    $query_insert .= "'".$location."',";
    $query_insert .= "'".$_POST["casetype1"]."',";
    $query_insert .= "'".$_POST["casetype2"]."',";
    $query_insert .= "'".$_POST["casetype3"]."',";
    $query_insert .= "'".$_POST["casetype4"]."',";
    $query_insert .= "'".$_POST["casetype5"]."',";
    $query_insert .= "'".$_POST["casetype6"]."',";
    $query_insert .= "'".$_POST["casetype7"]."',";
    $query_insert .= "'".$_POST["casetype8"]."',";
    $query_insert .= "'".$job."',";
    $query_insert .= "'".$_POST["edu"]."',";
    $query_insert .= "'".$marriage."',";
    $query_insert .= "'".$_POST["comor1"]."',";
    $query_insert .= "'".$_POST["comor2"]."',";
    $query_insert .= "'".$_POST["comor3"]."',";
    $query_insert .= "'".$_POST["comor4"]."',";
    $query_insert .= "'".$_POST["comor5"]."',";
    $query_insert .= "'".$_POST["comor6"]."',";
    $query_insert .= "'".$_POST["comor7"]."',";
    $query_insert .= "'".$_POST["comor8"]."',";
    $query_insert .= "'".$_POST["comor9"]."',";
    $query_insert .= "'".$_POST["comor10"]."',";
    $query_insert .= "'".$_POST["comor11"]."',";
    $query_insert .= "'".$_POST["comor12"]."',";
    $query_insert .= "'".$_POST["comor13"]."',";
    $query_insert .= "'".$_POST["comor14"]."',";
    $query_insert .= "'".$_POST["comor15"]."',";
    $query_insert .= "'".$_POST["comor_other"]."',";
    $query_insert .= "'".$_POST["regular_sex_partner"]."',";
    $query_insert .= "'".$_POST["smoking"]."',";
    $query_insert .= "'".$_POST["drinking"]."',";
    $query_insert .= "'".$_POST["betel_nut"]."',";
    $query_insert .= "'".$_POST["drugreason1"]."',";
    $query_insert .= "'".$_POST["drugreason2"]."',";
    $query_insert .= "'".$_POST["drugreason3"]."',";
    $query_insert .= "'".$_POST["drugreason4"]."',";
    $query_insert .= "'".$_POST["drugreason5"]."',";
    $query_insert .= "'".$_POST["drugreason6"]."',";
    $query_insert .= "'".$_POST["drugreason7"]."',";
    $query_insert .= "'".$_POST["drugreason8"]."',";
    $query_insert .= "'".$_POST["drugreason9"]."',";
    $query_insert .= "'".$_POST["drugreason10"]."',";
    $query_insert .= "'".$_POST["drugreason11"]."',";
    $query_insert .= "'".$_POST["drugreason12"]."',";
    $query_insert .= "'".$_POST["drugreason13"]."',";
    $query_insert .= "'".$_POST["drugreason14"]."',";
    $query_insert .= "'".$_POST["drugreason15"]."',";
    $query_insert .= "'".$_POST["drugreason_other"]."',";
    $query_insert .= "'".$_POST["drugplace1"]."',";
    $query_insert .= "'".$_POST["drugplace2"]."',";
    $query_insert .= "'".$_POST["drugplace3"]."',";
    $query_insert .= "'".$_POST["drugplace4"]."',";
    $query_insert .= "'".$_POST["drugplace5"]."',";
    $query_insert .= "'".$_POST["drugplace6"]."',";
    $query_insert .= "'".$_POST["drugplace7"]."',";
    $query_insert .= "'".$_POST["drugplace8"]."',";
    $query_insert .= "'".$_POST["drugplace9"]."',";
    $query_insert .= "'".$_POST["drugplace10"]."',";
    $query_insert .= "'".$_POST["drugplace11"]."',";
    $query_insert .= "'".$_POST["drugplace12"]."',";
    $query_insert .= "'".$_POST["drugplace13"]."',";
    $query_insert .= "'".$_POST["drugplace14"]."',";
    $query_insert .= "'".$_POST["drugplace15"]."',";
    $query_insert .= "'".$_POST["drugplace16"]."',";
    $query_insert .= "'".$_POST["drugplace17"]."',";
    $query_insert .= "'".$_POST["drugplace18"]."',";
    $query_insert .= "'".$_POST["drugplace19"]."',";
    $query_insert .= "'".$_POST["drugplace_other"]."',";
    $query_insert .= "'".$_POST["drugsource1"]."',";
    $query_insert .= "'".$_POST["drugsource2"]."',";
    $query_insert .= "'".$_POST["drugsource3"]."',";
    $query_insert .= "'".$_POST["drugsource4"]."',";
    $query_insert .= "'".$_POST["drugsource5"]."',";
    $query_insert .= "'".$_POST["drugsource6"]."',";
    $query_insert .= "'".$_POST["drugsource7"]."',";
    $query_insert .= "'".$_POST["drugsource8"]."',";
    $query_insert .= "'".$_POST["drugsource9"]."',";
    $query_insert .= "'".$_POST["drugsource_other"]."',";
    $query_insert .= "'".$_POST["first_ketamine_age"]."',";
    $query_insert .= "'".$ketamine_history."',";
    $query_insert .= "'".$_POST["ketamine_ave"]."',";
    $query_insert .= "'".$_POST["ketamine_method1"]."',";
    $query_insert .= "'".$_POST["ketamine_method2"]."',";
    $query_insert .= "'".$_POST["ketamine_method3"]."',";
    $query_insert .= "'".$_POST["ketamine_method4"]."',";
    $query_insert .= "'".$_POST["ketamine_method5"]."',";
    $query_insert .= "'".$_POST["ketamine_method6"]."',";
    $query_insert .= "'".$_POST["ketamine_method_other"]."',";
    $query_insert .= "'".$combined_drug."',";
    $query_insert .= "'".$_POST["symptom_starting_date"]."',";
    $query_insert .= "'".$_POST["stop_ketamine"]."',";
    $query_insert .= "'".$stop_ketamine_month."',";
    $query_insert .= "'".$_POST["IPSS_score1"]."',";
    $query_insert .= "'".$_POST["IPSS_score2"]."',";
    $query_insert .= "'".$_POST["IPSS_score3"]."',";
    $query_insert .= "'".$_POST["IPSS_score4"]."',";
    $query_insert .= "'".$_POST["IPSS_score5"]."',";
    $query_insert .= "'".$_POST["IPSS_score6"]."',";
    $query_insert .= "'".$_POST["IPSS_score7"]."',";
    $query_insert .= "'".$_POST["urinary_quality_life"]."',";
    $query_insert .= "'".$_POST["IC_symptom1"]."',";
    $query_insert .= "'".$_POST["IC_symptom2"]."',";
    $query_insert .= "'".$_POST["IC_symptom3"]."',";
    $query_insert .= "'".$_POST["IC_symptom4"]."',";
    $query_insert .= "'".$_POST["IC_question1"]."',";
    $query_insert .= "'".$_POST["IC_question2"]."',";
    $query_insert .= "'".$_POST["IC_question3"]."',";
    $query_insert .= "'".$_POST["IC_question4"]."',";
    $query_insert .= "'".$_POST["VAS"]."',";
    $query_insert .= "'".$_POST["BSRS1"]."',";
    $query_insert .= "'".$_POST["BSRS2"]."',";
    $query_insert .= "'".$_POST["BSRS3"]."',";
    $query_insert .= "'".$_POST["BSRS4"]."',";
    $query_insert .= "'".$_POST["BSRS5"]."',";
    $query_insert .= "'".$_POST["FSFI1"]."',";
    $query_insert .= "'".$_POST["FSFI2"]."',";
    $query_insert .= "'".$_POST["FSFI3"]."',";
    $query_insert .= "'".$_POST["FSFI4"]."',";
    $query_insert .= "'".$_POST["FSFI5"]."',";
    $query_insert .= "'".$_POST["FSFI6"]."',";
    $query_insert .= "'".$_POST["FSFI7"]."',";
    $query_insert .= "'".$_POST["FSFI8"]."',";
    $query_insert .= "'".$_POST["FSFI9"]."',";
    $query_insert .= "'".$_POST["FSFI10"]."',";
    $query_insert .= "'".$_POST["FSFI11"]."',";
    $query_insert .= "'".$_POST["FSFI12"]."',";
    $query_insert .= "'".$_POST["FSFI13"]."',";
    $query_insert .= "'".$_POST["FSFI14"]."',";
    $query_insert .= "'".$_POST["FSFI15"]."',";
    $query_insert .= "'".$_POST["FSFI16"]."',";
    $query_insert .= "'".$_POST["FSFI17"]."',";
    $query_insert .= "'".$_POST["FSFI18"]."',";
    $query_insert .= "'".$_POST["FSFI19"]."',";
    $query_insert .= "'".$_POST["IIEF1"]."',";
    $query_insert .= "'".$_POST["IIEF2"]."',";
    $query_insert .= "'".$_POST["IIEF3"]."',";
    $query_insert .= "'".$_POST["IIEF4"]."',";
    $query_insert .= "'".$_POST["IIEF5"]."',";
    $query_insert .= "'".$_POST["register_date"]."',";
    $query_insert .= "'".$_POST["firstmedical"]."',";
    $query_insert .= "'".$_POST["tx_date"]."',";
    $query_insert .= "'".$_POST["tx_nsaid"]."',";
    $query_insert .= "'".$_POST["tx_cox2"]."',";
    $query_insert .= "'".$_POST["tx_opioid"]."',";
    $query_insert .= "'".$_POST["tx_morphin"]."',";
    $query_insert .= "'".$_POST["tx_antim"]."',";
    $query_insert .= "'".$_POST["tx_double_antim"]."',";
    $query_insert .= "'".$_POST["tx_mucosa_op"]."',";
    $query_insert .= "'".$_POST["tx_mucosa_ic"]."',";
    $query_insert .= "'".$_POST["tx_hydrodistention"]."',";
    $query_insert .= "'".$_POST["tx_botox_id100u"]."',";
    $query_insert .= "'".$_POST["tx_botox_it100u"]."',";
    $query_insert .= "'".$_POST["tx_botox_idit100u"]."',";
    $query_insert .= "'".$_POST["tx_ewithout"]."',";
    $query_insert .= "'".$_POST["tx_epartial"]."',";
    $query_insert .= "'".$_POST["tx_ewhole"]."',";
    $query_insert .= "'".$_POST["tx_dj_one"]."',";
    $query_insert .= "'".$_POST["tx_dj_both"]."',";
    $query_insert .= "'".$_POST["tx_pcnd_one"]."',";
    $query_insert .= "'".$_POST["tx_pcnd_both"]."',";
    $query_insert .= "'".$_POST["tx_other"]."',";
    $query_insert .= "'".$_POST["systolic_pressure"]."',";
    $query_insert .= "'".$_POST["diastolic_pressure"]."',";
    $query_insert .= "'".$_POST["gross_hematuria"]."',";
    $query_insert .= "'".$_POST["other_symptoms"]."',";
    $query_insert .= "'".$_POST["Diary_1D"]."',";
    $query_insert .= "'".$_POST["Diary_1N"]."',";
    $query_insert .= "'".$_POST["Diary_2D"]."',";
    $query_insert .= "'".$_POST["Diary_2N"]."',";
    $query_insert .= "'".$_POST["Diary_3D"]."',";
    $query_insert .= "'".$_POST["Diary_3N"]."',";
    $query_insert .= "'".$_POST["Diary_Max_VV"]."',";
    $query_insert .= "'".$_POST["Urine_routine_WBC_HPF"]."',";
    $query_insert .= "'".$_POST["Urine_routine_RBC_HPF"]."',";
    $query_insert .= "'".$_POST["Urine_routine_Nit"]."',";
    $query_insert .= "'".$_POST["Urine_routine_LEU"]."',";
    $query_insert .= "'".$_POST["Urine_routine_Bact"]."',";
    $query_insert .= "'".$Urine_culture."',";
    $query_insert .= "'".$_POST["cytology"]."',";
    $query_insert .= "'".$_POST["STD_HIV"]."',";
    $query_insert .= "'".$_POST["STD_VDRL"]."',";
    $query_insert .= "'".$_POST["STD_TPHA"]."',";
    $query_insert .= "'".$_POST["Renal_function_BUN"]."',";
    $query_insert .= "'".$_POST["Renal_function_Cr"]."',";
    $query_insert .= "'".$_POST["Liver_function_GOT"]."',";
    $query_insert .= "'".$_POST["Liver_function_GPT"]."',";
    $query_insert .= "'".$_POST["Liver_function_ALB"]."',";
    $query_insert .= "'".$_POST["Liver_function_BIL"]."',";
    $query_insert .= "'".$_POST["Hematology_WBC"]."',";
    $query_insert .= "'".$_POST["Hematology_Hgb"]."',";
    $query_insert .= "'".$_POST["Hematology_Pl"]."',";
    $query_insert .= "'".$_POST["Hematology_eosinophil"]."',";
    $query_insert .= "'".$_POST["Immune_IgE"]."',";
    $query_insert .= "'".$_POST["renal_echo_right_echogenicity"]."',";
    $query_insert .= "'".$_POST["renal_echo_right_kidney"]."',";
    $query_insert .= "'".$_POST["renal_echo_left_echogenicity"]."',";
    $query_insert .= "'".$_POST["renal_echo_left_kidney"]."',";
    $query_insert .= "'".$_POST["IVP_right_cortical_thinning"]."',";
    $query_insert .= "'".$_POST["IVP_right_hydro_RK"]."',";
    $query_insert .= "'".$_POST["IVP_right_UrStricture_up"]."',";
    $query_insert .= "'".$_POST["IVP_right_UrStricture_middle"]."',";
    $query_insert .= "'".$_POST["IVP_right_UrStricture_down"]."',";
    $query_insert .= "'".$_POST["IVP_left_cortical_thinning"]."',";
    $query_insert .= "'".$_POST["IVP_left_hydro_LK"]."',";
    $query_insert .= "'".$_POST["IVP_left_UrStricture_up"]."',";
    $query_insert .= "'".$_POST["IVP_left_UrStricture_middle"]."',";
    $query_insert .= "'".$_POST["IVP_left_UrStricture_down"]."',";
    $query_insert .= "'".$_POST["CT_right_cortical_thinning"]."',";
    $query_insert .= "'".$_POST["CT_right_hydro_RK"]."',";
    $query_insert .= "'".$_POST["CT_right_UrStricture_up"]."',";
    $query_insert .= "'".$_POST["CT_right_UrStricture_middle"]."',";
    $query_insert .= "'".$_POST["CT_right_UrStricture_down"]."',";
    $query_insert .= "'".$_POST["CT_left_cortical_thinning"]."',";
    $query_insert .= "'".$_POST["CT_left_hydro_LK"]."',";
    $query_insert .= "'".$_POST["CT_left_UrStricture_up"]."',";
    $query_insert .= "'".$_POST["CT_left_UrStricture_middle"]."',";
    $query_insert .= "'".$_POST["CT_left_UrStricture_down"]."',";
    $query_insert .= "'".$_POST["PVR"]."',";
    $query_insert .= "'".$_POST["bladder_echo_BW_thickness"]."',";
    $query_insert .= "'".$_POST["Uroflowmetry_Qmax"]."',";
    $query_insert .= "'".$_POST["Uroflowmetry_VV"]."',";
    $query_insert .= "'".$_POST["Uroflowmetry_Pattern"]."',";
    $query_insert .= "'".$_POST["VCUG_trabeculation"]."',";
    $query_insert .= "'".$_POST["VCUG_VUR_left"]."',";
    $query_insert .= "'".$_POST["VCUG_VUR_right"]."',";
    $query_insert .= "'".$_POST["VCUG_DSD"]."',";
    $query_insert .= "'".$_POST["cystoscopy_ulcer"]."',";
    $query_insert .= "'".$_POST["cystoscopy_glomerulation"]."',";
    $query_insert .= "'".$_POST["cystoscopy_trabeculation"]."',";
    $query_insert .= "'".$_POST["urodynamic_study_FD"]."',";
    $query_insert .= "'".$_POST["urodynamic_study_MCC"]."',";
    $query_insert .= "'".$_POST["urodynamic_study_MP"]."',";
    $query_insert .= "'".$_POST["urodynamic_study_DO"]."',";
    $query_insert .= "'".$_POST["US_DO_amplitude"]."',";
    $query_insert .= "'".$_POST["US_DO_amplitude_at"]."',";
    $query_insert .= "'".$_POST["urodynamic_study_DSD"]."',";
    $query_insert .= "'".$_POST["urodynamic_study_compliance"]."',";
    $query_insert .= "'".$_POST["biopsy_denuded_epi"]."',";
    $query_insert .= "'".$_POST["biopsy_granulation"]."',";
    $query_insert .= "'".$_POST["biopsy_fibronoid_necrosis"]."',";
    $query_insert .= "'".$_POST["biopsy_eosinophil_infiltration"]."',";
    $query_insert .= "'".$_POST["psychi"]."',";
    $query_insert .= "'".$_POST["bile_duct_expand"]."',";
    $query_insert .= "'".$_POST["gastroscopy"]."',";
    $query_insert .= "'".$_POST["HP_examination"]."',";
    $query_insert .= "'".$_POST["description"]."',";
    $query_insert .= "'".$row_RecMember["m_sn"]."',";
    $query_insert .= "'".$row_RecMember["m_name"]."',";
    $query_insert .= "'".$doctorName."',";
    $query_insert .="NOW())";
    
    //echo "<br>";
    //echo $query_insert;
    //exit();
    mysqli_query($conn, $query_insert);
    header("Location: medical_list.php?medicalStats=0");
  }
?>