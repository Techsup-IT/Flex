<?php
if ($current_tab == '') {
    $current_tab == 'tab1';
}
?>

<div id="content-container">
    <div class="pageheader">
        <h3><i><img src="uploads/logo/company_icons/icons_flex-15.png" style ="width:40px;height:40px;"></i> <?php echo $lang['settings']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li> <a href="<?php echo $link->link('home', frontend); ?>"> <?php echo $lang['dashboard']; ?> </a> </li>
                <li class="active"><?php echo $lang['settings']; ?></li>
            </ol>
        </div>
    </div>
    <div id="page-content">
        <div class="row">
            <?php echo $display_msg; ?>
            <div class="">
                <div class="panel">
                    <div class="panel-body pad-no">
                        <div class="tab-base">
                            <ul class="nav nav-tabs">
                                <li class="<?php if ($current_tab == 'tab1' || $current_tab == '') {
                                                echo "active";
                                            } ?>"><a data-toggle="tab" href="#tab1"><?php echo $lang['company_settings']; ?></a> </li>
                                <!--  <li class="<?php if ($current_tab == 'tab2') {
                                                        echo "active";
                                                    } ?>"> <a data-toggle="tab" href="#tab2">Site entry</a> </li>-->
                            </ul>
                            <div class="tab-content">
                                <div id="tab1" class="tab-pane fade  <?php if ($current_tab == 'tab1'  || $current_tab == '') {
                                                                            echo "active in";
                                                                        } ?>">
                                    <div class="row">
                                        <?php //echo $display_msg;
                                        ?>
                                        <div class="eq-height">
                                            <div class="col-sm-12 eq-box-sm">
                                                <div class="panel">
                                                    <div class="panel-heading">
                                                        <div class="panel-control">
                                                            <button class="btn btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></button>
                                                            <button class="btn btn-default" data-click="panel-reload"><i class="fa fa-refresh"></i></button>
                                                            <button class="btn btn-default" data-click="panel-collapse"><i class="fa fa-chevron-down"></i></button>
                                                            <button class="btn btn-default" data-dismiss="panel"><i class="fa fa-times"></i></button>
                                                        </div>
                                                        <h3 class="panel-title"><?php echo $lang['update_company_settings_details']; ?></h3>
                                                    </div>
                                                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="editCompanyForm">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['company_name']; ?> *</label>
                                                                        <input class="form-control" name="company_name" type="text" value="<?php echo $company_details['company_name']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['company_email']; ?> *</label>
                                                                        <input class="form-control" name="company_email" type="text" value="<?php echo $company_details['company_email']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['company_website']; ?> </label>
                                                                        <input class="form-control" type="text" name="company_website" value="<?php echo $company_details['company_website']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['address']; ?> </label>
                                                                        <textarea class="form-control" name="company_address"><?php echo html_entity_decode($company_details['company_address']); ?>
                                                     </textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['telephone1']; ?></label>
                                                                        <input class="form-control" name="telephone1" type="text" value="<?php echo $company_details['telephone1']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['country']; ?> </label>
                                                                        <select class="form-control " name="country">
                                                                            <?php $country = $feature->getcountry_list(); ?>
                                                                            <option value="0" label="Select a country ... " selected="selected"><?php echo $lang['select_a_country']; ?> </option>
                                                                            <?php if (is_array($country)) foreach ($country as $key => $value) { ?>
                                                                                <option value="<?php echo $key; ?>" <?php if ($key == $company_details['country']) echo "selected"; ?>><?php echo $value; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['timezone']; ?> </label>
                                                                        <select class="form-control " name="timezone">
                                                                            <?php
                                                                            $timezones = $feature->get_timezones();
                                                                            if (is_array($timezones)) foreach ($timezones as $key => $value) { ?>
                                                                                <option value="<?php echo $value['zone']; ?>" <?php if ($company_details['timezone'] == $value['zone']) echo "selected"; ?>><?php echo $value['diff_from_GMT'] . " - " . $value['zone']; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['reports']; ?> : </label><br />
                                                                        <label class="checkbox-inline"><input type="checkbox" <?php if ($company_details['daily_report'] == 1) echo 'checked'; ?> name="daily_report" value="1"><?php echo $lang['daily_report']; ?></label>
                                                                        <label class="checkbox-inline"><input type="checkbox" <?php if ($company_details['weekly_report'] == 1) echo 'checked'; ?> name="weekly_report" value="1"><?php echo $lang['weekly_report']; ?></label>
                                                                        <label class="checkbox-inline"><input type="checkbox" <?php if ($company_details['monthly_report'] == 1) echo 'checked'; ?> name="monthly_report" value="1"><?php echo $lang['monthly_report']; ?></label>
                                                                    </div>


                                                                </div>
                                                                <div class="col-sm-1"></div>
                                                                <div class="col-sm-5">

                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['zip']; ?></label>
                                                                        <input class="form-control" name="zip" type="text" value="<?php echo $company_details['zip']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['state']; ?></label>
                                                                        <input class="form-control" name="state" type="text" value="<?php echo $company_details['state']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['city']; ?></label>
                                                                        <input class="form-control" name="city" type="text" value="<?php echo $company_details['city']; ?>">
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['date_format']; ?></label>
                                                                        <select class="form-control " name="date_format">
                                                                            <option value="1" <?php if ($company_details['date_format'] == 1) echo "selected"; ?>>DD/MM/YY</option>
                                                                            <option value="2" <?php if ($company_details['date_format'] == 2) echo "selected"; ?>>MM/DD/YY</option>
                                                                            <option value="3" <?php if ($company_details['date_format'] == 3) echo "selected"; ?>>Day-Month-Year(29th-may-1985)</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['currency_symbol']; ?> *</label>
                                                                        <input class="form-control" name="company_currencysymbol" type="text" value="<?php echo $company_details['company_currencysymbol']; ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label"><?php echo $lang['upload_logo']; ?></label>
                                                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                            <div class="fileupload-new img-thumbnail">
                                                                                <?php if (file_exists(SERVER_ROOT . '/uploads/logo/company_logo/' . $company_details['logo']) && (($company_details['logo']) != '')) { ?>
                                                                                    <img src="<?php echo SITE_URL . '/uploads/logo/company_logo/' . $company_details['logo'] . '?id=' . rand(0, 89); ?>" width="100%">
                                                                                <?php } else { ?>
                                                                                    <img src="<?php echo SITE_URL . '/uploads/noimage.png'; ?>" width="100%">
                                                                                <?php } ?>

                                                                            </div>
                                                                            <div>
                                                                                <br>
                                                                                <input type="file" name="logopic" id="logo" accept="image/*">
                                                                            </div>
                                                                            <small>Only jpg , png & jpeg (Max : <?php echo $upload_max_size; ?>)</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel-footer text-center">
                                                            <button class="btn btn-info" type="submit" name="submit_settings"><i class="fa fa-save"></i> <?php echo $lang['submit']; ?></button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <?php /*********************** by R ********************/ ?>
                                <div id="tab2" class="tab-pane fade <?php if ($current_tab == 'tab2') {
                                                                        echo "active in";
                                                                    } ?>">
                                    <div class="panel-heading">

                                        <span class="pull-right">
                                            <a href="<?php echo $link->link('add_site_entry', frontend); ?>" class="btn  btn-default"><i class="fa fa-plus"></i> Add Site Entry</a>
                                        </span>


                                    </div>

                                    <table id="demo-dt-basic" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%"> Site Title</th>
                                                <th class="min-tablet" width="62%"> Site Url</th>
                                                <th class="min-tablet" width="8%"> Blocked</th>
                                                <th width="20%"> Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (is_array($site_setting)) {
                                                foreach ($site_setting as $task_list) { ?>
                                                    <tr>
                                                        <td class="hidden-xs">
                                                            <?php echo $task_list['site_name']; ?>
                                                        </td>
                                                        <td class="hidden-xs">
                                                            <?php echo $task_list['site_url']; ?>
                                                        </td>
                                                        <td class="hidden-xs">
                                                            <?php
                                                            /* this is for keyborad action,mouse action, mouse movement*/
                                                            $site_blocked = $task_list['is_blocked'];
                                                            $title = "";
                                                            if ($site_blocked == "yes") {
                                                                echo "Yes";
                                                                $title = "Click to disable blocking";
                                                            } else {
                                                                echo "No";
                                                                $title = "Click to enable blocking";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="hidden-xs">
                                                            <a title="<?php echo $title; ?>" href="<?php echo $link->link("site_setting", frontend, '&is_block_' . $site_blocked . '=' . $task_list['site_setting_id']); ?>" class="btn <?php if ($site_blocked == "yes") {
                                                                                                                                                                                                                                            echo 'btn-success';
                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                            echo 'btn-warning';
                                                                                                                                                                                                                                        } ?> fa fa-shield"></a>
                                                            <a href="<?php echo $link->link("projects", frontend, '&del_project_id=' . $task_list['site_setting_id']); ?>" class="btn btn-danger fa fa-trash"></a>
                                                        </td>

                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php /*********************** End ********************/ ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>