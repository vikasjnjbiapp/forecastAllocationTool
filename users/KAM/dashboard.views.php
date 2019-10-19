<?php
echo isset($_SESSION['customerName']);
/*if(!isset($_SESSION['customerName'])) {
  $url = 'http://localhost/Site/JNJ_Project_New/?'.base64_encode('Home').'';
  header('Location: '.$url);
}*/

require_once('controllers/entryData.helper.php');
$limit = 25;
$entryData = new entryData();
$customerName = isset($_SESSION['customerName'])?$_SESSION['customerName']:null;
?>
<!-- Display the chart and report -->
<ul class="nav nav-tabs" id="myTab">
    <li class="nav-item">
        <a href="#chart" class="nav-link" data-toggle="tab">Charts</a>
    </li>
    <li class="nav-item">
        <a href="#currentYear" class="nav-link" data-toggle="tab" id="year_19">Year - <?php echo date("Y");?></a>
    </li>
    <li class="nav-item">
        <a href="#previousYear" class="nav-link" data-toggle="tab" id="year_18">Year - <?php echo date("Y")-1;?></a>
    </li>
    <li class="nav-item">
        <a href="#onePreviousYear" class="nav-link" data-toggle="tab" id="year_17">Year - <?php echo date("Y")-2;?></a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade row" id="chart">
        <h4 class="mt-2">Forecast Chart</h4>
        <p> <span id="countryAndforcast">Graph between country & forcast</span>
            <div class="col-6" id="mychartOne"><canvas id="myChart"></canvas></div>
        </p>
        <p> <span id="itemAndforcast">Graph between Item & forcast</span>
            <div class="col-6" id="mycharTwo"><canvas id="mycharTwo"></canvas></div>
        </p>
    </div>
    <div class="tab-pane fade" id="currentYear">
        <h4 class="mt-2"><?php echo date("Y");?> Data</h4>
        <div class="col-sm-6 float-left">
          <?php if(intval($customerName) === 1) { ?>
            <a href="#" id="downloadXlsxFile">Download consolidated report</a>
          <?php } ?>
        </div>
        <div class="row float-right">
            <div class="col-sm-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-search" id="custNumberSearch" data-toggle="tooltip" ></span>
                        </span>                    
                    </div>
                    <input type="text" class="form-control" placeholder="CustNum, CountryName, Item" value="" name="custNumSearch" id="custNumSearch" style="width:250px;">
                </div>
            </div>
        </div><br/><br/>
        <div id="data"></div><br/>
        <div class="float-right" id="peginationDiv">
        <?php
            
            $total_pages = $entryData->totalPages('jnj_enterydata', date("Y"), $customerName);
            $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.            
              $paginationDrop = '<div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pegination</span>                
                    </div><select class="form-control" id="dropDownPage" style="width:150px;">';
              if($lastpage > 0) {
                  for($i=1; $i<=$lastpage; $i++) {
                    $paginationDrop.= '<option value='.$i.'>'.$i.'</option>'; 
                  }
              } else {
                  $paginationDrop.= '<option value="">No Values</option>';
              }
              $paginationDrop .= '</select> &nbsp;
               <div class="input-group-prepend">
                    <span class="input-group-text">Limits</span>                
                </div>
               <select class="form-control" id="dropDownLimit" style="width:150px;" disabled>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select></div>';
           echo $paginationDrop;
        ?>
      </div><br/><br/>
    </div>
    <div class="tab-pane fade" id="previousYear">
        <h4 class="mt-2"><?php echo date("Y")-1;?> Data</h4>
        <div class="row float-right">
            <div class="col-sm-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-search" id="custNumberSearch1" data-toggle="tooltip" ></span>
                        </span>                    
                    </div>
                    <input type="text" class="form-control" placeholder="CustNum, CountryName, Item" value="" name="custNumSearch1" id="custNumSearch1" style="width:250px;">
                </div>
            </div>
        </div><br/><br/>
        <div id="data1"></div><br/>
        <div class="float-right" id="peginationDiv">
        <?php
            $total_pages = $entryData->totalPages('jnj_enterydata', date("Y")-1, $customerName);
            $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.            
              $paginationDrop = '<div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pegination</span>                
                    </div><select class="form-control" id="dropDownPage1" style="width:150px;">';
              if($lastpage > 0) {
                  for($i=1; $i<=$lastpage; $i++) {
                    $paginationDrop.= '<option value='.$i.'>'.$i.'</option>'; 
                  }
              } else {
                  $paginationDrop.= '<option value="">No Values</option>';
              }
              $paginationDrop .= '</select> &nbsp;
               <div class="input-group-prepend">
                    <span class="input-group-text">Limits</span>                
                </div>
               <select class="form-control" id="dropDownLimit1" style="width:100px;" disabled>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select></div>';
           echo $paginationDrop;
        ?>
      </div><br/><br/>
    </div>
    <div class="tab-pane fade" id="onePreviousYear">
        <h4 class="mt-2"><?php echo date("Y")-2;?> Data</h4>
        <div class="row float-right">
            <div class="col-sm-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-search" id="custNumberSearch2" data-toggle="tooltip" ></span>
                        </span>                    
                    </div>
                    <input type="text" class="form-control" placeholder="CustNum, CountryName, Item" value="" name="custNumSearch" id="custNumSearch2" style="width:250px;">
                </div>
            </div>
        </div><br/><br/>
        <div id="data2"></div><br/>
      <div class="float-right" id="peginationDiv">
        <?php
            /*$argThree = isset($_SESSION['argSearch'])?$_SESSION['argSearch']:'';
            echo $argThree;*/
            $total_pages = $entryData->totalPages('jnj_enterydata', date("Y")-2, $customerName);
            $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.            
              $paginationDrop = '<div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Pegination</span>                
                    </div><select class="form-control" id="dropDownPage2" style="width:150px;">';
              if($lastpage > 0) {
                  for($i=1; $i<=$lastpage; $i++) {
                    $paginationDrop.= '<option value='.$i.'>'.$i.'</option>'; 
                  }
              } else {
                  $paginationDrop.= '<option value="">No Values</option>';
              }
              $paginationDrop .= '</select> &nbsp;
               <div class="input-group-prepend">
                    <span class="input-group-text">Limits</span>                
                </div>
               <select class="form-control" id="dropDownLimit2" style="width:150px;" disabled>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select></div>';
           echo $paginationDrop;
        ?>
      </div><br/><br/>
    </div>
</div>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
     chartCreate(ctx);
    function chartCreate(argOne) {
       var chart = new Chart(argOne, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['Bahrain', 'KSA', 'Kuwait', 'Oman', 'Qatar', 'UAE'],
                datasets: [{
                    label: '2019 forcast',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [160427, 4614053.2, 681975, 156154, 892483, 1693705]
                }]
            },

            // Configuration options go here
            options: {}
        });
       return chart;
    }
    $(document).ready(function(){ 
        $("#myTab a:first").tab('show'); // show last tab on page load
        $('#mychartOne').hide();
        $('[data-toggle="tooltip"]').tooltip({
            title: "Searcch by customer number or country name or item. <br/> You can also use three criteria togather using colum saparator.",
            html: true
        });
    });
    var currentYear = (new Date).getFullYear();
    /*
      - To display the data on click of tags
    */
    $('#year_19').click(function() {
        $.post('controllers/apiEntryData.helper.php', {a:null, b:'fullGrid', c:currentYear, d:0, e:25, custNum:<?php echo $customerName;?>}, function(data){
            $('#data').html(data);
        });
        // [Not using] $('#data').load('views/grid.component.php');
    });
    $('#year_18').click(function() {
        $.post('controllers/apiEntryData.helper.php', {a:null, b:'fullGrid', c:currentYear-1, d:0, e:25, custNum:<?php echo $customerName;?>}, function(data){
            $('#data1').html(data);
        });
    });
    $('#year_17').click(function() {
        $.post('controllers/apiEntryData.helper.php', {a:null, b:'fullGrid', c:currentYear-2, d:0, e:25, custNum:<?php echo $customerName;?>}, function(data){
            $('#data2').html(data);
        });
    });
    /*
      - To search the grid value using customer number, country name etc
    */
    $('#custNumberSearch').click(function(){
        let inputValue = $("#custNumSearch").val();
        $.post("controllers/apiEntryData.helper.php", {a: inputValue, b: "searchData", c:<?php echo date("Y")-2;?>, d:0, e:25}, function(data) {
           $("#data").html(data);
        });
    });
    $('#custNumberSearch1').click(function(){
        let inputValue = $("#custNumSearch1").val();
        $.post("controllers/apiEntryData.helper.php", {a: inputValue, b: "searchData", c:<?php echo date("Y")-2;?>, d:0, e:25}, function(data) {
           $("#data1").html(data);
        });
    });
    $('#custNumberSearch2').click(function(){
        let inputValue = $("#custNumSearch2").val();
        $.post("controllers/apiEntryData.helper.php", {a: inputValue, b: "searchData", c:<?php echo date("Y")-2;?>, d:0, e:25}, function(data) {
           $("#data2").html(data);
        });
    });
    $('#countryAndforcast').click(function() {
        $('#mychartOne').slideToggle(100);
    });
    $('#dropDownPage2').change(function(){
       console.log($(this).val());
       let inputValue = $("#custNumSearch2").val();
       $.post("controllers/apiEntryData.helper.php", {a: inputValue, b: "pagination", c: <?php echo date("Y")-2;?>, d: $(this).val(), e:25, custNum:<?php echo $customerName;?>}, function(data) {
           $("#data2").html(data);
       });
    });
    $('#downloadXlsxFile').click(function() {

    })

</script>