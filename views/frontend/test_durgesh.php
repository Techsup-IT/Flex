<style>
* {
    box-sizing: border-box;
}

/* Create three columns of equal width */
.columns {
    float: left;
    width: 33.3%;
    padding: 8px;
}

/* Style the list */
.price {
    list-style-type: none;
   /* border: 1px solid #eee;*/
	border: 1px solid #bbb6b6;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
}

/* Add shadows on hover */
.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

/* Pricing header */
.price .header {
    background-color:#34495e; /* #111;*/
    color: white;
    font-size: 25px;
}

/* List items */
.price li {
    border-bottom: 1px solid #eee;
    padding: 15px;
    text-align: center;
}

/* Grey list item */
.price .grey {
    background-color: #eee;
    font-size: 20px;
}

/* The "Sign Up" button */
.button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 25px;
    text-align: center;
    text-decoration: none;
    font-size: 18px;
}

/* Change the width of the three columns to 100% 
(to stack horizontally on small screens) */
@media only screen and (max-width: 600px) {
    .columns {
        width: 100%;
    }
}

</style>
<?php if (isset($_POST['payment_submit'])){
    
   $company_id=$_POST['company_id'];
   $amount=$_POST['amount'];
   $employee_id=$_POST['employee_id'];
   $txn_id=time();
   $ip_address=$_SERVER['REMOTE_ADDR'];
   $create_on=date('y-m-d h:i:s');
   $ip_address=$_SERVER['REMOTE_ADDR'];
   
    $insert=$db->insert('payments',array('company_id'=>$company_id,
                                         'amount'=>$amount,
                                         'employee_id'=>$employee_id,
                                         'txn_id'=>$txn_id,
                                         'ip_address'=>$ip_address,
                                         'created_date'=>$create_on));
    if ($insert){
        $new_employee_alloyed_to_company=COMPANY_ALLOWED_EMPLOYEE+1;
        $update=$db->update('company',array('currently_allowed_employee'=>$new_employee_alloyed_to_company),array('id'=>$company_id));
        
        if ($update){
        $display_msg='<div class="alert alert-success">
		<i class="lnr lnr-sad"></i> <button class="close" data-dismiss="alert" type="button">&times;</button>
        Payment Successfully.
		</div>';
        echo "<script>
                 setTimeout(function(){
	    		  window.location = '".$link->link("add_user",frontend)."'
	                },3000);</script>";
        }
    }
    
    
    
}?>


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
                 
                       <?php echo $display_msg;?> 
                   <div class="columns">
 <form action="" method="post">
 <input type="hidden" name="amount" value="5">
 <input type="hidden" name="company_id" value="<?php echo CURRENT_LOGIN_COMPANY_ID;?>">
 <input type="hidden" name="employee_id" value="<?php echo CURRENT_LOGIN_ID;?>">
  <ul class="price">
    <li class="header">Basic</li>
    <li class="grey">$5/User/Month</li>
    <li>Snapshots</li>
    <li>Logs</li>
    <li>Projects</li>
    <li>Tasks</li>
    <li class="grey"><button type="submit" name="payment_submit" class="button">Pay & Continue</button></li>
  </ul>
  </form>
</div>

                       
                    </div>
                    </div>