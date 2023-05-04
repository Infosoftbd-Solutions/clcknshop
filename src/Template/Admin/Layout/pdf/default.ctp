<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<title><?=isset($order)?"Order-" . $order->order_id:"Report"?></title>

		<!-- Favicon -->
		<link rel="icon" href="./images/favicon.png" type="image/x-icon" />

		<!-- Invoice styling -->
		<style>
			body {
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				text-align: center;
				color: #777;
				background-color: #fff !important;
			}

			body h1 {
				font-weight: 300;
				margin-bottom: 0px;
				padding-bottom: 0px;
				color: #000;
			}
            body h2 {
				font-weight: 300;
				margin-top: 0px;
				margin-bottom: 0px;
				font-style: italic;
				color: #555;
			}
			body h3 {
				font-weight: 300;
				margin-top: 0px;
				margin-bottom: 0px;
				font-style: italic;
				color: #555;
			}

			body a {
				color: #06f;
			}

			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 13px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
				border-collapse: collapse;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:last-child {
				text-align: right;
			}
           
            .invoice-box table tr.top table tr {
                border-bottom: 2px solid #eee;
			}
			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-last-child(-n+2){
				border-top: 2px solid #eee;
				font-weight: bold;
                text-align:right;
			}

			.invoice-box tr.footer {
				border-top: 2px solid #eee;
				
			}
			.invoice-box table tr.footer td:last-child {
				text-align: center;
			}

			.invoice-box tr.footer table{
				 margin-left: auto;
  				margin-right: auto;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}
		</style>

		
	
	</head>

	<body>
<?= $this->fetch('content') ?>


<?php if(isset($_GET['domtoimg']) && $_GET['domtoimg'] == 1): ?>

<span data="" id="download-img"></span>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
<script>

    domtoimage.toJpeg(document.querySelector("body"), { quality: 0.95 })
        .then(function (dataUrl) {
            document.getElementById('download-img').setAttribute('data', dataUrl)
        });

</script>

<?php endif ?>

</body>
</html>