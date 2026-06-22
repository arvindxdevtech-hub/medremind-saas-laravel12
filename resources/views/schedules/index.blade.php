<x-app-layout>

  <div class="max-w-7xl mx-auto p-6">

    <h1 class="text-3xl font-bold mb-6">
      ⏰ Medicine Schedules
    </h1>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
      {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow p-6 mb-8">

      <form method="POST"
        action="{{ route('schedules.store') }}">

        @csrf

        <div class="grid md:grid-cols-3 gap-4">

          <select
            name="medicine_id"
            class="border rounded-lg p-3">

            <option>
              Select Medicine
            </option>

            @foreach($medicines as $medicine)

            <option value="{{ $medicine->id }}">
              {{ $medicine->name }}
            </option>

            @endforeach

          </select>

          <select
            name="day"
            class="border rounded-lg p-3">

            <option>Monday</option>
            <option>Tuesday</option>
            <option>Wednesday</option>
            <option>Thursday</option>
            <option>Friday</option>
            <option>Saturday</option>
            <option>Sunday</option>

          </select>

          <input
            type="time"
            name="time"
            class="border rounded-lg p-3">

        </div>

        <button
          class="mt-4 bg-blue-600 text-white px-6 py-3 rounded-lg">

          Save Schedule

        </button>

      </form>

    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

      <table class="w-full">

        <thead class="bg-slate-800 text-white">

          <tr>
            <th class="p-4 text-left">
              Medicine
            </th>

            <th class="p-4 text-left">
              Day
            </th>

            <th class="p-4 text-left">
              Time
            </th>

            <th class="p-4 text-center">
              Action
            </th>
          </tr>

        </thead>

        <tbody>

          @foreach($schedules as $schedule)

          <tr class="border-b">

            <td class="p-4">
              {{ $schedule->medicine->name }}
            </td>

            <td class="p-4">
              {{ $schedule->day }}
            </td>

            <td class="p-4">
              {{ $schedule->time }}
            </td>

            <td class="p-4 text-center">

              <form
                action="{{ route('schedules.destroy',$schedule) }}"
                method="POST">

                @csrf
                @method('DELETE')

                <button
                  class="bg-red-600 text-white px-4 py-2 rounded">

                  Delete

                </button>

              </form>

            </td>

          </tr>

          @endforeach

        </tbody>

      </table>

    </div>

  </div>

</x-app-layout>