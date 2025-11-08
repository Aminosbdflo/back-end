<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Book Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-3xl font-bold text-white">{{ $totalBooks }}</h4>
                                    <p class="text-blue-100 text-sm font-medium">Total Books</p>
                                </div>
                                <div class="text-blue-200">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-green-500 to-green-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-3xl font-bold text-white">{{ $availableBooks }}</h4>
                                    <p class="text-green-100 text-sm font-medium">Available Books</p>
                                </div>
                                <div class="text-green-200">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-red-500 to-red-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h4 class="text-3xl font-bold text-white">{{ $borrowedBooks }}</h4>
                                    <p class="text-red-100 text-sm font-medium">Borrowed Books</p>
                                </div>
                                <div class="text-red-200">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <a href="{{ route('conversations') }}" class="block">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-3xl font-bold text-white">{{ $conversationCount }}</h4>
                                        <p class="text-purple-100 text-sm font-medium">Conversations</p>
                                    </div>
                                    <div class="text-purple-200">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
            </div>

            {{-- <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Your Books</h3>
                    @if($books->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($books as $book)
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h4 class="font-semibold">{{ $book->title }}</h4>
                                    <p class="text-sm text-gray-600">Author: {{ $book->author }}</p>
                                    <p class="text-sm text-gray-600">Genre: {{ $book->genre }}</p>
                                    <p class="text-sm text-gray-600">Status: {{ ucfirst($book->status) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">You haven't created any books yet.</p>
                    @endif
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>
