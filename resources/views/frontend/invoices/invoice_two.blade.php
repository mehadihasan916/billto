
<style>

    .invoice-container {
        max-width: 794px;
        height: 1123px;
        margin: auto;
        padding: 20px;
    }

    .invoice-container .section-wrap {
        width: 100%;
        height: 100%;
        border-radius: 5px;
        border: 1px solid #ddd;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }






    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .company-info {
        text-align: left;
    }

    .invoice-number {
        text-align: right;
    }

    /* invoice form section  */



    .form-logo {
        width: 100px;
        height: 100px;
    }

    .form-logo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    .form-section {
        margin-bottom: 20px;
        font-family: solaimanlipi;
    }

    .form-section .first-td {
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 5px;
        vertical-align: top;
    }

    .form-section .second-td {
        padding: 10px;
        border: 1px solid #eee;
        vertical-align: top;
    }


    /* invoice form section end */

    .items-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .items-table th,
    .items-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .total {
        text-align: right;
        margin-bottom: 10px;
    }

    .instructions {
        margin-top: 20px;
        border: 1px solid #eee;
        padding: 10px;
    }


</style>
<div class="invoice-container a4-container ">
   <div  class="section-wrap position-relative " >
        <div >

            <div class="d-flex justify-content-between  py-2 overflow-hidden">
                <div class="col-4 d-flex  align-items-center ">
                    {{-- <div class="rounded-circle shadow p-2 me-2" style="width: 60px; height:60px ">
                         <img  style="width: 50px; height:50px "  src="https://www.svgrepo.com/show/530660/genetic-algorithm.svg" alt="Logo" >
                    </div> --}}
                    <div class="rounded-circle shadow p-2 me-2" style="width: 60px; height:60px; display: flex; justify-content: center; align-items: center;">
                        <img style="width: 50px; height:50px; object-fit: contain; max-width: 100%; max-height: 100%;" src="https://www.svgrepo.com/show/530660/genetic-algorithm.svg" alt="Logo" >
                    </div>
                    <strong>Ace Studio</strong>

                </div>
                <div class="col-8 d-flex align-items-center justify-content-end gap-5">
                    <div>
                        <span class="text-muted fw-bold">Invoice Number</span><br>
                        <span class="fw-bold">{{ $data->invoice_id }}</span>
                    </div>
                    <div>
                        <span class="text-muted fw-bold">Issued</span><br>
                        <span class="fw-bold">{{ $data->invoice_date }}</span>
                    </div>
                    <div>
                        <span class="text-muted fw-bold">Due Date</span><br>
                        <span class="fw-bold">{{ $data->invoice_dou_date }}</span>
                    </div>

                </div>
            </div>
        </div>


        <table class="form-section mt-3" width="100%" cellspacing="0" cellpadding="0" >

            <tr>
                <!-- From Address -->
                <td class="first-td" width="48%" style="">
                    <strong class="d-flex gap-1 p-1 shadow-sm rounded-3  justify-content-center" style="width: 70px">
                        <svg style="width: 15px; height: 15px " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5 12 3m0 0 7.5 7.5M12 3v18" />
                        </svg>

                        Form
                    </strong><br>

                    <div class="d-flex align-items-center mb-4">
                        <img class="p-2  rounded-circle shadow me-2" style="width: 40px; height:40px " src="https://www.svgrepo.com/show/530660/genetic-algorithm.svg" alt="Logo" class="logo">
                        <div>
                            <strong>Ace Studio</strong><br>
                            <span>atc@gmail.com</span>
                        </div>
                    </div>

                    <div class="d-flex gap-1 align-items-end mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; height: 30px" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>

                        <div>
                            {{-- <span class="text-muted">Address:</span> --}}
                            <p class="p-2 m-0 shadow-sm rounded-full fw-bold" style="border-radius:15px;">{{ $data->invoice_form }}</p>
                        </div>
                    </div>



                    <div class="d-flex gap-1 align-items-end mb-3">

                        <svg xmlns="http://www.w3.org/2000/svg"  style="width: 30px; height: 30px" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0 6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 0 1 4.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 0 0-.38 1.21 12.035 12.035 0 0 0 7.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 0 1 1.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 0 1-2.25 2.25h-2.25Z" />
                        </svg>


                        <div>
                            {{-- <span class="text-muted">PIO:</span> --}}
                            <p class="p-2 m-0 shadow-sm rounded-full fw-bold" style="border-radius:15px;">{{ $data->invoice_po_number }}</p>
                        </div>
                    </div>
                </td>

                <!-- Spacer column -->
                <td width="4%"></td>

                <!-- To Address -->
                <td  width="48%" class="second-td">
                        <strong class="d-flex gap-1 p-1 shadow-sm rounded-3 justify-content-center" style="width: 70px">

                        <svg style="width: 15px; height: 15px "  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
                        </svg>



                        To
                    </strong><br>

                    <div class="d-flex align-items-center mb-4">
                        <img class="p-2  rounded-circle shadow me-2" style="width: 40px; height:40px " src="https://www.svgrepo.com/show/530664/genetic-research.svg" alt="Logo" class="logo">
                        <div>
                            <strong>Ace Studio</strong><br>
                            <span>atc@gmail.com</span>
                        </div>
                    </div>

                    <div class="d-flex gap-1 align-items-end mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; height: 30px" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>

                        <div>
                            {{-- <span class="text-muted">Address:</span> --}}
                            <p class="p-2 m-0 shadow-sm rounded-full fw-bold" style="border-radius:15px;">{{ $data->invoice_to }}</p>
                        </div>
                    </div>



                    <div class="d-flex gap-1 align-items-end mb-3">

                        <svg xmlns="http://www.w3.org/2000/svg" style="width: 30px; height: 30px" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                        </svg>


                        <div>
                            {{-- <span class="text-muted">Tax Id:</span> --}}
                            <p class="p-2 m-0 shadow-sm rounded-full fw-bold" style="border-radius:15px;">93401RS</p>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        {{-- items  --}}
        <div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>QTY</th>
                        <th>Unit Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                        @forelse($productsDatas as $product_detail)
                            <tr>
                                <td> {{ $product_detail->product_name }}</td>
                                <td>{{ $product_detail->product_quantity }}</td>
                                <td class="text-end">{{ number_format($product_detail->product_rate, 2) }}</td>
                                <td class="text-end">{{ number_format($product_detail->product_amount, 2) }}</td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No products available</td>
                        </tr>
                         @endforelse
                </tbody>
            </table>
        </div>

        {{-- total  --}}
        <div class="total mt-5">
            <span class="font-monospace">Subtotal</span>: {{ number_format($no_vat = $data->subtotal_no_vat, 2) }}<br>
            <span class="font-monospace">Sales Tax ({{ number_format($percent = $data->invoice_tax_percent) }} %) </span>: {{ number_format(($no_vat * $percent) / 100, 2) }}<br>
            <span class="font-monospace">Discount Amount  ({{ $data->discount_percent }}%) </span>: {{ number_format($data->discount_amounts,2) }}<br>
            <span class="font-monospace">Receive Advance Amount ({{ $data->currency }}) </span> : {{ number_format($data->receive_advance_amount,2) }}<br>
            <span class="font-monospace">Requesting Advance Amount ({{ $data->requesting_advance_amount_percent }}%) </span> : {{ number_format(($data->final_total * $data->requesting_advance_amount_percent) / 100, 2) }}<br>
            <strong>Total: {{ $data->currency }} {{ number_format($data->final_total- $data->receive_advance_amount, 2) }}</strong>
        </div>


        <div>
            <strong> (Payable IN):</strong> Tether USDT (Tron)
        </div>

        <div class="instructions d-flex justify-content-between">
            <div>
                <strong>পেমেন্ট নির্দেশাবলী:</strong><br>
                নেটওয়ার্ক: Tron<br>
                ওয়ালেট: TY7MzheAre4bOcD6zEk14Q3PZ3PfJ4ybcs
            </div>
            <div class="">
                {{-- <img width="100px" height="auto" src="https://www.awesomesuite.com/sign/signature/barrack-obama2.webp" alt=""> --}}
                @if ($userLogoAndTerms->signature != '')
                    <div class="mx-auto ">
                        @if($data->invoice_signature=='signature_add')
                        <img src="{{ asset('uploads/signature/' . $userLogoAndTerms->signature) }}" alt=""
                            width="100px" height="auto" style="object-fit:contain;" />
                            <img width="100px" height="auto" src="{{ asset('uploads/signature/' . $userLogoAndTerms->signature) }}" alt="">
                            <p class="m-0"><strong>Signature</strong></p>
                        @endif
                    </div>

                @endif

            </div>

        </div>

        {{-- <div>
            <br>
            Powered by <strong>LuminaDev</strong>
        </div> --}}
        <div class="position-absolute bottom-0 start-50 translate-middle-x">
            <div class="pb-3">
                 Powered by <strong><a href="#" class="text-decoration-none text-dark">LuminaDev</a></strong>
            </div>
        </div>
    </div>
</div>
