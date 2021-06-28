<?php

if(isset($_POST['submit_user']))
{
    //print_r($_POST);
    //exit;
	$emp_name=$_POST['emp_name'];
	$emp_surname=$_POST['emp_surname'];
	$address=$_POST['address'];
	$contact1=$_POST['contact1'];
	$email=$_POST['email'];
	$department="1";
    $pass=$_POST['password'];
    
    $create_on=date('y-m-d h:i:s');
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $pro = $_FILES['img'];

    $handle = new uploader($_FILES['img']);
    $path=SERVER_ROOT.'/uploads/profile/';

    if (! is_dir($path)) {
    	if (! file_exists($path)) {
    		mkdir($path);
    	}
    }

    if(($fv->emptyfields(array('emp_name'=>$emp_name),NULL)))
    {
    	$display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>'.$lang["enter_employee_name"].'
		</div>';
    }
   elseif(($fv->emptyfields(array('email'=>$email),NULL)))
    {
       $display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>'.$lang["enter_your_email_address"].'
		</div>';
    }
    elseif(!$fv->check_email($email))
    {
        $display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>'.$lang["enter_valid_email"].'
		</div>';
    }
    elseif($db->exists('employee',array('email'=>$email)))
    {
        $display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>'.$lang["email_exists"].'
		</div>';
    }
    elseif($fv->emptyfields(array('password'=>$pass),NULL))
    {
        $display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>'.$lang["empty_password"].'
		</div>';
    }

    elseif (($pro['name']) != '') {
    	$newfilename = $handle->file_new_name_body = preg_replace('/\s+/', '', time());
    	$ext = $handle->image_src_type;
    	$filename = $newfilename . '.' . $ext;

    	if ($handle->image_src_type == 'jpg' || $handle->image_src_type == 'jpeg' || $handle->image_src_type == 'JPEG' || $handle->image_src_type == 'png' || $handle->image_src_type == 'JPG') {

    		if ($handle->uploaded) {

    			$handle->Process($path);
    			if ($handle->processed) {

    				$encrypt_password = $password->hashBcrypt( $pass , '10', PASSWORD_DEFAULT);
                    $insert=$db->insert('employee',array(
                                                        'emp_name'=>$emp_name,
                                                        'emp_surname'=>$emp_surname,
                                                        'department'=>$department,
                                                        'address'=>$address,
                                                        'contact1'=>$contact1,
                                                        'company_id'=>$_SESSION['company_id'],
                                                        'email'=>$email,
                                                        'password'=>$encrypt_password,
                                                        'create_date'=>$create_on,
                                                        'ip_address'=>$ip_address
                                                    )
                                        );
               $emplast_id=$db->lastInsertId();
               if($insert)
               {
                $insert_map = $db->insert('employee_company_map', array('employee_id' => $emplast_id, 'company_id' => $_SESSION['company_id']));
                    $path_cmp = SERVER_ROOT.'/uploads/images/'.$_SESSION['company_id'].'/';
        	       $path1 = SERVER_ROOT.'/uploads/images/'.$_SESSION['company_id'].'/'.$emplast_id.'/';

        	if(!is_dir($path_cmp))
        	{
        		mkdir($path_cmp);

        		if(!file_exists($path1)){
        			mkdir($path1);
        		}
        	}
               	echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("admin",frontend)."'
	                },2000);</script>";

               }


    			}
    		}
    	}
    }
  else
    {

    	$encrypt_password = $password->hashBcrypt( $pass , '10', PASSWORD_DEFAULT);
        $insert=$db->insert('employee',array(
                                             'emp_name'=>$emp_name,
                                             'emp_surname'=>$emp_surname,
                                             'department'=>$department,
                                             'address'=>$address,
                                             'contact1'=>$contact1,
                                             'company_id'=>$_SESSION['company_id'],
                                             'email'=>$email,
                                             'password'=>$encrypt_password,
                                             'create_date'=>$create_on,
                                             'ip_address'=>$ip_address
                                            )
                            );
        $emplast_id=$db->lastInsertId();
        if($insert)
        {
          $insert_map = $db->insert('employee_company_map', array('employee_id' => $emplast_id, 'company_id' => $_SESSION['company_id']));
        	$path_cmp = SERVER_ROOT.'/uploads/images/'.$_SESSION['company_id'].'/';
        	$path1 = SERVER_ROOT.'/uploads/images/'.$_SESSION['company_id'].'/'.$emplast_id.'/';

        	if(!is_dir($path_cmp))
        	{
        		mkdir($path_cmp);

        		if(!file_exists($path1)){
        			mkdir($path1);
        		}
        	}
          $display_msg='<div class="alert alert-success">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>'.$lang["add_success"].'
		</div>';
        	echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("admin",frontend)."'
	                },2000);</script>";

        }
    }


}
?>
