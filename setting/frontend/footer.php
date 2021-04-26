<nav id="mainnav-container">
    <div id="mainnav">

        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <ul id="mainnav-menu" class="list-group">
                        <!--<li class="list-header"><?php echo $lang['navigation']; ?></li>-->
                        <?php if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) { ?>
                            <li>
                                <a class="<?php if ($query1ans == "home") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('home', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-01.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                    <span class="menu-title"><?php echo $lang['dashboard']; ?></span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php
                        if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) { ?>
                            <li>
                                <a class="<?php if ($query1ans == "dashboard") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('dashboard', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-01.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                    <span class="menu-title"><?php echo $lang['dashboard']; ?></span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php
                        if ($_SESSION['department'] == 5) { ?>
                            <li>
                                <a class="<?php if ($query1ans == "company") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('company', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-02.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                    <span class="menu-title"><?php echo $lang['company']; ?></span>
                                </a>
                            </li>

                            <li>
                                <a class="<?php if ($query1ans == "admin") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('admin', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-04.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                    <span class="menu-title"><?php echo $lang['admin']; ?></span>
                                </a>
                            </li>

                            <!-- <li>
                                <a class="<?php if ($query1ans == "search") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('search', frontend); ?>">
                                  <i><img src="uploads/logo/company_icons/icons_flex-05.png" style ="width:20px;height:20px;"></i>

                                    <span class="menu-title"><?php echo $lang['search']; ?></span>
                                </a>
                            </li> -->

                            <li>
                                <a class="<?php if ($query1ans == "managers") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('managers', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-06.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                    <span class="menu-title"><?php echo $lang['managers']; ?></span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4) { ?>
                            <li>
                                <a class="<?php if ($query1ans == "supervisors") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('supervisors', frontend); ?>">
                  <i><img src="uploads/logo/company_icons/icons_flex-03.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
   
                                    <span class="menu-title"><?php echo $lang['supervisors']; ?></span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) { ?>
                            <li>
                                <a class="<?php if ($query1ans == "search_freelancer") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('search_freelancer', frontend); ?>">
                   <i><img src="uploads/logo/company_icons/icons_flex-05.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>

                                    <span class="menu-title"><?php echo $lang['search']; ?></span>
                                </a>
                            </li>
                            <li class="hidden">
                                <a class="<?php if ($query1ans == "users") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('users', frontend); ?>">
                                    <i class="fa fa-users"></i>
                                    <span class="menu-title"><?php echo $lang['employees']; ?></span>
                                </a>
                            </li>

                            <li>
                                <a class="<?php if ($query1ans == "freelancers") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('freelancers', frontend); ?>">
                           <i><img src="uploads/logo/company_icons/icons_flex-25.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                           <span class="menu-title"><?php echo $lang['freelancers']; ?></span>
                                </a>
                            </li>

                            <li>
                                <a class="<?php if ($query1ans == "projects") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('projects', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-08.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                    <span class="menu-title"><?php echo $lang['projects']; ?></span>
                                </a>
                            </li>


                            <li>
                                <a class="<?php if ($query1ans == "tasks") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('tasks', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-09.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                    <span class="menu-title"><?php echo $lang['tasks']; ?></span>
                                </a>
                            </li>

                            <li class="hidden">
                                <a class="<?php if ($query1ans == "edit_time") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('edit_time', frontend); ?>">
                                    <i class="fa fa-clock-o"></i>
                                    <span class="menu-title"><?php echo $lang['edit_time']; ?></span>
                                </a>
                            </li>

                        <?php } ?>

                        <?php
                        $message_notification = 0;
                        $messages = array();
                        if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
                            $messages = $db->run("SELECT * from `messages` where  `company_id` = '" . $_SESSION['company_id'] . "' and admin_status = 0 ")->fetchAll();
                        }

                        if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
                            $messages = $db->run("SELECT * from `messages` where `employee_id`= '" . $_SESSION['employee_id'] . "' AND `company_id` = '" . $_SESSION['company_id'] . "' and emp_status = 0 ")->fetchAll();
                        }
                        $message_notification = count($messages);
                        ?>

                        <li>
                            <a class="<?php if ($query1ans == "messages") {
                                            echo "current";
                                        } ?>" href="<?php echo $link->link('messages', frontend);
                                                    if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
                                                        echo '&employee_id=' . $_SESSION['employee_id'];
                                                    } ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-11.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                <span class="menu-title"><?php echo $lang['messages']; ?></span>
                                <?php
                                if ($message_notification > 0) {
                                ?>
                                    &nbsp;<span class="notification badge badge-info"><?php echo $message_notification; ?></span>
                                <?php
                                }
                                ?>
                            </a>
                        </li>

                        <?php
                        $email_notification = 0;
                        $emails = array();
                        if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
                            $emails = $db->run("SELECT * from `emails` where  `company_id` = '" . $_SESSION['company_id'] . "' and admin_status = 0 ")->fetchAll();
                        }

                        if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
                            $emails = $db->run("SELECT * from `emails` where `employee_id`= '" . $_SESSION['employee_id'] . "' AND `company_id` = '" . $_SESSION['company_id'] . "' and emp_status = 0 ")->fetchAll();
                        }
                        $email_notification = count($emails);
                        ?>

                        <li>
                            <a class="<?php if ($query1ans == "emails") {
                                            echo "current";
                                        } ?>" href="<?php echo $link->link('emails', frontend);
                                                    if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
                                                        echo '&employee_id=' . $_SESSION['employee_id'];
                                                    } ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-12.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                <span class="menu-title"><?php echo $lang['emails']; ?></span>
                                <?php
                                if ($email_notification > 0) {
                                ?>
                                    &nbsp;<span class="notification badge badge-info"><?php echo $email_notification; ?></span>
                                <?php
                                }
                                ?>
                            </a>
                        </li>

                        <?php
                        $file_notification = 0;
                        $files = array();
                        if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
                            $files = $db->run("SELECT * from `files` where  `company_id` = '" . $_SESSION['company_id'] . "' and admin_status = 0 ")->fetchAll();
                        }

                        if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
                            $files = $db->run("SELECT * from `files` where `employee_id`= '" . $_SESSION['employee_id'] . "' AND `company_id` = '" . $_SESSION['company_id'] . "' and emp_status = 0 ")->fetchAll();
                        }
                        $file_notification = count($files);
                        ?>

                        <li>
                            <a class="<?php if ($query1ans == "files") {
                                            echo "current";
                                        } ?>" href="<?php echo $link->link('files', frontend);
                                                    if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
                                                        echo '&employee_id=' . $_SESSION['employee_id'];
                                                    } ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-13.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                <span class="menu-title"><?php echo $lang['files']; ?></span>
                                <?php
                                if ($file_notification > 0) {
                                ?>
                                    &nbsp;<span class="notification badge badge-info"><?php echo $file_notification; ?></span>
                                <?php
                                }
                                ?>
                            </a>
                        </li>

                        <li>
                            <a class="<?php if ($query1ans == "reports") {
                                            echo "current";
                                        } ?>" href="<?php echo $link->link('reports', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/worinkg_hours_icon-01.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                <span class="menu-title"><?php echo $lang['working_hours']; ?></span>
                            </a>
                        </li>

                        <li>
                            <!-- Link with dropdown items -->
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"> <i><img src="uploads/logo/company_icons/icons_flex-14.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>

                                <span class="menu-title"><?php echo $lang['reports']; ?></span></a>
                            <ul class="collapse list-unstyled <?php if ($query1ans == "reports" || $query1ans == "attendance" || $query1ans == "c_reports" || $query1ans == "employee_reports") {
                                                                    echo "in";
                                                                } ?>" id="homeSubmenu">
                                <li>
                                    <a class="<?php if ($query1ans == "attendance") {
                                                    echo "current";
                                                } ?>" href="<?php echo $link->link('attendance', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-16.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                        <span class="menu-title"><?php echo $lang['attendance']; ?></span>
                                    </a>
                                </li>

                                <!-- <li>
                                    <a class="<?php if ($query1ans == "reports") {
                                                    echo "current";
                                                } ?>" href="<?php echo $link->link('reports', frontend); ?>">
                                        <i class="fa fa-clock-o"></i>
                                        <span class="menu-title"><?php echo $lang['working_hours']; ?></span>
                                    </a>
                                </li> -->

                                <li>
                                    <a class="<?php if ($query1ans == "c_reports") {
                                                    echo "current";
                                                } ?>" href="<?php echo $link->link('c_reports', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-18.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                        <span class="menu-title"><?php echo $lang['daily_report']; ?></span>
                                    </a>
                                </li>

                                <li>
                                    <a class="<?php if ($query1ans == "c_reports" && $query2 == 'weekly') {
                                                    echo "current";
                                                } ?>" href="<?php echo $link->link('c_reports&weekly', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-19.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                        <span class="menu-title"><?php echo $lang['weekly_report']; ?></span>
                                    </a>
                                </li>

                                <li>
                                    <a class="<?php if ($query1ans == "c_reports" && $query2 == 'monthly') {
                                                    echo "current";
                                                } ?>" href="<?php echo $link->link('c_reports&monthly', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-20.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                        <span class="menu-title"><?php echo $lang['monthly_report']; ?></span>
                                    </a>
                                </li>

                                <?php if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) { ?>
                                    <li class="hidden">
                                        <a class="<?php if ($query1ans == "employee_reports") {
                                                        echo "current";
                                                    } ?>" href="<?php echo $link->link('employee_reports', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-21.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                            <span class="menu-title"><?php echo $lang['employee']; ?></span>
                                        </a>
                                    </li>
                                <?php } ?>

                            </ul>
                        </li>

                        <?php if ($_SESSION['department'] == 3) { ?>
                            <li>
                                <a class="<?php if ($query1ans == "previous_jobs") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('previous_jobs', frontend); ?>">
                                   <i><img src="uploads/logo/company_icons/jobs_icon-01.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                    <span class="menu-title"><?php echo $lang['list_previous_jobs']; ?></span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4) { ?>
                            <li>
                                <a class="<?php if ($query1ans == "site_setting") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('site_setting', frontend); ?>">
                                    <i><img src="uploads/logo/company_icons/icons_flex-15.png" style ="width:30px;height:30px;margin: 0px -10px;"></i>
                                    <span class="menu-title"><?php echo $lang['company_settings']; ?></span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($_SESSION['department'] == 5) { ?>
                            <li class="list-header">API & Upgrade</li>
                            <li>
                                <a class="<?php if ($query1ans == "url") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('url', frontend); ?>">
                                    <i class="fa fa-external-link-square"></i>
                                    <span class="menu-title">Timenox API </span>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if ($dbtn == true && $_SESSION['department'] == 5) { ?>
                            <li>
                                <a class="<?php if ($query1ans == "updates") {
                                                echo "current";
                                            } ?>" href="<?php echo $link->link('updates', frontend); ?>">
                                    <i class="fa fa-tint"></i>
                                    <span class="menu-title">Timenox Updates</span>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="list-divider"></li>
                    </ul>
                    <div class="mainnav-widget">
                        <!-- Show the button on collapsed navigation -->
                        <div class="show-small">
                            <a href="#" data-toggle="menu-widget" data-target="#demo-wg-server">
                                <i class="fa fa-desktop"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
</div>
<footer id="footer">
    <div class="show-fixed pull-right">

    </div>
    <div class="hide-fixed pull-right pad-rgt">V3.0</div>
    <p class="pad-lft">&copy 2017 - <?php echo date("Y") . ' TechSup Flex Time'; ?></p>
</footer>
<button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
</div>


<script src="<?php echo SITE_URL . '/assets/frontend/js/bootstrap.min.js'; ?>"></script>

<script src="<?php echo SITE_URL . '/assets/frontend/js/scripts.js'; ?>"></script>
<script src="<?php echo SITE_URL . '/assets/frontend/plugins/metismenu/metismenu.min.js'; ?>"></script>

<script src="<?php echo SITE_URL . '/assets/frontend/plugins/nanoscrollerjs/jquery.nanoscroller.min.js'; ?>"></script>

<script src="<?php echo SITE_URL . '/assets/frontend/plugins/datatables/media/js/jquery.dataTables.js'; ?>"></script>
<script src="<?php echo SITE_URL . '/assets/frontend/plugins/datatables/media/js/dataTables.bootstrap.js'; ?>"></script>
<script src="<?php echo SITE_URL . '/assets/frontend/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js'; ?>"></script>

<script src="<?php echo SITE_URL . '/assets/frontend/plugins/screenfull/screenfull.js'; ?>"></script>
<script src="<?php echo SITE_URL . '/assets/frontend/plugins/parsley/parsley.min.js'; ?>"></script>
<script>
    $(document).ready(function() {

        $('#company_select').change(function() {
            var selected_id = $(this).val();
            var department = <?php echo $_SESSION['department'] ?>;
            var url = '<?php echo $link->link("home", frontend); ?>';
            if (department == 3) {
                var url = '<?php echo $link->link("dashboard", frontend); ?>';
            }
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    selected_company_id: selected_id
                },
                success: function(data) {
                    window.location = url;
                },
            });
        });

        // $('.demo-panel-ref-btn').jasmineOverlay().on('click', function() {
        //     var $el = $(this),
        //         relTime;
        //     $el.jasmineOverlay('show');

        //     relTime = setInterval(function() {
        //         $el.jasmineOverlay('hide');

        //         clearInterval(relTime);
        //     }, 2000);
        // });

        $("[data-click=panel-expand]").click(function(e) {
            e.preventDefault();
            var t = $(this).closest(".panel");
            if ($("body").hasClass("panel-expand") && $(t).hasClass("panel-expand")) {
                $("body, .panel").removeClass("panel-expand");
                $(".panel").removeAttr("style")
            } else {
                $("body").addClass("panel-expand");
                $(this).closest(".panel").addClass("panel-expand")
            }
            $(window).trigger("resize")
        });

        $("[data-click=panel-collapse]").click(function(e) {
            e.preventDefault();
            $(this).closest(".panel").find(".panel-body").slideToggle()
        });
        $("[data-click=panel-reload]").click(function(e) {
            e.preventDefault();
            var t = $(this).closest(".panel");
            if (!$(t).hasClass("panel-loading")) {
                var n = $(t).find(".panel-body");
                var r = '<div class="panel-loader"><span class="spinner-small"></span></div>';
                $(t).addClass("panel-loading");
                $(n).prepend(r);
                setTimeout(function() {
                    $(t).removeClass("panel-loading");
                    $(t).find(".panel-loader").remove()
                }, 2000)
            }
        });
    });
</script>
<script src="<?php echo SITE_URL . '/assets/frontend/js/tables-datatables.js'; ?>"></script>
<script src="<?php echo SITE_URL . '/assets/frontend/plugins/bootstrap-datepicker/bootstrap-datepicker.js'; ?>"></script>

<script src="<?php echo SITE_URL . '/assets/frontend/plugins/bootstrap-datepicker/moment.js'; ?>" type="text/javascript"></script>
<script src="<?php echo SITE_URL . '/assets/frontend/plugins/bootstrap-datepicker/bootstrap-datetimepicker.js'; ?>"></script>

<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true
    });

    $('.datepicker1').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        autoclose: true,
        endDate: '+0d',
        todayHighlight: true
    });
    
    $('.birthdate').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        endDate: '+0d',
        todayHighlight: true,
        startView: 2
    });
</script>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<!--jQuery UI [ REQUIRED ]-->
<script src="<?php echo SITE_URL . '/assets/frontend/js/jquery-ui.min.js'; ?>"></script>
<!-- <script src="<?php echo SITE_URL . '/assets/frontend/plugins/tag-it/tag-it.min.js'; ?>"></script> -->
<!--Chosen [ OPTIONAL ]-->
<script src="<?php echo SITE_URL . '/assets/frontend/plugins/chosen/chosen.jquery.min.js'; ?>"></script>
<!-- <script src="<?php echo SITE_URL . '/assets/frontend/js/demo/form-component.js'; ?>"></script> -->

<!--Switchery [ OPTIONAL ]-->
<!-- <script src="<?php echo SITE_URL . '/assets/frontend/' ?>plugins/switchery/switchery.min.js"></script> -->
<!--Fullscreen jQuery [ OPTIONAL ]-->
<!-- <script src="<?php echo SITE_URL . '/assets/frontend/' ?>plugins/screenfull/screenfull.js"></script> -->
<!--Form Wizard [ SAMPLE ]-->
<!-- <script src="<?php echo SITE_URL . '/assets/frontend/' ?>js/demo/form-switchery.js"></script> -->

<script>
    $("#application_visibility").change(function() {
        var av = $(this).val();
        if (av == 'no') {
            $(".table-responsive").hide();
            $("#lg").show();
        } else {
            $(".table-responsive").show();
            $("#lg").hide();
        }

    });
    $(".demo-cs-multiselect").chosen({
        width: "100%"
    });
</script>

<script>
    $("#r2").click(function() {
        $("#selectEmployees").show();
    });
    $("#r1").click(function() {
        $("#selectEmployees").hide();
    });
</script>

</body>

</html>