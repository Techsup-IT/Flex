<?php

if ($_REQUEST['token'] && $security->decrypt($_REQUEST['token'], key)) {

	$postdata = file_get_contents("php://input");
	header('Content-Type: application/json');
	$request = array();
	//$postdata = json_encode($_REQUEST);
	//echo "<pre>"; print_r($postdata); exit();
	$sessions = array();
	$request = json_decode($postdata, true);
	$email = $request['email'];
	$pass = $request['password'];
	$country = $request['country'];
	if ($email == "") {
		$sessions['loginerror'] = "Email Is Empty";
		$sessions['color'] = "danger";
	} elseif ($pass == "") {
		$sessions['loginerror'] = "Password Is Empty";
		$sessions['color'] = "danger";
	} else {

		if ($db->exists('employee', array('email' => $email))) {
			$query = $db->get_row('employee', array('email' => $email));
			if ($db->exists('company', array('id' => $query['company_id'])) && $query['status'] == 0) {
				$companyrow = $db->get_row('company', array('id' => $query['company_id']));
				$company = $companyrow['company_name'];
				$company_logo = $companyrow['logo'];

				/////////// company image
				if (file_exists(SERVER_ROOT . '/uploads/logo/company_logo/' . $company_logo)) {
					$query['company_logo'] = SITE_URL . '/uploads/logo/company_logo/' . $company_logo;
				}

				/////////// employee image
				if (file_exists(SERVER_ROOT . '/uploads/profile/' . $query['emp_photo_file'])) {
					$query['employee_img'] = SITE_URL . '/uploads/profile/' . $query['emp_photo_file'];
				}

				$verify_pass = $password->verify($pass, $query['password'], PASSWORD_DEFAULT);
				if (!$verify_pass) {
					$sessions['loginerror'] = "Wrong Password";
					$sessions['color'] = "danger";
				} elseif ($companyrow['status'] == 1) {
					$sessions['loginerror'] = "Account not activated";
					$sessions['color'] = "danger";
				} else {
					$sessions['status'] = true;
					$sessions['version'] = trversion;
					$sessions['timezone'] = $companyrow['timezone'];
					$sessions['address'] = $query['address'];
					$sessions['contact1'] = $query['contact1'];


					$sessions['email'] = $query['email'];
					$sessions['firstname'] = $query['emp_name'];
					$sessions['lastname'] = $query['emp_surname'];
					$sessions['employee_id'] = $query['employee_id'];
					$sessions['company_id'] = $query['company_id'];
					$sessions['company_logo'] = $query['company_logo'];
					$sessions['employee_img'] = $query['employee_img'];
					$sessions['country'] = $query['country'];
					$sessions['hour'] = $query['hour'];
					$sessions['company_name'] = $company;
					$sessions['createddate'] = $query['create_date'];
					$sessions['token'] = time();

					$update = $db->update('employee', array('country' => $country), array('employee_id' => $query['employee_id'], 'company_id' => $query['company_id']));
				}
			} else {
				$sessions['status'] = false;
			}
		} else {
			$sessions['status'] = false;
			$sessions['loginerror'] = "Wrong Email";
			$sessions['color'] = "danger";
		}
	}
	echo json_encode($sessions);
} else {
	$session->redirect('404', frontend);
}
