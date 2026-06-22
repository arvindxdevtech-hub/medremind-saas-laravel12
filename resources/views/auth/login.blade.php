<x-guest-layout>

    <div class="min-h-screen bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 flex items-center justify-center p-6">

        <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden">

            <div class="grid md:grid-cols-2">

                <!-- LEFT SIDE -->

                <div class="bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 text-white p-12 flex flex-col justify-center">

                    <div>
                        <span class="bg-white/20 px-4 py-2 rounded-full text-sm">
                            💊 MedRemind Pro
                        </span>

                        <h1 class="text-5xl font-bold mt-8 leading-tight">
                            Never Miss Your Medicine Again
                        </h1>

                        <p class="mt-5 text-blue-100">
                            Smart medicine reminder platform built with Laravel 12.
                        </p>

                        <div class="mt-8 space-y-3 text-lg">
                            <div>✅ Medicine Management</div>
                            <div>✅ Smart Scheduling</div>
                            <div>✅ Email Notifications</div>
                            <div>✅ Dashboard Analytics</div>
                        </div>

                        <div class="mt-10 bg-white/10 p-5 rounded-xl">
                            <h3 class="font-semibold mb-3">
                                Demo Login
                            </h3>

                            <p>
                                📧 arvinddevtech@medremind.com
                            </p>

                            <p>
                                🔑 12345678
                            </p>
                        </div>

                    </div>

                </div>

                <!-- RIGHT SIDE -->

                <div class="p-10 flex items-center">

                    <div class="w-full">

                        <h2 class="text-3xl font-bold text-gray-800">
                            Welcome Back
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Sign in to your account
                        </p>

                        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
                            @csrf

                            <div>
                                <label class="block mb-2 text-sm font-medium">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    required
                                    autofocus
                                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    required
                                    class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            </div>

                            <button
                                type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold">
                                Sign In
                            </button>

                            <p class="text-center text-sm text-gray-600">
                                Don't have an account?

                                <a href="{{ route('register') }}"
                                    class="text-blue-600 font-semibold">
                                    Create Account
                                </a>
                            </p>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-guest-layout>