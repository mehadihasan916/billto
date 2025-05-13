@extends('layouts.frontend.app')
@section('title', 'Payment Success')
@push('frontend_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<style>
    :root {
        --primary-color: #6366f1;
        --success-color: #10b981;
    }

    body {
        background-color: #f8fafc;
        font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
    }

    .success-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .success-header {
        background: linear-gradient(135deg, var(--primary-color), #4f46e5);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .checkmark-circle {
        width: 80px;
        height: 80px;
        background-color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .checkmark {
        color: var(--success-color);
        font-size: 3rem;
    }

    .order-details {
        padding: 2rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }

    .btn-return {
        background: var(--primary-color);
        border: none;
        padding: 0.75rem 2rem;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-return:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        background-color: var(--success-color);
        opacity: 0;
    }
</style>
@endpush
@section('frontend_content')


    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="success-card animate__animated animate__fadeInUp">
                    <div class="success-header">
                        <div class="checkmark-circle animate__animated animate__bounceIn">
                            <i class="bi bi-check2-all checkmark animate__animated animate__tada"></i>

                        </div>
                        <h2 class="fw-bold mb-3 ">Payment Successful!</h2>
                        <p class="mb-0 text-white">Thank you for your purchase</p>
                    </div>

                    <div class="order-details">
                        <h5 class="fw-bold mb-4">Order Details</h5>
                        <h2>Payment Successful</h2>


                        <div class="detail-item">
                            <span>Order Number</span>
                            <span class="fw-bold">#{{ $record->order_id ?? '' }}</span>
                        </div>

                        <div class="detail-item">
                            <span>Date</span>
                            <span class="fw-bold">{{ $record->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="detail-item">
                            <span>Amount Paid</span>
                            <span class="fw-bold">${{ $package_price }} USD</span>
                        </div>

                        <div class="detail-item">
                            <span>Payment Method</span>
                            <span class="fw-bold">Credit Card</span>
                        </div>

                        <div class="detail-item border-0">
                            <span>Status</span>
                            <span class="badge bg-success">Completed</span>
                        </div>

                        <div class="text-center mt-4 pt-3">
                            <a href="/" class="btn btn-return btn-lg rounded-pill text-white">
                                <i class="bi bi-house me-2"></i>Return to Home
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted">
                        Need help? <a href="#" class="text-decoration-none">Contact support</a>
                    </p>
                    <div class="d-flex justify-content-center gap-3 mt-2">
                        <a href="#" class="text-primary"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-primary"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-primary"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
@push('frontend_js')

    <!-- Confetti animation -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Making a confetti container
            const confettiContainer = document.createElement('div');
            confettiContainer.style.position = 'fixed';
            confettiContainer.style.top = '0';
            confettiContainer.style.left = '0';
            confettiContainer.style.width = '100%';
            confettiContainer.style.height = '100%';
            confettiContainer.style.pointerEvents = 'none';
            confettiContainer.style.overflow = 'hidden';
            confettiContainer.style.zIndex = '9999';
            document.body.appendChild(confettiContainer);

            // 2. Confetti making and throwing function
            function createConfetti() {
                const confetti = document.createElement('div');
                confetti.style.position = 'absolute';
                confetti.style.width = (8 + Math.random() * 8) + 'px';
                confetti.style.height = confetti.style.width;
                confetti.style.backgroundColor = `hsl(${Math.random() * 360}, 100%, 50%)`;
                confetti.style.borderRadius = '50%';
                confetti.style.left = (Math.random() * 100) + '%';
                confetti.style.top = '-20px';
                confettiContainer.appendChild(confetti);

                // 3. Animation (for 5 seconds)
                const animation = confetti.animate([
                    { top: '-20px', opacity: 1, transform: 'rotate(0deg)' },
                    { top: '100vh', opacity: 0, transform: 'rotate(360deg)' }
                ], {
                    duration: 5000, // 5 seconds
                    easing: 'cubic-bezier(0.1, 0.8, 0.3, 1)'
                });

                // 4. Delete the confetti when the animation ends.
                animation.onfinish = () => confetti.remove();
            }

            // 5. Create new confetti every 100 milliseconds (for 5 seconds)
            const interval = setInterval(createConfetti, 10);

            // 6. Animation stops after 5 seconds
            setTimeout(() => {
                clearInterval(interval);
                setTimeout(() => confettiContainer.remove(), 5000); // Time to read the last confetti
            }, 5000);
        });
        </script>

@endpush


