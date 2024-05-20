@extends('layouts.admin')
@section('content')
          <div class="container px-6 mx-auto grid">
            @component('components.tables.create-title',['item' => 'Delivery Trip'])
            @endcomponent
            <div
              class="px-4 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800"
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
              {{-- multidropdown for workmen --}}
              {{-- <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                  Workman
                </span>
                <select
                  class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                  name="workman[]"
                  required
                >
                <option value="" selected disabled>Please select workman</option>
                <optgroup label="Workman">
                @foreach ($workmen as $workman)
                    
                <option value="{{ $workman->name }}">{{ $workman->name }}
                  {{ old('driver') == $workman->name ? 'checked' : ''  }}
                </option>
                @endforeach
                </optgroup>
                <optgroup label="Driver">
                    @foreach ($drivers as $driver)
                        
                    <option value="{{ $driver->name }}">{{ $driver->name }}
                      {{ old('driver') == $driver->name ? 'checked' : ''  }}
                    </option>
                    @endforeach
                    </optgroup>
                </select>
              </label> --}}
              {{-- multidropdown for workmen --}}

              {{-- multdropdown for workmen --}}
              <div class="custome-select open">
                <div class="select-box">
                    <input type="text" class="tags_input" name="tags" hidden>
                    <div class="selected-options">
                        <span class="tag">Black<span class="remove-tag">&times;</span></span>
                        <span class="tag">White<span class="remove-tag">&times;</span></span>
                        <span class="tag">Green<span class="remove-tag">&times;</span></span>
                        <span class="tag">Orange<span class="remove-tag">&times;</span></span>
                    </div>
                    <div class="arrow">
                        <i data-feather="chevron-down" class=""></i>  
                    </div>
                </div>
                <div class="options">
                    <div class="option-search-tags">
                        <input type="text" class="search-tags"
                        placeholder="search tags"/>
                        <button type="button" class="clear"><i data-feather="x-square" class=""></i></button>
                    </div>
                    <div class="option all-tags"
                    data-value="All">Select All</div>
                    <div class="option active" data-value="Black">Black</div>
                    <div class="option active" data-value="White">White</div>
                    <div class="option active" data-value="Green">Green</div>
                    <div class="option active" data-value="Orange">Orange</div>
                    <div class="option" data-value="Yellow">Yellow</div>
                    <div class="option" data-value="Red">Red</div>
                    <div class="option" data-value="Purple">Purple</div>
                    <div class="option" data-value="">No result match</div>
                </div>
                <span class="tag_error_msg error">This field is required</span>
              </div>
              <input type="button" class="btn_submit" value="submit" />
              {{-- https://www.youtube.com/watch?v=MyJx3Fj1tWc --}}
              {{-- multdropdown for workmen --}}
            </div>
            @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.lorry.index'])
            @endcomponent
          </div>
          
          {{-- <script defer>

            // ESC keystroke to clear search
            document.onkeydown = function(e){
            e = e || window.event;
            keycode = e.which || e.keyCode;
            if(keycode == 27){      // '13' is the keycode for "enter"
                e.preventDefault();
                clear();
             }
            }
            // DEL keystroke to reset search
            document.onkeydown = function(e){
            e = e || window.event;
            keycode = e.which || e.keyCode;
            if(keycode == 46){      // '13' is the keycode for "enter"
                e.preventDefault();
                clear();
             }
            }
        </script> --}}
@endsection





