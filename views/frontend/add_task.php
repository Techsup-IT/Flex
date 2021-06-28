<div id="content-container">
    <div class="pageheader hidden-xs">
        <h3><i></i><?php echo $lang['add_task']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li> <a href="<?php echo $link->link('tasks', frontend); ?>"><?php echo $lang['tasks']; ?> </a> </li>
                <li class="active"><?php echo $lang['add_task']; ?></li>
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
                            <h3 class="panel-title"><?php echo $lang['add_new_task']; ?></h3>
                        </div>
                        <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" id="form">

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <div class="text-left">
                                                <label class="text-muted"><?php echo $lang['task_title']; ?></label>
                                                <input class="form-control" type="text" placeholder="<?php echo $lang['enter_your_task_title']; ?> *" name="task_title" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label"><?php echo $lang['select_project']; ?> </label>
                                            <!-- Default choosen -->
                                            <!--===================================================-->
                                            <select data-placeholder="<?php echo $lang['select_project']; ?>" class="form-control demo-chosen-select" name="proejct_id" required>
                                                <option value=""><?php echo $lang['select_project']; ?></option>
                                                <?php
                                                $projects_list = $db->run("SELECT * from `projects` where `company_id` ='" . $_SESSION['company_id'] . "'")->fetchAll();
                                                if (is_array($projects_list)) {
                                                    foreach ($projects_list as $proj_us) { ?>
                                                        <option value="<?php echo $proj_us["project_id"]; ?>"><?php echo $proj_us["project_name"]; ?></option>
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
                                                <input class="form-control start_date" type="text" name="start_date" value="<?php echo date("Y-m-d"); ?>">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar fa-lg"></i></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="text-muted"><?php echo $lang['end_date']; ?></label>
                                            <div class="input-group date datepicker">
                                                <input class="form-control end_date" type="text" name="end_date" value="<?php echo date("Y-m-d"); ?>">
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

<script>
    $(document).ready(function() {
        // $('.demo-chosen-select').chosen();
    });
</script>