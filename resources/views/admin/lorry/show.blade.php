@extends('layouts.admin')
@section('content')
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Forms
            </h2>

            <!-- General elements -->
            <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Elements
            </h4>
            <div
              class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <div class="w-full overflow-visible rounded-lg shadow-xs">
                <div class="w-full overflow-x-auto">
                   
                        <p class="w-24 px-4 py-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Plate Number</p>
                        <p class="w-40 px-4 py-3 text-sm bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-gray-600 dark:text-gray-400">{{ $lorry->plate_no }}</p>
                  
                        <p class="w-24 px-4 py-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Capacity</p>
                        <p class="w-40 px-4 py-3 text-sm bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-gray-600 dark:text-gray-400">{{ $lorry->capacity }}</p>
                  
                        <p class="w-24 px-4 py-3 text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Outlet</p>
                        <p class="w-40 px-4 py-3 text-sm bg-white divide-y dark:divide-gray-700 dark:bg-gray-800 text-gray-600 dark:text-gray-400">{{ $lorry->outlet }}</p>
                    
                </div>
                {{-- {{ $lorries->links() }} --}}
            </div> 

            
          </div>
@endsection
