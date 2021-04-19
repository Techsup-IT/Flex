<?php

if (isset($_SESSION['department'])) {
    if (isset($_SESSION['department']) && ($_SESSION['department'] == 2 || $_SESSION['department'] == 3)) {
        $session->redirect('profile', frontend);
    } else {
        $session->redirect('home', frontend);
    }
}

if (isset($_POST)) {

    if (!empty($_POST)) {
        $file = json_encode($_POST);

        $_POST = json_decode($file, true);
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $emp_name = $_POST['emp_name'];
        $emp_surname = $_POST['emp_surname'];
        $contact1 = $_POST['contact1'];
        $dob = $_POST['dob'];
        $address = $_POST['address'];
        $department = "1";

        //company details
        $company_name = $_POST['company_name'];
        $company_website = $_POST['company_website'];
        $company_email = $_POST['c_email'];
        $company_address = $_POST['company_address'];
        $telephone1 = $_POST['telephone1'];
        $company_currencysymbol = $_POST['company_currencysymbol'];
        $date_format = $_POST['date_format'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $timezone = $_POST['timezone'];
        $create_on = date('y-m-d h:i:s');
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $return = array();

        $currently_allowed_employee = $_POST['currently_allowed_employee'];

        $return['error'] = "false";
        // if ($db->exists('employee', array('email' => $email))) {
        //     $return['msg'] = '<div class="alert alert-danger text-danger text-center">
        //                         <i class="lnr lnr-sad"></i>
        //                             <font color="red"> ' . $lang["email_exists"] . '</font>
        //                         </div>';
        //     $return['error'] = true;
        // } 
        // elseif ($db->exists('company', array('company_name' => $company_name))) {
        if ($db->exists('company', array('company_name' => $company_name))) {
            $return['msg'] = '<div class="alert alert-danger text-danger text-center">
                                <i class="lnr lnr-sad"></i>
                                    <font color="red"> ' . $lang["company_name_exists"] . '</font>
                                </div>';
            $return['error'] = true;
        } elseif ($db->exists('company', array('company_email' => $company_email))) {
            $return['msg'] = '<div class="alert alert-danger text-danger text-center">
                                <i class="lnr lnr-sad"></i>
                                        <font color="red"> ' . $lang["company_email_exists"] . '</font>
                                </div>';
            $return['error'] = true;
        } else {

            $insert_company = $db->insert('company', array(
                'company_email' => $company_email, 'company_name' => $company_name, 'company_website' => $company_website,
                'company_address' => $company_address, 'telephone1' => $telephone1, 'timezone' => $timezone, 'company_currencysymbol' => $company_currencysymbol, 'date_format' => $date_format,
                'country' => $country, 'state' => $state, 'city' => $city, 'zip' => $zip, 'create_date' => $create_on, 'ip_address' => $ip_address, 'currently_allowed_employee' => $currently_allowed_employee
            ));

            $last_id = $db->lastInsertId();

            $encrypt_password = $password->hashBcrypt($pass, '10', PASSWORD_DEFAULT);
            if ($insert_company) {
                if ($db->exists('employee', array('email' => $email))) {
                    $query = $db->get_row('employee', array('email' => $email));
                    $emplast_id = $query['employee_id'];
                    $insert = $db->insert('employee_company_map', array('employee_id' => $query['employee_id'], 'company_id' => $last_id));
                } else {
                    $insert = $db->insert('employee', array('emp_name' => $emp_name, 'emp_surname' => $emp_surname, 'department' => $department, 'address' => $address, 'contact1' => $contact1, 'company_id' => $last_id, 'email' => $email, 'dob' => $dob, 'password' => $encrypt_password, 'create_date' => $create_on, 'ip_address' => $ip_address, 'privacy_check' => 1));
                    $emplast_id = $db->lastInsertId();
                    $insert = $db->insert('employee_company_map', array('employee_id' => $emplast_id, 'company_id' => $last_id));
                }
                // $insert = $db->insert('employee', array('emp_name' => $emp_name, 'emp_surname' => $emp_surname, 'department' => $department, 'address' => $address, 'contact1' => $contact1, 'company_id' => $last_id, 'email' => $email, 'dob' => $dob, 'password' => $encrypt_password, 'create_date' => $create_on, 'ip_address' => $ip_address));

                // $emplast_id = $db->lastInsertId();
                $pathimg = SERVER_ROOT . '/uploads/images/';
                $path = SERVER_ROOT . '/uploads/images/' . $last_id . '/';
                $emppath = SERVER_ROOT . '/uploads/images/' . $last_id . '/' . $emplast_id . '/';

                if (!is_dir($pathimg)) {
                    mkdir($pathimg);

                    if (!file_exists($path) && !file_exists($emppath)) {
                        mkdir($path);
                        mkdir($emppath);
                    }
                }
            }
            if ($insert_company) {
                echo $display_msg = '<div class="alert alert-success">
                                    <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["add_success"] . '
                                    </div>';
                echo "<script>
                    setTimeout(function(){
                    window.location = '" . $link->link("company", frontend) . "'
                    },1000);</script>";
                die();
            } else {
                $display_msg = '<div class="alert alert-danger">
                            <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Something went wrong. Please try agian later.
                            </div>';
                // echo $db->debug(); exit();
            }
        }
        echo $return['msg'];
        echo "<script>
                setTimeout(function(){
                window.location = '" . $link->link("login", frontend) . "'
                },2000);</script>";
        die();
    }

    echo $return['msg'];
} else {
    $session->redirect('404', frontend);
}
