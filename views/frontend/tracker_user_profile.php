<?php
if($_REQUEST['token'] && $_REQUEST['operation']==updateUserProfilePicture && $security->decrypt($_REQUEST['token'], key))
{
	$employee_id= $_REQUEST['employee_id'];
	$company_id = $_REQUEST['company_id'];

    $profilepic=$_FILES['userfile'];
    $handle= new uploader($profilepic);
	$ext=$handle->file_src_name_ext;
    $path = SERVER_ROOT.'/uploads/profile/';


		 if($profilepic['name']!=''){

			if(!is_dir($path))
			{
				if(!file_exists($path)){
					mkdir($path);
				}
			}
		        /*
			if(file_exists(SERVER_ROOT.'/uploads/profile/'.$get_row['emp_photo_file']) && (($get_row['emp_photo_file'])!=''))
			{
				unlink(SERVER_ROOT.'/uploads/profile/'.$get_row['emp_photo_file']);
			}
                        */
			$newfilename = $handle->file_new_name_body= time();
			$ext = $handle->image_src_type;
		    $filename = $newfilename.'.'.$ext;


			if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'png' )
			{
				if ($handle->uploaded) {
					$handle->Process($path);
					if ($handle->processed)
					{
						$update=$db->update('employee',array('emp_photo_file'=>$filename),array('employee_id'=>$employee_id,'company_id'=>$company_id));
						if($update)
						{
							$sessions['status'] = true;
					    		echo json_encode($sessions);

						}
						else {
							$sessions['status'] = false;
					    		echo json_encode($sessions);
						}
					}
				}
			}
    }
} // End profile image updload

else if($_REQUEST['token'])
{
        //&& $password->verify('iwcnshift',$_REQUEST['token'],PASSWORD_DEFAULT)
	$postdata=file_get_contents("php://input");
	header('Content-Type: application/json');

	$request=array();
	$sessions = array();
	$request = json_decode($postdata,true);

	    $employee_id = $request['employee_id'];
	    $company_id = $request['company_id'];
	    $create_date=date('Y/m/d');
	    $ip_address=$_SERVER['REMOTE_ADDR'];


    if($_REQUEST['operation']=='updateInformation') // to Update user information along company_id and employee_id
    {
		$emp_name=$request['emp_name'];
		$emp_surname=$request['emp_surname'];
		$address=$request['address'];
		$contact1=$request['contact1'];
		$country=$request['country'];
		$create_on=date('y-m-d h:i:s');
		$ip_address=$_SERVER['REMOTE_ADDR'];
			$update=$db->update('employee',array('emp_name'=>$emp_name,'emp_surname'=>$emp_surname,'address'=>$address,'country'=>$country,'contact1'=>$contact1,'create_date'=>$create_on,'ip_address'=>$ip_address),array('employee_id'=>$employee_id,'company_id'=>$company_id));
			if($update)
			{
				$sessions['status'] = true;
				echo json_encode($sessions);
			}
                        else {
                             $sessions['status'] = false;
		             echo json_encode($sessions);
                        }

    }
    elseif($_REQUEST['operation']=='updateLoginInformation') // to Update user login passwrod on requeset
    {
        $pass=$request['password'];

	if($pass!='')
	{
		$encrypt_password = $password->hashBcrypt( $pass , '10', PASSWORD_DEFAULT);
		$update=$db->update('employee',array('password'=>$encrypt_password),array('employee_id'=>$employee_id,'company_id'=>$company_id));
		if($update)
		{
                      $sessions['status'] = true;
		      echo json_encode($sessions);
		}
                else {
                      $sessions['status'] = false;
		      echo json_encode($sessions);
                }
	}
	else
	{
            echo "Password not found";
	}
    }

}

else
{
	$session->redirect('404',frontend);
}