<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
    </head>
    <body class="font-sans antialiased">
        <table>
            <thead>
                <tr>
                    <th>{{ $receipt['transaction_no'] }}</th>
                    <th><img src="{{ $receipt['qr_code_path'] }}" alt="{{ $receipt['transaction_no'] }} qr code"/></th>
                </tr>
            </thead>
            <!-- TODO: beautify -->
            <tbody>
                <!-- User Information -->
                <tr>
                    <th>User Information</th>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td>{{ $receipt['user_fullname'] }}</td>
                </tr>
                <tr>
                    <td>Contact No.:</td>
                    <td>{{ $receipt['user_contact_no'] }}</td>
                    <td>Email:</td>
                    <td>{{ $receipt['user_email'] }}</td>
                </tr>

                <!-- Reservation Details -->
                <tr>
                    <th>Reservation Details</th>
                </tr>
                <tr>
                    <td>Number of people:</td>
                    <td>{{ $receipt['no_of_people'] }}</td>
                    <td>From:</td>
                    <td>{{ $receipt['start_time'] }}</td>
                </tr>
                <tr>
                    <td>To:</td>
                    <td>{{ $receipt['end_time'] }}</td>
                    <td>Reserved for:</td>
                    <td>{{ $receipt['reserved_date'] }}</td>
                    <td>Mode of payment:</td>
                    <td>{{ $receipt['mode_of_payment'] }}</td>
                </tr>

                <!-- Accommodation Details -->
                <tr>
                    <th>Accommodation Details</th>
                </tr>
                <tr>
                    <th>Item</th>
                    <th>Rate</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <tr>
                    <td>Accommodation:</td>
                </tr>
                <tr>
                    <td>&emsp;{{ $receipt['accommodation'] }} ({{ $receipt['package']}})</td>
                    <td>{{ $receipt['rate'] }}</td>
                    <!-- Accommodation always has one (1) quantity. -->
                    <td>1</td>
                    <td>{{ $receipt['rate'] }}</td>
                </tr>

                @if ($receipt['addons'])
                    <tr>Addons:</tr>
                    @foreach ($receipt['addons'] as $addon)
                        <tr>
                            <td>&emsp;{{ $addon['name'] }}</td>
                            <td>{{ $addon['rate'] }}</td>
                            <td>{{ $addon['quantity'] }}</td>
                            <td>{{ $addon['subtotal'] }}</td>
                        </tr>
                    @endforeach
                @endif

                <tr>
                    <th>Total:</th>
                    <td>{{ $receipt['amount_to_pay'] }}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
