<div class="flex flex-row">
    <a href="{{ url()->route($IndexRoute) }}">
        <button class="mr-4 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded-lg shadow transition-colors duration-150">
            Cancel
          </button>
    </a>
      <button
          class="flex flex-row px-4 py-1 text-sm font-semibold leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
          {{-- <div class="flex flex-row"> --}}
              <i data-feather="save" class="mt-1"></i>  
              <span class="mt-2">&nbsp;Save</span>
          {{-- </div> --}}
      </button>
  </div>