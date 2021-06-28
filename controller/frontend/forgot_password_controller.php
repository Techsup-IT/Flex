<style>
	.alert button.close {
		margin-top: -15px;
	}
</style>

<?php
$exists = 0;
if ($session->Check()) {
	$session->redirect('home', frontend);
}
$setting = $db->get_row('settings');
if (isset($_POST['change_pass'])) {
	$exists = 1;
	$enc = $_POST['token'];
	$pass = $_POST['password'];
	$retypepassword = $_POST['retypepassword'];
	if ($pass == '') {
		$display_msg = '<div class="alert alert-danger">
	                      	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">
        					&times;</button>
					     	' . $lang["enter_password"] . '
		               </div>';
	} elseif ($retypepassword == '') {
		$display_msg = '<div class="alert alert-danger">
	                      	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">
       						 &times;</button>
					     	' . $lang["enter_retype_password"] . '
		               </div>';
	} elseif ($pass != $retypepassword) {
		$display_msg = '<div class="alert alert-danger">
	                     	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">
        					&times;</button>
					     	' . $lang["password_not_match"] . '
		               </div>';
	} else {
		$encrypt_password = $password->hashBcrypt($pass, '10', PASSWORD_DEFAULT);
		$update = $db->update('employee', array('password' => $encrypt_password, 'random' => 0), array('random' => $enc));
	}
	if ($update) {
		$display_msg = '<div class="alert alert-success">
	                      	<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">
        					&times;</button>
					     	' . $lang["update_success"] . '
		               </div>';
	}
} elseif (isset($_REQUEST['random']) && $_REQUEST['random'] != '') {

	$enc = $_REQUEST['random'];
	if (!$db->exists('employee', array('random' => $_REQUEST['random']))) {

		$exists = 0;
		$display_msg = '<div class="alert alert-danger">
	                      	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">
        					&times;</button>
					    	' . $lang["invalid_token"] . '
		               </div>';
	} else {
		$exists = 1;
	}
} elseif (isset($_POST['forgot_pass'])) {
	$forgot_email = $fv->removespace($_POST['email']);

	$emp = $db->get_var('employee', array('email' => $forgot_email), 'company_id');
	$company_details = $db->get_row('company', array('id' => $emp));
	if ($fv->emptyfields(array('email' => $forgot_email))) {
		$display_msg = '<div class="alert alert-danger">
	                      	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>
					     	' . $lang["enter_your_email_address"] . '
		               </div>';
	} elseif (!$fv->check_email($forgot_email)) {
		$display_msg = '<div class="alert alert-danger">
	                      	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>
					     	' . $lang["enter_valid_email"] . '
		               </div>';
	}
	// elseif(!$db->exists('employee', array ('email' => $forgot_email,'department'=>'1')))
	// {
	// 	$display_msg='<div class="alert alert-danger">
	// 	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Sorry! You are not Authorized Person.
	// 	</div>';
	// }
	elseif (!$db->exists('employee', array('email' => $forgot_email))) {


		$display_msg = '<div class="alert alert-danger">
	                      	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>
					      	' . $lang["email_not_exist"] . '
		               </div>';
	} else {



		$enc = $feature->encrypt(time());
		$row = $db->update('employee', array('random' => $enc), array('email' => $forgot_email));

		$email_body = '<table cellspacing="0" cellpadding="0" style="padding:30px 10px;background-color:rgb(238,238,238);width:100%;font-family:arial;background-repeat:initial initial">
<tbody>
<tr>
	<td>
		<table align="center" cellspacing="0" style="max-width:650px;min-width:320px">
			<tbody>
				<tr>
					<td align="center" style="background:#fff;border:1px solid #e4e4e4;padding:50px 30px">
						<table align="center">
							<tbody>
								<tr>
									<td style="border-bottom:1px solid #dfdfd0;color:#666;text-align:center">
										<table align="left" style="margin:auto">
										<tbody>
											<tr>
												<td style="color:rgb(102,102,102);font-size:16px;padding-bottom:30px;text-align:left;font-family:arial">
    You have requested for a password reset. Please click on the link or copy and paste the link in browser to proceed.<br><br>

											Password Reset Link : <a href="' . SITE_URL . '/index.php?user=forgot_password&random=' . $enc . '"> ' . SITE_URL . '/index.php?user=forgot_password&random=' . $enc . '</a><br>

											<br /><br><br>Regards<br><br>
											' . $company_details['company_name'] . '<br>
											</td>				</tr>
										</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
	</td>
</tr>
</tbody>
</table>';


		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'From:' . $company_details['company_name'] . '<support@techsupflex.com>' . "\r\n";
		$headers .= 'Reply-To: support@techsupflex.com' . "\r\n";
		// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'Content-type: text/html; charset= UTF-8' . "\r\n";
		// $headers .= 'From: '.$company_details['company_name'] .'<'.$company_details['company_email'] . ">\r\n" .
		// 'Reply-To: '.$company_details['company_email'] . "\r\n" .
		// 'X-Mailer: PHP/' . phpversion();
		// $forgot_email = 'hiren.macwan@confidosoft.com';
		$confirm    =  mail($forgot_email, 'Forgot Password Request', $email_body, $headers);



		if ($confirm == '1') {
			$display_msg = '<div class="alert alert-success">
		 <button class="close" data-dismiss="alert" type="button">&times;</button>
		 ' . $lang["mail_send"] . '
		 </div>';
		} else {
			$display_msg = '<div class="alert alert-danger">
		 <button class="close" data-dismiss="alert" type="button">&times;</button>
		 ' . $lang["error_occured"] . '
		 </div>';
		}
	}
}
?>