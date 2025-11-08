<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-3 rounded-lg shadow-md">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Profile Settings') }}
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage your account information and preferences</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Update Profile Information Section -->
            <div class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-5 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="bg-blue-600 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Profile Information</h3>
                            <p class="text-sm text-gray-600 mt-0.5">Update your account's profile information and email address</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Update Password Section -->
            <div class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-5 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="bg-purple-600 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Update Password</h3>
                            <p class="text-sm text-gray-600 mt-0.5">Ensure your account is using a long, random password to stay secure</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-red-200">
                <div class="bg-gradient-to-r from-red-50 to-orange-50 px-6 py-5 border-b border-red-200">
                    <div class="flex items-center space-x-3">
                        <div class="bg-red-600 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Delete Account</h3>
                            <p class="text-sm text-gray-600 mt-0.5">Permanently delete your account and all associated data</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 sm:p-8 bg-red-50/30">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

            <!-- Additional Info Card -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 shadow-xl sm:rounded-2xl overflow-hidden">
                <div class="px-6 py-8 sm:px-8">
                    <div class="flex items-start space-x-4">
                        <div class="bg-white/20 p-3 rounded-lg backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-lg font-bold text-white mb-2">Need Help?</h4>
                            <p class="text-blue-100 text-sm leading-relaxed">
                                If you have any questions about managing your profile or need assistance, please don't hesitate to contact our support team. We're here to help you!
                            </p>
                            <button class="mt-4 inline-flex items-center px-5 py-2.5 bg-white text-blue-600 font-semibold rounded-lg hover:bg-blue-50 transition duration-200 shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                Contact Support
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>