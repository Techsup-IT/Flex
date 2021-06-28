<?php
require 'assets/stripe/init.php';
use Stripe\Stripe;
//$stripe = new Stripe();
use Stripe\Charge;
?>
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
    padding: 10px;
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
<?php $all_plans=$db->get_all('plans');
if (is_array($all_plans))
{
    foreach ($all_plans as $allp)
    {
    $amount=$allp['price']*10000;
        ?>
     <div class="columns">
   <form action="" method="get">
   
     <input type="hidden" name ="user" value="payment">
     <input type="hidden" name ="plan_id" value="<?php echo $allp['id']?>">
     
    <ul class="price">
    <li class="header"><?php echo $allp['plan_name']?></li>
    <li class="grey">$<?php echo $allp['price']?>/Month</li>
    <li><?php echo $allp['allow_staff']?> Users</li>
    <li>Unlimited Logs</li>
    <li>Unlimited Projects</li>
    <li>Unlimited Tasks</li>
    <li class="grey"><button type="submit" name="payment_submit" class="button">Continue</button></li>
  </ul>                    
</form> 
</div>   
        
        
        
  <?php }}?> 



                       
                    </div>
                    </div>
                  