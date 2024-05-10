@extends('layouts.admin')
@section('content')
          <div class="container px-6 mx-auto grid">
            @component('components.tables.create-title',['item' => 'Delivery Trip'])
            @endcomponent
            <div
              class="px-4 py-2 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Trip Date</span>
                <input
                  class="block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  name="trip_date"
                  type="date"
                  required
                  value="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                  placeholder="Date"
                  x-on:click="open = true"
                  autofocus
                />
              </label>
              <label class="mt-4 block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Total Weight (KG)</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Enter weight"
                  name="total_weight"
                  step="any"
                  type="number"
                  {{ old('total_weight') }}
                  required
                />
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Lorry
                </span>
                <select
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  name="lorry"
                  required
                  {{ old('lorry') }}
                >
                <option value="" selected disabled>Please select lorry</option>
                @foreach ($lorries as $lorry)
                    
                <option value="{{ $lorry->plate_no }}">
                    {{ $lorry->plate_no }}
                </option>
                @endforeach
                </select>
              </label>
              </label>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Driver
                </span>
                <select
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  name="driver"
                  required
                >
                <option value="" selected disabled>Please select driver</option>
                @foreach ($drivers as $driver)
                    
                <option value="{{ $driver->name }}">{{ $driver->name }}
                  {{ old('driver') == $driver->name ? 'checked' : ''  }}
                </option>
                @endforeach
                </select>
              </label>
            </div>
            @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.lorry.index'])
            @endcomponent
          </div>
@endsection





