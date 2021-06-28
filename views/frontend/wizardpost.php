<?php

/*if($db->get_count('company')!='0'){
	$session->redirect('login',frontend);
}
*/
if(isset($_POST))
{

$file=json_encode($_POST);

$_POST=json_decode($file,true);
$email=$_POST['email'];
$pass=$_POST['password'];
$emp_name=$_POST['emp_name'];
$emp_surname=$_POST['emp_surname'];
$contact1=$_POST['contact1'];
$dob=$_POST['dob'];
$address=$_POST['address'];
$department="1";

//company details
$company_name=$_POST['company_name'];
$company_website=$_POST['company_website'];
$company_email=$_POST['c_email'];
$company_address=$_POST['company_address'];
$telephone1=$_POST['telephone1'];
$company_currencysymbol=$_POST['company_currencysymbol'];
$date_format=$_POST['date_format'];
$country=$_POST['country'];
$state=$_POST['state'];
$city=$_POST['city'];
$zip=$_POST['zip'];
$timezone=$_POST['timezone'];
$create_on=date('y-m-d h:i:s');
$ip_address=$_SERVER['REMOTE_ADDR'];
$return=array();

$return['error']="false";
if($db->exists('employee',array('email'=>$email)))
{
	$return['msg']='<div class="alert alert-danger text-danger text-center">
		<i class="lnr lnr-sad"></i>
			<font color="red"> Sorry! Email already exist!.</font>
		</div>';
	$return['error']=true;

}
elseif($db->exists('company',array('company_name'=>$company_name)))
{
	$return['msg']='<div class="alert alert-danger text-danger text-center">
		<i class="lnr lnr-sad"></i>
			<font color="red"> Sorry! Company name already exist!.</font>
		</div>';
	$return['error']=true;

}
elseif($db->exists('company',array('company_email'=>$company_email)))
{
	$return['msg']='<div class="alert alert-danger text-danger text-center">
		<i class="lnr lnr-sad"></i>
                 <font color="red"> Sorry! Company email already exist!.</font>
		</div>';
	$return['error']=true;

}
else
{

$insert_company=$db->insert('company',array('company_email'=>$company_email,'company_name'=>$company_name,'company_website'=>$company_website,
		                            'company_address'=>$company_address,'telephone1'=>$telephone1
		                            ,'timezone'=>$timezone,'company_currencysymbol'=>$company_currencysymbol,'date_format'=>$date_format,
		                            'country'=>$country,'state'=>$state,'city'=>$city,'zip'=>$zip,'create_date'=>$create_on,'ip_address'=>$ip_address));

$last_id=$db->lastInsertId();

$encrypt_password = $password->hashBcrypt( $pass , '10', PASSWORD_DEFAULT);
if($insert_company){
$insert=$db->insert('employee',array('emp_name'=>$emp_name,'emp_surname'=>$emp_surname,'department'=>$department,'address'=>$address,'contact1'=>$contact1,'company_id'=>$last_id,'email'=>$email,'dob'=>$dob,'password'=>$encrypt_password,'create_date'=>$create_on,'ip_address'=>$ip_address));

$emplast_id=$db->lastInsertId();
$pathimg = SERVER_ROOT.'/uploads/images/';
$path = SERVER_ROOT.'/uploads/images/'.$last_id.'/';
$emppath = SERVER_ROOT.'/uploads/images/'.$last_id.'/'.$emplast_id.'/';

if(!is_dir($pathimg))
{
	mkdir($pathimg);

	if(!file_exists($path) && !file_exists($emppath)){
		mkdir($path);
		mkdir($emppath);
	}
}
}
if ($insert_company){
	$link_address= SITE_URL.'/index.php?user=login';
	$return['msg']='<div class="alert alert-success text-success text-center">
		<i class="lnr lnr-smile"></i>
			<font color="green">Registration Successfull. </font>&nbsp;&nbsp;<a href="'.$link_address.'"><font color="blue">Click Here to Login</font></a>
		</div>';
	$return['error']=false;

}
}

echo $return['msg'];
}
else
{
$session->redirect('404',frontend);
}
?>