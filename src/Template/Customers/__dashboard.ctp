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
                    <i class="fa fa-edit"></i> Edit
                </button>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">Customer addresses</h3>

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
                    <?php if($customer->area) echo "Area: {$customer->area}" ?> </br>
                    <?= h($customer->city) ?>-<?= h($customer->post_code) ?><br />
                    <?= h($customer->country) ?>
                </p>
            </div>
        </div>

    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= h($customer->first_name) ?>  <?= h($customer->last_name) ?>'s Orders</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <td style="border-top: none">Order ID</td>
                    <td style="border-top: none">Order Date</td>
                    <td style="border-top: none">Order Status</td>
                    <td style="border-top: none">Order total Amount</td>
                    </thead>

                    <?php foreach ($customer->orders as  $order): ?>
                        <tr>
                            <td><a target="_blank" href="<?= $this->Url->build(['controller' => 'checkout', 'action' => 'trackOrder', $order->order_id, $order->order_password]) ?>"><?= $order->order_id ?></a></td>
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
                <h5 class="modal-title">Customer Overview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create($customer, ['url' => $this->Url->build(['controller'=>'Customers', 'action' => 'edit'])])?>
                <fieldset class="form-fieldset">

                    <div class="row">
                        <?php
                        echo $this->TablerForm->control('first_name',['row'=>6]);
                        echo $this->TablerForm->control('last_name',['row'=>6]);
                        echo $this->TablerForm->control('email',['row'=>6]);
                        echo $this->TablerForm->control('phone',['row'=>6]);

                        echo $this->TablerForm->control('address',['row'=>12]);
                        echo $this->TablerForm->control('area',['row'=>6]);
                        echo $this->TablerForm->control('city',['row'=>6,'label'=>'City/District/State','id'=>'shipping_city','required']);
                        echo $this->TablerForm->control('post_code',['row'=>6]);
                        echo $this->TablerForm->control('country', ['country' => true, 'row' => 6, 'required'])

                        ?>
                    </div>

                </fieldset>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>



<!--Edit customer modal-->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- SVG icon code -->
                </button>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create(null, ['url' => $this->Url->build(['controller'=>'Customers', 'action' => 'changePassword'])])?>
                <fieldset class="form-fieldset">

                    <div class="row">
                        <?php
                            echo $this->TablerForm->control('old_password',['row'=>12, 'required']);
                            echo $this->TablerForm->control('new_password',['row'=>12, 'required']);
                            echo $this->TablerForm->control('confirm_password',['row'=>12, 'required']);
                        ?>
                    </div>

                </fieldset>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white mr-auto" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Change Password</button>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>




<script>

    require(['jquery'], function ($, autocomplete) {
        $(document).ready(function() {

        });
    });


</script>