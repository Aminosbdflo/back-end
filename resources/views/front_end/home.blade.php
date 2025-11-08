<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store - Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-md border-b border-blue-200 sticky top-0 z-50">
        <div class="w-full lg:max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (Route::has('login'))
                <div class="flex items-center justify-between py-4">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="flex items-center space-x-2 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center transform group-hover:scale-105 transition-transform duration-300">
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
                            <a href="{{ url('/conversations') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">Conversations</a>
                            <a href="{{ url('/profile') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">Profile</a>
                            <a href="{{ url('/library') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">Library</a>
                            <a href="{{ Auth::user()->usertype === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">Register</a>
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
                            <a href="{{ url('/conversations') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg">Conversations</a>
                            <a href="{{ url('/profile') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg">Profile</a>
                            <a href="{{ url('/library') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg">Library</a>
                            <a href="{{ Auth::user()->usertype === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-lg shadow-md">Register</a>
                            @endif
                        @endauth
                    </nav>
                </div>
            @endif
        </div>
    </header>

    <div class="bg-gradient-to-r from-blue-600 to-purple-700 text-white">
        <div class="max-w-7xl mx-auto flex flex-col items-center justify-center h-screen px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center ">
                <h1 id="hero-title" class="text-4xl md:text-6xl font-bold mb-4">Welcome to BookStore</h1>
                <p id="hero-subtitle" class="text-xl md:text-2xl mb-8">Discover your next favorite book from our collection</p>
            </div>
    </div>

</div>
    <!-- Image Carousel Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Books</h2>
            <p class="text-lg text-gray-600">Discover our highlighted collection</p>
        </div>
        <div class="carousel-container overflow-hidden rounded-lg shadow-lg">
            <div class="carousel-slide flex">
                @foreach($books as $book)
                    <div class="carousel-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-80 object-cover">
                        @else
                            <div class="w-full h-80 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
                <!-- Duplicate for seamless loop -->
                @foreach($books->take(8) as $book)
                    <div class="carousel-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-80 object-cover">
                        @else
                            <div class="w-full h-80 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Books Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Available Books</h2>
            <p class="text-lg text-gray-600">Browse our latest available books</p>
        </div>
        @if($books->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 home-books-grid">
                @foreach($books as $book)
                    <div class="book-card home-book-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
                        @if($book->image)
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-80 object-cover">
                        @else
                            <div class="w-full h-80 bg-gradient-to-br from-blue-100 to-purple-100 flex items-center justify-center">
                                <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        @endif
                        <div class="p-5 flex-grow flex flex-col">
                            <div class="flex-grow mb-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $book->title }}</h3>
                                <p class="text-gray-600 text-sm mb-1">by {{ $book->author }}</p>
                                @if($book->published_year)
                                    <p class="text-gray-500 text-xs">Published: {{ $book->published_year }}</p>
                                @endif
                            </div>
                            <a href="{{ route('books.show', $book->id) }}" class="w-full bg-gradient-to-r from-blue-600 to-purple-700 hover:from-blue-700 hover:to-purple-800 text-white font-semibold py-2.5 px-4 rounded-lg transition-all duration-300 text-center shadow-md hover:shadow-lg">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-24 w-24 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">No books available</h3>
                <p class="text-gray-500">Check back later for new arrivals!</p>
            </div>
        @endif
        <div class="text-center py-6">
            <a href="{{ route('library') }}" class="inline-block mt-4 px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-700 hover:from-blue-700 hover:to-purple-800 text-white font-semibold rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                View All Books in Library
            </a>
        </div>
    </div>
        <!-- Services Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 services-section">
        <div class="text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Services</h2>
            <p class="text-lg text-gray-600">Discover what we offer to enhance your book experience</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Service 1: Swap Books -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 text-center service-card">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Swap Books</h3>
                <p class="text-gray-600">Exchange your books with others in our community for free.</p>
            </div>
            <!-- Service 2: Buy Books -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 text-center service-card">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.1 5H19M7 13v8a2 2 0 002 2h10a2 2 0 002-2v-3"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Buy Books</h3>
                <p class="text-gray-600">Purchase new and used books at affordable prices.</p>
            </div>
            <!-- Service 3: Sell Books -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 text-center service-card">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Sell Books</h3>
                <p class="text-gray-600">Sell your old books and earn money from our platform.</p>
            </div>
            <!-- Service 4: Community -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 text-center service-card">
                <div class="w-16 h-16 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Community</h3>
                <p class="text-gray-600">Connect with fellow book lovers through our chat system.</p>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-blue-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <p class="text-gray-300">&copy; 2024 Book Swap. All rights reserved.</p>
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
