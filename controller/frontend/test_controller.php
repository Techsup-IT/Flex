<?php



if(isset($_POST['submit_user']))
{

	$emp_name=$_POST['emp_name'];
	$emp_surname=$_POST['emp_surname'];
	$address=$_POST['address'];
	$contact1=$_POST['contact1'];
	$email=$_POST['email'];
	$department="2";
    $pass=$_POST['password'];
    $create_on=date('y-m-d h:i:s');
    $ip_address=$_SERVER['REMOTE_ADDR'];
    $pro = $_FILES['img'];

    $handle = new uploader($_FILES['img']);
    $path=SERVER_ROOT.'/uploads/users_image/';

    if (! is_dir($path)) {
    	if (! file_exists($path)) {
    		mkdir($path);
    	}
    }

    if(($fv->emptyfields(array('emp_name'=>$emp_name),NULL)))
    {
    	$display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Goshh! Enter employee name.
		</div>';
    }
   elseif(($fv->emptyfields(array('email'=>$email),NULL)))
    {
       $display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Goshh! Email Cannot Be Empty.
		</div>';
    }
    elseif(!$fv->check_email($email))
    {
        $display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Oopes! Enter a valid email.
		</div>';
    }
    elseif($db->exists('employee',array('email'=>$email)))
    {
        $display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Oopes! Email already Exists.
		</div>';
    }
    elseif($fv->emptyfields(array('password'=>$pass),NULL))
    {
        $display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Oopes! Password Cannot be empty.
		</div>';
    }
    elseif($fv->emptyfields(array('address'=>$address),NULL))
    {
    	$display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Oopes! Provide your address.
		</div>';
    }
    elseif($fv->emptyfields(array('contact1'=>$contact1),NULL))
    {
    	$display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Oopes! Enter your phone number.
		</div>';
    }
    elseif(!is_numeric($contact1))
    {
    	$display_msg='<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Oopes! Phone number should be numeric.
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
               $insert=$db->insert('employee',array('emp_name'=>$emp_name,'emp_surname'=>$emp_surname,'emp_photo_file'=>$filename,'department'=>$department,'address'=>$address,'contact1'=>$contact1,'company_id'=>$_SESSION['company_id'],'email'=>$email,'password'=>$encrypt_password,'create_date'=>$create_on,'ip_address'=>$ip_address));
               $emplast_id=$db->lastInsertId();
               if($insert)
               {
               	$path = SERVER_ROOT.'/uploads/images/'.$_SESSION['company_id'].'/'.$emplast_id.'/';
               	if(!is_dir($path))
               	{
               		if(!file_exists($path)){
               			mkdir($path);
               		}
               	}

               	$display_msg='<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Added Successfully.
		</div>';
               	echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("users",frontend)."'
	                },2000);</script>";

               }


    			}
    		}
    	}
    }
  else
    {

    	$encrypt_password = $password->hashBcrypt( $pass , '10', PASSWORD_DEFAULT);
        $insert=$db->insert('employee',array('emp_name'=>$emp_name,'emp_surname'=>$emp_surname,'department'=>$department,'address'=>$address,'contact1'=>$contact1,'company_id'=>$_SESSION['company_id'],'email'=>$email,'password'=>$encrypt_password,'create_date'=>$create_on,'ip_address'=>$ip_address));
        $emplast_id=$db->lastInsertId();
        if($insert)
        {
        	$path = SERVER_ROOT.'/uploads/images/'.$_SESSION['company_id'].'/'.$emplast_id.'/';
        	if(!is_dir($path))
        	{
        		if(!file_exists($path)){
        			mkdir($path);
        		}
        	}

        	$display_msg='<div class="alert alert-success">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>Added Successfully.
		</div>';
        	echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("users",frontend)."'
	                },2000);</script>";

        }
    }


}
?>
