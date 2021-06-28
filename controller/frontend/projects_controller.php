<?php
$emp=$_REQUEST['emp'];
$user_name=$db->get_var('employee',array('employee_id'=>$emp),'emp_name');

$projects_details=$db->run("SELECT projects.*, COUNT( project_assign.id ) 
    AS project_assign_count FROM projects LEFT JOIN project_assign 
    ON projects.project_id=project_assign.project_id  
    where projects.`company_id` ='". $_SESSION['company_id']."' 
    GROUP BY projects.project_id ORDER by projects.project_id DESC")->fetchAll();


$load=$_REQUEST['del_project_id'];

if(isset($_REQUEST['del_project_id']))
{
    $display_msg='<form method="POST" action="">
<div class="alert alert-success" >
'.$lang["project_delete_confirmation"].'
<input type="hidden" name="del_id" value="'.$load.'" >
<button name="yes" type="submit" class="btn btn-success btn-xs"  aria-hidden="true"><i class="fa fa-check-square-o"></i></button>
<button name="no" type="submit" class="btn btn-danger btn-xs" aria-hidden="true"><i class="fa fa-remove"></i></button>
</div>
</form>';
if(isset($_POST['yes']))
{
    $delete_project_assign=$db->delete("project_assign", array('project_id'=>$load));
    $delete=$db->delete("projects",array('project_id'=>$load));
    if($delete)
    {
       $session->redirect('projects',frontend);
    }
}
elseif(isset($_POST['no']))
{
    $session->redirect('projects',frontend);
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

