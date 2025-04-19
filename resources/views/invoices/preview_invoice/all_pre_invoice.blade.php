
@if("1"== $data->template_name)
@include('invoices.preview_invoice.invoice_pre_two')
{{-- @include('invoices.preview_invoice.invoice_pre_four') --}}
{{-- @include('invoices.preview_invoice.invoice_pre_one') --}}
{{-- @include('invoices.preview_invoice.invoice_pre_three') --}}
@elseif("2"== $data->template_name)
@include('invoices.preview_invoice.invoice_pre_wid')
@elseif("3"== $data->template_name)
@include('invoices.preview_invoice.invoice_pre_three')

@endif


