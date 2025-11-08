<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Book Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div id="smooth-wrapper">
        <div id="smooth-content">

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
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">Dashboard</a>
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
                            <a href="{{ url('/dashboard') }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-lg">Dashboard</a>
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

    <div class="bg-gradient-to-r from-blue-600 to-purple-700 h-screen flex items-center justify-center text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 id="library-title" class="text-4xl md:text-6xl font-bold mb-4">Library</h1>
                <p id="library-subtitle" class="text-xl md:text-2xl mb-8">Explore our complete collection of books</p>
            </div>
        </div>
    </div>

    <!-- Books Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">All Available Books</h2>
            <p class="text-gray-600">Browse through our entire collection of amazing books</p>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-8 border border-gray-200 filter-bar">
            <form method="GET" action="{{ route('library') }}" class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-6">
                <div class="w-full md:w-auto">
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" id="category_id" class="w-full md:w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-auto">
                    <label for="book_type_id" class="block text-sm font-medium text-gray-700 mb-2">Book Type</label>
                    <select name="book_type_id" id="book_type_id" class="w-full md:w-48 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 bg-white shadow-sm">
                        <option value="">All Types</option>
                        @foreach($bookTypes as $bookType)
                            <option value="{{ $bookType->id }}" {{ request('book_type_id') == $bookType->id ? 'selected' : '' }}>{{ $bookType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-auto flex space-x-2">
                    <button type="submit" class="flex-1 md:flex-none bg-gradient-to-r from-blue-600 to-purple-700 hover:from-blue-700 hover:to-purple-800 text-white font-semibold py-2.5 px-6 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        Filter
                    </button>
                    <a href="{{ route('library') }}" class="flex-1 md:flex-none bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2.5 px-6 rounded-lg transition-all duration-300 shadow-sm hover:shadow-md text-center">
                        Clear
                    </a>
                </div>
            </form>
        </div>
        @if($books->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4 books-grid">
                @foreach($books as $book)
                    <div class="book-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
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

        <!-- Pagination -->
        @if($books->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $books->links() }}
            </div>
        @endif
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
