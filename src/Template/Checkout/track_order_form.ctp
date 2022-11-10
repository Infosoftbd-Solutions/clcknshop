<?php
  $this->assign("layout","checkout");
?>
<div class="row">
    <div class="col col-login mx-auto">
        <div class="text-center">
            <?= $this->Flash->render() ?>
        </div>
        <div class="card">

            <form action="<?= $this->Url->build(['controller' => 'checkout', 'action' => 'trackOrder']) ?>" method="get">
            <div class="card-body p-6">
                <div class="card-title text-center">Track Your Order</div>
                <div class="form-group">
                    <label class="form-label">Order ID</label>
                    <input type="text" name="order_id" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your order ID">
                </div>
                <div class="form-group">
                    <label class="form-label">
                        Order Password
                    </label>
                    <input type="text" name="order_password" class="form-control" required id="exampleInputPassword1" placeholder="Enter your order password">
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Track Order</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
