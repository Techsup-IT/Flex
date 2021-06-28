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
    <title>
        <?php if ($db->exists('company', array('id' => 1))) { ?>
            <?php echo $setting['company_name']; ?>
        <?php } else { ?>
            <?php echo $setting['name']; ?>
        <?php } ?>
    </title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700|Roboto:300,400,700" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/css/bootstrap.min.css'; ?>" rel="stylesheet">
    <link href="<?php echo SITE_URL . '/assets/frontend/css/style.css'; ?>" rel="stylesheet">

    <!-- custom css -->
    <link href="<?php echo SITE_URL . '/assets/frontend/css/custom.css'; ?>" rel="stylesheet">

    <!-- jQuery -->
    <script src="<?php echo SITE_URL . '/assets/frontend/js/jquery-2.1.1.min.js'; ?>"></script>

    <!--Start of Tawk.to Script-->
    <!-- <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/58c1a12497fbd80a94f74d80/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script> -->
    <!--End of Tawk.to Script-->

    <style>
        #privacy_container {
            margin-top: 50px;
            border-top: 1px solid gainsboro;
        }

        #privacy_container h3 {
            text-decoration: underline overline;
            text-underline-offset: 7px;
        }
    </style>
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


                </div>
                <p class="text-center"></p>
                <h4> <?php echo $lang['login_to_access_account']; ?></h4>

                <div class="row">
                    <?php echo $display_msg; ?>
                    <form id="login_form" action="<?php $_SERVER['PHP_SELF']; ?>" class="form-inline" method="post">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <div class="text-left">
                                <label class="text-muted"><?php echo $lang['email_id']; ?></label>
                                <input name="email" type="email" id="login_email" placeholder="<?php echo $lang['enter_email_id']; ?>" value="" class="form-control" required />
                            </div>
                            <div class="text-left">
                                <label for="signupInputPassword" class="text-muted"><?php echo $lang['password']; ?></label>
                                <input name="password" type="password" placeholder="<?php echo $lang['password']; ?>" value="" class="form-control lock-input" required />
                            </div>

                            <?php
                            echo file_get_contents(SERVER_ROOT . '/protected/views/frontend/privacy_template.php');
                            ?>
                            <hr>

                            <div class="text-left privacy_checkbox_container">
                                <input name="privacy_checkbox" type="checkbox" value="1" class="form-control privacy_checkbox" style="width: auto !important; height: auto; margin-right: 10px;" required />
                                <?php echo $lang['privacy_policy']; ?>
                            </div>

                            <div class="pull-right pad-btm">
                                <a style="color:black;" href="<?php echo $link->link('forgot_password', frontend); ?>"><?php echo $lang['forgot_password']; ?></a>
                            </div>
                            <button type="submit" value="Log in" name="submit_login" class="btn btn-block btn-primary login_button" disabled>
                                <i class="fa  fa-sign-in fa-lg"></i> <?php echo $lang['sign_in']; ?>
                            </button>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="registration row">
                    <div class="col-md-12">
                        Don't have an account !
                    </div>
                    <div class="col-md-6"><a href="<?php echo $link->link('register_company', frontend); ?>"> <span class="text-primary"> Register as Company </span> </a></div>
                    <div class="col-md-6"><a href="<?php echo $link->link('register_freelancer', frontend); ?>"> <span class="text-primary"> Register as Freelancer </span> </a></div>
                </div>
            </div>
            <?php
            if ($query1ans == 'login' && $db->get_count('company') < com_number) {
            ?>
                <div class="registration"> Don't have an account ! <a href="<?php echo $link->link('signup', frontend); ?>"> <span class="text-primary"> Sign Up </span> </a> </div>
            <?php
            } ?>

        </div>
    </div>

    <script src="<?php echo SITE_URL . '/assets/frontend/js/bootstrap.min.js'; ?>"></script>
    <!-- jQuery-Vaildation -->
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/jquery-validation/jquery.validate.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/plugins/jquery-validation/additional-methods.min.js'; ?>"></script>
    <script src="<?php echo SITE_URL . '/assets/frontend/js/form-validation.js'; ?>"></script>

    <script>
        $(document).ready(function() {
            $('#privacy_container').hide();
            $('.privacy_checkbox_container').hide();
            if ($('#login_email').val() != '') {
                privacy_check();
            }

            $('.privacy_checkbox').click(function() {
                $(".login_button").attr('disabled', 'disabled');
                if ($(this).is(":checked")) {
                    $(".login_button").removeAttr('disabled');
                }
            });

            var timeout = null;
            $('#login_email').on('input', function() {
                clearTimeout(timeout);
                timeout = setTimeout(function() {
                    privacy_check();
                }, 1000);
            });
        });

        function privacy_check() {
            var email = $('#login_email').val();
            if (validateEmail(email)) {
                var url = '<?php echo $link->link("user_validations"); ?>';
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        'validation_type': 'privacy_check',
                        'email': email
                    },
                    success: function(response) {
                        res = JSON.parse(response);
                        if (res && res.status === true) {
                            if (res.data.privacy_check == 1) {
                                $('#privacy_container').hide();
                                $(".login_button").removeAttr('disabled');
                            } else {
                                $('#privacy_container').show();
                                $('.privacy_checkbox_container').show();
                                $(".login_button").attr('disabled', 'disabled');
                            }
                        }
                    }
                });
            }
        }

        function validateEmail(email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test(email);
        }
    </script>

</body>

</html>