@extends('layouts.admin')
@section('content')
<style>
.optionWM.active {
    font-weight: 600;
    background-color: #f2f2f2;
    border-bottom: 1px solid #eaeaea;
}
.tag:hover, .optionWM:hover {
    background-color: #eaeaea;
}
.error {
    color: #ff1a2a;
    margin-top: 8px;
}
.option-search-tags.input:focus {
    outline: none;
} 
/* .open .options {
    display: block;
} */
</style>
          <div class="container px-6 mx-auto grid">
            @component('components.tables.create-title',['item' => 'Delivery Trip'])
            @endcomponent
            <div
              class="px-4 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <form action="{{ route('admin.deliverytrip.store') }}" method="post">
                @csrf
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
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Workman
                  </span>
              <div class="multiselectcontainer flex items-start gap-20" name="workmen[]">
                <div class="custom-select relative w-full">
                    <div class="select-box bg-white border rounded bg-neutral-100 flex flex-row justify-between items-center px-10
                    
                    ">
                        <input type="text" class="tags_input" name="search" hidden>
                        <div class="flex flex-wrap mt-2 mb-2"> {{-- selected-options  --}}
                            <button onclick="myFunction()" id="tag" class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">Black<button class="ml-4 cursor-pointer">&times;</button></button>
                            <span class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">White<button class="ml-4 cursor-pointer">&times;</button></span>
                            <span class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">Green<button class="ml-4 cursor-pointer">&times;</button></span>
                            <span class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">Orange<button class="ml-4 cursor-pointer">&times;</button></span>
                        </div>
                        <div class="arrow mx-10">
                            <i data-feather="chevron-down" style="stroke: gray; stroke-width:2; width:16px;height:16px" ></i>  
                        </div>
                    </div>
                    <div id="open" class="open absolute w-full bg-white border-black max-h-56 z-10 shadow-md " style="max-height:170px; overflow-y: auto; z-index:1">
                        <div class="option-search-tags bg-white border border-gray-400 mt-2 py-2">
                            <input type="text" class="search-tags w-full border-0 px-2 text-sm
                            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray
                            "
                            placeholder="Search workman..."/>
                            <button type="button" class="clear absolute border-0 bg-transparent px-0 py-0" style="left:auto;right:10px"><i data-feather="x-square" style="stroke: black; stroke-width:1; width:24px;height:24px" ></i></button>
                        </div>
                        <div style="cursor: default;" class="px-4 optionWM active:text-black active:bg-gray-400 active" data-value="Black">Black</div>
                        <div style="cursor: default;" class="px-4 optionWM active:text-black active:bg-gray-400 active" data-value="White">White</div>
                        <div style="cursor: default;" class="px-4 optionWM active:text-black active:bg-gray-400 active" data-value="Green">Green</div>
                        <div style="cursor: default;" class="px-4 optionWM active:text-black active:bg-gray-400 active" data-value="Orange">Orange</div>
                        <div style="cursor: default;" class="px-4 optionWM active:text-black active:bg-gray-400" data-value="Yellow">Yellow</div>
                        <div style="cursor: default;" class="px-4 optionWM active:text-black active:bg-gray-400" data-value="Red">Red</div>
                        <div style="cursor: default;" class="px-4 optionWM active:text-black active:bg-gray-400" data-value="Purple">Purple</div>
                        <div style="cursor: default; display:none;" class="px-4 py-4 optionWM" data-value="">No result match</div>
                    </div>
                    <span class="tag_error_msg error hidden">This field is required</span>
                  </div>
                </label>
                  {{-- <input type="button" class="btn_submit" value="submit" /> --}}
              </div>
              {{-- https://www.youtube.com/watch?v=MyJx3Fj1tWc --}}
              {{-- multdropdown for workmen --}}
            </div>
            @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.lorry.index'])
        </form>
            @endcomponent
          </div>
          
          <script defer>
            //testing change class name
            function myFunction() {
                var element = document.getElementById("open");
                element.classList.add("hidden");
            }
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
        </script>
@endsection





