<?php  
    echo $this->TablerForm->input('api_key',['label'=>'Stripe API Key','value'=>(isset($options['api_key'])?$options['api_key']:'')]); 
    echo $this->TablerForm->input('publishable_key',['label'=>'Stripe Publishable Key','value'=>(isset($options['publishable_key'])?$options['publishable_key']:'')]); 
    echo $this->TablerForm->input('currency',['label'=>'Currency Code','value'=>(isset($options['currency'])?$options['currency']:'')]); 

?>

   
        
