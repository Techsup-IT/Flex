<?php
$where = '';
if ($_SESSION['department'] != 5) {
	$where = 'and `employee_id` = "' . $_SESSION['employee_id'] . '" ';
}
$users = $db->run("SELECT * from `employee` where `department`='6' " . $where . "  ")->fetchAll();

$load = $_REQUEST['del_id'];

if (isset($_REQUEST['del_id'])) {
	$display_msg = '<form method="POST" action="">
<div class="alert alert-success" >
' . $lang["user_delete_confirmation"] . '
<input type="hidden" name="del_id" value="' . $load . '" >
<button name="yes" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="fa fa-check-square-o"></i></button>
<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="fa fa-remove"></i></button>
</div>
</form>';
}
if (isset($_POST['yes'])) {
	$get_image = $db->get_var("employee", array('employee_id' => $load), 'emp_photo_file');

	$delete = $db->delete("employee", array('employee_id' => $load));
	$shift_dl = $db->delete("shift_check", array('employee_id' => $load));


	if (file_exists(SERVER_ROOT . '/uploads/profile/' . $get_image) && (($get_image) != '')) {
		unlink(SERVER_ROOT . '/uploads/profile/' . $get_image);
	}

	if ($delete) {
		$session->redirect('supervisors', frontend);
	}
} elseif (isset($_POST['no'])) {
	$session->redirect('supervisors', frontend);
}

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
	$update = $db->update("employee", array('status' => 0), array('employee_id' => $is_activate));

	if ($update) {
		$session->redirect('supervisors', frontend);
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
	$update = $db->update("employee", array('status' => 1), array('employee_id' => $is_deactivate));

	if ($update) {
		$session->redirect('supervisors', frontend);
	}
}
