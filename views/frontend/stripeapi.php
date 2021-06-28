<?php
require 'assets/stripe/init.php';
use Stripe\Stripe;
//$stripe = new Stripe();
use Stripe\Charge;
?>

<body class="">
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
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-x-auto pull-xs-none vamiddle">
                    <div class="card-group ">

                        <div class="card card-inverse card-primary p-y-3" >
                            <div class="card-block text-xs-center">
                                <div>
<?php






if ($_POST) {
   
    Stripe::setApiKey(stripe_secretkey_test);
    $error = '';
    $success = '';
    try {
        if (!isset($_POST['stripeToken']))
            throw new Exception("The Stripe Token was not generated correctly");
            $return = Charge::create(array("amount" => "100",
                "currency" => "usd",
                "card" => $_POST['stripeToken']));
           $success = 'Your payment was successful.';
           $transid = $return->id;
            print_r($return);
            print " <p><h3>Thank You Your Transaction Is Completed</h3></p>\n";
            
           
            
    }
    catch (Exception $e) {
        $error = $e->getMessage();
        print_r($error);
    }
}




// If there is no POST data or a token-id, print the initial shopping cart form to get ready for Step One.

    print '

  <h2>Invoice #'.$invoice.'</h2><p>Stripe Payment</p>
                                    <p>Enter your Details</p>

        <form action="" method="post">
                                 
        <input type="submit" class="btn btn-primary active m-t-1" value="Pay Now" data-currency="USD"
          
    data-key="'.stripe_publishkey_test.'" 
    data-name="Timenox"
    data-description="Invoice Payment"
    data-amount="10000">
                                <input type="hidden" name ="DO_STEP_1" value="true">
            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    ';

?>