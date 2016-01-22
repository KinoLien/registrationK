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
        var ketamine_history_year = parseInt(ketamine_history / 12);
        var ketamine_history_month = ketamine_history % 12;
        $("[name=ketamine_history_year]").val(ketamine_history_year);
        $("[name=ketamine_history_month]").val(ketamine_history_month); 
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
        var comor_other = "<?php echo $row_RecMedical["comor_other"]; ?>";
        if(comor1 == 0 && comor2 == 0 && comor3 == 0 && comor4 == 0 && comor5 == 0 && comor6 == 0 && comor7 == 0 && comor8 == 0 &&
           comor9 == 0 && comor10 == 0 && comor11 == 0 && comor12 == 0 && comor13 == 0 && comor14 == 0 && comor_other == "0"){
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
        //var comor_other = "<?php echo $row_RecMedical["comor_other"]; ?>";
        if(comor_other != "0" && comor_other != "99"){
          $("[name=comor_other][type=checkbox]").filter('[value="other"]').prop('checked', true);
          $("#comor").show();
          $("[name=comorbidity1]").val(comor_other);
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
        var drugreason_other = "<?php echo $row_RecMedical["drugreason_other"]; ?>";
        if(drugreason_other != "0" && drugreason_other != "99"){
          $("[name=drugreason_other][type=checkbox]").filter('[value="1"]').prop('checked', true);
          $("#drug_reason0").show();
          $("[name=drug_reason1]").val(drugreason_other);
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
        $("[name=drugplace17][type=checkbox]").filter('[value="<?php echo $row_RecMedical["drugplace18"]; ?>"]').prop('checked', true);
        var drugplace_other = "<?php echo $row_RecMedical["drugplace_other"]; ?>";
        if(drugplace_other != "0" && drugplace_other != "99"){
          $("[name=drugplace_other][type=checkbox]").filter('[value="1"]').prop('checked', true);
          $("#drug_place0").show();
          $("[name=drug_place1]").val(drugplace_other);
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
        var drugsource_other = "<?php echo $row_RecMedical["drugsource_other"]; ?>";
        if(drugsource_other != "0" && drugsource_other != "99"){
          $("[name=drugsource_other][type=checkbox]").filter('[value="1"]').prop('checked', true);
          
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
           job != "家庭主婦"){
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
        if (marriage != "未婚" && marriage != "已婚" && marriage != "同居" && marriage != "離婚" && marriage != "喪偶") {
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
        //主要使用方式
        var ketamine_method = "<?php echo $row_RecMedical["ketamine_method"]; ?>";
        if(ketamine_method != "口服" && ketamine_method != "以香菸或煙管方式吸食" && ketamine_method != "加熱成煙霧後鼻吸" && 
           ketamine_method != "藥物直接鼻吸" && ketamine_method != "嗅吸蒸發之氣體"){
          $("[name=ketamine_method][type=radio]").filter('[value="other"]').prop('checked', true);
          $("#ketamine_method0").show();
          $("[name=ketamine_method1]").val(ketamine_method);
        }else{
          $("[name=ketamine_method][type=radio]").filter('[value="<?php echo $row_RecMedical["ketamine_method"]; ?>"]').prop('checked', true);
        }
        //合併使用其他藥物
        var combined_drug = "<?php echo $row_RecMedical["combined_drug"]; ?>";
        if(combined_drug != "無"){
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
          var stop_ketamine_year = parseInt(stop_ketamine_month /12);
          stop_ketamine_month = stop_ketamine_month % 12;
          $("[name=stop_ketamine_year]").val(stop_ketamine_year);
          $("[name=stop_ketamine_month]").val(stop_ketamine_month);
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
        if (Renal_function_BUN == "NA" && Renal_function_Cr == "NA") {
          $("[name=RF_na][type=checkbox]").prop('checked', true);
          $("[name=Renal_function_BUN]").prop("disabled", true);
          $("[name=Renal_function_Cr]").prop("disabled", true);
          $("[name=Renal_function_BUN]").val(null);
          $("[name=Renal_function_Cr]").val(null);
        };
        if (Renal_function_BUN != "NA") {$("[name=Renal_function_BUN]").val(Renal_function_BUN);};
        if (Renal_function_Cr != "NA") {$("[name=Renal_function_Cr]").val(Renal_function_Cr);};
        //Liver function
        var Liver_function_GPT = "<?php echo $row_RecMedical["Liver_function_GPT"]; ?>";
        var Liver_function_GOT = "<?php echo $row_RecMedical["Liver_function_GOT"]; ?>";
        var Liver_function_ALB = "<?php echo $row_RecMedical["Liver_function_ALB"]; ?>";
        var Liver_function_BIL = "<?php echo $row_RecMedical["Liver_function_BIL"]; ?>";
        if (Liver_function_GPT == "NA" && Liver_function_GOT == "NA" && Liver_function_ALB == "NA" && Liver_function_BIL == "NA") {
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
        if (Liver_function_GOT != "NA") {$("[name=Liver_function_GOT]").val(Liver_function_GOT);};
        if (Liver_function_GPT != "NA") {$("[name=Liver_function_GPT]").val(Liver_function_GPT);};
        if (Liver_function_ALB != "NA") {$("[name=Liver_function_ALB]").val(Liver_function_ALB);};
        if (Liver_function_BIL != "NA") {$("[name=Liver_function_BIL]").val(Liver_function_BIL);};
        //Hematology
        var Hematology_WBC = "<?php echo $row_RecMedical["Hematology_WBC"]; ?>";
        var Hematology_Hgb = "<?php echo $row_RecMedical["Hematology_Hgb"]; ?>";
        var Hematology_Pl = "<?php echo $row_RecMedical["Hematology_Pl"]; ?>";
        var Hematology_eosinophil = "<?php echo $row_RecMedical["Hematology_eosinophil"]; ?>";
        if (Hematology_WBC == "NA" && Hematology_Hgb == "NA" && Hematology_Pl == "NA" && Hematology_eosinophil == "NA") {
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
        if (Hematology_WBC != "NA") {$("[name=Hematology_WBC]").val(Hematology_WBC);};
        if (Hematology_Hgb != "NA") {$("[name=Hematology_Hgb]").val(Hematology_Hgb);};
        if (Hematology_Pl != "NA") {$("[name=Hematology_Pl]").val(Hematology_Pl);};
        if (Hematology_eosinophil != "NA") {$("[name=Hematology_eosinophil]").val(Hematology_eosinophil);};
        //Immunology
        var Immune_IgE = "<?php echo $row_RecMedical["Immune_IgE"]; ?>";
        if (Immune_IgE == "NA") {
          $("[name=immunology_na][type=checkbox]").prop('checked', true);
          $("[name=Immune_IgE]").prop("disabled", true);
          $("[name=Immune_IgE]").val(null);
        };
        if (Immune_IgE != "NA") {$("[name=Immune_IgE]").val(Immune_IgE);};
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
          $("[name=IVP_na][type=checkbox]").prop('checked', true);
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
        if (PVR == "NA" && bladder_echo_BW_thickness == "NA") {
          $("[name=UB_na][type=checkbox]").prop('checked', true);
          $("[name=PVR]").prop("disabled", true);
          $("[name=bladder_echo_BW_thickness]").prop("disabled", true);
          $("[name=PVR]").val(null);
          $("[name=bladder_echo_BW_thickness]").val(null);
        };
        if (PVR != "NA") {$("[name=PVR]").val(PVR);};
        if (bladder_echo_BW_thickness != "NA") {$("[name=bladder_echo_BW_thickness]").val(bladder_echo_BW_thickness);};
        /*Uroflowmetry*/
        var Uroflowmetry_Qmax = "<?php echo $row_RecMedical["Uroflowmetry_Qmax"]; ?>";
        var Uroflowmetry_VV = "<?php echo $row_RecMedical["Uroflowmetry_VV"]; ?>";
        var Uroflowmetry_Pattern = "<?php echo $row_RecMedical["Uroflowmetry_Pattern"]; ?>";
        if (Uroflowmetry_Qmax == "NA" && Uroflowmetry_VV == "NA" && Uroflowmetry_Pattern == "NA") {
          $("[name=uroflowmetry_na][type=checkbox]").prop('checked', true);
          $("[name=Uroflowmetry_Qmax]").prop("disabled", true);
          $("[name=Uroflowmetry_VV]").prop("disabled", true);
          $("[name=Uroflowmetry_Pattern][type=radio]").prop("disabled", true);
          $("[name=Uroflowmetry_Qmax]").val(null);
          $("[name=Uroflowmetry_VV]").val(null);
          $("[name=Uroflowmetry_Pattern][type=radio]").attr('checked', false);
        };
        if (Uroflowmetry_Qmax != "NA") {$("[name=Uroflowmetry_Qmax]").val(Uroflowmetry_Qmax);};
        if (Uroflowmetry_VV != "NA") {$("[name=Uroflowmetry_VV]").val(Uroflowmetry_VV);};
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
        if (urodynamic_study_FD == "NA" && urodynamic_study_MCC == "NA" && urodynamic_study_MP == "NA" &&
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
        if (urodynamic_study_FD != "NA") {$("[name=urodynamic_study_FD]").val(urodynamic_study_FD);};
        if (urodynamic_study_MCC != "NA") {$("[name=urodynamic_study_MCC]").val(urodynamic_study_MCC);};
        if (urodynamic_study_MP != "NA") {$("[name=urodynamic_study_MP]").val(urodynamic_study_MP);};
        $("[name=urodynamic_study_DO][type=radio]").filter('[value="<?php echo $row_RecMedical["urodynamic_study_DO"]; ?>"]').prop('checked', true);
        if (urodynamic_study_DO == "1") {
          $("#urodynamic_do0").show();
          if (US_DO_amplitude != "NA") {$("[name=US_DO_amplitude]").val(US_DO_amplitude);};
          if (US_DO_amplitude_at != "NA") {$("[name=US_DO_amplitude_at]").val(US_DO_amplitude_at);};
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