<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('My Conversations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row h-[calc(100vh-12rem)] bg-gray-50 rounded-lg shadow-sm overflow-hidden">
                <!-- Left Sidebar: Conversations List -->
                <div class="w-full lg:w-96 bg-white border-b lg:border-b-0 lg:border-r border-gray-200 flex flex-col">
                    <div class="p-4 border-b border-gray-200 flex-shrink-0">
                        <h3 class="text-lg font-semibold text-gray-900">Chats</h3>
                    </div>
                    <div class="flex-1 overflow-y-auto p-4 space-y-1">
                        @if($conversations->count() > 0)
                            @foreach($conversations as $conversation)
                                <div data-partner-id="{{ $conversation['partner']->id }}" class="conversation-item cursor-pointer p-3 rounded-lg border border-transparent hover:bg-gray-50 hover:border-gray-300 transition-colors block">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3 flex-1 min-w-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm flex-shrink-0">
                                                {{ strtoupper(substr($conversation['partner']->name, 0, 1)) }}
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <h4 class="font-semibold text-gray-900 truncate">{{ $conversation['partner']->name }}</h4>
                                                <p class="text-sm text-gray-600 latest-message-text truncate">
                                                    @if($conversation['latest_message'])
                                                        {{ Str::limit($conversation['latest_message']->message, 30) }}
                                                    @else
                                                        No messages yet
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-right flex-shrink-0 ml-2">
                                            <p class="text-xs text-gray-500 latest-message-time">{{ $conversation['latest_message'] ? $conversation['latest_message']->created_at->diffForHumans() : '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No conversations</h3>
                                <p class="mt-1 text-sm text-gray-500">You haven't started any conversations yet. Start chatting by requesting a book from another user.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right Panel: Chat Area -->
                <div class="flex-1 flex flex-col">
                    <!-- Chat Header -->
                    <div id="chatHeader" class="hidden p-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                        <div class="flex items-center space-x-3">
                            <div id="chatAvatar" class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                            </div>
                            <div>
                                <h2 id="chatPartnerName" class="font-semibold text-gray-900 text-lg"></h2>
                                <p class="text-sm text-gray-500">Active now</p>
                            </div>
                        </div>
                    </div>

                    <!-- No Chat Selected -->
                    <div id="noChatSelected" class="flex-1 flex items-center justify-center bg-gray-50 p-6">
                        <div class="text-center">
                            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <h3 class="mt-2 text-xl font-medium text-gray-900">Select a chat</h3>
                            <p class="mt-2 text-gray-500">Pick a conversation to start messaging</p>
                        </div>
                    </div>

                    <!-- Chat Messages -->
                    <div id="chatContainer" class="hidden flex flex-col flex-1 bg-white">
                        <div id="messages" class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50">
                            <!-- Messages will be loaded here -->
                        </div>
                        <!-- Message Input -->
                        <div class="p-6 bg-white border-t border-gray-200">
                            <form id="messageForm" class="flex space-x-4">
                                <input type="text" id="messageInput" placeholder="Type your message..." class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none" disabled>
                                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl disabled:opacity-50" disabled>Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $pusherKey = config('broadcasting.connections.pusher.key');
        $pusherCluster = config('broadcasting.connections.pusher.options.cluster');
    @endphp

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</x-app-layout>
