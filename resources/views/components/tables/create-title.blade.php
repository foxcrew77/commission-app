<div class="flex">
    <h2
    class="mt-2 mb-2 text-2xl font-semibold text-gray-700 dark:text-gray-200"
    >
    Add New {{ $item }}
    </h2>
</div>
<div class="w-10/12 z-4 mb-2">
     @if(session()->has('failed'))
        @component('components.failed-add',['message' => session ('failed')])
        @endcomponent
     @endif
</div>