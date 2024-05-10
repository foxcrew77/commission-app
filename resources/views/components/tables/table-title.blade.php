<div class="flex flex-row">
    <h2 class="mt-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        {{ $title }}
    </h2>
    @if(session()->has('success'))
    @component('components.success-add',['message' => session('success')])
    @endcomponent
    @endif
</div>