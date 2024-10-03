@extends('layouts.admin')
@section('content')
          <div class="container px-6 mx-auto grid">
            @component('components.tables.create-title',['item' => 'Add New Workman'])
            @endcomponent
            <form action="{{ route('admin.workman.update',['workman' => $workman->slug]) }}" method="post">
              @csrf
              @method('put')
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
                  value="{{ old('name', $workman->name) }}"
                  required
                  autofocus
                />
              </label>
              <input hidden
              value="{{ old('slug', $workman->slug) }}"
              type="text" id="slug" name="slug">
              <input type="text" id="asWorkman_id" name="asWorkman_id" value=0 hidden>
              <input type="text" id="position" name="position" value="workman" hidden>
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
                      {{ $workman->outlet == 'KKIP' ? 'checked' : ''}}
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
                      {{ $workman->outlet == 'KK2' ? 'checked' : ''}}
                      
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
                      {{ $workman->outlet == 'JB' ? 'checked' : ''}}
                    />
                    <span class="ml-2">JB</span>
                  </label>
                </div>
              </div>
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Status
                </span>
                <select
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  name="status"
                >
                  <option
                  {{ $workman->status == 'ACTIVE' ? 'selected' : ''}}
                  value="ACTIVE">ACTIVE</option>
                  <option
                  {{ $workman->status == 'INACTIVE' ? 'selected' : ''}}
                  value="INACTIVE">INACTIVE</option>
                </select>
              </label>
            </div>
            @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.workman.index'])
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





