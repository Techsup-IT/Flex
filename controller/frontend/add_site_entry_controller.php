
<?php if (isset($_POST['submit_add_site_entry'])){
    print_r($_POST);
    $site_title=$_POST['site_title'];
    $site_url=$_POST['site_url'];
    $company_id = $_SESSION['company_id'];
    $user_id = $_SESSION['employee_id'];
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $create_on=date('y-m-d h:i:s');
    
    if($site_title == '')
    {
        $display_msg='<div class="alert alert-danger">
                    		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>'.$lang["enter_site_title"].'
                    		</div>';
    }
    else if($site_url == '')
    {
        $display_msg='<div class="alert alert-danger">
                    		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>'.$lang["enter_site_url"].'
                    		</div>';
    }
    else {
        $insert_site_entry = $db->insert('site_setting',array('site_name'=>$site_title,'site_url'=>$site_url,'company_id'=>$company_id,'ip_address'=>$ip_address,'created_date'=>$create_on));
        if($insert_site_entry) {
            $display_msg='<div class="alert alert-success">
                            	 <i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>'.$lang["add_success"].'
                            	 </div>';
        }
    }
}?>