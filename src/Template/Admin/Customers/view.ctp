<div class="row py-5">
    <div class="col-lg-4">
        <div class="card card-profile">

            <div class="card-body text-center">
                
            <span class="avatar avatar-xl" ><?= strtoupper(substr($customer->first_name,0,1)) ?><?= strtoupper(substr($customer->last_name,0,1)) ?></span>
                <h3 class="mb-3"><?= h($customer->first_name) ?>  <?= h($customer->last_name) ?></h3>
                
                <p class="mb-4">
                    <?= h($customer->email) ?><br/>
                    <?= h($customer->phone) ?>
                </p>

                <button data-toggle="modal" data-target="#editcustomerAddressModal" class="btn btn-outline-primary btn-sm edit-addr">
                    <i class="fa fa-edit"></i> <?= __('Edit') ?>
                </button>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title"><?= __('Customer addresses') ?></h3>

                <!--
             <div class="card-options">

                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#customerAddressModal">
                    <i class="fe fe-plus mr-2"></i>Add New
                  </button>
             </div>
             -->

            </div>
            <div class="card-body">
                <p class="mb-4">
                    <?= h($customer->address) ?>  <br />
                    <?php 
                        if($customer->area)
                            echo __("Area: {0}", [$customer->area]);
                    ?> 
                    </br>

                    <?= h($customer->city) ?>-<?= h($customer->post_code) ?><br />
                    <?php echo $customer->country ?>
                </p>
            </div>
        </div>

    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= h($customer->first_name) ?>  <?= h($customer->last_name) ?> <?= __('Orders') ?></h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <td style="border-top: none"><?= __('Order ID') ?></td>
                    <td style="border-top: none"><?= __('Order Date') ?></td>
                    <td style="border-top: none"><?= __('Order Status') ?></td>
                    <td style="border-top: none"><?= __('Order total Amount') ?></td>
                    </thead>
                    <?php
                    $badge = [0=>'badge-primary',1=>'badge-info', 2=>'badge-warning',3=>'badge-success', 4=>'badge-danger', 5=> 'badge-secondary'];
                    $order_statuses = [0=>'Pending',1=>'Processing',2=>'Shipped',3=>'Delivered',4=>'Cancelled',5=>'Payment'];
                    ?>
                    <?php foreach ($customer->orders as  $order): ?>
                        <tr>
                            <td><a href="<?= $this->Url->build(['controller' => 'Orders', 'action' => 'view', $order->id]) ?>"><?= $order->order_id ?></a></td>
                            <td><?= $order->order_date ?></td>
                            <td><span class="badge <?= $badge[$order->order_status] ?>"><?= $order_statuses[$order->order_status] ?></span></td>
                            <td><?= $order->order_total ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>
    </div>
</div>



<!--Edit customer modal-->
<div class="modal fade" id="editcustomerAddressModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= __('Update Customer Info') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create($customer, ['url' => $this->Url->build(['controller'=>'Customers', 'action' => 'edit', $customer->id])])?>
                <fieldset class="form-fieldset">
                  <h3 class="card-title"><?= __('Customer Overview') ?></h3>
                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('first_name',['row'=>6]);
                        echo $this->TablerForm->control('last_name',['row'=>6]);
                        echo $this->TablerForm->control('address',['row'=>12]);
                        echo $this->TablerForm->control('area',['row'=>6]);
                        //echo $this->TablerForm->control('city',['row'=>6]);
                        echo $this->TablerForm->control('city', ['row' => 6, 'label' => __('City/District/State'), 'id' => 'shipping_city', 'required']);
                        echo $this->TablerForm->control('post_code',['row'=>6]);
                        echo $this->TablerForm->control('country',['row'=>6, 'country' => true, 'id' => 'country']);
                        echo $this->TablerForm->control('email',['row'=>6]);
                        echo $this->TablerForm->control('phone',['row'=>6]);
                        //echo $this->TablerForm->control('passwd',['row'=>12, 'label' => 'Password', 'type' => 'password', 'value'=> '']);
                        ?>
                    </div>

                </fieldset>


                    <fieldset class="form-fieldset">
                        <h3 class="card-title"><?= __('Customer Authentication') ?></h3>
                        <div class="row">
                        <?php
                              echo $this->TablerForm->control('username', ['row' => 12, 'required', 'label' => 'Username']);
                              echo $this->TablerForm->control('passwd', ['row' => 12, 'value' => '', 'placeholder'=> __('type new password to change password'), 'label' => __('Password')]);
                        ?>
                        </div>
                    </fieldset>





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal"><?= __('Close') ?></button>
                <button type="submit" class="btn btn-primary"><?= __('Save changes') ?></button>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<div class="d-none">
    <?php echo $this->TablerForm->control('city', ['bd_district' => true, 'row' => 6, 'label' => __('City/District/State'), 'id' => 'var_shipping_city', 'required']); ?>
</div>

<script>

    require(['jquery'], function ($, selectize) {
        $(document).ready(function () {

        });
    });

</script>
