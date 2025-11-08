<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Verify Your Email</h2>
        <p class="text-gray-600">We've sent you a verification link</p>
    </div>

    <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-5 rounded-r-lg">
        <div class="flex items-start">
            <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm text-blue-800 leading-relaxed">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        </div>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-5 rounded-r-lg animate-fade-in">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="text-sm font-semibold text-green-800 mb-1">Email Sent Successfully!</p>
                    <p class="text-sm text-green-700 leading-relaxed">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Action Buttons -->
    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button class="w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-600 hover:from-yellow-600 hover:to-yellow-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:scale-[1.02]">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 hover:border-gray-400 transition duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                {{ __('Log Out') }}
            </button>
        </form>
    </div>

    <!-- Help Section -->
    <div class="mt-8 bg-gradient-to-r from-yellow-50 to-orange-50 rounded-lg p-5 border border-yellow-200">
        <div class="flex items-start space-x-3">
            <svg class="w-5 h-5 text-yellow-700 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
            </svg>
            <div>
                <p class="text-sm font-semibold text-yellow-900 mb-2">Troubleshooting Tips</p>
                <ul class="text-xs text-yellow-800 space-y-2 leading-relaxed">
                    <li class="flex items-start">
                        <svg class="w-3 h-3 text-yellow-600 mr-2 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span><strong>Check your spam folder</strong> - Verification emails sometimes end up there</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-3 h-3 text-yellow-600 mr-2 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span><strong>Wait a few minutes</strong> - Email delivery can take up to 5 minutes</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-3 h-3 text-yellow-600 mr-2 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span><strong>Verify your email address</strong> - Make sure you registered with the correct email</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-3 h-3 text-yellow-600 mr-2 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span><strong>Contact support</strong> - If problems persist, reach out to support@bookhub.com</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Email Preview -->
    <div class="mt-6 bg-white rounded-lg p-5 border-2 border-gray-200">
        <div class="flex items-start space-x-3">
            <svg class="w-5 h-5 text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-900 mb-1">What to look for in your email:</p>
                <div class="bg-gray-50 rounded p-3 mt-2 border border-gray-200">
                    <p class="text-xs font-semibold text-gray-700 mb-1">From: BookHub &lt;noreply@bookhub.com&gt;</p>
                    <p class="text-xs font-semibold text-gray-700 mb-2">Subject: Verify Your Email Address</p>
                    <p class="text-xs text-gray-600 italic">Look for a button or link that says "Verify Email Address"</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Security Notice -->
    <div class="mt-4 bg-gray-50 rounded-lg p-4 border border-gray-200">
        <div class="flex items-start space-x-3">
            <svg class="w-5 h-5 text-gray-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <p class="text-xs text-gray-600 leading-relaxed">
                <strong>Security Note:</strong> Verification links expire after 60 minutes for your security. If your link has expired, simply click the "Resend Verification Email" button above to receive a new one.
            </p>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>
</x-guest-layout>