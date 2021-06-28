<?php
if($_REQUEST['token'] && $security->decrypt($_REQUEST['token'], key))
{


$postdata = file_get_contents("php://input");
header('Content-Type: application/json');

$request = json_decode($postdata,true);
$st=array();
$employee_id=$request['employee_id'];
$company_id = $request['company_id'];

/*to get current week start and end date*/
$monday = strtotime("last monday");
$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;

$sunday = strtotime(date("Y-m-d",$monday)." +6 days");

$this_week_sd = date("Y-m-d",$monday);
//$this_week_ed = date("Y-m-d",$sunday);

$start = DateTime::createFromFormat("Y-m-d",$this_week_sd);
$interval = new DateInterval("P1D"); // 1 month
$occurrences = 6;
$period = new DatePeriod($start,$interval,$occurrences);
foreach($period as $dt){
         $date=$dt->format("Y-m-d");
         $date1=$dt->format("D");
         $ls_week=$db->run("SELECT SUM(check_out_time) from `shift_check` where `employee_id` ='".$employee_id."' AND `company_id`='".$company_id."' AND `current_dt`= '".$date."'")->fetchColumn();

        $getHours = floor($ls_week / 3600);
        $getMins = floor(($ls_week - ($getHours*3600)) / 60);
        $hr= $getMins;

         $st[$date1]=$hr;

}
echo json_encode($st);

}
else
{
	$session->redirect('404',frontend);
}
?>