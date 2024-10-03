<div class="my-4 mt-2 flex sm:flex-row justify-between focus-within:text-purple-500">
    <form class="form-inline" method="GET">
    <div class="flex  sm:flex-row">
        <div class="flex flex-row mb-2 sm:mb-0">
            {{-- {{ dd($lorryFilter) }} --}}
            <div class="flex flex-row mb-2 sm:mb-0 ">
                <input type="date"
                class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                name="trip_date"
                >
            </div>
            <div class="relative">
                <select
                    id="lorryFilter"
                    class="w-full text-sm font-semibold text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    name="lorry"
                    >
                    <option selected value="">Lorry</option>
                    @foreach ($lorryFilter as $lorry)
                        <option value="{{ $lorry->id }}">{{ $lorry->plate_no }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex flex-row mb-2 sm:mb-0">
            <div class="relative">
                <select
                    id="driverFilter" 
                    class="w-full font-semibold text-sm text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    name="driver"
                    >
                    <option selected value="">Driver</option>
                    @foreach ($driverFilter as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex flex-row mb-2 sm:mb-0">
            <div class="relative">
                <select
                    id="workmenFilter" 
                    class="w-full font-semibold text-sm text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    name="workmen"
                    >
                    <option selected value="">Workman</option>
                    @foreach ($workmenFilter as $workman)
                        <option value="{{ $workman->id }}">{{ $workman->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex flex-row mb-2 sm:mb-0">
            <div class="relative">
                <select
                    id="outlet" 
                    class="w-full font-semibold text-sm text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    name="outlet"
                    >
                    <option selected value="">Outlet</option>
                    <option value="KKIP">KKIP</option>
                    <option value="KK2">KK2</option>
                </select>
            </div>
        </div>
        <div class="block relative text-purple-500">
            <input 
            id="searchBar"
            class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
            type="text"
            placeholder="Filter by weight "
            aria-label="Search" 
            name="total_weight"
            value="{{ request()->input('filter') }}"
            />
        </div>
        <button
                    class="ml-2 px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                    style="height:38px;"
            >
                <i data-feather="search" class="" style="width:16px;height:16px;"></i>
        </button>
        {{-- <a href="{{ request()->input('filter') }}">
            <button class="ml-2 bg-white hover:bg-gray-100 text-gray-800 font-medium text-sm py-2 px-2 border border-gray-400    rounded-lg shadow transition-colors duration-150"
            style="height:37px;"
            >
                Reset
            </button>
        </a> --}}
    </div>
        
    </form>
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
@if(session()->has('success'))
<div class="w-10/12 z-4 mb-2">
    @component('components.success-add',['components' => 'success-add', 'message' => session('success')])
    @endcomponent
</div>
@endif
<script>
    window.onload = function() {
        const fieldOption = document.getElementById('filterBy');
        document.getElementById('searchBar').placeholder = 'Filter by ' + fieldOption.options[fieldOption.selectedIndex].text;
    document.getElementById('filterBy').addEventListener('click', function() {
        const fieldOption = document.getElementById('filterBy');
        const status = document.getElementById('statusFilter').text;
        const newPlaceholder =  fieldOption.options[fieldOption.selectedIndex].text;
        document.getElementById('searchBar').placeholder = 'Filter by '+ newPlaceholder;
    })
}
</script>