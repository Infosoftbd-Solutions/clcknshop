<div class="card">
    <div class="card-header d-print-none">
        <h3 class="card-title"><?= __('Packing Slip') ?></h3>
        <div class="card-options">
            <button type="button" class="btn btn-primary" onclick="javascript:window.frames['invoiceiframe'].print();"><i class="si si-printer"></i> <?= __('Print Packing Slip') ?>
            </button>
        </div>
    </div>
    <div class="card-body">
     <iframe id="invoiceiframe" name="invoiceiframe" src="<?=$this->Url->build(['action'=>'packing_slip',$order->order_id,$order->order_password])?>" style="height:50px;width:100%;border:none;overflow:hidden;" onload='javascript:(function(o){o.style.height=(o.contentWindow.document.body.scrollHeight + 50)+"px";}(this));' ></iframe>
    </div>
</div>

