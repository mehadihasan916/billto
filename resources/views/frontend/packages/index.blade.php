@extends('layouts.frontend.app')
@section('title', 'Pricing Plans')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-12 text-center mb-5">
            <h1 class="display-4 fw-bold">Choose Your Plan</h1>
            <p class="lead text-muted">Select the perfect plan for your invoicing needs</p>
        </div>
    </div>

    <div class="row justify-content-center">
        @foreach($packages as $package)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm border-0">
                @if($package->packageName == 'Free Plan')
                    <div class="card-header bg-success text-white text-center py-3">
                        <h4 class="mb-0">{{ $package->packageName }}</h4>
                    </div>
                @else
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0">{{ $package->packageName }}</h4>
                    </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <div class="text-center mb-4">
                        <h2 class="display-6 fw-bold">
                            @if($package->price == '0')
                                £{{ $package->price }}
                            @else
                                ${{ $package->price }}
                            @endif
                            <small class="text-muted fs-6">/month</small>
                        </h2>
                    </div>

                    <ul class="list-unstyled mb-4">
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            {{ $package->templateQuantity }} Invoice Templates
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            Up to {{ $package->limitInvoiceGenerate }} invoices per month
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success me-2"></i>
                            @php
                                $duration = $package->packageDuration;
                                if ($duration == 30) {
                                    echo 'One Month Duration';
                                } elseif ($duration == 90) {
                                    echo 'Three Months Duration';
                                } elseif ($duration == 180) {
                                    echo 'Six Months Duration';
                                } elseif ($duration == 365) {
                                    echo 'One Year Duration';
                                }
                            @endphp
                        </li>
                    </ul>

                    @php
                        $pricingFeatures = DB::table('pricings')
                            ->where('subscription_package_id', $package->id)
                            ->get();
                    @endphp

                    @foreach($pricingFeatures as $feature)
                        <div class="mb-2">
                            @if($feature->logo == 'Success')
                                <i class="fas fa-check text-success me-2"></i>
                            @else
                                <i class="fas fa-times text-danger me-2"></i>
                            @endif
                            {{ $feature->description }}
                        </div>
                    @endforeach

                    <div class="mt-auto">
                        @if($package->price == '0')
                            <form action="{{ url('payment/store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $package->id }}">
                                <input type="hidden" name="package_price" value="{{ $package->price }}">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-rocket me-2"></i>Activate Free Plan
                                </button>
                            </form>
                        @else
                            <a href="{{ url('payment-gateway', $package->id) }}" class="btn btn-primary w-100">
                                <i class="fas fa-credit-card me-2"></i>Choose Plan
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3>Need Help Choosing?</h3>
            <p class="text-muted">Contact our support team for personalized recommendations</p>
            <a href="#" class="btn btn-outline-primary">Contact Support</a>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}

.card-header {
    border-bottom: none;
}

.btn {
    border-radius: 25px;
    padding: 12px 24px;
    font-weight: 600;
}

.display-6 {
    font-size: 2.5rem;
}
</style>
@endsection
