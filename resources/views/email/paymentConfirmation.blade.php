<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="x-apple-disable-message-reformatting">
	<title></title>
	<!--[if mso]>
	<noscript>
		<xml>
            <o:OfficeDocumentSettings>
				<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
		</xml>
	</noscript>
	<![endif]-->
	<style>
		table, td, div, h1, p {font-family: Arial, sans-serif;}
		.user td {
			background: #3E7BA0 !important; 
			color: #ffffff;
			}
		.payment-info {
			text-align:center;
		}
		.payment-info p {
			font-size: 14px;
		}
		.payment-info div {
			margin-top: 30px;
		}
		.payment-info .payment-header {
			color:gray;
			text-transform:uppercase;
			font-weight:bold;
		}
		.payment-info .payment-data {
			margin:7px 0;
		}
	</style>
</head>
<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
		<tr>
			<td align="center" style="padding:20px;">
				<img style="width:300px" src="https://dev.aurorasw.com.au/aurora-logo.png"/>
			</td>
		</tr>
		<tr>
			<td class="payment-info">
				@if($payment->amount > 0)
					<h3>Thanks for your payment</h3>

					<p>Your payment has been received. Please find confirmation of the details below, and your invoice attached.</p>

					<div>
						<p class="payment-header">Payment Amount</p>
						<h3>${{ number_format($payment->amount / 100, 2) }}</h3>
					</div>
				@else
					<h3>Here's your refund</h3>

					<p>Please find confirmation of your refund below, and your invoice attached.</p>

					<div>
						<p class="payment-header">Refund Amount</p>
						<h3 style="color:green;">${{ number_format($payment->amount / 100, 2) }}</h3>
					</div>
				@endif

				<div>
					<p class="payment-header">Invoice Number</p>
					<h3>{{ $payment->full_invoice_number }}</h3>
				</div>

				<div>
					<p class="payment-header">Payment Date</p>
					<h3>{{ $payment->created_at->format('d-m-Y') }}</h3>
				</div>
			</td>
		</tr>
		<tr class="user">
			<td align="center" style="margin-top:30px;padding:20px;">
				footer
			</td>
		</tr>
	</table>
</body>
</html>