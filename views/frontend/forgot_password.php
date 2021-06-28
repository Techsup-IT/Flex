<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    if ($db->exists('company', array('id' => 1))) {
        $setting = $db->get_row('company', array('id' => 1));
    } else {
        $setting = $db->get_row('settings');
    }

    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if ($db->exists('company', array('id' => 1))) { ?>
            <?php echo $setting['company_name']; ?>
        <?php } else { ?>
            <?php echo $setting['name']; ?>
        <?php } ?></title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:300,400,700" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/css/style.css'; ?>" rel="stylesheet">

    <!-- custom css -->
    <link href="<?php echo SITE_URL . '/assets/frontend/css/custom.css'; ?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo SITE_URL . '/assets/frontend/js/jquery-2.1.1.min.js'; ?>"></script>
</head>

<body>
    <div id="container" class="cls-container">
        <div class="lock-wrapper">

            <div class="panel lock-box">
                <div class="center">

                    <?php if ($db->exists('company', array('id' => 1))) {
                        if ($setting['logo'] == '') {
                    ?>
                            <img src="<?php echo SITE_URL . '/uploads/noimage.png'; ?>" width="150px;">
                        <?php } else { ?>
                            <img src="<?php echo SITE_URL . '/uploads/logo/company_logo/' . $setting['logo']; ?>" width="200px;" />

                        <?php }
                    } else { ?>
                        <!-- <img  src="<?php echo SITE_URL . '/uploads/logo/' . $setting['logo']; ?>" class="img-circle"/> -->
                        <img src="<?php echo SITE_URL . '/uploads/logo/' . $setting['logo']; ?>" width="200px;" />
                    <?php } ?>

                    <div class="registration"> Log In to account ! <a href="<?php echo $link->link('login', frontend); ?>"> <span class="text-primary"> Sign In </span> </a> </div>

                </div>
                <hr>
                <h4> <?php echo $lang['hello_user']; ?></h4>
                <p class="text-center"><?php echo $lang['login_to_access_account']; ?></p>
                <div class="row">
                    <?php echo $display_msg; ?>
                    <?php if ($exists == 1 && isset($_REQUEST['random']) && $_REQUEST['random'] != '') { ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form-inline" method="post" id="forgotPasswordForm">
                            <input class="form-control" type="hidden" placeholder="token" name="token" value="<?php echo $_REQUEST['random']; ?>">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="text-left">
                                    <label for="signupInputPassword" class="text-muted"><?php echo $lang['password']; ?></label>
                                    <input class="form-control" type="password" placeholder="<?php echo $lang['password']; ?>" name="password">
                                </div>
                                <div class="text-left">
                                    <label for="signupInputPassword" class="text-muted"><?php echo $lang['retype_password']; ?></label>
                                    <input class="form-control" type="password" placeholder="<?php echo $lang['retype_password']; ?>" name="retypepassword">
                                </div>

                                <button type="submit" name="change_pass" class="btn btn-block btn-primary">
                                    <i class="fa  fa-sign-in fa-lg"></i> <?php echo $lang['change_password']; ?>
                                </button>
                            </div>
                        </form>
                    <?php } else { ?>
                        <form action="<?php $_SERVER['PHP_SELF']; ?>" class="form-inline" method="post" id="login_form">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <div class="text-left">
                                    <label class="text-muted"><?php echo $lang['email_id']; ?></label>
                                    <input class="form-control" placeholder="<?php echo $lang['email']; ?>" type="text" name="email" value="<?php echo $forgot_email; ?>">
                                </div>

                                <button type="submit" name="forgot_pass" class="btn btn-block btn-primary">
                                    <i class="fa  fa-sign-in fa-lg"></i> <?php echo $lang['submit']; ?>
                                </button>
                            </div>
                        </form>

                    <?php } ?>

                </div>
            </div>
            <!-- <div class="registration"> <?php echo $lang['login_to_account']; ?> <a href="<?php echo $link->link('login', frontend); ?>"> <span class="text-primary"> <?php echo $lang['sign_in']; ?> </span> </a> </div> -->
        </div>
    </div>

    <script src="<?php echo SITE_URL . '/assets/frontend/js/bootstrap.min.js'; ?>"></script>
    <!-- jQuery-Vaildation -->
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/jquery-validation/jquery.validate.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/jquery-validation/additional-methods.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/js/form-validation.js'; ?>"></script>

</body>

</html>