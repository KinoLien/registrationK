$(function() {
        $.datepicker.regional['zh-TW']={
            dayNames:["星期日","星期一","星期二","星期三","星期四","星期五","星期六"],
            dayNamesMin:["日","一","二","三","四","五","六"],
            monthNames:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
            monthNamesShort:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
            prevText:"上月",
            nextText:"次月",
            weekHeader:"週"
            };
      $.datepicker.setDefaults($.datepicker.regional["zh-TW"]);
    	$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true, maxDate:"0"});
        $( "#datepicker0" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true, maxDate:"0"});
        $( "#datepicker1" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true, maxDate:"0"});
        $( "#datepicker2" ).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, changeMonth: true, maxDate:"0"});
        
});

$(document).ready(
  function(){
    /*--- 單選 ”其他“ 欄位問題 ---*/
    //居住地
		$("[name=location]").on('change', function() {
		    if ($("[name=location]").val() == "other") {
		      $("#location_other").show();
		    } else {
          $("[name=location1]").val(null);
		      $("#location_other").hide();
		    }
    });
    //職業
    $("input[type=radio][name=job]").change(function(){
        if (this.value == 'other') {
          $("#job0").show();
        }else{
          $("[name=job1]").val(null);
          $("#job0").hide();
        }
    });
    //婚姻狀況
    $("input[type=radio][name=marriage]").change(function(){
      if (this.value == 'other') {
        $("#marriage0").show();
      }else{
        $("[name=marriage1]").val(null);
        $("#marriage0").hide();
      }
    });
    /*
    //使用方式
    $("input[type=radio][name=ketamine_method]").change(function(){
      if (this.value == 'other') {
        $("#ketamine_method0").show();
      }else{
        $("[name=ketamine_method1]").val(null);
        $("#ketamine_method0").hide();
      }
    });*/
    //合併使用其他種類藥物
    $("input[type=radio][name=combined_drug]").change(function(){
      if (this.value == 'other') {
        $("#combined_drug0").show();
      }else{
        $("[name=combined_drug1]").val(null);
        $("#combined_drug0").hide();
      }
    });
    //Urine Culture
    $("input[type=radio][name=Urine_culture]").change(function(){
      if (this.value == 'other') {
        $("#UCulture0").show();
      }else{
        $("[name=Urine_culture1]").val(null);
        $("#UCulture0").hide();
      }
    });
    //Urodynamic Study-DO
    $("input[type=radio][name=urodynamic_study_DO]").change(function(){
      if (this.value == '1') {
        $("#urodynamic_do0").show();
      }else{
        $("[name=US_DO_amplitude]").val(null);
        $("[name=US_DO_amplitude_at]").val(null);
        $("#urodynamic_do0").hide();
      }
    });
    //是否已戒除Ｋ他命
    $("input[type=radio][name=stop_ketamine]").change(function(){
      if (this.value == '1') {
        $("#stopK").show();
      }else{
        $("[name=stop_ketamine_year]").val(0);
        $("[name=stop_ketamine_month]").val(0);
        $("#stopK").hide();
      }
    });

    /*---多選 "其他" 欄位問題---*/
    //併存疾病
    $("input[type=checkbox][name=comor15]").change(function(){
      if ($("#comorbidity16").is(":checked")) {
        $("#comor").show();
      }else{
        $("[name=comor_other]").val(null);
        $("#comor").hide();
      }
    });
    //濫用藥物原因
    $("#drug_reason15").change(function(){
      if ($("#drug_reason15").is(":checked")) {
        $("#drug_reason0").show();
      }else{
        $("[name=drugreason_other]").val(null);
        $("#drug_reason0").hide();
      }
    });
    //取得藥物場所
    $("#drug_place19").change(function(){
      if ($("#drug_place19").is(":checked")) {
        $("#drug_place0").show();
      }else{
        $("[name=drugplace_other]").val(null);
        $("#drug_place0").hide();
      }
    });
    //取得藥物之來源
    $("#drug_source9").change(function(){
      if ($("#drug_source9").is(":checked")) {
        $("#drug_source0").show();
      }else{
        $("[name=drugsource_other]").val(null);
        $("#drug_source0").hide();
      }
    });
    //主要使用方式
    $("#ketaminemethod6").change(function(){
      if ($("#ketaminemethod6").is(":checked")) {
        $("#ketamine_method0").show();
      }else{
        $("[name=ketamine_method_other]").val(null);
        $("#ketamine_method0").hide();
      }
    });
    //第一次收案
    $("#fm1").change(function(){
      if ($("#fm1").is(":checked")) {
        $("#treatment").hide();
        $("[name=tx_date]").val(null);
        $("[name=tx_nsaid]").attr('checked', false);
        $("[name=tx_cox2]").attr('checked', false);
        $("[name=tx_opioid]").attr('checked', false);
        $("[name=tx_morphin]").attr('checked', false);
        $("[name=tx_antim]").attr('checked', false);
        $("[name=tx_double_antim]").attr('checked', false);
        $("[name=tx_mucosa_op]").attr('checked', false);
        $("[name=tx_mucosa_ic]").attr('checked', false);
        $("[name=tx_hydrodistention]").attr('checked', false);
        $("[name=tx_botox_id100u]").attr('checked', false);
        $("[name=tx_botox_it100u]").attr('checked', false);
        $("[name=tx_botox_idit100u]").attr('checked', false);
        $("[name=tx_ewithout]").attr('checked', false);
        $("[name=tx_epartial]").attr('checked', false);
        $("[name=tx_ewhole]").attr('checked', false);
        $("[name=tx_dj_one]").attr('checked', false);
        $("[name=tx_dj_both]").attr('checked', false);
        $("[name=tx_pcnd_one]").attr('checked', false);
        $("[name=tx_pcnd_both]").attr('checked', false);
        $("[name=tx_other]").val(null);

      }else{
        $("#treatment").show();
      }
    });
    /*----NA處理---*/
    //個案別-NA
    //併存疾病-NA
    //濫用原因-NA
    //取得地點-NA
    //藥物來源-NA

    //Urinalysis-NA
    $("[name=urinalysis_na]").on('change', function(){
        if($("[name=urinalysis_na]").prop('checked')){
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
      }else{
        $("[name=Urine_routine_WBC_HPF][type=radio]").prop("disabled", false);
        $("[name=Urine_routine_RBC_HPF][type=radio]").prop("disabled", false);
        $("[name=Urine_routine_Nit][type=radio]").prop("disabled", false);
        $("[name=Urine_routine_LEU][type=radio]").prop("disabled", false);
        $("[name=Urine_routine_Bact][type=radio]").prop("disabled", false);
      }
    });
    //Urine Culture-NA
    $("[name=Urine_culture][type=checkbox]").on('change', function(){
        if($("[name=Urine_culture][type=checkbox]").prop('checked')){
        $("[name=Urine_culture][type=radio]").prop("disabled", true);
        $("[name=Urine_culture][type=radio]").attr('checked', false);
        $("[name=Urine_culture1][type=text]").val(null);
      }else{
        $("[name=Urine_culture]").prop("disabled", false);
      }

      
      if (this.value == 'other') {
        $("#UCulture0").show();
      }else{
        $("[name=Urine_culture1]").val(null);
        $("#UCulture0").hide();
      }
    });
    //Urine Cytology-NA
    $("[name=cytology][type=checkbox]").on('change', function(){
        if($("[name=cytology][type=checkbox]").prop('checked')){
        $("[name=cytology][type=radio]").prop("disabled", true);
        $("[name=cytology][type=radio]").attr('checked', false);
      }else{
        $("[name=cytology][type=radio]").prop("disabled", false);
      }
    });
    //sexial transmitted disease-HIV-NA
    $("[name=STD_HIV_na]").on('change', function(){
        if($("[name=STD_HIV_na]").prop('checked')){
            $("[name=STD_HIV][type=radio]").prop("disabled", true);
            $("[name=STD_HIV][type=radio]").attr('checked', false);
        }else{
            $("[name=STD_HIV][type=radio]").prop("disabled", false);
        }
    });
    //sexial transmitted disease-VDRL-NA
    $("[name=STD_VDRL_na]").on('change', function(){
        if($("[name=STD_VDRL_na]").prop('checked')){
            $("[name=STD_VDRL][type=radio]").prop("disabled", true);
            $("[name=STD_VDRL][type=radio]").attr('checked', false);
        }else{
            $("[name=STD_VDRL][type=radio]").prop("disabled", false);
        }
    });
    //sexial transmitted disease-TPHA-NA
    $("[name=STD_TPHA_na]").on('change', function(){
        if($("[name=STD_TPHA_na]").prop('checked')){
            $("[name=STD_TPHA][type=radio]").prop("disabled", true);
            $("[name=STD_TPHA][type=radio]").attr('checked', false);
        }else{
            $("[name=STD_TPHA][type=radio]").prop("disabled", false);
        }
    });
    //Renal function-NA
    $("[name=RF_na]").on('change', function(){
        if($("[name=RF_na]").prop('checked')){
        $("[name=Renal_function_BUN]").prop("disabled", true);
        $("[name=Renal_function_Cr]").prop("disabled", true);
        $("[name=Renal_function_BUN]").val(null);
        $("[name=Renal_function_Cr]").val(null);
      }else{
        $("[name=Renal_function_BUN]").prop("disabled", false);
        $("[name=Renal_function_Cr]").prop("disabled", false);
      }
    });
    //Liver function-NA
    $("[name=LF_na]").on('change', function(){
        if($("[name=LF_na]").prop('checked')){
        $("[name=Liver_function_GOT]").prop("disabled", true);
        $("[name=Liver_function_GPT]").prop("disabled", true);
        $("[name=Liver_function_ALB]").prop("disabled", true);
        $("[name=Liver_function_BIL]").prop("disabled", true);
        $("[name=Liver_function_GOT]").val(null);
        $("[name=Liver_function_GPT]").val(null);
        $("[name=Liver_function_ALB]").val(null);
        $("[name=Liver_function_BIL]").val(null);
      }else{
        $("[name=Liver_function_GOT]").prop("disabled", false);
        $("[name=Liver_function_GPT]").prop("disabled", false);
        $("[name=Liver_function_ALB]").prop("disabled", false);
        $("[name=Liver_function_BIL]").prop("disabled", false);
      }
    });
    //Hematology-NA
    $("[name=hematology_na]").on('change', function(){
        if($("[name=hematology_na]").prop('checked')){
        $("[name=Hematology_WBC]").prop("disabled", true);
        $("[name=Hematology_Hgb]").prop("disabled", true);
        $("[name=Hematology_Pl]").prop("disabled", true);
        $("[name=Hematology_eosinophil]").prop("disabled", true);
        $("[name=Hematology_WBC]").val(null);
        $("[name=Hematology_Hgb]").val(null);
        $("[name=Hematology_Pl]").val(null);
        $("[name=Hematology_eosinophil]").val(null);
      }else{
        $("[name=Hematology_WBC]").prop("disabled", false);
        $("[name=Hematology_Hgb]").prop("disabled", false);
        $("[name=Hematology_Pl]").prop("disabled", false);
        $("[name=Hematology_eosinophil]").prop("disabled", false);
      }
    });
    //Immunology
    $("[name=immunology_na]").on('change', function(){
        if($("[name=immunology_na]").prop('checked')){
        $("[name=Immune_IgE]").prop("disabled", true);
        $("[name=Immune_IgE]").val(null);
      }else{
        $("[name=Immune_IgE]").prop("disabled", false);
      }
    });
    //Renal Sonography-NA
    $("[name=RS_na]").on('change', function(){
        if($("[name=RS_na]").prop('checked')){
        $("[name=renal_echo_right_echogenicity][type=radio]").prop("disabled", true);
        $("[name=renal_echo_right_kidney][type=radio]").prop("disabled", true);
        $("[name=renal_echo_right_echogenicity][type=radio]").attr('checked', false);
        $("[name=renal_echo_right_kidney][type=radio]").attr('checked', false);

        $("[name=renal_echo_left_echogenicity][type=radio]").prop("disabled", true);
        $("[name=renal_echo_left_kidney][type=radio]").prop("disabled", true);
        $("[name=renal_echo_left_echogenicity][type=radio]").attr('checked', false);
        $("[name=renal_echo_left_kidney][type=radio]").attr('checked', false);
      }else{
        $("[name=renal_echo_right_echogenicity]").prop("disabled", false);
        $("[name=renal_echo_right_kidney]").prop("disabled", false);

        $("[name=renal_echo_left_echogenicity]").prop("disabled", false);
        $("[name=renal_echo_left_kidney]").prop("disabled", false);
      }
    });
    //IVP-NA
    $("[name=IVP_na]").on('change', function(){
        if($("[name=IVP_na]").prop('checked')){
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
      }else{
        $("[name=ivp_right]").prop("disabled", false);
        $("[name=IVP_right_cortical_thinning]").prop("disabled", false);
        $("[name=IVP_right_hydro_RK]").prop("disabled", false);
        $("[name=IVP_right_UrStricture_up]").prop("disabled", false);
        $("[name=IVP_right_UrStricture_middle]").prop("disabled", false);
        $("[name=IVP_right_UrStricture_down]").prop("disabled", false);

        $("[name=ivp_left]").prop("disabled", false);
        $("[name=IVP_left_cortical_thinning]").prop("disabled", false);
        $("[name=IVP_left_hydro_LK]").prop("disabled", false);
        $("[name=IVP_left_UrStricture_up]").prop("disabled", false);
        $("[name=IVP_left_UrStricture_middle]").prop("disabled", false);
        $("[name=IVP_left_UrStricture_down]").prop("disabled", false);
      }
    });
    //CT-NA
    $("[name=CT_na]").on('change', function(){
        if($("[name=CT_na]").prop('checked')){
        $("[name=ct_right]").prop("disabled", true);
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
      }else{
        $("[name=ct_right]").prop("disabled", false);
        $("[name=CT_right_cortical_thinning]").prop("disabled", false);
        $("[name=CT_right_hydro_RK]").prop("disabled", false);
        $("[name=CT_right_UrStricture_up]").prop("disabled", false);
        $("[name=CT_right_UrStricture_middle]").prop("disabled", false);
        $("[name=CT_right_UrStricture_down]").prop("disabled", false);

        $("[name=ct_left]").prop("disabled", false);
        $("[name=CT_left_cortical_thinning]").prop("disabled", false);
        $("[name=CT_left_hydro_LK]").prop("disabled", false);
        $("[name=CT_left_UrStricture_up]").prop("disabled", false);
        $("[name=CT_left_UrStricture_middle]").prop("disabled", false);
        $("[name=CT_left_UrStricture_down]").prop("disabled", false);
      }
    });
    //Ultrasound of Bladder-NA
    $("[name=UB_na]").on('change', function(){
        if($("[name=UB_na]").prop('checked')){
        $("[name=PVR]").prop("disabled", true);
        $("[name=bladder_echo_BW_thickness]").prop("disabled", true);
        $("[name=PVR]").val(null);
        $("[name=bladder_echo_BW_thickness]").val(null);
      }else{
        $("[name=PVR]").prop("disabled", false);
        $("[name=bladder_echo_BW_thickness]").prop("disabled", false);
      }
    });
    //Uroflowmetry-NA
    $("[name=uroflowmetry_na]").on('change', function(){
        if($("[name=uroflowmetry_na]").prop('checked')){
        $("[name=Uroflowmetry_Qmax]").prop("disabled", true);
        $("[name=Uroflowmetry_VV]").prop("disabled", true);
        $("[name=Uroflowmetry_Pattern][type=radio]").prop("disabled", true);
        $("[name=Uroflowmetry_Qmax]").val(null);
        $("[name=Uroflowmetry_VV]").val(null);
        $("[name=Uroflowmetry_Pattern][type=radio]").attr('checked', false);
      }else{
        $("[name=Uroflowmetry_Qmax]").prop("disabled", false);
        $("[name=Uroflowmetry_VV]").prop("disabled", false);
        $("[name=Uroflowmetry_Pattern][type=radio]").prop("disabled", false);
        
      }
    });
    //VCUG-NA
    $("[name=vcug_na]").on('change', function(){
        if($("[name=vcug_na]").prop('checked')){
        $("[name=VCUG_trabeculation][type=radio]").prop("disabled", true);
        $("[name=VCUG_VUR_left][type=radio]").prop("disabled", true);
        $("[name=VCUG_VUR_right][type=radio]").prop("disabled", true);
        $("[name=VCUG_DSD][type=radio]").prop("disabled", true);
        $("[name=VCUG_trabeculation][type=radio]").attr('checked', false);
        $("[name=VCUG_VUR_left][type=radio]").attr('checked', false);
        $("[name=VCUG_VUR_right][type=radio]").attr('checked', false);
        $("[name=VCUG_DSD][type=radio]").attr('checked', false);
      }else{
        $("[name=VCUG_trabeculation][type=radio]").prop("disabled", false);
        $("[name=VCUG_VUR_left][type=radio]").prop("disabled", false);
        $("[name=VCUG_VUR_right][type=radio]").prop("disabled", false);
        $("[name=VCUG_DSD][type=radio]").prop("disabled", false);
      }
    });
    //Cystoscopy-NA
    $("[name=cystoscopy_na]").on('change', function(){
        if($("[name=cystoscopy_na]").prop('checked')){
        $("[name=cystoscopy_normal][type=checkbox]").prop("disabled", true);
        $("[name=cystoscopy_ulcer][type=radio]").prop("disabled", true);
        $("[name=cystoscopy_glomerulation][type=radio]").prop("disabled", true);
        $("[name=cystoscopy_trabeculation][type=radio]").prop("disabled", true);
        $("[name=cystoscopy_normal][type=checkbox]").attr('checked', false);
        $("[name=cystoscopy_ulcer][type=radio]").attr('checked', false);
        $("[name=cystoscopy_glomerulation][type=radio]").attr('checked', false);
        $("[name=cystoscopy_trabeculation][type=radio]").attr('checked', false);
      }else{
        $("[name=cystoscopy_normal][type=checkbox]").prop("disabled", false);
        $("[name=cystoscopy_ulcer][type=radio]").prop("disabled", false);
        $("[name=cystoscopy_glomerulation][type=radio]").prop("disabled", false);
        $("[name=cystoscopy_trabeculation][type=radio]").prop("disabled", false);
      }
    });
    //Urodynamic Study-NA
    $("[name=US_na]").on('change', function(){
        if($("[name=US_na]").prop('checked')){
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
      }else{
        $("[name=urodynamic_study_FD]").prop("disabled", false);
        $("[name=urodynamic_study_MCC]").prop("disabled", false);
        $("[name=urodynamic_study_MP]").prop("disabled", false);
        $("[name=urodynamic_study_DO][type=radio]").prop("disabled", false);
        $("[name=US_DO_amplitude]").prop("disabled", false);
        $("[name=US_DO_amplitude_at]").prop("disabled", false);
        $("[name=urodynamic_study_DSD][type=radio]").prop("disabled", false);
        $("[name=urodynamic_study_compliance][type=radio]").prop("disabled", false);

      }
      if (this.value == '1') {
          $("#urodynamic_do0").show();
        }else{
          $("[name=US_DO_amplitude]").val(null);
          $("[name=US_DO_amplitude_at]").val(null);
          $("#urodynamic_do0").hide();
        }
    });
    //Biopsy-NA
    $("[name=biopsy_na]").on('change', function(){
        if($("[name=biopsy_na]").prop('checked')){
        $("[name=biopsy_denuded_epi][type=radio]").prop("disabled", true);
        $("[name=biopsy_granulation][type=radio]").prop("disabled", true);
        $("[name=biopsy_fibronoid_necrosis][type=radio]").prop("disabled", true);
        $("[name=biopsy_eosinophil_infiltration][type=radio]").prop("disabled", true);
        $("[name=biopsy_denuded_epi][type=radio]").attr('checked', false);
        $("[name=biopsy_granulation][type=radio]").attr('checked', false);
        $("[name=biopsy_fibronoid_necrosis][type=radio]").attr('checked', false);
        $("[name=biopsy_eosinophil_infiltration][type=radio]").attr('checked', false);
      }else{
        $("[name=biopsy_denuded_epi][type=radio]").prop("disabled", false);
        $("[name=biopsy_granulation][type=radio]").prop("disabled", false);
        $("[name=biopsy_fibronoid_necrosis][type=radio]").prop("disabled", false);
        $("[name=biopsy_eosinophil_infiltration][type=radio]").prop("disabled", false);
      }
    });
    //其他-psychiatric consultation-NA
    $("[name=PC_na]").on('change', function(){
        if($("[name=PC_na]").prop('checked')){
        $("[name=psychi][type=radio]").prop("disabled", true);
        $("[name=psychi][type=radio]").attr('checked', false);
      }else{
        $("[name=psychi][type=radio]").prop("disabled", false);
      }
    });
    //Abdominal echo-BDD
    $("[name=BDD_na]").on('change', function(){
        if($("[name=BDD_na]").prop('checked')){
        $("[name=bile_duct_expand][type=radio]").prop("disabled", true);
        $("[name=bile_duct_expand][type=radio]").attr('checked', false);
      }else{
        $("[name=bile_duct_expand][type=radio]").prop("disabled", false);
      }
    });
    //Ulceration
    $("[name=ulceration_na]").on('change', function(){
        if($("[name=ulceration_na]").prop('checked')){
        $("[name=gastroscopy][type=radio]").prop("disabled", true);
        $("[name=gastroscopy][type=radio]").attr('checked', false);
        $("[name=HP_examination][type=radio]").prop("disabled", true);
        $("[name=HP_examination][type=radio]").attr('checked', false);
        $("[name=HP_na][type=checkbox]").prop("disabled", true);
        $("[name=HP_na][type=checkbox]").attr('checked', false);
      }else{
        $("[name=gastroscopy][type=radio]").prop("disabled", false);
        $("[name=HP_examination][type=radio]").prop("disabled", false);
        $("[name=HP_na][type=checkbox]").prop("disabled", false);
      }
    });
    //HP Stain
    $("[name=HP_na]").on('change', function(){
        if($("[name=HP_na]").prop('checked')){
        $("[name=HP_examination][type=radio]").prop("disabled", true);
        $("[name=HP_examination][type=radio]").attr('checked', false);
      }else{
        $("[name=HP_examination][type=radio]").prop("disabled", false);
      }
    });

    //Cystoscopy-normal
    $("[name=cystoscopy_normal]").on('change', function(){
        if($("[name=cystoscopy_normal]").is(":checked")){
        $("[name=cystoscopy_ulcer]").prop("disabled", true);
        $("[name=cystoscopy_glomerulation]").prop("disabled", true);
        $("[name=cystoscopy_trabeculation]").prop("disabled", true);
        $("[name=cystoscopy_ulcer]").attr('checked', false);
        $("[name=cystoscopy_glomerulation]").attr('checked', false);
        $("[name=cystoscopy_trabeculation]").attr('checked', false);
        $("[name=cystoscopy_ulcer][id=Cystoscopy_U1]").prop('checked', true);
        $("#Cystoscopy_G1").prop('checked', true);
        $("#Cystoscopy_T1").prop('checked', true);
      }else{
        $("[name=cystoscopy_ulcer]").prop("disabled", false);
        $("[name=cystoscopy_glomerulation]").prop("disabled", false);
        $("[name=cystoscopy_trabeculation]").prop("disabled", false);
        $("#Cystoscopy_U1").attr('checked', false);
        $("#Cystoscopy_G1").attr('checked', false);
        $("#Cystoscopy_T1").attr('checked', false);
      }
    });
    //Hide different sex questionnaire
    $("#radio1").on('change', function() {
      $(".fsfi_info").show();
      $(".iief_info").hide();
    });

    $("#radio2").on('change', function(){
      $(".fsfi_info").hide();
      $(".iief_info").show();
    });
    //併存疾病 點選 disabled 後面選項
    $("[name=comor]").on('change', function(){
        if($("[name=comor]").is(":checked")){
            $('#comorbidity2').attr('checked', false);
            $('#comorbidity3').attr('checked', false);
            $('#comorbidity4').attr('checked', false);
            $('#comorbidity5').attr('checked', false);
            $('#comorbidity6').attr('checked', false);
            $('#comorbidity7').attr('checked', false);
            $('#comorbidity8').attr('checked', false);
            $('#comorbidity9').attr('checked', false);
            $('#comorbidity10').attr('checked', false);
            $('#comorbidity11').attr('checked', false);
            $('#comorbidity12').attr('checked', false);
            $('#comorbidity13').attr('checked', false);
            $('#comorbidity14').attr('checked', false);
            $('#comorbidity15').attr('checked', false);
            $('#comorbidity16').attr('checked', false);

            $('#comorbidity2').prop("disabled", true);
            $('#comorbidity3').prop("disabled", true);
            $('#comorbidity4').prop("disabled", true);
            $('#comorbidity5').prop("disabled", true);
            $('#comorbidity6').prop("disabled", true);
            $('#comorbidity7').prop("disabled", true);
            $('#comorbidity8').prop("disabled", true);
            $('#comorbidity9').prop("disabled", true);
            $('#comorbidity10').prop("disabled", true);
            $('#comorbidity11').prop("disabled", true);
            $('#comorbidity12').prop("disabled", true);
            $('#comorbidity13').prop("disabled", true);
            $('#comorbidity14').prop("disabled", true);
            $('#comorbidity15').prop("disabled", true);
            $('#comorbidity16').prop("disabled", true);
        }else{
            $('#comorbidity2').prop("disabled", false);
            $('#comorbidity3').prop("disabled", false);
            $('#comorbidity4').prop("disabled", false);
            $('#comorbidity5').prop("disabled", false);
            $('#comorbidity6').prop("disabled", false);
            $('#comorbidity7').prop("disabled", false);
            $('#comorbidity8').prop("disabled", false);
            $('#comorbidity9').prop("disabled", false);
            $('#comorbidity10').prop("disabled", false);
            $('#comorbidity11').prop("disabled", false);
            $('#comorbidity12').prop("disabled", false);
            $('#comorbidity13').prop("disabled", false);
            $('#comorbidity14').prop("disabled", false);
            $('#comorbidity15').prop("disabled", false);
            $('#comorbidity16').prop("disabled", false);
        }
        if ($("#comorbidity16").is(":checked")) {
            $("#comor").show();
        }else{
            $("[name=comorbidity1]").val(null);
            $("#comor").hide();
        }
    });
    //IVP and CT normal click than abnormal unchecked and disabled
    $("[name=ivp_right]").on('change',function(){
      if($("#R_ivp1").is(":checked")){
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
      }else{
        $('#R_ivp2').prop("disabled", false);
        $('#R_ivp3').prop("disabled", false);
        $('#R_ivp4').prop("disabled", false);
        $('#R_ivp5').prop("disabled", false);
        $('#R_ivp6').prop("disabled", false);
      }
    });

    $("[name=ivp_left]").on('change',function(){
      if($("#L_ivp1").is(":checked")){
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
      }else{
        $('#L_ivp2').prop("disabled", false);
        $('#L_ivp3').prop("disabled", false);
        $('#L_ivp4').prop("disabled", false);
        $('#L_ivp5').prop("disabled", false);
        $('#L_ivp6').prop("disabled", false);
      }
    });

    $("[name=ct_right]").on('change',function(){
      if($("#R_ct1").is(":checked")){
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
      }else{
        $('#R_ct2').prop("disabled", false);
        $('#R_ct3').prop("disabled", false);
        $('#R_ct4').prop("disabled", false);
        $('#R_ct5').prop("disabled", false);
        $('#R_ct6').prop("disabled", false);
      }
    });

    $("[name=ct_left]").on('change',function(){
      if($("#L_ct1").is(":checked")){
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
      }else{
        $('#L_ct2').prop("disabled", false);
        $('#L_ct3').prop("disabled", false);
        $('#L_ct4').prop("disabled", false);
        $('#L_ct5').prop("disabled", false);
        $('#L_ct6').prop("disabled", false);
      }
    });

  }
);
