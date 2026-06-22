<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedRemind Pro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 min-h-screen">

    <div class="container mx-auto px-6 py-16">

        <div class="max-w-6xl mx-auto">

            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

                <div class="grid md:grid-cols-2">

                    <!-- LEFT SIDE -->

                    <div class="bg-gradient-to-br from-blue-600 via-indigo-700 to-purple-800 text-white p-12 flex flex-col justify-center">

                        <span class="bg-white/20 px-4 py-2 rounded-full text-sm w-fit">
                            💊 MedRemind Pro
                        </span>

                        <h1 class="text-5xl font-bold mt-8 leading-tight">
                            Never Miss Your
                            Medicine Again
                        </h1>

                        <p class="mt-5 text-blue-100 text-lg">
                            Smart medicine reminder platform built with Laravel 12.
                        </p>

                        <div class="mt-8 space-y-3">

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

                    <!-- RIGHT SIDE -->

                    <div class="p-12 flex items-center">

                        <div class="w-full">

                            <h2 class="text-4xl font-bold text-gray-800">
                                Welcome to MedRemind
                            </h2>

                            <p class="text-gray-500 mt-4">
                                Manage medicines, schedules, reminders and notifications from a single dashboard.
                            </p>

                            <div class="mt-10 grid grid-cols-2 gap-4">

                                <div class="bg-blue-50 p-4 rounded-xl text-center">
                                    <div class="text-3xl mb-2">💊</div>
                                    <div class="font-semibold">
                                        Medicines
                                    </div>
                                </div>

                                <div class="bg-green-50 p-4 rounded-xl text-center">
                                    <div class="text-3xl mb-2">⏰</div>
                                    <div class="font-semibold">
                                        Reminders
                                    </div>
                                </div>

                                <div class="bg-purple-50 p-4 rounded-xl text-center">
                                    <div class="text-3xl mb-2">📧</div>
                                    <div class="font-semibold">
                                        Notifications
                                    </div>
                                </div>

                                <div class="bg-orange-50 p-4 rounded-xl text-center">
                                    <div class="text-3xl mb-2">📊</div>
                                    <div class="font-semibold">
                                        Analytics
                                    </div>
                                </div>

                            </div>

                            <div class="mt-10 space-y-4">

                                <a
                                    href="{{ route('login') }}"
                                    class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-xl font-semibold transition">

                                    Sign In

                                </a>

                                <a
                                    href="{{ route('register') }}"
                                    class="block w-full border border-gray-300 hover:bg-gray-50 text-center py-3 rounded-xl font-semibold transition">

                                    Create Account

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>