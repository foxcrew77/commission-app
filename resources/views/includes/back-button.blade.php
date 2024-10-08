<div class="ml-4 flex justify-between mr-4 items-center space-x-4 text-sm">
    <template x-if="dark">
                <i class="back-icon" style="width:16px;height:16px;stroke-width:4;stroke:#9ca3af;" data-feather="corner-down-left" class="ml-2 my-2"></i> 

            </template>
            <template x-if="!dark">
                <i class="back-icon" style="width:16px;height:16px;stroke-width:4;stroke:#9333ea;" data-feather="corner-down-left" class="ml-2 my-2"></i> 

            </template>
    <a href="{{ url()->route($IndexRoute) }}">
        {{-- <button class="mr-4 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-2 border border-gray-400 rounded-lg shadow transition-colors duration-150"> --}}
            <template x-if="dark">
                <i class="back-icon" style="width:16px;height:16px;stroke-width:4;stroke:#9ca3af;" data-feather="corner-down-left" class="ml-2 my-2"></i> 

            </template>
            <template x-if="!dark">
                <i class="back-icon" style="width:16px;height:16px;stroke-width:4;stroke:#9333ea;" data-feather="corner-down-left" class="ml-2 my-2"></i> 

            </template>
        {{-- </button> --}}
    </a>
    <div class="flex flex-row">
        {{-- <a href="{{ route('admin.lorry.edit',['lorry' => $lorry->slug]) }}"> --}}
        <a href="{{ $route }}">
        <button
        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
        aria-label="Edit">
        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
        viewBox="0 0 20 20"
        >
        <path
        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
            </path>
        </svg>
    </button>
    </a>
    {{-- <form action="{{ route('admin.lorry.destroy',['lorry' => $lorry->slug]) }}" method="post"> --}}
    <form action="{{ $deleteRoute }}" method="post">
        @method('delete')
        @csrf
    <button
    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
    aria-label="Delete"
    onclick="return confirm('Are you sure to delete?')"
    >
    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
    viewBox="0 0 20 20">
    <path fill-rule="evenodd"
    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
    clip-rule="evenodd"></path>
        </svg>
    </button>
    </form>
    </div>
</div>