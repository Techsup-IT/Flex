<style type="text/css">
    .panel {
        border: 1px solid #c5c5c5;
        border-radius: 15px;
    }

    .stats .panel {
        border: 5px solid #fcf9f9;
        border-radius: 50px 10px 10px 50px;
    }

    .panel_head {
        font-size: 25px;
        text-align: center;
        padding-top: 15px;
        text-decoration: underline;
    }

    .home_icon {
        width: 65px;
        height: 65px;
    }
</style>
<div id="content-container">
    <div id="page-content">
        <div class="row stats">
            <a href="<?php echo $link->link('freelancers', frontend); ?>">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xm-12">
                    <!--Comments-->
                    <div class="panel media pad-all">
                        <div class="media-left">
                            <span class="icon-wrap icon-wrap-sm icon-circle">
                                <img class="home_icon" src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-24.png'; ?>" alt="Employees Picture">
                                <!--<i class="fa fa-user fa-2x"></i>-->
                            </span>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-thin text-right"><?php echo $total_freelancer; ?></p>
                            <p class="h5 mar-no text-right"><?php echo $lang['freelancers']; ?></p>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?php echo $link->link('projects', frontend); ?>">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xm-12">
                    <!--Sales-->
                    <div class="panel media pad-all">
                        <div class="media-left">
                            <span class="icon-wrap icon-wrap-sm icon-circle">
                                <img class="home_icon" src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-22.png'; ?>" alt="Info Picture">
                                <!--<i class="fa fa-tags fa-2x"></i>-->
                            </span>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no text-thin text-right"><?php echo $total_projects; ?></p>
                            <p class="h5 mar-no text-right"><?php echo $lang['projects']; ?></p>
                        </div>
                    </div>
                </div>
            </a>

            <?php if ($_SESSION['department'] == 5) { ?>
                <a href="<?php echo $link->link('company', frontend); ?>">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xm-12">
                        <!--Comments-->
                        <div class="panel media pad-all">
                            <div class="media-left">
                                <span class="icon-wrap icon-wrap-sm icon-circle">
                                    <img class="home_icon" src="<?php echo SITE_URL . '/uploads/logo/company_icons/icons_flex-23.png'; ?>" alt="Projects Picture">
                                    <!--<i class="fa fa-info-circle  fa-2x"></i>-->
                                </span>
                            </div>
                            <div class="media-body">
                                <p class="text-2x mar-no text-thin text-right"><?php echo $total_companies; ?></p>
                                <p class="h5 mar-no text-right"><?php echo $lang['companies']; ?></p>
                            </div>
                            <!-- <div class="media-body">
                            <a href="<?php echo $link->link('company', frontend); ?>">
                                <p class="h5 text-right" style="width: 80%;float: left;margin:2px 0px;"><?php echo $lang['companies']; ?>:</p>
                                <p class="h5 text-center" style="width: 20%;float: left;margin:2px 0px;"><b><?php echo $total_companies; ?></b></p>
                            </a>
                            <a href="<?php echo $link->link('all_users', frontend); ?>">
                                <p class="h5 text-right" style="width: 80%;float: left;margin:2px 0px;"><?php echo $lang['employees']; ?>:</p>
                                <p class="h5 text-center" style="width: 20%;float: left;margin:2px 0px;"><b><?php echo $total_users; ?></b></p>
                            </a>
                            <a href="<?php echo $link->link('active_users', frontend); ?>">
                                <p class="h5 text-right" style="width: 80%;float: left;margin:2px 0px;"><?php echo $lang['online_users']; ?>:</p>
                                <p class="h5 text-center" style="width: 20%;float: left;margin:2px 0px;"><b><?php echo $total_online_users; ?></b></p>
                            </a>
                        </div> -->
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel_head"><?php echo $lang['active_users']; ?></div>
                    <div class="panel-body">
                        <div class="tab-base">
                            <div class="tab-content">
                                <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                    <table id="active_user" class="cell-border active_user table table-striped table-hover table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $lang['name']; ?></th>
                                                <th><?php echo $lang['project']; ?></th>
                                                <th><?php echo $lang['task']; ?></th>
                                                <th><?php echo $lang['daily'] . ' ' . $lang['working_hours']; ?></th>
                                                <th><?php echo $lang['monthly'] . ' ' . $lang['working_hours']; ?></th>
                                                <th><?php echo $lang['total_working_time']; ?></th>
                                                <!-- <th><?php echo $lang['ip_address']; ?></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($active_employees) && count($active_employees) > 0) {
                                                foreach ($active_employees as $employee) { ?>
                                                    <tr>
                                                        <td><?php echo $employee['employee_id']; ?></td>
                                                        <td><?php echo $employee['emp_name']; ?></td>
                                                        <td><?php echo $employee['project_name']; ?></td>
                                                        <td><?php echo $employee['task_name']; ?></td>
                                                        <!-- <td><?php if ($employee['working_duration'] != '') echo gmdate("H:i:s", $employee['working_duration']); ?></td> -->
                                                        <td><?php if (isset($employee_working_details[$employee['employee_id']]) &&  $employee_working_details[$employee['employee_id']]['daily_duration'] != '') echo secondsToDHMS($employee_working_details[$employee['employee_id']]['daily_duration']); ?></td>
                                                        <td><?php if (isset($employee_working_details[$employee['employee_id']]) &&  $employee_working_details[$employee['employee_id']]['daily_duration'] != '') echo secondsToDHMS($employee_working_details[$employee['employee_id']]['monthly_duration']); ?></td>
                                                        <td><?php if (isset($employee_working_details[$employee['employee_id']]) &&  $employee_working_details[$employee['employee_id']]['daily_duration'] != '') echo secondsToDHMS($employee_working_details[$employee['employee_id']]['total_duration']); ?></td>
                                                        <!-- <td><?php echo $employee['ip_address']; ?></td> -->
                                                    </tr>
                                            <?php }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel-body">
                        <div id="piechart_3d" style="height: 350px;"></div>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-6">
                <div class="panel">
                    <div class="panel-body">
                        <div id="piechart_3d2" style="height: 300px;"></div>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel_head"><?php echo $lang['inactive_users']; ?></div>
                    <div class="panel-body">
                        <div class="tab-base">
                            <div class="tab-content">
                                <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                    <table id="inactive_user" class="cell-border inactive_user table table-striped table-hover table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $lang['users']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($inactive_employees) && count($inactive_employees) > 0) {
                                                foreach ($inactive_employees as $employee) { ?>
                                                    <tr>
                                                        <td><?php echo $employee['employee_id']; ?></td>
                                                        <td><?php echo $employee['emp_name']; ?></td>
                                                    </tr>
                                            <?php }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-12">
                <div class="panel">
                    <div class="panel_head"><?php echo $lang['user_activity_log']; ?></div>
                    <div class="panel-body">
                        <div class="tab-base">
                            <div class="tab-content">
                                <div id="demo-lft-tab-1" class="tab-pane fade active in">
                                    <table id="example1" class="cell-border example1 table table-striped table-hover table-vcenter">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php echo $lang['users']; ?></th>
                                                <th><?php echo $lang['ip_address']; ?></th>
                                                <th><?php echo $lang['active']; ?></th>
                                                <th><?php echo $lang['date']; ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>

<?php
function secondsToDHMS($seconds)
{
    $s = (int)$seconds;
    // return sprintf('%d:%02d:%02d:%02d', $s/86400, $s/3600%24, $s/60%60, $s%60);
    return sprintf('%02d:%02d:%02d', $s / 3600, $s / 60 % 60, $s % 60);
}
?>

<script type="text/javascript">
    $(document).ready(function() {
        var url = '<?php echo $link->link("get_home", frontend); ?>';
        var table = $('#example1').DataTable({
            // dom: 'lfBrtip',
            "processing": true,
            "serverSide": true,
            "ajax": url,
            "iDisplayLength": 10,
            "oLanguage": {
                'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang'] ?>.json'
            }
        });
        var a_table = $('#active_user').DataTable({
            // dom: 'lfBrtip',
            "iDisplayLength": 10,
            "oLanguage": {
                'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang'] ?>.json'
            }
        });

        var ia_table = $('#inactive_user').DataTable({
            "iDisplayLength": 10,
            "oLanguage": {
                'sUrl': '//cdn.datatables.net/plug-ins/1.10.19/i18n/<?php echo $_SESSION['site_lang'] ?>.json'
            }
        });
    });
</script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    var cp_data = <?php echo json_encode($cp_data); ?>;
    // var ct_data = <?php echo json_encode($ct_data); ?>;
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable(cp_data);
        var options = {
            title: '<?php echo $lang['employees_working_on_active_projects']; ?>',
            colors: ['#50c0c9', '#8dd3dd', '#baf3f4', '#b6faff', '#203b47', '#315866', '#46737f', '#64838e'],
            pieHole: 0.4,
            // is3D: true,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);

        // console.log(ct_data);
        // var tdata = google.visualization.arrayToDataTable(ct_data);
        // var toptions = {
        //     title: '<?php echo $lang['employees_working_on_active_task']; ?>',
        //     is3D: true,
        // };
        // var chart2 = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
        // chart2.draw(tdata, toptions);
    }
</script>