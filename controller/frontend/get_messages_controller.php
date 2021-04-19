<?php

if (isset($_POST['message']) && $_POST['message'] != '') {
	$message_data = $_POST['message'];
	$company_id = $_SESSION['company_id'];
	$manager_id = 0;
	$emp_status = 0;
	$admin_status = 0;
	if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
		$manager_id = $_SESSION['employee_id'];
	}
	$employee_id = $_POST['employee_id'];
	$ip_address = $_SERVER['REMOTE_ADDR'];
	$create_on = date('y-m-d h:i:s');

	$insert = $db->insert('messages', array(
		'company_id' => $company_id,
		'manager_id' => $manager_id,
		'employee_id' => $employee_id,
		'message_data' => $message_data,
		'admin_status' => $admin_status,
		'emp_status' => $emp_status,
		'ip_address' => $ip_address,
		'created_date' => $create_on
	));
	// $db->debug();
}

if (isset($_REQUEST['view']) && $_REQUEST['view'] == 'getChat' && isset($_REQUEST['employee_id']) && $_REQUEST['employee_id'] != '') {
	$extra_sql = '';
	$user_status = '';
	if ($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) {
		$extra_sql = 'and admin_status = 0';
		$user_status = 'admin_status';
	}
	if ($_SESSION['department'] == 2 || $_SESSION['department'] == 3) {
		$extra_sql = 'and emp_status = 0';
		$user_status = 'emp_status';
	}
	$messages = $db->run("SELECT * from `messages` where `employee_id`= '" . $_REQUEST['employee_id'] . "' AND `company_id` = '" . $_SESSION['company_id'] . "' " . $extra_sql)->fetchAll();

	$msg_html = '';
	if (isset($messages) && count($messages) > 0) {
		foreach ($messages as $msg) {

			$update = $db->update('messages', array($user_status => 1), array('message_id' => $msg['message_id']));

			$is_my_msg = '';
			if (($_SESSION['department'] == 2 || $_SESSION['department'] == 3) && $msg['manager_id'] == 0) {
				$is_my_msg = 'my_msg';
			}
			if (($_SESSION['department'] == 5 || $_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 6) && $msg['manager_id'] != 0) {
				$is_my_msg = 'my_msg';
			}
?>
			<div class="s_msg_container <?php echo $is_my_msg; ?>">
				<div class="msg_data"><?php echo $msg['message_data']; ?>
					<span class="msg_time"><?php echo $msg['timestamp']; ?></span>
				</div>
			</div>
			<div style="clear: both;"></div>
<?php
		}
	}
	// echo json_encode($messages);
	echo $msg_html;
	die();
}

?>