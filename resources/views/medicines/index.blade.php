<x-app-layout>

  <div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">

      <h1 class="text-3xl font-bold">
        💊 Medicines
      </h1>

    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-4">
      {{ session('success') }}
    </div>
    @endif

    <!-- Add Medicine -->

    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">

      <h2 class="text-xl font-semibold mb-4">
        Add New Medicine
      </h2>

      <form method="POST" action="{{ route('medicines.store') }}">
        @csrf

        <div class="grid md:grid-cols-2 gap-4">

          <input
            type="text"
            name="name"
            placeholder="Medicine Name"
            class="border rounded-lg p-3">

          <input
            type="text"
            name="description"
            placeholder="Description"
            class="border rounded-lg p-3">

        </div>

        <button
          type="submit"
          class="mt-4 bg-blue-600 text-white px-6 py-3 rounded-lg">

          Save Medicine

        </button>

      </form>

    </div>

    <!-- Medicines Table -->

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

      <div class="px-6 py-4 border-b">
        <h2 class="text-xl font-semibold">
          Medicine List
        </h2>
      </div>

      <table class="w-full">

        <thead class="bg-gray-100">

          <tr>
            <th class="p-4 text-left">Name</th>
            <th class="p-4 text-left">Description</th>
            <th class="p-4 text-left">Created</th>
            <th class="p-4 text-center">Actions</th>
          </tr>

        </thead>

        <tbody>

          @forelse($medicines as $medicine)

          <tr class="border-b hover:bg-gray-50">

            <td class="p-4 font-semibold">
              💊 {{ $medicine->name }}
            </td>

            <td class="p-4">
              {{ $medicine->description }}
            </td>

            <td class="p-4 text-gray-500">
              {{ $medicine->created_at->diffForHumans() }}
            </td>

            <td class="p-4 text-center">

              <a href="{{ route('medicines.edit', $medicine) }}"
                class="bg-yellow-500 text-white px-3 py-2 rounded">

                Edit

              </a>

              <form
                action="{{ route('medicines.destroy', $medicine) }}"
                method="POST"
                class="inline">

                @csrf
                @method('DELETE')

                <button
                  onclick="return confirm('Delete this medicine?')"
                  class="bg-red-600 text-white px-3 py-2 rounded">

                  Delete

                </button>

              </form>

            </td>

          </tr>

          @empty

          <tr>
            <td colspan="4" class="p-6 text-center text-gray-500">
              No Medicines Found
            </td>
          </tr>

          @endforelse

        </tbody>

      </table>

    </div>

  </div>

</x-app-layout>