<x-app-layout>

  <div class="p-8">

    <div class="flex justify-between items-center mb-6">

      <h1 class="text-3xl font-bold">
        Reminder History
      </h1>

      <a href="{{ route('reminders.index') }}"
        class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
        Upcoming Reminders
      </a>

    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

      <div class="bg-green-600 text-white px-6 py-4">
        <h2 class="text-lg font-semibold">
          Sent Reminders
        </h2>
      </div>

      <table class="w-full">

        <thead class="bg-gray-100">

          <tr>

            <th class="p-4 text-left">
              Medicine
            </th>

            <th class="p-4 text-left">
              Day
            </th>

            <th class="p-4 text-left">
              Reminder Time
            </th>

            <th class="p-4 text-left">
              Status
            </th>

          </tr>

        </thead>

        <tbody>

          @forelse($reminders as $reminder)

          <tr class="border-b hover:bg-gray-50">

            <td class="p-4 font-medium">
              💊 {{ $reminder->schedule->medicine->name }}
            </td>

            <td class="p-4">
              {{ $reminder->schedule->day }}
            </td>

            <td class="p-4">
              {{ \Carbon\Carbon::parse($reminder->reminder_time)->format('d M Y h:i A') }}
            </td>

            <td class="p-4">

              <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                Sent
              </span>

            </td>

          </tr>

          @empty

          <tr>

            <td colspan="4"
              class="text-center p-8 text-gray-500">

              No reminder history found.

            </td>

          </tr>

          @endforelse

        </tbody>

      </table>

    </div>

  </div>

</x-app-layout>