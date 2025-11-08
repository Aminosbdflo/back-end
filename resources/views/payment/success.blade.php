<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Book Swap</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .success-container {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .success-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin: 1rem;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: white;
            font-size: 2rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
            display: inline-block;
            margin-top: 1rem;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Successful!</h1>
            <p class="text-lg text-gray-600 mb-6">Your payment for <strong>{{ $transaction->book->title }}</strong> has been processed successfully.</p>
            <p class="text-sm text-gray-500 mb-8">Transaction ID: <strong>{{ $transaction->id }}</strong></p>
            <div class="space-y-2 mb-8">
                <p><strong>Type:</strong> {{ ucfirst($transaction->type) }}</p>
                <p><strong>Amount:</strong> ${{ number_format($transaction->amount, 2) }}</p>
                <p><strong>Status:</strong> <span class="text-green-600 font-semibold">Completed</span></p>
            </div>
            <a href="{{ route('home') }}" class="btn-primary">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Back to Home
            </a>
        </div>
    </div>
</body>
</html>
