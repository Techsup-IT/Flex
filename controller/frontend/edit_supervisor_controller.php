<?php
$load = $_REQUEST['edit'];
if (isset($_REQUEST['edit'])) {
	$get_row = $db->get_row('employee', array('employee_id' => $load));
}
if (isset($_REQUEST['tab'])) {
	$current_tab = $_REQUEST['tab'];
}
if (isset($_POST['submit_user'])) {
	$current_tab = $_POST['current_tab'];
	$emp_name = $_POST['emp_name'];
	$emp_surname = $_POST['emp_surname'];
	$address = $_POST['address'];
	$contact1 = $_POST['contact1'];

	$create_on = date('y-m-d h:i:s');
	$ip_address = $_SERVER['REMOTE_ADDR'];

	$department = '6';

	if (($fv->emptyfields(array('emp_name' => $emp_name), NULL))) {
		$display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_employee_name"] . '
		</div>';
	} else {
		$update = $db->update('employee', array('emp_name' => $emp_name, 'emp_surname' => $emp_surname, 'address' => $address, 'contact1' => $contact1, 'create_date' => $create_on, 'ip_address' => $ip_address, 'department' => $department), array('employee_id' => $load));
		if ($update) {
			$get_row = $db->get_row('employee', array('employee_id' => $load));

			$display_msg = '<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
		</div>';
		}
	}
} elseif (isset($_POST['submit_login'])) {

	$current_tab = $_POST['current_tab'];
	$pass = $_POST['password'];

	if ($pass != '') {
		$encrypt_password = $password->hashBcrypt($pass, '10', PASSWORD_DEFAULT);
		$update = $db->update('employee', array('password' => $encrypt_password), array('employee_id' => $load));
		if ($update) {
			$get_row = $db->get_row('employee', array('employee_id' => $load));
			$display_msg = '<div class="alert alert-success">
				  <i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
				  </div>';
		}
	} else {
		$get_row = $db->get_row('employee', array('employee_id' => $load));
		$display_msg = '<div class="alert alert-danger">
				  <i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["empty_password"] . '
				  </div>';
	}
} elseif (isset($_POST['submit_image'])) {

	$current_tab = $_POST['current_tab'];
	$profilepic = $_FILES['profilepic'];
	$handle = new uploader($profilepic);
	$ext = $handle->file_src_name_ext;
	$path = SERVER_ROOT . '/uploads/profile/';


	if ($profilepic['name'] != '') {

		if (!is_dir($path)) {
			if (!file_exists($path)) {
				mkdir($path);
			}
		}

		if (file_exists(SERVER_ROOT . '/uploads/profile/' . $get_row['emp_photo_file']) && (($get_row['emp_photo_file']) != '')) {
			unlink(SERVER_ROOT . '/uploads/profile/' . $get_row['emp_photo_file']);
		}
		$newfilename = $handle->file_new_name_body = time();
		$ext = $handle->image_src_type;
		$filename = $newfilename . '.' . $ext;


		if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'png') {
			if ($handle->uploaded) {
				$handle->Process($path);
				if ($handle->processed) {
					$update = $db->update('employee', array('emp_photo_file' => $filename), array('employee_id' => $load));
					if ($update) {
						$get_row = $db->get_row('employee', array('employee_id' => $load));

						$display_msg = '<div class="alert alert-success">
				  <i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["update_success"] . '
				  </div>';
					}
				}
			}
		}
	}
}
