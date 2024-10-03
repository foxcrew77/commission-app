@extends('layouts.admin')
@section('content')
          <div class="container px-6 mx-auto grid">
            @component('components.tables.create-title',['item' => 'Edit Lorry'])
            @endcomponent
            <form action="{{ route('admin.lorry.update',['lorry' => $lorry->slug]) }}" method="post">
            {{-- <form action="/dashboard/lorry/{{ $lorry->slug }}" method="post"> --}}
              @csrf
              @method('put')
            @csrf
            <div
            class="px-4 py-2 bg-white rounded-lg shadow-md dark:bg-gray-800"
          >
            <label class="block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Plate Number</span>
              <input
              id="plate_no"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input
                @error('plate_no')
                outline-red-400
                @enderror  
                "
              
                placeholder="Enter plate number here"
                name="plate_no"
                autofocus
                value="{{ old('plate_no', $lorry->plate_no) }}"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
              />
            </label>
            <input hidden
            value="{{ old('slug', $lorry->slug) }}"
            type="text" id="slug" name="slug">
            <label class="mt-4 block text-sm">
              <span class="text-gray-700 dark:text-gray-400">Capacity</span>
              <input
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Enter capacity"
                name="capacity"
                type="number"
                value="{{ old('capacity', $lorry->capacity) }}"
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
                    {{ $lorry->outlet == 'KKIP' ? 'checked' : ''}}
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
                    {{ $lorry->outlet == 'KK2' ? 'checked' : ''}}
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
                    {{ $lorry->outlet == 'JB' ? 'checked' : ''}}
                  />
                  <span class="ml-2">JB</span>
                </label>
              </div>
            </div>

            <label class="mt-4 text-sm">
              <span class="text-gray-700 dark:text-gray-400">
                Status
              </span>
              <select
                class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                name="status"
              >
                <option 
                {{ $lorry->status == 'ACTIVE' ? 'selected' : ''}} 
                value="ACTIVE">ACTIVE</option>
                <option 
                {{ $lorry->status == 'INACTIVE' ? 'selected' : ''}}
                value="INACTIVE">INACTIVE</option>
              </select>
            </label>
          </div>
          @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.lorry.index'])
          @endcomponent
        </form>
          </div>
          <script>
            const plate_no = document.querySelector('#plate_no');
            const slug = document.querySelector('#slug');
            
            plate_no.addEventListener("keyup", function() {
                    let preslug = plate_no.value;
                    preslug = preslug.replace(/ /g,"");
                    slug.value = preslug.toLowerCase();
                });

        </script>
@endsection





