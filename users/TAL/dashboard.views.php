<?php
$unit = ['CNS', 'ID', 'IMM', 'MB & RP', 'OH'];
$busSector = ['DPO', 'TND'];
$status = ['Not Registered', 'Registered'];
$divested = ['No', 'Yes'];
$specificMethod = new specificMethodFile();
$country = $specificMethod->fetchCountryDetails('jnj_country', $_SESSION['countryName']);

$tableName = ['jnj_item', 'jnj_registration'];
$itemOne = $specificMethod->fetchItemsIrrespectiveCustomer($tableName, $_SESSION['customerName']);
$numberOfItteration = (count($itemOne)*3*2 < 19)? count($itemOne) : 3;

$fields = implode(',',['id','brandName']);
$brandOne = $specificMethod->fetchBrandsIrrespectiveBrandId('jnj_brand', $fields);
$brandOneNew = $specificMethod->fetchBrandsIrrespectiveItemId('jnj_brand', $fields, $itemOne);

$condition = ' customerWWID='.$_SESSION['customerName'];
$customerNameOne = $specificMethod->customerDetailsFromId('jnj_customer', $condition)[0];

if($_SESSION['userRole'] !== 'CVTL'){
   $readonly = 'readonly';
}
$dateVal = [date("Y"), date("Y")+1, date("Y")+2, date("Y")+3, date("Y")+4];
?>
<!-- Display the chart and report -->
<ul class="nav nav-tabs" id="myTab">
    <li class="nav-item">
        <a href="#currentYear" class="nav-link" data-toggle="tab" id="year_19">Year - <?php echo $dateVal[0];?></a>
    </li>
    <li class="nav-item">
        <a href="#nextYear" class="nav-link" data-toggle="tab" id="year_19">Year - <?php echo $dateVal[1];?></a>
    </li>
    <li class="nav-item">
        <a href="#oneNextYear" class="nav-link" data-toggle="tab" id="year_18"> Accumulated 3 Years of data</a>
    </li>
    <li class="nav-item">
        <a href="#twoNextYear" class="nav-link" data-toggle="tab" id="year_17">Quarterly Prices</a>
    </li>
    <li class="nav-item">
        <a href="#threeNextYear" class="nav-link" data-toggle="tab" id="year_17">Report</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade" id="currentYear">
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
            $previousMonth = date('m')-1;
            $fieldTALName = '*';
            $conditionTAL = ' customerWWID='.$_SESSION['customerName'].' AND year='.$dateVal[0];
            $talDataFromActual = $specificMethod->fetchActualSalesRecordsByDateTime('jnj_actualsalesvalue', $fieldTALName, $dateVal[0], $conditionTAL);
            $talTempData = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', $fieldTALName, $dateVal[0], $conditionTAL);
            $talFcastFocsData = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_fcast_focs_dataentry', $fieldTALName, $dateVal[0], $conditionTAL);
            
            if (!empty($talDataFromActual) && empty($talTempData)){
                $tempTalDataEntry = $talDataFromActual;
                $readonly = 'readonly';
            } else {
                $tempTalDataEntry = $talTempData;
                $readonly = 'readonly';
            }
            $targetSales = $specificMethod->fetchTargetSales('jnj_totalSalesTarget', 'fftarget', $dateVal[0]);
            $lastRollingForecast = $specificMethod->fetchLastRollingForecast('jnj_totalrollingforecast', 'rollingForecast', $dateVal[0], $previousMonth);
        ?>
        <div class="table-responsive" style="height:550px;">
        <form id="entryGridFormCurrent" name="entryGridFormCurrent" method="post">
            <table class="table table-striped" id="currentSampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="4" class="small">
                            <div class="btn-group dropright">
                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="valueFromNFGSystem">Statical Forecast volume</button>
                              <div class="dropdown-menu" style="position:fixed;">
                                <a class="dropdown-item" href="#" >HGNC:1</a>
                                <a class="dropdown-item" href="#">HGNC:2</a>
                                <a class="dropdown-item" href="#">HGNC:3</a>
                                <a class="dropdown-item" href="#">HGNC:4</a>
                                <a class="dropdown-item" href="#">HGNC:5</a>
                                <a class="dropdown-item" href="#">HGNC:6</a>
                                <a class="dropdown-item" href="#">HGNC:7</a>
                                <a class="dropdown-item" href="#">HGNC:8</a>
                                <a class="dropdown-item" href="#">HGNC:9</a>  
                              </div>
                            </div>
                        </th>
                        <th colspan="3">
                            <div class="btn-group dropright">
                                <form class="form-inline">
                                   <input class="form-control mr-sm-2" type="search" placeholder="Search by brand" aria-label="Search" style="width:180px;">
                                   <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </th>
                        <th colspan="13"><div id="errorMessage"></div></th>
                        <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
                        <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
                        <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
                        <th><div class="small col-8" style='width: 60px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>TND/ DPO</div></th>
                        <th><div class="small col-12" style='width: 130px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 170px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Forecast/FOCs</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Jan</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Feb</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Mar</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Apr</div></th>
                        <th><div class="small col-12" style='width: 80px;'>May</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Jun</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Jul</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Aug</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Sep</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Oct</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Nov</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Dec</div></th>
                        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 120px;'>Total Sales (ff)</div></th>
                        <th><div class="small col-12" style='width: 100px;'>LR Forecast</div></th>
                        <th><div class="small col-12" style='width: 150px;'>CR Forecast</div></th>
                        <th><div class="small col-12" style='width: 120px;'>Variance (CRF-LRF)</div></th>
                        <th><div class="small col-8" style='width: 80px;'>YTD</div></th>
                        <th><div class="small col-12" style='width: 200px;'>Business to Go (FF Target - YTD)</div></th>
                        <th><div class="small col-12" style='width: 130px;'>Financial Plan (visible for CVTL)</div></th>
                    </tr>
                </thead>
                <tbody>
                  <?php 
                    $i = 0;
                     // foreach($tempTalDataEntry as $key => $val) {
                      foreach($itemOne as $key => $val) {
                       // echo $key .'=='. $val."\n";
                        $i = $i + 1;
                        $arrUpsideVal = ['upSidevalue', 'monthValue', 'itemId'];
                        $arrDownsideVal = ['downSidevalue', 'monthValue', 'itemId'];
                        $upside = $specificMethod->fetchUpsideVolume('jnj_upsidetable', $arrUpsideVal, $_SESSION['customerName'], $key, $dateVal[0]);
                        $downside = $specificMethod->fetchDownsideVolume('jnj_downsidetable', $arrDownsideVal, $_SESSION['customerName'], $key, $dateVal[0]);
                   ?>
                    <tr>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="hidden" class="form-control" name="customerName_<?php echo $i;?>" id="customerName_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">             
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="country_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                            
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
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">
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
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                            <level class="form-control"><?php echo $brandOne[$tempTalDataEntry[$i-1]['brandId']];?></level>
                            <input type="hidden" class="form-control" name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['brandId'];?>" readonly>
                            <?php } else { ?>
                            <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brand_<?php echo $i;?>" value="<?php echo $brandOne[$brandOneNew[$key]];?>" readonly>
                            <?php } ?>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                            <level class="form-control"><?php echo $itemOne[$tempTalDataEntry[$i-1]['itemId']];?></level>
                            <input type="hidden" class="form-control" name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['itemId']; ?>" readonly>
                            <?php } else { ?>
                            <input type="text" class="form-control" name="item_<?php echo $i;?>" id="item_<?php echo $i;?>" value="<?php echo $itemOne[$key]; ?>" readonly>
                            <?php } ?>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                          <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
                        </div><span style="font-size:12px;font-weight:bold;color:green;">Upside</span><br/><span style="font-size:12px;font-weight:bold;color:red;">Downside</span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">
                            <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jan_fcast'])?$tempTalDataEntry[$i-1]['jan_fcast']:$talFcastFocsData[$i-1]['jan_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['jan_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['jan_fcast']) && date('m')-1 > 1)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="jan_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="jan_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="jan_fcast_<?php echo $i;?>">Information</span>
                            </div>
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][1])?$upside[$key][1]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][1])?$downside[$key][1]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['feb_fcast'])?$tempTalDataEntry[$i-1]['feb_fcast']:$talFcastFocsData[$i-1]['feb_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['feb_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['feb_fcast'])&& date('m')-1 >= 2)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="feb_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="feb_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="feb_fcast_<?php echo $i;?>" >Information</span>
                            </div>                            
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][2])?$upside[$key][2]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][2])?$downside[$key][2]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['mar_fcast'])?$tempTalDataEntry[$i-1]['mar_fcast']:$talFcastFocsData[$i-1]['mar_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['mar_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['mar_fcast'])&& date('m')-1 >= 3)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="mar_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="mar_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="mar_fcast_<?php echo $i;?>">Information</span>
                            </div> 
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][3])?$upside[$key][3]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][3])?$downside[$key][3]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['apr_fcast'])?$tempTalDataEntry[$i-1]['apr_fcast']:$talFcastFocsData[$i-1]['apr_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['apr_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['apr_fcast'])&& date('m')-1 >= 4)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="apr_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="apr_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="apr_fcast_<?php echo $i;?>">Information</span>
                            </div> 
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][4])?$upside[$key][4]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][4])?$downside[$key][4]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['may_fcast'])?$tempTalDataEntry[$i-1]['may_fcast']:$talFcastFocsData[$i-1]['may_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['may_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['may_fcast'])&& date('m')-1 >= 5)?'green;color: #fff;':'pink;color: #fff;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="may_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="may_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="may_fcast_<?php echo $i;?>">Information</span>
                            </div>
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][5])?$upside[$key][5]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][5])?$downside[$key][5]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jun_fcast'])?$tempTalDataEntry[$i-1]['jun_fcast']:$talFcastFocsData[$i-1]['jun_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['jun_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['jun_fcast'])&& date('m')-1 >= 6)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="jun_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="jun_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="jun_fcast_<?php echo $i;?>">Information</span>
                            </div>
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][6])?$upside[$key][6]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][6])?$downside[$key][6]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jul_fcast'])?$tempTalDataEntry[$i-1]['jul_fcast']:$talFcastFocsData[$i-1]['jul_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['jul_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['jul_fcast'])&& date('m')-1 >= 7)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="jul_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="jul_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="jul_fcast_<?php echo $i;?>">Information</span>
                            </div>
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][7])?$upside[$key][7]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][7])?$downside[$key][7]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['aug_fcast'])?$tempTalDataEntry[$i-1]['aug_fcast']:$talFcastFocsData[$i-1]['aug_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['aug_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['aug_fcast'])&& date('m')-1 >= 8)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="aug_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="aug_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="aug_fcast_<?php echo $i;?>">Information</span>
                            </div>
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][8])?$upside[$key][8]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][8])?$downside[$key][8]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['sep_fcast'])?$tempTalDataEntry[$i-1]['sep_fcast']:$talFcastFocsData[$i-1]['sep_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['sep_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['sep_fcast'])&& date('m')-1 >= 9)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="sep_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="sep_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="sep_fcast_<?php echo $i;?>">Information</span>
                            </div> 
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][9])?$upside[$key][9]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][9])?$downside[$key][9]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['oct_fcast'])?$tempTalDataEntry[$i-1]['oct_fcast']:$talFcastFocsData[$i-1]['oct_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['oct_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['oct_fcast'])&& date('m')-1 >= 10)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="oct_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="oct_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="oct_fcast_<?php echo $i;?>">Information</span>
                            </div> 
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][10])?$upside[$key][10]:'';?></span><br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][10])?$downside[$key][10]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['nov_fcast'])?$tempTalDataEntry[$i-1]['nov_fcast']:$talFcastFocsData[$i-1]['nov_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['nov_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['nov_fcast'])&& date('m')-1 >= 11)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="nov_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="nov_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="nov_fcast_<?php echo $i;?>">Information</span>
                            </div> 
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][11])?$upside[$key][11]:'';?></span> <br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][11])?$downside[$key][11]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['dec_fcast'])?$tempTalDataEntry[$i-1]['dec_fcast']:$talFcastFocsData[$i-1]['dec_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['dec_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['dec_fcast'])&& date('m')-1 >= 12)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="dec_upside_<?php echo $i;?>" data-toggle="modal" data-target="#upside">Up-Side</span>
                              <span class="dropdown-item" id="dec_downside_<?php echo $i;?>" data-toggle="modal" data-target="#downside">Down-Side</span>
                              <div class="dropdown-divider"></div>
                              <span class="dropdown-item" id="informationSide_<?php echo $i;?>" data-toggle="modal" data-target="#informationSide" rel="dec_fcast_<?php echo $i;?>">Information</span>
                            </div> 
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upside[$key][12])?$upside[$key][12]:'';?></span><br/><span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][12])?$downside[$key][12]:'';?></span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            &nbsp;
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcast_<?php echo $i;?>" value="<?php echo isset($targetSales[$i])?$targetSales[$i]:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcast_<?php echo $i;?>" value="<?php echo isset($lastRollingForecast[$i])?$lastRollingForecast[$i]:0;?>"  readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalForecast_fcast'])?$tempTalDataEntry[$i-1]['totalForecast_fcast']:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['varient_fcast'])?$tempTalDataEntry[$i-1]['varient_fcast']:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['ytd_fcast'])?$tempTalDataEntry[$i-1]['ytd_fcast']:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">
                            <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['yearToGo_fcast'])?$tempTalDataEntry[$i-1]['yearToGo_fcast']:0;?>" style="color:<?php echo (isset($tempTalDataEntry[$i-1]['yearToGo_fcast']) && $tempTalDataEntry[$i-1]['yearToGo_fcast'] < 0)?'red;font-weight: bold;':'green;font-weight: bold;';?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcast_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['financialPlan_fcast'])?$tempTalDataEntry[$i-1]['financialPlan_fcast']:0;?>" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="6" style="padding-top:0px;"></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                          <level class="form-control"><?php echo strtoupper('focs');?></level>
                        </div><span style="font-size:12px;font-weight:bold;color:green;">Upside</span><br/><span style="font-size:12px;font-weight:bold;color:red;">Downside</span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jan_focs'])?$tempTalDataEntry[$i-1]['jan_focs']:0;?>" maxlength="8">
                        </div> <span style="font-size:12px;font-weight:600;color:green;">120</span><br/><span style="font-size:12px;font-weight:600;color:red;">130</span></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['feb_focs'])?$tempTalDataEntry[$i-1]['feb_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['mar_focs'])?$tempTalDataEntry[$i-1]['mar_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['apr_focs'])?$tempTalDataEntry[$i-1]['apr_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['may_focs'])?$tempTalDataEntry[$i-1]['may_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jun_focs'])?$tempTalDataEntry[$i-1]['jun_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jul_focs'])?$tempTalDataEntry[$i-1]['jul_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['aug_focs'])?$tempTalDataEntry[$i-1]['aug_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['sep_focs'])?$tempTalDataEntry[$i-1]['sep_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['oct_focs'])?$tempTalDataEntry[$i-1]['oct_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['nov_focs'])?$tempTalDataEntry[$i-1]['nov_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['dec_focs'])?$tempTalDataEntry[$i-1]['dec_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            &nbsp;
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalSalesTarget_focs'])?$tempTalDataEntry[$i-1]['totalSalesTarget_focs']:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['lastRollingForecast_focs'])?$tempTalDataEntry[$i-1]['lastRollingForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalForecast_focs'])?$tempTalDataEntry[$i-1]['totalForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['varient_focs'])?$tempTalDataEntry[$i-1]['varient_focs']:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['ytd_focs'])?$tempTalDataEntry[$i-1]['ytd_focs']:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['yearToGo_focs'])?$tempTalDataEntry[$i-1]['yearToGo_focs']:0;?>" readonly>
                        </div></td>
                        <td style="padding-top:0px;"><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focs_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['financialPlan_focs'])?$tempTalDataEntry[$i-1]['financialPlan_focs']:0;?>" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary">Submit</button></div>
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="nextYear">
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
            $previousMonth = date('m')-1;
            $fieldTALNameNextYear = '*';
            $conditionTALNextYear = ' customerWWID='.$_SESSION['customerName'].' AND year='.$dateVal[1];
            $talDataFromActualN = $specificMethod->fetchActualSalesRecordsByDateTime('jnj_actualsalesvalue', $fieldTALNameNextYear, $dateVal[1], $conditionTALNextYear);
            $talTempDataN = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', $fieldTALNameNextYear, $dateVal[1], $conditionTALNextYear);
            if (!empty($talDataFromActualN) && empty($talTempData)){
                $tempTalDataEntryNextYear = $talDataFromActualN;
                $readonly = 'readonly';
            } else {
                $tempTalDataEntryNextYear = $talTempDataN;
                $readonly = 'readonly';
            }
            $targetSalesN = $specificMethod->fetchTargetSales('jnj_totalSalesTarget', 'fftarget', $dateVal[1]);
            $lastRollingForecastN = $specificMethod->fetchLastRollingForecast('jnj_totalrollingforecast', 'rollingForecast', $dateVal[1], $previousMonth);
        ?>
        <div class="table-responsive" style="height:550px;">
        <form id="entryGridFormNextYear" name="entryGridFormNextYear" method="post">
            <table class="table table-striped" id="nextSampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="4" class="small">		                
                            <div class="btn-group dropright">		
                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="valueFromNFGSystem">Statical Forecast volume</button>		
                              <div class="dropdown-menu" style="position:fixed;">		
                                <a class="dropdown-item" href="#" >HGNC:1</a>		
                                <a class="dropdown-item" href="#">HGNC:2</a>		
                                <a class="dropdown-item" href="#">HGNC:3</a>		
                                <a class="dropdown-item" href="#">HGNC:4</a>		
                                <a class="dropdown-item" href="#">HGNC:5</a>		
                                <a class="dropdown-item" href="#">HGNC:6</a>		
                                <a class="dropdown-item" href="#">HGNC:7</a>		
                                <a class="dropdown-item" href="#">HGNC:8</a>		
                                <a class="dropdown-item" href="#">HGNC:9</a>  		
                              </div>		
                            </div>		
                        </th>
                        <th colspan="3">
                            <div class="btn-group dropright">
                                <form class="form-inline">
                                   <input class="form-control mr-sm-2" type="search" placeholder="Search by brand" aria-label="Search" style="width:180px;">
                                   <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </th>
                        <th colspan="13"><div id="errorMessage"></div></th>
                        <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
                        <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
                        <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
                        <th><div class="small col-8" style='width: 60px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>                        
                        <th><div class="small col-12" style='width: 130px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 170px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Forecast/FOCs</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Jan</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Feb</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Mar</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Apr</div></th>
                        <th><div class="small col-12" style='width: 80px;'>May</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Jun</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Jul</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Aug</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Sep</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Oct</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Nov</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Dec</div></th>
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
                  <?php 
                     $i = 0;
                     foreach($itemOne as $key => $val) {
                        $i = $i + 1;
                        $arrUpsideVal = ['upSidevalue', 'monthValue', 'itemId'];
                        $arrDownsideVal = ['downSidevalue', 'monthValue', 'itemId'];
                        $upsideN = $specificMethod->fetchUpsideVolume('jnj_upsidetable', $arrUpsideVal, $_SESSION['customerName'], $key, $dateVal[1]);
                        $downsideN = $specificMethod->fetchDownsideVolume('jnj_downsidetable', $arrDownsideVal, $_SESSION['customerName'], $key, $dateVal[1]);
                  ?>
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
                                <option value='0'>Select Type</option>
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
                            <level class="form-control"><?php echo $brandOne[$tempTalDataEntryNextYear[$i-1]['brandId']];?></level>
                            <input type="hidden" class="form-control" name="brand_<?php echo $i;?>" id="brandN_<?php echo $i;?>" value="<?php echo $tempTalDataEntryNextYear[$i-1]['brandId'];?>" readonly>
                            <?php } else { ?>
                            <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brandN_<?php echo $i;?>" value="<?php echo $brandOne[$brandOneNew[$key]];?>" readonly>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear[$i-1])) { ?>
                            <level class="form-control"><?php echo $itemOne[$tempTalDataEntryNextYear[$i-1]['itemId']];?></level>
                            <input type="hidden" class="form-control" name="item_<?php echo $i;?>" id="itemN_<?php echo $i;?>" value="<?php echo $tempTalDataEntryNextYear[$i-1]['itemId'];?>" readonly>
                            <?php } else { ?>
                            <input type="text" class="form-control" name="item_<?php echo $i;?>" id="itemN_<?php echo $i;?>" value="<?php echo $itemOne[$key]; ?>" readonly>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jan_fcast'])?$tempTalDataEntryNextYear[$i-1]['jan_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['jan_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['jan_fcast']) && date('m')-1 > 1)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <span class="dropdown-item" id="jan_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                                <span class="dropdown-item" id="jan_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                                <div class="dropdown-divider"></div>		
                                <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="jan_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                         </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][1])?$upsideN[$key][1]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][1])?$downsideN[$key][1]:0;?></span></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['feb_fcas'])?$tempTalDataEntryNextYear[$i-1]['feb_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['feb_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['feb_fcast'])&& date('m')-1 >= 2)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="feb_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="feb_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="feb_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][2])?$upsideN[$key][2]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][2])?$downsideN[$key][2]:0;?></span></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['mar_fcas'])?$tempTalDataEntryNextYear[$i-1]['mar_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['mar_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['mar_fcast'])&& date('m')-1 >= 3)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="mar_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="mar_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="mar_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][3])?$upsideN[$key][3]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][3])?$downsideN[$key][3]:0;?></span></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['apr_fcas'])?$tempTalDataEntryNextYear[$i-1]['apr_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['apr_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['apr_fcast'])&& date('m')-1 >= 4)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <span class="dropdown-item" id="apr_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                                <span class="dropdown-item" id="apr_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                                <div class="dropdown-divider"></div>		
                                <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="apr_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][4])?$upsideN[$key][4]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][4])?$downsideN[$key][4]:0;?></span></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['may_fcas'])?$tempTalDataEntryNextYear[$i-1]['may_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['may_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['may_fcast'])&& date('m')-1 >= 5)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="may_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="may_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="may_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][5])?$upsideN[$key][5]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][5])?$downsideN[$key][5]:0;?></span></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jun_fcas'])?$tempTalDataEntryNextYear[$i-1]['jun_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['jun_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['jun_fcast'])&& date('m')-1 >= 6)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="jun_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="jun_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="jun_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][6])?$upsideN[$key][6]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][6])?$downsideN[$key][6]:0;?></span></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jul_fcas'])?$tempTalDataEntryNextYear[$i-1]['jul_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['jul_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['jul_fcast'])&& date('m')-1 >= 7)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="jul_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="jul_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="jul_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][7])?$upsideN[$key][7]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][7])?$downsideN[$key][7]:0;?></span></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['aug_fcas'])?$tempTalDataEntryNextYear[$i-1]['aug_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['aug_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['aug_fcast'])&& date('m')-1 >= 8)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="aug_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="aug_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="aug_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][8])?$upsideN[$key][8]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][8])?$downsideN[$key][8]:0;?></span></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['sep_fcas'])?$tempTalDataEntryNextYear[$i-1]['sep_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['sep_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['sep_fcast'])&& date('m')-1 >= 9)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="sep_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="sep_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="sep_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][9])?$upsideN[$key][9]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downside[$key][9])?$downside[$key][9]:0;?></span></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['oct_fcas'])?$tempTalDataEntryNextYear[$i-1]['oct_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['oct_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['oct_fcast'])&& date('m')-1 >= 10)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="oct_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="oct_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="oct_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][10])?$upsideN[$key][10]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][10])?$downsideN[$key][10]:0;?></span></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['nov_fcas'])?$tempTalDataEntryNextYear[$i-1]['nov_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['nov_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['nov_fcast'])&& date('m')-1 >= 11)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="nov_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="nov_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="nov_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][11])?$upsideN[$key][11]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][11])?$downsideN[$key][11]:0;?></span></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['dec_fcas'])?$tempTalDataEntryNextYear[$i-1]['dec_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear[$i-1]['dec_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear[$i-1]['dec_fcast'])&& date('m')-1 >= 12)?'green;color: #fff;':'pink;';?>">&nbsp;<span class="nav-link dropdown-toggle" style="width:5px;height:5px;padding: 0rem 0rem;" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <span class="dropdown-item" id="dec_upsideN_<?php echo $i;?>" data-toggle="modal" data-target="#upsideN">Up-Side</span>		
                              <span class="dropdown-item" id="dec_downsideN_<?php echo $i;?>" data-toggle="modal" data-target="#downsideN">Down-Side</span>		
                              <div class="dropdown-divider"></div>		
                              <span class="dropdown-item" id="informationSideN_<?php echo $i;?>" data-toggle="modal" data-target="#informationSideN" rel="dec_fcastN_<?php echo $i;?>">Information</span>		
                            </div>		
                        </div><span style="font-size:12px;font-weight:600;color:green;" title="Upside"><?php echo isset($upsideN[$key][12])?$upsideN[$key][12]:0;?></span> |&nbsp;<span style="font-size:12px;font-weight:600;color:red;" title="Downside"><?php echo isset($downsideN[$key][12])?$downsideN[$key][12]:0;?></span></td>
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
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcastN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['financialPlan_fcast'])?$tempTalDataEntryNextYear[$i-1]['financialPlan_fcast']:0;?>" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <lable class="form-control"><?php echo strtoupper('focs');?></lable>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jan_focs'])?$tempTalDataEntryNextYear[$i-1]['jan_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['feb_focs'])?$tempTalDataEntryNextYear[$i-1]['feb_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['mar_focs'])?$tempTalDataEntryNextYear[$i-1]['mar_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['apr_focs'])?$tempTalDataEntryNextYear[$i-1]['apr_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['may_focs'])?$tempTalDataEntryNextYear[$i-1]['may_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jun_focs'])?$tempTalDataEntryNextYear[$i-1]['jun_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['jul_focs'])?$tempTalDataEntryNextYear[$i-1]['jul_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['aug_focs'])?$tempTalDataEntryNextYear[$i-1]['aug_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['sep_focs'])?$tempTalDataEntryNextYear[$i-1]['sep_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['oct_focs'])?$tempTalDataEntryNextYear[$i-1]['oct_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['nov_focs'])?$tempTalDataEntryNextYear[$i-1]['nov_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['dec_focs'])?$tempTalDataEntryNextYear[$i-1]['dec_focs']:0;?>" maxlength="8">
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
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focsN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear[$i-1]['financialPlan_focs'])?$tempTalDataEntryNextYear[$i-1]['financialPlan_focs']:0;?>" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridNextYear" name="btnEntryGridNextYear" class="btn btn-primary">Submit</button></div>
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="oneNextYear">
        <div class="btn-group float-right"> &nbsp; </div><br/><br/>
        <?php
            $previousMonth = date('m')-1;
            $fieldTALNameNextYear2 = '*';
            $conditionTALNextYear2 = ' customerWWID='.$_SESSION['customerName'].' AND year='.$dateVal[2];
            $talDataFromActualNN = $specificMethod->fetchActualSalesRecordsByDateTime('jnj_actualsalesvalue', $fieldTALNameNextYear2, $dateVal[2], $conditionTALNextYear2);
            $talTempDataNN = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', $fieldTALNameNextYear2, $dateVal[2], $conditionTALNextYear2);
            if (!empty($talDataFromActualNN)&& empty($talTempDataNN)){
                $tempTalDataEntryNextYear2 = $talDataFromActualNN;
                $readonly = 'readonly';
            } else {
                $tempTalDataEntryNextYear2 = $talTempDataNN;
                $readonly = 'readonly';
            }
        ?>
        <div class="table-responsive" style="height:550px;">
        <form id="entryGridFormOneNextYear" name="entryGridFormOneNextYear" method="post">
            <table class="table table-striped" id="nextOneSampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="3" class="small">
                        <div class="btn-group dropright">				
                              <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="valueFromNFGSystem">Statical Forecast volume</button>				
                              <div class="dropdown-menu" style="position:fixed;">				
                                <a class="dropdown-item" href="#" >HGNC:1</a>				
                                <a class="dropdown-item" href="#">HGNC:2</a>				
                                <a class="dropdown-item" href="#">HGNC:3</a>				
                                <a class="dropdown-item" href="#">HGNC:4</a>				
                                <a class="dropdown-item" href="#">HGNC:5</a>				
                                <a class="dropdown-item" href="#">HGNC:6</a>				
                                <a class="dropdown-item" href="#">HGNC:7</a>				
                                <a class="dropdown-item" href="#">HGNC:8</a>				
                                <a class="dropdown-item" href="#">HGNC:9</a>  				
                              </div>				
                            </div>				
                        </th>
                        <th colspan="3">
                            <div class="btn-group dropright">
                                <form class="form-inline">
                                   <input class="form-control mr-sm-2" type="search" placeholder="Search by brand" aria-label="Search" style="width:180px;">
                                   <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </th>
                        <th colspan="6"><div id="errorMessage"></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
                        <th><div class="small col-12" style='width: 30px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>                        
                        <th><div class="small col-12" style='width: 130px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 170px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 120px;'>Forecast/FOCs</div></th>
                        <th><div class="small col-12" style='width: 120px;'>Year - <?php echo $dateVal[2];?></div></th>
                        <th><div class="small col-12" style='width: 120px;'>Year - <?php echo $dateVal[3];?></div></th>
                        <th><div class="small col-12" style='width: 120px;'>Year - <?php echo $dateVal[4];?></div></th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    $i = 0;
                     foreach($itemOne as $key => $val) {
                        $i = $i + 1;
                        $arrUpsideValNN = ['upSidevalue', 'monthValue', 'itemId'];
                        $arrDownsideValNN = ['downSidevalue', 'monthValue', 'itemId'];
                        $upsideNN = $specificMethod->fetchUpsideVolume('jnj_upsidetable', $arrUpsideValNN, $_SESSION['customerName'], $key, $dateVal[2]);
                        $downsideNN = $specificMethod->fetchDownsideVolume('jnj_downsidetable', $arrDownsideValNN, $_SESSION['customerName'], $key, $dateVal[2]); 
                  ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="hidden" class="form-control" name="customerName_<?php echo $i;?>" id="customerNameNN_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="countryNN_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly style="width:20px;">
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
                            <lable class="form-control"><?php echo $brandOne[$tempTalDataEntryNextYear2[$i-1]['brandId']];?></lable>
                            <input type="hidden" class="form-control" name="brand_<?php echo $i;?>" id="brandNN_<?php echo $i;?>" value="<?php echo $tempTalDataEntryNextYear2[$i-1]['brandId'];?>" readonly style="width:50px;">
                            <?php } else { ?>
                            <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brandNN_<?php echo $i;?>" value="<?php echo $brandOne[$brandOneNew[$key]];?>" readonly style="width:50px;">
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntryNextYear2[$i-1])) { ?>
                            <lable class="form-control"><?php echo $itemOne[$tempTalDataEntryNextYear2[$i-1]['itemId']];?></lable>
                            <input type="hidden" class="form-control" name="item_<?php echo $i;?>" id="itemNN_<?php echo $i;?>" value="<?php echo $tempTalDataEntryNextYear2[$i-1]['itemId']; ?>" readonly style="width:120px;">
                            <?php } else { ?>
                            <input type="text" class="form-control" name="item_<?php echo $i;?>" id="itemNN_<?php echo $i;?>" value="<?php echo $itemOne[$key]; ?>" readonly style="width:120px;">
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <lable class="form-control"><?php echo strtoupper('forecast');?></lable>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                        <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['jan_fcast'])?$tempTalDataEntryNextYear2[$i-1]['jan_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear2[$i-1]['jan_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear2[$i-1]['jan_fcast']) && date('m')-1 > 1)?'green;color: #fff;':'pink;';?>">		
                        </div></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                        <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['feb_fcas'])?$tempTalDataEntryNextYear2[$i-1]['feb_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear2[$i-1]['feb_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear2[$i-1]['feb_fcast'])&& date('m')-1 >= 2)?'green;color: #fff;':'pink;';?>">		
                        </div></td>
                        
                        <td><div class="input-group input-group-sm mt-2">                
                        <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcastNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntryNextYear2[$i-1]['mar_fcas'])?$tempTalDataEntryNextYear2[$i-1]['mar_fcast']:0;?>" maxlength="8" <?php echo isset($tempTalDataEntryNextYear2[$i-1]['mar_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntryNextYear2[$i-1]['mar_fcast'])&& date('m')-1 >= 3)?'green;color: #fff;':'pink;';?>">		
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <lable class="form-control"><?php echo strtoupper('focs');?></lable>
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
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridOneNextYear" name="btnEntryGridOneNextYear" class="btn btn-primary">Submit</button></div>
            <!--div style="text-align:center;"><input type="submit" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary" value="Submit"></div-->
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="twoNextYear">
        <div style="padding-left: 20px; padding-top:10px;">
           <a href="#" id="previousYear" class="btn btn-outline-primary">Year - <?php echo ($dateVal[0]-1);?></a>
            <table class="table table-striped" style="font-family: calibri;" id="previousYearTable">
              <thead class="table table-secondary">
               <tr>
                   <th class="col-8" style="width:80px;">Material</th>
                   <th class="col-12" style="width:150px;">SKU</th>
                   <th class="col-8" style="width:50px;">Country Code</th>
                   <th class="col-8" style="width:60px;">Currency</th>
                   <th style="text-align:center" colspan="5">CIF</th>
                   <th style="text-align:center" colspan="5">TENDER PRICES</th>
                   <th style="text-align:center" colspan="4">Private Discounts</th>
               </tr>
               <tr class="table-primary">
                    <th class="small col-8" colspan="4"></th>
                    <th class="small col-8" style="border-left: 1px solid #dee2e6;"></th>
                    <th class="small col-8">Q1</th>
                    <th class="small col-8">Q2</th>
                    <th class="small col-8">Q3</th>
                    <th class="small col-8">Q4</th>
                    <th class="small col-8" style="border-left: 1px solid #dee2e6;"></th>
                    <th class="small col-8">Q1</th>
                    <th class="small col-8">Q2</th>
                    <th class="small col-8">Q3</th>
                    <th class="small col-8">Q4</th>
                    <th class="small col-8" style="border-right: 1px solid #dee2e6;"></th>
                    <th class="small col-8">Discounts</th>
                    <th class="small col-8">"FOCs"</th>
                    <th class="small col-8">Total Discounts</th>
                  </tr>
              </thead>
              <tbody>
              <?php
                 $previousYear = $dateVal[0]-1;
                 $pricingDataEntry = $specificMethod->fetchPricingDataEntry('jnj_pricing_dataentry', $_SESSION['customerName'], $previousYear);
                 if(!empty($pricingDataEntry)) {
                  foreach($pricingDataEntry as $key => $val) {
               ?>
                <tr>
                  <td><?php echo $val['material'];?></td>
                  <td><?php echo $val['SKU'];?></td>
                  <td><?php echo $val['countryCode'];?></td>
                  <td><?php echo $val['currency'];?></td>
                  <td style="border-left: 1px solid #dee2e6;"></td>
                  <td><?php echo $Q1 = ($val['cif_jan']+$val['cif_feb']+$val['cif_mar'])/3;?></td>
                  <td><?php echo $Q2 = ($val['cif_apr']+$val['cif_may']+$val['cif_jun'])/3;?></td>
                  <td><?php echo $Q3 = ($val['cif_jul']+$val['cif_aug']+$val['cif_sep'])/3;?></td>
                  <td><?php echo $Q4 = ($val['cif_oct']+$val['cif_nov']+$val['cif_dec'])/3;?></td>
                  <td style="border-left: 1px solid #dee2e6;"></td>
                  <td><?php echo $Q1 = ($val['tnd_jan']+$val['tnd_feb']+$val['tnd_mar'])/3;?></td>
                  <td><?php echo $Q2 = ($val['tnd_apr']+$val['tnd_may']+$val['tnd_jun'])/3;?></td>
                  <td><?php echo $Q3 = ($val['tnd_jul']+$val['tnd_aug']+$val['tnd_sep'])/3;?></td>
                  <td><?php echo $Q3 = ($val['tnd_oct']+$val['tnd_nov']+$val['tnd_dec'])/3;?></td>
                  <td style="border-left: 1px solid #dee2e6;"></td>
                  <td><?php echo $val['discounts'];?></td>
                  <td><?php echo $val['focs'];?></td>
                  <td><?php echo $val['totalDiscount'];?></td>
                </tr>
              <?php }
                 } else { ?>
               <tr><td colspan="18"> No records available !</td></tr>
              <?php } ?>
              </tbody>
            </table>
           <br/><br/>
           <a href="#" id="currentYearVal" class="btn btn-outline-primary">Year - <?php echo $dateVal[0];?></a>
            <table class="table table-striped" style="font-family: calibri;" id="currentYearTable">
              <thead class="table table-secondary">
               <tr>
                   <th class="col-8" style="width:80px;">Material</th>
                   <th class="col-12" style="width:150px;">SKU</th>
                   <th class="col-8" style="width:50px;">Country Code</th>
                   <th class="col-8" style="width:60px;">Currency</th>
                   <th style="text-align:center" colspan="5">CIF</th>
                   <th style="text-align:center" colspan="5">TENDER PRICES</th>
                   <th style="text-align:center" colspan="4">Private Discounts</th>
               </tr>
               <tr class="table-primary">
                    <th class="small col-8" colspan="4"></th>
                    <th class="small col-8" style="border-left: 1px solid #dee2e6;"></th>
                    <th class="small col-8">Q1</th>
                    <th class="small col-8">Q2</th>
                    <th class="small col-8">Q3</th>
                    <th class="small col-8">Q4</th>
                    <th class="small col-8" style="border-left: 1px solid #dee2e6;"></th>
                    <th class="small col-8">Q1</th>
                    <th class="small col-8">Q2</th>
                    <th class="small col-8">Q3</th>
                    <th class="small col-8">Q4</th>
                    <th class="small col-8" style="border-right: 1px solid #dee2e6;"></th>
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
                  <td style="border-left: 1px solid #dee2e6;"></td>
                  <td><?php echo $Q1 = ($val['cif_jan']+$val['cif_feb']+$val['cif_mar'])/3;?></td>
                  <td><?php echo $Q2 = ($val['cif_apr']+$val['cif_may']+$val['cif_jun'])/3;?></td>
                  <td><?php echo $Q3 = ($val['cif_jul']+$val['cif_aug']+$val['cif_sep'])/3;?></td>
                  <td><?php echo $Q4 = ($val['cif_oct']+$val['cif_nov']+$val['cif_dec'])/3;?></td>
                  <td style="border-left: 1px solid #dee2e6;"></td>
                  <td><?php echo $Q1 = ($val['tnd_jan']+$val['tnd_feb']+$val['tnd_mar'])/3;?></td>
                  <td><?php echo $Q2 = ($val['tnd_apr']+$val['tnd_may']+$val['tnd_jun'])/3;?></td>
                  <td><?php echo $Q3 = ($val['tnd_jul']+$val['tnd_aug']+$val['tnd_sep'])/3;?></td>
                  <td><?php echo $Q3 = ($val['tnd_oct']+$val['tnd_nov']+$val['tnd_dec'])/3;?></td>
                  <td style="border-left: 1px solid #dee2e6;"></td>
                  <td><?php echo $val['discounts'];?></td>
                  <td><?php echo $val['focs'];?></td>
                  <td><?php echo $val['totalDiscount'];?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
        </div><br/>
    </div>
    <div class="tab-pane fade" id="threeNextYear">
        <div class="btn-group float-right">	&nbsp; </div><br/><br/>
        <?php
            $previousMonth = date('m')-1;
            $fieldTALName = '*';
            $conditionTAL = ' customerWWID='.$_SESSION['customerName'].' AND year='.$dateVal[0];
            $talDataFromActual = $specificMethod->fetchActualSalesRecordsByDateTime('jnj_actualsalesvalue', $fieldTALName, date("Y"), $conditionTAL);
            $talTempData = $specificMethod->fetchMultipleRecordsByDateTimeMain('jnj_temp_tal_dataentry', $fieldTALName, date("Y"), $conditionTAL);
            if (!empty($talDataFromActual) && empty($talTempData)){
                $tempTalDataEntry = $talDataFromActual;
                $readonly = 'readonly';
            } else {
                $tempTalDataEntry = $talTempData;
                $readonly = 'readonly';
            }
            $targetSales = $specificMethod->fetchTargetSales('jnj_totalSalesTarget', 'fftarget', $dateVal[0]);
            $lastRollingForecast = $specificMethod->fetchLastRollingForecast('jnj_totalrollingforecast', 'rollingForecast', $dateVal[0], $previousMonth);
        ?>
        <div class="table-responsive" style="height:550px;">
        <form id="entryGridFormCurrent" name="entryGridFormCurrent" method="post">
            <table class="table table-striped" id="currentSampleTbl">
                <thead>
                    <tr class="table-dark">
                        <th colspan="3">
                            <div class="btn-group dropright">
                                <form class="form-inline">
                                   <input class="form-control mr-sm-2" type="search" placeholder="Search by brand" aria-label="Search" style="width:180px;">
                                   <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                </form>
                            </div>
                        </th>
                        <th colspan="17"><div id="errorMessage"></div></th>
                        <th colspan="2" style="text-align: center; color: black;"><div class="small"><strong>Auto Populated</strong></div></th>
                        <th colspan="4" style="text-align: center; color: black;"><div class="small"><strong>Calculated Field</strong></div></th>
                        <th><div class="small col-12" style='width: 150px; color: black;'><strong>Only CVTL</strong></div></th>
                    </tr>
                    <tr class="table-primary">
                        <th><div class="small col-4" style='width: 2px;'>&nbsp;</div></th>
                        <th><div class="small col-8" style='width: 60px;'>Country</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Type</div></th>
                        <th><div class="small col-12" style='width: 100px;'>Bus Selector</div></th>
                        <th><div class="small col-12" style='width: 130px;'>Brand</div></th>
                        <th><div class="small col-12" style='width: 170px;'>Item(SKU)</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Forecast/FOCs</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Jan</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Feb</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Mar</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Apr</div></th>
                        <th><div class="small col-12" style='width: 80px;'>May</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Jun</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Jul</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Aug</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Sep</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Oct</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Nov</div></th>
                        <th><div class="small col-12" style='width: 80px;'>Dec</div></th>
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
                  <?php 
                    $i = 0;
                     // foreach($tempTalDataEntry as $key => $val) {
                      // print_r($pricingDataEntry);
                      // $pricingDataEntryForReport = $specificMethod->fetchPricingDataEntry('jnj_pricing_dataentry', $_SESSION['customerName'], $dateVal[0]);
                      $tableNameForReport = ['jnj_item', 'jnj_registration'];
                      $itemOneForReport = $specificMethod->fetchItemsIrrespectiveCustomerForReport($tableNameForReport, $_SESSION['customerName']);
                      // print_r($itemOneForReport);
                      foreach($itemOneForReport as $key => $val) {
                        // echo $key .'=='. $val['Q1']."\n";
                        
                        $i = $i + 1;
                        $arrUpsideValNNNN = ['upSidevalue', 'monthValue', 'itemId'];
                        $arrDownsideValNNNN = ['downSidevalue', 'monthValue', 'itemId'];
                        $upsideNNNN = $specificMethod->fetchUpsideVolume('jnj_upsidetable', $arrUpsideValNNNN, $_SESSION['customerName'], $key, $dateVal[0]);
                        $downsideNNNN = $specificMethod->fetchDownsideVolume('jnj_downsidetable', $arrDownsideValNNNN, $_SESSION['customerName'], $key, $dateVal[0]);
                   ?>
                    <tr>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="hidden" class="form-control" name="customerName_<?php echo $i;?>" id="customerNameNNNN_<?php echo $i;?>" value="<?php echo $_SESSION['customerName'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">             
                            <input type="text" class="form-control" name="country_<?php echo $i;?>" id="countryNNNN_<?php echo $i;?>" value="<?php echo $country['countryCode'];?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                            
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                            <input type="text" class="form-control" name="type_<?php echo $i;?>" id="typeNNNN_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['type'];?>" readonly>
                            <?php } else { ?>
                            <select class="form-control form-control-inline" name="type_<?php echo $i;?>" id="typeNNNN_<?php echo $i;?>">
                                <option value='0'>Select Type</option>
                                <option value="Private" selected>Private</option>
                                <option value="Institution">Institution</option>
                                <option value="MOH">MOH</option>
                            </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                             <input type="text" class="form-control" name="busSelector_<?php echo $i;?>" id="busSelectorNNNN_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['busSelector'];?>" readonly>
                            <?php } else { ?>
                            <select name="busSelector_<?php echo $i;?>" id="busSelectorNNNN_<?php echo $i;?>" class="form-control form-control-inline">
                                <?php foreach($busSector as $val) { ?>
                                    <option value='<?php echo $val; ?>'><?php echo $val; ?></option>
                                <?php } ?>
                             </select>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                            <level class="form-control"><?php echo $brandOne[$tempTalDataEntry[$i-1]['brandId']];?></level>
                            <input type="hidden" class="form-control" name="brand_<?php echo $i;?>" id="brandNNNN_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['brandId'];?>" readonly>
                            <?php } else { ?>
                            <input type="text" class="form-control" name="brand_<?php echo $i;?>" id="brandNNNN_<?php echo $i;?>" value="<?php echo $brandOne[$brandOneNew[$key]];?>" readonly>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <?php if(!empty($tempTalDataEntry[$i-1])) { ?>
                            <level class="form-control"><?php echo $itemOne[$tempTalDataEntry[$i-1]['itemId']];?></level>
                            <input type="hidden" class="form-control" name="item_<?php echo $i;?>" id="itemNNNN_<?php echo $i;?>" value="<?php echo $tempTalDataEntry[$i-1]['itemId']; ?>" readonly>
                            <?php } else { ?>
                            <input type="text" class="form-control" name="item_<?php echo $i;?>" id="itemNNNN_<?php echo $i;?>" value="<?php echo $itemOne[$key]; ?>" readonly>
                            <?php } ?>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <lavel class="form-control"><?php echo strtoupper('forecast');?></lavel>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">
                            <input type="text" class="form-control" name="jan_fcast_<?php echo $i;?>" id="jan_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jan_fcast'])?$tempTalDataEntry[$i-1]['jan_fcast']:$talFcastFocsData[$i-1]['jan_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['jan_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['jan_fcast']) && date('m')-1 > 1)?'green;color: #fff;':'pink;';?>">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_fcast_<?php echo $i;?>" id="feb_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['feb_fcast'])?$tempTalDataEntry[$i-1]['feb_fcast']:$talFcastFocsData[$i-1]['feb_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['feb_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['feb_fcast'])&& date('m')-1 >= 2)?'green;color: #fff;':'pink;';?>">                            
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_fcast_<?php echo $i;?>" id="mar_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['mar_fcast'])?$tempTalDataEntry[$i-1]['mar_fcast']:$talFcastFocsData[$i-1]['mar_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['mar_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['mar_fcast'])&& date('m')-1 >= 3)?'green;color: #fff;':'pink;';?>"> 
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_fcast_<?php echo $i;?>" id="apr_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['apr_fcast'])?$tempTalDataEntry[$i-1]['apr_fcast']:$talFcastFocsData[$i-1]['apr_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['apr_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['apr_fcast'])&& date('m')-1 >= 4)?'green;color: #fff;':'pink;';?>">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_fcast_<?php echo $i;?>" id="may_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['may_fcast'])?$tempTalDataEntry[$i-1]['may_fcast']:$talFcastFocsData[$i-1]['may_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['may_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['may_fcast'])&& date('m')-1 >= 5)?'green;color: #fff;':'pink;color: #fff;';?>">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_fcast_<?php echo $i;?>" id="jun_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jun_fcast'])?$tempTalDataEntry[$i-1]['jun_fcast']:$talFcastFocsData[$i-1]['jun_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['jun_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['jun_fcast'])&& date('m')-1 >= 6)?'green;color: #fff;':'pink;';?>">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_fcast_<?php echo $i;?>" id="jul_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jul_fcast'])?$tempTalDataEntry[$i-1]['jul_fcast']:$talFcastFocsData[$i-1]['jul_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['jul_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['jul_fcast'])&& date('m')-1 >= 7)?'green;color: #fff;':'pink;';?>">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_fcast_<?php echo $i;?>" id="aug_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['aug_fcast'])?$tempTalDataEntry[$i-1]['aug_fcast']:$talFcastFocsData[$i-1]['aug_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['aug_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['aug_fcast'])&& date('m')-1 >= 8)?'green;color: #fff;':'pink;';?>">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_fcast_<?php echo $i;?>" id="sep_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['sep_fcast'])?$tempTalDataEntry[$i-1]['sep_fcast']:$talFcastFocsData[$i-1]['sep_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['sep_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['sep_fcast'])&& date('m')-1 >= 9)?'green;color: #fff;':'pink;';?>">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_fcast_<?php echo $i;?>" id="oct_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['oct_fcast'])?$tempTalDataEntry[$i-1]['oct_fcast']:$talFcastFocsData[$i-1]['oct_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['oct_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['oct_fcast'])&& date('m')-1 >= 10)?'green;color: #fff;':'pink;';?>"> 
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_fcast_<?php echo $i;?>" id="nov_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['nov_fcast'])?$tempTalDataEntry[$i-1]['nov_fcast']:$talFcastFocsData[$i-1]['nov_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['nov_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['nov_fcast'])&& date('m')-1 >= 11)?'green;color: #fff;':'pink;';?>">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_fcast_<?php echo $i;?>" id="dec_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['dec_fcast'])?$tempTalDataEntry[$i-1]['dec_fcast']:$talFcastFocsData[$i-1]['dec_fcast'];?>" maxlength="8" <?php echo isset($tempTalDataEntry[$i-1]['dec_fcast'])?$readonly:'';?> style="background:<?php echo (isset($tempTalDataEntry[$i-1]['dec_fcast'])&& date('m')-1 >= 12)?'green;color: #fff;':'pink;';?>">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            &nbsp;
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalSalesTarget_fcast_<?php echo $i;?>" id="totalSalesTarget_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($targetSales[$i])?$targetSales[$i]:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_fcast_<?php echo $i;?>" id="lastRollingForecast_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($lastRollingForecast[$i])?$lastRollingForecast[$i]:0;?>"  readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_fcast_<?php echo $i;?>" id="totalForecast_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalForecast_fcast'])?$tempTalDataEntry[$i-1]['totalForecast_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_fcast_<?php echo $i;?>" id="varient_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['varient_fcast'])?$tempTalDataEntry[$i-1]['varient_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_fcast_<?php echo $i;?>" id="ytd_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['ytd_fcast'])?$tempTalDataEntry[$i-1]['ytd_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_fcast_<?php echo $i;?>" id="yearToGo_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['yearToGo_fcast'])?$tempTalDataEntry[$i-1]['yearToGo_fcast']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_fcast_<?php echo $i;?>" id="financialPlan_fcastNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['financialPlan_fcast'])?$tempTalDataEntry[$i-1]['financialPlan_fcast']:0;?>" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                    <!--tr>
                        <td colspan="6"></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <level class="form-control"><?php echo strtoupper('focs');?></level>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jan_focs'])?$tempTalDataEntry[$i-1]['jan_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['feb_focs'])?$tempTalDataEntry[$i-1]['feb_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['mar_focs'])?$tempTalDataEntry[$i-1]['mar_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['apr_focs'])?$tempTalDataEntry[$i-1]['apr_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['may_focs'])?$tempTalDataEntry[$i-1]['may_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jun_focs'])?$tempTalDataEntry[$i-1]['jun_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jul_focs'])?$tempTalDataEntry[$i-1]['jul_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['aug_focs'])?$tempTalDataEntry[$i-1]['aug_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['sep_focs'])?$tempTalDataEntry[$i-1]['sep_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['oct_focs'])?$tempTalDataEntry[$i-1]['oct_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['nov_focs'])?$tempTalDataEntry[$i-1]['nov_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['dec_focs'])?$tempTalDataEntry[$i-1]['dec_focs']:0;?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            &nbsp;
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalSalesTarget_focs'])?$tempTalDataEntry[$i-1]['totalSalesTarget_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['lastRollingForecast_focs'])?$tempTalDataEntry[$i-1]['lastRollingForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalForecast_focs'])?$tempTalDataEntry[$i-1]['totalForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['varient_focs'])?$tempTalDataEntry[$i-1]['varient_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['ytd_focs'])?$tempTalDataEntry[$i-1]['ytd_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['yearToGo_focs'])?$tempTalDataEntry[$i-1]['yearToGo_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_focsNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['financialPlan_focs'])?$tempTalDataEntry[$i-1]['financialPlan_focs']:0;?>" <?php echo $readonly;?>>
                        </div></td>
                    </tr-->
                    <tr>
                        <td colspan="6"></td>
                        <td><div class="input-group input-group-sm mt-2">                
                          <level class="form-control"><?php echo strtoupper('Values');?></level>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jan_focs_<?php echo $i;?>" id="jan_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jan_fcast'])?($tempTalDataEntry[$i-1]['jan_fcast']*$val['Q1']):($talFcastFocsData[$i-1]['jan_fcast']*$val['Q1']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="feb_focs_<?php echo $i;?>" id="feb_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['feb_fcast'])?($tempTalDataEntry[$i-1]['feb_fcast']*$val['Q1']):($talFcastFocsData[$i-1]['feb_fcast']*$val['Q1']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="mar_focs_<?php echo $i;?>" id="mar_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['mar_fcast'])?($tempTalDataEntry[$i-1]['mar_fcast']*$val['Q1']):($talFcastFocsData[$i-1]['mar_fcast']*$val['Q1']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="apr_focs_<?php echo $i;?>" id="apr_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['apr_fcast'])?($tempTalDataEntry[$i-1]['apr_fcast']*$val['Q2']):($talFcastFocsData[$i-1]['apr_fcast']*$val['Q2']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="may_focs_<?php echo $i;?>" id="may_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['may_fcast'])?($tempTalDataEntry[$i-1]['may_fcast']*$val['Q2']):($talFcastFocsData[$i-1]['may_fcast']*$val['Q2']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jun_focs_<?php echo $i;?>" id="jun_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jun_fcast'])?($tempTalDataEntry[$i-1]['jun_fcast']*$val['Q2']):($talFcastFocsData[$i-1]['jun_fcast']*$val['Q2']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="jul_focs_<?php echo $i;?>" id="jul_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['jul_fcast'])?($tempTalDataEntry[$i-1]['jul_fcast']*$val['Q3']):($talFcastFocsData[$i-1]['jul_fcast']*$val['Q3']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="aug_focs_<?php echo $i;?>" id="aug_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['aug_fcast'])?($tempTalDataEntry[$i-1]['aug_fcast']*$val['Q3']):($talFcastFocsData[$i-1]['aug_fcast']*$val['Q3']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="sep_focs_<?php echo $i;?>" id="sep_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['sep_fcast'])?($tempTalDataEntry[$i-1]['sep_fcast']*$val['Q3']):($talFcastFocsData[$i-1]['sep_fcast']*$val['Q3']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="oct_focs_<?php echo $i;?>" id="oct_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['oct_fcast'])?($tempTalDataEntry[$i-1]['oct_fcast']*$val['Q4']):($talFcastFocsData[$i-1]['oct_fcast']*$val['Q4']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="nov_focs_<?php echo $i;?>" id="nov_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['nov_fcast'])?($tempTalDataEntry[$i-1]['nov_fcast']*$val['Q4']):($talFcastFocsData[$i-1]['nov_fcast']*$val['Q4']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="dec_focs_<?php echo $i;?>" id="dec_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['dec_fcast'])?($tempTalDataEntry[$i-1]['dec_fcast']*$val['Q4']):($talFcastFocsData[$i-1]['dec_fcast']*$val['Q4']);?>" maxlength="8">
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            &nbsp;
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalSalesTarget_focs_<?php echo $i;?>" id="totalSalesTarget_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalSalesTarget_focs'])?$tempTalDataEntry[$i-1]['totalSalesTarget_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="lastRollingForecast_focs_<?php echo $i;?>" id="lastRollingForecast_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['lastRollingForecast_focs'])?$tempTalDataEntry[$i-1]['lastRollingForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="totalForecast_focs_<?php echo $i;?>" id="totalForecast_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['totalForecast_focs'])?$tempTalDataEntry[$i-1]['totalForecast_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="varient_focs_<?php echo $i;?>" id="varient_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['varient_focs'])?$tempTalDataEntry[$i-1]['varient_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="ytd_focs_<?php echo $i;?>" id="ytd_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['ytd_focs'])?$tempTalDataEntry[$i-1]['ytd_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="yearToGo_focs_<?php echo $i;?>" id="yearToGo_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['yearToGo_focs'])?$tempTalDataEntry[$i-1]['yearToGo_focs']:0;?>" readonly>
                        </div></td>
                        <td><div class="input-group input-group-sm mt-2">                
                            <input type="text" class="form-control" name="financialPlan_focs_<?php echo $i;?>" id="financialPlan_valueNNNN_<?php echo $i;?>" value="<?php echo isset($tempTalDataEntry[$i-1]['financialPlan_focs'])?$tempTalDataEntry[$i-1]['financialPlan_focs']:0;?>" <?php echo $readonly;?>>
                        </div></td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
            <div style="text-align:center;"><button type="button" id="btnEntryGridCurrent" name="btnEntryGridCurrent" class="btn btn-primary">Submit</button></div>
        </form>
        </div>
    </div>
</div>
<!------------------ Model Box:: Start ---->
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

    <div class="modal fade" id="upside" role="dialog">
        <div class="modal-dialog" role="document" style="width:300px;">
         <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Up-Side</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span id="itemValueWithIdUpside" style="display:none;"></span>
            <span id="inputType"></span>
            <input type="hidden" name="customerWWID" id="customerWWID" value="<?php echo $_SESSION['customerName']; ?>" >
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveUpside">Save</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="upsideN" role="dialog">
        <div class="modal-dialog" role="document" style="width:300px;">
         <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Up-Side</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <span id="itemValueWithIdUpsideN" style="display:none;"></span>
            <span id="inputTypeN"></span>
            <input type="hidden" name="customerWWID" id="customerWWIDN" value="<?php echo $_SESSION['customerName']; ?>" >
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveUpsideN">Save</button>
          </div>
        </div>
      </div>
    </div>
<div class="modal fade" id="downside" role="dialog">
    <div class="modal-dialog" role="document" style="width:300px;">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Down-Side</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="itemValueWithIdDownside" style="display:none;"></span>
        <span id="inputTypeDown"></span>
        <input type="hidden" name="customerWWID" id="customerWWID" value="<?php echo $_SESSION['customerName']; ?>" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveDownside" <?php echo date('m');?>>Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="informationSide" role="dialog">
    <div class="modal-dialog" role="document" style="width:600px;">
     <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="itemValueWithIdInformationside"></span>
        <table>
          <thead>
            <tr class="table-primary">
                <th><div class="small col-8" style='width: 60px;'>Status Type</div></th>
                <th><div class="small col-8" style='width: 60px;'>Tander Type</div></th>
                <th><div class="small col-8" style='width: 60px;'>Tander Risk %</div></th>
                <th><div class="small col-8" style='width: 60px;'>Comments</div></th>
            </tr>  
          </thead>
          <tbody>
            <tr>
                <td><div class="input-group input-group-sm mt-2">
                <select class="form-control form-control-inline" name="status" id="status">
                    <option value='NA'>Select Status</option>
                    <option value="Private" selected>Based</option>
                    <option value="Institution">Downside</option>
                    <option value="MOH">Upside</option>
                </select></div></td>
                <td><div class="input-group input-group-sm mt-2">
                <select class="form-control form-control-inline" name="tenderType" id="tendarType">
                    <option value='NA'>Select Tender Type</option>
                    <option value="Private" selected>Confirmed</option>
                    <option value="Institution">Non Confirmed</option>
                    <option value="MOH">MOH</option>
                </select></div></td>
                <td><div class="input-group input-group-sm mt-2"><input type="text" class="form-control" name="tanderRisk" id="tanderRisk" value=""></div></td>
                <td><div class="input-group input-group-sm mt-2"><input type="text" class="form-control" name="comments" id="comments" value=""></div></td>
            </tr>  
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<!------------------ Model Box:: End ---->

<script type="text/javascript" src="javascript/fieldValidatorForTAL.js"></script>
<script>
    var monthArr = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
    var iterrateArrOne = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,	32,	33,	34,	35,	36,	37,	38,	39,	40,	41,	42,	43,	44,	45,	46,	47,	48,	49,	50,	51,	52,	53,	54,	55,	56,	57,	58,	59,	60,	61,	62,	63,	64,	65,	66,	67,	68,	69,	70,	71,	72,	73,	74,	75,	76,	77,	78,	79,	80,	81,	82,	83,	84,	85,	86,	87,	88,	89,	90,	91,	92,	93,	94,	95,	96,	97,	98,	99,	100];
    var iterrateArr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31,	32,	33,	34,	35,	36,	37,	38,	39,	40,	41,	42,	43,	44,	45,	46,	47,	48,	49,	50,	51,	52,	53,	54,	55,	56,	57,	58,	59,	60,	61,	62,	63,	64,	65,	66,	67,	68,	69,	70,	71,	72,	73,	74,	75,	76,	77,	78,	79,	80,	81,	82,	83,	84,	85,	86,	87,	88,	89,	90,	91,	92,	93,	94,	95,	96,	97,	98,	99,	100];
    $(document).ready(function(){ 
        $("#myTab a:first").tab('show'); // show last tab on page load
        $('#mychartOne').hide();
        $('[data-toggle="tooltip"]').tooltip({
            title: "Searcch by customer number or country name or item. <br/> You can also use three criteria togather using colum saparator.",
            html: true
        });
        $('#previousYearTable').hide();
        $('#currentYearTable').hide();
        // console.log($(window).height()); check the hight
        let forecastVol = $("#entryGridFormCurrent").serializeArray();
         calLastRollingForecastVolume(forecastVol, <?php echo $_SESSION['customerName'];?>, <?php echo $_SESSION['countryName'];?>);
         calForecastVolume(forecastVol, <?php echo $_SESSION['customerName'];?>, <?php echo $_SESSION['countryName'];?>);
        iterrateArrOne.map(function(i){

          //current year dashboard :: start            
            var addFcast = parseFloat($('#jan_fcast_'+i+'').val()) + parseFloat($('#feb_fcast_'+i+'').val()) + parseFloat($('#mar_fcast_'+i+'').val()) + parseFloat($('#apr_fcast_'+i+'').val()) + parseFloat($('#may_fcast_'+i+'').val()) + parseFloat($('#jun_fcast_'+i+'').val()) + parseFloat($('#jul_fcast_'+i+'').val()) + parseFloat($('#aug_fcast_'+i+'').val()) + parseFloat($('#sep_fcast_'+i+'').val()) + parseFloat($('#oct_fcast_'+i+'').val()) + parseFloat($('#nov_fcast_'+i+'').val()) + parseFloat($('#dec_fcast_'+i+'').val());
            $('#totalForecast_fcast_'+i+'').val(addFcast);
            let LRF = $('#lastRollingForecast_fcast_'+i+'').val();
            let varientVolume = addFcast - $('#lastRollingForecast_fcast_'+i+'').val();
             $('#varient_fcast_'+i+'').val(varientVolume);
             $('#ytd_fcast_'+i+'').val(addFcast); //'sum of approve month forecast'
             $('#yearToGo_fcast_'+i+'').val($('#totalSalesTarget_fcast_'+i+'').val() - $('#ytd_fcast_'+i+'').val());
             if($('#yearToGo_fcast_'+i+'').val() < 0) {
                $('#yearToGo_fcast_'+i+'').css({ "color":'red', "font-weigth":'bold' })
             }

            /*This line of code for focs*/
             var addFocs = parseFloat($('#jan_focs_'+i+'').val()) + parseFloat($('#feb_focs_'+i+'').val()) + parseFloat($('#mar_focs_'+i+'').val()) + parseFloat($('#apr_focs_'+i+'').val()) + parseFloat($('#may_focs_'+i+'').val()) + parseFloat($('#jun_focs_'+i+'').val()) + parseFloat($('#jul_focs_'+i+'').val()) + parseFloat($('#aug_focs_'+i+'').val()) + parseFloat($('#sep_focs_'+i+'').val()) + parseFloat($('#oct_focs_'+i+'').val()) + parseFloat($('#nov_focs_'+i+'').val()) + parseFloat($('#dec_focs_'+i+'').val());
             $('#totalForecast_focs_'+i+'').val(addFocs);
             let varientVolumeFocs = (addFocs - parseFloat($('#lastRollingForecast_focs_'+i+'').val()));
                $('#varient_focs_'+i+'').val(varientVolumeFocs);
             $('#ytd_focs_'+i+'').val(addFocs); //'sum of approve month focs'     
             $('#yearToGo_focs_'+i+'').val(parseFloat($('#totalSalesTarget_focs_'+i+'').val() - $('#ytd_focs_'+i+'').val()));
           //current year dashboard :: End
        });
    });    
    iterrateArr.map(function(i){
        
/*Start:: Current Year Form ----------------------------------------------------*/
        $('#item_'+i).change(function(){
            $.when( $.post('router.php', {page: 'brandDropDown', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}) )
                .then( function(data) { $('#brand_'+i).html(data); });
            $.when ( $.post('router.php', {page: 'lastRollingForecast', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}))
                .then( function(data) { $('#lastRollingForecast_fcast_'+i).val(data); } );
        });
        $('#brand_'+i).change(function(){
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
        $('#jan_fcast_'+i+', #feb_fcast_'+i+', #mar_fcast_'+i+', #apr_fcast_'+i+', #may_fcast_'+i+', #jun_fcast_'+i+', #jul_fcast_'+i+', #aug_fcast_'+i+', #sep_fcast_'+i+', #oct_fcast_'+i+', #nov_fcast_'+i+', #dec_fcast_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_fcast_'+i+'').val()) + parseFloat($('#feb_fcast_'+i+'').val()) + parseFloat($('#mar_fcast_'+i+'').val()) + parseFloat($('#apr_fcast_'+i+'').val()) + parseFloat($('#may_fcast_'+i+'').val()) + parseFloat($('#jun_fcast_'+i+'').val()) + parseFloat($('#jul_fcast_'+i+'').val()) + parseFloat($('#aug_fcast_'+i+'').val()) + parseFloat($('#sep_fcast_'+i+'').val()) + parseFloat($('#oct_fcast_'+i+'').val()) + parseFloat($('#nov_fcast_'+i+'').val()) + parseFloat($('#dec_fcast_'+i+'').val());
            $('#totalForecast_fcast_'+i+'').val(add);
            let varientVolume = (add - parseFloat($('#lastRollingForecast_fcast_'+i+'').val()));
            $('#varient_fcast_'+i+'').val(varientVolume);
         });
         $('#ytd_fcast_'+i+'').val(0); //'sum of approve month forecast'
         $('#yearToGo_fcast_'+i+'').val(parseFloat($('#totalSalesTarget_fcast_'+i+'').val() - $('#ytd_fcast_'+i+'').val()));
        
        /*This line of code for focs*/
         $('#jan_focs_'+i+', #feb_focs_'+i+', #mar_focs_'+i+', #apr_focs_'+i+', #may_focs_'+i+', #jun_focs_'+i+', #jul_focs_'+i+', #aug_focs_'+i+', #sep_focs_'+i+', #oct_focs_'+i+', #nov_focs_'+i+', #dec_focs_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_focs_'+i+'').val()) + parseFloat($('#feb_focs_'+i+'').val()) + parseFloat($('#mar_focs_'+i+'').val()) + parseFloat($('#apr_focs_'+i+'').val()) + parseFloat($('#may_focs_'+i+'').val()) + parseFloat($('#jun_focs_'+i+'').val()) + parseFloat($('#jul_focs_'+i+'').val()) + parseFloat($('#aug_focs_'+i+'').val()) + parseFloat($('#sep_focs_'+i+'').val()) + parseFloat($('#oct_focs_'+i+'').val()) + parseFloat($('#nov_focs_'+i+'').val()) + parseFloat($('#dec_focs_'+i+'').val());
            $('#totalForecast_focs_'+i+'').val(add);
            let varientVolumeFocs = (add - parseFloat($('#lastRollingForecast_focs_'+i+'').val()));
            $('#varient_focs_'+i+'').val(varientVolumeFocs); 
         });
         $('#ytd_focs_'+i+'').val(0); //'sum of approve month focs'
         $('#yearToGo_focs_'+i+'').val(parseFloat($('#totalSalesTarget_focs_'+i+'').val() - $('#ytd_focs_'+i+'').val()));
//--------------- JavaScript Model::01
         $('#jan_upside_'+i+', #feb_upside_'+i+', #mar_upside_'+i+', #apr_upside_'+i+', #may_upside_'+i+', #jun_upside_'+i+', #jul_upside_'+i+', #aug_upside_'+i+', #sep_upside_'+i+', #oct_upside_'+i+', #nov_upside_'+i+', #dec_upside_'+i+'').click(function(){
            $('#itemValueWithIdUpside').html('{"itemId" :'+$('#item_'+i).val()+', "Months" :"'+$(this).attr('id').split('_')[0]+'", "customerWWID" :'+$('#customerWWID').val()+'}');
            $('#inputType').html('<input type="text" name="upside_'+i+'" id="upside_'+i+'" value="0" maxlength="8">')
         });
         $('#jan_downside_'+i+', #feb_downside_'+i+', #mar_downside_'+i+', #apr_downside_'+i+', #may_downside_'+i+', #jun_downside_'+i+', #jul_downside_'+i+', #aug_downside_'+i+', #sep_downside_'+i+', #oct_downside_'+i+', #nov_downside_'+i+', #dec_downside_'+i+'').click(function(){
            $('#itemValueWithIdDownside').html('{"itemId" :'+$('#item_'+i).val()+', "Months" :"'+$(this).attr('id').split('_')[0]+'", "customerWWID" :'+$('#customerWWID').val()+'}');
            $('#inputTypeDown').html('<input type="text" name="downside_'+i+'" id="downside_'+i+'" value="0" maxlength="8">')
         });         
         $('#informationSide_'+i+'').click(function(){
            console.log($(this));
            $('#itemValueWithIdInformationside').html('Item Id :-'+$('#item_'+i).val()+'<br/>');
         });
         $('#saveUpside').click(function(){
            let upsideValue = $('#upside_'+i).val();
             console.log(upsideValue);
            if(upsideValue !== undefined) {
              let arrayDataUpside = $('#itemValueWithIdUpside').text();
              $.post('router.php', {page: 'upsideValue', arrayData: arrayDataUpside, upside: upsideValue, years: <?php echo date('Y');?> }, function(data) {
                 if(data) {
                    alert('Sucessfully saved.');
                    $('#upside_'+i).val('');
                    $('#upside').hide();
                    location.reload();
                    console.log("Current: "+data);
                 }
              });
            }
         });
         $('#saveDownside').click(function(){
            let downsideValue = $('#downside_'+i).val();
            if(downsideValue !== undefined) {
              let arrayDataUpside = $('#itemValueWithIdDownside').text();
              console.log(arrayDataUpside);
              $.post('router.php', {page: 'downsideValue', arrayData: arrayDataUpside, downside: downsideValue, years: <?php echo date('Y');?>}, function(data) {
                 if(data) {
                    alert('Sucessfully saved.');
                    $('#downside_'+i).val('');
                    $('#downside_').hide();
                    location.reload();
                    // console.log(data);
                 }
              });
            }
         });
/*End:: Current Year Form ------------------------------------------------------------------*/
     
/*Start:: Next Year Form -------------------------------------------------------------------*/
        $('#itemN_'+i).change(function(){
            $.when( $.post('router.php', {page: 'brandDropDown', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}) )
                .then( function(data) { $('#brandN_'+i).html(data); });
            $.when ( $.post('router.php', {page: 'lastRollingForecast', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}))
                .then( function(data) { $('#lastRollingForecast_fcastN_'+i).val(data); } );
        });
        $('#brandN_'+i).change(function(){
             let itemId = $('#itemN_'+i).val();
             $.post('router.php', {page: 'totalSalesTarget', arrayData: itemId, otherdata: {customerName: '<?php echo $_SESSION['customerName'];?>', countryId: <?php echo $_SESSION['countryName'];?>} }, function(data) {
                if(data!=="")
                   var dataValue = data;
                 else
                   var dataValue = 0;
                $('#totalSalesTarget_fcastN_'+i).val(dataValue);
             });                     
        });
        $('#jan_fcastN_'+i+', #feb_fcastN_'+i+', #mar_fcastN_'+i+', #apr_fcastN_'+i+', #may_fcastN_'+i+', #jun_fcastN_'+i+', #jul_fcastN_'+i+', #aug_fcastN_'+i+', #sep_fcastN_'+i+', #oct_fcastN_'+i+', #nov_fcastN_'+i+', #dec_fcastN_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_fcastN_'+i+'').val()) + parseFloat($('#feb_fcastN_'+i+'').val()) + parseFloat($('#mar_fcastN_'+i+'').val()) + parseFloat($('#apr_fcastN_'+i+'').val()) + parseFloat($('#may_fcastN_'+i+'').val()) + parseFloat($('#jun_fcastN_'+i+'').val()) + parseFloat($('#jul_fcastN_'+i+'').val()) + parseFloat($('#aug_fcastN_'+i+'').val()) + parseFloat($('#sep_fcastN_'+i+'').val()) + parseFloat($('#oct_fcastN_'+i+'').val()) + parseFloat($('#nov_fcastN_'+i+'').val()) + parseFloat($('#dec_fcastN_'+i+'').val());
            $('#totalForecast_fcastN_'+i+'').val(add);
            let varientVolume = (add - parseFloat($('#lastRollingForecast_fcastN_'+i+'').val())).toFixed(2)
            $('#varient_fcastN_'+i+'').val(varientVolume);
         });
         $('#ytd_fcastN_'+i+'').val(0); //'sum of approve month forecast'
         $('#yearToGo_fcastN_'+i+'').val(parseFloat($('#totalSalesTarget_fcastN_'+i+'').val() - $('#ytd_fcastN_'+i+'').val()));
        
        /*This line of code for focs*/
         $('#jan_focsN_'+i+', #feb_focsN_'+i+', #mar_focsN_'+i+', #apr_focsN_'+i+', #may_focsN_'+i+', #jun_focsN_'+i+', #jul_focsN_'+i+', #aug_focsN_'+i+', #sep_focsN_'+i+', #oct_focsN_'+i+', #nov_focsN_'+i+', #dec_focsN_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_focsN_'+i+'').val()) + parseFloat($('#feb_focsN_'+i+'').val()) + parseFloat($('#mar_focsN_'+i+'').val()) + parseFloat($('#apr_focsN_'+i+'').val()) + parseFloat($('#may_focsN_'+i+'').val()) + parseFloat($('#jun_focsN_'+i+'').val()) + parseFloat($('#jul_focsN_'+i+'').val()) + parseFloat($('#aug_focsN_'+i+'').val()) + parseFloat($('#sep_focsN_'+i+'').val()) + parseFloat($('#oct_focsN_'+i+'').val()) + parseFloat($('#nov_focsN_'+i+'').val()) + parseFloat($('#dec_focsN_'+i+'').val());
            $('#totalForecast_focsN_'+i+'').val(add);
            let varientVolumeFocs = (add - parseFloat($('#lastRollingForecast_focsN_'+i+'').val())).toFixed(2);
            $('#varient_focsN_'+i+'').val(varientVolumeFocs); 
         });
         $('#ytd_focsN_'+i+'').val(0); //'sum of approve month focs'     
         $('#yearToGo_focsN_'+i+'').val(parseFloat($('#totalSalesTarget_focsN_'+i+'').val() - $('#ytd_focsN_'+i+'').val()));
//--------------- JavaScript Model::02
         $('#jan_upsideN_'+i+', #feb_upsideN_'+i+', #mar_upsideN_'+i+', #apr_upsideN_'+i+', #may_upsideN_'+i+', #jun_upsideN_'+i+', #jul_upsideN_'+i+', #aug_upsideN_'+i+', #sep_upsideN_'+i+', #oct_upsideN_'+i+', #nov_upsideN_'+i+', #dec_upsideN_'+i+'').click(function(){
            console.log("N");
            $('#itemValueWithIdUpsideN').html('{"itemId" :'+$('#itemN_'+i).val()+', "Months" :"'+$(this).attr('id').split('_')[0]+'", "customerWWID" :'+$('#customerWWIDN').val()+'}');
            $('#inputTypeN').html('<input type="text" name="upside_'+i+'" id="upsideN_'+i+'" value="0" maxlength="8">')
         });
         $('#jan_downsideN_'+i+', #feb_downsideN_'+i+', #mar_downsideN_'+i+', #apr_downsideN_'+i+', #may_downsideN_'+i+', #jun_downsideN_'+i+', #jul_downsideN_'+i+', #aug_downsideN_'+i+', #sep_downsideN_'+i+', #oct_downsideN_'+i+', #nov_downsideN_'+i+', #dec_downsideN_'+i+'').click(function(){
            $('#itemValueWithIdDownsideN').html('{"itemId" :'+$('#itemN_'+i).val()+', "Months" :"'+$(this).attr('id').split('_')[0]+'", "customerWWID" :'+$('#customerWWIDN').val()+'}');
            $('#inputTypeDownN').html('<input type="text" name="downside_'+i+'" id="downsideN_'+i+'" value="0" maxlength="8">')
         });         
         $('#informationSideN_'+i+'').click(function(){
            $('#itemValueWithIdInformationsideN').html('Item Id :-'+$('#item_'+i).val()+'<br/>');
         });
         $('#saveUpsideN').click(function(){
            let upsideValue = $('#upsideN_'+i).val();
            if(upsideValue !== undefined) {
              let arrayDataUpside = $('#itemValueWithIdUpsideN').text();
              console.log(arrayDataUpside);
              $.post('router.php', {page: 'upsideValue', arrayData: arrayDataUpside, upside: upsideValue, years: <?php echo $dateVal[1];?> }, function(data) {
                 if(data) {
                    alert('Sucessfully saved.');
                    $('#upsideN_'+i).val('');
                    $('#upsideN_').hide();
                    // location.reload();
                    console.log("N: "+data);
                 }
              });
            }
         });
         $('#saveDownsideN').click(function(){
            let downsideValue = $('#downsideN_'+i).val();
            if(downsideValue !== undefined) {
              let arrayDataUpside = $('#itemValueWithIdDownsideN').text();
              console.log(arrayDataUpside);
              $.post('router.php', {page: 'downsideValue', arrayData: arrayDataUpside, downside: downsideValue, years: <?php echo $dateVal[1];?>}, function(data) {
                 if(data) {
                    alert('Sucessfully saved.');
                    $('#downsideN_'+i).val('');
                    $('#downsideN').hide();
                    location.reload();
                    // console.log(data);
                 }
              });
            }
         });
/*End:: Next Year Form --------------------------------------------------------------------*/
      
/*Start:: Next to Next Year Form ----------------------------------------------------------*/
        $('#itemNN_'+i).change(function(){
            $.when( $.post('router.php', {page: 'brandDropDown', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}) )
                .then( function(data) { $('#brandNN_'+i).html(data); });
            $.when ( $.post('router.php', {page: 'lastRollingForecast', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}))
                .then( function(data) { $('#lastRollingForecast_fcastNN_'+i).val(data); } );
        });
        $('#brandNN_'+i).change(function(){
             $.post('router.php', {page: 'totalSalesTarget', arrayData: $(this).val(), otherdata: {customerName: '<?php echo $_SESSION['customerName'];?>', countryId: <?php echo $_SESSION['countryName'];?>} }, function(data) {
                if(data!=="")
                   var dataValue = data;
                 else
                   var dataValue = 0;
                $('#totalSalesTarget_fcastNN_'+i).val(dataValue);
             });                     
        });
        $('#jan_fcastNN_'+i+', #feb_fcastNN_'+i+', #mar_fcastNN_'+i+', #apr_fcastNN_'+i+', #may_fcastNN_'+i+', #jun_fcastNN_'+i+', #jul_fcastNN_'+i+', #aug_fcastNN_'+i+', #sep_fcastNN_'+i+', #oct_fcastNN_'+i+', #nov_fcastNN_'+i+', #dec_fcastNN_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_fcastNN_'+i+'').val()) + parseFloat($('#feb_fcastNN_'+i+'').val()) + parseFloat($('#mar_fcastNN_'+i+'').val()) + parseFloat($('#apr_fcastNN_'+i+'').val()) + parseFloat($('#may_fcastNN_'+i+'').val()) + parseFloat($('#jun_fcastNN_'+i+'').val()) + parseFloat($('#jul_fcastNN_'+i+'').val()) + parseFloat($('#aug_fcastNN_'+i+'').val()) + parseFloat($('#sep_fcastNN_'+i+'').val()) + parseFloat($('#oct_fcastNN_'+i+'').val()) + parseFloat($('#nov_fcastNN_'+i+'').val()) + parseFloat($('#dec_fcastNN_'+i+'').val());
            $('#totalForecast_fcastNN_'+i+'').val(add);
            let varientVolume = (add - parseFloat($('#lastRollingForecast_fcastNN_'+i+'').val())).toFixed(2)
            $('#varient_fcastNN_'+i+'').val(varientVolume);
         });
         $('#ytd_fcastNN_'+i+'').val(0); //'sum of approve month forecast'
         $('#yearToGo_fcastNN_'+i+'').val(parseFloat($('#totalSalesTarget_fcastNN_'+i+'').val() - $('#ytd_fcastNN_'+i+'').val()));
        
        /*This line of code for focs*/
         $('#jan_focsNN_'+i+', #feb_focsNN_'+i+', #mar_focsNN_'+i+', #apr_focsNN_'+i+', #may_focsNN_'+i+', #jun_focsNN_'+i+', #jul_focsNN_'+i+', #aug_focsNN_'+i+', #sep_focsNN_'+i+', #oct_focsNN_'+i+', #nov_focsNN_'+i+', #dec_focsNN_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_focsNN_'+i+'').val()) + parseFloat($('#feb_focsNN_'+i+'').val()) + parseFloat($('#mar_focsNN_'+i+'').val()) + parseFloat($('#apr_focsNN_'+i+'').val()) + parseFloat($('#may_focsNN_'+i+'').val()) + parseFloat($('#jun_focsNN_'+i+'').val()) + parseFloat($('#jul_focsNN_'+i+'').val()) + parseFloat($('#aug_focsNN_'+i+'').val()) + parseFloat($('#sep_focsNN_'+i+'').val()) + parseFloat($('#oct_focsNN_'+i+'').val()) + parseFloat($('#nov_focsNN_'+i+'').val()) + parseFloat($('#dec_focsNN_'+i+'').val());
            $('#totalForecast_focsNN_'+i+'').val(add);
            let varientVolumeFocs = (add - parseFloat($('#lastRollingForecast_focsNN_'+i+'').val())).toFixed(2);
            $('#varient_focsNN_'+i+'').val(varientVolumeFocs); 
         });
         $('#ytd_focsNN_'+i+'').val(0); //'sum of approve month focs'     
         $('#yearToGo_focsNN_'+i+'').val(parseFloat($('#totalSalesTarget_focsNN_'+i+'').val() - $('#ytd_focsNN_'+i+'').val()));
/*End:: Next to Next Year Form ------------------------------------------------------------*/
/*Start:: Next to Two Next Year Form ----------------------------------------------------------*/
        $('#itemNNN_'+i).change(function(){
            $.when( $.post('router.php', {page: 'brandDropDown', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}) )
                .then( function(data) { $('#brandNNN_'+i).html(data); });
            $.when ( $.post('router.php', {page: 'lastRollingForecast', arrayData: $(this).val(), countryId: <?php echo $_SESSION['countryName']?>}))
                .then( function(data) { $('#lastRollingForecast_fcastNNN_'+i).val(data); } );
        });
        $('#brandNNN_'+i).change(function(){
             $.post('router.php', {page: 'totalSalesTarget', arrayData: $(this).val(), otherdata: {customerName: '<?php echo $_SESSION['customerName'];?>', countryId: <?php echo $_SESSION['countryName'];?>} }, function(data) {
                if(data!=="")
                   var dataValue = data;
                 else
                   var dataValue = 0;
                $('#totalSalesTarget_fcastNNN_'+i).val(dataValue);
             });                     
        });
        $('#jan_fcastNNN_'+i+', #feb_fcastNNN_'+i+', #mar_fcastNNN_'+i+', #apr_fcastNNN_'+i+', #may_fcastNNN_'+i+', #jun_fcastNNN_'+i+', #jul_fcastNNN_'+i+', #aug_fcastNNN_'+i+', #sep_fcastNNN_'+i+', #oct_fcastNNN_'+i+', #nov_fcastNNN_'+i+', #dec_fcastNNN_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_fcastNNN_'+i+'').val()) + parseFloat($('#feb_fcastNNN_'+i+'').val()) + parseFloat($('#mar_fcastNNN_'+i+'').val()) + parseFloat($('#apr_fcastNNN_'+i+'').val()) + parseFloat($('#may_fcastNNN_'+i+'').val()) + parseFloat($('#jun_fcastNNN_'+i+'').val()) + parseFloat($('#jul_fcastNNN_'+i+'').val()) + parseFloat($('#aug_fcastNNN_'+i+'').val()) + parseFloat($('#sep_fcastNNN_'+i+'').val()) + parseFloat($('#oct_fcastNNN_'+i+'').val()) + parseFloat($('#nov_fcastNNN_'+i+'').val()) + parseFloat($('#dec_fcastNNN_'+i+'').val());
            $('#totalForecast_fcastNNN_'+i+'').val(add);
            let varientVolume = (add - parseFloat($('#lastRollingForecast_fcastNNN_'+i+'').val())).toFixed(2)
            $('#varient_fcastNNN_'+i+'').val(varientVolume);
         });
         $('#ytd_fcastNNN_'+i+'').val(0); //'sum of approve month forecast'
         $('#yearToGo_fcastNNN_'+i+'').val(parseFloat($('#totalSalesTarget_fcastNNN_'+i+'').val() - $('#ytd_fcastNNN_'+i+'').val()));
        
        /*This line of code for focs*/
         $('#jan_focsNNN_'+i+', #feb_focsNNN_'+i+', #mar_focsNNN_'+i+', #apr_focsNNN_'+i+', #may_focsNNN_'+i+', #jun_focsNNN_'+i+', #jul_focsNNN_'+i+', #aug_focsNNN_'+i+', #sep_focsNNN_'+i+', #oct_focsNNN_'+i+', #nov_focsNNN_'+i+', #dec_focsNNN_'+i+'').keyup(function(){
            var add = parseFloat($('#jan_focsNNN_'+i+'').val()) + parseFloat($('#feb_focsNNN_'+i+'').val()) + parseFloat($('#mar_focsNNN_'+i+'').val()) + parseFloat($('#apr_focsNNN_'+i+'').val()) + parseFloat($('#may_focsNNN_'+i+'').val()) + parseFloat($('#jun_focsNNN_'+i+'').val()) + parseFloat($('#jul_focsNNN_'+i+'').val()) + parseFloat($('#aug_focsNNN_'+i+'').val()) + parseFloat($('#sep_focsNNN_'+i+'').val()) + parseFloat($('#oct_focsNNN_'+i+'').val()) + parseFloat($('#nov_focsNNN_'+i+'').val()) + parseFloat($('#dec_focsNNN_'+i+'').val());
            $('#totalForecast_focsNN_'+i+'').val(add);
            let varientVolumeFocs = (add - parseFloat($('#lastRollingForecast_focsNNN_'+i+'').val())).toFixed(2);
            $('#varient_focsNNN_'+i+'').val(varientVolumeFocs); 
         });
         $('#ytd_focsNNN_'+i+'').val(0); //'sum of approve month focs'     
         $('#yearToGo_focsNNN_'+i+'').val(parseFloat($('#totalSalesTarget_focsNNN_'+i+'').val() - $('#ytd_focsNNN_'+i+'').val()));
/*End:: Next to Next Year Form ------------------------------------------------------------*/
    }); //End iterations
   
/*----------------------------------- Button Click Event :: Start -------------------------------------------------*/
    $('#btnEntryGridCurrent').click(function() {
      var TableData;
       TableData = $("#entryGridFormCurrent").serializeArray();
       var a = fieldValidator(TableData);
       let sendData = storeTblValues('currentSampleTbl');
       sendData = JSON.stringify(sendData);
       if(a === true) {
           $.post('router.php', {page: 'dataEnterIntoTable', arrayData:sendData, yearval: <?php echo date("Y");?>}, function(data){
              console.log('Vikas '+data);
              if(data) {
                alert('Date insert sucessfully.');
                location.reload();
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
       var a = fieldValidatorAnother(tempArr);
       let sendDataTwo = storeTblValues('nextSampleTbl');
       sendDataTwo = JSON.stringify(sendDataTwo);
       console.log(sendDataTwo);
       if(a === true) {
           // let TableData = $('#entryGridFormNextYear').serializeArray();
           $.post('router.php', {page:'dataEnterIntoTable', arrayData: sendDataTwo, yearval: <?php echo date("Y")+1;?>}, function(data){
              console.log('VikasN '+data);
              if(data) {
                  // alert('Date insert sucessfully.');
                  // location.reload();
              }
           });
        }
    });    
    $('#btnEntryGridOneNextYear').click(function(){      
       let tempArr = [];
       $("input[id*='fcastNN']").each(function(i){           
           tempArr.push({'name': $(this).attr('id'), 'value': $(this).val()});
       });
       $("input[id*='focsNN']").each(function() {
           tempArr.push({'name': $(this).attr('id'), 'value': $(this).val()});
       });
       var a = fieldValidatorAnother(tempArr);
       let sendData = storeTblValues('nextOneSampleTbl');
       sendData = JSON.stringify(sendData);
       if(a === true) {
           let TableData = $('#entryGridFormOneNextYear').serializeArray();
           $.post('router.php', {page:'dataEnterIntoTable', arrayData:sendData, yearval: <?php echo date("Y")+2;?>}, function(data){
              console.log('VikasNN '+data);
              if(data) {
                 // alert('Date insert sucessfully.');
                 //  location.reload();
              }
           });
        }
    });    
    $('#btnEntryGridTwoNextYear').click(function(){      
       let tempArr = [];
       $("input[id*='fcastNNN']").each(function(i){           
           tempArr.push({'name': $(this).attr('id'), 'value': $(this).val()});
       });
       $("input[id*='focsNNN']").each(function() {
           tempArr.push({'name': $(this).attr('id'), 'value': $(this).val()});
       });
       var a = fieldValidatorAnother(tempArr);
       let sendData = storeTblValues('nextTwoSampleTbl');
       sendData = JSON.stringify(sendData);    
       if(a === true) {
           let TableData = $('#entryGridFormTwoNextYear').serializeArray();
           $.post('router.php', {page:'dataEnterIntoTable', arrayData:sendData, yearval: <?php echo date("Y")+2;?>}, function(data){
              console.log('VikasNNN '+data);
              if(data) {
                  alert('Date insert sucessfully.');
                  location.reload();
              }
           });
        }
    });    
    $('#btnEntryGridThreeNextYear').click(function(){      
       let tempArr = [];
       $("input[id*='fcastNNNN']").each(function(i){           
           tempArr.push({'name': $(this).attr('id'), 'value': $(this).val()});
       });
       $("input[id*='focsNNNN']").each(function() {
           tempArr.push({'name': $(this).attr('id'), 'value': $(this).val()});
       });
       var a = fieldValidatorAnother(tempArr);
       var a = fieldValidatorAnother(tempArr);
       let sendData = storeTblValues('nextThreeSampleTbl');    
       if(a === true) {
           let TableData = $('#entryGridFormThreeNextYear').serializeArray();
           $.post('router.php', {page:'dataEnterIntoTable', arrayData:sendData, yearval: <?php echo date("Y")+2;?>}, function(data){
              console.log('VikasNNNN '+data);
              if(data) {
                  alert('Date insert sucessfully.');
                  location.reload();
              }
           });
        }
    });
/*---------------------------------------------------------Button Click Event :: End ---------------------------------------------*/
/*To reset the dropdown index into 0::combination check*/
    $("select[id*='type_']").change(function(){
        console.log($(this).attr('id'), $(this).val());
    });

$('#valueFromNFGSystem').click(function() {
   console.log("Hello Vikas ");
   $.post('test.php', {page: 'fetchNGFSytemRecords'}, function(data) {
      console.log(data);
   })
});

$('#previousYear').click(function(){
    $('#previousYearTable').slideDown();
    $('#currentYearTable').hide();
});
$('#currentYearVal').click(function(){
    $('#currentYearTable').slideDown();
    $('#previousYearTable').hide();
});
    
</script>