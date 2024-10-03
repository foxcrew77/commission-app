@extends('layouts.admin')
@section('content')
          <div class="container px-6 mx-auto grid">
            @component('components.tables.create-title',['item' => 'Add New Driver'])
            @endcomponent
            <form action="{{ route('admin.driver.store') }}" method="post">
              @csrf
              <div
              class="px-4 py-2 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Name</span>
                <input
                id="name"
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Jane Doe"
                  name="name"
                  value="{{ old('name') }}"
                  required
                  autofocus
                />
              </label>
              <input type="text" id="slug" name="slug" hidden>
              <input type="text" id="position" name="position" value="driver" hidden>
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
                      {{ old('outlet') == 'KKIP' ? 'checked' : ''  }}
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
                      {{ old('outlet') == 'KK2' ? 'checked' : ''  }}
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
                      {{ old('outlet') == 'JB' ? 'checked' : ''  }}
                    />
                    <span class="ml-2">JB</span>
                  </label>
                </div>
              </div>
              <label class="block mt-4 text-sm hidden">
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
            @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.driver.index'])
            @endcomponent
          </div>
        </form>
          <script>
            const name = document.querySelector('#name');
            const slug = document.querySelector('#slug');
            
            name.addEventListener("keyup", function() {
                    let preslug = name.value;
                    preslug = preslug.replace(/ /g,"-");
                    slug.value = preslug.toLowerCase();
                });

        </script>
@endsection





