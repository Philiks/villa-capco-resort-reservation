<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
            body {
                size: a5;
                font-family: DejaVu Sans;
                font-size: small;
            }

            header {
                width: 100%;
                text-align: center;
                margin-top: 2rem;
            }

            table {
                border-collapse: collapse;
                margin-top: 5px;
            }

            caption, th {
                text-align: left;
                font-weight: bold;
            }

            .side-by-side-table {
                /* wrap the table in a <div>. 
                Since unfortunately inline-table is 
                not supported by the SnappyPdf. */
                display: inline-block;
                border: 2px solid #ce9e54;
                padding: 1rem;
                margin-top: 50px;
            }

            .accommodation-table {
                width: 100%;
                margin: 3rem 0rem;
            }

            .accommodation-table tr:first-child {
                background-color: #ce9e54;
            }

            .accommodation-table, .accommodation-table th, .accommodation-table td {
                border: 1px solid;
                padding: 5px 10px;
            }

            .accommodation-table tbody th {
                text-align: center;
                background-color: #b2b2b2;
            }

            .money-column {
                text-align: right;
            }

            .quantity-column {
                text-align: center;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <header>
            <img src="{{ 'file:///' . public_path('storage/images/villa_capco_logo.jpg') }}"
                alt="Villa Capco logo"
                width="150px" height="150px"
                style="border-radius: 100%;"/>
            <p style="font-weight: bold; font-size: medium; margin: 0;">Reservation Receipt</p>
            <p style="font-size: x-small; margin: 0;">Transaction no.: {{ $receipt['transaction_no'] }}</p>
        </header>

        <!-- Reservation Details -->
        <div class="side-by-side-table" style="margin-right: 4px;">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Reservation Details</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Scheduled for:</td>
                        <td>{{ $receipt['reserved_date'] }}</td>
                    </tr>

                    <tr>
                        <td>Schedule:</td>
                        <td>{{ $receipt['start_time'] }} - {{ $receipt['end_time'] }}</td>
                    </tr>

                    <tr>
                        <td>Payment Method:</td>
                        <td>{{ $receipt['mode_of_payment'] }}</td>
                    </tr>

                    <tr>
                        <td>No. of People:</td>
                        <td>{{ $receipt['no_of_people'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- User Details -->
        <div class="side-by-side-table">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">User Details</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>Name:</td>
                        <td>{{ $receipt['user_fullname'] }}</td>
                    </tr>

                    <tr>
                        <td>Contact No.:</td>
                        <td>{{ $receipt['user_contact_no'] }}</td>
                    </tr>

                    <tr>
                        <td>Email:</td>
                        <td>{{ $receipt['user_email'] }}</td>
                    </tr>

                    <tr>
                        <!-- Empty row to match the height of reservation details. -->
                        <td>&nbsp;<td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Accommodation Details -->
        <table class="accommodation-table">
            <thead>
                <tr>
                    <th colspan="4">Accommodation Details</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th>Item</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

                <tr>
                    <td>Accommodation:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <!-- &emsp; does not work. use padding instead. -->
                    <td style="padding-left: 30px">{{ $receipt['accommodation'] . '(' . $receipt['package'] . ')' }}</td>
                    <td class="money-column">&#8369; {{ number_format($receipt['rate'], 2) }}</td>
                    <!-- Accommodation always has one (1) quantity. -->
                    <td class="quantity-column">1</td>
                    <td class="money-column">&#8369; {{ number_format($receipt['rate'], 2) }}</td>
                </tr>

                <tr>
                    <td>Addons:</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                @forelse ($receipt['addons'] as $addon)
                    <tr>
                        <!-- &emsp; does not work. use padding instead. -->
                        <td style="padding-left: 30px">{{ $addon['name'] }}</td>
                        <td class="money-column">&#8369; {{ number_format($addon['rate'], 2) }}</td>
                        <td class="quantity-column">{{ $addon['quantity'] }}</td>
                        <td class="money-column">&#8369; {{ number_format($addon['subtotal'], 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <!-- &emsp; does not work. use padding instead. -->
                        <td style="padding-left: 30px">No addons</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforelse

                <tr>
                    <th colspan="3" style="text-align: right;">Total:</th>
                    <th style="text-align: right;">&#8369; {{ number_format($receipt['amount_to_pay'], 2) }}</th>
                </tr>
            </tbody>
        </table>

        <div style="text-align: center;">
            <img src="{{ 'file:///' . $receipt['qr_code_path'] }}"
                alt="{{ $receipt['transaction_no'] }} qr code"
                width="150px" height="150px"
                style="margin: 0"/>
            <div style="font-size: x-small;">Scan this redirect to your receipt.</div>
        <div>
    </body>
</html>
