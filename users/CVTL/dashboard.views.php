<?php
  // print_r($_SESSION);
$unit = ['CNS', 'ID', 'IMM', 'MB & RP', 'OH'];
$busSector = ['DPO', 'TND'];
$status = ['Not Registered', 'Registered'];
$divested = ['No', 'Yes'];
$specificMethod = new specificMethodFile();
$country = $specificMethod->fetchCountryDetails('jnj_country', $_SESSION['countryName']);
/*$fieldName = implode(',', ['id', 'itemName', 'skuCode']);
$condition = ' jnj_item.countryId='.$_SESSION['countryName'];
$item = $specificMethod->fetchItemDetails('jnj_item', $fieldName, $condition);*/

$fields = implode(',',['id','brandName']);
$brandOne = $specificMethod->fetchBrandsIrrespectiveBrandId('jnj_brand', $fields);

$tableName = ['jnj_item', 'jnj_registration'];
$itemOne = $specificMethod->fetchItemsIrrespectiveCustomer($tableName, $_SESSION['customerName']);
$numberOfItteration = (count($itemOne)*3*2 < 19)? count($itemOne)*3*2 : 3;

$dateVal = [date("Y"), date("Y")+1, date("Y")+2, date("Y")+3, date("Y")+4];
?>
<!-- Display the chart and report -->
<ul class="nav nav-tabs" id="myTab">
    <li class="nav-item">
        <a href="#currentYear" class="nav-link" data-toggle="tab">Year - <?php echo date("Y");?></a>
    </li>
    <li class="nav-item">
        <a href="#nextYear" class="nav-link" data-toggle="tab">Year - <?php echo date("Y")+1;?></a>
    </li>
    <li class="nav-item">
        <a href="#oneNextYear" class="nav-link" data-toggle="tab">Year - <?php echo date("Y")+2;?></a>
    </li>
    <li class="nav-item">
        <a href="#twoNextYear" class="nav-link" data-toggle="tab">Year - <?php echo date("Y")+3;?></a>
    </li>
    <li class="nav-item">
        <a href="#threeNextYear" class="nav-link" data-toggle="tab">Year - <?php echo date("Y")+4;?></a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade" id="currentYear">        
        <!-- h4 class="mt-2">Year - <?php echo date("Y");?></h4-->
        <!-- Notification - Status alert -->
        <div class="btn-group float-right">
            <a href="#" class="btn btn-secondary dropdown-toggle btn-sm active" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false" >Notifications &nbsp;
                <i class="fa fa-envelope" style="color:white;" >&nbsp; 
                    <span class="badge badge-pill badge-danger">9</span>
                    <span class="sr-only">unread messages</span>
                </i>
            </a>
            <div class="dropdown-menu  dropdown-menu-right dropdown-menu-sm-right" style="width: 17px;">
                <div class="card-body" style="">
                    <h5 class="card-title small">CVTL's</h5>
                    <p class="card-text small">Your Forecast sheet is being rejected</p>
                    <a href="#" class="card-link small" data-toggle="modal" data-target="#myModal">See the Comments</a>
                </div>
                <div class="card-body">
                    <h5 class="card-title small">CVTL's</h5>
                    <p class="card-text small">Your Forecast sheet is being rejected</p>
                    <a href="#" class="card-link small" data-toggle="modal" data-target="#myModal">See the Comments</a>
                </div>
            </div>
        </div><br/><br/>
        <!-- Notification DropDown -->
        <?php
            $conditionTAL = ' customerName='.$_SESSION['customerName'].' AND year='.$dateVal[0];
            $tempTalDataEntry = $specificMethod->fetchMultipleRecordsByDateTime('jnj_temp_cvtl_dataentry', '*', $dateVal[0], $conditionTAL);
        ?>
        <div class="table-responsive">
        <form id="entryGridFormCurrent" name="entryGridFormCurrent" method="post">
            <table class="table table-striped" id="sampleCurrentTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="22"><div id="errorMessage"><?php if($numberOfItteration === 0) echo "No Item has assgined."; ?></div></th>
                        <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
                        <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
                        <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-4" style='width: 40px;'>&nbsp;</div></th>
                        <th><div class="small col-8" style='width: 60px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 150px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Forecast/FOCs</div></th>
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
                        <th><div class="small col-12" style='width: 150px;'>Current Rolling Forecast</div></th>
                        <th><div class="small col-8" style='width: 80px;'>Variance</div></th>
                        <th><div class="small col-8" style='width: 80px;'>YTD</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Business to Go</div></th>
                        <th><div class="small col-12" style='width: 130px;'>Financial Plan (visible for CVTL)</div></th>
                    </tr>
                </thead>
                <tbody>
                  <?php for($i=1; $i<=$numberOfItteration; $i++) { ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="hidden" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                            <input type="text" class="form-control" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['type'];?>" readonly>
                            <?php } else { ?>
                            <select class="form-control form-control-inline" name="type_<?php echo $i;?>" id="type_<?php echo $i;?>">
                                <option value='0'>Select Type</option>
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
                            <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" value="<?php echo $brandOne[$tempTalDataEntry[$i-1]['brandId']];?>" readonly>
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
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['financialPlan_fcast'])?$tempTalDataEntry[$i-1]['financialPlan_fcast']:0;?>">
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
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['financialPlan_focs'])?$tempTalDataEntry[$i-1]['financialPlan_focs']:0;?>">
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary">Submit</button></div>
            <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div-->
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="nextYear">
        <!--h4 class="mt-2"><?php echo date("Y")+1;?> Data</h4-->
        <!-- Notification - Status alert -->
        <div class="btn-group float-right">
            <a href="#" class="btn btn-secondary dropdown-toggle btn-sm active" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false" >Notifications &nbsp;
                <i class="fa fa-envelope" style="color:white;" >&nbsp; 
                    <span class="badge badge-pill badge-danger">9</span>
                    <span class="sr-only">unread messages</span>
                </i>
            </a>
            <div class="dropdown-menu  dropdown-menu-right dropdown-menu-sm-right" style="width: 17px;">
                <div class="card-body" style="">
                    <h5 class="card-title small">CVTL's</h5>
                    <p class="card-text small">Your Forecast sheet is being rejected</p>
                    <a href="#" class="card-link small" data-toggle="modal" data-target="#myModal">See the Comments</a>
                </div>
                <div class="card-body">
                    <h5 class="card-title small">CVTL's</h5>
                    <p class="card-text small">Your Forecast sheet is being rejected</p>
                    <a href="#" class="card-link small" data-toggle="modal" data-target="#myModal">See the Comments</a>
                </div>
            </div>
        </div><br/><br/>
        <!-- Notification DropDown -->
        <?php
            $conditionTALNextYear = ' customerName='.$_SESSION['customerName'].' AND year='.$dateVal[1];
            $tempTalDataEntryNextYear = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', '*', $dateVal[1], $conditionTALNextYear);
            // print_r($tempTalDataEntryNextYear);
        ?>
        <div class="table-responsive">
        <form id="entryGridFormNextYear" name="entryGridFormNextYear" method="post">
            <table class="table table-striped" id="sampleNextTbl">
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
                  <?php for($i=1; $i<=$numberOfItteration; $i++) { ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="hidden" class="form-control" name="customerName_<?php echo $i;?>" id="customerNameN_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="countryN_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear[$i-1])) { ?>
                            <input type="text" class="form-control" name="type_<?php echo $i;?>" id="typeN_<?php echo $i;?>" value="<?php echo $tempTalDataEntryNextYear[$i-1]['type'];?>" readonly>
                            <?php } else { ?>
                            <select class="form-control form-control-inline" name="type_<?php echo $i;?>" id="typeN_<?php echo $i;?>">
                                <option value='NA'>Select Type</option>
                                <option value="Private" selected>Private</option>
                                <option value="Institution">Institution</option>
                                <option value="MOH">MOH</option>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear[$i-1])) { ?>
                             <input type="text" class="form-control" name="busSelector_<?php echo $i;?>" id="busSelectorN_<?php echo $i;?>" value="<?php echo $tempTalDataEntryNextYear[$i-1]['busSelector'];?>" readonly>
                            <?php } else { ?>
                            <select name="busSelector_<?php echo $i;?>" id="busSelectorN_<?php echo $i;?>" class="form-control form-control-inline">
                                <?php foreach($busSector as $val) { ?>
                                    <option value='<?php echo $val; ?>'><?php echo $val; ?></option>
                                <?php } ?>
                             </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear[$i-1])) { ?>
                            <input type="text" class="form-control" name="item_<?php echo $i;?>" id="itemN_<?php echo $i;?>" value="<?php echo $itemOne[$tempTalDataEntryNextYear[$i-1]['itemId']]; ?>" readonly>
                            <?php } else { ?>
                            <select name="item_<?php echo $i;?>" id="itemN_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Item</option>
                                <?php foreach($itemOne as $key => $val) { ?>
                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear[$i-1])) { ?>
                            <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brandN_<?php echo $i;?>" value="<?php echo $brandOne[$tempTalDataEntryNextYear[$i-1]['brandId']];?>" readonly>
                            <?php } else { ?>
                            <select name="brand_<?php echo $i;?>" id="brandN_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Brand</option>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jan_fcast'])?$tempTalDataEntryNextYear[$i-1]['jan_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['feb_fcast'])?$tempTalDataEntryNextYear[$i-1]['feb_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['mar_fcast'])?$tempTalDataEntryNextYear[$i-1]['mar_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['apr_fcast'])?$tempTalDataEntryNextYear[$i-1]['apr_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['may_fcast'])?$tempTalDataEntryNextYear[$i-1]['may_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jun_fcast'])?$tempTalDataEntryNextYear[$i-1]['jun_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jul_fcast'])?$tempTalDataEntryNextYear[$i-1]['jul_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['aug_fcast'])?$tempTalDataEntryNextYear[$i-1]['aug_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['sep_fcast'])?$tempTalDataEntryNextYear[$i-1]['sep_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['oct_fcast'])?$tempTalDataEntryNextYear[$i-1]['oct_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['nov_fcast'])?$tempTalDataEntryNextYear[$i-1]['nov_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['dec_fcast'])?$tempTalDataEntryNextYear[$i-1]['dec_fcast']:0;?>" maxlength="5">
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
                            <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['totalSalesTarget_fcast'])?$tempTalDataEntryNextYear[$i-1]['totalSalesTarget_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['lastRollingForecast_fcast'])?$tempTalDataEntryNextYear[$i-1]['lastRollingForecast_fcast']:0;?>"  readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['totalForecast_fcast'])?$tempTalDataEntryNextYear[$i-1]['totalForecast_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['varient_fcast'])?$tempTalDataEntryNextYear[$i-1]['varient_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['ytd_fcast'])?$tempTalDataEntryNextYear[$i-1]['ytd_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['yearToGo_fcast'])?$tempTalDataEntryNextYear[$i-1]['yearToGo_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['financialPlan_fcast'])?$tempTalDataEntryNextYear[$i-1]['financialPlan_fcast']:0;?>">
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <level class="form-control"><?php echo strtoupper('focs');?></level>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jan_focs'])?$tempTalDataEntryNextYear[$i-1]['jan_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['feb_focs'])?$tempTalDataEntryNextYear[$i-1]['feb_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['mar_focs'])?$tempTalDataEntryNextYear[$i-1]['mar_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['apr_focs'])?$tempTalDataEntryNextYear[$i-1]['apr_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['may_focs'])?$tempTalDataEntryNextYear[$i-1]['may_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jun_focs'])?$tempTalDataEntryNextYear[$i-1]['jun_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jul_focs'])?$tempTalDataEntryNextYear[$i-1]['jul_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['aug_focs'])?$tempTalDataEntryNextYear[$i-1]['aug_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['sep_focs'])?$tempTalDataEntryNextYear[$i-1]['sep_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['oct_focs'])?$tempTalDataEntryNextYear[$i-1]['oct_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['nov_focs'])?$tempTalDataEntryNextYear[$i-1]['nov_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['dec_focs'])?$tempTalDataEntryNextYear[$i-1]['dec_focs']:0;?>" maxlength="5">
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
                            <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['totalSalesTarget_focs'])?$tempTalDataEntryNextYear[$i-1]['totalSalesTarget_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['lastRollingForecast_focs'])?$tempTalDataEntryNextYear[$i-1]['lastRollingForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['totalForecast_focs'])?$tempTalDataEntryNextYear[$i-1]['totalForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['varient_focs'])?$tempTalDataEntryNextYear[$i-1]['varient_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['ytd_focs'])?$tempTalDataEntryNextYear[$i-1]['ytd_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['yearToGo_focs'])?$tempTalDataEntryNextYear[$i-1]['yearToGo_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['financialPlan_focs'])?$tempTalDataEntryNextYear[$i-1]['financialPlan_focs']:0;?>">
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridNextYear" name="btnEntryGridNextYear" class="btn btn-primary">Submit</button></div>
            <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div-->
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="oneNextYear">
        <!--h4 class="mt-2"><?php echo date("Y")+2;?> Data</h4-->
        <!-- Notification DropDown -->
        <div class="btn-group float-right">
            <a href="#" class="btn btn-secondary dropdown-toggle btn-sm active" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false" >Notifications &nbsp;
                <i class="fa fa-envelope" style="color:white;" >&nbsp; 
                    <span class="badge badge-pill badge-danger">9</span>
                    <span class="sr-only">unread messages</span>
                </i>
            </a>
            <div class="dropdown-menu  dropdown-menu-right dropdown-menu-sm-right" style="width: 17px;">
                <div class="card-body" style="">
                    <h5 class="card-title small">CVTL's</h5>
                    <p class="card-text small">Your Forecast sheet is being rejected</p>
                    <a href="#" class="card-link small" data-toggle="modal" data-target="#myModal">See the Comments</a>
                </div>
                <div class="card-body">
                    <h5 class="card-title small">CVTL's</h5>
                    <p class="card-text small">Your Forecast sheet is being rejected</p>
                    <a href="#" class="card-link small" data-toggle="modal" data-target="#myModal">See the Comments</a>
                </div>
            </div>
        </div><br/><br/>
        <!-- Notification DropDown -->
        <?php
            $conditionTALNextYear2 = ' customerName='.$_SESSION['customerName'].' AND year='.$dateVal[2];
            $tempTalDataEntryNextYear2 = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', '*', $dateVal[2], $conditionTALNextYear2);
            // print_r($tempTalDataEntryNextYear);
        ?>
        <div class="table-responsive">
        <form id="entryGridFormOneNextYear" name="entryGridFormOneNextYear" method="post">
            <table class="table table-striped" id="nextOneSampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="22"></th>
                        <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
                        <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
                        <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-4" style='width: 40px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Country</div></th>
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
                    for($i=1; $i<=$numberOfItteration; $i++) {  
                  ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="hidden" class="form-control" name="customerName_<?php echo $i;?>" id="customerNameNN_<?php echo $i;?>" value="<?php echo $customerNameOne['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="countryNN_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear2[$i-1])) { ?>
                            <input type="text" class="form-control" name="type_<?php echo $i;?>" id="typeNN_<?php echo $i;?>" value="<?php echo $tempTalDataEntryNextYear2[$i-1]['type'];?>" readonly>
                            <?php } else { ?>
                            <select class="form-control form-control-inline" name="type_<?php echo $i;?>" id="typeNN_<?php echo $i;?>">
                                <option value='NA'>Select Type</option>
                                <option value="Private" selected>Private</option>
                                <option value="Institution">Institution</option>
                                <option value="MOH">MOH</option>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear2[$i-1])) { ?>
                             <input type="text" class="form-control" name="busSelector_<?php echo $i;?>" id="busSelectorNN_<?php echo $i;?>" value="<?php echo $tempTalDataEntryNextYear2[$i-1]['busSelector'];?>" readonly>
                            <?php } else { ?>
                            <select name="busSelector_<?php echo $i;?>" id="busSelectorNN_<?php echo $i;?>" class="form-control form-control-inline">
                                <?php foreach($busSector as $val) { ?>
                                    <option value='<?php echo $val; ?>'><?php echo $val; ?></option>
                                <?php } ?>
                             </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear2[$i-1])) { ?>
                            <input type="text" class="form-control" name="item_<?php echo $i;?>" id="itemNN_<?php echo $i;?>" value="<?php echo $itemOne[$tempTalDataEntryNextYear2[$i-1]['itemId']]; ?>" readonly>
                            <?php } else { ?>
                            <select name="item_<?php echo $i;?>" id="itemNN_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Item</option>
                                <?php foreach($itemOne as $key => $val) { ?>
                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                <?php } ?>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear2[$i-1])) { ?>
                            <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brandNN_<?php echo $i;?>" value="<?php echo $brandOne[$tempTalDataEntryNextYear2[$i-1]['brandId']];?>" readonly>
                            <?php } else { ?>
                            <select name="brand_<?php echo $i;?>" id="brandNN_<?php echo $i;?>" class="form-control form-control-inline">
                                <option value='0'>Select Brand</option>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['jan_fcast'])?$tempTalDataEntryNextYear2[$i-1]['jan_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['feb_fcast'])?$tempTalDataEntryNextYear2[$i-1]['feb_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['mar_fcast'])?$tempTalDataEntryNextYear2[$i-1]['mar_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['apr_fcast'])?$tempTalDataEntryNextYear2[$i-1]['apr_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['may_fcast'])?$tempTalDataEntryNextYear2[$i-1]['may_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['jun_fcast'])?$tempTalDataEntryNextYear2[$i-1]['jun_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['jul_fcast'])?$tempTalDataEntryNextYear2[$i-1]['jul_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['aug_fcast'])?$tempTalDataEntryNextYear2[$i-1]['aug_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['sep_fcast'])?$tempTalDataEntryNextYear2[$i-1]['sep_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['oct_fcast'])?$tempTalDataEntryNextYear2[$i-1]['oct_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['nov_fcast'])?$tempTalDataEntryNextYear2[$i-1]['nov_fcast']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['dec_fcast'])?$tempTalDataEntryNextYear2[$i-1]['dec_fcast']:0;?>" maxlength="5">
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
                            <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['totalSalesTarget_fcast'])?$tempTalDataEntryNextYear2[$i-1]['totalSalesTarget_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['lastRollingForecast_fcast'])?$tempTalDataEntryNextYear2[$i-1]['lastRollingForecast_fcast']:0;?>"  readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['totalForecast_fcast'])?$tempTalDataEntryNextYear2[$i-1]['totalForecast_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['varient_fcast'])?$tempTalDataEntryNextYear2[$i-1]['varient_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['ytd_fcast'])?$tempTalDataEntryNextYear2[$i-1]['ytd_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['yearToGo_fcast'])?$tempTalDataEntryNextYear2[$i-1]['yearToGo_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['financialPlan_fcast'])?$tempTalDataEntryNextYear2[$i-1]['financialPlan_fcast']:0;?>">
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <level class="form-control"><?php echo strtoupper('focs');?></level>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['jan_focs'])?$tempTalDataEntryNextYear2[$i-1]['jan_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['feb_focs'])?$tempTalDataEntryNextYear2[$i-1]['feb_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['mar_focs'])?$tempTalDataEntryNextYear2[$i-1]['mar_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['apr_focs'])?$tempTalDataEntryNextYear2[$i-1]['apr_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['may_focs'])?$tempTalDataEntryNextYear2[$i-1]['may_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['jun_focs'])?$tempTalDataEntryNextYear2[$i-1]['jun_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['jul_focs'])?$tempTalDataEntryNextYear2[$i-1]['jul_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['aug_focs'])?$tempTalDataEntryNextYear2[$i-1]['aug_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['sep_focs'])?$tempTalDataEntryNextYear2[$i-1]['sep_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['oct_focs'])?$tempTalDataEntryNextYear2[$i-1]['oct_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['nov_focs'])?$tempTalDataEntryNextYear2[$i-1]['nov_focs']:0;?>" maxlength="5">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['dec_focs'])?$tempTalDataEntryNextYear2[$i-1]['dec_focs']:0;?>" maxlength="5">
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
                            <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['totalSalesTarget_focs'])?$tempTalDataEntryNextYear2[$i-1]['totalSalesTarget_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['lastRollingForecast_focs'])?$tempTalDataEntryNextYear2[$i-1]['lastRollingForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['totalForecast_focs'])?$tempTalDataEntryNextYear2[$i-1]['totalForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['varient_focs'])?$tempTalDataEntryNextYear2[$i-1]['varient_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['ytd_focs'])?$tempTalDataEntryNextYear2[$i-1]['ytd_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['yearToGo_focs'])?$tempTalDataEntryNextYear2[$i-1]['yearToGo_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focsNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['financialPlan_focs'])?$tempTalDataEntryNextYear2[$i-1]['financialPlan_focs']:0;?>">
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridOneNextYear" name="btnEntryGridOneNextYear" class="btn btn-primary">Submit</button></div>
            <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div-->
        </form>
        </div>
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
<script src="javascript/fieldValidatorForCVTL.js"></script>
<script>
    $(document).ready(function(){ 
        $("#myTab a:first").tab('show'); // show last tab on page load
        $('[data-toggle="tooltip"]').tooltip({
            title: "Searcch by customer number or country name or item. <br/> You can also use three criteria togather using colum saparator.",
            html: true
        });
    });
    var iterrateArr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,	32,	33,	34,	35,	36,	37,	38,	39,	40,	41,	42,	43,	44,	45,	46,	47,	48,	49,	50,	51,	52,	53,	54,	55,	56,	57,	58,	59,	60,	61,	62,	63,	64,	65,	66,	67,	68,	69,	70,	71,	72,	73,	74,	75,	76,	77,	78,	79,	80,	81,	82,	83,	84,	85,	86,	87,	88,	89,	90,	91,	92,	93,	94,	95,	96,	97,	98,	99,	100];
    iterrateArr.map(function(i){
/*Start:: Current Year Form*/
        $('#item_'+i).change(function(){
            /*$.post('router.php', {page: 'brandDropDown', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}, function(data) {
                $('#brand_'+i).html(data);                
            });*/
            $.when( $.post('router.php', {page: 'brandDropDown', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}) )
                .then( function(data) { $('#brand_'+i).html(data); });
            $.when ( $.post('router.php', {page: 'lastRollingForecast', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}))
                .then( function(data) { $('#lastRollingForecast_fcast_'+i).val(data); } );
        });
        $('#brand_'+i).change(function(){
             /*$.post('router.php', {page: 'totalSalesTarget', arrayData: $(this).val(), otherdata: {customerName: '<?php echo $_SESSION['customerName'];?>', countryId: <?php echo $_SESSION['countryName'];?>} }, function(data) {
                console.log(data);
                if(data!=="")
                   var dataValue = data;
                 else
                   var dataValue = 0;
                $('#totalSalesTarget_fcast_'+i).val(dataValue);
             });*/
             let itemId = $('#item_'+i).val();
             $.post('router.php', {page: 'totalSalesTarget', arrayData: itemId, otherdata: {customerName: '<?php echo $_SESSION['customerName'];?>', countryId: <?php echo $_SESSION['countryName'];?>} }, function(data) {
                if(data!=="")
                   var dataValue = data;
                 else
                   var dataValue = 0;
                $('#totalSalesTarget_fcast_'+i).val(dataValue);
             });
        });
        var aDate = new Date();
        // console.log(aDate);
        $('#jan_fcast_'+i+', #feb_fcast_'+i+', #mar_fcast_'+i+', #apr_fcast_'+i+', #may_fcast_'+i+', #jun_fcast_'+i+', #jul_fcast_'+i+', #aug_fcast_'+i+', #sep_fcast_'+i+', #oct_fcast_'+i+', #nov_fcast_'+i+', #dec_fcast_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_fcast_'+i+'').val()) + parseFloat($('#feb_fcast_'+i+'').val()) + parseFloat($('#mar_fcast_'+i+'').val()) + parseFloat($('#apr_fcast_'+i+'').val()) + parseFloat($('#may_fcast_'+i+'').val()) + parseFloat($('#jun_fcast_'+i+'').val()) + parseFloat($('#jul_fcast_'+i+'').val()) + parseFloat($('#aug_fcast_'+i+'').val()) + parseFloat($('#sep_fcast_'+i+'').val()) + parseFloat($('#oct_fcast_'+i+'').val()) + parseFloat($('#nov_fcast_'+i+'').val()) + parseFloat($('#dec_fcast_'+i+'').val());
            $('#totalForecast_fcast_'+i+'').val(add);
            let varientVolume = (add - parseFloat($('#lastRollingForecast_fcast_'+i+'').val())).toFixed(2)
            $('#varient_fcast_'+i+'').val(varientVolume);
         });
         $('#ytd_fcast_'+i+'').val(0); //'sum of approve month forecast'
         $('#yearToGo_fcast_'+i+'').val(parseFloat($('#totalSalesTarget_fcast_'+i+'').val() - $('#ytd_fcast_'+i+'').val()));
        
        /*This line of code for focs*/
         $('#jan_focs_'+i+', #feb_focs_'+i+', #mar_focs_'+i+', #apr_focs_'+i+', #may_focs_'+i+', #jun_focs_'+i+', #jul_focs_'+i+', #aug_focs_'+i+', #sep_focs_'+i+', #oct_focs_'+i+', #nov_focs_'+i+', #dec_focs_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_focs_'+i+'').val()) + parseFloat($('#feb_focs_'+i+'').val()) + parseFloat($('#mar_focs_'+i+'').val()) + parseFloat($('#apr_focs_'+i+'').val()) + parseFloat($('#may_focs_'+i+'').val()) + parseFloat($('#jun_focs_'+i+'').val()) + parseFloat($('#jul_focs_'+i+'').val()) + parseFloat($('#aug_focs_'+i+'').val()) + parseFloat($('#sep_focs_'+i+'').val()) + parseFloat($('#oct_focs_'+i+'').val()) + parseFloat($('#nov_focs_'+i+'').val()) + parseFloat($('#dec_focs_'+i+'').val());
            $('#totalForecast_focs_'+i+'').val(add);
            let varientVolumeFocs = (add - parseFloat($('#lastRollingForecast_focs_'+i+'').val())).toFixed(2);
            $('#varient_focs_'+i+'').val(varientVolumeFocs); 
         });         
         $('#ytd_focs_'+i+'').val(0); //'sum of approve month focs'     
         $('#yearToGo_focs_'+i+'').val(parseFloat($('#totalSalesTarget_focs_'+i+'').val() - $('#ytd_focs_'+i+'').val())); 
/*End:: Current Year Form*/
     
     /*Start:: Current Year Form*/
        $('#itemN_'+i).change(function(){
            $.post('router.php', {page: 'brandDropDown', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}, function(data) {
                console.log(data);
                $('#brandN_'+i).html(data);
            });
        });
        $('#brandN_'+i).change(function(){
             $.post('router.php', {page: 'totalSalesTarget', arrayData: $(this).val(), otherdata: {customerName: '<?php echo $_SESSION['customerName'];?>', countryId: <?php echo $_SESSION['countryName'];?>} }, function(data) {
                $('#totalSalesTarget_fcastN_'+i).val(data);
             });                     
        }); 
    });
    $('#btnEntryGridCurrent').click(function() {
      var TableData;
       TableData = $("#entryGridFormCurrent" ).serializeArray();
       var a = fieldValidator(TableData);
       let sendData = storeTblValues('currentSampleTbl');
       sendData = JSON.stringify(sendData);
       if(a === true) {
           $.post('router.php', {page:'dataEnterIntoTableCVTL', arrayData:TableData, yearval: <?php echo date("Y");?>}, function(data){
              if(data) {
                  console.log(data);
                 /* alert('Date insert sucessfully.');
                  location.reload();*/
              }
           });
        }
    }); 
    $('#btnEntryGridNextYear').click(function(){      
       let tempArr = [];
       $("input[id*='fcastN']").each(function(i){           
           tempArr.push({'name': $(this).attr('id'), 'value': $(this).val()});
       });
       $("input[id*='focsN']").each(function() {
           tempArr.push({'name': $(this).attr('id'), 'value': $(this).val()});
       });
       // console.log(tempArr);
       var a = fieldValidatorAnother(tempArr);
       if(a === true) {
           let TableData = $('#entryGridFormNextYear').serializeArray();
           $.post('router.php', {page:'dataEnterIntoTableCVTL', arrayData:TableData, yearval: <?php echo date("Y")+1;?>}, function(data){
              if(data) {
                  alert('Date insert sucessfully.');
                  location.reload();
              }
           });
        }
    });
   
</script>