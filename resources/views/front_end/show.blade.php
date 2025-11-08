<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $book->title }} - Book Details</title>
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
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-200 w-full max-w-7xl book-card-hover">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-0">
                <!-- Book Image -->
                <div class="md:col-span-2 relative book-image-animation overflow-hidden">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover min-h-[450px] md:min-h-[600px] transform hover:scale-105 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-100 via-indigo-100 to-purple-100 flex items-center justify-center relative overflow-hidden min-h-[450px] md:min-h-[600px] shimmer">
                            <div class="absolute inset-0 bg-white/30 backdrop-blur-xl"></div>
                            <svg class="w-32 h-32 text-blue-400 relative z-10 pulse-glow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
                </div>

                <!-- Book Details -->
                <div class="md:col-span-3 p-8 md:p-12 flex flex-col book-details-animation">
                    <div class="flex-grow">
                        <h1 id="book-title" class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3 leading-tight detail-item">{{ $book->title }}</h1>
                        <p class="text-xl text-gray-600 font-medium mb-6 detail-item">by <span class="text-gray-800 font-semibold">{{ $book->author }}</span></p>

                        <div class="border-t border-gray-200 my-6 detail-item"></div>

                        <!-- Tags -->
                        <div class="mb-6 flex flex-wrap gap-3">
                            <span class="tag-item inline-flex items-center bg-gradient-to-r from-blue-100 to-blue-50 text-blue-800 text-sm font-semibold px-4 py-2 rounded-full border border-blue-200 shadow-sm hover:shadow-md transform hover:scale-105 transition-all duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                {{ $book->category->name ?? 'N/A' }}
                            </span>
                            <span class="tag-item inline-flex items-center bg-gradient-to-r from-indigo-100 to-indigo-50 text-indigo-800 text-sm font-semibold px-4 py-2 rounded-full border border-indigo-200 shadow-sm hover:shadow-md transform hover:scale-105 transition-all duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                {{ $book->bookType->name ?? 'N/A' }}
                            </span>
                            <span class="tag-item inline-flex items-center {{ $book->status === 'available' ? 'bg-gradient-to-r from-green-100 to-green-50 text-green-800 border-green-200' : 'bg-gradient-to-r from-red-100 to-red-50 text-red-800 border-red-200' }} text-sm font-semibold px-4 py-2 rounded-full border shadow-sm hover:shadow-md transform hover:scale-105 transition-all duration-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ ucfirst($book->status) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 text-sm">
                            @if($book->published_year)
                            <div class="detail-item flex items-start text-gray-700 bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors duration-300 border border-gray-200">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <div>
                                    <strong class="block text-gray-900 mb-1">Published Year</strong>
                                    <span class="text-gray-700">{{ $book->published_year }}</span>
                                </div>
                            </div>
                            @endif
                            <br><br>
                            @if($book->genre)
                            <div class="detail-item flex items-start text-gray-700 bg-gray-50 p-4 rounded-lg hover:bg-gray-100 transition-colors duration-300 border border-gray-200">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                <div>
                                    <strong class="block text-gray-900 mb-1">Genre</strong>
                                    <span class="text-gray-700">{{ $book->genre }}</span>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($book->summary)
                            <div class="mb-8 detail-item">
                                <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Summary
                                </h3>
                                <p class="text-gray-700 leading-relaxed bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-xl border-l-4 border-blue-400 shadow-sm hover:shadow-md transition-shadow duration-300">{{ $book->summary }}</p>
                            </div>
                        @endif

                        <div class="mb-8 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-sm border border-blue-100 detail-item">
                            <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mr-3 shadow-md">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </div>
                                Book Owner
                            </h3>
                            <p class="text-gray-800 font-semibold text-lg ml-13">{{ $book->user->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-auto pt-6 border-t border-gray-200">
                        <div class="flex flex-wrap gap-4">
                            <a href="{{ url('/') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition-all duration-300 border border-gray-300 shadow-sm hover:shadow-md transform hover:scale-105 w-full sm:w-auto">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                                Back to Home
                            </a>
                            @if(in_array($book->status, ['available', 'vente']))
                                @auth
                                    @if($book->price > 0)
                                    <a href="{{ url('/payment/confirm/' . $book->id) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 shimmer">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        {{ $book->status === 'vente' ? 'Buy Now' : 'Borrow Now' }} (${{ $book->price }})
                                    </a>
                                    @endif
                                    <a href="{{ route('chat.show', $book->user_id) }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300 shimmer">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        Contact Owner
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 hover:scale-105 transition-all duration-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                                        Log in to Request
                                    </a>
                                @endauth
                            @else
                                <div class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-red-100 to-red-50 text-red-800 font-semibold rounded-lg border border-red-300 shadow-sm">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                    This book is currently borrowed
                                </div>
                            @endif
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