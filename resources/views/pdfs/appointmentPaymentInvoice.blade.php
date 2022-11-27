<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style>
        html,
        body {
            margin: 0px;
            height: 100%;
            font-family: Arial, Helvetica, sans-serif, sans-serif;
            font-size: 13px;
        }

        footer {
            position: absolute;
            bottom: 0px;
        }

        section {
            padding: 15px 40px;
        }

        .light {
            color: gray;
            font-size: small;
        }

        .heading {
            font-weight: bold;
            color: #494949;
        }

        .gray-heading {
            font-weight: bold;
            color: gray;
            text-transform: uppercase;
        }

        .summary-table {
            margin-left: auto;
            right: 0;
        }

        .summary-table td {
            padding: 8px;
            text-align: right;
            border-top: 1px solid lightgray;
        }
        
        .summary-table .info-header {
            font-size: 13px;
        }

        .item-table th, .item-table td {
            padding: 7px;
            border: 1px solid #1d1d1d;
        }

        .item-table th {
            background-color: lightgray;
        }

        .payment-table th, .payment-table td {
            padding: 7px;
            border-top: 1px solid #aaa;
            border-bottom: 1px solid #aaa;
            text-align: center;
        }

        .payment-table th {
            border-top: 0;
        }
    </style>
</head>

<body>
    <header>
        <img src="" style="width: 100%;">
    </header>
    <section>
        <h1 class="gray-heading">Invoice #{{ $full_invoice_number }}</h1>

        <table style="width: 100%;">
            <tr>
                <td style="width: 50%; line-height: 1.5">
                    @if ($bill_from === 'CLINIC')
                        {{ $organization->name }}<br>
                        Provider Number: {{ $clinic->hospital_provider_number }}<br><br>
                    @elseif ($bill_from === 'SPECIALIST')
                        {{ $appointment->specialist_name }}<br>
                        Provider Number: {{ $provider_number }}<br><br>
                    @endif
                    {{ $clinic->name }}<br>
                    {{ $clinic->address }}<br>
                    <span class="heading" style="font-size: 13px;">Phone:</span> {{ $clinic->phone_number }}<br>
                    <span class="heading" style="font-size: 13px;">Fax:</span> {{ $clinic->fax_number }}<br>
                </td>
                <td style="width:50%;text-align:right;vertical-align:bottom;">
                    <h4 class="gray-heading" style="margin-bottom: 0; padding-bottom: 0;">Bill To</h4>

                    <div style="line-height: 1.5">
                        {{ $patient->full_name }}<br>
                        {{ $patient->address }}<br>
                        {{ $patient->suburb }} {{ $patient->postcode }}<br>
                        {{ $patient->email }}<br>
                    </div>
                </td>
            </tr>
        </table>
    </section>
    
    <section>
        <h4 class="gray-heading" style="margin-bottom: 0; padding-bottom: 0;">Appointment Details</h4>

        <table style="width: 100%;">
            <tr>
                <td style="line-height:1.5;padding-right:10px;">
                    <span class="heading" style="font-size: 13px;">Patient:</span> {{ $patient->full_name }}<br>
                    <span class="heading" style="font-size: 13px;">DOB:</span> {{ $patient->date_of_birth }}<br>
                    <span class="heading" style="font-size: 13px;">Medicare:</span> {{ $medicare_card ? $medicare_card->member_number . $medicare_card->member_reference_number : 'N/A' }}<br>
                    <span class="heading" style="font-size: 13px;">Hospital:</span> {{ $clinic->name }}<br>
                </td>

                <td style="line-height:1.5;padding-left:10px;">
                    <span class="heading" style="font-size: 13px;">Specialist:</span> {{ $appointment->specialist_name }}<br>
                    <span class="heading" style="font-size: 13px;">Referred By:</span> {{ $referral->doctor_address_book_name }}<br>
                    <span class="heading" style="font-size: 13px;">Referral Date:</span> {{ $referral->referral_date }}<br>
                    <span class="heading" style="font-size: 13px;">Appointment Date:</span> {{ $appointment->date }}<br>
                </td>
            </tr>
        </table>
    </section>
    
    <section>
        <table class="item-table" style="width: 100%;" cellspacing="0">
            <tr>
                <th>
                    Date
                </th>
                <th style="text-align: left;">
                    Item
                </th>
                <th>
                    Price
                </th>
            </tr>
            @foreach ($items as $item)
            <tr>
                <td style="text-align: center;">
                    {{ Carbon\Carbon::create($appointment->date)->format('j F Y') }}
                </td>
                <td>
                    {{ $item['label_name'] }}
                </td>
                <td style="text-align: right;">
                    ${{ number_format($item['price'] / 100, 2) }}
                </td>
            </tr>
            @endforeach
        </table>
    </section>
    
    <section>
       <div style="width: 100%;">
            <table class="summary-table" cellspacing="0">
                <tr>
                    <td class="info-header heading">
                        Total Fee
                    </td>
                    <td>
                        ${{ number_format($total_cost / 100, 2) }}
                    </td>
                </tr>
                @if ($total_paid > 0)
                    <tr>
                        <td class="info-header heading">
                            Paid to Date
                        </td>
                        <td>
                            ${{ number_format($total_paid / 100, 2) }}
                        </td>
                    </tr>
                @endif
                @if (isset($payment))
                    <tr>
                        <td class="info-header heading">
                            This Payment
                        </td>
                        <td {!! $payment->amount < 0 ? 'style="color:red;"' : '' !!}>
                            ${{ number_format($payment['amount'] / 100, 2) }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <td class="info-header heading" style="border-bottom: 1px solid lightgray;">
                        Balance Due
                    </td>
                    
                    @if (isset($payment))
                        <td style="border-bottom: 1px solid lightgray;">
                            ${{ number_format(($total_cost - $total_paid - $payment['amount']) / 100, 2) }}
                        </td>
                    @else
                        <td style="border-bottom: 1px solid lightgray;">
                            ${{ number_format(($total_cost - $total_paid) / 100, 2) }}
                        </td>
                    @endif
                </tr>
            </table>
       </div>
    </section>
    
    <section>
        <h4 class="gray-heading" style="text-align:center;">Payment Information</h4>

        <table class="payment-table" style="width: 100%;" cellspacing="0">
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Type
                </th>
                <th>
                    Payer
                </th>
                <th>
                    Amount
                </th>
            </tr>
            @foreach ($payments as $pay)
            <tr>
                <td {!! isset($payment) && $pay->id === $payment->id ? 'style="background-color:#ddd;font-weight:bold;"' : '' !!}>
                    {{ Carbon\Carbon::create($pay->created_at)->format('j F Y') }}
                </td>
                <td {!! isset($payment) && $pay->id === $payment->id ? 'style="background-color:#ddd;font-weight:bold;"' : '' !!}>
                    {{ $pay->amount < 0 ? 'REFUND' : $pay->payment_type }}
                </td>
                <td {!! isset($payment) && $pay->id === $payment->id ? 'style="background-color:#ddd;font-weight:bold;"' : '' !!}>
                    Patient
                </td>
                <td {!! isset($payment) && $pay->id === $payment->id ? 'style="background-color:#ddd;font-weight:bold;"' : '' !!}>
                    <span {!! $pay->amount < 0 ? 'style="color:red;"' : '' !!}>${{ number_format($pay->amount / 100, 2) }}</span>
                </td>
            </tr>
            @endforeach
        </table>
    </section>

    <section>
        @if ($bill_from === 'CLINIC')
            <p style="text-align: center; font-size: 12px;">
                {{ strlen($organization->abn_acn) === 9 ? 'ACN:' : 'ABN:' }} {{ $organization->formatted_abn_acn }}
            </p>
        @else
            <p style="text-align: center; font-size: 12px;">
                {{ strlen($specialist->abn_acn) === 9 ? 'ACN:' : 'ABN:' }} {{ $specialist->formatted_abn_acn }}
            </p>
        @endif
    </section>
    <footer>
        <img src="" style="width: 100%;">
    </footer>
</body>

</html>
