<x-app-layout>

  <div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-2xl shadow-lg p-6">

      <h1 class="text-2xl font-bold mb-6">
        Edit Medicine
      </h1>

      <form
        method="POST"
        action="{{ route('medicines.update', $medicine) }}">

        @csrf
        @method('PUT')

        <input
          type="text"
          name="name"
          value="{{ $medicine->name }}"
          class="border rounded-lg p-3 w-full mb-4">

        <textarea
          name="description"
          class="border rounded-lg p-3 w-full mb-4">{{ $medicine->description }}</textarea>

        <button
          type="submit"
          class="bg-blue-600 text-white px-6 py-3 rounded-lg">

          Update Medicine

        </button>

      </form>

    </div>

  </div>

</x-app-layout>