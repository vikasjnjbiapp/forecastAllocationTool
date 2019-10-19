/*
File Discription: Customer forecast validation file
*/


/*This method call for current year data validation*/
let fieldValidator = function(TableData) {
    var a = true;
    TableData.map(function(field) {
      // let fieldName = $(field).attr('name').split('_');
      let fieldName = $(field).attr('name').split('_');
      if(fieldName[1] === 'fcast' || fieldName[1] === 'focs') {
         if(fieldName[0] !== 'totalSalesTarget' && fieldName[0] !== 'lastRollingForecast' && fieldName[0] !== 'totalForecast' && fieldName[0] !== 'varient' && fieldName[0] !== 'ytd' && fieldName[0] !== 'yearToGo') {
            var fieldValue = $(field).attr('value').match(/^[A-Za-z]*$/);
            if(fieldValue!==null) {
                console.log('hello');
                $('#'+$(field).attr('name')).addClass('error');
                //$('#errorMessage').html('Something went wrong!');
                a = false;
            } else {
                $('#'+$(field).attr('name')).removeClass('error');
                $('#errorMessage').hide();
            }            
         }
      }
   });
  return a;
};

/*This method call for dynaamic for rest all year validation*/
let fieldValidatorAnother = function(TableData) {
    var a = true;
    TableData.map(function(field) {
      // let fieldName = $(field).attr('name').split('_');
      let fieldName = $(field).attr('name').split('_');
      let searchText = ['fcast','fcastN', 'fcastNN', 'fcastNNN', 'fcastNNNN', 'focs','focsN','focsNN','focsNN', 'focsNNN', 'focsNNNN'].indexOf(fieldName[1]);
      let searchNextText = ['totalSalesTargetN', 'lastRollingForecastN', 'totalForecastN', 'varientN', 'ytdN', 'yearToGoN', 'totalSalesTargetNN', 'lastRollingForecastNN', 'totalForecastNN', 'varientNN', 'ytdNN', 'yearToGoNN', 'totalSalesTargetNNN', 'lastRollingForecastNNN', 'totalForecastNNN', 'varientNNN', 'ytdNNN', 'yearToGoNNN', 'totalSalesTargetNNNN', 'lastRollingForecastNNNN', 'totalForecastNNNN', 'varientNNNN', 'ytdNNNN', 'yearToGoNNNN'].indexOf(fieldName[0])
      if(searchText >= 1) {
         if(searchNextText !== 1) {
            var fieldValue = $(field).attr('value').match(/^[A-Za-z]*$/);
            if(fieldValue!==null) {
                console.log('hello');
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
  return a;
};

let storeTblValues = function() {
    console.log(arg);
    var TableData = new Array();
    $('#currentSampleTbl tr').each(function(row, tr){
        TableData[row]={
            "customerName" : $(tr).find('td:eq(0) input').val(),
            "countryId" :$(tr).find('td:eq(1) input').val(),
            "type" : $(tr).find('td:eq(2) input').val(),
            "busSelector" : $(tr).find('td:eq(3) input').val(),
            "item" : $(tr).find('td:eq(4) input').val(),
            "brand" : $(tr).find('td:eq(5) input').val(),
            "unit" : $(tr).find('td:eq(6) select').val(),
            "busSelector" : $(tr).find('td:eq(7) select').val(),
            "forcast" : $(tr).find('td:eq(8) input').val(),
            "focs" : $(tr).find('td:eq(9) input').val(),
            "month" : $(tr).find('td:eq(10) input').val(),
            "year" : $(tr).find('td:eq(11) input').val(),
            "status" : $(tr).find('td:eq(12) select').val(),
            "sapcode" : $(tr).find('td:eq(13) input').val(),
            "diversted" : $(tr).find('td:eq(14) select').val()
        }    
    }); 
    TableData.shift();  // first row will be empty - so remove
    TableData.shift();
  return TableData;
};

