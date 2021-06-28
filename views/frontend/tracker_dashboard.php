<?php
if($_REQUEST['token'] && $security->decrypt($_REQUEST['token'], key))
{

		$postdata = file_get_contents("php://input");
		header('Content-Type: application/json');
		$request=array();
        $sessions = array();
		$request = json_decode($postdata,true);
		$employee_id = $request['employee_id'];
		$company_id=$request['company_id'];

		//for today total work
		$today = date('Y-m-d');
		$yesterday=date('Y-m-d',strtotime("-1 days"));

         $times=$db->run("SELECT SUM(check_out_time) from `shift_check` where `employee_id` ='".$employee_id."' AND `current_dt` ='" . $today . "'")->fetchColumn();


       //for LAST week
		$slast_date = strtotime( $yesterday . " -1 week" );
		 $slast_date=date('Y-m-d',$slast_date);

		$elast_date = strtotime( $yesterday . " -1 days" );
		 $elast_date=date('Y-m-d',$elast_date);

		 $ls_week=$db->run("SELECT SUM(check_out_time) from `shift_check` where `employee_id` ='".$employee_id."' AND `current_dt` BETWEEN '". $slast_date ."' AND  '" . $elast_date . "'")->fetchColumn();



		//for THIS week
		$end_comingwk_date = strtotime( $yesterday . " +6 days" );
		$end_comingwk_date=date('Y-m-d',$end_comingwk_date);

		$this_week=$db->run("SELECT SUM(check_out_time) from `shift_check` where `employee_id` ='".$employee_id."' AND `current_dt` BETWEEN '" . $yesterday . "' AND  '" . $end_comingwk_date . "'")->fetchColumn();



		//for this month
		$s_month=date('Y-m-01');
		$e_month = date('Y-m-t');

        $this_month=$db->run("SELECT SUM(check_out_time) from `shift_check` where `employee_id` ='".$employee_id."' AND `current_dt` BETWEEN '" . $s_month . "' AND  '" . $e_month . "'")->fetchColumn();




		$sessions['today']=gmdate("H:i:s", $times);

		$sessions['this_week']=gmdate("H:i:s", $this_week);
		$sessions['ls_week']=gmdate("H:i:s", $ls_week);
		$sessions['this_month']=gmdate("H:i:s", $this_month);

        $today_format=date('F d, Y',strtotime($today));
		$sessions['today_date']=$today_format;

		$slast_week_date_format=date('M d, Y',strtotime($slast_date));
		$elast_week_date_format=date('M d, Y',strtotime($elast_date));
		$sessions['slast_week_date']=$slast_week_date_format;
		$sessions['elast_week_date']=$elast_week_date_format;

		$yesterday_format=date('M d, Y',strtotime($yesterday));
		$end_comingwk_date_format=date('M d, Y',strtotime($end_comingwk_date));

		$sessions['yesterday']=$yesterday_format;
		$sessions['end_comingwk_date']=$end_comingwk_date_format;

		$s_month_format=date('F, Y',strtotime($s_month));
		$e_month_format=date('Mon d, Y',strtotime($e_month));

		$sessions['s_month']=$s_month_format;
		$sessions['e_month']=$e_month_format;



        echo json_encode($sessions);


        }
        else
        {
        	$session->redirect('404',frontend);
        }

?>