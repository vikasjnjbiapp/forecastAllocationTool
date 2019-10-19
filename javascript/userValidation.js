/*JavaScript - Validation*/
$('[id^=custNum]').keypress(function (event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode==44) {
        return false;        
    } else {
    	return true;        
    }
});
$('[id^=pass]').keypress(function (event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 188) {
        return false;        
    }
});

$('#custNum').on('keyup', function(){
  if($(this).val().length < 4){
    $('#custNum').css({'border': '2px dotted red', 'color': 'red'});
    $('#loginUser').attr({'disabled': 'disabled', 'style': {'color': 'red'}});
    // $('#loginUser').css({'disabled': 'disabled', 'color': 'red'});  
  } else {
    $('#custNum').css({'border': '1px solid #ced4da', 'color': 'black'});
    $('#loginUser').removeAttr('disabled');
  }    
});
$('#pass').on('keyup', function(event){
    console.log("Vikas "+ event.keyCode);
  if(event.keyCode === 188 || event.keyCode === 32 || event.keyCode === 191 || (event.keyCode > 64 && 90 < event.keyCode)) {
    $('#pass').css({'border': '2px dotted red', 'color': 'red'});
    $('#loginUser').attr({'disabled': 'disabled'});
  } else {
    $('#pass').css({'border': '1px solid #ced4da', 'color': 'black'});
    $('#loginUser').removeAttr('disabled');
  }
});
