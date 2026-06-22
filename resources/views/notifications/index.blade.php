<x-app-layout>

  <div class="p-6">

    <h2 class="text-2xl font-bold mb-4">
      Notifications
    </h2>
    <form action="{{ route('notifications.readAll') }}" method="POST">
      @csrf

      <button
        type="submit"
        class="bg-green-500 text-white px-4 py-2 rounded">
        Mark All Read
      </button>
    </form>

    @foreach($notifications as $notification)

    <div class="border p-4 mb-3 rounded">

      <strong>
        {{ $notification->data['medicine_name'] }}
      </strong>

      <br>

      {{ $notification->data['message'] }}

      <br>

      {{ $notification->created_at->diffForHumans() }}

      @if(is_null($notification->read_at))

      <form
        action="{{ route('notifications.read', $notification->id) }}"
        method="POST"
        class="mt-2">
        @csrf

        <button
          type="submit"
          class="bg-blue-500 text-white px-3 py-1 rounded">
          Mark As Read
        </button>

      </form>

      @else

      <span class="text-green-600">
        Read
      </span>

      @endif

    </div>

    @endforeach

  </div>

</x-app-layout>