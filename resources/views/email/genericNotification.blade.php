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
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }

        .user td {
            background: #3E7BA0 !important;
            color: #ffffff;
        }
		img{
			width:300px;
		}
    </style>
</head>

<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:20px;">
                <img src="https://aurorasw.com.au/aurora-logo.png" />
            </td>
        </tr>
        <tr>
            <td align="center" style="padding:20px;">
                {!! $content !!}
            </td>
        </tr>
        <tr class="user">
            <td align="center" style="padding:20px;">
                footer
            </td>
        </tr>
    </table>
</body>

</html>
