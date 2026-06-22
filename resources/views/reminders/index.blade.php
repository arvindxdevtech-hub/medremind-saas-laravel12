<x-app-layout>

  <div class="p-8">

    <h1 class="text-3xl font-bold mb-6">
      Upcoming Reminders
    </h1>

    <div class="bg-white rounded-xl shadow overflow-hidden">

      <table class="w-full">

        <thead class="bg-indigo-600 text-white">

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

          @foreach($reminders as $reminder)

          <tr class="border-b">

            <td class="p-4">
              💊
              {{ $reminder->schedule->medicine->name }}
            </td>

            <td class="p-4">
              {{ $reminder->schedule->day }}
            </td>

            <td class="p-4">
              {{ $reminder->reminder_time }}
            </td>

            <td class="p-4">

              @if($reminder->status == 'pending')

              <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">
                Pending
              </span>

              @else

              <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">
                Sent
              </span>

              @endif

            </td>

          </tr>

          @endforeach

        </tbody>

      </table>

    </div>

  </div>

</x-app-layout>