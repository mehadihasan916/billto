<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Css -->
    <title>Invoice</title>
</head>

<body>
    <div class="invoice_page" size="A4">
        <div class="page">
            <div class="top_section d-flex">
                <div class="left_content col-8">
                    <h1 class="m-0">{!! Str::words($invoiceData->invoice_form, 4, '...') !!}</h1>
                    <br>
                    <pre>{{ $invoiceData->invoice_form }}</pre>
                </div>
                <div class="right_content col-4">
                    <div class="logo">
                        @if ($invoiceData->invoice_logo)
                        <img src="{{ asset('storage/invoice/logo/'.$invoiceData->invoice_logo) }}" alt="" width="150" class="img-fluid">
                        @else
                        <h1>NO LOGO</h1>
                        @endif
                    </div>
                    <div class="text">
                        <div class="date d-flex justify-content-between">
                            <span>Invoice:</span><span>{{ $invoiceData->invoice_id }}</span>
                        </div>
                        <div class="date d-flex justify-content-between">
                            <span>Due Date:</span><span>{{ $invoiceData->invoice_dou_date }}</span>
                        </div>
                        <div class="date d-flex justify-content-between">
                            <span>PO Number:</span><span>{{ $invoiceData->invoice_po_number }}</span>
                        </div>
                        <div class="date d-flex justify-content-between">
                            <span>Payment Terms:</span><span>{{ $invoiceData->invoice_payment_term }}</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="bill_to_area border-top mb-5">
                <div class="bill_to d-flex justify-content-between pt-2">
                    <p>Bill To :{{ $invoiceData->invoice_to }}</p>
                    <h4>Invoice Date: <span>{{ $invoiceData->invoice_date }}</span></h4>
                </div>
            </div>
            <table class="table table-striped border mb-0 custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="w_57">Description</th>
                        <th>Unite Price</th>
                        <th class="text-end">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productsDatas as $Key => $productsData)
                    <tr>
                        <th scope="row">{{ ++$Key }}</th>
                        <td>{{ $productsData->product_name }}</td>
                        <td>{{  $productsData->product_rate }}</td>
                        <td class="text-end">{{ $productsData->product_amount }} {{  $invoiceData->currency }}</td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
            <table class="table table-striped border-0 mb-0 border_bottom">
                <thead>
                    <tr>
                        <th></th>
                        <th class="w_57"></th>
                        <th>Due:</th>
                        <th class="text-end">{{ $due }} {{  $invoiceData->currency }}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th class="w_57"></th>
                        <th>Total:</th>
                        <th class="text-end">{{ $invoiceData->total }} {{  $invoiceData->currency }}</th>
                    </tr>
                </thead>
            </table>
            <div class="bottom_text">
                <div class="footer d-flex justify-content-between">
                    <div class="left_text">
                        <div class="one">
                            <h1>Thank You for your business</h1>
                            <p>
                                <span>Notes</span> <br>  @if ($invoiceData->invoice_notes)
                                <p>{{ Str::words($invoiceData->invoice_notes, 16, '...') }}</p>
                                @else
                                <p>NO NOTE</p>
                                @endif
                            </p>
                        </div>
                        <div class="two">
                            <p><span>Terms</span> <br> @if ($invoiceData->invoice_terms)
                                <p>{{ Str::words($invoiceData->invoice_terms, 16, '...') }}</p>
                                @else
                                    <p>ON TERM</p>
                                @endif</p>
                        </div>


                    </div>
                    <div class="right_image">
                        <img src="sign.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>
