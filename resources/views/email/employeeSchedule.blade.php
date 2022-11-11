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
        .slot {
            background: #033c61 !important;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px;
        }
        .clinic-name {
            padding-top: 5px;
        }
        .date {
            font-weight: 700;
            font-size: 18px;
        }
        .details {
            padding: 5px 0;
            margin: 5px 0;
            width: 40%;
            border: 1px solid white;
            border-radius: 10px;
        }
        .details span {
            padding: 5px 0;
        }
	</style>
</head>
<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
		<tr>
			<td align="center" style="padding:20px;">
				<img  style="width:300px" src="https://dev.aurorasw.com.au/aurora-logo.png"/>
			</td>
		</tr>
        <tr class="user">
            <td align="center" style="padding:20px;">
                <h3>Please note your published working schedule as bellow</h3>
            </td>
        </tr>
        @foreach($period as $day)
         <tr>
             <td align="center" style="padding:20px;">
                 <div class="slot">
                <span class="date">{{$day->format('Y-m-d')}}</span>
         @php ($isShiftFound = false)

             @foreach($user->hrmWeeklySchedule as $shift)
                @if($shift->date == $day->format('Y-m-d'))
                    @php ($isShiftFound = true)
                 <div class="details">
                     <span>{{$shift->start_time}} to </span>
                     <span>{{$shift->end_time}}</span>
                     <br/>
                     <span class="clinic-name">{{$shift->clinic_name}}</span>
                 </div>
                 @endif
             @endforeach
                     @if(!$isShiftFound)
                         <span>No allocated shifts are found</span>
                     @endif
                 </div>
                 </td>
         </tr>
        @endforeach
		<tr class="user">
			<td align="center" style="padding:20px;">
				footer
			</td>
		</tr>
	</table>
</body>
</html>
