<?php 
    use Cake\Core\Configure;
?>

<style type="text/css">
.hidden {
display: none;
}
    /* spinner/processing state, errors */
.spinner,
.spinner:before,
.spinner:after {
  border-radius: 50%;
}
.spinner {
  color: #ffffff;
  font-size: 22px;
  text-indent: -99999px;
  margin: 0px auto;
  position: relative;
  width: 20px;
  height: 20px;
  box-shadow: inset 0 0 0 2px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.spinner:before,
.spinner:after {
  position: absolute;
  content: "";
}
.spinner:before {
  width: 10.4px;
  height: 20.4px;
  background: #095cfa;
  border-radius: 20.4px 0 0 20.4px;
  top: -0.2px;
  left: -0.2px;
  -webkit-transform-origin: 10.4px 10.2px;
  transform-origin: 10.4px 10.2px;
  -webkit-animation: loading 2s infinite ease 1.5s;
  animation: loading 2s infinite ease 1.5s;
}
.spinner:after {
  width: 10.4px;
  height: 10.2px;
  background: #095cfa;
  border-radius: 0 10.2px 10.2px 0;
  top: -0.1px;
  left: 10.2px;
  -webkit-transform-origin: 0px 10.2px;
  transform-origin: 0px 10.2px;
  -webkit-animation: loading 2s infinite ease;
  animation: loading 2s infinite ease;
}

@-webkit-keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes loading {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>
<div class="container bodyBck">
<div class="row">
<div class="col col-login mx-auto">    
<div class="card">
   
    <div class="card-body p-6">
         <div class="card-heading">
        <h3 class="panel-title">Charge <?php echo Configure::read('App.currency') . $order->order_total; ?> with Stripe</h3>
    </div>
        <!-- Display status message -->
        <div id="paymentResponse" class="hidden"></div>
        
        <!-- Display a payment form -->
        <form id="paymentFrm" class="hidden">
            <div class="form-group">
                <label class="form-label">NAME</label>
                <input type="text" id="name" class="form-control" placeholder="Enter name" required="" autofocus="">
            </div>
            <div class="form-group">
                <label class="form-label">EMAIL</label>
                <input type="email" id="email" class="form-control" placeholder="Enter email" required="">
            </div>
            
            <div id="paymentElement">
                <!--Stripe.js injects the Payment Element-->
            </div>
            <div class="form-footer">
                <button id="submitBtn" class="btn btn-success">
                <div class="spinner hidden" id="spinner"></div>
                <span id="buttonText">Pay Now</span>
                </button>
            </div>
           
        </form>
        
        <!-- Display processing notification -->
        <div id="frmProcess" class="hidden">
            <span class="ring"></span> Processing...
        </div>
        
        <!-- Display re-initiate button -->
        <div id="payReinit" class="hidden">
            <button class="btn btn-primary" onClick="window.location.href=window.location.href.split('?')[0]"><i class="rload"></i>Re-initiate Payment</button>
        </div>
    </div>
</div>
</div>
</div>
</div>

<!-- Stripe JS library -->
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
// Get API Key
let STRIPE_PUBLISHABLE_KEY =  '<?= $options->publishable_key ?>' //'pk_test_wm51P01rw8PYTJ8Pjwa3kLwk';

// Create an instance of the Stripe object and set your publishable API key
const stripe = Stripe(STRIPE_PUBLISHABLE_KEY);

let elements; // Define card elements
const paymentFrm = document.querySelector("#paymentFrm"); // Select payment form element

// Get payment_intent_client_secret param from URL
const clientSecretParam = new URLSearchParams(window.location.search).get(
    "payment_intent_client_secret"
);

// Check whether the payment_intent_client_secret is already exist in the URL
setProcessing(true);
if(!clientSecretParam){
    setProcessing(false);
	
    // Create an instance of the Elements UI library and attach the client secret
    initialize();
}

// Check the PaymentIntent creation status
checkStatus();

// Attach an event handler to payment form
paymentFrm.addEventListener("submit", handleSubmit);

// Fetch a payment intent and capture the client secret
let payment_intent_id;
async function initialize() {
    const { id, clientSecret } = await fetch("<?=$this->Url->build(['action'=>'intent',$order->id])?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ request_type:'create_payment_intent' }),
    }).then((r) => r.json());
	
    const appearance = {
        theme: 'stripe',
        rules: {
            '.Label': {
                fontWeight: 'bold',
                textTransform: 'uppercase',
            }
        }
    };
	
    elements = stripe.elements({ clientSecret, appearance });
	
    const paymentElement = elements.create("payment");
    paymentElement.mount("#paymentElement");
	
    payment_intent_id = id;
}

// Card form submit handler
async function handleSubmit(e) {
    e.preventDefault();
    setLoading(true);
	
    let customer_name = document.getElementById("name").value;
    let customer_email = document.getElementById("email").value;
	
    const { id, customer_id } = await fetch("<?=$this->Url->build(['action'=>'intent', $order->id])?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ request_type:'create_customer', payment_intent_id: payment_intent_id, name: customer_name, email: customer_email }),
    }).then((r) => r.json());
	
    const { error } = await stripe.confirmPayment({
        elements,
        confirmParams: {
            // Make sure to change this to your payment completion page
            return_url: window.location.href+'?customer_id='+customer_id,
        },
	});
	
    // This point will only be reached if there is an immediate error when
    // confirming the payment. Otherwise, your customer will be redirected to
    // your `return_url`. For some payment methods like iDEAL, your customer will
    // be redirected to an intermediate site first to authorize the payment, then
    // redirected to the `return_url`.
    if (error.type === "card_error" || error.type === "validation_error") {
        showMessage(error.message);
    } else {
        showMessage("An unexpected error occured.");
    }
	
    setLoading(false);
}

// Fetch the PaymentIntent status after payment submission
async function checkStatus() {
    const clientSecret = new URLSearchParams(window.location.search).get(
        "payment_intent_client_secret"
    );
	
    const customerID = new URLSearchParams(window.location.search).get(
        "customer_id"
    );
	
    if (!clientSecret) {
        return;
    }
	
    const { paymentIntent } = await stripe.retrievePaymentIntent(clientSecret);
	
    if (paymentIntent) {
        switch (paymentIntent.status) { 
            case "succeeded":
                //showMessage("Payment succeeded!");
				
                // Post the transaction info to the server-side script and redirect to the payment status page
                fetch("<?=$this->Url->build(['action'=>'intent', $order->id])?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ request_type:'payment_insert', payment_intent: paymentIntent, customer_id: customerID }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.payment_id) {
                        transErr = 0;
                        window.location.href =  '<?= $this->Url->build(['plugin' => null,'controller' => 'checkout', 'action' => 'thankYou', $order->order_id ]) ?>';
                    } else {
                        showMessage(data.error);
                        setReinit();
                    }
                })
                .catch(console.error);
				
                break;
            case "processing":
                showMessage("Your payment is processing.");
                setReinit();
                break;
            case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.");
                setReinit();
                break;
            default:
                showMessage("Something went wrong.");
                setReinit();
                break;
        }
    } else {
        showMessage("Something went wrong.");
        setReinit();
    }
}


// Display message
function showMessage(messageText) {
    const messageContainer = document.querySelector("#paymentResponse");
	
    messageContainer.classList.remove("hidden");
    messageContainer.textContent = messageText;
	
    setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
    }, 5000);
}

// Show a spinner on payment submission
function setLoading(isLoading) {
    if (isLoading) {
        // Disable the button and show a spinner
        document.querySelector("#submitBtn").disabled = true;
        document.querySelector("#spinner").classList.remove("hidden");
        document.querySelector("#buttonText").classList.add("hidden");
    } else {
        // Enable the button and hide spinner
        document.querySelector("#submitBtn").disabled = false;
        document.querySelector("#spinner").classList.add("hidden");
        document.querySelector("#buttonText").classList.remove("hidden");
    }
}

// Show a spinner on payment form processing
function setProcessing(isProcessing) {
    if (isProcessing) {
        paymentFrm.classList.add("hidden");
        document.querySelector("#frmProcess").classList.remove("hidden");
    } else {
        paymentFrm.classList.remove("hidden");
        document.querySelector("#frmProcess").classList.add("hidden");
    }
}

// Show payment re-initiate button
function setReinit() {
    document.querySelector("#frmProcess").classList.add("hidden");
    document.querySelector("#payReinit").classList.remove("hidden");
}

</script>