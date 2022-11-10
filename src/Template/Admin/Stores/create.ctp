


<style type="text/css">
.preloader{
display: flex;
align-items: center;
justify-content: center;
position: fixed;
top: 0;
width: 100%;
height: 100%;
background: #f5f7fb; 
z-index: 9999;
  
}
</style>

  
<!-- Preloader -->
<div id="preloader" style="display:none" class="container preloader flex-column align-items-center justify-content-center">
<div class="row">
<div class="spinner-border text-primary" role="status"></div>
</div>
<div class="row">
<strong id="loading_message"></strong>
</div>
</div>




  
    <div class="container" id="personal_details" style="display:none">
 
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6 card card-body py-5 px-5">
          <div class="px-3 py-3">
            <div class="mb-4">
              <h3><?= h('Your shop almost created')?></h3>
              <p class="mt-3 text-muted"><?= h('Please share some details info about yourself to configure your store.')?></p>
            </div>


            <?=$this->Form->create(null,['id'=>'detailsfrm'])?>
              <?=$this->TablerForm->control('store[title]',['label'=>'Store Full Name','required'=>true,'id'=>'store_title'])?>
              <?=$this->TablerForm->control('store[first_name]',['label'=>'Your First Name','required'=>true])?>
              <?=$this->TablerForm->control('store[last_name]',['label'=>'Your Last Name','required'=>true])?>
              <?=$this->TablerForm->control('store[address]',['label'=>'Store Address','required'=>true,])?>
              <?=$this->TablerForm->control('store[area]',['label'=>'Area','required'=>true])?>
              <?=$this->TablerForm->control('store[city]',['label'=>'City','required'=>true])?>
              <?=$this->TablerForm->control('store[post_code]',['label'=>'Post Code','required'=>true])?>
              <?=$this->TablerForm->control('store[phone]',['label'=>'Phone No','required'=>true])?>
              <?=$this->TablerForm->control('store[country]',['label'=>'Country','country'=>true])?>
              <?=$this->TablerForm->control('store[currency]',['label'=>'Currency','value'=>'$','required'=>true])?>
            
              <?=$this->Form->hidden('store[email]',['id'=>'email']) ?>
              <?=$this->Form->hidden('store[web]',['id'=>'web']) ?>
              <?=$this->Form->hidden('auth_token') ?>
              <?=$this->Form->hidden('nonce') ?>
              <?=$this->Form->hidden('username') ?>
              <?=$this->Form->hidden('customer_id',['id'=>'customer_id']) ?>

              <button type="submit" id="submit" class="btn btn-primary btn-block"><?=__('Continue')?></button>

              <?=$this->Form->end()?>

          </div>
        </div>
      </div>
    </div>


  <!-- End Preloader -->

  <!-- Section 1 -->
 
    <div class="container" id="register">
   
      <div class="row justify-content-center">
        <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6 card card-body py-5 px-5">
          <div class="px-3 py-3">
            <div class="card-title">
            <?= __('Start your free store with')?> <?php echo ADMIN_DOMAIN?>
              <p class="mt-3 text-muted"></p>
            </div>
            <div id="flasharea">
              <?= $this->Flash->render() ?>
            </div>

            <?=$this->Form->create(null,['id'=>'registerfrm'])?>
             
              
              <?=$this->TablerForm->control('email',['autocomplete'=>'off','label'=>'Email Address','required'=>true])?>
              <?=$this->TablerForm->control('password',['autocomplete'=>'off','label'=>'Password','required'=>true])?>
              
              <div class="form-group mb-3 required">
              	<label for="store_name" class='form-label'><?=__('Store Name')?></label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">https://</span>
                  </div>
                 
                  <?=$this->Form->text('store_name',['class'=>'form-control'])?>
                  <div class="input-group-append">
                      <span class="input-group-text">.<?php echo ADMIN_DOMAIN?></span>
                  </div>
              </div>
              </div>
              
             <?php if($captcha_verify): ?>
             <div class="form-group">
              <div class="g-recaptcha" data-sitekey="<?=$captcha_site_key?>"></div>
             </div>
            <?php endif; ?>  

            <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" required="required">
                      <span class="custom-control-label">Agree the <a href="<?=$this->Url->build('/page/terms')?>">terms and policy</a></span>
                    </label>
            </div>
           <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block"><?=__('Create Store')?></button>
            </div>
              

              <?=$this->Form->end()?>
            <div class="mt-5 text-center">
              <p class="m-0"><?=__('Feeling trouble in registration ?')?></p>
              <a href="<?=$this->Url->build('/page/contact-us')?>"><?=__('Contact us')?></a>
            </div>
          </div>
        </div>
      </div>
    </div>

  <!-- End Section 1 -->

  <script>
require(['jquery'], function ($, selectize) {
  $(function() {

    
  var store_data;
 

  function show_alert(message){
    var html = `<div class="alert alert-danger alert-dismissible fade show" role="alert">`
     + message +
    `<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      
      </button>
    </div>`;
    $('#flasharea').append(html);

  }
  


  $("#detailsfrm").submit(function(e) {
      e.preventDefault();
      $('#detailsfrm').fadeOut();
      $('#preloader').fadeIn();
      $('#loading_message').html("<?=('Please wait while we are configuring your store...')?>");
      var form = $(this);
      var url = $("#registerfrm").attr('action');
      console.log(url);
       console.log(form.serialize());
      $.ajax({
             type: "POST",
             url: url,
             data: form.serialize(), // serializes the form's elements.
             beforeSend: function(xhr){
                xhr.setRequestHeader(
                    'X-CSRF-Token',
                    <?= json_encode($this->request->param('_csrfToken')); ?>
                );
             },
             success: function(data)
             {
              $("#detailsfrm").unbind('submit');
              $("#detailsfrm button").click();
             }
      });

      

  }) 


    // this is the id of the form
  $("#registerfrm").submit(function(e) {

      e.preventDefault(); // avoid to execute the actual submit of the form.
      $('#register').fadeOut();
      $('#preloader').fadeIn();
      $('#loading_message').html("<?=('Please wait while we are creating your store...')?>");
      var form = $(this);
      var url = form.attr('action');

      $.ajax({
             type: "POST",
             url: url,
             data: form.serialize(), // serializes the form's elements.
             success: function(data)
             {
                 $('#flasharea').html("");
                 //console.log(data); // show response from the php script.
                  if(data.hasOwnProperty("status") == false) {
                    console.log("some error occured");
                    console.log(data);
                    return;
                  }
                  if(data.status < 0){
                    $('#preloader').fadeOut();
                    $('#register').fadeIn();
                    <?php if($captcha_verify): ?>  grecaptcha.reset(); <?php endif; ?>
                    if(data.hasOwnProperty("errors")){
                      //  console.log(data.errors);
                        if($.isPlainObject(data.errors)){
                            $.each( data.errors, function( key, errors ) {
                              //alert( key + ": " + value );
                            //  console.log(errors);
                              $.each( errors, function( key1, error ) {
                                //alert( key + ": " + value );
                              //  console.log(error);
                                show_alert(error);
                              });
                            });
                       }else{
                         show_alert(data.errors);
                       }
                    }


                  }else{
                  //  console.log(data);
                    if(data.hasOwnProperty("store_url")){
                        //window.location.href  = data.redirect;
                        //store_login(data);
                        store_data = data;
                        $('#preloader').fadeOut();
                        $('#register').fadeOut();
                        $('#personal_details').fadeIn();
                        $('#store_title').val($("input[name='store_name']").val());
                        $("input[name='auth_token']").val(data.auth_token);
                        $("input[name='nonce']").val(data.nonce);
                        $("input[name='username']").val(data.username);
                        $("#email").val(data.username);
                        $("#web").val(data.store_url);
                        $("#customer_id").val(data.customer_id);
                        $('#detailsfrm').attr("action",data.store_url + "/api/admin_login/" + data.site_token);



                    }else{
                      show_alert("<?=__('Site successfully created')?>");
                    }

                  }



             }
           });


         });

    });
});
  </script>

