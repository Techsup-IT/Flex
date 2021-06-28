<?php
define('Appname', 'chimpu');
define('Package', 'chimpu');
define('frontend', 'user');
defined('admin') or define('admin', 'admin');
defined('backend') or define('backend', 'backend');
define('owner', 'TIMENOX');
define('key', '7895215780405209');
define('js', SERVER_ROOT . "/assets/frontend/plugins/LICENSE.md");
define('com_number', '1');
define('trversion', '5');
define('stripe_publishkey_test', 'pk_test_RYEwLLjceoYo7I2fYZPJH3Ct'); //pk_test_RYEwLLjceoYo7I2fYZPJH3Ct
define('stripe_secretkey_test', 'sk_test_KXph2B1DZXtvrG26qi9gTkf3'); //sk_test_KXph2B1DZXtvrG26qi9gTkf3
define('FACEBOOK_API_ID', '');
define('FACEBOOK_API_SECRET', '');
define('GOOGLE_CLIENT_ID', '');
define('GOOGLE_CLIENT_SECRET', '');
$dbtn = false;
if (ini_get('allow_url_fopen') == 1) {
    // $trupd=file_get_contents('http://www.iwcnetwork.com/timenox/timenoxUpdate/webupdate.php');
    if ($trupd) {
        $trupd = json_decode($trupd, true);
        if ($trupd['version'] > trversion) {
            $updm = '<div class="col-md-12">
        <div class="panel">
        <div class="panel-heading">
        <h3 class="panel-title"> New Update Available </h3>
        </div>
        <div class="panel-body panel panel-mint panel-colorful">
        <div class="">
        <p>"' . $trupd['description'] . '"</p>
                                                    <p><a class="btn btn-primary btn-lg" href="' . $trupd['path'] . '" role="button">Download Now</a></p> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
            $dbtn = true;
        }
    }
}
