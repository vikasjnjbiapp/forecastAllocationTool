<?php
$commonMethod = new commonMethodFile();
$condition = 'userRole = 0';
$checkValue = $commonMethod->checkAndFetchSingleRecord('jnj_registration', 'id', $condition);
?>
<!--The content below is only a placeholder and can be replaced.-->
<div class="bs-example">
    <form id="registrationForm">
        <div class="col">
            <div class="col-sm-4">
                <div class="input-group">
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
                            <span class="fa fa-key"></span>
                        </span>                    
                    </div>
                    <input type="password" class="form-control" placeholder="Confirm Password" value="" id="confpass" name="confpass">
                </div>
            </div><br/>
            <div class="col-sm-4">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-envelope"></span>
                        </span>                    
                    </div>
                    <input type="text" class="form-control" placeholder="Email" value="" id="email" name="email">
                </div>
            </div><br/>
            <div class="col-sm-4">
                <div class="input-group">            
                   <div class="input-group-prepend">
                        <span class="input-group-text">
                            <span class="fa fa-address-book"></span>
                        </span>                    
                    </div>
                    <!-- input type="text" class="form-control" placeholder="Country" -->
                    <select class="form-control" id="country" name="country" placeholder="Select Country">
                      <?php                         
                         $array = $commonMethod->fetchTableValue('jnj_country', '*');
                         foreach($array as $key => $val) {
                      ?>
                        <option value="<?php echo $val['id'];?>"><?php echo $val['countryCode'].'-'.$val['countryName'];?></option>
                      <?php } ?>
                    </select>
                </div>
            </div><br/>
        </div>
        <div class="row">
            <div class="col-md-4 text-right">
                <button type="button" class="btn btn-primary" id="registerUser">Submit</button>
            </div>
        </div>
    </form>
<script>
    $(document).ready(function() {
        let currentYear = (new Date).getFullYear();
        let currentMonth = (new Date).getMonth() + 1;
        $('#yearValue').val(currentYear);
        $('#monthValue').val(currentMonth);
        $('#registerUser').click(function() {
           $.post('router.php', {arrayData: $( "#registrationForm" ).serializeArray(), page: 'register'}, function(data) {
              if(data > 0) {
                  alert('User register successfully'+data);
                 window.location.href = 'http://localhost/Site/jnj_bi_project/?<?php echo base64_encode('login'); ?>';
              } else {
                  alert('Something went worng.'+data);
                 window.location.href = 'http://localhost/Site/jnj_bi_project/?<?php echo base64_encode('home'); ?>';
              }
           });
        });
    });
</script>
</div>
