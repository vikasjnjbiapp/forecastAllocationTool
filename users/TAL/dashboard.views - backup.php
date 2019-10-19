<?php
$unit = ['CNS', 'ID', 'IMM', 'MB & RP', 'OH'];
$busSector = ['DPO', 'TND'];
$status = ['Not Registered', 'Registered'];
$divested = ['No', 'Yes'];
$specificMethod = new specificMethodFile();
$country = $specificMethod->fetchCountryDetails('jnj_country', $_SESSION['countryName']);
$fieldName = implode(',', ['id', 'itemName', 'skuCode']);
$condition = ' jnj_item.countryId='.$_SESSION['countryName'];
$item = $specificMethod->fetchItemDetails('jnj_item', $fieldName, $condition);

$tableName = ['jnj_item', 'jnj_registration'];
$itemOne = $specificMethod->fetchItemsIrrespectiveCustomer($tableName, $_SESSION['customerName']);
$numberOfItteration = count($itemOne)*3*2;
// echo "VB::".$numberOfItteration;
if($_SESSION['userRole'] !== 'CVTL'){
   $readonly = 'readonly';
}
?>
<!-- Display the chart and report -->
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
    <div class="tab-pane fade row" id="currentYear">        
        <h4 class="mt-2">Year - <?php echo date("Y");?></h4>
        <?php
            $fieldTALName = '*';
            $conditionTAL = ' customerName='.$_SESSION['customerName'].' AND year='.date("Y");
            $tempTalDataEntry = $specificMethod->fetchItemDetails('jnj_temp_tal_dataentry', $fieldTALName, $conditionTAL);
        ?>
        <div class="table-responsive">
        <form id="entryGridFormCurrent" name="entryGridFormCurrent" method="post">
            <table class="table table-striped" id="sampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="22"><div id="errorMessage"></div></th>
                        <th colspan="2" style="text-align: center;"><div class="small">Auto Populated</div></th>
                        <th colspan="4" style="text-align: center;"><div class="small">Calculated Field</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Only CVTL</div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-12" style='width: 100px;'>CustomerNumber</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
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
                        <th><div class="small col-12" style='width: 100px;'>Action</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Sales Target</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Last Rolling Forecast</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Variance</div></th>
                        <th><div class="small col-12" style='width: 150px;'>YTD</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Year to go</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Financial Plan (visible for CVTL)</div></th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    // $numberOfItteration
                    for($i=1; $i<=3; $i++) {
                  ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                            <input type="text" class="form-control" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['type'];?>" readonly>
                            <?php } else { ?>
                            <select class="form-control form-control-inline" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>">
                                <option value='NA'>Select Type</option>
                                <option value="Private" selected>Private</option>
                                <option value="Institution">Institution</option>
                                <option value="MOH">MOH</option>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                             <input type="text" class="form-control" name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['busSelector'];?>" readonly>
                            <?php } else { ?>
                            <select name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" class="form-control form-control-inline">
                                <?php foreach($busSector as $val) { ?>
                                    <option value='<?php echo $val; ?>'><?php echo $val; ?></option>
                                <?php } ?>
                             </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                            <input type="text" class="form-control" name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" value="<?php echo $itemOne[$tempTalDataEntry[$i-1]['itemId']]; ?>" readonly>
                            <?php } else { ?>
                            <select name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Item</option>
                                <?php foreach($itemOne as $key => $val) { ?>
                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                            <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['brandId'];?>" readonly>
                            <?php } else { ?>
                            <select name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Brand</option>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jan_fcast'])?$tempTalDataEntry[$i-1]['jan_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['feb_fcast'])?$tempTalDataEntry[$i-1]['feb_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['mar_fcast'])?$tempTalDataEntry[$i-1]['mar_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['apr_fcast'])?$tempTalDataEntry[$i-1]['apr_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['may_fcast'])?$tempTalDataEntry[$i-1]['may_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jun_fcast'])?$tempTalDataEntry[$i-1]['jun_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jul_fcast'])?$tempTalDataEntry[$i-1]['jul_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['aug_fcast'])?$tempTalDataEntry[$i-1]['aug_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['sep_fcast'])?$tempTalDataEntry[$i-1]['sep_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['oct_fcast'])?$tempTalDataEntry[$i-1]['oct_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['nov_fcast'])?$tempTalDataEntry[$i-1]['nov_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['dec_fcast'])?$tempTalDataEntry[$i-1]['dec_fcast']:0;?>" maxlength="5">
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
                            <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalSalesTarget_fcast'])?$tempTalDataEntry[$i-1]['totalSalesTarget_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['lastRollingForecast_fcast'])?$tempTalDataEntry[$i-1]['lastRollingForecast_fcast']:0;?>"  readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalForecast_fcast'])?$tempTalDataEntry[$i-1]['totalForecast_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['varient_fcast'])?$tempTalDataEntry[$i-1]['varient_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['ytd_fcast'])?$tempTalDataEntry[$i-1]['ytd_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['yearToGo_fcast'])?$tempTalDataEntry[$i-1]['yearToGo_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['financialPlan_fcast'])?$tempTalDataEntry[$i-1]['financialPlan_fcast']:0;?>" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <level class="form-control"><?php echo strtoupper('focs');?></level>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jan_focs'])?$tempTalDataEntry[$i-1]['jan_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['feb_focs'])?$tempTalDataEntry[$i-1]['feb_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['mar_focs'])?$tempTalDataEntry[$i-1]['mar_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['apr_focs'])?$tempTalDataEntry[$i-1]['apr_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['may_focs'])?$tempTalDataEntry[$i-1]['may_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jun_focs'])?$tempTalDataEntry[$i-1]['jun_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jul_focs'])?$tempTalDataEntry[$i-1]['jul_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['aug_focs'])?$tempTalDataEntry[$i-1]['aug_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['sep_focs'])?$tempTalDataEntry[$i-1]['sep_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['oct_focs'])?$tempTalDataEntry[$i-1]['oct_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['nov_focs'])?$tempTalDataEntry[$i-1]['nov_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['dec_focs'])?$tempTalDataEntry[$i-1]['dec_focs']:0;?>" maxlength="5">
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
                            <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalSalesTarget_focs'])?$tempTalDataEntry[$i-1]['totalSalesTarget_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['lastRollingForecast_focs'])?$tempTalDataEntry[$i-1]['lastRollingForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalForecast_focs'])?$tempTalDataEntry[$i-1]['totalForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['varient_focs'])?$tempTalDataEntry[$i-1]['varient_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['ytd_focs'])?$tempTalDataEntry[$i-1]['ytd_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['yearToGo_focs'])?$tempTalDataEntry[$i-1]['yearToGo_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['financialPlan_focs'])?$tempTalDataEntry[$i-1]['financialPlan_focs']:0;?>" <?php echo $readonly;?>>
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
        <h4 class="mt-2"><?php echo date("Y")+1;?> Data</h4>
        <?php
            $fieldTALNameNexxtYear = '*';
            $date = date("Y")+1;
            $conditionTALNextYear = ' customerName='.$_SESSION['customerName'].' AND year='.$date;
            $tempTalDataEntryNextYear = $specificMethod->fetchItemDetails('jnj_temp_tal_dataentry', $fieldTALNameNexxtYear, $conditionTALNextYear);
            // print_r($tempTalDataEntryNextYear);
        ?>
        <div class="table-responsive">
        <form id="entryGridFormNextYear" name="entryGridFormNextYear" method="post">
            <table class="table table-striped" id="sampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="22"></th>
                        <th colspan="2" style="text-align: center;"><div class="small">Auto Populated</div></th>
                        <th colspan="4" style="text-align: center;"><div class="small">Calculated Field</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Only CVTL</div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-12" style='width: 100px;'>CustomerNumber</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
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
                        <th><div class="small col-12" style='width: 100px;'>Action</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Sales Target</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Rolling Forecast</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Variance</div></th>
                        <th><div class="small col-12" style='width: 150px;'>YTD</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Year to go</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Financial Plan (visible for CVTL)</div></th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    for($i=1; $i<=2; $i++) {  
                  ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select class="form-control form-control-inline" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>">
                                <option value='NA'>Select Type</option>
                                <option value="Private" selected>Private</option>
                                <option value="Institution">Institution</option>
                                <option value="MOH">MOH</option>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" class="form-control form-control-inline">
                                <?php foreach($busSector as $val) { ?>
                                    <option value='<?php echo $val; ?>'><?php echo $val; ?></option>
                                <?php } ?>
                             </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Item</option>
                                <?php foreach($itemOne as $key => $val) { ?>
                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                <?php } ?>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <select name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Brand</option>
                            </select>
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
                            <a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            &nbsp;
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
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="0" <?php echo $readonly;?>>
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
                           <a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a>
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
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="0" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridNextYear" name="btnEntryGridNextYear" class="btn btn-primary">Submit</button></div>
            <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div--> <br/>
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="oneNextYear">
        <h4 class="mt-2"><?php echo date("Y")+2;?> Data</h4>
        <div class="table-responsive">
        <form id="entryGridFormOneNextYear" name="entryGridFormOneNextYear" method="post">
            <table class="table table-striped" id="sampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="22"></th>
                        <th colspan="2" style="text-align: center;"><div class="small">Auto Populated</div></th>
                        <th colspan="4" style="text-align: center;"><div class="small">Calculated Field</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Only CVTL</div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-12" style='width: 100px;'>CustomerNumber</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
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
                        <th><div class="small col-12" style='width: 100px;'>Action</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Sales Target</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Rolling Forecast</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Variance</div></th>
                        <th><div class="small col-12" style='width: 150px;'>YTD</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Year to go</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Financial Plan (visible for CVTL)</div></th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    for($i=1; $i<2; $i++) {  
                  ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select class="form-control form-control-inline" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>">
                                <option value='NA'>Select Type</option>
                                <option value="Private" selected>Private</option>
                                <option value="Institution">Institution</option>
                                <option value="MOH">MOH</option>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" class="form-control form-control-inline">
                                <?php foreach($busSector as $val) { ?>
                                    <option value='<?php echo $val; ?>'><?php echo $val; ?></option>
                                <?php } ?>
                             </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Item</option>
                                <?php foreach($itemOne as $key => $val) { ?>
                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                <?php } ?>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <select name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Brand</option>
                            </select>
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
                            <a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            &nbsp;
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
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="0" <?php echo $readonly;?>>
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
                           <a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a>
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
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="0" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridOneNextYear" name="btnEntryGridOneNextYear" class="btn btn-primary">Submit</button></div>
            <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div--> <br/>
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="twoNextYear">
        <h4 class="mt-2"><?php echo date("Y")+3;?> Data</h4>
        <div class="table-responsive">
        <form id="entryGridFormTwoNextYear" name="entryGridFormTwoNextYear" method="post">
            <table class="table table-striped" id="sampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="22"></th>
                        <th colspan="2" style="text-align: center;"><div class="small">Auto Populated</div></th>
                        <th colspan="4" style="text-align: center;"><div class="small">Calculated Field</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Only CVTL</div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-12" style='width: 100px;'>CustomerNumber</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
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
                        <th><div class="small col-12" style='width: 100px;'>Action</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Sales Target</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Rolling Forecast</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Variance</div></th>
                        <th><div class="small col-12" style='width: 150px;'>YTD</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Year to go</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Financial Plan (visible for CVTL)</div></th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    for($i=1; $i<2; $i++) {  
                  ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select class="form-control form-control-inline" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>">
                                <option value='NA'>Select Type</option>
                                <option value="Private" selected>Private</option>
                                <option value="Institution">Institution</option>
                                <option value="MOH">MOH</option>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" class="form-control form-control-inline">
                                <?php foreach($busSector as $val) { ?>
                                    <option value='<?php echo $val; ?>'><?php echo $val; ?></option>
                                <?php } ?>
                             </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Item</option>
                                <?php foreach($itemOne as $key => $val) { ?>
                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                <?php } ?>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <select name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Brand</option>
                            </select>
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
                            <a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            &nbsp;
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
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="0" <?php echo $readonly;?>>
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
                           <a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a>
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
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="0" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridTwoNextYear" name="btnEntryGridTwoNextYear" class="btn btn-primary">Submit</button></div>
            <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div--> <br/>
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="threeNextYear">
        <h4 class="mt-2"><?php echo date("Y")+4;?> Data</h4>
        <div class="table-responsive">
        <form id="entryGridFormThreeNextYear" name="entryGridFormThreeNextYear" method="post">
            <table class="table table-striped" id="sampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="22"></th>
                        <th colspan="2" style="text-align: center;"><div class="small">Auto Populated</div></th>
                        <th colspan="4" style="text-align: center;"><div class="small">Calculated Field</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Only CVTL</div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-12" style='width: 100px;'>CustomerNumber</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
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
                        <th><div class="small col-12" style='width: 100px;'>Action</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 50px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Sales Target</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Rolling Forecast</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Total Forecast (in Current year)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Variance</div></th>
                        <th><div class="small col-12" style='width: 150px;'>YTD</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Year to go</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Financial Plan (visible for CVTL)</div></th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    for($i=1; $i<2; $i++) {  
                  ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select class="form-control form-control-inline" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>">
                                <option value='NA'>Select Type</option>
                                <option value="Private" selected>Private</option>
                                <option value="Institution">Institution</option>
                                <option value="MOH">MOH</option>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="busSelector_<?php echo $i;?>" id="busSelector_<?php echo $i;?>" class="form-control form-control-inline">
                                <?php foreach($busSector as $val) { ?>
                                    <option value='<?php echo $val; ?>'><?php echo $val; ?></option>
                                <?php } ?>
                             </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <select name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Item</option>
                                <?php foreach($itemOne as $key => $val) { ?>
                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                <?php } ?>
                            </select>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <select name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Brand</option>
                            </select>
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
                            <a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            &nbsp;
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
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="0" <?php echo $readonly;?>>
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
                           <a href="#" class="form-control" name="Action" id="Action">Edit/Delete</a>
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
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="0" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridThreeNextYear" name="btnEntryGridThreeNextYear" class="btn btn-primary">Submit</button></div>
            <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div--> <br/>
        </form>
        </div>
    </div>
</div>
<script src="javascript/fieldValidatorForTAL.js"></script>
<script>
    var monthArr = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
    var iterrateArr = [1, 2, 3];
    $(document).ready(function(){ 
        $("#myTab a:first").tab('show'); // show last tab on page load
        $('#mychartOne').hide();
        $('[data-toggle="tooltip"]').tooltip({
            title: "Searcch by customer number or country name or item. <br/> You can also use three criteria togather using colum saparator.",
            html: true
        });
       /*var rules = new Array();
       $('#entryGridFormCurrent input[type=text]').each(function(index, field) {
          let fieldName = $(field).attr('name').split('_');
          if(fieldName[1] === 'fcast' || fieldName[1] === 'focs') {
             if(fieldName[0] !== 'totalSalesTarget' && fieldName[0] !== 'lastRollingForecast' && fieldName[0] !== 'totalForecast' && fieldName[0] !== 'varient' && fieldName[0] !== 'ytd' && fieldName[0] !== 'yearToGo') {
                rules.push($(field).attr('value'));
             }
          } 
       });*/
       
    });    
    iterrateArr.map(function(i){
        $('#item_'+i).change(function(){
            $.post('router.php', {page: 'brandDropDown', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}, function(data) {
                // console.log(data);
                $('#brand_'+i).html(data);                
            });
        });
        $('#brand_'+i).change(function(){
             $.post('router.php', {page: 'totalSalesTarget', arrayData: $(this).val(), otherdata: {customerName: '<?php echo $_SESSION['customerName'];?>', countryId: <?php echo $_SESSION['countryName'];?>} }, function(data) {
                $('#totalSalesTarget_fcast_'+i).val(data);
             });                     
        });
        
        $('#jan_fcast_'+i+', #feb_fcast_'+i+', #mar_fcast_'+i+', #apr_fcast_'+i+', #may_fcast_'+i+', #jun_fcast_'+i+', #jul_fcast_'+i+', #aug_fcast_'+i+', #sep_fcast_'+i+', #oct_fcast_'+i+', #nov_fcast_'+i+', #dec_fcast_'+i+'').keyup(function(){
            var add = parseInt($('#jan_fcast_'+i+'').val()) + parseInt($('#feb_fcast_'+i+'').val()) + parseInt($('#mar_fcast_'+i+'').val()) + parseInt($('#apr_fcast_'+i+'').val()) + parseInt($('#may_fcast_'+i+'').val()) + parseInt($('#jun_fcast_'+i+'').val()) + parseInt($('#jul_fcast_'+i+'').val()) + parseInt($('#aug_fcast_'+i+'').val()) + parseInt($('#sep_fcast_'+i+'').val()) + parseInt($('#oct_fcast_'+i+'').val()) + parseInt($('#nov_fcast_'+i+'').val()) + parseInt($('#dec_fcast_'+i+'').val());
            $('#totalForecast_fcast_'+i+'').val(add);
            // $('#lastRollingForecast_fcast_'+i).val();
            // $('#varient_fcast_'+i+'').val(add - parseInt($('#lastRollingForecast_fcast_'+i+'').val()));
         });
        $('#lastRollingForecast_fcast_'+i).keyup(function(){
            console.log('#lastRollingForecast_fcast_'+i);
           $('#varient_fcast_'+i+'').val(parseInt($('#totalForecast_fcast_'+i).val()) - parseInt($(this).val()));
           $('#ytd_fcast_'+i+'').val(0); //'sum of approve month forecast'
           $('#yearToGo_fcast_'+i+'').val(parseInt($('#totalSalesTarget_fcast_'+i+'').val() - $('#ytd_fcast_'+i+'').val()));
        });
         /*$('#ytd_fcast_'+i+'').val(0); //'sum of approve month forecast'
         $('#yearToGo_fcast_'+i+'').val(parseInt($('#totalSalesTarget_fcast_'+i+'').val() - $('#ytd_fcast_'+i+'').val()));*/
        
        /*This line of code for focs*/
         $('#jan_focs_'+i+', #feb_focs_'+i+', #mar_focs_'+i+', #apr_focs_'+i+', #may_focs_'+i+', #jun_focs_'+i+', #jul_focs_'+i+', #aug_focs_'+i+', #sep_focs_'+i+', #oct_focs_'+i+', #nov_focs_'+i+', #dec_focs_'+i+'').keyup(function(){
            var add = parseInt($('#jan_focs_'+i+'').val()) + parseInt($('#feb_focs_'+i+'').val()) + parseInt($('#mar_focs_'+i+'').val()) + parseInt($('#apr_focs_'+i+'').val()) + parseInt($('#may_focs_'+i+'').val()) + parseInt($('#jun_focs_'+i+'').val()) + parseInt($('#jul_focs_'+i+'').val()) + parseInt($('#aug_focs_'+i+'').val()) + parseInt($('#sep_focs_'+i+'').val()) + parseInt($('#oct_focs_'+i+'').val()) + parseInt($('#nov_focs_'+i+'').val()) + parseInt($('#dec_focs_'+i+'').val());
            $('#totalForecast_focs_'+i+'').val(add);
           // $('#varient_focs_'+i+'').val(add - parseInt($('#lastRollingForecast_focs_'+i+'').val())); 
         });
         $('#lastRollingForecast_focs_'+i).keyup(function(){
             $('#varient_focs_'+i+'').val(parseInt($('#totalForecast_focs_'+i).val()) - parseInt($(this).val()));
             $('#ytd_fcast_'+i+'').val(0); //'sum of approve month focs'     
             $('#yearToGo_focs_'+i+'').val(parseInt($('#totalSalesTarget_focs_'+i+'').val() - $('#ytd_focs_'+i+'').val())); 
         });            
    });
   
   $('#btnEntryGridCurrent').click(function() {
      var TableData;
       TableData = $("#entryGridFormCurrent" ).serializeArray();
       var a = true;
       TableData.map(function(field) {
          let fieldName = $(field).attr('name').split('_');
          if(fieldName[1] === 'fcast' || fieldName[1] === 'focs') {
             if(fieldName[0] !== 'totalSalesTarget' && fieldName[0] !== 'lastRollingForecast' && fieldName[0] !== 'totalForecast' && fieldName[0] !== 'varient' && fieldName[0] !== 'ytd' && fieldName[0] !== 'yearToGo') {
                var fieldValue = $(field).attr('value').match(/^[A-Za-z]*$/);
                // console.log($(field).attr('name')+'==>'+typeof $(field).attr('value')+'==>'+fieldValue); 
                if(fieldValue!==null) {
                    console.log('hello');
                    // $('#'+$(field).attr('name')).val('error');
                    $('#'+$(field).attr('name')).addClass('error');
                   // $('#errorMessage').html('Something went wrong!');
                    a = false;
                } else {
                    $('#'+$(field).attr('name')).removeClass('error');
                    $('#errorMessage').hide();
                }            
             }
          }
       });
       if(a === true) {
           $.post('router.php', {page:'dataEnterIntoTable', arrayData:TableData, yearval: <?php echo date("Y");?>}, function(data){
              console.log('Vikas '+data);
              if(data) {
                  alert('Date insert sucessfully.');
                  location.reload();
              }
           });
        }
    }); 
    $('#btnEntryGridNextYear').click(function(){
      var TableData;
      TableData = $('#entryGridFormNextYear').serializeArray();
      /*var a = true;
       TableData.map(function(field) {
          let fieldName = $(field).attr('name').split('_');
          if(fieldName[1] === 'fcast' || fieldName[1] === 'focs') {
             if(fieldName[0] !== 'totalSalesTarget' && fieldName[0] !== 'lastRollingForecast' && fieldName[0] !== 'totalForecast' && fieldName[0] !== 'varient' && fieldName[0] !== 'ytd' && fieldName[0] !== 'yearToGo') {
                var fieldValue = $(field).attr('value').match(/^[A-Za-z]*$/);
                // console.log($(field).attr('name')+'==>'+typeof $(field).attr('value')+'==>'+fieldValue); 
                if(fieldValue!==null) {
                    console.log('hello');
                    // $('#'+$(field).attr('name')).val('error');
                    $('#'+$(field).attr('name')).addClass('error');
                    //$('#errorMessage').html('Something went wrong!');
                    a = false;
                } else {
                    $('#'+$(field).attr('name')).removeClass('error');
                    $('#errorMessage').hide();
                }            
             }
          }
       });*/
       var a = fieldValidator(TableData);
       if(a === true) {
           $.post('router.php', {page:'dataEnterIntoTable', arrayData:TableData, yearval: <?php echo date("Y")+1;?>}, function(data){
              console.log('Vikas '+data);
              if(data) {
                  alert('Date insert sucessfully.');
                  location.reload();
              }
           });
        }
    });
    
</script>