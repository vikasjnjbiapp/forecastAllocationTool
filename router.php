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
  $value = $argTwo->checkAndFetchSingleRecord('jnj_registration', 'customerName, userRole, countryName, assignCustomes', $condition);
  // $userRole = ['SuperAdmin', 'KAM Manger', 'CVTL', 'TAL', 'KAMs'];
  $userRole = ['SuperAdmin', 'KAM Manger', 'CVTL', 'TAL', 'KAMs','Pricing Team'];
  if(!empty($value)) {
    $_SESSION['customerName'] = $value['customerName'];
    $_SESSION['userRole'] = $userRole[$value['userRole']];
    $_SESSION['countryName'] = $value['countryName'];
    $_SESSION['assignCustomers'] = $value['assignCustomes'];
    echo implode(',', $value);
  } else {
    echo 5;
  }
};
$fetchBrand = function($countryId, $argOne, $argTwo){
  $tables = ['jnj_item', 'jnj_brand'];
  $fields = ['brandId', 'countryId', 'jnj_brand.id', 'brandName'];
  $onCond = 'jnj_item.brandId = jnj_brand.id';
  // $whereCond = 'jnj_item.countryId='.$countryId.' and jnj_item.id='.$argOne;
  $whereCond = ' jnj_item.id='.$argOne;
  return $argTwo->joinTwoOrMultipleRecords($tables, $fields, $onCond, $whereCond);
};
$insesrtTempDataEntry = function($tableName, $tempData, $year, $argOne) { 
  $fields = "(`customerWWID`,`countryId`,`type`,`busSelector`,`itemId`,`brandId`,`jan_fcast`,`feb_fcast`,`mar_fcast`,`apr_fcast`,`may_fcast`,`jun_fcast`,`jul_fcast`,`aug_fcast`,`sep_fcast`,`oct_fcast`,`nov_fcast`,`dec_fcast`,`totalSalesTarget_fcast`,`lastRollingForecast_fcast`,`totalForecast_fcast`,`varient_fcast`,`ytd_fcast`,`yearToGo_fcast`,`financialPlan_fcast`,`jan_focs`,`feb_focs`,`mar_focs`,`apr_focs`,`may_focs`,`jun_focs`,`jul_focs`,`aug_focs`,`sep_focs`,`oct_focs`,`nov_focs`,`dec_focs`,`totalSalesTarget_focs`,`lastRollingForecast_focs`,`totalForecast_focs`,`varient_focs`,`ytd_focs`,`yearToGo_focs`,`financialPlan_focs`,`year`,`createDate`,`ModifiedDate`)";
  return $argOne->insertDataIntoMultiTables($tableName, $fields, $tempData, $year);
};
/*$fetchRoleAndCountry = function($data, $argOne) {
  $tableNames = ['jnj_registration', 'jnj_country'];
  $fieldNames = ['jnj_registration.userRole', 'jnj_registration.countryName', 'jnj_country.id', 'jnj_country.countryCode'];
  $onConditions = 'jnj_registration.countryName=jnj_country.id';
  $whereCond = 'jnj_registration.customerName='.$data;
  return $argOne->joinTwoOrMultipleRecords($tableNames, $fieldNames, $onConditions, $whereCond);
};*/
/*$fetchItemRespectCountry = function($data, $argOne) {
  $cond = ' countryId='.$data;
  return $argOne->fetchMultipleRecords('jnj_item', '*', $cond);
};*/
$totalSalesTarget = function($arrayData, $customerName, $countryId, $argOne) {   
  $tableName = 'jnj_totalSalesTarget';
  $fieldName = 'fftarget';
  $condition = ' customerName='.$customerName.' AND countryId='.$countryId.' AND itemName='.$arrayData;
  return $argOne->fetchMultipleRecords($tableName, $fieldName, $condition);
};
/*$fetchCountryRespectCustomer = function($arrayData, $argOne) {
  $cond = ' countryName='.$arrayData.' AND userRole = 2';
  return $argOne->fetchMultipleRecords('jnj_registration', '`id`, `customerName`', $cond);
};*/
$fetchUserDetails = function($arrayData, $argOne) {
  $cond = ' customerName='.$arrayData;
  $fieldName = '`customerName`,`email`,`userRole`,`userStatus`';
  return $argOne->checkAndFetchSingleRecord('jnj_registration', $fieldName, $cond);
};
$updateUserDetails = function($arrayData, $argOne) {
  $condition = ' customerName='.$arrayData[0]['value'];
  $fieldName = ['email','userRole','userStatus'];
  return $argOne->updateTableDetails('jnj_registration', $fieldName, $arrayData, $condition);
};
$fetchCustomerIrrespectUserRole = function($arrayData, $argOne) {
   $condition = ' userRole='.$arrayData[1].' AND countryName='.$arrayData[0];
   $fieldName = "`customerName`";
   return $argOne->fetchMultipleRecords('jnj_registration', $fieldName, $condition);   
};
$fetchCustomerIrrespectSC = function($arrayData, $argOne) {
   $condition = ' customerName='.$arrayData;
   $fieldName = "`assignCustomes`";
   return $argOne->fetchMultipleRecords('jnj_registration', $fieldName, $condition);
};
$updateItemUserMapping = function($arrayData, $argOne) {
  $tempArrItem = [];
   foreach($arrayData as $key => $val) {
      if($val['name']==='itemMapping') {
         array_push($tempArrItem, $val['value']);
      }
   }
   if($arrayData[3]['name'] === 'juniorCustomerNumber') {
      $condition = ' customerName='.$arrayData[3]['value'];   
   }  
  $fieldNames = ['assignItems'];
  $itemList = implode(',', $tempArrItem);
  $arrayDataValues = [$itemList];
  return $argOne->updateTableDetailValues('jnj_registration', $fieldNames, $arrayDataValues, $condition);
};
$fetchItemIrrespectCountry = function($arrayData, $argOne) {
  $condition = ' countryId='.$arrayData;
  $fieldName = '*';
  return $argOne->fetchMultipleRecords('jnj_item', $fieldName, $condition);
};
$fetchItemIrrespectJuniorCustomer = function($arrayData, $argOne) {
  $whereCond = ' jnj_registration.customerName='.$arrayData;
  $tableName = ['jnj_item', 'jnj_registration'];
  $fieldNames = 'jnj_item.id, jnj_item.itemName';
  $onConditions = 'jnj_registration.countryName = jnj_item.countryId';
  // $argOne->joinTwoOrMultipleRecords($tableNames, $fieldNames, $onConditions, $whereCond);
};
$lastRollingForecast = function($itemId, $argOne) {
   $fields = 'rollingForecast';
   $month = date("m")-1;
   $year = date("Y");
   $conditions = ' customerWWID='.$_SESSION['customerName'].' AND itemId='.$itemId;
   $argOne->fetchLastRollingForecast('jnj_totalrollingforecast',$fields, $conditions, $month, $year);
};
$upsideValue = function($tableName, $data, $upside, $year, $argOne) {
   return $argOne->insertUpSideDownSide($tableName, $data, $upside, $year);
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
    echo '<option value="0">Select Brand</option><option value="'.$rs['id'].'">'.$rs['brandName'].'</option>';
  break;
  /*case 'fetchRoleAndCountry':
    $rs = $fetchRoleAndCountry($arrayData, $commonMethod);
    $userRole = ['SuperAdmin', 'KAM Manger', 'CVTL', 'TAL', 'KAMs'];
    echo '<option value="0">Select Country</option><option value="'.$rs['id'].'">'.$rs['countryCode'].'</option>,'.$userRole[$rs['userRole']];
  break;*/
  /*case 'fetchItemRespectCountry':
    $rs = $fetchItemRespectCountry($arrayData, $commonMethod);
    $itemList = '';
      foreach($rs as $key => $val) {
         $itemList .= '<option value="'.$val['id'].'">'.$val['itemName'].'</option>';
      }
    echo $itemList;
  break;*/
  case 'totalSalesTarget':
    $otherData = !empty($_POST['otherdata'])?$_POST['otherdata']:null;
    // $countryId = isset($_POST['countryId'])?$_POST['countryId']:null;
    $rs = $totalSalesTarget($arrayData, $otherData['customerName'], $otherData['countryId'], $commonMethod);
    $tempArr = [];
    if(count($rs) > 0) {
      foreach ($rs as $key => $val) {
         array_push($tempArr, $val['fftarget']);
      }
    }
    echo implode(',',$tempArr);
  break;
  /*case 'fetchCountryRespectCustomer':
    $rs = $fetchCountryRespectCustomer($arrayData, $commonMethod);
    $customerList = '<option value="0">Select CVTL</option>';
      foreach($rs as $key => $val) {
         $customerList .= '<option value="'.$val['id'].'">'.$val['customerName'].'</option>';
      }
    echo $customerList;
  break;*/
  case 'fetchUserDetails':
    $rs = $fetchUserDetails($arrayData, $commonMethod);
    echo implode(',', $rs);
  break;
  case 'updateUserDetails':
    echo $updateUserDetails($arrayData, $commonMethod);
  break;
  case 'fetchCustomerIrrespectUserRole':
    $rs = $fetchCustomerIrrespectUserRole($arrayData, $commonMethod);
    $selectOpt = '<option value="0">Select Superior Customer</option>';
    foreach($rs as $val) {
       $selectOpt.= '<option value='.$val['customerName'].'>'.$val['customerName'].'</option>';   
    }
    echo $selectOpt;
  break;
  case 'fetchCustomerIrrespectSC':
    $rs = $fetchCustomerIrrespectSC($arrayData, $commonMethod);
    echo $rs[0]['assignCustomes'];
  break;
  case 'updateItemUserMapping':
    echo $updateItemUserMapping($arrayData, $commonMethod);    
  break;
  case 'fetchItemIrrespectCountry':
    $rs = $fetchItemIrrespectCountry($arrayData, $commonMethod);
    $itemList = '<select name="itemMapping" id="itemMapping" class="form-control form-control-inline" style="height:200px;width: 200px;" multiple>';
        foreach($rs as $val) {
          $itemList.= '<option value='.$val['id'].'>'.$val['itemName'].'</option>';
        }
    $itemList.= '</select>';
    echo $itemList;
  break;
  case 'fetchItemIrrespectJuniorCustomer':
    $fetchItemIrrespectJuniorCustomer($arrayData, $commonMethod);
  break;
  case 'lastRollingForecast':
    $lastRollingForecast($arrayData, $commonMethod);
  break;
  case 'dataEnterIntoTable':
    $someArray = json_decode($arrayData, true);
    echo $insesrtTempDataEntry('jnj_temp_tal_dataentry', $someArray, $_POST['yearval'], $commonMethod);
  break;
  case 'dataEnterIntoTableCVTL':
    $someArray = json_decode($arrayData, true);
    echo $insesrtTempDataEntry('jnj_temp_cvtl_dataentry', $someArray, $_POST['yearval'], $commonMethod);
  break;
  case 'upsideValue':
    $upside = isset($_POST['upside'])?$_POST['upside']:0;
    $year = isset($_POST['years'])?$_POST['years']:0;
    $upsideValue('jnj_upsideTable', $arrayData, $upside, $year, $commonMethod);
    //print_r($arrayData);
  break;
  case 'downsideValue':
    $downside = isset($_POST['downside'])?$_POST['downside']:0;
    $year = isset($_POST['years'])?$_POST['years']:0;
    $upsideValue('jnj_downsideTable', $arrayData, $downside, $year, $commonMethod);
    //print_r($arrayData);
  break;
  case 'importPricingDataFile':
    $pyscript = 'C:\\xampp\\htdocs\\Site\\jnj_bi_project\\users\\PricingTeam\\execution.bat';
    $output = 'hello';
    echo exec('start /B '.$pyscript, $output);
  break;
  case 'importActualSalesDataFile':
    $pyscript = 'C:\\xampp\\htdocs\\Site\\jnj_bi_project\\users\\PricingTeam\\execution.bat';
    $str = exec('start /B '.$pyscript);
    print_r($str);
  break;
}

