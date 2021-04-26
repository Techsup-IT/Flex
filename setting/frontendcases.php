<?php

$_SESSION['site_lang'] = $_SESSION['site_lang'] ?: 'English';
if (file_exists(SERVER_ROOT . '/protected/languages/lang_' . $_SESSION['site_lang'] . '.php')) {
    require SERVER_ROOT . '/protected/languages/lang_' . $_SESSION['site_lang'] . '.php';
}

if (!isset($query1ans) || $query1 == '' || $query1ans == '') {
    $query1 = frontend;
    $query1ans = 'login';
}
if ($query1ans == 'signup' && $db->get_count('company') >= com_number) {
    $session->redirect('login', frontend);
} elseif ($query1ans == 'login' && $db->get_count('company') == 0) {
    $session->redirect('signup', frontend);
}
$fcontroller = SERVER_ROOT . '/protected/controller/frontend/' . $query1ans . '_controller.php';

// if ($query1ans == 'get_users' || $query1ans == 'get_freelancers' || $query1ans == 'get_managers' || $query1ans == 'get_admin' || $query1ans == 'get_search_data' || $query1ans == 'get_tasks' || $query1ans == 'get_home' || $query1ans == 'edit_data' || $query1ans == 'get_messages' || $query1ans == 'change_lang') {
//     require $fcontroller;
// }

$api_controllers = array(
    'get_users', 'get_freelancers', 'get_managers', 'get_admin',
    'get_search_data', 'get_tasks', 'get_home', 'edit_data', 'get_messages',
    'change_lang', 'register_company'
);
if (in_array($query1ans, $api_controllers)) {
    require $fcontroller;
}
$fview = SERVER_ROOT . '/protected/views/frontend/' . $query1ans . ".php";

$views_array = array(
    "login", "signup", "forgot_password", "404", "tracker_counter",
    "tracker_dashboard", "tracker_chart2", "tracker_login", "tracker_add_activity",
    "tracker_add_check", "404", "tracker_logs", "tracker_chart1", "tracker_view_check",
    "tracker_view_activity", "tracker_preview", "tracker_project", "tracker_user_profile",
    "tracker_task", "wizardpost", "test2", "test", "test1", "test3", "stripeapi",
    "tracker_chat_room", "tracker_counter_i", "tracker_dashboard_i", "tracker_chart2_i",
    "tracker_login_i", "tracker_add_activity_i", "tracker_add_check_i", "tracker_logs_i",
    "tracker_chart1_i", "tracker_view_check_i", "tracker_view_activity_i",
    "tracker_preview_i", "tracker_project_i", "tracker_user_profile_i", "tracker_task_i",
    "tracker_chat_room_i", "tracker_token", "tracker_emails", "tracker_files",
    "tracker_messages", "tracker_user_details", 'user_validations',
    "register_company", 'register_freelancer',
);
if (in_array($query1ans, $views_array)) {
    if (file_exists($fview)) {
        if (file_exists($fcontroller))
            require $fcontroller;
        require $fview;
    }
} elseif ($query1ans == "logout") {
    setcookie('remember_me', "", time() - 3600);
    $session->destroy('login', frontend);
} elseif (!file_exists($fview) || $query1ans == 'installation_final' || $query1ans == 'installation') {

    header("HTTP/1.0 404 Not Found");
    require SERVER_ROOT . '/protected/views/frontend/404.php';
} else {

    if (file_exists(SERVER_ROOT . '/protected/setting/frontend/common_data.php')) {

        require SERVER_ROOT . '/protected/setting/frontend/common_data.php';
    }
    if (file_exists(SERVER_ROOT . '/protected/setting/frontend/header.php')) {
        if ($query1ans != 'pdfgenerate')
            require SERVER_ROOT . '/protected/setting/frontend/header.php';
    }
    if (file_exists(SERVER_ROOT . '/protected/setting/frontend/sidebar.php')) {
        require SERVER_ROOT . '/protected/setting/frontend/sidebar.php';
    }
    if (file_exists($fview)) {
        if (file_exists($fcontroller))
            require $fcontroller;
        require $fview;
    }

    if (file_exists(SERVER_ROOT . '/protected/setting/frontend/footer.php')) {
        require SERVER_ROOT . '/protected/setting/frontend/footer.php';
    }
}
