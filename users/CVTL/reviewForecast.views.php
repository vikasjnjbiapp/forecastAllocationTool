<?php
/*
Review the TAL forecast and evaluated it
1. Review the TAL IMS forecast
2. Input forecast volume from CVTL
3. Approve & reject forecast for specific SKUs
*/
 // print_r($_SESSION);
$specificMethod = new specificMethodFile();
$fields = implode(',',['id','brandName']);
$brandOne = $specificMethod->fetchBrandsIrrespectiveBrandId('jnj_brand', $fields);

$itemOne = $specificMethod->fetchItemsIrrespectiveCVTLCustomer('jnj_item', '*');
$dateVal = [date("Y"), date("Y")+1, date("Y")+2, date("Y")+3, date("Y")+4];

?>

<ul class="nav nav-tabs" id="myTab">
    <li class="nav-item">
        <a href="#currentYear" class="nav-link" data-toggle="tab" id="year_19">Year - <?php echo date("Y");?></a>
    </li>
    <li class="nav-item">
        <a href="#nextYear" class="nav-link" data-toggle="tab" id="year_19">Year - <?php echo date("Y")+1;?></a>
    </li>
    <li class="nav-item">
        <a href="#oneNextYear" class="nav-link" data-toggle="tab" id="year_18">Year - <?php echo date("Y")+2;?></a>
    </li>
    <li class="nav-item">
        <a href="#twoNextYear" class="nav-link" data-toggle="tab" id="year_17">Year - <?php echo date("Y")+3;?></a>
    </li>
    <li class="nav-item">
        <a href="#threeNextYear" class="nav-link" data-toggle="tab" id="year_17">Year - <?php echo date("Y")+4;?></a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade" id="currentYear">
    <?php
    $fieldname = '*';
    $condition = ' customerName in('.$_SESSION['assignCustomers'].') AND year='.$dateVal[0];
    $userCurrDetails = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', $fieldname, $dateVal[0], $condition);  
    ?>
    <h4 class="mt-2">Year - <?php echo date("Y");?></h4>
    <div class="table-responsive">
    <form id="entryGridFormCurrent" name="entryGridFormCurrent" method="post">
    <table class="table table-striped" id="sampleCurrentTbl">
    <thead>
      <tr class="table-dark">
          <th colspan="22"><div id="errorMessage"></div></th>
          <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
          <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
          <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
      </tr>
      <tr class="table-primary">
        <th><div class="small col-4" style='width: 40px;'>&nbsp;</div></th>
        <!--th><div class="small col-12" style='width: 240px;'>CustomerName</div></th-->
        <th><div class="small col-8" style='width: 60px;'>Country</div></th>
        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
        <th><div class="small col-12" style='width: 100px;'>Vaue_Category</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jan</div></th>
        <th><div class="small col-12" style='width: 60px;'>Feb</div></th>
        <th><div class="small col-12" style='width: 60px;'>Mar</div></th>
        <th><div class="small col-12" style='width: 60px;'>Apr</div></th>
        <th><div class="small col-12" style='width: 60px;'>May</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jun</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jul</div></th>
        <th><div class="small col-12" style='width: 60px;'>Aug</div></th>
        <th><div class="small col-12" style='width: 60px;'>Sep</div></th>
        <th><div class="small col-12" style='width: 60px;'>Oct</div></th>
        <th><div class="small col-12" style='width: 60px;'>Nov</div></th>
        <th><div class="small col-12" style='width: 60px;'>Dec</div></th>
        <th><div class="small col-4" style='width: 50px;'>Action</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-12" style='width: 100px;'>Total Sales Target</div></th>
        <th><div class="small col-12" style='width: 100px;'>Last Rolling Forecast</div></th>
        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
        <th><div class="small col-8" style='width: 80px;'>Variance</div></th>
        <th><div class="small col-8" style='width: 80px;'>YTD</div></th>
        <th><div class="small col-12" style='width: 100px;'>Year to go</div></th>
        <th><div class="small col-12" style='width: 130px;'>Financial Plan (visible for CVTL)</div></th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      foreach($userCurrDetails as $key => $val) {
        $i = $i + 1;
    ?>
      <tr>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="hidden" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="<?php echo $val['customerName'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="<?php echo $val['countryId'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>" value="<?php echo $val['type'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" value="<?php echo $val['busSelector'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" value="<?php echo $itemOne[$val['itemId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" value="<?php echo $brandOne[$val['brandId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
            <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcast_<?php echo $i;?>" value="<?php echo $val['jan_fcast'];?>" maxlength="5"><br/>
              <!--div>A<input type="radio" class="form-check-input" name="radioBut" id="A" value="A"> R<input type="radio" class="form-check-input" name="radioBut" id="R" value="R">R</div-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcast_<?php echo $i;?>" value="<?php echo $val['feb_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcast_<?php echo $i;?>" value="<?php echo $val['mar_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcast_<?php echo $i;?>" value="<?php echo $val['apr_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcast_<?php echo $i;?>" value="<?php echo $val['may_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcast_<?php echo $i;?>" value="<?php echo $val['jun_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcast_<?php echo $i;?>" value="<?php echo $val['jul_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcast_<?php echo $i;?>" value="<?php echo $val['aug_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcast_<?php echo $i;?>" value="<?php echo $val['sep_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcast_<?php echo $i;?>" value="<?php echo $val['oct_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcast_<?php echo $i;?>" value="<?php echo $val['nov_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcast_<?php echo $i;?>" value="<?php echo $val['dec_fcast'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <a href="#" class="form-control" name="actionApprove" id="actionApprove_<?php echo $i;?>">Approve</a>              
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <a href="#" class="form-control" name="actionReject" id="actionReject_<?php echo $i;?>">Reject</a>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcast_<?php echo $i;?>" value="<?php echo $val['totalSalesTarget_fcast'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcast_<?php echo $i;?>" value="<?php echo $val['lastRollingForecast_fcast'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcast_<?php echo $i;?>" value="<?php echo $val['totalForecast_fcast'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcast_<?php echo $i;?>" value="<?php echo $val['varient_fcast'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcast_<?php echo $i;?>" value="<?php echo $val['ytd_fcast'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcast_<?php echo $i;?>" value="<?php echo $val['yearToGo_fcast'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6"></td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('focs');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focs_<?php echo $i;?>" value="<?php echo $val['jan_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focs_<?php echo $i;?>" value="<?php echo $val['feb_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focs_<?php echo $i;?>" value="<?php echo $val['mar_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focs_<?php echo $i;?>" value="<?php echo $val['apr_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focs_<?php echo $i;?>" value="<?php echo $val['may_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focs_<?php echo $i;?>" value="<?php echo $val['jun_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focs_<?php echo $i;?>" value="<?php echo $val['jul_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focs_<?php echo $i;?>" value="<?php echo $val['aug_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focs_<?php echo $i;?>" value="<?php echo $val['sep_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focs_<?php echo $i;?>" value="<?php echo $val['oct_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focs_<?php echo $i;?>" value="<?php echo $val['nov_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focs_<?php echo $i;?>" value="<?php echo $val['dec_focs'];?>" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focs_<?php echo $i;?>" value="<?php echo $val['totalSalesTarget_focs'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focs_<?php echo $i;?>" value="<?php echo $val['lastRollingForecast_focs'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focs_<?php echo $i;?>" value="<?php echo $val['totalForecast_focs'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focs_<?php echo $i;?>" value="<?php echo $val['varient_focs'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focs_<?php echo $i;?>" value="<?php echo $val['ytd_focs'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focs_<?php echo $i;?>" value="<?php echo $val['yearToGo_focs'];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6" style="text-align:right;">Insert CVTL</td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('volumes');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_volumes_<?php echo $i;?>" id="jan_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_volumes_<?php echo $i;?>" id="feb_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_volumes_<?php echo $i;?>" id="mar_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_volumes_<?php echo $i;?>" id="apr_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_volumes_<?php echo $i;?>" id="may_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_volumes_<?php echo $i;?>" id="jun_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_volumes_<?php echo $i;?>" id="jul_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_volumes_<?php echo $i;?>" id="aug_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_volumes_<?php echo $i;?>" id="sep_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_volumes_<?php echo $i;?>" id="oct_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_volumes_<?php echo $i;?>" id="nov_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_volumes_<?php echo $i;?>" id="dec_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_volumes_<?php echo $i;?>" id="totalSalesTarget_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_volumes_<?php echo $i;?>" id="lastRollingForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_volumes_<?php echo $i;?>" id="totalForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_volumes_<?php echo $i;?>" id="varient_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_volumes_<?php echo $i;?>" id="ytd_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_volumes_<?php echo $i;?>" id="yearToGo_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_volumes_<?php echo $i;?>" id="financialPlan_volumes_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <div style="text-align:center;"><button type="button" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary">Submit</button></div>
    <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div--> <br/>
    </form>
    </div>
    </div>
    <div class="tab-pane fade" id="nextYear">
    <?php
    $conditionNext = ' customerName in('.$_SESSION['assignCustomers'].') AND year='.$dateVal[1];
    $userNextDetails = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', '*', $dateVal[1], $conditionNext);  
    ?>
    <h4 class="mt-2">Year - <?php echo date("Y")+1;?></h4>
    <div class="table-responsive">
    <form id="entryGridFormCurrent" name="entryGridFormCurrent" method="post">
    <table class="table table-striped" id="nextSampleTbl">
    <thead>
      <tr class="table-dark">
          <th colspan="22"><div id="errorMessage"></div></th>
          <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
          <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
          <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
      </tr>
      <tr class="table-primary">
         <th><div class="small col-4" style='width: 40px;'>&nbsp;</div></th>
        <!--th><div class="small col-12" style='width: 240px;'>CustomerName</div></th-->
        <th><div class="small col-8" style='width: 60px;'>Country</div></th>
        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
        <th><div class="small col-12" style='width: 100px;'>Vaue_Category</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jan</div></th>
        <th><div class="small col-12" style='width: 60px;'>Feb</div></th>
        <th><div class="small col-12" style='width: 60px;'>Mar</div></th>
        <th><div class="small col-12" style='width: 60px;'>Apr</div></th>
        <th><div class="small col-12" style='width: 60px;'>May</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jun</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jul</div></th>
        <th><div class="small col-12" style='width: 60px;'>Aug</div></th>
        <th><div class="small col-12" style='width: 60px;'>Sep</div></th>
        <th><div class="small col-12" style='width: 60px;'>Oct</div></th>
        <th><div class="small col-12" style='width: 60px;'>Nov</div></th>
        <th><div class="small col-12" style='width: 60px;'>Dec</div></th>
        <th><div class="small col-4" style='width: 50px;'>Action</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-12" style='width: 100px;'>Total Sales Target</div></th>
        <th><div class="small col-12" style='width: 100px;'>Last Rolling Forecast</div></th>
        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
        <th><div class="small col-8" style='width: 80px;'>Variance</div></th>
        <th><div class="small col-8" style='width: 80px;'>YTD</div></th>
        <th><div class="small col-12" style='width: 100px;'>Year to go</div></th>
        <th><div class="small col-12" style='width: 130px;'>Financial Plan (visible for CVTL)</div></th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      foreach($userNextDetails as $key => $val) {  
          $i = $i + 1;
    ?>
      <tr>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="hidden" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" value="<?php echo $itemOne[$val['itemId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" value="<?php echo $brandOne[$val['brandId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
            <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <a href="#" class="form-control" name="actionApprove" id="actionApprove_<?php echo $i;?>">Approve</a>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <a href="#" class="form-control" name="actionReject" id="actionReject_<?php echo $i;?>">Reject</a>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6"></td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('focs');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6" style="text-align:right;">Insert CVTL</td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('volumes');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_volumes_<?php echo $i;?>" id="jan_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_volumes_<?php echo $i;?>" id="feb_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_volumes_<?php echo $i;?>" id="mar_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_volumes_<?php echo $i;?>" id="apr_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_volumes_<?php echo $i;?>" id="may_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_volumes_<?php echo $i;?>" id="jun_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_volumes_<?php echo $i;?>" id="jul_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_volumes_<?php echo $i;?>" id="aug_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_volumes_<?php echo $i;?>" id="sep_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_volumes_<?php echo $i;?>" id="oct_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_volumes_<?php echo $i;?>" id="nov_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_volumes_<?php echo $i;?>" id="dec_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_volumes_<?php echo $i;?>" id="totalSalesTarget_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_volumes_<?php echo $i;?>" id="lastRollingForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_volumes_<?php echo $i;?>" id="totalForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_volumes_<?php echo $i;?>" id="varient_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_volumes_<?php echo $i;?>" id="ytd_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_volumes_<?php echo $i;?>" id="yearToGo_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_volumes_<?php echo $i;?>" id="financialPlan_volumes_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <div style="text-align:center;"><button type="button" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary">Submit</button></div>
    <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div--> <br/>
    </form>
    </div>
    </div>
    <div class="tab-pane fade" id="oneNextYear">
    <h4 class="mt-2">Year - <?php echo date("Y")+2;?></h4>
    <?php
    $conditionNext2 = ' customerName in('.$_SESSION['assignCustomers'].') AND year='.$dateVal[2];
    $userNextDetails2 = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', '*', $dateVal[2], $conditionNext2);  
    ?>
    <div class="table-responsive">
    <form id="entryGridFormCurrent" name="entryGridFormCurrent" method="post">
    <table class="table table-striped" id="oneNextSampleTbl">
    <thead>
      <tr class="table-dark">
          <th colspan="22"><div id="errorMessage"></div></th>
          <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
          <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
          <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
      </tr>
      <tr class="table-primary">
         <th><div class="small col-4" style='width: 40px;'>&nbsp;</div></th>
        <!--th><div class="small col-12" style='width: 240px;'>CustomerName</div></th-->
        <th><div class="small col-8" style='width: 60px;'>Country</div></th>
        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
        <th><div class="small col-12" style='width: 100px;'>Vaue_Category</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jan</div></th>
        <th><div class="small col-12" style='width: 60px;'>Feb</div></th>
        <th><div class="small col-12" style='width: 60px;'>Mar</div></th>
        <th><div class="small col-12" style='width: 60px;'>Apr</div></th>
        <th><div class="small col-12" style='width: 60px;'>May</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jun</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jul</div></th>
        <th><div class="small col-12" style='width: 60px;'>Aug</div></th>
        <th><div class="small col-12" style='width: 60px;'>Sep</div></th>
        <th><div class="small col-12" style='width: 60px;'>Oct</div></th>
        <th><div class="small col-12" style='width: 60px;'>Nov</div></th>
        <th><div class="small col-12" style='width: 60px;'>Dec</div></th>
        <th><div class="small col-4" style='width: 50px;'>Action</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-12" style='width: 100px;'>Total Sales Target</div></th>
        <th><div class="small col-12" style='width: 100px;'>Last Rolling Forecast</div></th>
        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
        <th><div class="small col-8" style='width: 80px;'>Variance</div></th>
        <th><div class="small col-8" style='width: 80px;'>YTD</div></th>
        <th><div class="small col-12" style='width: 100px;'>Year to go</div></th>
        <th><div class="small col-12" style='width: 130px;'>Financial Plan (visible for CVTL)</div></th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      foreach($userNextDetails2 as $key => $val) {  
          $i = $i + 1;  
    ?>
      <tr>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" value="<?php echo $itemOne[$val['itemId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" value="<?php echo $brandOne[$val['brandId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
            <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">               
              <a href="#" class="form-control" name="actionApprove" id="actionApprove_<?php echo $i;?>">Approve</a>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <a href="#" class="form-control" name="actionReject" id="actionReject_<?php echo $i;?>">Reject</a>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6"></td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('focs');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6" style="text-align:right;">Insert CVTL</td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('volumes');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_volumes_<?php echo $i;?>" id="jan_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_volumes_<?php echo $i;?>" id="feb_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_volumes_<?php echo $i;?>" id="mar_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_volumes_<?php echo $i;?>" id="apr_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_volumes_<?php echo $i;?>" id="may_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_volumes_<?php echo $i;?>" id="jun_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_volumes_<?php echo $i;?>" id="jul_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_volumes_<?php echo $i;?>" id="aug_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_volumes_<?php echo $i;?>" id="sep_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_volumes_<?php echo $i;?>" id="oct_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_volumes_<?php echo $i;?>" id="nov_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_volumes_<?php echo $i;?>" id="dec_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_volumes_<?php echo $i;?>" id="totalSalesTarget_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_volumes_<?php echo $i;?>" id="lastRollingForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_volumes_<?php echo $i;?>" id="totalForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_volumes_<?php echo $i;?>" id="varient_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_volumes_<?php echo $i;?>" id="ytd_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_volumes_<?php echo $i;?>" id="yearToGo_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_volumes_<?php echo $i;?>" id="financialPlan_volumes_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <div style="text-align:center;"><button type="button" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary">Submit</button></div>
    <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div--> <br/>
    </form>
    </div>
    </div>
    <div class="tab-pane fade" id="twoNextYear">
    <h4 class="mt-2">Year - <?php echo date("Y")+3;?></h4>
    <?php
        $conditionNext3 = ' customerName in('.$_SESSION['assignCustomers'].') AND year='.$dateVal[3];
        $userNextDetails3 = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', '*', $dateVal[3], $conditionNext3);  
    ?>
    <div class="table-responsive">
    <form id="entryGridFormCurrent" name="entryGridFormCurrent" method="post">
    <table class="table table-striped" id="nextTwoSampleTbl">
    <thead>
      <tr class="table-dark">
          <th colspan="22"><div id="errorMessage"></div></th>
          <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
          <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
          <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
      </tr>
      <tr class="table-primary">
        <th><div class="small col-4" style='width: 40px;'>&nbsp;</div></th>
        <!--th><div class="small col-12" style='width: 240px;'>CustomerName</div></th-->
        <th><div class="small col-8" style='width: 60px;'>Country</div></th>
        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
        <th><div class="small col-12" style='width: 100px;'>Vaue_Category</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jan</div></th>
        <th><div class="small col-12" style='width: 60px;'>Feb</div></th>
        <th><div class="small col-12" style='width: 60px;'>Mar</div></th>
        <th><div class="small col-12" style='width: 60px;'>Apr</div></th>
        <th><div class="small col-12" style='width: 60px;'>May</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jun</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jul</div></th>
        <th><div class="small col-12" style='width: 60px;'>Aug</div></th>
        <th><div class="small col-12" style='width: 60px;'>Sep</div></th>
        <th><div class="small col-12" style='width: 60px;'>Oct</div></th>
        <th><div class="small col-12" style='width: 60px;'>Nov</div></th>
        <th><div class="small col-12" style='width: 60px;'>Dec</div></th>
        <th><div class="small col-4" style='width: 50px;'>Action</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-12" style='width: 100px;'>Total Sales Target</div></th>
        <th><div class="small col-12" style='width: 100px;'>Last Rolling Forecast</div></th>
        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
        <th><div class="small col-8" style='width: 80px;'>Variance</div></th>
        <th><div class="small col-8" style='width: 80px;'>YTD</div></th>
        <th><div class="small col-12" style='width: 100px;'>Year to go</div></th>
        <th><div class="small col-12" style='width: 130px;'>Financial Plan (visible for CVTL)</div></th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      foreach($userNextDetails3 as $key => $val) {  
          $i = $i + 1;  
    ?>
      <tr>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" value="<?php echo $itemOne[$val['itemId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" value="<?php echo $brandOne[$val['brandId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
            <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <a href="#" class="form-control" name="actionApprove" id="actionApprove_<?php echo $i;?>">Approve</a>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <a href="#" class="form-control" name="actionReject" id="actionReject_<?php echo $i;?>">Reject</a>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6"></td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('focs');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6" style="text-align:right;">Insert CVTL</td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('volumes');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_volumes_<?php echo $i;?>" id="jan_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_volumes_<?php echo $i;?>" id="feb_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_volumes_<?php echo $i;?>" id="mar_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_volumes_<?php echo $i;?>" id="apr_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_volumes_<?php echo $i;?>" id="may_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_volumes_<?php echo $i;?>" id="jun_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_volumes_<?php echo $i;?>" id="jul_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_volumes_<?php echo $i;?>" id="aug_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_volumes_<?php echo $i;?>" id="sep_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_volumes_<?php echo $i;?>" id="oct_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_volumes_<?php echo $i;?>" id="nov_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_volumes_<?php echo $i;?>" id="dec_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_volumes_<?php echo $i;?>" id="totalSalesTarget_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_volumes_<?php echo $i;?>" id="lastRollingForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_volumes_<?php echo $i;?>" id="totalForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_volumes_<?php echo $i;?>" id="varient_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_volumes_<?php echo $i;?>" id="ytd_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_volumes_<?php echo $i;?>" id="yearToGo_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_volumes_<?php echo $i;?>" id="financialPlan_volumes_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <div style="text-align:center;"><button type="button" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary">Submit</button></div>
    <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div--> <br/>
    </form>
    </div>
    </div>
    <div class="tab-pane fade" id="threeNextYear">
    <h4 class="mt-2">Year - <?php echo date("Y")+4;?></h4>
    <?php
        $conditionNext4 = ' customerName in('.$_SESSION['assignCustomers'].') AND year='.$dateVal[1];
        $userNextDetails4 = $specificMethod->fetchMultipleRecordsByDateTime('jnj_temp_tal_dataentry', '*', $conditionNext4);  
    ?>
    <div class="table-responsive">
    <form id="entryGridFormCurrent" name="entryGridFormCurrent" method="post">
    <table class="table table-striped" id="nextThreeSampleTbl">
    <thead>
      <tr class="table-dark">
          <th colspan="22"><div id="errorMessage"></div></th>
          <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
          <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
          <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
      </tr>
      <tr class="table-primary">
        <th><div class="small col-4" style='width: 40px;'>&nbsp;</div></th>
        <!--th><div class="small col-12" style='width: 240px;'>CustomerName</div></th-->
        <th><div class="small col-8" style='width: 60px;'>Country</div></th>
        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
        <th><div class="small col-12" style='width: 100px;'>Vaue_Category</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jan</div></th>
        <th><div class="small col-12" style='width: 60px;'>Feb</div></th>
        <th><div class="small col-12" style='width: 60px;'>Mar</div></th>
        <th><div class="small col-12" style='width: 60px;'>Apr</div></th>
        <th><div class="small col-12" style='width: 60px;'>May</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jun</div></th>
        <th><div class="small col-12" style='width: 60px;'>Jul</div></th>
        <th><div class="small col-12" style='width: 60px;'>Aug</div></th>
        <th><div class="small col-12" style='width: 60px;'>Sep</div></th>
        <th><div class="small col-12" style='width: 60px;'>Oct</div></th>
        <th><div class="small col-12" style='width: 60px;'>Nov</div></th>
        <th><div class="small col-12" style='width: 60px;'>Dec</div></th>
        <th><div class="small col-4" style='width: 50px;'>Action</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
        <th><div class="small col-12" style='width: 100px;'>Total Sales Target</div></th>
        <th><div class="small col-12" style='width: 100px;'>Last Rolling Forecast</div></th>
        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
        <th><div class="small col-8" style='width: 80px;'>Variance</div></th>
        <th><div class="small col-8" style='width: 80px;'>YTD</div></th>
        <th><div class="small col-12" style='width: 100px;'>Year to go</div></th>
        <th><div class="small col-12" style='width: 130px;'>Financial Plan (visible for CVTL)</div></th>
      </tr>
    </thead>
    <tbody>
    <?php
      $i = 0;
      foreach($userNextDetails4 as $key => $val) {  
          $i = $i + 1;  
    ?>
      <tr>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="hidden" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" value="" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" value="<?php echo $itemOne[$val['itemId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">
              <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" value="<?php echo $brandOne[$val['brandId']];?>" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
            <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcast_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <a href="#" class="form-control" name="actionApprove" id="actionApprove_<?php echo $i;?>">Approve</a>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <a href="#" class="form-control" name="actionReject" id="actionReject_<?php echo $i;?>">Reject</a>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcast_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6"></td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('focs');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focs_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focs_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
      <tr>
          <td colspan="6" style="text-align:right;">Insert CVTL</td>
          <td><div class="input-group input-group-sm mt-2">                
            <level class="form-control"><?php echo strtoupper('volumes');?></level>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jan_volumes_<?php echo $i;?>" id="jan_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="feb_volumes_<?php echo $i;?>" id="feb_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="mar_volumes_<?php echo $i;?>" id="mar_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="apr_volumes_<?php echo $i;?>" id="apr_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="may_volumes_<?php echo $i;?>" id="may_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jun_volumes_<?php echo $i;?>" id="jun_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="jul_volumes_<?php echo $i;?>" id="jul_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="aug_volumes_<?php echo $i;?>" id="aug_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="sep_volumes_<?php echo $i;?>" id="sep_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="oct_volumes_<?php echo $i;?>" id="oct_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="nov_volumes_<?php echo $i;?>" id="nov_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="dec_volumes_<?php echo $i;?>" id="dec_volumes_<?php echo $i;?>" value="0" maxlength="5">
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
             <!--a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a-->
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              &nbsp;
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalSalesTarget_volumes_<?php echo $i;?>" id="totalSalesTarget_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="lastRollingForecast_volumes_<?php echo $i;?>" id="lastRollingForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="totalForecast_volumes_<?php echo $i;?>" id="totalForecast_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="varient_volumes_<?php echo $i;?>" id="varient_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="ytd_volumes_<?php echo $i;?>" id="ytd_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="yearToGo_volumes_<?php echo $i;?>" id="yearToGo_volumes_<?php echo $i;?>" value="0" readonly>
          </div></td>
          <td><div class="input-group input-group-sm mt-2">                
              <input type="text" class="form-control" name="financialPlan_volumes_<?php echo $i;?>" id="financialPlan_volumes_<?php echo $i;?>" value="0">
          </div></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <div style="text-align:center;"><button type="button" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary">Submit</button></div>
    <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div--> <br/>
    </form>
    </div>
    </div>
</div>
<script>
    $(document).ready(function(){ 
        $("#myTab a:first").tab('show'); // show last tab on page load
        $('[data-toggle="tooltip"]').tooltip({
            title: "Searcch by customer number or country name or item. <br/> You can also use three criteria togather using colum saparator.",
            html: true
        });
    });
   
</script>