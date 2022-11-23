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
				<h3>Here's your invoice</h3>

				<p>Please find attached your invoice for your {{ $appointment->date }} appointment.</p>

				<div>
					<p class="payment-header">Invoice Number</p>
					<h3>{{ $invoice_number }}</h3>
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