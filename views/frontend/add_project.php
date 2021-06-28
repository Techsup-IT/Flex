<div id="content-container">
    <div class="pageheader hidden-xs">
        <h3><i></i><?php echo $lang['add_project']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li> <a href="<?php echo $link->link('projects', frontend); ?>"><?php echo $lang['projects']; ?> </a> </li>
                <li class="active"><?php echo $lang['add_project']; ?></li>
            </ol>
        </div>
    </div>
    <div id="page-content">

        <div class="row">
            <?php echo $display_msg; ?>
            <div class="eq-height">
                <div class="col-sm-12 eq-box-sm">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-control">
                                <button class="btn btn-default" onclick="goBack()"><i class="fa fa-arrow-circle-left"></i> <?php echo $lang['go_back']; ?></button>
                            </div>
                            <h3 class="panel-title"><?php echo $lang['add_new_project']; ?></h3>
                        </div>

                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="form">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted"><?php echo $lang['project_title']; ?></label>
                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_project_title']; ?> *" name="project_title" required>
                                            </div>
                                        </div>

                                        <label class="control-label"><?php echo $lang['select_employees']; ?> </label>

                                        <div class="radio">
                                            <label><input checked type="radio" name="radio1" id="r1" value="public"><?php echo $lang['public']; ?></label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="radio1" id="r2" value="private"><?php echo $lang['private']; ?></label>
                                        </div>
                                        <div style="display:none;" id="selectEmployees">
                                            <select class="demo-cs-multiselect" data-placeholder="<?php echo $lang['select_employees']; ?>" multiple tabindex="4" name="employee_id[]">

                                                <?php
                                                // $employees_list = $db->run("SELECT * from `employee` where `company_id` ='" . $_SESSION['company_id'] . "' AND `department` !='1'")->fetchAll();
                                                $employees_list = $db->run("SELECT DISTINCT(e.employee_id), e.* FROM employee e LEFT JOIN employee_company_map ec on ec.employee_id = e.employee_id WHERE e.department in (2,3) and (e.company_id = '" . $_SESSION['company_id'] . "' || ec.company_id = '" . $_SESSION['company_id'] . "')")->fetchAll();
                                                if (is_array($employees_list)) {
                                                    foreach ($employees_list as $us) { ?>
                                                        <option value="<?php echo $us["employee_id"]; ?>"><?php echo $us["emp_name"]; ?></option>
                                                <?php }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">
                                        <label class="text-muted"><?php echo $lang['start_date']; ?></label>
                                        <div class="input-group date datepicker">
                                            <input class="form-control start_date" type="text" name="start_date" value="<?php echo date("Y-m-d"); ?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar fa-lg"></i></span>
                                        </div>

                                        <label class="text-muted"><?php echo $lang['end_date']; ?></label>
                                        <div class="input-group date datepicker">
                                            <input class="form-control end_date" type="text" name="end_date" value="<?php echo date("Y-m-d"); ?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar fa-lg"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    <a class="btn btn-warning" href="<?php echo $link->link('projects', frontend); ?>"><i class="fa fa-times"></i> <?php echo $lang['cancel']; ?></a>
                                    <button class="btn btn-success" type="submit" name="submit_add_project"><i class="fa fa-save"></i> <?php echo $lang['submit']; ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>