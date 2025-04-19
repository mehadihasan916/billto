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
    @foreach ($invoice_template as $invoice_temp)
        @php
            $join_table_valu = DB::table('subscription_package_templates')
                ->join('subscription_packages', 'subscription_package_templates.subscriptionPackageId', '=', 'subscription_packages.id')
                ->where('subscription_package_templates.template', $invoice_temp->id)
                ->get();
            $join_table_value = $join_table_valu->unique('subscription_packages.id');
        @endphp
        @foreach ($join_table_value as $join_table_values)
            <label class="custom-radio  col-sm-6 col-md-4 col-lg-3 mb-4 ">
                <div class=" card shadow border-0">
                    <span class="pakages_name">
                        @if (Config::get('languages')[App::getLocale()]['flag-icon'] == 'bd')
                            {{ $join_table_values->packageNamebn }}
                        @else
                            {{ $join_table_values->packageName }}
                        @endif
                    </span>
                    <input type="radio" name="template_name" value="{{ $invoice_temp->id }}"
                        @if ($template_id_check->id == $invoice_temp->id) checked @else @endif />
                    <span class="radio-btn"> <i class="bi bi-check-lg"></i>
                        <div class="hobbies-icon tempResponsive">
                            <img src=" {{ asset('uploads/template/' . $invoice_temp->templateImage) }}" alt="">
                        </div>
                    </span>
                </div>
            </label>
        @endforeach
    @endforeach
@else
    @foreach ($invoice_template_not_com as $invoice_temp)
        @php
            $join_table_valu = DB::table('subscription_package_templates')
                ->join('subscription_packages', 'subscription_package_templates.subscriptionPackageId', '=', 'subscription_packages.id')
                ->where('subscription_package_templates.template', $invoice_temp->id)
                ->get();
            $join_table_value = $join_table_valu->unique('subscription_packages.id');
        @endphp
        @foreach ($join_table_value as $join_table_values)
            <label class="custom-radio  col-sm-6 col-md-4 col-lg-3 mb-4 ">
                <div class=" card shadow border-0">
                    <span class="pakages_name">
                        @if (Config::get('languages')[App::getLocale()]['flag-icon'] == 'bd')
                            {{ $join_table_values->packageNamebn }}
                        @else
                            {{ $join_table_values->packageName }}
                        @endif
                    </span>
                    <input type="radio" name="template_name" value="{{ $invoice_temp->id }}"
                        @if ($template_id_check->id == $invoice_temp->id) checked @else @endif />
                    <span class="radio-btn"> <i class="bi bi-check-lg"></i>
                        <div class="hobbies-icon tempResponsive">
                            <img src=" {{ asset('uploads/template/' . $invoice_temp->templateImage) }}" alt="">
                        </div>
                    </span>
                </div>
            </label>
        @endforeach
    @endforeach

@endif

