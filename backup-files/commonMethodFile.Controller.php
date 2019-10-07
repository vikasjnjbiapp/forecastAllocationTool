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
    
  /*This function create the connection between your PHP application and MySQL*/
    public function dbConnection($host=null, $user=null, $password=null, $db=null) {
        $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db);
        if(!$this->conn) {
            die('Error '.mysqli_error());
        }
       return $this->conn;
    }
  /*This function create the file name, which call when ever your event will execute*/
    public function fileNameCreation($fileName, $customerName, $ext='php') {
        if($fileName === 'registration' || $fileName === 'login' || $fileName === 'logout' || $fileName === 'home') {
            $path = '';
            $middleValue = 'component';
        } else {
            if($customerName!==""){
               if($_SESSION['userRole'] === 'SuperAdmin') {
                   $path = 'users/SuperAdmin/';
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
  /*It will decoded your password and take the first element of string*/
    public function createDecodedPassword($password) {
        $passValue = base64_decode($passValue);
        return explode(',', $passValue)[0];
    }
  /*create the router for all pages*/
    public function pageRouter($fileName, $customerName) {
        return $this->fileNameCreation($fileName, $customerName);
    }
  /*This function will fetch the data from the table basis of the second argument*/
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
       $sql = " INSERT INOT ".$tableName." ".implode(',', $fieldName)." VALUES ".implode(',', $valueArray);
       echo $sql;
    }
  /*Insert the data into reistation table*/
    public function insertRegistrationTable($tableName, $valueArray, $fieldName=null) {
      $tempArr = [];
      $errorNum = '';
      if($tableName === 'jnj_registration') {
         $sql = " INSERT INTO ".$tableName." (`customerName`, `password`, `confpassword`, `userRole`, `countryName`, `month`, `year`, `createDate`, `modifiedDate`) VALUES ";
          if(!empty($valueArray)) {
            for($i=0; $i<count($valueArray);$i++) {
               if($valueArray[$i]['value'] === '') {
                  $errorNum = 0;
               }
            }
            $sql.= "(".$valueArray[0]['value'].",'".$this->createEncryptedPassword($valueArray[1]['value'])."','".$this->createEncryptedPassword($valueArray[2]['value'])."',".$valueArray[3]['value'].",".$valueArray[4]['value'].",".$valueArray[5]['value'].",".$valueArray[6]['value'].",CURDATE(), CURDATE())";
          }        
      }
       if($errorNum) {
         echo 0;
       } else {
         $rs = mysqli_query($this->dbConnection(), $sql);
         echo $rs; 
       }
    }
  /*This function for fetch the single records from DB*/
    public function checkAndFetchSingleRecord($tableName, $fieldName, $condition) {
      $sql = " SELECT ".$fieldName." FROM ".$tableName." WHERE ".$condition;
      // echo $sql;
      $query = mysqli_query($this->dbConnection(), $sql);
      $rs = mysqli_fetch_array($query, MYSQLI_ASSOC);
      return $rs;
    }
    public function fetchMultipleRecords($tableName, $fieldName, $condition) {
      $sql = " SELECT ".$fieldName." FROM ".$tableName." WHERE ".$condition;
      // echo $sql;
      $query = mysqli_query($this->dbConnection(), $sql);
      $tempArr = [];
       while($rs = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
          array_push($tempArr, $rs);
       }
      return $tempArr;
    }
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
}// End class