<?php  echo $this->TablerForm->input('email',['label'=>'Paypal Email','value'=>(isset($options['email'])?$options['email']:'')]); 
 echo $this->TablerForm->input('currency',['label'=>'Currency Code','value'=>(isset($options['currency'])?$options['currency']:'')]); 
   echo $this->TablerForm->control('sandbox', ['type' => 'checkbox','value'=>1, 'label' => __('Use Sandbox'),'checked'=>(isset($options['sandbox']) && $options['sandbox']) == 1?true:false]); ?>
        
