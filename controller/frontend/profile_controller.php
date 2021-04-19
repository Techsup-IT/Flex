<?php
if (isset($_POST['submit_profile'])) {
	$firstname = $_POST['f_name'];
	$lastname = $_POST['l_name'];
	$contact1 = $_POST['contact1'];
	$address = $_POST['address'];
	$profilepic = $_FILES['profilepic'];

	$handle = new uploader($profilepic);
	$ext = $handle->file_src_name_ext;
	$path = SERVER_ROOT . '/uploads/profile/';

	if (($fv->emptyfields(array('emp_name' => $firstname), NULL))) {
		$display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_name"] . '
		</div>';
	} elseif (($fv->emptyfields(array('emp_surname' => $lastname), NULL))) {
		$display_msg = '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>' . $lang["enter_your_surname"] . '
		</div>';
	} elseif ($profilepic['name'] != '') {

		if (!is_dir($path)) {
			if (!file_exists($path)) {
				mkdir($path);
			}
		}

		if (file_exists(SERVER_ROOT . '/uploads/profile/' . $user_details['emp_photo_file']) && (($user_details['emp_photo_file']) != '')) {
			unlink(SERVER_ROOT . '/uploads/profile/' . $user_details['emp_photo_file']);
		}
		$newfilename = $handle->file_new_name_body = time();
		$ext = $handle->image_src_type;
		$filename = $newfilename . '.' . $ext;


		if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'png') {
			if ($handle->uploaded) {
				$handle->Process($path);
				if ($handle->processed) {
					$update = $db->update('employee', array('emp_name' => $firstname, 'emp_surname' => $lastname, 'emp_photo_file' => $filename, 'contact1' => $contact1, 'address' => $address), array('employee_id' => $_SESSION['employee_id']));
				}
			}
		}
	} else {
		$update = $db->update('employee', array('emp_name' => $firstname, 'emp_surname' => $lastname, 'address' => $address, 'contact1' => $contact1), array('employee_id' => $_SESSION['employee_id']));
	}

	if ($update) {

		$display_msg = '<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times</button>' . $lang["update_success"] . '
		</div>';

		echo "<script>
                 setTimeout(function(){
	    		  window.location = '" . $link->link("profile", frontend) . "'
	                },1000);</script>";
	}
}
