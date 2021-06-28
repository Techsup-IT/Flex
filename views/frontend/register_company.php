<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    // $setting = $db->get_row('settings');
    if ($db->exists('company', array('id' => 1))) {
        $setting = $db->get_row('company', array('id' => 1));
    } else {
        $setting = $db->get_row('settings');
    }

    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if ($db->exists('company', array('id' => 1))) { ?>
            <?php echo $setting['company_name']; ?>
        <?php } else { ?>
            <?php echo $setting['name']; ?>
        <?php } ?>
    </title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:300,400,700" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/css/style.css'; ?>" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/plugins/font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/css/demo/jquery-steps.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/plugins/bootstrap-datepicker/bootstrap-datepicker.css'; ?>" rel="stylesheet">
</head>

<body>
    <div id="container">

        <div class="boxed">
            <div id="content-container" style="padding-top: 15px;">
                <div id="page-content">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <?php echo $display_msg; ?>
                            <div class="eq-height">
                                <div class="col-sm-12 eq-box-sm">
                                    <div class="panel">
                                        <div>
                                            <div class="center" style="text-align:center;">
                                                <!-- <img src="<?php echo SITE_URL . '/uploads/logo/' . $setting['logo']; ?>" width="200px;"> -->
                                                <?php if ($db->exists('company', array('id' => 1))) {
                                                    if ($setting['logo'] == '') {
                                                ?>
                                                        <img src="<?php echo SITE_URL . '/uploads/noimage.png'; ?>" width="150px;">
                                                    <?php } else { ?>
                                                        <img src="<?php echo SITE_URL . '/uploads/logo/company_logo/' . $setting['logo']; ?>" width="200px;" />

                                                    <?php }
                                                } else { ?>
                                                    <!-- <img  src="<?php echo SITE_URL . '/uploads/logo/' . $setting['logo']; ?>" class="img-circle"/> -->
                                                    <img src="<?php echo SITE_URL . '/uploads/logo/' . $setting['logo']; ?>" width="200px;" />
                                                <?php } ?>
                                                <div class="registration"> Log In to account ! <a href="<?php echo $link->link('login', frontend); ?>"> <span class="text-primary"> Sign In </span> </a> </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="panel-heading">
                                            <h3 class="panel-title text-center">Register Company</h3>
                                        </div>
                                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="wizard-validate">
                                            <div class="wizard-title"> <?php echo $lang['registration']; ?> </div>
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <h4 class="text-primary"> <i class="fa fa-sign-in"></i> <?php echo $lang['login_details']; ?> </h4>
                                                    <p class="text-muted"> <?php echo $lang['enter_login_details']; ?> </p>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"> <?php echo $lang['email_address']; ?> <span class="text-danger">*</span>: </label>
                                                    <input class="form-control" name="email" type="email" placeholder="<?php echo $lang['type_your_email']; ?>" data-parsley-group="order" data-parsley-required />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"> <?php echo $lang['password']; ?> <span class="text-danger">*</span>: </label>
                                                    <input class="form-control" name="password" type="password" id="passwordinput" placeholder="<?php echo $lang['type_your_password']; ?>" data-parsley-minlength="6" data-parsley-group="order" data-parsley-required data-parsley-pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,30}$" data-parsley-pattern-message="Passwords are 6-16 characters with uppercase letters, lowercase letters and at least one number and symbol." />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"> <?php echo $lang['re_password']; ?> <span class="text-danger">*</span>: </label>
                                                    <input class="form-control" name="repassword" type="password" placeholder="<?php echo $lang['type_your_password']; ?>" data-parsley-equalto="#passwordinput" data-parsley-group="order" data-parsley-required />
                                                </div>
                                            </div>
                                            <div class="wizard-title"> <?php echo $lang['general_information']; ?> </div>
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-user"></i> <?php echo $lang['general_information']; ?> </h4>
                                                        <p class="text-muted"> <?php echo $lang['general_information_about_applicant']; ?> </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['first_name']; ?>: <span class="text-danger">*</span> </label>
                                                            <input type="text" name="emp_name" class="form-control" placeholder="<?php echo $lang['first_name']; ?>" data-parsley-group="information" data-parsley-required />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['last_name']; ?>: <span class="text-danger">*</span> </label>
                                                            <input type="text" name="emp_surname" class="form-control" placeholder="<?php echo $lang['last_name']; ?>" data-parsley-group="information" data-parsley-required />
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['phone']; ?> #:</label>
                                                            <input type="text" placeholder="+99-99-9999-9999" name="contact1" class="form-control" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['date_of_birth']; ?>:</label>
                                                            <input type="text" placeholder="yyyy-mm-dd" name="dob" class="form-control birthdate" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-12 col-md-6">
                                                            <label><?php echo $lang['personal_address']; ?>: </label>
                                                            <textarea class="form-control" name="address" placeholder="<?php echo $lang['enter_your_address']; ?>"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <strong> <?php echo $lang['location_setting']; ?></strong>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <label> <?php echo $lang['country']; ?>: </label>
                                                            <select class="form-control selectpicker" name="country">
                                                                <?php $country = $feature->getcountry_list(); ?>
                                                                <option value=""><?php echo $lang['select_a_country']; ?></option>
                                                                <?php if (is_array($country)) foreach ($country as $key => $value) { ?>
                                                                    <!-- <option value="<?php echo $key; ?>" <?php if ($key == $settings['country']) echo "selected"; ?> ><?php echo $value; ?></option> -->
                                                                    <option value="<?php echo $key; ?>" <?php if ($key == 'SA') echo "selected"; ?>><?php echo $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['state']; ?>:</label>
                                                            <input type="text" placeholder="<?php echo $lang['enter_state']; ?>" name="state" class="form-control" />
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['city']; ?>:</label>
                                                            <input type="text" placeholder="<?php echo $lang['enter_city']; ?>" name="city" class="form-control" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['zip']; ?>:</label>
                                                            <input type="text" placeholder="<?php echo $lang['enter_zip']; ?>" name="zip" class="form-control" />
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wizard-title"> <?php echo $lang['company_profile']; ?> </div>
                                            <div class="wizard-container">
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <h4 class="text-primary"> <i class="fa fa-book"></i> <?php echo $lang['company_profile']; ?> </h4>
                                                        <p class="text-muted"> <?php echo $lang['information_about_company']; ?> </p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['company_name']; ?> <span class="text-danger">*</span> : </label>
                                                            <input type="text" name="company_name" class="form-control" placeholder="<?php echo $lang['enter_your_company_name']; ?> *" data-parsley-group="payment" data-parsley-required />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label> <?php echo $lang['company_email']; ?> <span class="text-danger">*</span> : </label>
                                                            <input type="email" name="c_email" class="form-control" placeholder="<?php echo $lang['enter_your_company_email']; ?> *" data-parsley-group="payment" data-parsley-required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['company_website']; ?>: </label>
                                                            <input type="text" name="company_website" class="form-control" placeholder="<?php echo $lang['enter_your_company_website']; ?> " />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label> <?php echo $lang['company_address']; ?>: </label>
                                                            <input type="text" name="company_address" class="form-control" placeholder="<?php echo $lang['enter_your_company_address']; ?> " />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['company_phone']; ?> #:</label>
                                                            <input type="text" placeholder="+99-99-9999-9999" name="telephone1" class="form-control" />
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['company_currency']; ?> <span class="text-danger">*</span> : </label>
                                                            <input type="text" placeholder="<?php echo $lang['enter_your_company_currency']; ?>" name="company_currencysymbol" class="form-control" value="SR" data-parsley-group="payment" data-parsley-required />
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6 hidden">
                                                            <label> <?php echo $lang['date_format']; ?>: </label>

                                                            <select class="form-control selectpicker" name="date_format" id="dateformat" data-parsley-group="payment" data-parsley-required>
                                                                <option value="1">DD/MM/YY</option>
                                                                <option value="2">MM/DD/YY</option>
                                                                <option value="3">Day-Month-Year(29th-may-1985)</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label><?php echo $lang['timezone']; ?> <span class="text-danger"></span>: </label>
                                                            <select class="form-control selectpicker" name="timezone">
                                                                <?php
                                                                $timezones = $feature->get_timezones();
                                                                if (is_array($timezones)) foreach ($timezones as $key => $value) { ?>
                                                                    <!-- <option value="<?php echo $value['zone']; ?>" <?php if ($company_details['timezone'] == $value['zone']) echo "selected"; ?>><?php echo $value['zone'] . " ( " . $value['diff_from_GMT'] . " )"; ?></option> -->
                                                                    <option value="<?php echo $value['zone']; ?>" <?php if ($value['zone'] == 'Asia/Riyadh') echo "selected"; ?>><?php echo $value['zone'] . " ( " . $value['diff_from_GMT'] . " )"; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="control-label"><?php echo $lang['number_of_teleworkers']; ?> </label>
                                                            <input type="number" name="currently_allowed_employee" class="form-control" value="1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                echo file_get_contents(SERVER_ROOT . '/protected/views/frontend/privacy_template.php');
                                                ?>
                                                <hr>

                                                <div class="form-group">
                                                    <div class="text-left privacy_checkbox_container row">
                                                        <input name="privacy_checkbox" type="checkbox" value="1" class="form-control privacy_checkbox col-md-1" style="width: auto !important; height: auto; margin-left: 10px;" required />
                                                        <span class="col-md-11"><?php echo $lang['privacy_policy']; ?></span>
                                                    </div>
                                                </div>

                                                <br>
                                                <div id="after_post_message"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="<?php echo SITE_URL . '/assets/frontend/js/jquery-2.1.1.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/parsley/parsley.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/masked-input/bootstrap-inputmask.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/jquery-steps/jquery-steps.min.js'; ?>"></script>

    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/bootstrap-datepicker/bootstrap-datepicker.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/bootstrap-datepicker/moment.js'; ?>" type="text/javascript"></script>
    <script>
        // $(document).ready(function() {

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

                if (currentIndex === 2) {
                    $('#privacy_container').show();
                }
            },
            onFinishing: function(event, currentIndex, newIndex) {
                return $(this).parsley().validate();
            },
            onFinished: function() {

                $.post("<?php echo $link->link('register_company'); ?>", $("#wizard-validate").serialize(),
                    function(data) {
                        $("#after_post_message").html(data);

                    });
            }
        });
        // });

        $('.birthdate').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            endDate: '+0d',
            todayHighlight: true,
            startView: 2
        });
    </script>
    <!-- <script src="<?php echo SITE_URL . '/assets/frontend/js/form-wizard.js'; ?>"></script> -->
</body>

</html>