
 @if("1"==$invoiceData->template_name)
 @include('invoices.free.invoice_two')
 @elseif ("2"==$invoiceData->template_name)
 @include('invoices.free.invoice_one')
 @elseif ("3"==$invoiceData->template_name)
 @include('invoices.free.invoice_three')
 @elseif ("4"==$invoiceData->template_name)
 @include('invoices.free.invoice_four')
 @elseif ("5"==$invoiceData->template_name)
 @include('invoices.free.invoice_five')
 @elseif ("6"==$invoiceData->template_name)
 @include('invoices.free.invoice_six')
 @endif
