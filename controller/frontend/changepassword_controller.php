<?php
if(isset($_POST[submit_changepassword]))
{
	$oldpassword=$_POST['oldpassword'];
	$pass=$_POST['newpassword'];
	$confirmpassword=$_POST['confirmpassword'];
    $verify_pass=$password->verify($oldpassword,$user_details['password'],PASSWORD_DEFAULT);
   if(!$verify_pass)
    {
	$display_msg='<div class="alert alert-danger">
	<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times</button>'.$lang["wrong_old_password"].'
	</div>';
    }
   elseif($fv->emptyfields(array(password=>$oldpassword),NULL))
	{
		$display_msg= '<div class="alert alert-danger">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times</button>'.$lang["oldpass_empty"].'
		</div>';
	}
	elseif($fv->emptyfields(array(password=>$pass),NULL))
	{
		$display_msg= '<div class="alert alert-danger ">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times</button>'.$lang["newpass_empty"].'
		</div>';
	}
	elseif($pass!=$confirmpassword)
	{
		$display_msg= '<div class="alert alert-danger ">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times</button>'.$lang["password_not_match"].'
		</div>';
	}
	else
	{
		$encrypt_password = $password->hashBcrypt( $pass, '10', PASSWORD_DEFAULT) ;
		$update=$db->update('employee',array('password'=>$encrypt_password),array('employee_id'=>$_SESSION['employee_id']));
	}
	if($update)
	{
		$display_msg='<div class="alert alert-success ">
		<i class="lnr lnr-smile"></i> <button class="close" data-dismiss="alert" type="button">&times</button>'.$lang["password_changed"].'
		</div>';
		echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("changepassword",frontend)."'
	                },2000);</script>";
	}
}
?>