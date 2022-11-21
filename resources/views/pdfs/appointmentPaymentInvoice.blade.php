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
            font-size: 14px;
        }

        footer {
            position: absolute;
            bottom: 0px;
        }

        section {
            padding: 20px 40px 20px 40px;
        }

        .light {
            color: gray;
            font-size: small;
        }

        .heading {
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
    </style>
</head>

<body>
    <header>
        <img src="" style="width: 100%;">
    </header>
    <section>
        <h1 class="heading">Invoice</h1>

        <table style="width: 100%;">
            <tr>
                <td style="width: 50%; line-height: 1.3">
                    {{ $organization->name }}<br>
                    {{ $clinic->name }}<br>
                    {{ $clinic->address }}<br>
                    {{ $clinic->phone_number }}
                </td>
                <td style="width: 50%; text-align: right;">
                    <span class="heading">Date:</span> {{ $payment->created_at->format('d-m-Y') }}<br>
                    <span class="heading">Invoice No.:</span> {{ $payment->full_invoice_number }}
                </td>
            </tr>
        </table>
    </section>
    
    <section>
        <h5 class="heading" style="margin-bottom: 0; padding-bottom: 0;">Bill To</h5>

        <table style="width: 100%;">
            <tr>
                <td style="line-height: 1.3">
                    {{ $patient->full_name }}<br>
                    {{ $patient->email }}<br>
                </td>
            </tr>
        </table>
    </section>
    
    <section>
        <table class="item-table" style="width: 100%;" cellspacing="0">
            <tr>
                <th style="text-align: left;">
                    Item
                </th>
                <th>
                    Price
                </th>
            </tr>
            @foreach ($items as $item)
            <tr>
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
                        Appointment Total
                    </td>
                    <td>
                        ${{ number_format($total_cost / 100, 2) }}
                    </td>
                </tr>
                <tr>
                    <td class="info-header heading">
                        Paid to Date
                    </td>
                    <td>
                        ${{ number_format($total_paid / 100, 2) }}
                    </td>
                </tr>
                <tr>
                    <td class="info-header heading">
                        This Invoice
                    </td>
                    <td>
                        ${{ number_format($payment['amount'] / 100, 2) }}
                    </td>
                </tr>
                <tr>
                    <td class="info-header heading" style="border-bottom: 1px solid lightgray;">
                        Outstanding
                    </td>
                    <td style="border-bottom: 1px solid lightgray;">
                        ${{ number_format(($total_cost - $total_paid - $payment['amount']) / 100, 2) }}
                    </td>
                </tr>
            </table>
       </div>
    </section>

    <section>
        <p style="text-align: center; font-size: 12px;">ABN: {{ $organization->formatted_abn }}</p>
    </section>
    <footer>
        <img src="" style="width: 100%;">
    </footer>
</body>

</html>
