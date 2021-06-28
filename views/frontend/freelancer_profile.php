<div id="content-container">
    <div class="pageheader">
        <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-01.png'; ?>" style="width:40px;height:40px;margin:0 10px;" alt="Home Picture"></i> <?php echo $lang['your_profile']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <!--<li> <a href="<?php echo ($_SESSION['department'] == 2) ? '#' :  $link->link('home', frontend); ?>"> <?php echo $lang['dashboard']; ?> </a> </li>-->
                <li> <a href="<?php echo ($_SESSION['department'] == 2) ? '#' :  '#' ?>"> <?php echo $lang['dashboard']; ?> </a> </li>
                <li class="active"><?php echo $lang['your_profile']; ?></li>
            </ol>
        </div>
    </div>
    <div id="page-content">
        <div class="row">
            <?php echo $display_msg; ?>
            <div class="">
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-control">
                            <button class="btn btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></button>
                            <button class="btn btn-default" data-click="panel-reload"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-default" data-click="panel-collapse"><i class="fa fa-chevron-down"></i></button>
                            <button class="btn btn-default" data-dismiss="panel"><i class="fa fa-times"></i></button>
                        </div>
                        <h3 class="panel-title"><?php echo $lang['update_your_profile_details']; ?></h3>
                    </div>
                    <div class="panel-body pad-no12">
                        <div class="tab-base">
                            <ul class="nav nav-tabs freelancer_profile_tab">
                                <li class="<?php if ($current_tab == 'tab1' || $current_tab == '') {
                                                echo "active";
                                            } ?>"><a data-toggle="tab" href="#tab1"><?php echo $lang['personal_information']; ?></a> </li>
                                <li class="<?php if ($current_tab == 'tab2') {
                                                echo "active";
                                            } ?>"> <a data-toggle="tab" href="#tab2"><?php echo $lang['cv']; ?></a> </li>
                                <li class="<?php if ($current_tab == 'tab3') {
                                                echo "active";
                                            } ?>"> <a data-toggle="tab" href="#tab3"><?php echo $lang['contract_info']; ?></a> </li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab1" class="tab-pane fade  <?php if ($current_tab == 'tab1'  || $current_tab == '') {
                                                                            echo "active in";
                                                                        } ?>">
                                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="profileForm">
                                        <input type="hidden" name="profilesize" id="profilesize">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['email']; ?></label>
                                                        <input class="form-control" name="username" disabled type="text" value="<?php echo $_SESSION['email']; ?>">
                                                        <br>
                                                        <label><?php echo $lang['profile_email_instruction']; ?></label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['first_name']; ?></label>
                                                        <input class="form-control" name="f_name" type="text" value="<?php echo $user_details['emp_name']; ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['last_name']; ?></label>
                                                        <input class="form-control" name="l_name" type="text" value="<?php echo $user_details['emp_surname']; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['phone']; ?></label>
                                                        <input class="form-control" placeholder="+99-99-9999-9999" name="contact1" type="text" value="<?php echo $user_details['contact1']; ?>">
                                                    </div>

                                                    <!--New edits 11 April 2021 - add three filds in freelancer page -->
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['IdNumber']; ?></label>
                                                        <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_IdNumber']; ?> *" name="IdNumber" value="<?php echo $user_details['IdNumber']; ?>" required="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['EstLaborOfficeId']; ?></label>
                                                        <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_EstLaborOfficId']; ?> *" name="EstLaborOfficeId" value="<?php echo $user_details['EstLaborOfficeId']; ?>" required="required">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['EstSequenceNumber']; ?></label>
                                                        <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_EstSequenceNumber']; ?> *" name="EstSequenceNumber" value="<?php echo $user_details['EstSequenceNumber']; ?>" required="required">
                                                    </div>


                                                </div>
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-5">
                                                    <!--New edits 11 April 2021 - add three filds in freelancer page -->
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['address']; ?></label>
                                                        <textarea class="form-control" name="address" placeholder="<?php echo $lang['enter_your_address']; ?>"><?php echo $user_details['address']; ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['date_of_birth']; ?> * : </label>
                                                        <input class="form-control birthdate" placeholder="yyyy-mm-dd" name="dob" type="text" value="<?php echo $user_details['dob']; ?>" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['employee_national_number']; ?> * : </label>
                                                        <input class="form-control" placeholder="<?php echo $lang['employee_national_number']; ?>" name="employee_national_number" type="text" value="<?php echo $user_details['employee_national_number']; ?>" required />
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['city']; ?> * : </label>
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
                                                                <option value="<?= $city_id; ?>" <?php if ($city_id == $user_details['city_id']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?= $city['Arabic_Name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['upload_pic']; ?></label>
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-new img-thumbnail">
                                                                <?php
                                                                if (file_exists(SERVER_ROOT . '/uploads/profile/' . $user_details['emp_photo_file']) && (($user_details['emp_photo_file']) != '')) { ?>
                                                                    <img src="<?php echo SITE_URL . '/uploads/profile/' . $user_details['emp_photo_file']; ?>" style="width:200px;">
                                                                <?php } else { ?>
                                                                    <img src="<?php echo SITE_URL . '/uploads/noimage.png'; ?>" style="width:200px;">
                                                                <?php } ?>
                                                            </div>
                                                            <div>
                                                                <br>
                                                                <input type="file" name="profilepic" accept="image/*">
                                                                <br> <small>Only jpeg, png & jpeg (Max : <?php echo $upload_max_size; ?>)</small>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-center">
                                            <button class="btn btn-success" type="submit" name="submit_profile"><i class="fa fa-save"></i> <?php echo $lang['update']; ?></button>
                                        </div>
                                    </form>
                                </div>
                                <div id="tab2" class="tab-pane fade <?php if ($current_tab == 'tab2') {
                                                                        echo "active in";
                                                                    } ?>">
                                    <form method="post" action="<?php $link->link("freelancer_profile", frontend, '&edit=' . $load . '&tab=' . $current_tab); ?>" enctype="multipart/form-data" id="cv_form">
                                        <input type="hidden" name="current_tab" value="tab2">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['major']; ?></label>
                                                            <select name="major" id="major_select" class="form-control" required>
                                                                <option value="">Select your Speciality</option>
                                                                <?php
                                                                foreach ($specialities as $specialityID => $speciality) {
                                                                ?>
                                                                    <option value="<?= $specialityID; ?>" <?php if ($specialityID == $freelancer_data['major']) {
                                                                                                                echo "selected";
                                                                                                            } ?>><?= $speciality[$_SESSION['site_lang'] . '_Title']; ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                                <option value="Other" <?php if ($freelancer_data['major'] === 'Other') {
                                                                                            echo "selected";
                                                                                        } ?>>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <input id="other_major" placeholder="Enter you Speciality" class="form-control" type="text" value="<?= $freelancer_data['other_major']; ?>" name="other_major" <?php if ($freelancer_data['major'] !== 'Other') {
                                                                                                                                                                                                                                echo 'style="display: none;"';
                                                                                                                                                                                                                            } ?>>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['skills']; ?></label>
                                                            <textarea name="skills" id="skills" rows="5" class="form-control"><?= $freelancer_data['skills'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['upload_cert']; ?></label>
                                                            <input type="file" name="upload_cert" id="upload_cert" class="form-control" accept="application/pdf">
                                                            <input type="hidden" name="certificate" value="<?= $freelancer_data['certificate']; ?>">
                                                            <br> <small>Only pdf (Max : <?php echo $upload_max_size; ?>)</small>
                                                        </div>
                                                        <span class="btn btn-info">
                                                            <a href="<?php echo SITE_URL; ?>/uploads/certificates/<?= $freelancer_data['certificate'] ?>" target="_blank"><?= $freelancer_data['certificate'] ?></a>
                                                        </span>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="text-left work_exp_container">
                                                            <div class="col-md-5"><label class="text-muted"><?php echo $lang['work_exp']; ?></label></div>
                                                            <?php
                                                            if (is_array($freelancer_work_exp) && count($freelancer_work_exp) > 0) {
                                                                $count = 1;
                                                                foreach ($freelancer_work_exp as $exp_details) {
                                                            ?>
                                                                    <div class="col-md-12 single_exp" style="margin-top: 10px;">
                                                                        <div class="col-md-5">
                                                                            <!-- <input type="text" name="speciality[]" placeholder="Speciality" class="form-control" value="<?= $exp_details['job_title']; ?>" required> -->
                                                                            <select name="job_title[]" class="contract_speciality form-control" required>
                                                                                <option value="">Select your job</option>
                                                                                <?php
                                                                                foreach ($specialities as $specialityID => $speciality) {
                                                                                ?>
                                                                                    <option value="<?= $specialityID; ?>" <?php if ($specialityID == $exp_details['job_title']) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>><?= $speciality[$_SESSION['site_lang'] . '_Title']; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                <option value="Other" <?php if ($exp_details['job_title'] === 'Other') {
                                                                                                            echo "selected";
                                                                                                        } ?>>Other</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-5"><input type="text" name="years_of_experience[]" placeholder="Years" class="form-control" value="<?= $exp_details['years_of_exp']; ?>" required></div>
                                                                        <div class="col-md-2">
                                                                            <?php
                                                                            if ($count > 1) { ?>
                                                                                <i class="fa fa-trash btn btn-danger del_exp"></i>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                    $count++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <div class="col-md-12 single_exp" style="margin-top: 10px;">
                                                                    <!-- <div class="col-md-5"><input type="text" name="speciality[]" placeholder="Speciality" class="form-control" required></div> -->
                                                                    <div class="col-md-5">
                                                                        <select name="job_title[]" class="contract_speciality form-control" required>
                                                                            <option value="">Select your job</option>
                                                                            <?php
                                                                            foreach ($specialities as $specialityID => $speciality) {
                                                                            ?>
                                                                                <option value="<?= $specialityID; ?>"><?= $speciality[$_SESSION['site_lang'] . '_Title']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-5"><input type="text" name="years_of_experience[]" placeholder="Years" class="form-control" required></div>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="button" id="add_exp" class="btn btn-info"><?php echo $lang['add_experience']; ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-center">
                                            <button class="btn btn-success" type="submit" name="submit_cv"><i class="fa fa-save"></i> <?php echo $lang['update']; ?></button>
                                        </div>
                                    </form>
                                </div>
                                <div id="tab3" class="tab-pane fade <?php if ($current_tab == 'tab3') {
                                                                        echo "active in";
                                                                    } ?>">
                                    <form method="post" action="<?php $link->link("edit_user", frontend, '&edit=' . $load . '&tab=' . $current_tab); ?>" enctype="multipart/form-data">
                                        <input type="hidden" name="current_tab" value="tab3">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-8">
                                                    <div class="form-group row">
                                                        <div class="text-left contract_info_container">
                                                            <div class="col-md-5"><label class="text-muted"><?php echo $lang['speciality']; ?></label></div>
                                                            <div class="col-md-5"><label class="text-muted"><?php echo $lang['hour_rate']; ?></label></div>
                                                            <?php
                                                            if (is_array($freelancer_contract_info) && count($freelancer_contract_info) > 0) {
                                                                $count = 1;
                                                                foreach ($freelancer_contract_info as $contract_details) {
                                                            ?>
                                                                    <div class="col-md-12 single_contract_info" style="margin-top: 10px;">
                                                                        <div class="col-md-5">
                                                                            <!-- <input type="text" name="speciality[]" placeholder="Speciality" class="form-control" value="<?= $contract_details['speciality']; ?>" required> -->
                                                                            <select name="speciality[]" class="contract_speciality form-control" required>
                                                                                <option value="">Select your Speciality</option>
                                                                                <?php
                                                                                foreach ($specialities as $specialityID => $speciality) {
                                                                                ?>
                                                                                    <option value="<?= $specialityID; ?>" <?php if ($specialityID == $contract_details['speciality']) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>><?= $speciality[$_SESSION['site_lang'] . '_Title']; ?></option>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                                <option value="Other" <?php if ($contract_details['speciality'] === 'Other') {
                                                                                                            echo "selected";
                                                                                                        } ?>>Other</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-5"><input type="text" name="hourly_rate[]" placeholder="Hourly Rate" class="form-control" value="<?= $contract_details['hourly_rate']; ?>" required></div>
                                                                        <div class="col-md-2">
                                                                            <?php
                                                                            if ($count > 1) { ?>
                                                                                <i class="fa fa-trash btn btn-danger del_contract_info"></i>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                    $count++;
                                                                }
                                                            } else {
                                                                ?>
                                                                <div class="col-md-12 single_contract_info" style="margin-top: 10px;">
                                                                    <!-- <div class="col-md-5"><input type="text" name="speciality[]" placeholder="Speciality" class="form-control" required></div> -->
                                                                    <div class="col-md-5">
                                                                        <select name="speciality[]" class="contract_speciality form-control" required>
                                                                            <option value="">Select your Speciality</option>
                                                                            <?php
                                                                            foreach ($specialities as $specialityID => $speciality) {
                                                                            ?>
                                                                                <option value="<?= $specialityID; ?>"><?= $speciality[$_SESSION['site_lang'] . '_Title']; ?></option>
                                                                            <?php
                                                                            }
                                                                            ?>
                                                                            <option value="Other">Other</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-5"><input type="text" name="hourly_rate[]" placeholder="Hourly Rate" class="form-control" required></div>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="button" id="add_contract_info" class="btn btn-info"><?php echo $lang['add_more']; ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-center">
                                            <button class="btn btn-success" type="submit" name="submit_contract_info"><i class="fa fa-save"></i><?php echo $lang['update']; ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#major_select').chosen();
        $('.contract_speciality').chosen();
        $('#major_select_chosen').css('width', '100%');
        $('.chosen-container-single').css('width', '100%');

        $('#major_select').change(function() {
            $('#other_major').hide();
            $('#other_major').removeAttr('required');
            if ($(this).val() == 'Other') {
                $('#other_major').show();
                $('#other_major').attr('required', 'required')
            }
        });

        $('#add_exp').click(function() {
            $('.work_exp_container').append(`
                <div class="col-md-12 single_exp" style="margin-top: 10px;">
                    <div class="col-md-5">
                        <select name="job_title[]" class="contract_speciality form-control" required>
                            <option value="">Select your job</option>
                            <?php
                            foreach ($specialities as $specialityID => $speciality) {
                            ?>
                                <option value="<?= $specialityID; ?>"><?= $speciality[$_SESSION['site_lang'] . '_Title']; ?></option>
                            <?php
                            }
                            ?>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-5"><input type="text" name="years_of_experience[]" placeholder="Years" class="form-control" required></div>
                    <div class="col-md-2"><i class="fa fa-trash btn btn-danger del_exp"></i></div>
                </div>
            `);
            $('.contract_speciality').chosen();
        });

        $(document).on('click', '.del_exp', function() {
            $(this).parent().parent().remove();
        });

        $('#add_contract_info').click(function() {
            $('.contract_info_container').append(`
                <div class="col-md-12 single_contract_info" style="margin-top: 10px;">
                    <div class="col-md-5">
                        <select name="speciality[]" class="contract_speciality form-control" required>
                            <option value="">Select your Speciality</option>
                            <?php
                            foreach ($specialities as $specialityID => $speciality) {
                            ?>
                                <option value="<?= $specialityID; ?>"><?= $speciality[$_SESSION['site_lang'] . '_Title']; ?></option>
                            <?php
                            }
                            ?>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-5"><input type="text" name="hourly_rate[]" placeholder="Hourly Rate" class="form-control" required></div>
                    <div class="col-md-2"><i class="fa fa-trash btn btn-danger del_contract_info"></i></div>
                </div>
            `);
            $('.contract_speciality').chosen();
        });

        $(document).on('click', '.del_contract_info', function() {
            $(this).parent().parent().remove();
        });
    });
</script>