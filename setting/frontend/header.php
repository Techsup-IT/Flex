<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $company_details['company_name']; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:300,400,700" rel="stylesheet">

    <link href="<?php echo SITE_URL . '/assets/frontend/css/bootstrap.min.css'; ?>" rel="stylesheet">

    <link href="<?php echo SITE_URL . '/assets/frontend/css/style.css'; ?>" rel="stylesheet">

    <link href="<?php echo SITE_URL . '/assets/frontend/plugins/font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet">

    <link href="<?php echo SITE_URL . '/assets/frontend/plugins/datatables/media/css/dataTables.bootstrap.css'; ?>" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css'; ?>" rel="stylesheet">

    <link href="<?php echo SITE_URL . '/assets/frontend/plugins/bootstrap-datepicker/bootstrap-datepicker.css'; ?>" rel="stylesheet">
    <script src="<?php echo SITE_URL . '/assets/frontend/js/jquery-2.1.1.min.js'; ?>"></script>

    <!--Chosen [ OPTIONAL ]-->
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/chosen/chosen.jquery.min.js'; ?>"></script>
    <link href="<?php echo SITE_URL . '/assets/frontend/plugins/chosen/chosen.min.css'; ?>" rel="stylesheet">

    <!--Switchery [ OPTIONAL ]-->
    <!-- <link href="<?php echo SITE_URL . '/assets/frontend/plugins/switchery/switchery.min.css'; ?>" rel="stylesheet"> -->

    <!-- added export buttons -->
    <link href="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/jquery.dataTables.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/dataTables.tableTools.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.flash.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/jszip.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/vfs_fonts.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_URL; ?>/assets/frontend/js/report_buttons/buttons.print.min.js"></script>

    <!-- custom css -->
    <link href="<?php echo SITE_URL . '/assets/frontend/css/custom.css'; ?>" rel="stylesheet">

    <!-- jQuery-Vaildation -->
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/jquery-validation/jquery.validate.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/jquery-validation/additional-methods.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/js/form-validation.js'; ?>"></script>

</head>

<body>
    <div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">

        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <div class="navbar-header">
                    <a href="<?php echo SITE_URL; ?>" class="navbar-brand navbar-brand-logo" >
                         <!--<i class="fa fa-clock-o brand-icon"></i>-->
                        <!--<div class="brand-title" style="padding-left: 10px;">-->
                        <!--    <span class="brand-text" style="font-size: 20px; font-weight: 400;padding-left: 5px;">Techsup Flex Time</span>-->
                        <!--</div> -->
                        <!--<img class="logo" src="<?php echo SITE_URL . '/uploads/logo/techsupflex.png'; ?>" alt="Company Logo">-->
                        <img  class="img-responsive" src="<?php echo SITE_URL . '/uploads/logo/techsupflex_white1-01.png'; ?>" alt="Company Logo">
                        
                    </a>
                </div>

                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-left">

                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" style="color:#fff;" href="#"> <i class="fa fa-navicon fa-lg"></i> </a>
                        </li>
                        <!-- <li id="profilebtn" class="hidden-xs">
                            <a href="#"><?php echo $company_details['company_name']; ?> (<?php echo $lang['company']; ?>)</a>
                        </li> -->

                        <!-- <li>
                            <a class="fa fa-globe">
                                <?php echo $company_details['timezone']; ?>
                            </a>
                        </li> -->

                        <li>
                            <?php
                            if (in_array($_SESSION['department'], [5, 4, 3])) { ?>
                                <div class="company_top">
                                    <select id="company_select" class="form-control selectpicker" name="company" style="max-width: 300px;min-width: 250px;">
                                        <?php if (is_array($company)) foreach ($company as $value) { ?>
                                            <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $_SESSION['company_id']) echo "selected"; ?>><?php echo $value['company_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } else {
                            ?>
                                <div class="company_top"><?php echo $company_details['company_name']; ?></div>
                            <?php
                            }
                            ?>
                        </li>

                        <?php if ($dbtn == true && $_SESSION['department'] == 5) { ?>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="true"> <i class="fa fa-bell fa-lg"></i> <span class="badge badge-header badge-danger">New</span> </a>
                                <!--Notification dropdown menu-->
                                <div class="dropdown-menu dropdown-menu-md with-arrow">
                                    <div class="pad-all bord-btm">
                                        <div class="h4 text-muted text-thin mar-no"> Update Available </div>
                                    </div>

                                    <!--Dropdown footer-->
                                    <div class="pad-all bord-top">
                                        <p><a class="btn btn-primary btn-lg" href="<?php echo $link->link('updates', frontend); ?>" role="button">Upgrade Now</a></p>
                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                        </li>
                    </ul>

                    <ul class="nav navbar-top-links pull-right">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right"><?php echo $_SESSION['site_lang'] ?></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right with-arrow">

                                <ul class="head-list">
                                    <li>
                                        <a href="#" class="change_lang" data-lang="English"> <i class="fa fa-language fa-fw"></i> English </a>
                                    </li>
                                    <li>
                                        <a href="#" class="change_lang" data-lang="Arabic"> <i class="fa fa-language fa-fw"></i> Arabic </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right">
                                    <?php if (file_exists(SERVER_ROOT . '/uploads/profile/' . $user_details['emp_photo_file']) && (($user_details['emp_photo_file']) != '')) {
                                    ?>
                                        <img class="img-circle img-user media-object" src="<?php echo SITE_URL . '/uploads/profile/' . $user_details['emp_photo_file']; ?>" alt="Profile Picture">
                                    <?php } else {
                                    ?>
                                        <img class="img-circle img-user media-object" src="<?php echo SITE_URL . '/uploads/noimage.png'; ?>" alt="Profile Picture">
                                    <?php } ?>

                                </span>
                                <div class="username hidden-xs"><?php echo ucfirst($user_details['emp_name']) . " " . $user_details['emp_surname']; ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right with-arrow">

                                <ul class="head-list">
                                    <li>
                                        <?php if ($_SESSION['department'] == 3) { ?>
                                            <a href="<?php echo $link->link('freelancer_profile', frontend) ?>"> <i class="fa fa-user fa-fw"></i> <?php echo $lang['profile']; ?> </a>
                                        <?php } else { ?>
                                            <a href="<?php echo $link->link('profile', frontend) ?>"> <i class="fa fa-user fa-fw"></i> <?php echo $lang['profile']; ?> </a>
                                        <?php } ?>
                                        <!-- <a href="<?php echo $link->link('profile', frontend) ?>"> <i class="fa fa-user fa-fw"></i> <?php echo $lang['profile']; ?> </a> -->
                                    </li>
                                    <!-- <li>
                                            <a href="<?php echo $link->link('changepassword', frontend) ?>">  <i class="fa fa-lock fa-fw"></i> Change Password </a>
                                        </li>-->
                                    <?php if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4) { ?>
                                        <li>
                                            <a href="<?php echo $link->link('site_setting', frontend); ?>"> <i class="fa fa-gear fa-fw"></i><?php echo $lang['company_settings']; ?> </a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a href="<?php echo $link->link('logout', frontend); ?>"> <i class="fa fa-sign-out fa-fw"></i> <?php echo $lang['logout']; ?> </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <!-- <li class="hidden-xs" id="toggleFullscreen">
                            <a class="fa fa-expand" data-toggle="fullscreen" href="#" role="button">
                                <span class="sr-only">Toggle fullscreen</span>
                            </a>
                        </li> -->
                        <!--   <li class="hidden-xs">
                                <a id="demo-toggle-aside" href="#">
                                <i class="fa fa-navicon fa-lg"></i>
                                </a>
                            </li> -->
                    </ul>
                    <!-- <?php
                            if (in_array($_SESSION['department'], [5, 4, 3])) { ?>
                        <ul class="nav navbar-top-links pull-right">

                            <li class="hidden-xs">
                                <span class="company_top"> <i class="fa fa-building fa-lg"></i> <?php echo $lang['company']; ?> : </span>
                            </li>
                            <li class="hidden-xs">
                                <div class="company_top">
                                    <select id="company_select" class="form-control selectpicker" name="company" style="max-width: 300px;min-width: 250px;">
                                        <?php if (is_array($company)) foreach ($company as $value) { ?>
                                            <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $_SESSION['company_id']) echo "selected"; ?>><?php echo $value['company_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    <?php } ?> -->

                    <!-- <?php
                            if ($_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 3  || $_SESSION['department'] == 6) { ?>
                        <ul class="nav navbar-top-links pull-right">

                            <li class="hidden-xs">
                                <span class="company_top"> <i class="fa fa-building fa-lg"></i> <?php echo $lang['company']; ?> : </span>
                            </li>
                            <li class="hidden-xs">
                                <div class="company_top">
                                    <select id="company_select" class="form-control selectpicker" name="company" style="max-width: 300px;min-width: 250px;">
                                        <?php if (is_array($company)) foreach ($company as $value) { ?>
                                            <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $_SESSION['company_id']) echo "selected"; ?>><?php echo $value['company_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </li>
                        </ul>
                    <?php } ?> -->
                </div>
            </div>
        </header>

        <div class="boxed">
            <aside id="aside-container">
                <div id="aside">
                    <div class="nano closed">
                        <div class="nano-content">
                            <div class="fade in active">
                                <h4 class="pad-hor text-thin"> Members (<?php echo $user_count; ?>) </h4>
                                <ul class="list-group bg-trans">

                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <script type="text/javascript">
                $('#company_select').chosen();

                $('.change_lang').click(function() {
                    var current_lang = '<?php echo $_SESSION["site_lang"]; ?>';
                    var change_lang = $(this).attr('data-lang');
                    if (current_lang != change_lang) {
                        var url = '<?php echo $link->link("change_lang", frontend); ?>';
                        $.post(url, {
                            'site_lang': change_lang
                        }).done(function() {
                            window.location.reload();
                        });
                    }
                });
            </script>