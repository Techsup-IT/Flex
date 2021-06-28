<?php
require 'assets/stripe/init.php';
use Stripe\Stripe;
//$stripe = new Stripe();
use Stripe\Charge;
?>

  <script src="https://checkout.stripe.com/v2/checkout.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script>
        
        $(document).ready(function() {
            
            $(':submit').on('click', function(event) {
                event.preventDefault();

                var $button = $(this),
                    $form = $button.parents('form');

                var opts = $.extend({}, $button.data(), {
                    token: function(result) {
                        $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                    }
                });

                StripeCheckout.open(opts);
            });
        });
        </script>



<div id="content-container">
          <div class="pageheader">
                        <h3><i class="fa fa-money"></i>Payment</h3>
                        <div class="breadcrumb-wrapper">
                             <span class="label">You are here:</span>  <ol class="breadcrumb">
                                 <li class="active">Payment</li>
                            </ol>
                        </div>
                    </div>



                    <div id="page-content">
 <?php
 $company_id=CURRENT_LOGIN_COMPANY_ID;
 $plan_id=$_REQUEST['plan_id'];

 
 if(!$db->exists('plans',array('id'=>$plan_id)))
 {
     $display=1;
     echo '<h2>Plan Id # does not exist';
 
 }else{
    
 
     $get_plan_details=$db->get_row('plans',array('id'=>$plan_id));
     $paid_amount = $get_plan_details['price']*100;
     $plan_name=$get_plan_details['plan_name'];
     $plan_price=$get_plan_details['price'];
     $allow_staff=$get_plan_details['allow_staff'];
    
if ($_POST) {
    
   
    Stripe::setApiKey(stripe_secretkey_test);
    $error = '';
    $success = '';
    try {
        if (!isset($_POST['stripeToken']))
            throw new Exception("The Stripe Token was not generated correctly");
            $return = Charge::create(array("amount" =>$paid_amount,
                "currency" => "usd",
                "card" => $_POST['stripeToken']));
           $success = 'Your payment was successful.';
           $transid = $return->id;
           
         //   print " <p><h3>Thank You Your Transaction Is Completed</h3></p>\n";
            
            
	        
      if (!$db->exists('plans_company',array('company_id'=>$company_id)))
	        {
	        	
	            $plan_update=$db->insert('plans_company',array('plan_id'=>$plan_id,
                                            	               'plan_name'=>$plan_name,
                                            	               'price'=>$plan_price,
        	                                                   'company_id'=>$company_id,
        	                                                   'allow_staff'=>$allow_staff,
                                                	           'created_date'=>date('Y-m-d'),
                                                	           'ip_address'=>$_SERVER['REMOTE_ADDR']
                                                	           ));
	            $insert_allplan_table=$db->insert('plans_all',array('plan_id'=>$plan_id,
                                    	                'plan_name'=>$plan_name,
                                    	                'price'=>$plan_price,
                                    	                'company_id'=>$company_id,
                                    	                'allow_staff'=>$allow_staff,
                                    	                'txn'=>$transid,
                                    	                'txn_details'=>serialize($return),
                                    	                'created_date'=>date('Y-m-d'),
	                                                    'txn'=>$transid,
	                'txn_details'=>serialize($return),
                                    	                'ip_address'=>$_SERVER['REMOTE_ADDR']
                                    	            ));
	        }
	        else{
	            $plan_update=$db->update('plans_company',array('plan_id'=>$plan_id,
                                    	                'plan_name'=>$plan_name,
                                    	                'price'=>$plan_price,
	                                                    'allow_staff'=>$allow_staff,
                                    	                'txn'=>$transid,
                                    	                'txn_details'=>serialize($return),
                                    	                'created_date'=>date('Y-m-d'),
                                    	                'ip_address'=>$_SERVER['REMOTE_ADDR']
	                                                    ),array('company_id'=>$company_id));
	            $insert_allplan_table=$db->insert('plans_all',array('plan_id'=>$plan_id,
                                        	                'plan_name'=>$plan_name,
                                        	                'price'=>$plan_price,
                                        	                'company_id'=>$company_id,
                                        	                'allow_staff'=>$allow_staff,
	                                                        'txn'=>$transid,
	                                                        'txn_details'=>serialize($return),
                                        	                'created_date'=>date('Y-m-d'),
                                        	                'ip_address'=>$_SERVER['REMOTE_ADDR']
                                        	            ));


	        }
           // $db->debug();
         if ($plan_update)
         {
             $session->redirect('home',frontend);
         }  
            
    }
    catch (Exception $e){
        $error = $e->getMessage();
        print_r($error);
    }
}

 }
?>                   
                 
                       <?php echo $success;?> 

     <div class="columns">
   <form action="" method="post">
     <input type="hidden" name ="DO_STEP_1" value="true">
  
    <ul class="price">
    <li class="header"><?php echo $get_plan_details['plan_name']?></li>
    <li class="grey">$<?php echo $get_plan_details['price']?>/Month</li>
    <li><?php echo $get_plan_details['allow_staff']?> Users</li>
    <li>Unlimited Logs</li>
    <li>Unlimited Projects</li>
    <li>Unlimited Tasks</li>
    <li class="grey"><input type="submit" class="btn btn-primary active m-t-1" value="Pay" data-currency="USD"
                                                                  data-key="<?php echo stripe_publishkey_test ?>" 
                                                                  data-name="<?php echo $get_plan_details['plan_name']?>"
                                                                  data-custom="<?php echo $get_plan_details['plan_id']?>"
                                                                  data-image="<?php echo SITE_URL.'/assets/timenox.jpg';?>"
                                                                  data-description="<?php echo $get_plan_details['plan_name']?> Plan Subscription"
                                                                  data-amount="<?php echo $paid_amount;?>"></li>
  </ul>                    
</form> 
</div>   




                       
                    </div>
                    </div>
                  