<?php
if (! isset($query1ans) || $query1 == '' || $query1ans == '') {
    $query1 = user;
    $query1ans = 'home';
}
$fcontroller = SERVER_ROOT . '/protected/controller/installation/' . $query1ans . '_controller.php';
$fview = SERVER_ROOT . '/protected/views/installation/' . $query1ans . ".php";
if ($query1ans == "login" || $query1ans == 'signup' || $query1ans == 'forgot_password' || $query1ans == 'installation_final' || $query1ans == 'installation' || $query1ans == 'ajax') {
    if (file_exists($fview)) {
        if (file_exists($fcontroller))
            require $fcontroller;
        require $fview;
    }
} elseif ($query1ans == "logout") {
    setcookie('remember_me', "", time() - 3600);
    $session->destroy('login', frontend);
}
elseif (!file_exists($fview)) {
    header("HTTP/1.0 404 Not Found");
    require SERVER_ROOT . '/protected/views/installation/404.php';
}
else {
    if (file_exists(SERVER_ROOT . '/protected/setting/installation/common_data.php')) {

        require SERVER_ROOT . '/protected/setting/installation/common_data.php';
    }
    if (file_exists(SERVER_ROOT . '/protected/setting/installation/header.php')) {
        if($query1ans!='pdfgenerate')
        require SERVER_ROOT . '/protected/setting/installation/header.php';
    }
    if (file_exists(SERVER_ROOT . '/protected/setting/installation/sidebar.php')) {
        require SERVER_ROOT . '/protected/setting/installation/sidebar.php';
    }
    if (file_exists($fview)) {
        if (file_exists($fcontroller))
            require $fcontroller;
        require $fview;
    }

    if (file_exists(SERVER_ROOT . '/protected/setting/installation/footer.php')) {
        require SERVER_ROOT . '/protected/setting/installation/footer.php';
    }
}
?>