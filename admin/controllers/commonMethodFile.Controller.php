<?php
/*
FileName:: commonMethodFile Controller


*/
class commonMethodFile {
    private $conn;
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $db = 'jnjbiapplication';
    
/*Discription: This function create the connection between your PHP application and MySQL*/
    public function dbConnection($host=null, $user=null, $password=null, $db=null) {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db);
        if(!$this->conn) {
            die('Error '.mysqli_error());
        }
       return $this->conn;
    }

/*Discription: This function create the file name, which call when ever your event will execute*/
    public function fileNameCreation($fileName, $customerName, $ext='php') {
        if($fileName === 'registration' || $fileName === 'login' || $fileName === 'logout' || $fileName === 'home') {
            $path = '';
            $middleValue = 'component';
        } else {
            if($customerName!==""){
               if($_SESSION['userRole'] === 'SuperAdmin') {
                   $path = 'users/SuperAdmin/';
               } else if($_SESSION['userRole'] === 'CVTL') {
                   $path = 'users/CVTL/';
               } else if($_SESSION['userRole'] === 'Pricing Team') {
                   $path = 'users/PricingTeam/';
               } else {
                  $path = 'users/TAL/'; 
               }              
               $middleValue = 'views';
            } else {
               $path = '';
               $middleValue = 'component';
            }            
        }
        require_once("$path$fileName.$middleValue.$ext");
        // require_once("views/app.component.php");
    }

  /*This function create the logic of encryption of password*/
    public function createEncryptedPassword($password) {
        $value = $password.",".date('Y');
        return base64_encode($value);
    }
  /*Not used*/
    public function createEncodedPassword($password, $y) {
        $passValue = $password.','.$y;
        return base64_encode($passValue);
    }
/*Discriptoin: It will decoded your password and take the first element of string*/
    public function createDecodedPassword($password) {
        $passValue = base64_decode($passValue);
        return explode(',', $passValue)[0];
    }

/*Discription: create the router for all pages*/
    public function pageRouter($fileName, $customerName) {
        return $this->fileNameCreation($fileName, $customerName);
    }

/*Discription: This function will fetch the data from the table basis of the second argument*/
    public function fetchTableValue($tableName, $fieldName) {
       $sql = " SELECT ".$fieldName." FROM ".$tableName;
       $query = mysqli_query($this->dbConnection(), $sql);
       $tempArr = [];
       while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
          array_push($tempArr, $rs);
       }
      return $tempArr;
    }

/*Not used*/
    public function insertDataIntoTable($tableName, $fieldName, $valueArray, $year) {
       // $sql = " INSERT INTO ".$tableName." (".implode(',', $fieldName).") VALUES ";
       $sql = " INSERT IGNORE INTO ".$tableName." ".$fieldName." VALUES ";
       for($i=0; $i<count($valueArray); $i++) {
           if(!empty($valueArray[$i])) {
               if($i > 0) {
                 $sql.= ',';
               }
               $sql.= '('.implode(',', $valueArray[$i]).','.$year.',CURDATE(), CURDATE())'; //ON DUPLICATE KEY UPDATE customerName=customerName, countryId=countryId, itemId=itemId
           }
       }
      // echo $sql;
      $query = mysqli_query($this->dbConnection(), $sql);
      return $query;
    }

/*Discription: used while enter the value in TAL/CVTL temp table + Rolling forecast table*/
    public function insertDataIntoMultiTables($tableName, $fieldName, $valueArray, $year) {
       $sql = " INSERT IGNORE INTO ".$tableName." ".$fieldName." VALUES ";
       for($i=0; $i<count($valueArray); $i++) {
           if(!empty($valueArray[$i])) {
               if($i > 0) {
                 $sql.= ',';
               }
               $sql.= '('.implode(',', $valueArray[$i]).','.$year.',NOW(), CURDATE())';
           }
       }
     // echo $sql ."\n";
      $query = mysqli_query($this->dbConnection(), $sql);
      $secondTable = ($tableName === 'jnj_temp_tal_dataentry')?'jnj_totalrollingforecast' : 'jnj_totalrollingforecast_cvt';
       $sqlTwo = " INSERT IGNORE INTO ".$secondTable." (`customerWWID`, `itemId`, `month`, `year`, `rollingForecast`, `rollingForecastFocs`, `createdDate`, `modifiedDate`) VALUES ";
         for($i=0; $i<count($valueArray); $i++) {
           if(!empty($valueArray[$i])) {
               if($i > 0) {
                 $sqlTwo.= ',';
               }
              $sqlTwo.= '('.$valueArray[$i]['customerName'].','.$valueArray[$i]['itemId'].','.date("m").','.$year.','.$valueArray[$i]['lastRollingForecastFcast'].','.$valueArray[$i]['lastRollingForecastFocs'].',NOW(), CURDATE())';
            }
        }
      // echo $sqlTwo;
      $queryTwo = mysqli_query($this->dbConnection(), $sqlTwo);
      return $queryTwo;
    }

/*Discription: used while the data enter into reistation table*/
    public function insertRegistrationTable($tableName, $valueArray, $fieldName=null) {
      $tempArr = [];
      $errorNum = '';
      if($tableName === 'jnj_registration') {
         $sql = " INSERT INTO ".$tableName." (`customerName`, `password`, `confpassword`, `email`, `countryName`, `month`, `year`, `createDate`, `modifiedDate`) VALUES ";
          if(!empty($valueArray)) {
            for($i=0; $i<count($valueArray);$i++) {
               if($valueArray[$i]['value'] === '') {
                  $errorNum = 0;
               }
            }
            $sql.= "(".$valueArray[0]['value'].",'".$this->createEncryptedPassword($valueArray[1]['value'])."','".$this->createEncryptedPassword($valueArray[2]['value'])."','".$valueArray[3]['value']."',".$valueArray[4]['value'].",".date("m").",".date("Y").",CURDATE(), CURDATE())";
          }        
      }
        // echo $sql;
       if($errorNum) {
         echo 0;
       } else {
         $rs = mysqli_query($this->dbConnection(), $sql);
         echo $rs; 
       }
    }

/*Discription: This function for fetch the single records from single table*/
    public function checkAndFetchSingleRecord($tableName, $fieldName, $condition) {
      $sql = " SELECT ".$fieldName." FROM ".$tableName." WHERE ".$condition;
     // echo $sql;
      $query = mysqli_query($this->dbConnection(), $sql);
      $rs = mysqli_fetch_array($query, MYSQLI_ASSOC);
      return $rs;
    }

/*Discription: fetching the multiple records from single table*/
    public function fetchMultipleRecords($tableName, $fieldName, $condition=null) {
      $sql = " SELECT ".$fieldName." FROM ".$tableName;
        if($condition!== null){
          $sql.=" WHERE ".$condition; 
        }
      // echo $sql;
      $query = mysqli_query($this->dbConnection(), $sql);
      $tempArr = [];
      if(@ mysqli_num_rows($query) > 0) {
           while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
              array_push($tempArr, $rs);
           }
       }
      return $tempArr;
    }

/*Discription: fetching multiple records from multiple tables*/
    public function joinTwoOrMultipleRecords($tableNames, $fieldNames, $onConditions, $whereCond) {
      $field = implode(',', $fieldNames);  
      $sql = " SELECT ".$field." FROM ".$tableNames[0]." JOIN ".$tableNames[1]." ON ".$onConditions;
        if($whereCond !== null){
            $sql.= " WHERE ".$whereCond;
        }
      // echo $sql;
      $query = mysqli_query($this->dbConnection(), $sql);
      $tempArr = [];
       while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
          array_push($tempArr, $rs);
       }
      return $tempArr[0];
    }

/*Discription: update the details of single table*/
    public function updateTableDetails($tableName, $fieldNames, $arrayData, $condition) {      
      $sql = ' UPDATE '.$tableName.' SET '.$fieldNames[0].'="'.$arrayData[1]['value'].'", '.$fieldNames[1].'='.$arrayData[2]['value'].', '.$fieldNames[2].'='.$arrayData[3]['value'].' WHERE '.$condition;
      $query = mysqli_query($this->dbConnection(), $sql);
      return $query;
    }

/*Discription: update the details of single table for multiple field values*/
    public function updateTableDetailValues($tableName, $fieldNames, $arrayData, $condition) {
      // print_r($arrayData);
      $sql = ' UPDATE '.$tableName.' SET ';
        if(!empty($fieldNames)) {
           foreach($fieldNames as $key => $val) {
               $sql.= $fieldNames[$key].'="'.$arrayData[$key].'"';
           }
        }
      $sql.= ' WHERE '.$condition;
      // echo $sql;
      $query = mysqli_query($this->dbConnection(), $sql);
      return $query;
    }

/*Discription: Specificly for fetcing rolling forecast volume*/
    public function fetchLastRollingForecast($tableName,$fields, $conditions=null, $month, $year) {
      $sql = ' SELECT '.$fields.' FROM '.$tableName.' WHERE ';
        if($conditions !== null)
          $sql.=$conditions;
      $sql.= ' AND month='.$month.' AND year='.$year;
      $query = mysqli_query($this->dbConnection(), $sql);
      /*$tempArr = [];
       while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
          array_push($tempArr, $rs);
       }*/
      $rs = mysqli_fetch_array($query, MYSQLI_ASSOC);
      echo (!empty($rs['rollingForecast']))?$rs['rollingForecast']:0;
    }

/*Discription: fetching multiple records basis of date and time - IMP*/
    public function fetchMultipleRecordsByDateTime($tableName, $fieldName, $year, $condition=null) {
      $sql = " SELECT ".$fieldName." FROM ".$tableName;
        if($condition!== null){
          $sql.=" WHERE ".$condition; 
        }
        // $sql.= " AND talId in (SELECT talId FROM ".$tableName." WHERE createDate = (SELECT MAX(createDate) FROM ".$tableName." where year=".$year.")) ORDER BY talId DESC";
        $sql.= " AND talId in (SELECT talId FROM ".$tableName." WHERE createDate = (SELECT MAX(createDate) FROM ".$tableName." where year=".$year.")) ";
      //echo $sql;
      $query = mysqli_query($this->dbConnection(), $sql);
      $tempArr = [];
      if(@ mysqli_num_rows($query) > 0) {
           while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
              array_push($tempArr, $rs);
           }
       }
      return $tempArr;
    }

/*Discription: fetching sales records from table*/
    public function fetchActualSalesRecordsByDateTimeMain($tableName, $fieldName, $year, $condition=null) {
       $sql = " SELECT ".$fieldName." FROM ".$tableName;
        if($condition!== null){
          $sql.=" WHERE ".$condition; 
        }
        // $sql.= " AND id in (SELECT id FROM ".$tableName." WHERE createdDate = (SELECT MAX(createdDate) FROM ".$tableName." where year=".$year.")) ORDER BY id DESC";
        $sql.= " AND id in (SELECT id FROM ".$tableName." WHERE createdDate = (SELECT MAX(createdDate) FROM ".$tableName." where year=".$year."))";
        // echo $sql;
        $query = mysqli_query($this->dbConnection(), $sql);
        $tempArr = [];
        if(@ mysqli_num_rows($query) > 0) {
           while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
              array_push($tempArr, $rs);
           }
        }
      return $tempArr;    
    }
    
/*Discription: insert upside/downside value into tables respectively*/
    public function insertUpSideDownSide($tableName, $data, $sideValue, $year) {
      $jsoneDecoded = json_decode($data, true);
          $month = ['jan'=>1, 'feb'=>2, 'mar'=>3, 'apr'=>4, 'may'=>5, 'jun'=>6, 'jul'=>7, 'aug'=>8, 'sep'=>9, 'oct'=>10, 'nov'=>11, 'dec'=>12];
          if($tableName === 'jnj_upsideTable') {
              $sql = ' INSERT INTO '.$tableName.' (`customerWWID`, `itemId`, `upSideValue`, `monthValue`, `yearValue`, `status`, `createdDate`, `modifiedDate`) VALUES ';
          } else {
              $sql = ' INSERT INTO '.$tableName.' (`customerWWID`, `itemId`, `downSideValue`, `monthValue`, `yearValue`, `status`, `createdDate`, `modifiedDate`) VALUES ';
          }
        $sql .= '('.$jsoneDecoded['customerWWID'].','.$jsoneDecoded['itemId'].','.$sideValue.','.$month[$jsoneDecoded['Months']].','.$year.',1,NOW(),CURDATE())';
        // echo $sql;
        $rs = mysqli_query($this->dbConnection(), $sql);
      echo $rs;       
    }

}// End class