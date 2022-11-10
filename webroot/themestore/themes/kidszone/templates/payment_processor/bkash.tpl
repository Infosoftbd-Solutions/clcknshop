<style>
    .bkash {
        border: 4px solid #df146e;
    }

    .bkash h3 {
        text-align: center;
        padding-top: 7px;
        padding-bottom: 7px;
        background: #df146e;
        color: #fff;

    }
</style>

<div class="payment_Bkash payment_processor_div">
    <div class="bkash">
        <div class="bk-header">
            <div class="text-center pt-1 pb-1">
                <img src="https://clcknshop.com/img/bkash.png" alt="" height="80">
            </div>
            <h3>Bkash Instruction</h3>
            <div class="card-body">
                <ul>
                    <li><b>Step : 1</b> Dial *247#</li>
                    <li><b>Step : 2</b> Choose Option "Payment"</li>
                    <li><b>Step : 3</b> Enter Merchant Bkash Account No (01701020304)</li>
                    <li><b>Step : 4</b> Enter Amount {{Formats.moneySymbol()}} <span
                            class="pay_amout">{{order_total}}</span> (Not more or less)</li>
                    <li><b>Step : 5</b> Enter Reference (1)</li>
                    <li><b>Step : 6</b> Enter Counter No (1)</li>
                    <li><b>Step : 7</b> Enter Your PIN to Confirm Transaction (xxxx)</li>
                    <li><b>Step : 8</b> Enter Your Mobile Number and TrxID to complete your transaction</li>
                </ul>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="bkash_number">Bkash Number</label>
                            <input type="text" class="form-control" placeholder="Bkash Number" id="bkash_number"
                                name="bkash_number">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="bkash_transaction_number">Bkash Transaction ID</label>
                            <input type="text" class="form-control" placeholder="Bkash Transaction ID"
                                id="bkash_transaction_number" name="bkash_transaction_number">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>