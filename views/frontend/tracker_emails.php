<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
if($_REQUEST['token'] && $security->decrypt($_REQUEST['token'], key)){

	$postdata = file_get_contents("php://input");
	header('Content-Type: application/json');
	$request=array();
	$sessions = array();
	$request = json_decode($postdata,true);

	$employee_id=$request['employee_id'];
	$company_id = $request['company_id'];
	$emails = array();
	$emails = $db->run("SELECT * from `emails` where `employee_id`='".$employee_id."' AND `company_id`='".$company_id."' ORDER BY message_id DESC")->fetchAll();
	$unread_emails_count = 0;
	if(!empty($emails)){
		foreach ($emails as $email) {
			if($email['emp_status'] == 0){
				$unread_emails_count++;
			}
		}
	}
	$sessions['emails'] = $emails;
	$sessions['unread_emails_count'] = $unread_emails_count;
	echo json_encode($sessions);
}
else{
	$session->redirect('404',frontend);
}

?>