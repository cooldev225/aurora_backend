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

        
    </style>
</head>

<body style="font-size: 1.5rem">
    <h2>HL7 Parsing test</h2>
    <strong>FILENAME: </strong> {{ $file_name }}
    <table style="width: 100%">
        <tr>
            <td>
                <h3>Patient</h3>
                First name: {{ $patient_first_name }} <br />
                Last name: {{ $patient_last_name }} <br />
                DOB: {{ $patient_date_of_birth }} <br />
            </td>
            <td>
                <h3>Sender Information</h3>
                Sending Application: {{ $message_sending_application }} <br />
                Sending Facility EDI: {{ $message_sending_facility_edi }} <br />
                Sending Facility Name: {{ $message_sending_facility_name }} <br />
                Reffering Doctor: {{ $doctor_address_book_provider }}
            </td>
            <td>
                <h3>Receiver Information</h3>
                Receiving Application: {{ $message_receiving_application }} <br />
                Receiving Facility EDI: {{ $message_receiving_facility_edi }} <br />
                Receiving Facility Name: {{ $message_receiving_facility_name }} <br />
                Receiving Doctor: {{ $receiving_doctor_provider }}
            </td>
        </tr>
        <table>

            <h3>Document Contents</h3>

            {!! $data_content !!} <br />








</body>

</html>
