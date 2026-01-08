{{-- @if ('1' == $invoiceData->template_name)
    @include('invoices.free.invoice_two') --}}
{{-- @include('frontend.invoices.invoice_two') --}}

{{-- @elseif ("2"==$invoiceData->template_name)
    @include('invoices.free.invoice_wid') --}}
{{-- @include('invoices.preview_invoice.invoice_pre_wid') --}}
{{-- @elseif ("3"==$invoiceData->template_name)
    @include('invoices.free.invoice_three')
 @elseif ("4"==$invoiceData->template_name)
    @include('invoices.free.invoice_four')
 @elseif ("5"==$invoiceData->template_name)
    @include('invoices.free.invoice_five')
 @elseif ("6"==$invoiceData->template_name)
    @include('invoices.free.invoice_six')
 @endif --}}




@if ('1' == $invoiceData->template_name)
    @include('invoices.free.invoice_one')
@elseif ('2' == $invoiceData->template_name)
    @include('invoices.free.invoice_two')
@elseif ('3' == $invoiceData->template_name)
    @include('invoices.free.invoice_wid')
@elseif ('4' == $invoiceData->template_name)
    {{-- @include('invoices.free.invoice_four') --}}
    @include('invoices.free.invoice_update01')
@endif

{{-- 3,4,5,6 thik download version thik nai  --}}
