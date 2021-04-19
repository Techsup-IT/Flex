<?php
echo $emp=$_REQUEST['emp'];
echo $user_name=$db->get_var('employee',array('employee_id'=>$emp),'emp_name');

$tasks_details=$db->run("select to_do_list.*, projects.project_name from to_do_list 
    LEFT JOIN projects ON to_do_list.project_id = projects.project_id where to_do_list.company_id = ".$_SESSION['company_id']."
    order by to_do_list.task_id DESC")->fetchAll();
//$db->debug();
//exit;
//print_r($tasks_details);
$load=$_REQUEST['del_task_id'];

if(isset($_REQUEST['del_task_id']))
{
    $display_msg='<form method="POST" action="">
<div class="alert alert-success" >
'.$lang["task_delete_confirmation"].'
<input type="hidden" name="del_id" value="'.$load.'" >
<button name="yes" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="fa fa-check-square-o"></i></button>
<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="fa fa-remove"></i></button>
</div>
</form>';
if(isset($_POST['yes']))
{
    $delete_task=$db->delete("to_do_list", array('task_id'=>$load));
    if($delete_task)
    {
       $session->redirect('tasks',frontend);
    }
}
elseif(isset($_POST['no']))
{
    $session->redirect('tasks',frontend);
}

}
if(SITE_DATE_FORMAT==1)
{
    $date_format="DD-MM-YYYY";
}elseif(SITE_DATE_FORMAT==2)
{
    $date_format="MM-DD-YYYY";
}
elseif(SITE_DATE_FORMAT==3)
{
     $date_format="Day-Month-Year";
}
?>
