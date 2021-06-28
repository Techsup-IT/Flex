<div id="content-container">
    <div class="pageheader">
        <h3><i class="fa fa-home"></i><?php echo $lang['edit_freelancer']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li> <a href="<?php echo $link->link('home', frontend); ?>"> <?php echo $lang['dashboard']; ?> </a> </li>
                <li> <a href="<?php echo $link->link('freelancers', frontend); ?>"><?php echo $lang['freelancers']; ?> </a> </li>
                <li class="active"><?php echo $lang['edit_freelancer']; ?></li>
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
                            <button class="btn btn-default" onclick="goBack()"><i class="fa fa-arrow-circle-left"></i> <?php echo $lang['go_back']; ?></button>
                        </div>
                        <h3 class="panel-title"><?php echo $lang['edit_freelancer']; ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="tab-base">
                            <ul class="nav nav-tabs">
                                <li class="<?php if ($current_tab == 'tab1' || $current_tab == '') {
                                                echo "active";
                                            } ?>"><a data-toggle="tab" href="#tab1"><?php echo $lang['personal_information']; ?></a> </li>
                                <?php if ($_SESSION['department'] == 1 || $_SESSION['department'] == 5) { ?>
                                    <li class="<?php if ($current_tab == 'tab2') {
                                                    echo "active";
                                                } ?>"> <a data-toggle="tab" href="#tab2"><?php echo $lang['login_credential']; ?></a> </li>
                                <?php } ?>
                                <li class="<?php if ($current_tab == 'tab3') {
                                                echo "active";
                                            } ?>"> <a data-toggle="tab" href="#tab3"><?php echo $lang['profile_image']; ?></a> </li>
                            </ul>
                            <div class="tab-content" style="padding: 0;">
                                <div id="tab1" class="tab-pane fade  <?php if ($current_tab == 'tab1'  || $current_tab == '') {
                                                                            echo "active in";
                                                                        } ?>">
                                    <form method="post" action="<?php $link->link("edit_freelancer", frontend, '&edit=' . $load . '&tab=' . $current_tab); ?>" enctype="multipart/form-data" id="editPersonalInfo">
                                        <input type="hidden" name="current_tab" value="tab1">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['IdNumber']; ?></label>
                                                            <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_IdNumber']; ?> *" name="IdNumber" value="<?php echo $get_row['IdNumber']; ?>" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['EstLaborOfficeId']; ?></label>
                                                            <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_EstLaborOfficId']; ?> *" name="EstLaborOfficeId" value="<?php echo $get_row['EstLaborOfficeId']; ?>" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['EstSequenceNumber']; ?></label>
                                                            <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_EstSequenceNumber']; ?> *" name="EstSequenceNumber" value="<?php echo $get_row['EstSequenceNumber']; ?>" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['first_name']; ?></label>
                                                            <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_name']; ?> *" name="emp_name" value="<?php echo $get_row['emp_name']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['last_name']; ?></label>
                                                            <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_surname']; ?>" name="emp_surname" value="<?php echo $get_row['emp_surname']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['address']; ?></label>
                                                            <textarea class="form-control" name="address" placeholder="<?php echo $lang['enter_your_address']; ?>"><?php echo $get_row['address']; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['is_mol_TWC']; ?></label>
                                                        <select class="form-control " name="is_molTWC">
                                                            <option value="0" <?php if ($get_row['is_molTWC'] == 0) echo "selected"; ?>><?php echo $lang['no']; ?></option>
                                                            <option value="1" <?php if ($get_row['is_molTWC'] == 1) echo "selected"; ?>><?php echo $lang['yes']; ?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="text-left">
                                                            <label class="text-muted"><?php echo $lang['phone_number']; ?></label>
                                                            <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_phone_number']; ?>" name="contact1" value="<?php echo $get_row['contact1']; ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group text-left">
                                                        <label><?php echo $lang['date_of_birth']; ?> * : </label>
                                                        <input type="text" placeholder="yyyy-mm-dd" name="dob" class="form-control birthdate" value="<?php echo $get_row['dob']; ?>" required />
                                                    </div>

                                                    <div class="form-group text-left">
                                                        <label><?php echo $lang['employee_national_number']; ?> * : </label>
                                                        <input type="text" placeholder="<?php echo $lang['employee_national_number']; ?>" name="employee_national_number" class="form-control" value="<?php echo $get_row['employee_national_number']; ?>" required />
                                                    </div>

                                                    <div class="form-group text-left">
                                                        <label><?php echo $lang['city']; ?> * : </label>
                                                        <select name="city_id" id="select_city" placeholder="<?= $lang['select_city']; ?>" class="form-control">
                                                            <option value=""><?= $lang['select_city'] ?></option>
                                                            <?php
                                                            foreach ($cities as $city_id => $city) {
                                                            ?>
                                                                <option value="<?= $city_id; ?>" <?php if ($city_id == $get_row['city_id']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?= $city['Arabic_Name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <hr>
                                                    <div class="form-group">
                                                        <label class="control-label text-bold"><?php echo $lang['freelancer_company_details']; ?> </label>
                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-4"><label class="text-muted"><?php echo $lang['freelancer_type']; ?> : </label></div>
                                                        <div class="col-md-8">
                                                            <select name="freelancer_type" class="form-control " id="freelancer_type">
                                                                <option value="0" <?php if ($get_row['is_company'] == 0) echo "selected"; ?>><?php echo $lang['company']; ?></option>
                                                                <option value="1" <?php if ($get_row['is_company'] == 1) echo "selected"; ?>><?php echo $lang['individual']; ?></option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row freelancer_company_container">
                                                        <div class="col-md-4">
                                                            <label class="text-muted"><?php echo $lang['freelancer'] . ' ' . $lang['company']; ?> : </label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select id="freelancer_company" class="form-control selectpicker" name="freelancer_company">
                                                                <?php if (is_array($company)) foreach ($company as $value) { ?>
                                                                    <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $get_row['company_id']) echo "selected"; ?>><?php echo $value['company_name']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label class="control-label text-bold"><?php echo $lang['assign_company_add_work_hour']; ?> </label>
                                                    </div>

                                                    <div class="freelancer_cw_container">
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-4 text-bold"><?php echo $lang['company']; ?> </label>
                                                            <label class="control-label col-md-4 text-right text-bold"><?php echo $lang['working_hours']; ?> </label>
                                                            <label class="control-label col-md-4 text-bold"><?php echo $lang['hour_rate']; ?> </label>
                                                        </div>

                                                        <?php
                                                        if (!empty($freelancer_assigned_companies)) {
                                                            $company_count = 0;
                                                            foreach ($freelancer_assigned_companies as $c) {
                                                                $company_count++;
                                                        ?>
                                                                <div class="form-group row">
                                                                    <div class="col-md-5">
                                                                        <select class="form-control selectpicker freelancer_company_select" name="freelancer_assigned_company[]" required>
                                                                            <?php if (is_array($company)) foreach ($company as $value) { ?>
                                                                                <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $c['company_id']) echo "selected"; ?>><?php echo $value['company_name']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input class="form-control freelancer_wh" type="text" placeholder="<?php echo $lang['working_hours']; ?>" name="freelancer_working_hours[]" value="<?php echo $c['working_hours']; ?>" required>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input class="form-control freelancer_hr" type="text" placeholder="<?php echo $lang['hour_rate']; ?>" name="freelancer_hourly_rate[]" value="<?php echo $c['hourly_rate']; ?>" required>
                                                                    </div>

                                                                    <?php
                                                                    if ($company_count > 1) {
                                                                    ?>
                                                                        <div class="col-md-1">
                                                                            <button type="button" class="btn btn-danger freelancer_delete_row"><i class="fa fa-trash"></i></button>
                                                                        </div>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </div> 

                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-primary freelancer_assign_company"><i class="fa fa-plus"></i> <?php echo $lang['add_more'] ?></button>
                                                    </div> -->

                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-center">
                                            <button class="btn btn-success" type="submit" name="submit_freelancer"><i class="fa fa-save"></i> <?php echo $lang['update']; ?></button>
                                        </div>
                                    </form>
                                </div>

                                <?php if ($_SESSION['department'] == 1 || $_SESSION['department'] == 5) { ?>
                                    <div id="tab2" class="tab-pane fade <?php if ($current_tab == 'tab2') {
                                                                            echo "active in";
                                                                        } ?>">
                                        <form method="post" action="<?php $link->link("edit_freelancer", frontend, '&edit=' . $load . '&tab=' . $current_tab); ?>" enctype="multipart/form-data" id="editLoginInfo">
                                            <input type="hidden" name="current_tab" value="tab2">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['email_id']; ?> *</label>
                                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_email_address']; ?> *" name="email" value="<?php echo $get_row['email']; ?>" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="text-left">
                                                                <label class="text-muted"><?php echo $lang['password']; ?></label>
                                                                <input class="form-control" type="password" placeholder="<?php echo $lang['enter_password']; ?>" name="password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer text-center">
                                                <button class="btn btn-success" type="submit" name="submit_login"><i class="fa fa-save"></i> <?php echo $lang['update']; ?></button>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>

                                <div id="tab3" class="tab-pane fade <?php if ($current_tab == 'tab3') {
                                                                        echo "active in";
                                                                    } ?>">
                                    <form method="post" action="<?php $link->link("edit_freelancer", frontend, '&edit=' . $load . '&tab=' . $current_tab); ?>" enctype="multipart/form-data" id="editProfileImage">
                                        <input type="hidden" name="current_tab" value="tab3">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-sm-1"></div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo $lang['upload_pic']; ?></label>
                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <div class="fileupload-new img-thumbnail">
                                                                <?php
                                                                if (file_exists(SERVER_ROOT . '/uploads/profile/' . $get_row['emp_photo_file']) && (($get_row['emp_photo_file']) != '')) { ?>
                                                                    <img src="<?php echo SITE_URL . '/uploads/profile/' . $get_row['emp_photo_file']; ?>" style="width:200px;">
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
                                            <button class="btn btn-success" type="submit" name="submit_image"><i class="fa fa-save"></i> <?php echo $lang['update']; ?></button>
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
        var companies = <?php echo json_encode($company); ?>;
        var freelancer_type = $('#freelancer_type').val();
        if (freelancer_type != '' && freelancer_type == 1) {
            $('.freelancer_company_container').hide();
        }

        $('.freelancer_company_select').chosen();
        $('#freelancer_type').change(function() {
            var freelancer_type = $(this).val();
            if (freelancer_type == 1) {
                $('.freelancer_company_container').hide();
            } else {
                $('.freelancer_company_container').show();
            }
        });

        $('.freelancer_assign_company').click(function() {
            var html = '';
            html += '<div class="form-group row">';
            html += '<div class="col-md-5">';
            html += '<select class="form-control selectpicker freelancer_company_select" name="freelancer_assigned_company[]" required>';

            var selected_companies = [];
            $('.freelancer_company_select').each(function() {
                if ($(this).val() != '') {
                    selected_companies.push($(this).val());
                }
            });
            companies.forEach(function(company) {
                if (!selected_companies.includes(company.id)) {
                    html += '<option value="' + company.id + '">' + company.company_name + '</option>';
                }
            });

            html += '</select>';
            html += '</div>';

            html += '<div class="col-md-3">';
            html += '<input class="form-control freelancer_wh" type="text" placeholder="<?php echo $lang['working_hours']; ?>" name="freelancer_working_hours[]" required>';
            html += '</div>';

            html += '<div class="col-md-3">';
            html += '<input class="form-control freelancer_ht" type="text" placeholder="<?php echo $lang['hour_rate']; ?>" name="freelancer_hourly_rate[]" required>';
            html += '</div>';

            html += '<div class="col-md-1">';
            html += '<button type="button" class="btn btn-danger freelancer_delete_row"><i class="fa fa-trash"></i></button>';
            html += '</div>';

            html += '</div>';

            $('.freelancer_cw_container').append(html);
            $('.freelancer_company_select').chosen();

        });

        $(document).on('click', '.freelancer_delete_row', function() {
            $(this).parent().parent().remove();
        });

        $('#select_city').chosen();
    });
</script>