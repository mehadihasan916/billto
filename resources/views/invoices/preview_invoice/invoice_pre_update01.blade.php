<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            line-height: 24px;
        }


        .table-layout {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .title {
            font-size: 35px;
            color: #444;
            font-weight: bold;
        }

        .items-table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
        }

        .items-table th {
            background: #f5f5f5;
            border-bottom: 2px solid #ddd;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .total-section {
            margin-top: 20px;
            float: right;
            width: 30%;
        }

        .total-table td {
            padding: 5px;
            font-weight: bold;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table class="table-layout header-table">
            <tr>
                <td class="title">
                    <div style="width: 200px; height: 60px;">
                        <img src="{{ asset('storage/invoice/logo/' . $userLogoAndTerms->invoice_logo) }}" width="200"
                            height="55" style="display: block;" />
                    </div>
                </td>
                <td style="text-align: right;">
                    Invoice #: {{ $data->invoice_id }}<br>
                    Date: {{ $data->invoice_date }}<br>
                    Due: {{ $data->invoice_dou_date }}<br>
                    P.O: {{ $data->invoice_po_number }}
                </td>
            </tr>
        </table>

        <hr color="#eeeeee">

        <table class="table-layout header-table" style="margin-top: 20px;">
            <tr>
                <td style="width: 45%; vertical-align: top;">
                    <strong>Bill From:</strong><br>
                    {{ $data->invoice_form }}
                </td>

                <td style="width: 10%;"></td>

                <td style="width: 45%; text-align: right; vertical-align: top;">
                    <strong>Bill To:</strong><br>
                    {{ $data->invoice_to }}
                </td>
            </tr>
        </table>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productsDatas as $product_detail)
                    <tr>
                        <td>{{ $product_detail->product_name }}</td>
                        <td>{{ $product_detail->product_quantity }}</td>
                        <td>{{ number_format($product_detail->product_rate, 2) }}</td>
                        <td>{{ number_format($product_detail->product_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table-layout" style="margin-top: 20px;">
            <tr>
                <td width="70%"></td>
                <td width="50%">
                    <table class="total-table" style="width: 100%;">
                        <tr>
                            <td style="text-align: left;">Subtotal:</td>
                            <td style="text-align: right;">
                                {{ number_format($subtotal = $data->subtotal_no_vat, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Sales Tax :</td>
                            ({{ $tax = $data->invoice_tax_percent }}%)
                            <td style="text-align: right;">
                                {{ number_format($tax_value = ($subtotal * $tax) / 100, 2) }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Discount Amount
                                ({{ $tax = $data->discount_percent }}%):</td>
                            <td style="text-align: right;">
                                {{ number_format($data->discount_amounts, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Receive Advance Amount({{ $data->currency }}):</td>
                            <td style="text-align: right;">
                                {{ number_format($data->receive_advance_amount, 2) }}</td>
                        </tr>

                        <tr style="color: #000; font-size: 18px;">
                            <td style="text-align: left; border-top: 2px solid #333;">Total:</td>
                            <td style="text-align: right; border-top: 2px solid #333;">
                                {{ number_format($data->final_total - $data->receive_advance_amount, 2) }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div style="margin-top: 50px;">
            <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                <tr>
                    <td style="width: 50%; vertical-align: top; padding-right: 20px;">
                        <h4 style="margin-bottom: 10px; color: #333; font-size: 14px;">Terms & Conditions</h4>
                        <ul style="font-size: 11px; color: #555; padding-left: 15px; margin: 0;">
                            <p style="">{{ $userLogoAndTerms->terms }}</p> <br>
                            <p>{{ $data->invoice_notes }}</p>
                        </ul>
                    </td>

                    <td style="width: 50%; vertical-align: bottom; text-align: right;">
                        <div style="display: inline-block; text-align: center; width: 200px;">
                            <div>
                                <img src="{{ asset('uploads/signature/' . $userLogoAndTerms->signature) }}"
                                    alt="img" style="width: 100px; height:100px;">
                            </div>
                            <div style="border-top: 1px solid #333; margin-top: 10px; padding-top: 5px;">
                                <p style="font-size: 13px; font-weight: bold; margin: 0;">Authorized Signature</p>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer">
            Thank you for your business! <br>
            This is a computer generated document No Physical Signature Needed
        </div>
    </div>
</body>

</html>
