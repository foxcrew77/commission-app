<div class="flex ">
    <div class="mr-24">
        <h2 class="mt-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            {{ $title }} list
        </h2>
    </div>
    {{-- @if(session()->has('success')) --}}
    <div class="w-64 mt-2">
        @component('components.success-add',['message' => session('success')])
        @endcomponent
    </div>
    
    {{-- @endif --}}
</div>