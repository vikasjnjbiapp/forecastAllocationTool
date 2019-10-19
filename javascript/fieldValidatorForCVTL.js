/*
File Discription: Customer forecast validation file
*/


/*This method call for current year data validation*/
let fieldValidator = function(TableData) {
    var a = true
    TableData.map(function(field) {
      // let fieldName = $(field).attr('name').split('_');
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
   });
  return a;
};

/*This method call for dynaamic for rest all year validation*/
let fieldValidatorAnother = function(TableData) {
    var a = true
    TableData.map(function(field) {
      // let fieldName = $(field).attr('name').split('_');
      let fieldName = $(field).attr('name').split('_');
      let searchText = ['fcast','fcastN','focs','focsN'].indexOf(fieldName[1]);
      let searchNextText = ['totalSalesTargetN', 'lastRollingForecastN', 'totalForecastN', 'varientN', 'ytdN', 'yearToGoN'].indexOf(fieldName[0])
      if(searchText >= 1) {
         if(searchNextText !== 1) {
            var fieldValue = $(field).attr('value').match(/^[A-Za-z]*$/);
            // console.log($(field).attr('name')+'==>'+typeof $(field).attr('value')+'==>'+fieldValue); 
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

/* This will insert the values into DB*/
let storeTblValues = function(argOne) {
  var TableData = new Array();
  $('#'+argOne+' tr').each(function(row){
    if ($('#item_'+(row+1)+'').val() !== undefined && $('#item_'+(row+1)+'').val() !== "0" && argOne==='currentSampleTbl') {
        TableData[row] = { "customerName" : $('input[id="customerName_'+(row+1)+'"]').val(), "countryId" : "'"+$('input[id="country_'+(row+1)+'"]').val()+"'",
            "type" : "'"+$('[id="type_'+(row+1)+'"]').val()+"'", "busSelector" : "'"+$('[id="busSelector_'+(row+1)+'"]').val()+"'", "itemId" : $('[id="item_'+(row+1)+'"]').val(), "brandId" : $('[id="brand_'+(row+1)+'"]').val(),  "janFcast" : $('input[id="jan_fcast_'+(row+1)+'"]').val(), "febFcast" : $('input[id="feb_fcast_'+(row+1)+'"]').val(), "marFcast" : $('input[id="mar_fcast_'+(row+1)+'"]').val(), "aprFcast" : $('input[id="apr_fcast_'+(row+1)+'"]').val(), "mayFcast" : $('input[id="may_fcast_'+(row+1)+'"]').val(), "junFcast" : $('input[id="jun_fcast_'+(row+1)+'"]').val(),
            "julFcast" : $('input[id="jul_fcast_'+(row+1)+'"]').val(), "augFcast" : $('input[id="aug_fcast_'+(row+1)+'"]').val(), "sepFcast" : $('input[id="sep_fcast_'+(row+1)+'"]').val(), "octFcast" : $('input[id="oct_fcast_'+(row+1)+'"]').val(), "novFcast" : $('input[id="nov_fcast_'+(row+1)+'"]').val(), "decFcast" : $('input[id="dec_fcast_'+(row+1)+'"]').val(), "totalSalesTargetFcast" : $('input[id="totalSalesTarget_fcast_'+(row+1)+'"]').val(), "lastRollingForecastFcast" : $('input[id="lastRollingForecast_fcast_'+(row+1)+'"]').val(), "totalForecastFcast" : $('input[id="totalForecast_fcast_'+(row+1)+'"]').val(), "varientFcast" : $('input[id="varient_fcast_'+(row+1)+'"]').val(),
            "ytdFcast" : $('input[id="ytd_fcast_'+(row+1)+'"]').val(), "yearToGoFcast" : $('input[id="yearToGo_fcast_'+(row+1)+'"]').val(),
            "financialPlanFcast" : $('input[id="financialPlan_fcast_'+(row+1)+'"]').val(), "janFocs" : $('input[id="jan_focs_'+(row+1)+'"]').val(),
            "febFocs" : $('input[id="feb_focs_'+(row+1)+'"]').val(), "marFocs" : $('input[id="mar_focs_'+(row+1)+'"]').val(), "aprFocs" : $('input[id="apr_focs_'+(row+1)+'"]').val(), "mayFocs" : $('input[id="may_focs_'+(row+1)+'"]').val(), "junFocs" : $('input[id="jun_focs_'+(row+1)+'"]').val(), "julFocs" : $('input[id="jul_focs_'+(row+1)+'"]').val(), "augFocs" : $('input[id="aug_focs_'+(row+1)+'"]').val(),
            "sepFocs" : $('input[id="sep_focs_'+(row+1)+'"]').val(), "octFocs" : $('input[id="oct_focs_'+(row+1)+'"]').val(), "novFocs" : $('input[id="nov_focs_'+(row+1)+'"]').val(), "decFocs" : $('input[id="dec_focs_'+(row+1)+'"]').val(), "totalSalesTargetFocs" : $('input[id="totalSalesTarget_focs_'+(row+1)+'"]').val(), "lastRollingForecastFocs" : $('input[id="lastRollingForecast_focs_'+(row+1)+'"]').val(),
            "totalForecastFocs" : $('input[id="totalForecast_focs_'+(row+1)+'"]').val(), "varientFocs" : $('input[id="varient_focs_'+(row+1)+'"]').val(),
            "ytdFocs" : $('input[id="ytd_focs_'+(row+1)+'"]').val(), "yearToGoFocs" : $('input[id="yearToGo_focs_'+(row+1)+'"]').val(), "financialPlanFocs" : $('input[id="financialPlan_focs_'+(row+1)+'"]').val() }
     } else if ($('#itemN_'+(row+1)+'').val() !== undefined && $('#itemN_'+(row+1)+'').val() !== "0" && argOne==='nextSampleTbl') {
        TableData[row] = { "customerName" : $('input[id="customerNameN_'+(row+1)+'"]').val(), "countryId" : "'"+$('input[id="countryN_'+(row+1)+'"]').val()+"'",
            "type" : "'"+$('[id="typeN_'+(row+1)+'"]').val()+"'", "busSelector" : "'"+$('[id="busSelectorN_'+(row+1)+'"]').val()+"'", "itemId" : $('[id="itemN_'+(row+1)+'"]').val(), "brandId" : $('[id="brandN_'+(row+1)+'"]').val(),  "janFcast" : $('input[id="jan_fcastN_'+(row+1)+'"]').val(), "febFcast" : $('input[id="feb_fcastN_'+(row+1)+'"]').val(), "marFcast" : $('input[id="mar_fcastN_'+(row+1)+'"]').val(), "aprFcast" : $('input[id="apr_fcastN_'+(row+1)+'"]').val(), "mayFcast" : $('input[id="may_fcastN_'+(row+1)+'"]').val(), "junFcast" : $('input[id="jun_fcastN_'+(row+1)+'"]').val(),
            "julFcast" : $('input[id="jul_fcastN_'+(row+1)+'"]').val(), "augFcast" : $('input[id="aug_fcastN_'+(row+1)+'"]').val(), "sepFcast" : $('input[id="sep_fcastN_'+(row+1)+'"]').val(), "octFcast" : $('input[id="oct_fcastN_'+(row+1)+'"]').val(), "novFcast" : $('input[id="nov_fcastN_'+(row+1)+'"]').val(), "decFcast" : $('input[id="dec_fcastN_'+(row+1)+'"]').val(), "totalSalesTargetFcast" : $('input[id="totalSalesTarget_fcastN_'+(row+1)+'"]').val(), "lastRollingForecastFcast" : $('input[id="lastRollingForecast_fcastN_'+(row+1)+'"]').val(), "totalForecastFcast" : $('input[id="totalForecast_fcastN_'+(row+1)+'"]').val(), "varientFcast" : $('input[id="varient_fcastN_'+(row+1)+'"]').val(),
            "ytdFcast" : $('input[id="ytd_fcastN_'+(row+1)+'"]').val(), "yearToGoFcast" : $('input[id="yearToGo_fcastN_'+(row+1)+'"]').val(),
            "financialPlanFcast" : $('input[id="financialPlan_fcastN_'+(row+1)+'"]').val(), "janFocs" : $('input[id="jan_focsN_'+(row+1)+'"]').val(),
            "febFocs" : $('input[id="feb_focsN_'+(row+1)+'"]').val(), "marFocs" : $('input[id="mar_focsN_'+(row+1)+'"]').val(), "aprFocs" : $('input[id="apr_focsN_'+(row+1)+'"]').val(), "mayFocs" : $('input[id="may_focsN_'+(row+1)+'"]').val(), "junFocs" : $('input[id="jun_focsN_'+(row+1)+'"]').val(), "julFocs" : $('input[id="jul_focsN_'+(row+1)+'"]').val(), "augFocs" : $('input[id="aug_focsN_'+(row+1)+'"]').val(), "sepFocs" : $('input[id="sep_focsN_'+(row+1)+'"]').val(), "octFocs" : $('input[id="oct_focsN_'+(row+1)+'"]').val(), "novFocs" : $('input[id="nov_focsN_'+(row+1)+'"]').val(), "decFocs" : $('input[id="dec_focsN_'+(row+1)+'"]').val(), "totalSalesTargetFocs" : $('input[id="totalSalesTarget_focsN_'+(row+1)+'"]').val(), "lastRollingForecastFocs" : $('input[id="lastRollingForecast_focsN_'+(row+1)+'"]').val(), "totalForecastFocs" : $('input[id="totalForecast_focsN_'+(row+1)+'"]').val(), "varientFocs" : $('input[id="varient_focsN_'+(row+1)+'"]').val(), "ytdFocs" : $('input[id="ytd_focsN_'+(row+1)+'"]').val(), "yearToGoFocs" : $('input[id="yearToGo_focsN_'+(row+1)+'"]').val(), "financialPlanFocs" : $('input[id="financialPlan_focsN_'+(row+1)+'"]').val() }
     } else if ($('#itemNN_'+(row+1)+'').val() !== undefined && $('#itemNN_'+(row+1)+'').val() !== "0" && argOne==='nextOneSampleTbl') {
        TableData[row] = { "customerName" : $('input[id="customerNameNN_'+(row+1)+'"]').val(), "countryId" : "'"+$('input[id="countryNN_'+(row+1)+'"]').val()+"'",
            "type" : "'"+$('[id="typeNN_'+(row+1)+'"]').val()+"'", "busSelector" : "'"+$('[id="busSelectorNN_'+(row+1)+'"]').val()+"'", "itemId" : $('[id="itemNN_'+(row+1)+'"]').val(), "brandId" : $('[id="brandNN_'+(row+1)+'"]').val(),  "janFcast" : $('input[id="jan_fcastNN_'+(row+1)+'"]').val(), "febFcast" : $('input[id="feb_fcastNN_'+(row+1)+'"]').val(), "marFcast" : $('input[id="mar_fcastNN_'+(row+1)+'"]').val(), "aprFcast" : $('input[id="apr_fcastNN_'+(row+1)+'"]').val(), "mayFcast" : $('input[id="may_fcastNN_'+(row+1)+'"]').val(), "junFcast" : $('input[id="jun_fcastNN_'+(row+1)+'"]').val(),
            "julFcast" : $('input[id="jul_fcastNN_'+(row+1)+'"]').val(), "augFcast" : $('input[id="aug_fcastNN_'+(row+1)+'"]').val(), "sepFcast" : $('input[id="sep_fcastNN_'+(row+1)+'"]').val(), "octFcast" : $('input[id="oct_fcastNN_'+(row+1)+'"]').val(), "novFcast" : $('input[id="nov_fcastNN_'+(row+1)+'"]').val(), "decFcast" : $('input[id="dec_fcastNN_'+(row+1)+'"]').val(), "totalSalesTargetFcast" : $('input[id="totalSalesTarget_fcastNN_'+(row+1)+'"]').val(), "lastRollingForecastFcast" : $('input[id="lastRollingForecast_fcastNN_'+(row+1)+'"]').val(), "totalForecastFcast" : $('input[id="totalForecast_fcastNN_'+(row+1)+'"]').val(), "varientFcast" : $('input[id="varient_fcastNN_'+(row+1)+'"]').val(),
            "ytdFcast" : $('input[id="ytd_fcastNN_'+(row+1)+'"]').val(), "yearToGoFcast" : $('input[id="yearToGo_fcastNN_'+(row+1)+'"]').val(),
            "financialPlanFcast" : $('input[id="financialPlan_fcastNN_'+(row+1)+'"]').val(), "janFocs" : $('input[id="jan_focsNN_'+(row+1)+'"]').val(),
            "febFocs" : $('input[id="feb_focsNN_'+(row+1)+'"]').val(), "marFocs" : $('input[id="mar_focsNN_'+(row+1)+'"]').val(), "aprFocs" : $('input[id="apr_focsNN_'+(row+1)+'"]').val(), "mayFocs" : $('input[id="may_focsNN_'+(row+1)+'"]').val(), "junFocs" : $('input[id="jun_focsNN_'+(row+1)+'"]').val(), "julFocs" : $('input[id="jul_focsNN_'+(row+1)+'"]').val(), "augFocs" : $('input[id="aug_focsNN_'+(row+1)+'"]').val(), "sepFocs" : $('input[id="sep_focsNN_'+(row+1)+'"]').val(), "octFocs" : $('input[id="oct_focsNN_'+(row+1)+'"]').val(), "novFocs" : $('input[id="nov_focsNN_'+(row+1)+'"]').val(), "decFocs" : $('input[id="dec_focsNN_'+(row+1)+'"]').val(), "totalSalesTargetFocs" : $('input[id="totalSalesTarget_focsNN_'+(row+1)+'"]').val(), "lastRollingForecastFocs" : $('input[id="lastRollingForecast_focsNN_'+(row+1)+'"]').val(), "totalForecastFocs" : $('input[id="totalForecast_focsNN_'+(row+1)+'"]').val(), "varientFocs" : $('input[id="varient_focsNN_'+(row+1)+'"]').val(), "ytdFocs" : $('input[id="ytd_focsNN_'+(row+1)+'"]').val(), "yearToGoFocs" : $('input[id="yearToGo_focsNN_'+(row+1)+'"]').val(), "financialPlanFocs" : $('input[id="financialPlan_focsNN_'+(row+1)+'"]').val() }
     } else if ($('#itemNNN_'+(row+1)+'').val() !== undefined && $('#itemNNN_'+(row+1)+'').val() !== "0" && argOne==='nextTwoSampleTbl') {
        TableData[row] = { "customerName" : $('input[id="customerNameNNN_'+(row+1)+'"]').val(), "countryId" : "'"+$('input[id="countryNNN_'+(row+1)+'"]').val()+"'",
            "type" : "'"+$('[id="typeNNN_'+(row+1)+'"]').val()+"'", "busSelector" : "'"+$('[id="busSelectorNNN_'+(row+1)+'"]').val()+"'", "itemId" : $('[id="itemNNN_'+(row+1)+'"]').val(), "brandId" : $('[id="brandNNN_'+(row+1)+'"]').val(),  "janFcast" : $('input[id="jan_fcastNNN_'+(row+1)+'"]').val(), "febFcast" : $('input[id="feb_fcastNNN_'+(row+1)+'"]').val(), "marFcast" : $('input[id="mar_fcastNNN_'+(row+1)+'"]').val(), "aprFcast" : $('input[id="apr_fcastNNN_'+(row+1)+'"]').val(), "mayFcast" : $('input[id="may_fcastNNN_'+(row+1)+'"]').val(), "junFcast" : $('input[id="jun_fcastNNN_'+(row+1)+'"]').val(),
            "julFcast" : $('input[id="jul_fcastNNN_'+(row+1)+'"]').val(), "augFcast" : $('input[id="aug_fcastNNN_'+(row+1)+'"]').val(), "sepFcast" : $('input[id="sep_fcastNNN_'+(row+1)+'"]').val(), "octFcast" : $('input[id="oct_fcastNNN_'+(row+1)+'"]').val(), "novFcast" : $('input[id="nov_fcastNNN_'+(row+1)+'"]').val(), "decFcast" : $('input[id="dec_fcastNNN_'+(row+1)+'"]').val(), "totalSalesTargetFcast" : $('input[id="totalSalesTarget_fcastNNN_'+(row+1)+'"]').val(), "lastRollingForecastFcast" : $('input[id="lastRollingForecast_fcastNNN_'+(row+1)+'"]').val(), "totalForecastFcast" : $('input[id="totalForecast_fcastNNN_'+(row+1)+'"]').val(), "varientFcast" : $('input[id="varient_fcastNNN_'+(row+1)+'"]').val(),
            "ytdFcast" : $('input[id="ytd_fcastNNN_'+(row+1)+'"]').val(), "yearToGoFcast" : $('input[id="yearToGo_fcastNNN_'+(row+1)+'"]').val(),
            "financialPlanFcast" : $('input[id="financialPlan_fcastNNN_'+(row+1)+'"]').val(), "janFocs" : $('input[id="jan_focsNNN_'+(row+1)+'"]').val(),
            "febFocs" : $('input[id="feb_focsNNN_'+(row+1)+'"]').val(), "marFocs" : $('input[id="mar_focsNNN_'+(row+1)+'"]').val(), "aprFocs" : $('input[id="apr_focsNNN_'+(row+1)+'"]').val(), "mayFocs" : $('input[id="may_focsNNN_'+(row+1)+'"]').val(), "junFocs" : $('input[id="jun_focsNNN_'+(row+1)+'"]').val(), "julFocs" : $('input[id="jul_focsNNN_'+(row+1)+'"]').val(), "augFocs" : $('input[id="aug_focsNNN_'+(row+1)+'"]').val(), "sepFocs" : $('input[id="sep_focsNNN_'+(row+1)+'"]').val(), "octFocs" : $('input[id="oct_focsNNN_'+(row+1)+'"]').val(), "novFocs" : $('input[id="nov_focsNNN_'+(row+1)+'"]').val(), "decFocs" : $('input[id="dec_focsNNN_'+(row+1)+'"]').val(), "totalSalesTargetFocs" : $('input[id="totalSalesTarget_focsNNN_'+(row+1)+'"]').val(), "lastRollingForecastFocs" : $('input[id="lastRollingForecast_focsNNN_'+(row+1)+'"]').val(), "totalForecastFocs" : $('input[id="totalForecast_focsNNN_'+(row+1)+'"]').val(), "varientFocs" : $('input[id="varient_focsNNN_'+(row+1)+'"]').val(), "ytdFocs" : $('input[id="ytd_focsNNN_'+(row+1)+'"]').val(), "yearToGoFocs" : $('input[id="yearToGo_focsNNN_'+(row+1)+'"]').val(), "financialPlanFocs" : $('input[id="financialPlan_focsNNN_'+(row+1)+'"]').val() }
     } else if ($('#itemNNNN_'+(row+1)+'').val() !== undefined && $('#itemNNNN_'+(row+1)+'').val() !== "0" && argOne==='nextThreeSampleTbl') {
        TableData[row] = { "customerName" : $('input[id="customerNameNNNN_'+(row+1)+'"]').val(), "countryId" : "'"+$('input[id="countryNNNN_'+(row+1)+'"]').val()+"'",
            "type" : "'"+$('[id="typeNNNN_'+(row+1)+'"]').val()+"'", "busSelector" : "'"+$('[id="busSelectorNNNN_'+(row+1)+'"]').val()+"'", "itemId" : $('[id="itemNNNN_'+(row+1)+'"]').val(), "brandId" : $('[id="brandNNNN_'+(row+1)+'"]').val(),  "janFcast" : $('input[id="jan_fcastNNNN_'+(row+1)+'"]').val(), "febFcast" : $('input[id="feb_fcastNNNN_'+(row+1)+'"]').val(), "marFcast" : $('input[id="mar_fcastNNNN_'+(row+1)+'"]').val(), "aprFcast" : $('input[id="apr_fcastNNNN_'+(row+1)+'"]').val(), "mayFcast" : $('input[id="may_fcastNNNN_'+(row+1)+'"]').val(), "junFcast" : $('input[id="jun_fcastNNNN_'+(row+1)+'"]').val(),
            "julFcast" : $('input[id="jul_fcastNNNN_'+(row+1)+'"]').val(), "augFcast" : $('input[id="aug_fcastNNNN_'+(row+1)+'"]').val(), "sepFcast" : $('input[id="sep_fcastNNNN_'+(row+1)+'"]').val(), "octFcast" : $('input[id="oct_fcastNNNN_'+(row+1)+'"]').val(), "novFcast" : $('input[id="nov_fcastNNNN_'+(row+1)+'"]').val(), "decFcast" : $('input[id="dec_fcastNNNN_'+(row+1)+'"]').val(), "totalSalesTargetFcast" : $('input[id="totalSalesTarget_fcastNNNN_'+(row+1)+'"]').val(), "lastRollingForecastFcast" : $('input[id="lastRollingForecast_fcastNNNN_'+(row+1)+'"]').val(), "totalForecastFcast" : $('input[id="totalForecast_fcastNNNN_'+(row+1)+'"]').val(), "varientFcast" : $('input[id="varient_fcastNNNN_'+(row+1)+'"]').val(), "ytdFcast" : $('input[id="ytd_fcastNNNN_'+(row+1)+'"]').val(), "yearToGoFcast" : $('input[id="yearToGo_fcastNNNN_'+(row+1)+'"]').val(), "financialPlanFcast" : $('input[id="financialPlan_fcastNNNN_'+(row+1)+'"]').val(), "janFocs" : $('input[id="jan_focsNNNN_'+(row+1)+'"]').val(), "febFocs" : $('input[id="feb_focsNNNN_'+(row+1)+'"]').val(), "marFocs" : $('input[id="mar_focsNNNN_'+(row+1)+'"]').val(), "aprFocs" : $('input[id="apr_focsNNNN_'+(row+1)+'"]').val(), "mayFocs" : $('input[id="may_focsNNNN_'+(row+1)+'"]').val(), "junFocs" : $('input[id="jun_focsNNNN_'+(row+1)+'"]').val(), "julFocs" : $('input[id="jul_focsNNNN_'+(row+1)+'"]').val(), "augFocs" : $('input[id="aug_focsNNNN_'+(row+1)+'"]').val(), "sepFocs" : $('input[id="sep_focsNNNN_'+(row+1)+'"]').val(), "octFocs" : $('input[id="oct_focsNNNN_'+(row+1)+'"]').val(), "novFocs" : $('input[id="nov_focsNNNN_'+(row+1)+'"]').val(), "decFocs" : $('input[id="dec_focsNNNN_'+(row+1)+'"]').val(), "totalSalesTargetFocs" : $('input[id="totalSalesTarget_focsNNNN_'+(row+1)+'"]').val(), "lastRollingForecastFocs" : $('input[id="lastRollingForecast_focsNNNN_'+(row+1)+'"]').val(), "totalForecastFocs" : $('input[id="totalForecast_focsNNNN_'+(row+1)+'"]').val(), "varientFocs" : $('input[id="varient_focsNNNN_'+(row+1)+'"]').val(), "ytdFocs" : $('input[id="ytd_focsNNNN_'+(row+1)+'"]').val(), "yearToGoFocs" : $('input[id="yearToGo_focsNNNN_'+(row+1)+'"]').val(), "financialPlanFocs" : $('input[id="financialPlan_focsNNNN_'+(row+1)+'"]').val() } 
     }
  });
  return TableData;
};

