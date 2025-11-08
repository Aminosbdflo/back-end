{{-- resources/views/user/books/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-800 rounded-r-lg flex items-start">
                            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">{{ __("My Book Collection") }}</h3>
                            <p class="text-gray-600 text-sm mt-1">Manage and organize your personal library</p>
                        </div>

                        <button id="openModalBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add New Book
                        </button>
                    </div>

                    <!-- Search Form -->
                    <div class="mb-6">
                        <form method="GET" action="{{ route('user.books') }}" class="flex items-center space-x-4">
                            <div class="flex-1">
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, author, or genre..." class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Search
                            </button>
                            @if(request('search'))
                                <a href="{{ route('user.books') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Clear
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- Books Table -->
                    <div class="overflow-hidden border border-gray-200 rounded-lg shadow-sm">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <tr>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Image</th>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Title</th>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Author</th>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Published Year</th>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Genre</th>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Summary</th>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Category</th>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Book Type</th>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Price</th>
                                        <th class="py-4 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                        <th class="py-4 px-6 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($books as $book)
                                        <tr class="hover:bg-gray-50 transition duration-150">
                                            <td class="py-4 px-6 text-sm text-center">
                                                @if($book->image)
                                                    <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image" class="w-12 h-12 object-cover rounded-lg mx-auto">
                                                @else
                                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center mx-auto">
                                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $book->title }}</td>
                                            <td class="py-4 px-6 text-sm text-gray-700">{{ $book->author }}</td>
                                            <td class="py-4 px-6 text-sm text-gray-700">{{ $book->published_year }}</td>
                                            <td class="py-4 px-6 text-sm text-gray-700">
                                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                                    {{ $book->genre }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-600 max-w-xs truncate">{{ $book->summary }}</td>
                                            <td class="py-4 px-6 text-sm text-gray-700">
                                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                                    {{ $book->category->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-700">
                                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                                    {{ $book->bookType->name ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 text-sm text-gray-700">
                                                @if(optional($book->bookType)->name === 'vente' && $book->price)
                                                    ${{ number_format($book->price, 2) }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>

                                            <td class="py-4 px-6 text-sm text-gray-700">
                                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full @if($book->status == 'available') bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                                    {{ ucfirst($book->status) }}
                                                </span>
                                            </td>

                                            <td class="py-4 px-6 text-sm text-center">
                                                <div class="flex justify-center space-x-3 items-center">
                                                    {{-- Request button --}}
                                                    @if($book->status === 'available')
                                                        <form action="{{ route('user.books.request', $book->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="flex items-center px-3 py-2 rounded-md bg-purple-50 hover:bg-purple-100 text-purple-700 text-sm" title="Request Book">
                                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                                </svg>
                                                                Request
                                                            </button>
                                                        </form>
                                                    @endif

                                                    {{-- Edit button: store the book JSON into data-book to avoid escaping problems in onclick --}}
                                                    <button
                                                        type="button"
                                                        class="flex items-center px-3 py-2 rounded-md bg-yellow-50 hover:bg-yellow-100 text-yellow-700 text-sm"
                                                        data-book='@json($book->loadMissing(["category","bookType"]))'
                                                        onclick="openEditModal(this)"
                                                        aria-label="Edit book">
                                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                        </svg>

                                                    </button>

                                                    {{-- Delete form --}}
                                                    <form action="{{ route('user.books.destroy', $book->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-800 transition duration-150" onclick="return confirm('Are you sure you want to delete this book?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" class="py-12 px-6 text-center">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                                </svg>
                                                <p class="mt-4 text-gray-500 text-lg font-medium">No books found</p>
                                                <p class="mt-2 text-gray-400 text-sm">Start building your library by adding your first book</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        <div class="mt-6 px-6 py-4">
                            {{ $books->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- EDIT BOOK MODAL --}}
        <div id="editBookModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 backdrop-blur-sm">
            <div class="relative top-10 mx-auto p-0 border-0 w-full max-w-2xl">
                <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-2xl font-bold text-white flex items-center">
                                <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit Book
                            </h3>
                            <button type="button" id="closeEditModalBtn" class="text-white hover:text-gray-200 transition duration-150">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <form action="" method="POST" id="editBookForm" enctype="multipart/form-data" class="p-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="edit_title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                                <input type="text" name="title" id="edit_title" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter book title" required>
                            </div>

                            <div>
                                <label for="edit_author" class="block text-sm font-semibold text-gray-700 mb-2">Author</label>
                                <input type="text" name="author" id="edit_author" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Author name" required>
                            </div>

                            <div>
                                <label for="edit_published_year" class="block text-sm font-semibold text-gray-700 mb-2">Published Year</label>
                                <input type="number" name="published_year" id="edit_published_year" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="2024" required>
                            </div>

                            <div>
                                <label for="edit_genre" class="block text-sm font-semibold text-gray-700 mb-2">Genre</label>
                                <input type="text" name="genre" id="edit_genre" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="e.g., Fiction, Mystery" required>
                            </div>

                            <div>
                                <label for="edit_category_id" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                                <select name="category_id" id="edit_category_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="edit_book_type_id" class="block text-sm font-semibold text-gray-700 mb-2">Book Type</label>
                                <select name="book_type_id" id="edit_book_type_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                                    <option value="">Select Book Type</option>
                                    @foreach($bookTypes as $bookType)
                                        <option value="{{ $bookType->id }}" data-name="{{ $bookType->name }}">{{ $bookType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="edit_status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                <select name="status" id="edit_status" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" required>
                                    <option value="">Select Status</option>
                                    <option value="available">Available</option>
                                    <option value="borrowed">Borrowed</option>
                                </select>
                            </div>

                            <div id="editPriceField" style="display: none;">
                                <label for="edit_price" class="block text-sm font-semibold text-gray-700 mb-2">Price ($)</label>
                                <input type="number" name="price" id="edit_price" step="0.01" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="0.00">
                            </div>

                            <div class="md:col-span-2">
                                <label for="edit_summary" class="block text-sm font-semibold text-gray-700 mb-2">Summary</label>
                                <textarea name="summary" id="edit_summary" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 resize-none" placeholder="Brief description of the book..."></textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label for="edit_image" class="block text-sm font-semibold text-gray-700 mb-2">Book Image</label>
                                <input type="file" name="image" id="edit_image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500">
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                            <button type="button" id="closeEditModalBtn2" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 shadow-md transform hover:scale-105 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- CREATE BOOK MODAL --}}
        <div id="createBookModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50 backdrop-blur-sm">
            <div class="relative top-10 mx-auto p-0 border-0 w-full max-w-2xl">
                <div class="bg-white shadow-2xl rounded-2xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
                        <div class="flex justify-between items-center">
                            <h3 class="text-2xl font-bold text-white flex items-center">
                                <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                                Add New Book
                            </h3>
                            <button type="button" id="closeModalBtn" class="text-white hover:text-gray-200 transition duration-150">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <form action="{{ route('user.books.store') }}" method="POST" id="createBookForm" enctype="multipart/form-data" class="p-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title</label>
                                <input type="text" name="title" id="title" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter book title" required>
                            </div>

                            <div>
                                <label for="author" class="block text-sm font-semibold text-gray-700 mb-2">Author</label>
                                <input type="text" name="author" id="author" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Author name" required>
                            </div>

                            <div>
                                <label for="published_year" class="block text-sm font-semibold text-gray-700 mb-2">Published Year</label>
                                <input type="number" name="published_year" id="published_year" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="2024" required>
                            </div>

                            <div>
                                <label for="genre" class="block text-sm font-semibold text-gray-700 mb-2">Genre</label>
                                <input type="text" name="genre" id="genre" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Fiction, Mystery" required>
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                                <select name="category_id" id="category_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" data-name="{{ $category->name }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="book_type_id" class="block text-sm font-semibold text-gray-700 mb-2">Book Type</label>
                                <select name="book_type_id" id="book_type_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Select Book Type</option>
                                    @foreach($bookTypes as $bookType)
                                        <option value="{{ $bookType->id }}" data-name="{{ $bookType->name }}">{{ $bookType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                                <select name="status" id="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Select Status</option>
                                    <option value="available">Available</option>
                                    <option value="borrowed">Borrowed</option>
                                </select>
                            </div>

                            <div id="priceField" style="display: none;">
                                <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price ($)</label>
                                <input type="number" name="price" id="price" step="0.01" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
                            </div>

                            <div class="md:col-span-2">
                                <label for="summary" class="block text-sm font-semibold text-gray-700 mb-2">Summary</label>
                                <textarea name="summary" id="summary" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none" placeholder="Brief description of the book..."></textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Book Image</label>
                                <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                            <button type="button" id="closeModalBtn2" class="px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200">Cancel</button>
                            <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 shadow-md transform hover:scale-105 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Create Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script>
        // Modal elements
        const createModal = document.getElementById('createBookModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const closeModalBtn2 = document.getElementById('closeModalBtn2');
        const createBookForm = document.getElementById('createBookForm');

        const editModal = document.getElementById('editBookModal');
        const closeEditModalBtn = document.getElementById('closeEditModalBtn');
        const closeEditModalBtn2 = document.getElementById('closeEditModalBtn2');
        const editBookForm = document.getElementById('editBookForm');

        // Open / close create modal
        openModalBtn.addEventListener('click', () => createModal.classList.remove('hidden'));
        closeModalBtn.addEventListener('click', () => createModal.classList.add('hidden'));
        closeModalBtn2.addEventListener('click', () => createModal.classList.add('hidden'));

        // Close create modal after submit (lets server handle redirect/flash)
        createBookForm.addEventListener('submit', () => {
            // small delay to make user see the click, then hide; server will redirect on success
            setTimeout(() => createModal.classList.add('hidden'), 100);
        });

        // Helper: toggle price field by bookType data-name attribute
        function togglePriceField(selectElement, priceFieldId, priceInputId) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const bookTypeName = selectedOption ? selectedOption.getAttribute('data-name') : '';
            const priceField = document.getElementById(priceFieldId);
            const priceInput = document.getElementById(priceInputId);

            if (bookTypeName === 'vente') {
                priceField.style.display = 'block';
                priceInput.required = true;
            } else {
                priceField.style.display = 'none';
                priceInput.required = false;
                if (priceInput) priceInput.value = '';
            }
        }

        // Wire up create modal book type toggle
        document.getElementById('book_type_id').addEventListener('change', function() {
            togglePriceField(this, 'priceField', 'price');
        });

        // Wire up edit modal book type toggle
        document.getElementById('edit_book_type_id').addEventListener('change', function() {
            togglePriceField(this, 'editPriceField', 'edit_price');
        });

        // Initialize create modal price field on DOMContentLoaded
        document.addEventListener('DOMContentLoaded', function() {
            togglePriceField(document.getElementById('book_type_id'), 'priceField', 'price');
        });

        // edit modal close handlers
        closeEditModalBtn.addEventListener('click', () => editModal.classList.add('hidden'));
        closeEditModalBtn2.addEventListener('click', () => editModal.classList.add('hidden'));

        // global click to close modals when clicking on backdrop
        window.addEventListener('click', (e) => {
            if (e.target === createModal) createModal.classList.add('hidden');
            if (e.target === editModal) editModal.classList.add('hidden');
        });

        // Open edit modal using the button that holds data-book JSON
        function openEditModal(button) {
            try {
                const book = JSON.parse(button.getAttribute('data-book'));
                // Show the modal first
                document.getElementById('editBookModal').classList.remove('hidden');
                
                // populate fields
                document.getElementById('edit_title').value = book.title ?? '';
                document.getElementById('edit_author').value = book.author ?? '';
                document.getElementById('edit_published_year').value = book.published_year ?? '';
                document.getElementById('edit_genre').value = book.genre ?? '';
                document.getElementById('edit_summary').value = book.summary ?? '';
                document.getElementById('edit_category_id').value = book.category_id ?? '';
                document.getElementById('edit_book_type_id').value = book.book_type_id ?? '';
                document.getElementById('edit_status').value = book.status ?? '';
                const editPriceInput = document.getElementById('edit_price');
                if (book.price) editPriceInput.value = book.price;

                // set form action: use a base url + id (adjust base URL if your route is different)
                // base url generated by Blade to avoid hardcoding domain
                editBookForm.action = `{{ route('user.books') }}/${book.id}`;

                // toggle price field visibility for edit modal
                togglePriceField(document.getElementById('edit_book_type_id'), 'editPriceField', 'edit_price');

                // show modal
                editModal.classList.remove('hidden');

            } catch (err) {
                console.error('Failed to open edit modal:', err);
                alert('Could not open edit modal. See console for details.');
            }
        }

        // Close edit modal after submit
        editBookForm.addEventListener('submit', () => {
            setTimeout(() => editModal.classList.add('hidden'), 100);
        });
    </script>
</x-app-layout>
