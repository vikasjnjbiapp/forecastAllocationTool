<?php
/*
router.php
*/
session_start();
require_once('admin/controllers/commonMethodFile.Controller.php');

$page = isset($_POST['page'])?$_POST['page']:null;
$arrayData = isset($_POST['arrayData'])?$_POST['arrayData']:null;
$commonMethod = new commonMethodFile();

$register = function($argOne, $argTwo) {
  $argTwo->insertRegistrationTable('jnj_registration', $argOne);
};
$login = function($argOne, $argTwo) {
  $condition = ' customerName='.$argOne[0]['value'].' and password="'.$argTwo->createEncryptedPassword($argOne[1]['value']).'" and userRole='.$argOne[2]['value'];
  $value = $argTwo->checkAndFetchSingleRecord('jnj_registration', 'customerName, userRole, countryName', $condition);
  $userRole = ['SuperAdmin', 'KAMs', 'CVTL', 'TAL'];
  if(!empty($value)) {
    $_SESSION['customerName'] = $value['customerName'];
    $_SESSION['userRole'] = $userRole[$value['userRole']];
    $_SESSION['countryName'] = $value['countryName'];  
    echo implode(',', $value);
  } else {
    echo 5;
  }
};
$fetchBrand = function($countryId, $argOne, $argTwo){
  $tables = ['jnj_item', 'jnj_brand'];
  $fields = ['brandId', 'countryId', 'jnj_brand.id', 'brandName'];
  $onCond = 'jnj_item.brandId = jnj_brand.id';
  $whereCond = 'jnj_item.countryId='.$countryId.' and jnj_item.id='.$argOne;
  return $argTwo->joinTwoOrMultipleRecords($tables, $fields, $onCond, $whereCond);
};
$insesrtTempDataEntry = function($tempData, $year, $argOne) {
  $table = 'jnj_temp_tal_dataentry';
  /*$fields = ['customerName','country','type','busSelector','item','brand','jan_fcast','feb_fcast','mar_fcast','apr_fcast','may_fcast','jun_fcast','jul_fcast','aug_fcast','sep_fcast','oct_fcast','nov_fcast','dec_fcast','totalSalesTarget_focs','lastRollingForecast_focs','totalForecast_focs','varient_focs','ytd_focs','yearToGo_focs','financialPlan_focs','jan_focs','feb_focs','mar_focs','apr_focs','may_focs','jun_focs','jul_focs','aug_focs','sep_focs','oct_focs','nov_focs','dec_focs','year','createDate','modifiedDate'];*/  
  $fields = "(`customerName`,`countryId`,`type`,`busSelector`,`itemId`,`brandId`,`jan_fcast`,`feb_fcast`,`mar_fcast`,`apr_fcast`,`may_fcast`,`jun_fcast`,`jul_fcast`,`aug_fcast`,`sep_fcast`,`oct_fcast`,`nov_fcast`,`dec_fcast`,`totalSalesTarget_fcast`,`lastRollingForecast_fcast`,`totalForecast_fcast`,`varient_fcast`,`ytd_fcast`,`yearToGo_fcast`,`financialPlan_fcast`,`jan_focs`,`feb_focs`,`mar_focs`,`apr_focs`,`may_focs`,`jun_focs`,`jul_focs`,`aug_focs`,`sep_focs`,`oct_focs`,`nov_focs`,`dec_focs`,`totalSalesTarget_focs`,`lastRollingForecast_focs`,`totalForecast_focs`,`varient_focs`,`ytd_focs`,`yearToGo_focs`,`financialPlan_focs`,`year`,`createDate`,`ModifiedDate`)";
  // return $argOne->insertDataIntoTable($table, $fields, $tempData, $year);
};

/*if($page === 'register') {
  $register($arrayData);
}*/

switch($page) {
  case 'register':
    $register($arrayData, $commonMethod);
  break;
  case 'login':
    $login($arrayData, $commonMethod);
  break;
  case 'brandDropDown':
    $countryId = isset($_POST['countryId'])?$_POST['countryId']:0;
    $rs = $fetchBrand($countryId, $arrayData, $commonMethod);
    echo '<option value="'.$rs['id'].'">'.$rs['brandName'].'</option>';
  break;
  case 'dataEnterIntoTable':
    $tempArr = array();
    $temp1 = $temp2 = $temp3 = $temp4 = $temp5 = $temp6 = $temp7 = $temp8 = $temp9 = $temp10 = $temp11 = $temp12 = $temp13 = $temp14 = $temp15 = $temp16 = $temp17 = $temp18 = $temp19 = $temp20 = $temp21 = array();
    print_r($arrayData);
    $arrElement1 = array('1'=>'customerName_1','country_1','type_1','busSelector_1','item_1','brand_1','jan_fcast_1','feb_fcast_1','mar_fcast_1','apr_fcast_1','may_fcast_1','jun_fcast_1','jul_fcast_1','aug_fcast_1','sep_fcast_1','oct_fcast_1','nov_fcast_1','dec_fcast_1','totalSalesTarget_fcast_1','lastRollingForecast_fcast_1','totalForecast_fcast_1','varient_fcast_1','ytd_fcast_1','yearToGo_fcast_1','financialPlan_fcast_1','jan_focs_1','feb_focs_1','mar_focs_1','apr_focs_1','may_focs_1','jun_focs_1','jul_focs_1','aug_focs_1','sep_focs_1','oct_focs_1','nov_focs_1','dec_focs_1','totalSalesTarget_focs_1','lastRollingForecast_focs_1','totalForecast_focs_1','varient_focs_1','ytd_focs_1','yearToGo_focs_1','financialPlan_focs_1');
    $arrElement2 = array('44'=>'customerName_2','country_2','type_2','busSelector_2','item_2','brand_2','jan_fcast_2','feb_fcast_2','mar_fcast_2','apr_fcast_2','may_fcast_2','jun_fcast_2','jul_fcast_2','aug_fcast_2','sep_fcast_2','oct_fcast_2','nov_fcast_2','dec_fcast_2','totalSalesTarget_fcast_2','lastRollingForecast_fcast_2','totalForecast_fcast_2','varient_fcast_2','ytd_fcast_2','yearToGo_fcast_2','financialPlan_fcast_2','jan_focs_2','feb_focs_2','mar_focs_2','apr_focs_2','may_focs_2','jun_focs_2','jul_focs_2','aug_focs_2','sep_focs_2','oct_focs_2','nov_focs_2','dec_focs_2','totalSalesTarget_focs_2','lastRollingForecast_focs_2','totalForecast_focs_2','varient_focs_2','ytd_focs_2','yearToGo_focs_2','financialPlan_focs_2');
   $arrElement3 = array('88'=>'customerName_3','country_3','type_3','busSelector_3','item_3','brand_3','jan_fcast_3','feb_fcast_3','mar_fcast_3','apr_fcast_3','may_fcast_3','jun_fcast_3','jul_fcast_3','aug_fcast_3','sep_fcast_3','oct_fcast_3','nov_fcast_3','dec_fcast_3','totalSalesTarget_fcast_3','lastRollingForecast_fcast_3','totalForecast_fcast_3','varient_fcast_3','ytd_fcast_3','yearToGo_fcast_3','financialPlan_fcast_3','jan_focs_3','feb_focs_3','mar_focs_3','apr_focs_3','may_focs_3','jun_focs_3','jul_focs_3','aug_focs_3','sep_focs_3','oct_focs_3','nov_focs_3','dec_focs_3','totalSalesTarget_focs_3','lastRollingForecast_focs_3','totalForecast_focs_3','varient_focs_3','ytd_focs_3','yearToGo_focs_3','financialPlan_focs_3');
   $arrElement4 = array('132'=>'customerName_4','country_4','type_4','busSelector_4','item_4','brand_4','jan_fcast_4','feb_fcast_4','mar_fcast_4','apr_fcast_4','may_fcast_4','jun_fcast_4','jul_fcast_4','aug_fcast_4','sep_fcast_4','oct_fcast_4','nov_fcast_4','dec_fcast_4','totalSalesTarget_fcast_4','lastRollingForecast_fcast_4','totalForecast_fcast_4','varient_fcast_4','ytd_fcast_4','yearToGo_fcast_4','financialPlan_fcast_4','jan_focs_4','feb_focs_4','mar_focs_4','apr_focs_4','may_focs_4','jun_focs_4','jul_focs_4','aug_focs_4','sep_focs_4','oct_focs_4','nov_focs_4','dec_focs_4','totalSalesTarget_focs_4','lastRollingForecast_focs_4','totalForecast_focs_4','varient_focs_4','ytd_focs_4','yearToGo_focs_4','financialPlan_focs_4');
   $arrElement5 = array('176'=>'customerName_5','country_5','type_5','busSelector_5','item_5','brand_5','jan_fcast_5','feb_fcast_5','mar_fcast_5','apr_fcast_5','may_fcast_5','jun_fcast_5','jul_fcast_5','aug_fcast_5','sep_fcast_5','oct_fcast_5','nov_fcast_5','dec_fcast_5','totalSalesTarget_fcast_5','lastRollingForecast_fcast_5','totalForecast_fcast_5','varient_fcast_5','ytd_fcast_5','yearToGo_fcast_5','financialPlan_fcast_5','jan_focs_5','feb_focs_5','mar_focs_5','apr_focs_5','may_focs_5','jun_focs_5','jul_focs_5','aug_focs_5','sep_focs_5','oct_focs_5','nov_focs_5','dec_focs_5','totalSalesTarget_focs_5','lastRollingForecast_focs_5','totalForecast_focs_5','varient_focs_5','ytd_focs_5','yearToGo_focs_5','financialPlan_focs_5');
   $arrElement6 = array('220'=>'customerName_6','country_6','type_6','busSelector_6','item_6','brand_6','jan_fcast_6','feb_fcast_6','mar_fcast_6','apr_fcast_6','may_fcast_6','jun_fcast_6','jul_fcast_6','aug_fcast_6','sep_fcast_6','oct_fcast_6','nov_fcast_6','dec_fcast_6','totalSalesTarget_fcast_6','lastRollingForecast_fcast_6','totalForecast_fcast_6','varient_fcast_6','ytd_fcast_6','yearToGo_fcast_6','financialPlan_fcast_6','jan_focs_6','feb_focs_6','mar_focs_6','apr_focs_6','may_focs_6','jun_focs_6','jul_focs_6','aug_focs_6','sep_focs_6','oct_focs_6','nov_focs_6','dec_focs_6','totalSalesTarget_focs_6','lastRollingForecast_focs_6','totalForecast_focs_6','varient_focs_6','ytd_focs_6','yearToGo_focs_6','financialPlan_focs_6');
   $arrElement7 = array('264'=>'customerName_7','country_7','type_7','busSelector_7','item_7','brand_7','jan_fcast_7','feb_fcast_7','mar_fcast_7','apr_fcast_7','may_fcast_7','jun_fcast_7','jul_fcast_7','aug_fcast_7','sep_fcast_7','oct_fcast_7','nov_fcast_7','dec_fcast_7','totalSalesTarget_fcast_7','lastRollingForecast_fcast_7','totalForecast_fcast_7','varient_fcast_7','ytd_fcast_7','yearToGo_fcast_7','financialPlan_fcast_7','jan_focs_7','feb_focs_7','mar_focs_7','apr_focs_7','may_focs_7','jun_focs_7','jul_focs_7','aug_focs_7','sep_focs_7','oct_focs_7','nov_focs_7','dec_focs_7','totalSalesTarget_focs_7','lastRollingForecast_focs_7','totalForecast_focs_7','varient_focs_7','ytd_focs_7','yearToGo_focs_7','financialPlan_focs_7');
   $arrElement8 = array('308'=>'customerName_8','country_8','type_8','busSelector_8','item_8','brand_8','jan_fcast_8','feb_fcast_8','mar_fcast_8','apr_fcast_8','may_fcast_8','jun_fcast_8','jul_fcast_8','aug_fcast_8','sep_fcast_8','oct_fcast_8','nov_fcast_8','dec_fcast_8','totalSalesTarget_fcast_8','lastRollingForecast_fcast_8','totalForecast_fcast_8','varient_fcast_8','ytd_fcast_8','yearToGo_fcast_8','financialPlan_fcast_8','jan_focs_8','feb_focs_8','mar_focs_8','apr_focs_8','may_focs_8','jun_focs_8','jul_focs_8','aug_focs_8','sep_focs_8','oct_focs_8','nov_focs_8','dec_focs_8','totalSalesTarget_focs_8','lastRollingForecast_focs_8','totalForecast_focs_8','varient_focs_8','ytd_focs_8','yearToGo_focs_8','financialPlan_focs_8');
   $arrElement9 = array('352'=>'customerName_9','country_9','type_9','busSelector_9','item_9','brand_9','jan_fcast_9','feb_fcast_9','mar_fcast_9','apr_fcast_9','may_fcast_9','jun_fcast_9','jul_fcast_9','aug_fcast_9','sep_fcast_9','oct_fcast_9','nov_fcast_9','dec_fcast_9','totalSalesTarget_fcast_9','lastRollingForecast_fcast_9','totalForecast_fcast_9','varient_fcast_9','ytd_fcast_9','yearToGo_fcast_9','financialPlan_fcast_9','jan_focs_9','feb_focs_9','mar_focs_9','apr_focs_9','may_focs_9','jun_focs_9','jul_focs_9','aug_focs_9','sep_focs_9','oct_focs_9','nov_focs_9','dec_focs_9','totalSalesTarget_focs_9','lastRollingForecast_focs_9','totalForecast_focs_9','varient_focs_9','ytd_focs_9','yearToGo_focs_9','financialPlan_focs_9');
   $arrElement10 = array('396'=>'customerName_10','country_10','type_10','busSelector_10','item_10','brand_10','jan_fcast_10','feb_fcast_10','mar_fcast_10','apr_fcast_10','may_fcast_10','jun_fcast_10','jul_fcast_10','aug_fcast_10','sep_fcast_10','oct_fcast_10','nov_fcast_10','dec_fcast_10','totalSalesTarget_fcast_10','lastRollingForecast_fcast_10','totalForecast_fcast_10','varient_fcast_10','ytd_fcast_10','yearToGo_fcast_10','financialPlan_fcast_10','jan_focs_10','feb_focs_10','mar_focs_10','apr_focs_10','may_focs_10','jun_focs_10','jul_focs_10','aug_focs_10','sep_focs_10','oct_focs_10','nov_focs_10','dec_focs_10','totalSalesTarget_focs_10','lastRollingForecast_focs_10','totalForecast_focs_10','varient_focs_10','ytd_focs_10','yearToGo_focs_10','financialPlan_focs_10');
   $arrElement11 = array('440'=>'customerName_11','country_11','type_11','busSelector_11','item_11','brand_11','jan_fcast_11','feb_fcast_11','mar_fcast_11','apr_fcast_11','may_fcast_11','jun_fcast_11','jul_fcast_11','aug_fcast_11','sep_fcast_11','oct_fcast_11','nov_fcast_11','dec_fcast_11','totalSalesTarget_fcast_11','lastRollingForecast_fcast_11','totalForecast_fcast_11','varient_fcast_11','ytd_fcast_11','yearToGo_fcast_11','financialPlan_fcast_11','jan_focs_11','feb_focs_11','mar_focs_11','apr_focs_11','may_focs_11','jun_focs_11','jul_focs_11','aug_focs_11','sep_focs_11','oct_focs_11','nov_focs_11','dec_focs_11','totalSalesTarget_focs_11','lastRollingForecast_focs_11','totalForecast_focs_11','varient_focs_11','ytd_focs_11','yearToGo_focs_11','financialPlan_focs_11');
  $arrElement12 =    array('484'=>'customerName_12','country_12','type_12','busSelector_12','item_12','brand_12','jan_fcast_12','feb_fcast_12','mar_fcast_12','apr_fcast_12','may_fcast_12','jun_fcast_12','jul_fcast_12','aug_fcast_12','sep_fcast_12','oct_fcast_12','nov_fcast_12','dec_fcast_12','totalSalesTarget_fcast_12','lastRollingForecast_fcast_12','totalForecast_fcast_12','varient_fcast_12','ytd_fcast_12','yearToGo_fcast_12','financialPlan_fcast_12','jan_focs_12','feb_focs_12','mar_focs_12','apr_focs_12','may_focs_12','jun_focs_12','jul_focs_12','aug_focs_12','sep_focs_12','oct_focs_12','nov_focs_12','dec_focs_12','totalSalesTarget_focs_12','lastRollingForecast_focs_12','totalForecast_focs_12','varient_focs_12','ytd_focs_12','yearToGo_focs_12','financialPlan_focs_12');
  $arrElement13 = array('528'=>'customerName_13','country_13','type_13','busSelector_13','item_13','brand_13','jan_fcast_13','feb_fcast_13','mar_fcast_13','apr_fcast_13','may_fcast_13','jun_fcast_13','jul_fcast_13','aug_fcast_13','sep_fcast_13','oct_fcast_13','nov_fcast_13','dec_fcast_13','totalSalesTarget_fcast_13','lastRollingForecast_fcast_13','totalForecast_fcast_13','varient_fcast_13','ytd_fcast_13','yearToGo_fcast_13','financialPlan_fcast_13','jan_focs_13','feb_focs_13','mar_focs_13','apr_focs_13','may_focs_13','jun_focs_13','jul_focs_13','aug_focs_13','sep_focs_13','oct_focs_13','nov_focs_13','dec_focs_13','totalSalesTarget_focs_13','lastRollingForecast_focs_13','totalForecast_focs_13','varient_focs_13','ytd_focs_13','yearToGo_focs_13','financialPlan_focs_13');
  $arrElement14 = array('572'=>'customerName_14','country_14','type_14','busSelector_14','item_14','brand_14','jan_fcast_14','feb_fcast_14','mar_fcast_14','apr_fcast_14','may_fcast_14','jun_fcast_14','jul_fcast_14','aug_fcast_14','sep_fcast_14','oct_fcast_14','nov_fcast_14','dec_fcast_14','totalSalesTarget_fcast_14','lastRollingForecast_fcast_14','totalForecast_fcast_14','varient_fcast_14','ytd_fcast_14','yearToGo_fcast_14','financialPlan_fcast_14','jan_focs_14','feb_focs_14','mar_focs_14','apr_focs_14','may_focs_14','jun_focs_14','jul_focs_14','aug_focs_14','sep_focs_14','oct_focs_14','nov_focs_14','dec_focs_14','totalSalesTarget_focs_14','lastRollingForecast_focs_14','totalForecast_focs_14','varient_focs_14','ytd_focs_14','yearToGo_focs_14','financialPlan_focs_14');
  $arrElement15 = array('616'=>'customerName_15','country_15','type_15','busSelector_15','item_15','brand_15','jan_fcast_15','feb_fcast_15','mar_fcast_15','apr_fcast_15','may_fcast_15','jun_fcast_15','jul_fcast_15','aug_fcast_15','sep_fcast_15','oct_fcast_15','nov_fcast_15','dec_fcast_15','totalSalesTarget_fcast_15','lastRollingForecast_fcast_15','totalForecast_fcast_15','varient_fcast_15','ytd_fcast_15','yearToGo_fcast_15','financialPlan_fcast_15','jan_focs_15','feb_focs_15','mar_focs_15','apr_focs_15','may_focs_15','jun_focs_15','jul_focs_15','aug_focs_15','sep_focs_15','oct_focs_15','nov_focs_15','dec_focs_15','totalSalesTarget_focs_15','lastRollingForecast_focs_15','totalForecast_focs_15','varient_focs_15','ytd_focs_15','yearToGo_focs_15','financialPlan_focs_15');
  $arrElement16 = array('660'=>'customerName_16','country_16','type_16','busSelector_16','item_16','brand_16','jan_fcast_16','feb_fcast_16','mar_fcast_16','apr_fcast_16','may_fcast_16','jun_fcast_16','jul_fcast_16','aug_fcast_16','sep_fcast_16','oct_fcast_16','nov_fcast_16','dec_fcast_16','totalSalesTarget_fcast_16','lastRollingForecast_fcast_16','totalForecast_fcast_16','varient_fcast_16','ytd_fcast_16','yearToGo_fcast_16','financialPlan_fcast_16','jan_focs_16','feb_focs_16','mar_focs_16','apr_focs_16','may_focs_16','jun_focs_16','jul_focs_16','aug_focs_16','sep_focs_16','oct_focs_16','nov_focs_16','dec_focs_16','totalSalesTarget_focs_16','lastRollingForecast_focs_16','totalForecast_focs_16','varient_focs_16','ytd_focs_16','yearToGo_focs_16','financialPlan_focs_16');
  $arrElement17 = array('704'=>'customerName_17','country_17','type_17','busSelector_17','item_17','brand_17','jan_fcast_17','feb_fcast_17','mar_fcast_17','apr_fcast_17','may_fcast_17','jun_fcast_17','jul_fcast_17','aug_fcast_17','sep_fcast_17','oct_fcast_17','nov_fcast_17','dec_fcast_17','totalSalesTarget_fcast_17','lastRollingForecast_fcast_17','totalForecast_fcast_17','varient_fcast_17','ytd_fcast_17','yearToGo_fcast_17','financialPlan_fcast_17','jan_focs_17','feb_focs_17','mar_focs_17','apr_focs_17','may_focs_17','jun_focs_17','jul_focs_17','aug_focs_17','sep_focs_17','oct_focs_17','nov_focs_17','dec_focs_17','totalSalesTarget_focs_17','lastRollingForecast_focs_17','totalForecast_focs_17','varient_focs_17','ytd_focs_17','yearToGo_focs_17','financialPlan_focs_17');
  $arrElement18 = array('748'=>'customerName_18','country_18','type_18','busSelector_18','item_18','brand_18','jan_fcast_18','feb_fcast_18','mar_fcast_18','apr_fcast_18','may_fcast_18','jun_fcast_18','jul_fcast_18','aug_fcast_18','sep_fcast_18','oct_fcast_18','nov_fcast_18','dec_fcast_18','totalSalesTarget_fcast_18','lastRollingForecast_fcast_18','totalForecast_fcast_18','varient_fcast_18','ytd_fcast_18','yearToGo_fcast_18','financialPlan_fcast_18','jan_focs_18','feb_focs_18','mar_focs_18','apr_focs_18','may_focs_18','jun_focs_18','jul_focs_18','aug_focs_18','sep_focs_18','oct_focs_18','nov_focs_18','dec_focs_18','totalSalesTarget_focs_18','lastRollingForecast_focs_18','totalForecast_focs_18','varient_focs_18','ytd_focs_18','yearToGo_focs_18','financialPlan_focs_18');
  $arrElement19 = array('792'=>'customerName_19','country_19','type_19','busSelector_19','item_19','brand_19','jan_fcast_19','feb_fcast_19','mar_fcast_19','apr_fcast_19','may_fcast_19','jun_fcast_19','jul_fcast_19','aug_fcast_19','sep_fcast_19','oct_fcast_19','nov_fcast_19','dec_fcast_19','totalSalesTarget_fcast_19','lastRollingForecast_fcast_19','totalForecast_fcast_19','varient_fcast_19','ytd_fcast_19','yearToGo_fcast_19','financialPlan_fcast_19','jan_focs_19','feb_focs_19','mar_focs_19','apr_focs_19','may_focs_19','jun_focs_19','jul_focs_19','aug_focs_19','sep_focs_19','oct_focs_19','nov_focs_19','dec_focs_19','totalSalesTarget_focs_19','lastRollingForecast_focs_19','totalForecast_focs_19','varient_focs_19','ytd_focs_19','yearToGo_focs_19','financialPlan_focs_19');
  $arrElement20 = array('792'=>'customerName_20','country_20','type_20','busSelector_20','item_20','brand_20','jan_fcast_20','feb_fcast_20','mar_fcast_20','apr_fcast_20','may_fcast_20','jun_fcast_20','jul_fcast_20','aug_fcast_20','sep_fcast_20','oct_fcast_20','nov_fcast_20','dec_fcast_20','totalSalesTarget_fcast_20','lastRollingForecast_fcast_20','totalForecast_fcast_20','varient_fcast_20','ytd_fcast_20','yearToGo_fcast_20','financialPlan_fcast_20','jan_focs_20','feb_focs_20','mar_focs_20','apr_focs_20','may_focs_20','jun_focs_20','jul_focs_20','aug_focs_20','sep_focs_20','oct_focs_20','nov_focs_20','dec_focs_20','totalSalesTarget_focs_20','lastRollingForecast_focs_20','totalForecast_focs_20','varient_focs_20','ytd_focs_20','yearToGo_focs_20','financialPlan_focs_20');
    foreach($arrayData as $key => $val) {
      // echo $key .'=>'. $val['name']."\n";
       if($key1 = array_search($val['name'], $arrElement1)) {
         if($key1 === 2 || $key1 === 3 || $key1 === 4)
            array_push($temp1, '"'.$arrayData[$key]['value'].'"');
          else
            array_push($temp1, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement2)) {
         if($key === 45 || $key === 46 || $key === 47)
            array_push($temp2, '"'.$arrayData[$key]['value'].'"');
         else
            array_push($temp2, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement3)) {
         if($key === 89 || $key === 90 || $key === 91)
            array_push($temp3, '"'.$arrayData[$key]['value'].'"');
         else
            array_push($temp3, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement4)) {
         array_push($temp4, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement5)) {
         array_push($temp5, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement6)) {
         array_push($temp6, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement7)) {
         array_push($temp7, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement8)) {
         array_push($temp8, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement9)) {
         array_push($temp9, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement10)) {
         array_push($temp10, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement11)) {
         array_push($temp11, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement12)) {
         array_push($temp12, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement13)) {
         array_push($temp13, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement14)) {
         array_push($temp14, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement15)) {
         array_push($temp15, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement16)) {
         array_push($temp16, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement17)) {
         array_push($temp17, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement18)) {
         array_push($temp18, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement19)) {
         array_push($temp19, $arrayData[$key]['value']);
       }
       if($key = array_search($val['name'], $arrElement20)) {
         array_push($temp20, $arrayData[$key]['value']);
       }
    }
    $tempArr = [$temp1, $temp2, $temp3, $temp4, $temp5, $temp6, $temp7, $temp8, $temp9, $temp10, $temp11, $temp12, $temp13, $temp14, $temp15, $temp16, $temp17, $temp18, $temp19, $temp20];
    // print_r($tempArr);
    $insesrtTempDataEntry($tempArr, $_POST['yearval'], $commonMethod);
  break;
}



