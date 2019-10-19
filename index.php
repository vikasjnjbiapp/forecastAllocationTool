<!DOCTYPE html>
<?php   session_start();
$customerName = (isset($_SESSION['customerName']))?$_SESSION['customerName']:'';
// echo "Hello ".$customerName;
require_once('admin/controllers/commonMethodFile.Controller.php');
require_once('admin/controllers/specificMethodFile.Controller.php');
$commonMethod = new commonMethodFile();
$case = base64_decode(explode('/', $_SERVER['QUERY_STRING'])[0]);
if($case===''){
  $case = 'home';
}
?>
<html lang="en">
<head>
<title>J&J BI Tool </title>
<!-- base href="/" -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <!-- select2-bootstrap4-theme -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.min.css" rel="stylesheet">

<style>
    .bs-example{
        margin: 20px;        
    }
    .form-control {
        width:400px;
    }
    input.error { border: 1px dotted red; }

</style>
<script>
    $(document).ready(function(){
        url = window.location.href.split('#');

       $('#myModal').on('shown.bs.modal', function () {
          $('#myInput').trigger('focus')
        });    
    });
let sessionVal = document.cookie;

</script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
    <div class="container" style="max-width:100%">
        <a href="#" class="navbar-brand mr-3">Johnson & Johnson</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav justify-content-end">
              <li class="nav-item active">
                <a class="nav-link" href="?<?php echo base64_encode('home');?>">Home <span class="sr-only">(current)</span></a>
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <?php if($customerName!=="") { ?>   
              <li class="nav-item"><a href="?<?php echo base64_encode('dashboard'); ?>" class="nav-item nav-link" id="Iflogin">Dashoard</a></li>
              <li class="nav-item"><a href="?<?php echo base64_encode('dataEntry'); ?>" class="nav-item nav-link" id="Entrygrid">Master Data Entry</a></li>
              <?php if($_SESSION['userRole']==='CVTL') { ?>
                 <li class="nav-item"><a href="?<?php echo base64_encode('reviewForecast'); ?>" class="nav-item nav-link" id="reviewForecast">Review Forecast</a></li>
              <?php } ?>
                 <?php if($customerName === 1) { ?>
                      <!--li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Bulk Import
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="#">Item Import</a>
                          <a class="dropdown-item" href="#">Brand Import</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#">Master Data Import</a>
                        </div>
                      </li>
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Single Item Add
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="#">Item Add</a>
                          <a class="dropdown-item" href="#">Brand Add</a>
                        </div>
                      </li>
              <li class="nav-item"><a href="?<?php echo base64_encode('dataLogs'); ?>" class="nav-item nav-link" id="Analysisdata">Data Logs</a></li-->
                <?php } ?>
              <li class="nav-item"><a href="?<?php echo base64_encode('logout'); ?>" class="nav-item nav-link" id="Logout">Logout</a></li>
              <?php } else { ?>
              <li class="nav-item"> <a href="?<?php echo base64_encode('registration'); ?>" class="nav-item nav-link" id="Register">Register</a></li>
              <li class="nav-item"><a href="?<?php echo base64_encode('login'); ?>" class="nav-item nav-link" id="Login">Login</a></li>
              <?php } ?>
            </ul>            
        </div>
    </div>    
</nav>
<div class="container" style="max-width:100%">
    <div class="jumbotron row">
        <div class="col-md-6"><h1><span id="topic"><?php echo strtoupper($case);?></span></h1></div>
        <div class="col-md-6 text-md-right">
           <span id="details">
            <?php if($customerName !== "") { ?>
            User: <?php echo $_SESSION['userRole'].' :: '.$_SESSION['customerName'];?> <br/>
            Year: <?php echo date("Y");?>
            <?php } else { ?>
            Customer Number: Guest <br/>
            Year: <?php echo date("Y");?>
            <?php } ?>
            </span>
        </div>
        <!-- p class="lead">In today's world internet is the most popular way of connecting with the people. At <a href="https://www.tutorialrepublic.com" target="_blank">tutorialrepublic.com</a> you will learn the essential web development technologies along with real life practice examples, so that you can create your own website to connect with the people around the world.</p>
        <p><a href="https://www.tutorialrepublic.com" target="_blank" class="btn btn-success btn-lg">Get started today</a></p -->
    </div>
    <!--div id="app-root"></div-->
    <?php
        $commonMethod->pageRouter($case, $customerName);
    ?>
    <footer>
        <div class="row">
            <div class="col-md-6">
                <p>Copyright &copy; 2019 Johnson & Johnson</p>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="#" class="text-dark">Terms of Use</a> 
                <span class="text-muted mx-2">|</span> 
                <a href="#" class="text-dark">Privacy Policy</a>
            </div>
        </div>
    </footer>
</div>
    
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="addItemForm" name="addItemForm" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="col">
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fa fa-bandcamp"></span>
                            </span>                    
                        </div>
                        <input type="text" class="form-control" placeholder="Item Name" value="" id="itemName" name="itemName" style="width:130px;">
                    </div>
                </div><br/>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fa fa-bandcamp"></span>
                            </span>                    
                        </div>
                        <input type="text" class="form-control" placeholder="Brand Name" value="" id="brandName" name="brandName">                                              
                    </div>
                </div><br/>
                <div class="col-sm-10">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <span class="fa fa-id-card"></span>
                            </span>                    
                        </div>
                        <input type="text" class="form-control" placeholder="SAP Code" value="" id="sapCode" name="sapCode">
                    </div>
                </div><br/>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- select2-bootstrap4-theme -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('#saveChanges').click(function(){
      $.post()
        location.reload(true);
    })
</script>
</body>
</html>
