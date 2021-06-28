<style type="text/css">
    .timer_container {
        border-radius: 50%;
        height: 100px;
        width: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #d5d5d5;
        box-shadow: 2px 2px 9px 2px #888;
        cursor: pointer;
    }

    .timer_container :hover {
        background-color: #d5d5d5;
    }

    .timer {
        padding: 10px;
        margin: auto;
        border-radius: 10px;
        box-shadow: 2px 2px 9px 2px #888;
    }

    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
        display: none;
    }
    
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Add animation to "page content" */
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0px;
            opacity: 1
        }
    }

    @keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0;
            opacity: 1
        }
    }
</style>
<link href="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<div id="content-container">
    <div class="pageheader">
        <h3><i><img src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-01.png'; ?>" style ="width:40px;height:40px" alt="Home Picture"></i> <?php echo ucfirst($company_details['company_name']); ?> - <?php echo $lang['dashboard']; ?></h3>
        <div class="breadcrumb-wrapper">
            <span class="label"><?php echo $lang['you_are_here']; ?>:</span>
            <ol class="breadcrumb">
                <li class="active"><?php echo $lang['dashboard']; ?></li>
            </ol>
        </div>
    </div>

    <div id="page-content">
        <br>
        <div class="row">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="message_container" style="display: none;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="project"><?= $lang['project'] ?></label>
                                <select name="project" id="project" class="form-control">
                                    <option value=""><?= $lang['select_project'] ?></option>
                                    <?php
                                    if (isset($user_projects) && count($user_projects) > 0) {
                                        foreach ($user_projects as $project) {
                                    ?>
                                            <option value="<?= $project['project_id'] ?>" <?php if ($current_check['project_id'] == $project['project_id']) {
                                                                                                echo "selected";
                                                                                            } ?>><?= $project['project_name'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="task"><?= $lang['task'] ?></label>
                                <select name="task" id="task" class="form-control" disabled>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php echo $display_msg; ?>
            <div class="col-md-12">
                <div class="col-md-3">
                    <div class="panel bg-success timer_container text-center start_time">
                        <div class="panel-body">
                            <i class="fa fa-play fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel bg-danger timer_container text-center stop_time">
                        <div class="panel-body">
                            <i class="fa fa-stop fa-3x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel text-center timer">
                        <div class="panel-body">
                            <span id="hour">00</span> :
                            <span id="min">00</span> :
                            <span id="sec">00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        ?>
        <br>
        <div class="panel">
            <div class="panel-body">
                <table id="company_report" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th> <?php echo $lang['employee']; ?> </th>
                            <th> <?php echo $lang['date']; ?> </th>
                            <th> <?php echo $lang['start_time']; ?> </th>
                            <th> <?php echo $lang['end_time']; ?> </th>
                            <th> <?php echo $lang['break_time']; ?> </th>
                            <th class="min-tablet"> <?php echo $lang['total_working_time']; ?> (HH:MM:SS)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($report_details)) {
                            foreach ($report_details as $task) {
                        ?>
                                <tr>
                                    <td><?php echo $task['emp_name']; ?></td>
                                    <td><?php echo $task['current_dt']; ?></td>
                                    <td><?php echo $feature->convertTimeZone(date("Y-m-d H:i:s", $task['check_in']), 'time'); ?></td>
                                    <td><?php if ($task['check_out'] != '') echo $feature->convertTimeZone(date("Y-m-d H:i:s", $task['check_out']), 'time'); ?></td>
                                    <td><?php if ($task['check_out'] != '' && ($task['check_out'] - $task['check_in'] >= $task['working_hours'])) {
                                            echo gmdate("H:i:s", ($task['check_out'] - $task['check_in'] - $task['working_hours']));
                                        } ?></td>
                                    <td><?php if ($task['working_hours'] != '') echo gmdate("H:i:s", $task['working_hours']); ?></td>
                                </tr>
                        <?php
                            }
                        } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<div id="loader"></div>


<script type="text/javascript">
    $(document).ready(function() {
        $('#company_report').DataTable({
            "responsive": true,
            "language": {
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                }
            },
            "oLanguage": {
                'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang']; ?>.json'
            }
        });

        $('.datetimepicker').datetimepicker({
            format: 'HH:mm:ss'
        });

        var selectedProject = null;
        var selectedTask = null;

        var x;
        var sec = 0;
        var min = 0;
        var hour = 0;
        var secOut = 0;
        var minOut = 0;
        var hourOut = 0;
        var isStarted = false;
        var isCheckedIn = <?php echo json_encode($is_checked_in); ?>;
        var last_check_id;
        var last_check_in;
        var last_check_out;

        var department = <?php echo json_encode($_SESSION['department']); ?>;
        var current_month_working_duration = <?php echo json_encode($current_month_working_duration); ?>;
        var fc_monthly_max_working_duration = <?php echo json_encode($fc_monthly_max_working_duration); ?>;

        if (isCheckedIn == 1) {
            isStarted = true;
            selectedProject = <?php echo json_encode($current_check['project_id']); ?>;
            selectedTask = <?php echo json_encode($current_check['task_id']); ?>;
            last_check_id = <?php echo json_encode($current_check['id']); ?>;
            last_check_in = <?php echo json_encode($current_check['check_in']); ?>;
            sec = <?php echo json_encode((int)(time() - $current_check['check_in'])); ?>;
            hour = Math.floor(sec / (60 * 60));
            sec -= hour * (60 * 60);
            min = Math.floor(sec / (60));
            sec -= min * (60);
            start();
            addTaskList();
        }

        $('.start_time').click(function() {
            if (current_month_working_duration < fc_monthly_max_working_duration) {
                if (selectedProject !== null && selectedTask !== null) {
                    if (!isStarted) {
                        sec = ++sec;
                        start();
                        $('#loader').show();
                        last_check_in = Math.round(+new Date() / 1000);
                        add_check();
                    }
                } else {
                    $('.message_container').append(`
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $lang['select_project_task']; ?>
                        </div>
                    `);
                    $('.message_container').show();
                }
            } else {
                $('.message_container').append(`
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $lang['monthly_hour_limit_error']; ?>
                        </div>
                    `);
                $('.message_container').show();
            }
        });
        $('.stop_time').click(function() {
            if (isStarted) {
                stop();
                $('#loader').show();
                last_check_out = Math.round(+new Date() / 1000);
                add_checkout();
            }
        });

        function start() {
            x = setInterval(timer, 1000)
        }

        function stop() {
            clearInterval(x);
            sec = 0;
            min = 0;
            hour = 0;
        }

        function timer() {
            secOut = checkTime(sec);
            minOut = checkTime(min);
            hourOut = checkTime(hour);

            sec = ++sec;

            if (sec == 60) {
                min = ++min;
                sec = 0;
            }
            if (min == 60) {
                min = 0;
                hour = ++hour;
            }
            document.getElementById("sec").innerHTML = secOut;
            document.getElementById("min").innerHTML = minOut;
            document.getElementById("hour").innerHTML = hourOut;

            if (department == 3 || department == 2) {
                checkMaxTimeLimit();
            }
        }

        function checkMaxTimeLimit() {
            var current_time = Math.round(+new Date() / 1000);
            var check_duration = current_time - last_check_in;
            var total_duration = current_month_working_duration + check_duration;
            if (total_duration > fc_monthly_max_working_duration) {
                if (isStarted) {
                    stop();
                    $('#loader').show();
                    last_check_out = Math.round(+new Date() / 1000);
                    add_checkout();
                    $('.message_container').append(`
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <?php echo $lang['monthly_hour_limit_error']; ?>
                        </div>
                    `);
                    $('.message_container').show();
                }
            }
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }

        function add_check() {
            var company_id = '<?php echo $_SESSION["company_id"] ?>';
            var employee_id = '<?php echo $_SESSION["employee_id"] ?>';
            var add_checkin = last_check_in;
            var url = '<?php echo $link->link("tracker_add_check_i&token=$token"); ?>';

            if (company_id > 0 && employee_id > 0 && add_checkin != '') {
                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        company_id: company_id,
                        employee_id: employee_id,
                        project_id: selectedProject,
                        task_id: selectedTask,
                        check_in: add_checkin,
                        check_out: '',
                    },
                    success: function(res) {
                        // isStarted = true;
                        // $('#loader').hide();
                        // last_check_id = res.last_id
                        // location.reload();
                        $('#loader').hide();
                        if (res.status !== false) {
                            isStarted = true;
                            last_check_id = res.last_id
                            location.reload();
                        } else {
                            $('.message_container').append(`
                                <div class="alert alert-warning alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?php echo $lang['error_occured']; ?>
                                </div>
                            `);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        }

        function add_checkout() {
            var company_id = '<?php echo $_SESSION["company_id"] ?>';
            var employee_id = '<?php echo $_SESSION["employee_id"] ?>';
            var add_checkin = last_check_in;
            var add_checkout = last_check_out;
            add_checkout_time = last_check_out - last_check_in;
            var url = '<?php echo $link->link("tracker_add_check_i&token=$token"); ?>';

            if (company_id > 0 && employee_id > 0 && add_checkin != '' && last_check_id != '') {
                $.ajax({
                    url: url,
                    method: 'get',
                    data: {
                        company_id: company_id,
                        employee_id: employee_id,
                        check_in: add_checkin,
                        check_out: add_checkout,
                        check_out_time: add_checkout_time,
                        last_id: last_check_id,
                    },
                    success: function(res) {
                        isStarted = false;
                        $('#loader').hide();
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        }

        $('#project').change(function() {
            selectedProject = null;
            selectedTask = null;
            $('#task').attr('disabled', 'disabled');
            $('#task').html('');
            if ($(this).val() != '') {
                selectedProject = $(this).val();
                addTaskList();
            }
        });

        $('#task').change(function() {
            if ($(this).val() != '') {
                selectedTask = $(this).val();
            }
        });

        function addTaskList() {
            var taskOptions = '';
            $('#task').removeAttr('disabled');
            var userTasks = <?php echo json_encode($user_tasks); ?>;
            taskOptions += '<option value=""><?= $lang['select_task'] ?></option>';
            userTasks.forEach(task => {
                var selected = '';
                if (task.task_id == selectedTask) {
                    selected = 'selected';
                }
                if (task.project_id == selectedProject) {
                    taskOptions += '<option value="' + task.task_id + '" ' + selected + '>' + task.task_name + '</option>';
                }
            });
            $('#task').append(taskOptions);
        }

    });
</script>