<!-- Login page -->
<div class="bs-example">
    <form id="loginForm">
        <div class="col">
            <div class="col-sm-4">
                <div class="input-group" id="cusNumError">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-user"></span>
                        </span>                    
                    </div>
                    <input type="text" class="form-control" placeholder="Custmor Number" value="" id="custNum" name="custNum">
                </div>
            </div><br/>
            <div class="col-sm-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-key"></span>
                        </span>                    
                    </div>
                    <input type="password" class="form-control" placeholder="Password" value="" id="pass" name="pass">
                </div>
            </div><br/>
            <div class="col-sm-4">
                <div class="input-group">            
                   <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-level-up"></span>
                        </span>                    
                    </div>
                    <!-- input type="text" class="form-control" placeholder="Country" -->
                    <select class="form-control" id="authlevel" name="authlevel" placeholder="Select Level">
                        <option value="0">Super Admin</option>
                        <option value="1">KAMs</option>
                        <option value="2">CVTL</option>
                        <option value="3" selected>TALs/CL</option>
                    </select>
                </div>
            </div><br/>
        </div>
        <div class="row">
            <div class="col-md-4 text-right">
                <button type="button" class="btn btn-primary" id="loginUser">Submit</button>
            </div>
        </div>
    </form>
    <script src="javascript/userValidation.js"></script>
    <script>
    $(document).ready(function() {
        $('#loginUser').click(function() {
           if(($('#custNum').val() !== "") && $('#pass').val() !== "") {
               $.post('router.php', {arrayData: $( "#loginForm" ).serializeArray(), page: 'login'}, function(data) {
                  if(data) {
                      console.log(data);
                      let checkUserRole = data.split(','); 
                      if(parseInt(checkUserRole[1]) === 0) {
                         alert('Super Admin sucessfully login.');
                         window.location.href = 'http://localhost/Site/jnj_bi_project/?<?php echo base64_encode('dashboard'); ?>';    
                      } else if(parseInt(checkUserRole[1]) < 4 && parseInt(checkUserRole[1]) > 0) {
                         alert('KAMs/CVTL/TALs sucessfully login.');
                         window.location.href = 'http://localhost/Site/jnj_bi_project/?<?php echo base64_encode('dashboard'); ?>';  
                      } else {
                         alert('User did not enter proper details.');
                         window.location.href = 'http://localhost/Site/jnj_bi_project/?<?php echo base64_encode('home'); ?>';  
                      }                  
                  } else {
                      alert('Somthing went wrong in login'+data);
                      window.location.href = 'http://localhost/Site/jnj_bi_project/?<?php echo base64_encode('login'); ?>';
                  }                
               });
           } else {
              $('#custNum').css({'border': '2px dotted red', 'color': 'red'});
              $('#pass').css({'border': '1px dotted red', 'color': 'red'});   
           }
        });
    });
</script>
</div>
