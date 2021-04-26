<?php

if ($_SESSION['department'] != 5 && $_SESSION['department'] != 4 && $_SESSION['department'] != 6) {
	$session->redirect('home', frontend);
}

$company = $db->run("SELECT * from `company`")->fetchAll();
$company_count = count($company);

$all_company_count = $company_count + 1;

$load = $_REQUEST['del_id'];

if (isset($_REQUEST['del_id'])) {
	$display_msg = '<form method="POST" action="">
						<div class="alert alert-success" >
						' . $lang["company_delete_confirmation"] . '
						<input type="hidden" name="del_id" value="' . $load . '" >
						<button name="yes" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="fa fa-check-square-o"></i></button>
						<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="fa fa-remove"></i></button>
						</div>
					</form>';
}
if (isset($_POST['yes']) && $load != 1) {
	$get_cimage = $db->get_var("company", array('id' => $load), 'logo');

	$delete = $db->delete("company", array('id' => $load));
	$employees = $db->get_all('employee', array('company_id' => $load));
	foreach ($employees as $val) {
		$employee_id = $val['employee_id'];
		$get_image = $db->get_var("employee", array('employee_id' => $employee_id), 'emp_photo_file');
		if (file_exists(SERVER_ROOT . '/uploads/profile/' . $get_image) && (($get_image) != '')) {
			unlink(SERVER_ROOT . '/uploads/profile/' . $get_image);
		}
	}
	$delete = $db->delete("employee", array('company_id' => $load));
	$shift_dl = $db->delete("shift_check", array('company_id' => $load));

	$feature->rrmdir(SERVER_ROOT . '/uploads/images/' . $load);

	if (file_exists(SERVER_ROOT . '/uploads/logo/company_logo/' . $get_cimage) && (($get_cimage) != '')) {
		unlink(SERVER_ROOT . '/uploads/logo/company_logo/' . $get_cimage);
	}


	if ($delete) {
		$session->redirect('company', frontend);
	}
} elseif (isset($_POST['no'])) {
	$session->redirect('company', frontend);
}

//changes added on 08 march 2018 to activate/deactivate company
$is_activate = $_REQUEST['activate_id'];

if (isset($_REQUEST['activate_id'])) {
	$display_msg = '<form method="POST" action="">
						<div class="alert alert-success" >
						' . $lang["are_you_sure"] . '
						<input type="hidden" name="activate_id" value="' . $is_activate . '" >
						<button name="activate" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="fa fa-check-square-o"></i></button>
						<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="fa fa-remove"></i></button>
						</div>
					</form>';
}
if (isset($_POST['activate'])) {
	$update = $db->update("company", array('status' => 0), array('id' => $is_activate));

	if ($update) {
		$session->redirect('company', frontend);
	}
}


$is_deactivate = $_REQUEST['deactivate_id'];

if (isset($_REQUEST['deactivate_id'])) {
	$display_msg = '<form method="POST" action="">
					<div class="alert alert-success" >
					' . $lang["are_you_sure"] . '
					<input type="hidden" name="deactivate_id" value="' . $is_deactivate . '" >
					<button name="deactivate" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="fa fa-check-square-o"></i></button>
					<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="fa fa-remove"></i></button>
					</div>
				</form>';
}
if (isset($_POST['deactivate'])) {
	$update = $db->update("company", array('status' => 1), array('id' => $is_deactivate));

	if ($update) {
		$session->redirect('company', frontend);
	}
}
