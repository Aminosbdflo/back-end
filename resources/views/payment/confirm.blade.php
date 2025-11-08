<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Confirm Payment - {{ $book->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .book-image-animation {
            animation: fadeInLeft 0.8s ease-out;
        }

        .book-details-animation {
            animation: fadeInRight 0.8s ease-out 0.2s backwards;
        }

        .detail-item {
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .detail-item:nth-child(1) { animation-delay: 0.3s; }
        .detail-item:nth-child(2) { animation-delay: 0.4s; }
        .detail-item:nth-child(3) { animation-delay: 0.5s; }
        .detail-item:nth-child(4) { animation-delay: 0.6s; }

        .tag-item {
            animation: scaleIn 0.5s ease-out backwards;
        }

        .tag-item:nth-child(1) { animation-delay: 0.4s; }
        .tag-item:nth-child(2) { animation-delay: 0.5s; }
        .tag-item:nth-child(3) { animation-delay: 0.6s; }

        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .book-card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .book-card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .shimmer {
            position: relative;
            overflow: hidden;
        }

        .shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            100% {
                left: 100%;
            }
        }

        .pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
            }
            50% {
                box-shadow: 0 0 40px rgba(59, 130, 246, 0.8);
            }
        }

        .payment-summary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .paypal-button {
            background: #0070ba;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .paypal-button:hover {
            background: #005ea6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 112, 186, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen flex flex-col">
    <div id="smooth-wrapper">
        <div id="smooth-content">

    <!-- Enhanced Header -->
    <header class="bg-white shadow-md border-b border-blue-200 sticky top-0 z-50 glass-effect">
        <div class="w-full lg:max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (Route::has('login'))
                <div class="flex items-center justify-between py-4">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center space-x-2 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center transform group-hover:scale-105 group-hover:rotate-3 transition-all duration-300 shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                                Book Swap
                            </span>
                        </a>
                    </div>

                    <!-- Desktop Menu -->
                    <nav class="hidden md:flex items-center space-x-1">
                        @auth
                            <a href="{{ url('/conversations') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">Conversations</a>
                            <a href="{{ url('/profile') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">Profile</a>
                            <a href="{{ url('/library') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">Library</a>
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 hover:scale-105 transition-all duration-300">Register</a>
                            @endif
                        @endauth
                    </nav>

                    <!-- Hamburger Button -->
                    <div class="md:hidden flex items-center">
                        <button id="nav-toggle" class="p-2 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="nav-links" class="hidden md:hidden">
                    <nav class="flex flex-col space-y-2 py-4 border-t border-gray-200">
                        @auth
                            <a href="{{ url('/conversations') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Conversations</a>
                            <a href="{{ url('/profile') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Profile</a>
                            <a href="{{ url('/library') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Library</a>
                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg shadow-md">Register</a>
                            @endif
                        @endauth
                    </nav>
                </div>
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200 w-full max-w-4xl book-card-hover">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- Book Image -->
                <div class="relative book-image-animation overflow-hidden">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover min-h-[400px] lg:min-h-[500px] transform hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 flex items-center justify-center relative overflow-hidden min-h-[400px] lg:min-h-[500px] shimmer">
                            <div class="absolute inset-0 bg-white/30 backdrop-blur-xl"></div>
                            <svg class="w-24 h-24 text-blue-400 relative z-10 pulse-glow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
                </div>

                <!-- Payment Details -->
                <div class="p-8 lg:p-12 flex flex-col book-details-animation">
                    <div class="flex-grow">
                        <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4 leading-tight detail-item">Confirm Payment</h1>
                        <p class="text-lg text-gray-600 font-medium mb-6 detail-item">Review your {{ $book->status === 'vente' ? 'purchase' : 'borrowing' }} details</p>

                        <div class="border-t border-gray-200 my-6 detail-item"></div>

                        <!-- Book Summary -->
                        <div class="mb-6 detail-item">
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $book->title }}</h3>
                            <p class="text-gray-600 mb-2">by <span class="font-semibold">{{ $book->author }}</span></p>
                            <p class="text-sm text-gray-500">{{ $book->status === 'vente' ? 'Purchase' : 'Borrow' }}</p>
                        </div>

                        <!-- Payment Summary -->
                        <div class="payment-summary rounded-xl p-6 mb-8 detail-item">
                            <h3 class="text-xl font-bold mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Payment Summary
                            </h3>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span>{{ $book->status === 'vente' ? 'Purchase Price' : 'Borrowing Fee' }}</span>
                                    <span class="font-semibold">${{ number_format($book->price, 2) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Processing Fee</span>
                                    <span class="font-semibold">$0.00</span>
                                </div>
                                <div class="border-t border-white/30 pt-2 mt-4">
                                    <div class="flex justify-between text-lg font-bold">
                                        <span>Total</span>
                                        <span>${{ number_format($book->price, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="mb-8 detail-item">
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <h4 class="font-semibold text-gray-900 mb-2">Terms & Conditions</h4>
                                <ul class="text-sm text-gray-600 space-y-1">
                                    <li>• Payment will be processed directly</li>
                                    <li>• {{ $book->status === 'vente' ? 'This is a final purchase with no returns' : 'Book must be returned in good condition' }}</li>
                                    <li>• Contact the owner for any questions</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-auto pt-6 border-t border-gray-200">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('books.show', $book->id) }}" class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition-all duration-300 border border-gray-300 shadow-sm hover:shadow-md transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Back to Book
                            </a>
                            <form action="{{ route('payment.process') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                <button type="submit" class="w-full paypal-button inline-flex items-center justify-center px-6 py-3 font-bold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                    Confirm and Proceed
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <footer class="bg-gradient-to-r from-gray-900 via-blue-900 to-indigo-900 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-gray-300 font-medium">&copy; 2024 Book Swap. All rights reserved.</p>
                <p class="text-gray-400 text-sm mt-2">Discover, Share, and Exchange Books</p>
            </div>
        </div>
    </footer>

        </div>
    </div>
    <script>
        // Hamburger menu toggle
        document.getElementById('nav-toggle').addEventListener('click', function() {
            const navLinks = document.getElementById('nav-links');
            navLinks.classList.toggle('hidden');
        });
    </script>
</body>
</html>
