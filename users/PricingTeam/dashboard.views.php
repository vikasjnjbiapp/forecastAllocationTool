<?php
  // print_r($_SESSION);
$unit = ['CNS', 'ID', 'IMM', 'MB & RP', 'OH'];
$busSector = ['DPO', 'TND'];
$status = ['Not Registered', 'Registered'];
$divested = ['No', 'Yes'];
$specificMethod = new specificMethodFile();
$country = $specificMethod->fetchCountryDetails('jnj_country', $_SESSION['countryName']);

$fields = implode(',',['id','brandName']);
$brandOne = $specificMethod->fetchBrandsIrrespectiveBrandId('jnj_brand', $fields);

$tableName = ['jnj_item', 'jnj_registration'];
$itemOne = $specificMethod->fetchItemsIrrespectiveCustomer($tableName, $_SESSION['customerName']);

$dateVal = [date("Y"), date("Y")+1, date("Y")+2, date("Y")+3, date("Y")+4];
?>
<script lang="javascript" src="javascript/xlsx.full.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
      function myFunction() {
        var x = document.getElementById("Dashboard");
        if (x.style.display === "none") {
        x.style.display = "block";
        $('#first_page').hide();
        $('#back_page').show();
        }
        }  
        function newFunction() {
        var x = document.getElementById("Dashboard");
        if (x.style.display === "block") {
        x.style.display = "none";
        $('#first_page').show();
        $('#back_page').hide();
        }
        }  
     
</script>

<!-- Original Page  -->
  <ul class="nav nav-tabs" id="tablist">
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#pricing">Pricing</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#currency">Currency Master table</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#distrubutor">Distributor Markup</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="pricing" class="tab-pane fade">
        <div class="container-fluid" id="first_page" style="padding-top: 10px;">
          <div class="row">
            <div class="col-sm-6" >
                <div class="input-group mb-3">
                 <button class= "btn btn-secondary" id="submitbutton" type="button">Upload the File</button>
                </div>
            </div>
            <!--div class="col-sm-6">
                <button type="button" class="btn btn-secondary" onclick="myFunction()" >Click to View the Dashboard</button>
            </div-->
          </div>
        </div>
        <div class="table-responsive" style="height:550px;">
            <table class="table table-striped" style="font-family: calibri;">
              <thead class="table table-secondary">
               <tr >
                    <th class="col-8" style="width:150px;">Material</th>
                    <th class="col-12" style="width:250px;">SKU</th>
                    <th class="col-8" style="width:150px;">Country Code</th>
                    <th class="col-8" style="width:150px;">Currency</th>
                    <th style="text-align:center" colspan="12">2020 CIF</th>
                    <th style="text-align:center" colspan="12">2020 TENDER PRICES</th>
                    <th style="text-align:center" colspan="3">Private Discounts</th>
                  </tr>
                  <tr class="table-primary">
                    <th class="small col-8" colspan="4"></th>
                    <th class="small col-8" style="border-left: 1px solid #dee2e6;">Jan</th>
                    <th class="small col-8">Feb</th>
                    <th class="small col-8">Mar</th>
                    <th class="small col-8">Apr</th>
                    <th class="small col-8">May</th>
                    <th class="small col-8">Jun</th>
                    <th class="small col-8">Jul</th>
                    <th class="small col-8">Aug</th>
                    <th class="small col-8">Sep</th>
                    <th class="small col-8">Oct</th>
                    <th class="small col-8">Nov</th>
                    <th class="small col-8">Dec</th>
                    <th class="small col-8" style="border-left: 1px solid #dee2e6;">Jan</th>
                    <th class="small col-8">Feb</th>
                    <th class="small col-8">Mar</th>
                    <th class="small col-8">Apr</th>
                    <th class="small col-8">May</th>
                    <th class="small col-8">Jun</th>
                    <th class="small col-8">Jul</th>
                    <th class="small col-8">Aug</th>
                    <th class="small col-8">Sep</th>
                    <th class="small col-8">Oct</th>
                    <th class="small col-8">Nov</th>
                    <th class="small col-8" style="border-right: 1px solid #dee2e6;">Dec</th>
                    <th class="small col-8">Discounts</th>
                    <th class="small col-8">"FOCs"</th>
                    <th class="small col-8">Total Discounts</th>
                  </tr>
              </thead>
              <tbody>
              <?php 
                 $pricingDataEntry = $specificMethod->fetchPricingDataEntry('jnj_pricing_dataentry', $_SESSION['customerName'], $dateVal[0]);
                  foreach($pricingDataEntry as $key => $val) {
               ?>
                <tr>
                  <td><?php echo $val['material'];?></td>
                  <td><?php echo $val['SKU'];?></td>
                  <td><?php echo $val['countryCode'];?></td>
                  <td><?php echo $val['currency'];?></td>
                  <td><?php echo $val['cif_jan'];?></td>
                  <td><?php echo $val['cif_feb'];?></td>
                  <td><?php echo $val['cif_mar'];?></td>
                  <td><?php echo $val['cif_apr'];?></td>
                  <td><?php echo $val['cif_may'];?></td>
                  <td><?php echo $val['cif_jun'];?></td>
                  <td><?php echo $val['cif_jul'];?></td>
                  <td><?php echo $val['cif_aug'];?></td>
                  <td><?php echo $val['cif_sep'];?></td>
                  <td><?php echo $val['cif_oct'];?></td>
                  <td><?php echo $val['cif_nov'];?></td>
                  <td><?php echo $val['cif_dec'];?></td>
                  <td><?php echo $val['tnd_jan'];?></td>
                  <td><?php echo $val['tnd_feb'];?></td>
                  <td><?php echo $val['tnd_mar'];?></td>
                  <td><?php echo $val['tnd_apr'];?></td>
                  <td><?php echo $val['tnd_may'];?></td>
                  <td><?php echo $val['tnd_jun'];?></td>
                  <td><?php echo $val['tnd_jul'];?></td>
                  <td><?php echo $val['tnd_aug'];?></td>
                  <td><?php echo $val['tnd_sep'];?></td>
                  <td><?php echo $val['tnd_oct'];?></td>
                  <td><?php echo $val['tnd_nov'];?></td>
                  <td><?php echo $val['tnd_dec'];?></td>
                  <td><?php echo $val['discounts'];?></td>
                  <td><?php echo $val['focs'];?></td>
                  <td><?php echo $val['totalDiscount'];?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
    </div>
    <div id="currency" class="tab-pane fade" style ="padding-left:30px;width:30%"><br>
      <table class="table table-hover" style="width:600px;">
        <thead class="thead-dark">
          <tr>
            <th style="width:150px;">Currency</th>
            <th style="width:400px;">Rate vs. USD</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="table-secondary">USD</td>
            <td class="table-secondary">
              <span style="width:200px;"><input type="text" name="txt_usd" id="txt_usd" value="1" style="width:150px;" readonly></span> &nbsp;<span id="saveUsd"><i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp; <i class="fa fa-times" aria-hidden="true" id="iconCancelUsd"></i></span>&nbsp;<i class="fa fa-pencil" aria-hidden="true" id="iconEditUsd"></i>
            </td>
          </tr>
          <tr>
            <td class="table-secondary">EUR</td>
            <td class="table-secondary">
                <span style="width:200px;"><input type="text" name="txt_eur" id="txt_eur" value="1.235" style="width:150px;" readonly></span> &nbsp;<span id="saveEur"><i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp; <i class="fa fa-times" aria-hidden="true"></i></span>&nbsp;<i class="fa fa-pencil" aria-hidden="true" id="iconEditEur"></i>  
            </td>
          </tr>
          <tr>
            <td class="table-secondary">DZD</td>
            <td class="table-secondary">
                <span style="width:200px;"><input type="text" name="txt_dzd" id="txt_dzd" value="0" style="width:150px;" readonly></span> &nbsp;<span id="saveDzd"><i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp; <i class="fa fa-times" aria-hidden="true"></i></span>&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i>  
            </td>
          </tr>
          <tr>
            <td class="table-secondary">EGP</td>
            <td class="table-secondary">
                <span style="width:200px;"><input type="text" name="txt_egp" id="txt_egp" value="0" style="width:150px;" readonly></span> &nbsp;<span id="saveEgp"><i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp; <i class="fa fa-times" aria-hidden="true"></i></span>&nbsp;<i class="fa fa-pencil" aria-hidden="true" ></i>  
            </td>
          </tr>
          <tr>
            <td class="table-secondary">CHF</td>
            <td class="table-secondary">
                <span style="width:200px;"><input type="text" name="txt_chf" id="txt_chf" value="0" style="width:150px;" readonly></span> &nbsp;<span id="saveChf"><i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp; <i class="fa fa-times" aria-hidden="true"></i></span>&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i>  
            </td>
          </tr>
          <tr>
            <td class="table-secondary">SAR</td>
            <td class="table-secondary">
                <span style="width:200px;"><input type="text" name="txt_sar" id="txt_sar" value="0" style="width:150px;" readonly></span> &nbsp;<span id="saveSar"><i class="fa fa-check-square-o" aria-hidden="true"></i> &nbsp; <i class="fa fa-times" aria-hidden="true"></i></span>&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i>  
            </td>
          </tr>
        </tbody>
      </table>
    
  </div>
    <div id="distrubutor" class="tab-pane fade" style ="padding-left:30px;width:50%"><br>
      <table class="table table-hover">
        <thead class="thead-dark">
          <tr>
            <th style="text-align:center">Country</th>
            <th style="text-align:center">Distrubutor name</th>
            <th style="text-align:center">Janssen</th>
            <th style="text-align:center">PAH</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="table-secondary" style="text-align:center">AE</td>
            <td class="table-secondary" style="text-align:center">Distr 1</td>
            <td class="table-secondary" style="text-align:center">10.00%</td>
            <td class="table-secondary" style="text-align:center">0.00%</td>
          </tr>
          <tr>
            <td class="table-secondary" style="text-align:center">AE</td>
            <td class="table-secondary" style="text-align:center">Distr 2</td>
            <td class="table-secondary" style="text-align:center">10.00%</td>
            <td class="table-secondary" style="text-align:center">0.00%</td>
          </tr>
          <tr>
            <td class="table-secondary"style="text-align:center">BH</td>
            <td class="table-secondary"style="text-align:center">Distr 3</td>
            <td class="table-secondary" style="text-align:center">10.00%</td>
            <td class="table-secondary" style="text-align:center">0.00%</td>
          </tr>
          <tr>
            <td class="table-secondary"style="text-align:center">BH</td>
            <td class="table-secondary"style="text-align:center">Distr 4</td>
            <td class="table-secondary" style="text-align:center">10.00%</td>
            <td class="table-secondary" style="text-align:center">0.00%</td>
          </tr>
          <tr>
            <td class="table-secondary"style="text-align:center">OM</td>
            <td class="table-secondary"style="text-align:center">Distr 5</td>
            <td class="table-secondary" style="text-align:center">10.00%</td>
            <td class="table-secondary" style="text-align:center">0.00%</td>
          </tr>
          <tr>
            <td class="table-secondary" style="text-align:center">KW</td>
            <td class="table-secondary" style="text-align:center">Distr 6</td>
            <td class="table-secondary" style="text-align:center">10.00%</td>
            <td class="table-secondary" style="text-align:center">0.00%</td>
          </tr>
          <tr>
            <td class="table-secondary" style="text-align:center">QA</td>
            <td class="table-secondary" style="text-align:center">Distr 7</td>
            <td class="table-secondary" style="text-align:center">10.00%</td>
            <td class="table-secondary" style="text-align:center">0.00%</td>
          </tr>
          <tr>
            <td class="table-secondary" style="text-align:center">SA</td>
            <td class="table-secondary" style="text-align:center">Distr 8</td>
            <td class="table-secondary" style="text-align:center">10.00%</td>
            <td class="table-secondary" style="text-align:center">0.00%</td>
          </tr>
        </tbody>
      </table>
  </div>
  </div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Comments</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>  
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Oops!!</h4>
                <p>The content that you have filled in your forecast sheet is facing problem such as duplicate values,Improper data type,missmatch value</p>
                <hr>
                <p class="mb-0">Please fill the details properly and send it again to get approved by the CVTL.</p>
            </div>
        </div>        
      </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#tablist a:first").tab('show'); // show last tab on page load
    $('input[id="txt_usd"][id="txt_eur"][id="txt_dzd"][id="txt_egp"][id="txt_chf"][id="txt_sar"]').prop('readonly',true);
    $('#saveUsd,#saveEur,#saveDzd,#saveEgp,#saveChf,#saveSar').hide();
});
$('#submitbutton').click(function(){
   $.post('router.php', {page:'importPricingDataFile'}, function(data){
     $('#myModal').show();
      console.log(data);
     if(data) {
        
     }
   });
});
$('.fa-pencil').click(function(){
  console.log($(this).attr('id'));
  if($(this).attr('id') == 'iconEditUsd')
    $('#saveUsd').show();
  else
    $('#saveEur').show();
  $('#'+$(this).attr('id')).hide();
});
$('.fa-times').click(function(event){
   console.log($(this).attr('id'));
   if($(this).attr('id') == 'iconCancelUsd') {
     $('#iconEditUsd').show();
     $('#saveUsd').hide();
   } else {
     $('#iconEditEur').show();
     $('#saveEur').hide();   
   }
});

</script>


