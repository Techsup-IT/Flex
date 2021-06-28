<div id="content-container">
    <div class="pageheader">
        <h3><i></i><?php echo $lang['edit_task']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li> <a href="<?php echo $link->link('tasks', frontend); ?>"><?php echo $lang['tasks']; ?> </a> </li>
                <li class="active"><?php echo $lang['edit_task']; ?></li>
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
                            <h3 class="panel-title"><?php echo $lang['edit_task']; ?></h3>
                        </div>
                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="form">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted"><?php echo $lang['task_title']; ?></label>
                                                <input class="form-control" type="text" value="<?php echo $task_details['task_name']; ?>" placeholder="<?php echo $lang['enter_your_task_title']; ?> *" name="task_title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <option value="0"><?php echo $lang['select_project']; ?></option>
                                            <!-- Default choosen -->
                                            <!--===================================================-->
                                            <select data-placeholder="<?php echo $lang['select_project']; ?>" class="form-control demo-chosen-select" name="proejct_id" required>
                                                <option value=""><?php echo $lang['select_project']; ?></option>
                                                <?php
                                                $projects_list = $db->run("SELECT * from `projects` where `company_id` ='" . $_SESSION['company_id'] . "'")->fetchAll();
                                                if (is_array($projects_list)) {
                                                    foreach ($projects_list as $proj_us) { ?>
                                                        <option <?php if ($task_details['project_id'] == $proj_us["project_id"]) {
                                                                    echo 'selected';
                                                                } ?> value="<?php echo $proj_us["project_id"]; ?>"><?php echo $proj_us["project_name"]; ?></option>
                                                <?php }
                                                }
                                                ?>
                                            </select>
                                            <!--===================================================-->
                                        </div>


                                    </div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="text-muted"><?php echo $lang['start_date']; ?></label>
                                            <div class="input-group date datepicker">
                                                <input class="form-control start_date" type="text" value="<?php echo $task_details['start_date']; ?>" name="start_date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar fa-lg"></i></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted"><?php echo $lang['end_date']; ?></label>
                                            <div class="input-group date datepicker">
                                                <input class="form-control end_date" type="text" value="<?php echo $task_details['end_date']; ?>" name="end_date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar fa-lg"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-center">
                                    <a class="btn btn-warning" href="<?php echo $link->link('tasks', frontend); ?>"><i class="fa fa-times"></i> <?php echo $lang['cancel']; ?></a>
                                    <button class="btn btn-success" type="submit" name="submit_add_task"><i class="fa fa-save"></i> <?php echo $lang['submit']; ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>