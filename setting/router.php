<?php
/* directory that contain classes */
$classesDir = array(
    SERVER_ROOT . '/protected/library/'
);
/* loading all library components in everywhere */
spl_autoload_register(function ($class) {
    global $classesDir;
    foreach ($classesDir as $directory) {
        if (file_exists($directory . $class . '_class.php')) {
            require($directory . $class . '_class.php');

            return;
        }
    }
    require($directory . 'ssp_class.php');
});
/* loading all library end */
/* Connect to an ODBC database using driver invocation */
// $db = new db("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
if (file_exists(SERVER_ROOT . "/protected/setting/" . Appname . "lock")) {
    $db = new db("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
}
$fv = new form_validations();
$feature = new feature();
$password = new password();
$link = new links();
$session = new session();
$security = new security();


/**
 * This controller routes all incoming requests to the appropriate controller and page
 */

$request = explode('?', $_SERVER['REQUEST_URI']);
$parsed = explode('=', $request['1']);
$query3ans = $parsed['3'];

$query1 = $parsed['0'];
$getParsed = explode('&', $parsed['1']);

$query1ans = $getParsed['0'];
$query2 = $getParsed['1'];
$query2ans = $parsed['2'];
$query2ans_extended = explode('&', $query2ans);
$query2ans = $query2ans_extended['0'];
$query3 = $query2ans_extended['1'];

if (!file_exists(SERVER_ROOT . "/protected/setting/" . Package . "lock")) {

    setcookie('remember_me', "", time() - 3600);
    session_unset();
    session_destroy();
    $query1 = 'user';
    if ($query1ans != 'installation' && $query1ans != 'installation_final')
        $query1ans = 'installation';
    $query1 = "installation";
    require SERVER_ROOT . '/protected/setting/installationcases.php';
} else {


    require SERVER_ROOT . '/protected/setting/frontendcases.php';
}
