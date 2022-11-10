
		
		<div class="invoice-box">
			<table>
            <tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td >
									<h1><?=$store->title?></h1>
								</td>

								<td >
								<h2>Invoice</h2>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td >
                                <?= $this->Formats->barcode($order->order_id) ?>
								</td>

								<td >
									Invoice #: <?=$order->order_id?><br />
									Created: <?=$order->order_date?><br />
									Due: <?=$this->Formats->moneyFormat($order->due,false)?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="information">
					<td colspan="2">
						<table>
							<tr>
								<td>
                                    <strong>Pay To:</strong><br />
									<?=$store->title?><br />
									<?= $store->address ?>,<?= $store->area ?><br />
									<?= $store->city ?>-<?= $store->post_code ?>, <?= $store->country ?><br />
									<?= $store->phone ?>
								</td>

								<td >
                                   <strong>Invoice To:</strong><br />
									<?= $customer->first_name . " " . $customer->last_name ?> </br>
						            <?= $customer->address ?>,
						            <?= $customer->area ?></br>
						            <?= $customer->city ?>-
						            <?= $customer->post_code ?>,
						            <?= $customer->country?> </br>
						            <?= $customer->phone ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>

			

			
			</table>
            <table>
            <tr class="heading">
                    <td>Sl.</td>
					<td>Item</td>
                    <td>Qty.</td>    
                    <td>Unit</td>
					<td >Price</td>
				</tr>
                <?php foreach ($order->order_products as $key=>$product): ?>
				<tr class="item <?=(++$key  == sizeof($order->order_products))?'last':''?>">
                    <td><?= $key ?> </td>
					<td><?=  $product->product_title ?><br />
                        <?php if(!empty($product->product_options)): ?>
                        <?= $product->product_options ?> <br>
                         <?php endif; ?>
                        <em>Sku: <?= $product->product_sku ?></em> 
                    </td>
                    <td><?= $product->product_quantity ?></td>    
                    <td><?= $this->Formats->moneyFormat($product->product_price) ?></td>
					<td ><?= $this->Formats->moneyFormat($product->product_price * $product->product_quantity) ?></td>
				</tr>
                <?php endforeach; ?>
			

				<tr class="total">
                <td></td>
					<td ></td>
                    <td></td>    
                    <td >Subtotal:</td>
					<td><?=$this->Formats->moneyFormat($order->sub_total)?></td>
				</tr>
                <tr class="total">
                <td></td>
					<td ></td>
                    <td></td>    
                    <td >Discount:</td>
                    <td><?=$this->Formats->moneyFormat($order->discount,false)?></td>
				</tr>
                <tr class="total">
                <td></td>
					<td ></td>
                    <td></td>    
                    <td >Tax:</td>
                    <td><?=$this->Formats->moneyFormat($order->tax,false)?></td>
				</tr>
                <tr class="total">
                <td></td>
					<td ></td>
                    <td></td>    
                    <td >Shipping Fee:</td>
					<td><?=$this->Formats->moneyFormat($order->shipping_fee,false)?></td>
				</tr>
                <tr class="total">
                <td></td>
					<td ></td>
                    <td></td>    
                    <td >Amount Due:</td>
					<td><?=$this->Formats->moneyFormat($order->due,false)?></td>
				</tr>
            </table>
		</div>
	


