<!DOCTYPE html>
<html lang="en">
    <head>
  <?php

    $setting = $db->get_row('settings');
  ?>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> <?php echo $setting['name'];?></title>
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:300,400,700" rel="stylesheet">
        <link href="<?php echo SITE_URL.'/assets/frontend/css/bootstrap.min.css';?>" rel="stylesheet">
        <link href="<?php echo SITE_URL.'/assets/frontend/css/style.css';?>" rel="stylesheet">
        <link href="<?php echo SITE_URL.'/assets/frontend/plugins/font-awesome/css/font-awesome.min.css';?>" rel="stylesheet">
       <link href="<?php echo SITE_URL.'/assets/frontend/css/demo/jquery-steps.min.css';?>" rel="stylesheet">
      </head>
    <body>
        <div id="container">

            <div class="boxed">
                <div id="content-container" style="padding-top: 15px;">
                   <div id="page-content">
                   <div class="center" style="text-align:center;">
                   <img  src="<?php echo SITE_URL.'/uploads/logo/'.$setting['logo'];?>"  width="200px;">
                  <div class="registration"> Log In to account ! <a href="<?php echo $link->link('login',frontend);?>"> <span class="text-primary"> Sign In </span> </a> </div>
                    </div>
                  <div class="row">
                     <div class="col-md-2"></div>
                            <div class="col-md-8">
                             <?php echo $display_msg;?>
                                <section class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Company Settings</h3>
                                    </div>
                                    <div class="panel-body">
                                         <form class="form-horizontal form-bordered" action="" id="wizard-validate" method="post"  >
                                            <div class="wizard-title"> Registration </div>
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-sign-in"></i> Login Details </h4>
                                                         <p class="text-muted"> Enter Your Login Details </p>
                                                    </div>
                                                </div>
                                               <div class="form-group">
                                                    <label class="col-sm-2 control-label"> Email Address <span class="text-danger">*</span>: </label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="email" type="email" placeholder="Type your Email" data-parsley-group="order" data-parsley-required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label"> Password <span class="text-danger">*</span>: </label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="password" type="password" id="passwordinput" placeholder="Type your password" data-parsley-minlength="6" data-parsley-group="order" data-parsley-required />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label"> Re-Password <span class="text-danger">*</span>: </label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="repassword" type="password" placeholder="Type your password" data-parsley-equalto="#passwordinput" data-parsley-group="order" data-parsley-required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wizard-title"> General information </div>
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-user"></i> General information </h4>
                                                        <p class="text-muted"> General Information About Applicant </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>First Name: <span class="text-danger">*</span> </label>
                                                            <input type="text" name="emp_name" class="form-control" placeholder="First Name" data-parsley-group="information" data-parsley-required />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Last Name: <span class="text-danger">*</span> </label>
                                                            <input type="text" name="emp_surname" class="form-control" placeholder="Last Name" data-parsley-group="information" data-parsley-required />
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Phone #:</label>
                                                            <input type="text" placeholder="+99-99-9999-9999" name="contact1" class="form-control" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Date of birth:</label>
                                                            <input type="text" placeholder="99/99/9999" name="dob"  class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                <div class="col-md-6">
                                                 <label>Personal Address: </label>
                                                 <textarea class="form-control" name="address" placeholder="Enter your address " ></textarea>
                                                 </div>
                                                 </div>
                                                 <div class="form-group">
                                                <br>
                                               <strong style="padding-left: 19px;"> Location Settings</strong>
                                                    <div class="row">

                                                          <div class="col-md-6">
                                                            <label> Country: </label>
                                                           <select class="form-control selectpicker" name="country">
						                            <?php $country=$feature->getcountry_list();?>
												    <option value="">Select a country ... </option>
												    <?php if(is_array($country))foreach($country as $key=>$value){?>
												    <option value="<?php echo $key;?>" <?php if($key==$settings['country']) echo "selected";?> ><?php echo $value;?></option>
												<?php }?>
                                                    </select>
                                                        </div>
                                                          <div class="col-md-6">
                                                            <label>State:</label>
                                                            <input type="text" placeholder="Enter State" name="state" class="form-control" />
                                                        </div>

                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <div class="row">
                                                          <div class="col-md-6">
                                                            <label>City:</label>
                                                            <input type="text" placeholder="Enter City" name="city" class="form-control" />
                                                        </div>
                                                          <div class="col-md-6">
                                                            <label>Zip:</label>
                                                            <input type="text" placeholder="Enter Zip" name="zip" class="form-control" />
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                             <div class="wizard-title"> Company Profile </div>
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-book"></i> Company Profile </h4>
                                                        <p class="text-muted"> Information About Company </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Company Name <span class="text-danger">*</span> : </label>
                                                            <input type="text" name="company_name" class="form-control" placeholder="Enter your Company name *" data-parsley-group="payment" data-parsley-required />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label> Company Email <span class="text-danger">*</span> : </label>
                                                            <input type="email" name="c_email" class="form-control" placeholder="Enter your Company email *" data-parsley-group="payment" data-parsley-required />
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Company Website: </label>
                                                            <input type="text" name="company_website" class="form-control" placeholder="Enter your Company website " />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label> Company Address: </label>
                                                            <input type="text" name="company_address" class="form-control" placeholder="Enter your Company Address " />
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Company Phone #:</label>
                                                            <input type="text" placeholder="+99-99-9999-9999" name="telephone1" class="form-control" />
                                                        </div>
                                                         <div class="col-md-6">
                                                            <label>Company Currency <span class="text-danger">*</span> : </label>
                                                            <input type="text" placeholder="Enter Company Currency" name="company_currencysymbol" class="form-control" data-parsley-group="payment" data-parsley-required/>
                                                         </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                <div class="col-md-6">
                                                            <label> Date Format: </label>

                                                            <select class="form-control selectpicker" name="date_format" id="dateformat" data-parsley-group="payment" data-parsley-required>
											              <option value="1">DD/MM/YY</option>
											              <option value="2">MM/DD/YY</option>
											              <option value="3">Day-Month-Year(29th-may-1985)</option>
											              </select>
                                                       </div>
                                                       <div class="col-md-6">
                                                              <label >Timezone <span class="text-danger"></span>: </label>
                                                           <select class="form-control selectpicker" name="timezone">
								                            <?php
															$timezones=$feature->get_timezones();
															if(is_array($timezones)) foreach ($timezones as $key=>$value){?>
													                  <option value="<?php echo $value['zone'];?>" <?php if($company_details['timezone']==$value['zone'])echo "selected";?>><?php echo $value['zone']." ( ".$value['diff_from_GMT']." )";?></option>
													                  <?php }?>
                                                    </select>
                                                        </div>
                                                      </div>
                                                </div>
                           <br>
                            <div id="after_post_message"></div>
                                            </div>

                                        </form>

                                    </div>
                                </section>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                 </div>
              </div>

        </div>
        <script src="<?php echo SITE_URL.'/assets/frontend/js/jquery-2.1.1.min.js';?>"></script>
        <script src="<?php echo SITE_URL.'/assets/frontend/plugins/parsley/parsley.min.js';?>"></script>
      <script src="<?php echo SITE_URL.'/assets/frontend/plugins/masked-input/bootstrap-inputmask.min.js';?>"></script>
         <script src="<?php echo SITE_URL.'/assets/frontend/plugins/jquery-steps/jquery-steps.min.js';?>"></script>
 <script>
$(document).ready(function() {

    $("#wizard-validate").steps({
        headerTag: ".wizard-title",
        bodyTag: ".wizard-container",
        transitionEffect: "fade",
        onStepChanging: function(event, currentIndex, newIndex) {

            if (currentIndex > newIndex) {
                return true;
            }




            if ((currentIndex === 0)) {
                return $(this).parsley().validate("order");

            }


            if ((currentIndex === 1)) {
                return $(this).parsley().validate("information");
            }


            if ((currentIndex === 2)) {
                return $(this).parsley().validate("payment");
            }


            if ((currentIndex === 2)) {
                return $(this).parsley().validate("experience");
            }

        },
        onStepChanged: function(event, currentIndex, priorIndex) {

            if (currentIndex === 2 && Number($("#age-2").val()) >= 18) {
                $("#form-3").steps("next");
            }


            if (currentIndex === 2 && priorIndex === 3) {
                $("#form-3").steps("previous");
            }
        },
        onFinishing: function(event, currentIndex, newIndex) {

            return $(this).parsley().validate();
        },
        onFinished: function() {

        	  $.post("<?php echo $link->link('wizardpost');?>", $( "#wizard-validate" ).serialize(),
        		       function(data) {
                     $("#after_post_message").html(data);

             });
        }
    });
});

</script>
       <script src="<?php echo SITE_URL.'/assets/frontend/js/form-wizard.js';?>"></script>
    </body>
</html>