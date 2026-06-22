<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-500 text-white p-8 rounded-3xl shadow-xl mb-8">
                <h2 class="text-3xl font-bold mb-2">
                    Welcome Back 👋
                </h2>

                <p class="opacity-90">
                    Manage medicines, schedules, reminders and notifications from one dashboard.
                </p>
            </div>


            <!-- Analytics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">

                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm opacity-80">Medicines</p>
                            <h2 class="text-4xl font-bold mt-2">
                                {{ $medicineCount }}
                            </h2>
                        </div>
                        <div class="text-5xl">💊</div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-violet-700 text-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm opacity-80">Schedules</p>
                            <h2 class="text-4xl font-bold mt-2">
                                {{ $scheduleCount }}
                            </h2>
                        </div>
                        <div class="text-5xl">📅</div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm opacity-80">Pending</p>
                            <h2 class="text-4xl font-bold mt-2">
                                {{ $pendingReminderCount }}
                            </h2>
                        </div>
                        <div class="text-5xl">⏳</div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-emerald-700 text-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm opacity-80">Sent</p>
                            <h2 class="text-4xl font-bold mt-2">
                                {{ $sentReminderCount }}
                            </h2>
                        </div>
                        <div class="text-5xl">✅</div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white rounded-2xl p-6 shadow-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm opacity-80">Notifications</p>
                            <h2 class="text-4xl font-bold mt-2">
                                {{ $notificationCount }}
                            </h2>
                        </div>
                        <div class="text-5xl">🔔</div>
                    </div>
                </div>

            </div>

            <!-- Today's Medicines -->

            <div class="mt-8 bg-white rounded-3xl shadow-lg overflow-hidden">
                @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                <div class="bg-green-600 text-white px-6 py-4">

                    <h2 class="text-lg font-semibold">
                        📅 Today's Medicines
                    </h2>

                </div>

                <div class="p-6">

                    @forelse($todaySchedules as $schedule)
                    @php
                    $log = $medicineLogs[$schedule->medicine->id] ?? null;
                    @endphp

                    <div class="flex justify-between items-center border-b py-4">

                        <div>

                            <h3 class="font-semibold text-gray-800">
                                💊 {{ $schedule->medicine->name }}
                            </h3>

                            <p class="text-gray-500 text-sm">
                                {{ $schedule->medicine->description }}
                            </p>

                            @if($log)

                            @if($log->status == 'taken')

                            <span class="inline-block mt-2 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                ✅ Taken Today
                            </span>

                            @else

                            <span class="inline-block mt-2 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                ❌ Missed Today
                            </span>

                            @endif

                            @endif

                        </div>

                        <div class="flex items-center gap-3">

                            <span
                                class="bg-green-100 text-green-700 px-4 py-2 rounded-full font-semibold">

                                {{ \Carbon\Carbon::parse($schedule->time)->format('h:i A') }}

                            </span>

                            <!-- Taken -->

                            @if(!$log)

                            <!-- Taken Button -->

                            <form
                                action="{{ route('medicine-log.store') }}"
                                method="POST">

                                @csrf

                                <input
                                    type="hidden"
                                    name="medicine_id"
                                    value="{{ $schedule->medicine->id }}">

                                <input
                                    type="hidden"
                                    name="status"
                                    value="taken">

                                <button
                                    type="submit"
                                    class="bg-green-500 text-white px-3 py-2 rounded-lg">

                                    ✓ Taken

                                </button>

                            </form>

                            <!-- Missed Button -->

                            <form
                                action="{{ route('medicine-log.store') }}"
                                method="POST">

                                @csrf

                                <input
                                    type="hidden"
                                    name="medicine_id"
                                    value="{{ $schedule->medicine->id }}">

                                <input
                                    type="hidden"
                                    name="status"
                                    value="missed">

                                <button
                                    type="submit"
                                    class="bg-red-500 text-white px-3 py-2 rounded-lg">

                                    ✗ Missed

                                </button>

                            </form>

                            @endif

                        </div>

                    </div>

                    @empty

                    <div class="text-center py-8">

                        <div class="text-5xl mb-3">
                            📭
                        </div>

                        <p class="text-gray-500">
                            No medicines scheduled for today.
                        </p>

                    </div>

                    @endforelse

                </div>

            </div>

            <!-- Recent Medicines -->
            <div class="mt-8 bg-white rounded-3xl shadow-lg overflow-hidden">

                <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50">
                    <h2 class="text-xl font-bold text-gray-800">
                        💊 Recent Medicines
                    </h2>

                    <span class="text-sm text-gray-500">
                        {{ $recentMedicines->count() }} Records
                    </span>
                </div>

                @if($recentMedicines->count())

                <div class="overflow-x-auto">

                    <table class="min-w-full">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                    Medicine
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                    Description
                                </th>

                                <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-600">
                                    Created
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200 bg-white">

                            @foreach($recentMedicines as $medicine)

                            <tr class="hover:bg-blue-50 transition">

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            💊
                                        </div>

                                        <p class="font-semibold text-gray-800">
                                            {{ $medicine->name }}
                                        </p>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $medicine->description ?: 'No Description' }}
                                </td>

                                <td class="px-6 py-4 text-gray-500">
                                    {{ $medicine->created_at->diffForHumans() }}
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @else

                <div class="p-10 text-center">

                    <div class="text-5xl mb-3">💊</div>

                    <h3 class="text-lg font-semibold text-gray-700">
                        No Medicines Found
                    </h3>

                    <p class="text-gray-500 mt-2">
                        Start by adding your first medicine.
                    </p>

                </div>

                @endif

            </div>

            <!-- Recent Notifications -->
            <div class="mt-8 bg-white rounded-3xl shadow-lg overflow-hidden">

                <div class="bg-orange-500 text-white px-6 py-4">
                    <h2 class="font-semibold text-lg">
                        🔔 Recent Notifications
                    </h2>
                </div>

                <div class="p-6">

                    @forelse($notifications as $notification)

                    <div class="border-l-4 border-orange-500 bg-gray-50 p-4 rounded-lg mb-4">

                        <h4 class="font-semibold text-gray-800">
                            {{ $notification->data['medicine_name'] ?? 'Medicine' }}
                        </h4>

                        <p class="text-gray-600 mt-1">
                            {{ $notification->data['message'] ?? '' }}
                        </p>

                        <small class="text-gray-400">
                            {{ $notification->created_at->diffForHumans() }}
                        </small>

                    </div>

                    @empty

                    <div class="text-center py-6 text-gray-500">
                        No notifications found.
                    </div>

                    @endforelse

                </div>

            </div>

        </div>
    </div>
    ```

</x-app-layout>