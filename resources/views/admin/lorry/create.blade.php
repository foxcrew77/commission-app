@extends('layouts.admin')
@section('content')
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Add New Lorry
            </h2>
            <!-- General elements -->
            {{-- <h4
              class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
              Elements
            </h4> --}}
            <div
              class="px-4 py-2 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Plate Number</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Enter plate number here"
                  name="name"
                  required
                />
              </label>
              <label class="mt-4 block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Capacity</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Enter capacity"
                  name="capacity"
                  type="number"
                  required
                />
              </label>
            

              <div class="mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Outlet
                </span>
                <div class="mt-2">
                  <label
                    class="inline-flex items-center text-gray-600 dark:text-gray-400"
                  >
                    <input
                      type="radio"
                      class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                      name="outlet"
                      value="KKIP"
                      required
                    />
                    <span class="ml-2">KKIP</span>
                  </label>
                  <label
                    class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400"
                  >
                    <input
                      type="radio"
                      class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                      name="outlet"
                      value="KK2"
                    />
                    <span class="ml-2">KK2</span>
                  </label>
                  <label
                    class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400"
                  >
                    <input
                      type="radio"
                      class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                      name="outlet"
                      value="JB"
                    />
                    <span class="ml-2">JB</span>
                  </label>
                </div>
              </div>

              <label class="mt-4 text-sm hidden">
                <span class="text-gray-700 dark:text-gray-400">
                  Status
                </span>
                <select
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  name="status"
                >
                  <option selected value="ACTIVE">ACTIVE</option>
                  <option value="INACTIVE">INACTIVE</option>
                </select>
              </label>
            </div>
            
            @include('includes.save-cancel-button',['IndexRoute' => 'admin.lorry.index'])
          </div>
@endsection





