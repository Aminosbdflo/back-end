
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat with {{ $owner->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@if($currentUser->id == $owner->id)
<body class="bg-black min-h-screen flex items-center justify-center">
    <div class="text-center">
        <p class="text-white text-4xl font-bold">BAGHI DWI M3A RASEK !</p>
    </div>
</body>
@else
<body class="bg-gradient-to-br from-blue-50 via-white to-indigo-50 min-h-screen">
    <!-- Header -->
    <header class="bg-white shadow-md border-b border-blue-200 sticky top-0 z-50">
        <div class="w-full lg:max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (Route::has('login'))
                <nav class="flex items-center justify-between py-4">
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
                    <div class="flex items-center space-x-2">
                        @auth
                            <a href="{{ url('/conversations') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">
                                Conversations
                            </a>
                            <a href="{{ url('/profile') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">
                                Profile
                            </a>
                            <a href="{{ url('/library') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">
                                Library
                            </a>
                            <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2.5 text-blue-600 hover:text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-all duration-300">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </nav>
            @endif
        </div>
    </header>

    <!-- Chat Container -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-blue-100">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6">
                <h1 class="text-2xl font-bold">Chat with {{ $owner->name }}</h1>
                <p class="text-blue-100">Discuss book exchange details</p>
            </div>

            <!-- Messages Container -->
            <div id="messages" class="h-96 overflow-y-auto p-6 space-y-4 bg-gray-50">
                <!-- Messages will be loaded here -->
            </div>

            <!-- Message Input -->
            <div class="p-6 bg-white border-t border-gray-200">
                <form id="messageForm" class="flex space-x-4">
                    <input type="text" id="messageInput" placeholder="Type your message..." class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const ownerId = {!! json_encode($owner->id) !!};
        const currentUserId = {!! json_encode($currentUser->id) !!};
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        let lastMessageId = 0;

        // Load initial messages
        function loadMessages() {
            fetch(`/chat/${ownerId}/messages`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(messages => {
                const messagesContainer = document.getElementById('messages');
                messagesContainer.innerHTML = '';
                messages.forEach(message => {
                    appendMessage(message);
                    if (message.id > lastMessageId) {
                        lastMessageId = message.id;
                    }
                });
                scrollToBottom();
                // Start polling for new messages
                setInterval(pollNewMessages, 2000); // Poll every 2 seconds
            })
            .catch(error => console.error('Error loading messages:', error));
        }

        // Poll for new messages
        function pollNewMessages() {
            fetch(`/chat/${ownerId}/messages?after=${lastMessageId}`, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(messages => {
                messages.forEach(message => {
                    appendMessage(message);
                    if (message.id > lastMessageId) {
                        lastMessageId = message.id;
                    }
                });
            })
            .catch(error => console.error('Error polling messages:', error));
        }

        // Append message to chat
        function appendMessage(message) {
            const messagesContainer = document.getElementById('messages');
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${message.sender_id == currentUserId ? 'justify-end' : 'justify-start'} mb-4`;

            const time = new Date(message.created_at).toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            const bubbleClass = message.sender_id == currentUserId ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white' : 'bg-white text-gray-800 border border-gray-200 shadow-sm';

            messageDiv.innerHTML = `
                <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${bubbleClass}">
                    <p class="text-sm">${message.message}</p>
                    <p class="text-xs mt-1 opacity-75">${time}</p>
                </div>
            `;

            messagesContainer.appendChild(messageDiv);
            scrollToBottom();
        }

        // Scroll to bottom
        function scrollToBottom() {
            const messagesContainer = document.getElementById('messages');
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }

        // Send message
        document.getElementById('messageForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const messageInput = document.getElementById('messageInput');
            const message = messageInput.value.trim();

            if (message) {
                fetch(`/chat/${ownerId}/send`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ message: message })
                })
                .then(response => response.json())
                .then(data => {
                    appendMessage(data);
                    if (data.id > lastMessageId) {
                        lastMessageId = data.id;
                    }
                    messageInput.value = '';
                })
                .catch(error => console.error('Error:', error));
            }
        });

        // Load messages on page load
        loadMessages();
    </script>
</body>
@endif
</html>
