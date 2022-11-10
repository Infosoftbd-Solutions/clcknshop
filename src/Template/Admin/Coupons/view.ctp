<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
?>
<?php
//    dd($order);
?>
<script>
    require.config({
        shim: {
            'autocomplete': ['jquery', 'bootstrap']
        },
        paths: {
            'autocomplete': 'assets/js/vendors/bootstrap-autocomplete.min'
        }
    });

    /*require.config({
      shim: {
          'btvalidator': ['jquery', 'bootstrap']
      },
      paths: {
          'btvalidator': 'assets/js/vendors/bootstrap-validate'
      }
    });*/

</script>

<?=$this->Html->css('/js/x-editable/bootstrap-editable')?>
<script>
    require.config({
        shim: {
            'xeditable': ['jquery', 'core']
        },
        paths: {
            'xeditable': 'js/x-editable/bootstrap-editable.min'
        }
    });
</script>

<script>
    require.config({
        shim: {
            'jqtoast': ['jquery']
        },
        paths: {
            'jqtoast': 'assets/js/jquery.toast.min'
        }
    });
</script>


<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered" style="margin-bottom: 0px !important; background-color: #ffffff">
                <thead>
                <td colspan="7" style="border-bottom-width: 0px">
                    <div class="d-flex">
                        <p style="margin-bottom: 0px !important; font-weight: bold; font-size: 18px;">
                            <?php echo "Coupon # " . $coupon->coupon_code; ?>
                        </p>
                        <a href="<?php echo $this->Url->build(['action'=>'edit', $coupon->id]) ?>" class="btn btn-sm btn-outline-primary ml-auto">Edit Coupon</a>
                    </div>
                </td>
                </thead>
                <tbody>
                    <tr>
                        <th class="text-center" style="width: 15%"><?= __('Title') ?></th>
                        <th class="text-center" style="width: 10%"><?= __('Start Date') ?></th>
                        <th class="text-center" style="width: 10%"><?= __('End Date') ?></th>
                        <th class="text-center" style="width: 10%"><?= __('Discount') ?></th>
                        <th class="text-center" style="width: 10%"><?= __('Max Amount') ?></th>
                        <th class="text-center" style="width: 10%"><?= __('Min Shopping') ?></th>
                        <th class="text-center" style="width: 7%"><?= __('Status') ?></th>
                    </tr>

                    <tr>
                        <td class="text-center"><?= $coupon->title ?></td>
                        <td class="text-center"><?= $coupon->start_date ?></td>
                        <td class="text-center"><?= $coupon->end_date ?></td>
                        <td class="text-center"><?= $coupon->discount ?> <?= $coupon->discount_type ? "%" : '' ?></td>
                        <td class="text-center"><?= $coupon->max_amount ?></td>
                        <td class="text-center"><?= $coupon->min_shopping ?></td>
                        <td class="text-center"><?= $coupon->status ? __('Active') : __('Inactive') ?></td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="row row-cards row-deck mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex">
                <h4 style="margin-bottom: 0px !important;"><?= __('Collections') ?></h4>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                    <thead style="font-weight: bold">
                    <tr>
                        <th width="12%" class="text-center"><?= __('Collections') ?></th>
                        <th><?= __('Log') ?></th>
                        <th class="text-center"><?= __('Date') ?></th>
                        <th><?= __('Added By') ?></th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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

<?php //debug($order); debug($shipping_methods);?>
