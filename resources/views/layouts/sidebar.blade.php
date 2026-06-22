<div class="w-64 bg-slate-900 text-white min-h-screen fixed">

  <div class="p-6 border-b border-slate-700">
    <h2 class="text-2xl font-bold">
      💊 MedRemind
    </h2>
  </div>

  <nav class="mt-6">

    <a href="{{ route('dashboard') }}"
      class="block px-6 py-3 rounded-lg mx-2
{{ request()->routeIs('dashboard')
? 'bg-blue-600 text-white'
: 'hover:bg-slate-800' }}">
      📊 Dashboard
    </a>

    <a href="{{ route('medicines.index') }}"
      class="block px-6 py-3 rounded-lg mx-2
{{ request()->routeIs('medicines.*')
? 'bg-blue-600 text-white'
: 'hover:bg-slate-800' }}">
      💊 Medicines
    </a>

    <a href="{{ route('schedules.index') }}"
      class="block px-6 py-3 rounded-lg mx-2
{{ request()->routeIs('schedules.*')
? 'bg-blue-600 text-white'
: 'hover:bg-slate-800' }}">
      ⏰ Schedules
    </a>


    <a href="{{ route('reminders.index') }}"
      class="block px-6 py-3 rounded-lg mx-2
{{ request()->routeIs('reminders.index')
? 'bg-blue-600 text-white'
: 'hover:bg-slate-800' }}">
      ⏰ Upcoming Reminders
    </a>

    <a href="{{ route('reminders.history') }}"
      class="block px-6 py-3 rounded-lg mx-2
{{ request()->routeIs('reminders.history')
? 'bg-blue-600 text-white'
: 'hover:bg-slate-800' }}">
      📜 Reminder History
    </a>

    <a href="{{ route('notifications.index') }}"
      class="block px-6 py-3 rounded-lg mx-2
{{ request()->routeIs('notifications.index')
? 'bg-blue-600 text-white'
: 'hover:bg-slate-800' }}">
      <div class="flex justify-between items-center">

        <span>
          🔔 Notifications
        </span>

        <span
          class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">

          {{ auth()->user()->unreadNotifications()->count() }}

        </span>

      </div>
    </a>

    <a href="{{ route('profile.edit') }}"
      class="block px-6 py-3 hover:bg-slate-800">
      👤 Profile
    </a>

    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <button
        type="submit"
        class="w-full text-left px-6 py-3 hover:bg-red-600">
        <div class="flex items-center gap-3">
          <span>🚪</span>
          <span>Logout</span>
        </div>
      </button>
    </form>

  </nav>

</div>