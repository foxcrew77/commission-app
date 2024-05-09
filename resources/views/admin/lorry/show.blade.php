@extends('layouts.admin')
@section('content')
          {{-- <div class="container px-6 mx-auto grid"> --}}
          <div class="container px-6 mx-auto">
              <h2
                class="mt-4 text-2xl font-semibold text-gray-700 dark:text-gray-200"
              >
                {{ $lorry->plate_no }}
              </h2>

              <!-- General elements -->
              <h4
                class="mb-4 mt-2 text-lg font-semibold text-gray-600 dark:text-gray-300"
              >
                Lorry Details
              </h4>
              
              <div
                class="w-full px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
              >
              @include('includes.back-button', ['IndexRoute' => 'admin.lorry.index'])
              <div class="w-auto overflow-visible rounded-lg shadow-xs">
                <div class="w-auto overflow-x-auto">
                  <div class="flex flex-row">
                    <div class="flex flex-col w-64">
                      <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">No.</div>
                      <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Plate Number</div>
                      <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Capacity (KG)</div>
                      <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Outlet</div>
                      <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Created By</div>
                      <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Created At</div>
                      <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Updated At</div>
                    </div>
                    <div class="flex flex-col w-full">
                      <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $lorry->id }}</div>
                      <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $lorry->plate_no }}</div>
                      <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $lorry->capacity }}</div>
                      <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $lorry->outlet }}</div>
                      <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $created_by->name}}</div>
                      <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $lorry->created_at }}</div>
                      <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $lorry->updated_at }}</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
            
          </div>
          
@endsection
