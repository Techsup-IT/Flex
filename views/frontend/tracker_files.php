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
	$files = array();
	$files = $db->run("SELECT * from `files` where `employee_id`='".$employee_id."' AND `company_id`='".$company_id."' ORDER BY message_id DESC")->fetchAll();
	$unread_files_count = 0;
	if(!empty($files)){
		foreach ($files as $file) {
			if($file['emp_status'] == 0){
				$unread_files_count++;
			}
		}
	}
	$sessions['files'] = $files;
	$sessions['unread_files_count'] = $unread_files_count;
	echo json_encode($sessions);
}
else{
	$session->redirect('404',frontend);
}

?>