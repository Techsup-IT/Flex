<?php

$load = $_REQUEST['edit_id'];
if (isset($_REQUEST['edit_id'])) {
    $company_details = $db->get_row('company', array('id' => $load));
}


if (isset($_POST['submit_settings'])) {
    $company_name = $_POST['company_name'];
    $company_email = $_POST['company_email'];
    $company_website = $_POST['company_website'];
    $company_address = htmlentities($_POST['company_address']);
    $country = $_POST['country'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $date_format = $_POST['date_format'];
    $telephone1 = $_POST['telephone1'];
    $timezone = $_POST['timezone'];
    $company_currencysymbol = $_POST['company_currencysymbol'];
    $currently_allowed_employee = $_POST['currently_allowed_employee'];


    $create_date = date('y-m-d,h:i:s');
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $logopic = $_FILES['logopic'];

    $handle = new uploader($logopic);
    $ext = $handle->file_src_name_ext;
    $path = SERVER_ROOT . '/uploads/logo/company_logo/';




    if ($company_name == '') {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_company_name"] . '
		</div>';
    } elseif ($company_email == '') {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_company_email"] . '
		</div>';
    } elseif (!$fv->check_email($company_email)) {
        $display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_valid_email"] . '
		</div>';
    } elseif ($logopic['name'] != '') {

        if (!is_dir($path)) {
            if (!file_exists($path)) {
                mkdir($path);
            }
        }

        if (file_exists(SERVER_ROOT . '/uploads/logo/company_logo/' . $company_details['logo']) && (($company_details['logo']) != '')) {
            unlink(SERVER_ROOT . '/uploads/logo/company_logo/' . $company_details['logo']);
        }
        $newfilename = $handle->file_new_name_body = time();
        $ext = $handle->image_src_type;
        $filename = $newfilename . '.' . $ext;


        if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'png') {
            if ($handle->uploaded) {
                $handle->Process($path);
                if ($handle->processed) {
                    // $update=$db->update('company',array('company_name'=>$company_name,'company_email'=>$company_email,'timezone'=>$timezone,'logo'=>$filename,'company_website'=>$company_website,'company_address'=>$company_address,'country'=>$country,'city'=>$city,'state'=>$state,'zip'=>$zip,'date_format'=>$date_format,'telephone1'=>$telephone1,'company_currencysymbol'=>$company_currencysymbol, 'currently_allowed_employee'=>$currently_allowed_employee),array('id'=>$_SESSION['company_id']));
                    $update = $db->update('company', array('company_name' => $company_name, 'company_email' => $company_email, 'timezone' => $timezone, 'logo' => $filename, 'company_website' => $company_website, 'company_address' => $company_address, 'country' => $country, 'city' => $city, 'state' => $state, 'zip' => $zip, 'date_format' => $date_format, 'telephone1' => $telephone1, 'company_currencysymbol' => $company_currencysymbol, 'currently_allowed_employee' => $currently_allowed_employee), array('id' => $load));
                }
            }
        }
    } else {
        // $update=$db->update('company',array('company_name'=>$company_name,'company_email'=>$company_email,'timezone'=>$timezone,'company_website'=>$company_website,'company_address'=>$company_address,'country'=>$country,'city'=>$city,'state'=>$state,'zip'=>$zip,'date_format'=>$date_format,'telephone1'=>$telephone1,'company_currencysymbol'=>$company_currencysymbol, 'currently_allowed_employee'=>$currently_allowed_employee),array('id'=>$_SESSION['company_id']));
        $update = $db->update('company', array('company_name' => $company_name, 'company_email' => $company_email, 'timezone' => $timezone, 'company_website' => $company_website, 'company_address' => $company_address, 'country' => $country, 'city' => $city, 'state' => $state, 'zip' => $zip, 'date_format' => $date_format, 'telephone1' => $telephone1, 'company_currencysymbol' => $company_currencysymbol, 'currently_allowed_employee' => $currently_allowed_employee), array('id' => $load));
    }

    if ($update) {
        // $company_details=$db->get_row('company',array('id'=>$_SESSION['company_id']));
        $company_details = $db->get_row('company', array('id' => $load));

        /*$display_msg='<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Success! In demo you cannot change data.
		</div>';*/
        $display_msg = '<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
		</div>';
    }
} elseif (isset($_REQUEST['is_block_yes'])) {
    $id = $_REQUEST['is_block_yes'];
    $update = $db->update('site_setting', array('is_blocked' => "no"), array('site_setting_id' => $id));
    if ($update) {
        $session->redirect('site_setting', frontend);
    }
} elseif (isset($_REQUEST['is_block_no'])) {
    $id = $_REQUEST['is_block_no'];
    $update = $db->update('site_setting', array('is_blocked' => "yes"), array('site_setting_id' => $id));
    if ($update) {
        $session->redirect('site_setting', frontend);
    }
}
