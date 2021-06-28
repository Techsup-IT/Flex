<!DOCTYPE html>
<html lang="en">

<head>
    <?php
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
    <link href="<?php echo SITE_URL . '/assets/frontend/plugins/chosen/chosen.min.css'; ?>" rel="stylesheet">
    <!-- custom css -->
    <link href="<?php echo SITE_URL . '/assets/frontend/css/custom.css'; ?>" rel="stylesheet">
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
                                            <hr>
                                        </div>
                                        <div class="panel-heading">
                                            <h3 class="panel-title text-center">Freelancer Registration</h3>
                                        </div>
                                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="addUserFrom">
                                            <input type="hidden" name="profilesize" id="profilesize">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-5">

                                                        <div class="form-group hidden">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['IdNumber']; ?></label>
                                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_IdNumber']; ?> *" name="IdNumber" required="required">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['EstLaborOfficeId']; ?></label>
                                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_EstLaborOfficId']; ?> *" name="EstLaborOfficeId" required="required">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['EstSequenceNumber']; ?></label>
                                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_EstSequenceNumber']; ?> *" name="EstSequenceNumber" required="required">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['first_name']; ?></label>
                                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_name']; ?> *" name="emp_name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['last_name']; ?></label>
                                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_surname']; ?>" name="emp_surname">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['email_id']; ?></label>
                                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_email_address']; ?> *" name="email">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['password']; ?></label>
                                                                <input class="form-control" type="password" placeholder="<?php echo $lang['enter_password']; ?> *" name="password">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['address']; ?></label>
                                                                <textarea class="form-control" name="address" placeholder="<?php echo $lang['enter_your_address']; ?>"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1"></div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="text-muted"><?php echo $lang['is_mol_TWC']; ?> </label>
                                                            <select name="is_molTWC" class="form-control" id="allowed">
                                                                <option value="0"><?php echo $lang['no']; ?></option>
                                                                <option value="1"><?php echo $lang['yes']; ?></option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['phone_number']; ?></label>
                                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_phone_number']; ?>" name="contact1">
                                                            </div>
                                                        </div>

                                                        <div class="form-group text-left">
                                                            <label><?php echo $lang['date_of_birth']; ?> * : </label>
                                                            <input type="text" placeholder="yyyy-mm-dd" name="dob" class="form-control birthdate" required />
                                                        </div>

                                                        <div class="form-group text-left">
                                                            <label><?php echo $lang['employee_national_number']; ?> * : </label>
                                                            <input type="text" placeholder="<?php echo $lang['employee_national_number']; ?>" name="employee_national_number" class="form-control" required />
                                                        </div>

                                                        <div class="form-group text-left">
                                                            <label><?php echo $lang['city']; ?> * : </label>
                                                            <select name="city_id" id="select_city" placeholder="<?= $lang['select_city']; ?>" class="form-control">
                                                                <option value=""><?= $lang['select_city'] ?></option>
                                                                <?php
                                                                $cities = array();
                                                                if (file_exists(SERVER_ROOT . '/uploads/cities.json')) {
                                                                    $cities = file_get_contents(SERVER_ROOT . '/uploads/cities.json');
                                                                }
                                                                $cities = json_decode($cities, true);
                                                                foreach ($cities as $city_id => $city) {
                                                                ?>
                                                                    <option value="<?= $city_id; ?>"><?= $city['Arabic_Name']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo $lang['upload_pic']; ?></label>
                                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <div class="fileupload-new img-thumbnail">
                                                                    <img src="<?php echo SITE_URL . '/uploads/noimage.png'; ?>" width="100%">
                                                                </div>
                                                                <div>
                                                                    <br>
                                                                    <input type="file" name="img" accept="image/*">
                                                                </div>
                                                                <small>Only jpg , png & jpeg (Max : <?php echo $upload_max_size; ?>)</small>
                                                            </div>
                                                        </div>

                                                        <!-- <hr> -->
                                                        <div class="form-group hidden">
                                                            <label class="control-label text-bold"><?php echo $lang['freelancer_company_details']; ?> </label>
                                                        </div>

                                                        <div class="form-group row hidden">
                                                            <div class="col-md-4"><label class="text-muted"><?php echo $lang['freelancer_type']; ?></label></div>
                                                            <div class="col-md-8">
                                                                <select name="freelancer_type" class="form-control " id="freelancer_type">
                                                                    <option value="1" selected><?php echo $lang['individual']; ?></option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>


                                                <?php
                                                echo file_get_contents(SERVER_ROOT . '/protected/views/frontend/privacy_template.php');
                                                ?>
                                                <hr>

                                                <div class="text-left privacy_checkbox_container row">
                                                    <input name="privacy_checkbox" type="checkbox" value="1" class="form-control privacy_checkbox col-md-1" style="width: auto !important; height: auto; margin-right: 10px;" required />
                                                    <span class="col-md-11"><?php echo $lang['privacy_policy']; ?></span>
                                                </div>
                                            </div>

                                            <div class="panel-footer text-center">
                                                <button class="btn btn-success register_button" type="submit" name="submit_freelancer" disabled><i class="fa fa-save"></i> Register</button>

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
    <script src="<?php echo SITE_URL . '/assets/frontend/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/chosen/chosen.jquery.min.js'; ?>"></script>
    <!-- jQuery-Vaildation -->
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/jquery-validation/jquery.validate.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/jquery-validation/additional-methods.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/js/form-validation.js'; ?>"></script>

    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/bootstrap-datepicker/bootstrap-datepicker.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/bootstrap-datepicker/moment.js'; ?>" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('#select_city').chosen();

            $('#privacy_container').show();
            $('.privacy_checkbox').click(function() {
                $(".register_button").attr('disabled', 'disabled');
                if ($(this).is(":checked")) {
                    $(".register_button").removeAttr('disabled');
                }
            });

            $('.birthdate').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                endDate: '+0d',
                todayHighlight: true,
                startView: 2
            });
        });
    </script>

</body>

</html>