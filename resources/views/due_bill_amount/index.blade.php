<style>
    .text_color_alert{
        color: #686868;
    }
</style>
<div class="row">
    <div class="col-sm-7">
        <div class="row">
            <div class="col-sm-12">
                <table class="table p-0 m-0 w-100">

                    <tr>
                        <td class=" border-0 p-1 m-0" style="width: 60%">
                            <strong class="text_color_alert">{{ __('messages.Total_Amount') }}:</strong>
                        </td>
                        <td class="p-1 m-0 border-0 " >
                            <strong class="text_color_alert">{{number_format($data->final_total,2) }} </strong>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12">
                <table class="table p-0 m-0">
                    <tr>
                        <td class="border-0 p-1 m-0" style="width: 60%">
                            <strong class="text_color_alert">{{ __('messages.Received_Amount') }} :</strong>
                        </td>
                        <td class=" border-0 p-1 m-0" >
                            <strong class="text_color_alert">{{ number_format($data->receive_advance_amount,2) }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12">
                <table class="table p-0 m-0">
                    <tr>
                        <td class="border-0 p-1 m-0" style="width: 60%">
                            <strong class="text_color_alert"> {{ __('messages.Due_Amount') }} :</strong>
                        </td>
                        <td class=" border-0 p-1 m-0">
                            <strong class="text_color_alert">{{ number_format($data->balanceDue_amounts,2) }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12">
                <table class="table p-0 m-0">
                    <tr>
                        <td class="border-0 p-1 m-0" style="width: 60%">
                            <strong class="text_color_alert">{{ __('messages.Due_Date') }} :</strong>
                        </td>
                        <td class=" border-0 p-1 m-0">
                            <strong class="text_color_alert">{{ $data->invoice_dou_date }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <input type="hidden" name="total_amount"  value="{{ $data->final_total }}">
        <input type="hidden" name="old_recived_amount" id="old_recived_amount" value="{{ $data->receive_advance_amount }}">
        <input type="hidden" name="balanceDue_amounts_user" id="balanceDue_amounts_user" value="{{ $data->balanceDue_amounts }}">
        <input type="hidden" name="invoice_user_id" id="invoice_user_id"value="{{ $data->user_id }}">
        <input type="hidden" name="invoice_id" id="invoice_id" value="{{ $data->id }}">
        <div class="mb-2 mt-sm-0 mt-3">
         <strong class="mb-2 text-black">{{ __('messages.Payment_Date') }}</strong>

        <input class="form-control form-control-sm" id="date_id" type="date" name="date_id" >
        </div>
        <div class="mb-1">
            <strong class="mb-2 text-black">{{ __('messages.Payment_Amount') }}</strong>
            <input class="form-control form-control-sm" id="amount_id" type="number" name="amount_id" readonly min="1">
            <small id="message_error" class="d-none text-danger"> Please check due amount</small>
        </div>
    </div>
</div>

