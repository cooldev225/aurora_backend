<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Aurora API</title>
    <style>
        .pdf-iframe {
            width: 100%;
            height: 600px;
        }

        ul {
            list-style: none;
        }
    </style>
</head>

<body style="font-size: 1.5rem">
    <h2>Healthlink HL7 Parsing test</h2>
    <p>Filename : {{$file_name}}</p>
    <p>REF</p>
    <h3>MAH</h3>
    <ul>
        <li><strong> Seedning Application:</strong> {{ $msh['sending_application'] }}</li>
        <li><strong> Sending Facilty:</strong> {{ $msh['sending_facility'] }}</li>
        <li><strong> Receiving Application: </strong>{{ $msh['receiving_application'] }}</li>
        <li><strong> Receiving Facilty: </strong>{{ $msh['receiving_facility'] }}</li>
        <li><strong> Message Time: </strong>{{ $msh['message_time'] }}</li>
        <li><strong> Message Type: </strong>{{ $msh['message_type'] }}</li>
    </ul>

    <hr />
    <h3>RF1</h3>
    <ul>
        <li><strong> Referral Status:</strong> {{ $rf1['referral_status'] }}</li>
        <li><strong> Referral Priority:</strong> {{ $rf1['referral_priority'] }}</li>
        <li><strong> Referral Type: </strong>{{ $rf1['referral_type'] }}</li>
        <li><strong> Referral Disposition: </strong>{{ $rf1['referral_disposition'] }}</li>
        <li><strong> Referral Reason: </strong>{{ $rf1['referral_reason'] }}</li>

    </ul>
    <hr />
    <h3>Providers</h3>
    <ul>

        @foreach ($prds as $prd)
        <li><strong>Role:</strong> {{ $prd['provider_role'] }} <strong>Number:</strong> {{ $prd['provider_number'] }}</li>
        @endforeach

   
   
</ul>

<hr />
    <h3>Patient</h3>
    <ul>
        <li><strong> First Name:</strong> {{ $pid['patient_first_name'] }}</li>
        <li><strong> Last Name:</strong> {{ $pid['patient_last_name'] }}</li>
        <li><strong>  DOB: </strong>{{ $pid['patient_dob'] }}</li>
</ul>
<hr />
<h3>Patient</h3>
{!! $document_contents !!} <br />
</body>

</html>
