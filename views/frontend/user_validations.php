<?php
$status = null;
$data = [];
$msg = '';

$validation_type = isset($_POST['validation_type']) ? $_POST['validation_type'] : '';
if ($validation_type == 'privacy_check') {
    $user_email = isset($_POST['email']) ? $_POST['email'] : '';
    if ($user_email != '') {
        $user_details = $db->get_row('employee', array('email' => $user_email));
        if ($user_details && is_array($user_details)) {
            $status = true;
            $data = array('privacy_check' => $user_details['privacy_check']);;
        }
    }
}

$response = array(
    'status' => $status,
    'data' => $data,
    'msg' => $msg
);
echo json_encode($response);
die();
