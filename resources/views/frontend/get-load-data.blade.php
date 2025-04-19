@php
    use App\Models\User;
    $test = null;
    if (auth()->check()) {
        $test = User::where('email', Auth::user()->email)
            ->where('email', 'womenindigitalbd@gmail.com')
            ->first();
    }
@endphp

@if ($test)
    @php
        $count = 0;
    @endphp
    @foreach ($invoice_template as $invoice_temp)
        @php
            $join_table_valu = DB::table('subscription_package_templates')
                ->join('subscription_packages', 'subscription_package_templates.subscriptionPackageId', '=', 'subscription_packages.id')
                ->where('subscription_package_templates.template', $invoice_temp->id)
                ->get();
            $join_table_value = $join_table_valu->unique('subscription_packages.id');
        @endphp
        @foreach ($join_table_value as $join_table_values)
            <div class="col-sm-4 col-lg-3  tamplate_show_A">
                <div class="card shadow">
                    <span class="pakages_name">
                        {{ $join_table_values->packageName }}
                    </span>
                    <a href="{{ url('home/invoice/page/' . $invoice_temp->id) }}">
                        <div class="tamplate_show_home">
                            <img src="{{ asset('uploads/template/' . $invoice_temp->templateImage) }}" alt=""
                                style="border: 1px solid #ccc;">
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
        @php
            $count++;
        @endphp
    @endforeach
    @if ($count > 1)
        <div class="load-more-template text-center">
            <button class="btn btn-warning" data-id={{ $invoice_temp->id }} id="loadMoreBotton">
                {{ __('messages.more_template') }} </button>
        </div>
    @endif
@else

    @php
        $count = 0;
    @endphp
    @foreach ($invoice_template_not_com as $invoice_temp)
        @php
            $join_table_valu = DB::table('subscription_package_templates')
                ->join('subscription_packages', 'subscription_package_templates.subscriptionPackageId', '=', 'subscription_packages.id')
                ->where('subscription_package_templates.template', $invoice_temp->id)
                ->get();
            $join_table_value = $join_table_valu->unique('subscription_packages.id');
        @endphp
        @foreach ($join_table_value as $join_table_values)
            <div class="col-sm-4 col-lg-3  tamplate_show_A">
                <div class="card shadow">
                    <span class="pakages_name">
                        {{ $join_table_values->packageName }}
                    </span>
                    <a href="{{ url('home/invoice/page/' . $invoice_temp->id) }}">
                        <div class="tamplate_show_home">
                            <img src="{{ asset('uploads/template/' . $invoice_temp->templateImage) }}" alt=""
                                style="border: 1px solid #ccc;">
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
        @php
            $count++;
        @endphp
    @endforeach
    @if ($count > 1)
        <div class="load-more-template text-center">
            <button class="btn btn-warning" data-id={{ $invoice_temp->id }} id="loadMoreBotton">
                {{ __('messages.more_template') }} </button>
        </div>
    @endif
@endif
