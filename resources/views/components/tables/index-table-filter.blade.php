<div class="my-4 mt-2 flex sm:flex-row justify-between focus-within:text-purple-500">
    <div class="flex  sm:flex-row">
        <div class="flex flex-row mb-2 sm:mb-0">
            <div class="relative">
                <select
                    class="w-full text-sm text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                    <option>All</option>
                    <option selected>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
        </div>
        <div class="block relative text-purple-500">
            <input 
            class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
            type="text"
            placeholder="{{ $placeholder }}"
            aria-label="Search" />
        </div>
    </div>
    <div class="w-64">
        @component('components.success-add',['message' => session('success')])
        @endcomponent
    </div>
    <div class="pl-22">
        <a href="{{ route( $createRoute )}}">
            <button
                    class="flex items-center justify-between px-4 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            >
                {{ $addNew }}
                <span class="ml-2" aria-hidden="true">+</span>
        </button>
    </a>
    </div>
</div>