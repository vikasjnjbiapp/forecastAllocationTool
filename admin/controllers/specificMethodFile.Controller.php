<?php
/*
specific functions
*/

class specificMethodFile extends commonMethodFile {
   public function fetchCountryDetails($tableName, $countryId) {
     $sql = " SELECT countryCode FROM ".$tableName." WHERE id=".$countryId;
     $query = mysqli_query(parent::dbConnection(), $sql);
     $rs = mysqli_fetch_array($query, MYSQLI_ASSOC);
     return $rs;
   }
   public function fetchItemDetails($tableName, $fieldName, $condition) {
       return parent::fetchMultipleRecords($tableName, $fieldName, $condition);
   }
   public function fetchUserList($tableName, $fieldName, $condition) {
       return parent::fetchMultipleRecords($tableName, $fieldName, $condition);
   }
   public function fetchTotalSales($tableName, $fieldName, $condition) {
       return parent::fetchMultipleRecords($tableName, $fieldName, $condition);
   }
   public function customerDetailsFromId($tableName, $condition) {
       return parent::fetchMultipleRecords($tableName, '*', $condition);
   }

/*Discription: fetching items details from customerWWID*/
   public function fetchItemsIrrespectiveCustomer($tableArray, $condtions) {
     $sqlAssignId = " SELECT assignItems FROM ".$tableArray[1]." WHERE customerName=".$condtions;
     $queryAssignId = mysqli_query(parent::dbConnection(), $sqlAssignId);
     $rsAssignId = mysqli_fetch_array($queryAssignId, MYSQLI_ASSOC);
     if(!empty($rsAssignId['assignItems'])) {
         $sql = " SELECT id, itemName, brandId from ".$tableArray[0]." WHERE id in ( ".$rsAssignId['assignItems']." )";
         $query = mysqli_query(parent::dbConnection(), $sql);
         $tempArrName = $tempArrId = [];
         $tempArr = [];
           while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
              array_push($tempArrId, $rs['id']);
              array_push($tempArrName, $rs['itemName']);
           }
         return array_combine($tempArrId, $tempArrName);
     }
   }
   
   public function fetchItemsIrrespectiveCustomerForReport($tableArray, $condtions) {
     $sqlAssignId = " SELECT assignItems FROM ".$tableArray[1]." WHERE customerName=".$condtions;
     $queryAssignId = mysqli_query(parent::dbConnection(), $sqlAssignId);
     $rsAssignId = mysqli_fetch_array($queryAssignId, MYSQLI_ASSOC);
     if(!empty($rsAssignId['assignItems'])) {
         // $sql = " SELECT id, itemName, skuCode, brandId from ".$tableArray[0]." WHERE id in ( ".$rsAssignId['assignItems']." ) and sku in ()";
        $sql = " SELECT jnj_item.id, itemName, skuCode, brandId, round(sum(cif_jan+cif_feb+cif_mar)/3, 5) as Q1, round(sum(cif_apr+cif_may+cif_jun)/3, 5) as Q2, round(sum(cif_jul+cif_aug+cif_sep)/3, 5) as Q3, round(sum(cif_oct+cif_nov+cif_dec)/3, 5) as Q4  FROM jnj_item join jnj_pricing_dataentry ON jnj_item.skuCode = jnj_pricing_dataentry.material where jnj_item.id in ( ".$rsAssignId['assignItems']." )";
        // echo $sql;
         $query = mysqli_query(parent::dbConnection(), $sql);
         $tempArrName = $tempArrId = [];
         $tempArr = [];
           while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
              array_push($tempArr, $rs);
           }
         return $tempArr;
     }
   }

/*Discription: fetching brands details basis of item selection*/
   public function fetchBrandsIrrespectiveItemId($tableName, $fieldName, $mappingId) {
      $a = array_keys($mappingId);
      $findBrandId = ' SELECT id, brandId from jnj_item where id in ('.implode(',', $a).')';
      $queryFindBrandId = mysqli_query(parent::dbConnection(), $findBrandId);
      $tempArrId = [];
      $tempArrBrandName = [];
      while($rs = mysqli_fetch_array($queryFindBrandId, MYSQLI_ASSOC)) {
          array_push($tempArrId, $rs['id']);
          array_push($tempArrBrandName, $rs['brandId']);
      }     
     return array_combine($tempArrId, $tempArrBrandName);
   }
    
/*Discription: fetching brand details based on his ID*/
   public function fetchBrandsIrrespectiveBrandId($tableName, $fieldName) {
      $result = parent::fetchTableValue($tableName, $fieldName);
      $tempArrId = [];
      $tempArrBrandName = [];  
      foreach($result as $val) {
         array_push($tempArrId, $val['id']);
         array_push($tempArrBrandName, $val['brandName']);  
      }
     return array_combine($tempArrId, $tempArrBrandName);
   }
    
/*Discription: fetching items details based on CVTL role*/
   public function fetchItemsIrrespectiveCVTLCustomer($tableName, $fieldName) {
     $result = parent::fetchTableValue($tableName, $fieldName);
      $tempArrId = [];
      $tempArrBrandName = [];  
      foreach($result as $val) {
         array_push($tempArrId, $val['id']);
         array_push($tempArrBrandName, $val['itemName']);  
      }
     return array_combine($tempArrId, $tempArrBrandName);
   }
    
/*Discription: Import the data from excel and load into DB*/
   public function importDataIntoTable($fileName=null) {
      /*$fh = fopen($fileName, 'r+');
      $arrPush = [];
      while (($data = fgetcsv($fh, filesize($fileName), ",")) !== false) {
        print_r($data);
        array_push($arrPush, $data);
      }
       print_r($arrPush);*/
      // fclose($fh);
      // $file = 'C:/xampp/htdocs/Site/jnj_bi_project/users/SuperAdmin/uploads/actualSalesFileTemplate.csv';
       $file = 'actualSalesFileTemplate.csv';
      /*$sql = "LOAD DATA INFILE 'C:/xampp/htdocs/Site/jnj_bi_project/users/SuperAdmin/uploads/actualSalesFileTemplate.csv' INTO TABLE jnj_actualsalesvalue FIELDS TERMINATED BY ',' ENCLOSED BY '"' LINES TERMINATED BY \n IGNORE 1 ROWS;"*/
      $sql = "LOAD DATA LOCAL INFILE \'.C:/xampp/htdocs/Site/jnj_bi_project/users/SuperAdmin/uploads/actualSalesFileTemplate.csv.\' INTO TABLE jnj_actualsalesvalue FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY ',,,\\r\\n' IGNORE 1 LINES (customerWWID, countryId, type, busSelector, itemId, brandId, unit, month, sales, value, unitPrice, year, status, sapCode, divested, createdDate, modifiedDate) SET customerWWID = NULLIF(@customerWWID, 'null'), countryId = NULLIF(@countryID, 'null'), type = NULLIF(@CustType, 'null'), busSelector = NULLIF(@busSelector, 'null'), itemId = NULLIF(@itemId, 'null'), brandId = NULLIF(@brandId, 'null'), unit = NULLIF(@Unit, 'null'), month = NULLIF(@month, 'null'), sales = NULLIF(@Sales, 'null'), value = NULLIF(@Value, 'null'), unitPrice = NULLIF(@UnitPrice, 'null'), year = NULLIF(@Year, 'null'), status = NULLIF(@Status, 'null'), sapCode = NULLIF(@SAPCode, 'null'), divested = NULLIF(@Divested, 'null'), createdDate = NOW(), modifiedDate = CURDATE() ";
      /*$sql = "LOAD DATA LOCAL INFILE \'.C:/xampp/htdocs/Site/jnj_bi_project/users/SuperAdmin/uploads/actualSalesFileTemplate.csv.\' INTO TABLE jnj_actualsalesvalue FIELDS TERMINATED BY \',\' OPTIONALLY ENCLOSED BY \'\\\"\' LINES TERMINATED BY \',,,\\\\r\\\\n\' IGNORE 1 LINES (customerWWID, countryId, type, busSelector, itemId, brandId, unit, month, sales, valueV, unitPrice, yearV, status, sapCode, divested, createdDate, modifiedDate) SET customerWWID = NULLIF(@customerWWID, \'null\'), countryId = NULLIF(@countryID, \'null\'), type = NULLIF(@CustType, \'null\'), busSelector = NULLIF(@busSelector, \'null\'), itemId = NULLIF(@itemId, \'null\'), brandId = NULLIF(@brandId, \'null\'), unit = NULLIF(@Unit, \'null\'), month = NULLIF(@month, \'null\'), sales = NULLIF(@Sales, \'null\'), valueV = NULLIF(@Value, \'null\'), unitPrice = NULLIF(@UnitPrice, \'null\'), yearV = NULLIF(@Year, \'null\'), status = NULLIF(@Status, \'null\'), sapCode = NULLIF(@SAPCode, \'null\'), divested = NULLIF(@Divested, \'null\'), createdDate = NOW(), modifiedDate = CURDATE()";*/
      // echo $sql;
       mysqli_query(parent::dbConnection(), $sql);
       $affected = (int) (mysqli_affected_rows(parent::dbConnection()))-1;
       echo $affected;
   }

   public function fetchMultipleRecordsByDateTimeMain($tableName, $fieldName, $year, $condition) {
      return parent::fetchMultipleRecordsByDateTime($tableName, $fieldName, $year, $condition);
   }

   public function fetchActualSalesRecordsByDateTime($tableName, $fieldName, $year, $condition) {
      return parent::fetchActualSalesRecordsByDateTimeMain($tableName, $fieldName, $year, $condition);
   }

/*Discription: fetching fftarget sales from table*/
   public function fetchTargetSales($tableName, $fieldName, $year, $condition=null) {
      $condition = ' customerName='.$_SESSION['customerName'].' AND year='.$year;
      // $sql =' SELECT '.$fieldName.' FROM '.$tableName.' WHERE '.$condition.' ORDER BY id DESC';
      $sql =' SELECT '.$fieldName.' FROM '.$tableName.' WHERE '.$condition;
      $query = mysqli_query(parent::dbConnection(), $sql);
      $tempArr = [];
        if(count($query) > 0) {
         $i = 1;
          foreach ($query as $key => $val) {
             // array_push($tempArr, $val['fftarget']);
             $tempArr[$i] = $val['fftarget'];
             $i++;
          }
        }
      $rs = implode(',',$tempArr);
      return $tempArr;
   }

/*Discription: fetching rolling forecast from table*/
   public function fetchLastRollingForecast($tableName, $fieldName, $year, $previousMonth, $condition=null) {
      // $conditions = ' customerWWID='.$_SESSION['customerName'].' AND year='.$year.' AND month='.$previousMonth.' ORDER BY id DESC';
      $conditions = ' customerWWID='.$_SESSION['customerName'].' AND year='.$year.' AND month='.$previousMonth;   
      $sql =' SELECT '.$fieldName.' FROM '.$tableName.' WHERE '.$conditions;
      // echo $sql;
      $query = mysqli_query(parent::dbConnection(), $sql);
      $tempArr = [];
        if(count($query) > 0) {
         $i = 1;
          foreach ($query as $key => $val) {
             // array_push($tempArr, $val['fftarget']);
             $tempArr[$i] = $val[$fieldName];
             $i++;
          }
        }
      $rs = implode(',',$tempArr);
      return $tempArr;
   }
    
   public function fetchUpsideVolume($tableName, $fieldValues, $customerName, $itemValue, $year) {
      $sql = ' SELECT '.implode(',', $fieldValues).' FROM '.$tableName.' WHERE customerWWID='.$customerName.' AND itemid='.$itemValue.' AND yearValue='.$year;
     // echo $sql;
      $query = mysqli_query(parent::dbConnection(), $sql);
      $tempArr = [];
        if(!empty($query)) {
         $i = 1;
          foreach ($query as $key => $val) {
             $tempArr[$val['itemId']][$val['monthValue']] = $val['upSidevalue'];
             $i++;
          }
        }
      
      return $tempArr;
   }
    
   public function fetchDownsideVolume($tableName, $fieldValues, $customerName, $itemValue, $year) {
      $sql = ' SELECT '.implode(',', $fieldValues).' FROM '.$tableName.' WHERE customerWWID='.$customerName.' AND itemid='.$itemValue.' AND yearValue='.$year;
      // echo $sql;
      $query = mysqli_query(parent::dbConnection(), $sql);
      $tempArr = [];
        if(!empty($query)) {
         $i = 1;
          foreach ($query as $key => $val) {
             $tempArr[$val['itemId']][$val['monthValue']] = $val['downSidevalue'];
             $i++;
          }
        }      
      return $tempArr;
   }

   public function fetchNGFSytemAPI() {
     $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "	http://dummy.restapiexample.com/api/v1/employees",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array("x-rapidapi-host: weatherbit-v1-mashape.p.rapidapi.com", "x-rapidapi-key: SIGN-UP-FOR-KEY"),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
   }
   
   public function fetchPricingDataEntry($tableName, $customerWWID=NULL, $year=NULL) {
      $sql = 'SELECT * FROM '.$tableName;
        if($year!= NULL) {
           $sql.= ' WHERE year='.$year;
        }
      $query = mysqli_query(parent::dbConnection(), $sql);
      $tempArr = [];
        if(!empty($query)) {
          foreach ($query as $key => $val) {
             array_push($tempArr, $val);
          }
        }      
      return $tempArr;
   }
}// End class
