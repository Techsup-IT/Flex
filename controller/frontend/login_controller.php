<?php

if ($db->get_count('company') == '0') {
    $session->redirect('signup', frontend);
} elseif (isset($_SESSION['email'])) {
    if (isset($_SESSION['department']) && ($_SESSION['department'] == 2 || $_SESSION['department'] == 3)) {
        $session->redirect('profile', frontend);
    } else {
        $session->redirect('home', frontend);
    }
    // $session->redirect('home',frontend);
}


if (isset($_POST['submit_login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    //$cookie_set=$_POST['cookie_set'];
    if ($email == '') {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_email_address"] . '
                        </div>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_valid_email"] . '
                        </div>';
    } elseif ($pass == '') {
        $display_msg = '<div class="alert alert-danger">
                        <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["empty_password"] . '
                        </div>';
    } else {
        $query = $db->get_row('employee', array('email' => $email));

        if ($query['department'] == 1 || $query['department'] == 4 || $query['department'] == 3) {
            $user_companies = array();
            $employee_company_map = $db->get('employee_company_map', array('employee_id' => $query['employee_id']));
            if (!empty($employee_company_map)) {
                foreach ($employee_company_map as $map_data) {
                    if ($db->exists('company', array('id' => $map_data['company_id'])) && $db->get_row('company', array('id' => $map_data['company_id']))['status'] != 1) {
                        $user_companies[] = $map_data['company_id'];
                    }
                }
            }
        }

        if (is_array($query)) {
            $verify_pass = $password->verify($pass, $query['password'], PASSWORD_DEFAULT);
            if (!$verify_pass) {
                $display_msg = '<div class="alert alert-danger">
                                <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["signin_error"] . '
                                </div>';

                if ($query['login_fail_time'] > time()) {
                    $display_msg = '<div class="alert alert-danger">
                                <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["max_login_failed_error"] . '
                                </div>';
                } else {
                    $login_failed_count = ($query['login_fail_count'] >= 3) ? 0 : ($query['login_fail_count'] + 1);
                    $login_fail_time = ($login_failed_count >= 3) ? time() + 60 * 10 : 0;
                    $update = $db->update("employee", array('login_fail_count' => $login_failed_count, 'login_fail_time' => $login_fail_time), array('email' => $email));
                }
            } elseif (!in_array($query['department'], [1, 2, 3, 4, 5, 6])) {
                $display_msg = '<div class="alert alert-danger">
                                <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["not_authorized_person"] . '
                                </div>';
            } elseif ($query['status'] == 1 || ($db->exists('company', array('id' => $query['company_id'])) && $db->get_row('company', array('id' => $query['company_id']))['status'] == 1)) {
                $display_msg = '<div class="alert alert-danger">
                                <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["accont_not_activated"] . '
                                </div>';
            } elseif (($query['department'] == 1 || $query['department'] == 4 || $query['department'] == 3) && empty($user_companies)) {
                $display_msg = '<div class="alert alert-danger">
                                <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["accont_not_activated"] . '
                                </div>';
            } else if ($query['department'] != 5 && $query['login_fail_time'] > time()) {
                echo time() . "<br>";
                echo $query['login_fail_time'] . "<br>";
                echo $query['login_fail_time'] - time() . "<br>";
                $display_msg = '<div class="alert alert-danger">
                                <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["max_login_failed_error"] . '
                                </div>';
            } else {
                $update = $db->update("employee", array('login_fail_count' => 0, 'login_fail_time' => 0, 'privacy_check' => 1), array('email' => $email));
                $session->Open();
                if (isset($_SESSION)) {
                    $_SESSION['email'] = $query['email'];
                    $_SESSION['employee_id'] = $query['employee_id'];
                    $_SESSION['company_id'] = $query['company_id'];
                    $_SESSION['department'] = $query['department'];

                    if ($query['department'] == 1 || $query['department'] == 4 || $query['department'] == 3) {
                        $_SESSION['user_companies'] = $user_companies;
                        $_SESSION['company_id'] = $user_companies[0];
                    }

                    if (isset($_SESSION['department']) && ($_SESSION['department'] == 2)) {
                        $session->redirect('profile', frontend);
                    } else if (isset($_SESSION['department']) && ($_SESSION['department'] == 3)) {
                        $session->redirect('freelancer_profile', frontend);
                    } else {
                        $session->redirect('home', frontend);
                    }
                    // $session->redirect('home',frontend);
                }
            }
        } else {
            $display_msg = '<div class="alert alert-danger">
                            <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>
                                ' . $lang["signin_error"] . '
                            </div>';
        }
    }
}
