<?php
// print_r($_SESSION);
$commonMethod = new commonMethodFile();
$regist = $commonMethod->fetchMultipleRecords('jnj_registration', '*', 'customerName!=1');
$registCVTL = $commonMethod->fetchMultipleRecords('jnj_registration', '*', 'userRole=2');
$country = $commonMethod->fetchTableValue('jnj_country', '*');
// $items = $commonMethod->fetchTableValue('jnj_item', '*');
$userRole = ['SuperAdmin', 'KAM Manger', 'CVTL', 'TAL', 'KAMs', 'Pricing Team', '9'=>'No Role'];
$userStatus = ['1'=>'Active', 'Deactive'];
?>
<!-- Display the chart and report -->
<ul class="nav nav-tabs" id="myTab">
    <li class="nav-item">
        <a href="#activeUserDetail" class="nav-link" data-toggle="tab" id="activeUserDetails">User Details</a>
    </li>
    <!--li class="nav-item">
        <a href="#userRoleDetail" class="nav-link" data-toggle="tab" id="userRoleDetails">User Role</a>
    </li-->
    <li class="nav-item">
        <a href="#countryItemMapping" class="nav-link" data-toggle="tab" id="countryItemMappingDetails"> Country&nbsp;| Customer &nbsp;| Item - Mapping</a>
    </li>
    <!--li class="nav-item">
        <a href="#assignTAL" class="nav-link" data-toggle="tab" id="assignTALs">Assign TALs</a>
    </li-->
    <li class="nav-item">
        <a href="#previousYear" class="nav-link" data-toggle="tab" id="year_18">Import Prvious Year Data</a>
    </li>
    <!--li class="nav-item">
        <a href="#onePreviousYear" class="nav-link" data-toggle="tab" id="year_17">Year - <?php echo date("Y")+3;?></a>
    </li>
    <li class="nav-item">
        <a href="#onePreviousYear" class="nav-link" data-toggle="tab" id="year_17">Year - <?php echo date("Y")+4;?></a>
    </li-->
</ul>
<div class="tab-content">
    <div class="tab-pane fade" id="activeUserDetail">
        <h4 class="mt-2">User Details </h4>
        <div class="table-responsive">
           <form id="entryGridActiveUser" name="entryGridActiveUser" method="post">
              <table class="table table-striped" id="activeUserTable">
                <thead>
                    <tr class="table-dark">
                        <th colspan="7"><div id="errorMessage"></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-12" style='width: 150px;'>Customer Number</div></th>
                        <th><div class="small col-4" style='width: 100px;'>Email</div></th>
                        <th><div class="small col-8" style='width: 100px;'>User Role</div></th>
                        <th><div class="small col-4" style='width: 100px;'>Acive/Deactive</div></th>
                        <th>&nbsp;</th>
                        <th><div class="small col-4" style='width: 100px;'>Action</div></th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                   $i = 1;
                   foreach($regist as $val) { ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">
                            <input type="text" class="form-control" placeholder="Customer Number" value="<?php echo $val['customerName'];?>" name="customerUserRole" id="customerUserRole" style='width: 60px;' readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <input type="text" class="form-control" placeholder="Email" value="<?php echo $val['email'];?>" name="userEmail" id="userEmail" style='width: 150px;' readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                          <?php if($val['userRole'] !== '') {?>
                            <input type="text" class="form-control" placeholder="User Role" value="<?php echo $userRole[$val['userRole']];?>" name="userRoleOne" id="userRoleOne" style='width: 150px;' readonly>
                          <?php } ?>
                          </div></td>                        
                        <td><div class="input-group input-group-sm mt-2">
                          <?php if($val['userStatus'] !== '') {?>
                            <input type="text" class="form-control" placeholder="User Status" value="<?php echo $userStatus[$val['userStatus']];?>" name="userStatus" id="userStatus" style='width: 150px;' readonly>
                          <?php } ?>
                        </div></td>
                        <td>&nbsp;</td>
                        <td><div class="input-group input-group-sm mt-2">             
                            <a href="#" class="btn btn-primary" name="entryGridActiveUserEdit_<?php echo $i?>" id="entryGridActiveUserEdit_<?php echo $i?>" data-toggle="modal" data-target="#exampleModal" rs="<?php echo $val['customerName'];?>">Edit</a>
                        </div><!--button type="button" class="btn btn-primary" name="entryGridActiveUserEdit" id="entryGridActiveUserEdit" >Edit</button-->
                       </td>
                        <td>&nbsp;</td>
                    </tr>
                  <?php 
                    $i = $i + 1;
                   } ?>
                </tbody>
             </table>
            <!--div style="text-align:center;"><button type="button" id="btnActiveUserDetail" name="btnActiveUserDetail" class="btn btn-primary">Submit</button></div-->
           </form>
        </div>
    </div>
    <!--div class="tab-pane fade" id="userRoleDetail">
        <h4 class="mt-2">User Role </h4>
        <div class="table-responsive">
           <form id="entryGridUserRole" name="entryGridUserRole" method="post">
              <table class="table table-striped" id="sampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="6"><div id="errorMessage"></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-4" style='width: 150px;'>Customer Number</div></th>
                        <th><div class="small col-4" style='width: 100px;'>User Role</div></th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="customerUserRole" id="customerUserRole" class="form-control form-control-inline" style="width:100px;">
                                <option value='0'>Select Customer</option>
                                <?php foreach($regist as $val) {
                                    $disabled = '';
                                    if($val['userRole'] !== '') {
                                       $disabled = 'disabled';
                                    }
                                ?>
                                    <option value='<?php echo $val['customerName']; ?>' <?php echo $disabled;?>><?php echo $val['customerName']; ?></option>
                                <?php } ?>
                             </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <select name="userRoleOne" id="userRoleOne" class="form-control form-control-inline" style='width: 100px;'>
                                <option value='NA'>Select Role</option>
                                <option value='1'>KAM Manager</option>
                                <option value='2'>CVTL</option>
                                <option value='3' selected>TAL</option>
                                <option value='3'>KAM</option>
                            </select>
                        </div></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>    
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnUserRoleEntryGrid" name="btnUserRoleEntryGrid" class="btn btn-primary">Submit</button></div>
           </form>
        </div>
    </div-->
    <div class="tab-pane fade" id="countryItemMapping">
        <h4 class="mt-2">Item & User Mapping</h4>
        <div class="table-responsive">
        <form id="entryGridItemUserMapping" name="entryGridItemUserMapping" method="post">
            <table class="table table-striped" id="sampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="5"><div id="errorMessage"></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-4" style='width: 100px;'>Country</div></th>
                        <th><div class="small col-8" style='width: 100px;'>User Role</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Superior Customer</div></th>                      
                        <th><div class="small col-12" style='width: 150px;'>Junior Customer</div></th>
                        <th><div class="small col-4" style='width: 100px;'>Items</div></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">
                            <select name="countryCodeMapping" id="countryCodeMapping" class="form-control form-control-inline" style='width: 60px;'>
                                <option value='0'>Select Country</option>
                                <?php foreach($country as $countries) { ?>
                                    <option value="<?php echo $countries['id']?>" ><?php echo $countries['countryCode']?></option>
                                <?php } ?>
                             </select>
                            <!--input type="text" class="form-control" placeholder="Country" value="" name="countryCode" id="countryCode" readonly-->
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <select name="userRoleMapping" id="userRoleMapping" class="form-control form-control-inline" style='width: 100px;'>
                                <option value='0'>Select User Role</option>
                                <option value='1'>KAMs Manager</option>
                                <option value='2'>CVTL</option>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="superiorCustomerNumber" id="superiorCustomerNumber" class="form-control form-control-inline" style='width: 100px;'>
                                <option value='0'>Select Superior Customer</option>
                             </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="juniorCustomerNumber" id="juniorCustomerNumber" class="form-control form-control-inline" style='width: 100px;'>
                                <option value='0'>Select Junior Customer</option>
                             </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2" id="itemmappingDiv">                
                            <select name="itemMapping" id="itemMapping" class="form-control form-control-inline" style="height:200px;width: 200px;" multiple></select>
                        </div></td>
                    </tr>    
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridItemUserMapping" name="btnEntryGridItemUserMapping" class="btn btn-primary">Submit</button></div>
        </form>
        </div>
    </div>
    <!--div class="tab-pane fade" id="assignTAL">
        <h4 class="mt-2">Assign TALs</h4>
        <div class="table-responsive">
        <form id="entryGridCountry" name="entryGridCountry" method="post">
            <table class="table table-striped" id="sampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="4"><div id="errorMessage"></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-4" style='width: 60px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Customer Number - CVTLs</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Customer Number - TALs</div></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="countryCodeSec" id="countryCodeSec" class="form-control form-control-inline">
                                <option value='0'>Select Country</option>
                                <?php foreach($country as $val) { ?>
                                    <option value='<?php echo $val['id']; ?>'><?php echo $val['countryCode']; ?></option>
                                <?php } ?>
                             </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <select name="customerCVTL" id="customerCVTL" class="form-control form-control-inline" style='width: 100px;'>
                                <option value='0'>Select CVTL</option>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="customerTAL" id="customerTAL" class="form-control form-control-inline" style="height:100px;width: 100px;" multiple>
                               <?php
                                  foreach($regist as $val) {
                                    if($val['userRole'] === '2')
                                      $disabled = 'disabled';
                                    else
                                      $disabled = '';
                               ?>
                                <option value='<?php echo $val['id']; ?>' <?php echo $disabled;?> ><?php echo $val['customerName']; ?></option>
                               <?php } ?>
                            </select>
                        </div></td>
                    </tr>    
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary">Submit</button></div>
        </form>
        </div>
    </div-->
    <div class="tab-pane fade" id="previousYear">
        <h4 class="mt-2">Import Actual Sales</h4>
        <div class="table-responsive">
            <form id="entryItemEntryImport" name="entryItemEntryImport" method="post" enctype="multipart/form-data">              
              <div class="input-group mb-3">                
                <div class="input-group-append">
                  <input type="file" name="file" id="file">
                 </div>
                 <div style="text-align:center;"><button class='btn btn-primary'id="submitbutton" type="submit">Upload CSV file!</button></div>  
              </div>
            </form>
        </div>
    </div>
    <!--div class="tab-pane fade" id="onePreviousYear">
        <h4 class="mt-2"><?php echo date("Y")-2;?> Data</h4>
    </div-->
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:800px;">
      <form id="updateUserDetailForm" name="updateUserDetailForm" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">User Details:: </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table class="table table-striped" id="sampleTbl">
            <thead>
                <tr class="table-primary">
                    <th><div class="small col-12" style='width: 150px;'>Customer Number</div></th>
                    <th><div class="small col-4" style='width: 100px;'>Email</div></th>
                    <th><div class="small col-8" style='width: 100px;'>User Role</div></th>
                    <th><div class="small col-4" style='width: 100px;'>Acive/Deactive</div></th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td><div class="input-group input-group-sm mt-2">
                    <input type="text" class="form-control" placeholder="Customer Number" value="<?php echo $val['customerName'];?>" name="customerUserRoleEdit" id="customerUserRoleEdit" style='width: 60px;' readonly>
                </div></td>
                <td><div class="input-group input-group-sm mt-2">
                    <input type="text" class="form-control" placeholder="Email" value="<?php echo $val['email'];?>" name="userEmailEdit" id="userEmailEdit" style='width: 150px;'>
                </div></td>
                <td><div class="input-group input-group-sm mt-2">                          
                    <select name="userRoleOneEdit" id="userRoleOneEdit" class="form-control form-control-inline" style='width: 60px;'>
                        <option value='NA'>Select Role</option>
                        <option value='1'>KAM Manager</option>
                        <option value='2'>CVTL</option>
                        <option value='3' selected>TAL</option>
                        <option value='4'>KAM</option>
                        <option value='5'>Pricing Team</option>
                    </select>
                  </div></td>                        
                <td><div class="input-group input-group-sm mt-2">
                    <select name="userStatusEdit" id="userStatusEdit" class="form-control form-control-inline" style='width: 100px;'>
                        <option value='NA'>Select Active/Deactive</option>
                        <option value='1' selected>Active</option>
                        <option value='2'>Deactive</option>
                    </select>
                </div></td>
              </tr>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChanges" name="saveChanges">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script src="javascript/papaparse.min.js"></script>
<script>
    $(document).ready(function(){ 
        $("#myTab a:first").tab('show'); // show last tab on page load
        $('#mychartOne').hide();
        $('[data-toggle="tooltip"]').tooltip({
            title: "Searcch by customer number or country name or item. <br/> You can also use three criteria togather using colum saparator.",
            html: true
        });
    });
/*Start:: activeUserDetail*/
    $('#entryGridActiveUser').each(function(i, td) {
       // console.log("Vikas ", i, $(td).find('a rs').val());
    });
    $("a[name*='entryGridActiveUserEdit']").click(function() {
       let customerNumber = $(this).attr('rs');
       let domElementName = ['customerUserRoleEdit', 'userEmailEdit'];
       let responseField = ['customerName', 'email']
       getResponse('router.php', 'fetchUserDetails', customerNumber, domElementName, responseField);       
    });
    $('#saveChanges').click(function() {
       let tempData = $('#updateUserDetailForm').serializeArray();
       postRequest('router.php', 'updateUserDetails', tempData);       
    });
/*End:: activeUserDetail*/
/*Start:: entryGridItemUserMapping*/
    $('#countryCodeMapping').change(function() {
        $('#userRoleMapping').prop('selectedIndex',0);
        $('#superiorCustomerNumber').prop('selectedIndex', 0);
        $('#juniorCustomerNumber').prop('selectedIndex', 0);
        $.post('router.php', {page: 'fetchItemIrrespectCountry', arrayData: $(this).val()}, function(data) {
          console.log(data);
           $('#itemmappingDiv').html(data);
        });
    });
    $('#userRoleMapping').change(function() {
        let tempArrayData = [$('#countryCodeMapping').val(), $(this).val()];
        $.post('router.php', {page: 'fetchCustomerIrrespectUserRole', arrayData: tempArrayData}, function(data) {
           $('#superiorCustomerNumber').html(data);
        });
    });
    $('#superiorCustomerNumber').change(function() {
        $.post('router.php', {page: 'fetchCustomerIrrespectSC', arrayData:$(this).val()}, function(data) {
            let itteration = data.split(',');
            let tempDrop = '<option value="0">Select Junior Customer</option>';
            if(itteration.length > 1) {
                for(let i in itteration) {
                    tempDrop +='<option value='+itteration[i]+'>'+itteration[i]+'</option>';
                }
            }
            $('#juniorCustomerNumber').html(tempDrop);
        });        
    });
    $('#btnEntryGridItemUserMapping').click(function() {
        let tempArrayData = $('#entryGridItemUserMapping').serializeArray();
        $.post('router.php', {page: 'updateItemUserMapping', arrayData: tempArrayData}, function(data) {
           if(data > 0) {
              alert('User register successfully'+data);
              window.location.href = 'http://localhost/Site/jnj_bi_project/?<?php echo base64_encode('dashboard'); ?>';
           }
        });        
    });
    $('#juniorCustomerNumber').change(function() {
       $.post('router.php', {page: 'fetchItemIrrespectJuniorCustomer', arrayData: $(this).val()}, function(data) {
           console.log(data);
       });
    })
/*End:: entryGridItemUserMapping*/
/*Start:: submitbutton*/
    $('#entryItemEntryImport').on('submit', function(e) {
       e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'test.php?pageImport=importDataFile',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
               // $('#submitbutton').attr("disabled","disabled");
                // $('#entryItemEntryImport').css("opacity",".5");
            },
            success: function(response){
              console.log(response);
                /*if(response === 1){
                    // $('#entryItemEntryImport').reset();
                    $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
                }else{
                    $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
                }*/
                $('#entryItemEntryImport').css("opacity","");
                $("#submitbutton").removeAttr("disabled");
            }
        }); 
    })
/*End::*/
/*$("#submitbutton").click(function(){
  var myfile = $("#file")[0].files[0];
  console.log(myfile);
  var json = Papa.parse(myfile, {
        header: true, 
        skipEmptyLines: true,
        complete: function(results) {
            console.log("Dataframe:", JSON.stringify(results.data));
            console.log("Column names:", results.meta.fields);
            console.log("Errors:", results.errors);
            var jsonString = JSON.stringify(results.data,undefined, 2);
            $.post('router.php', {page: 'importDataFile', arrayData: jsonString}, function(data) {
                console.log(data);
            });
        }
    });
});*/

    
/*----------- Common functions ----------------------*/
   var getResponse = function(argUrl, argPage, argArrayData, domElementName, responseField) {
      $.post(argUrl, {page: argPage, arrayData: argArrayData}, function(data) {
        let tempData = data.split(',');
        if(tempData.length > 1) { 
            $('#'+domElementName[0]).val(tempData[0]);
            $('#'+domElementName[1]).val(tempData[1]);
        }
      });
   };
   var postRequest = function(argUrl, argPage, argArrayData ){
      $.post(argUrl, {page: argPage, arrayData: argArrayData}, function(data) {
          if(data) {
             alert('Data update sucessfully.'+data);
          }
      });
   };
</script>