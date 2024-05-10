<div class="flex">
    <h2
    class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
    >
    Add New {{ $item }}
    </h2>
    {{-- @if(session()->has('failed')) --}}
    @component('components.failed-add',['message' => session ('failed')])
    @endcomponent
    {{-- @endif --}}
  </div>