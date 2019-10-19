<?php
session_start();
require_once('admin/controllers/commonMethodFile.Controller.php');
require_once('admin/controllers/specificMethodFile.Controller.php');
$specificMethod = new specificMethodFile();

$importDataFile = function($fileNameArg, $uploadDir, $classObject) {
    $uploadStatus = 1;
    $uploadedFile = '';
    if(!empty($fileNameArg)){
      $fileName = basename($fileNameArg); 
      $targetFilePath = $uploadDir . $fileName;
      $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
        // Allow certain file formats 
        $allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg', 'csv'); 
        if(in_array($fileType, $allowTypes)){ 
            // Upload file to the server
            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 
                $uploadedFile = $fileName;
                $uploadStatus = 1;
            }else{ 
                $uploadStatus = 0; 
                $response['message'] = 'Sorry, there was an error uploading your file.'; 
            } 
        }else{ 
            $uploadStatus = 0; 
            $response['message'] = 'Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.'; 
        }
    }
    if($uploadStatus === 1) {
       //$rs = $classObject->importDataIntoTable();
       $cmd = 'perl  C:/xampp/htdocs/Site/jnj_bi_project/users/SuperAdmin/actualSalesScript.pl';
       exec($cmd, $rs);
    }
  return $rs;
};

$uploadDirectory = 'users/SuperAdmin/uploads/';

if(isset($_GET['pageImport']) && $_GET['pageImport'] === 'importDataFile') {
   $a = $importDataFile($_FILES["file"]["name"], $uploadDirectory, $specificMethod);
   print_r($a);    
}
$page = isset($_POST['page'])?$_POST['page']:null;
if($page === 'fetchNGFSytemRecords') {
   $fetchNGFSytemRecords = $specificMethod->fetchNGFSytemAPI();
}