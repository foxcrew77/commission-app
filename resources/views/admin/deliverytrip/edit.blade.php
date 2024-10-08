@extends('layouts.admin')
@section('content')
<style>
.option.active {
    font-weight: 600;
    background-color: #f2f2f2;
    border-bottom: 1px solid #eaeaea;
}
.tag:hover, .option:hover {
    background-color: #eaeaea;
}
.error {
    color: #ff1a2a;
    margin-top: 8px;
}
.option-search-tags.input:focus {
    outline: none;
} 
.options {
    display: none;
    z-index: 1;
}
.open .options {
  display: block;
}
.tag {
  cursor: pointer;
}
#options.open {
  display:block;
}
.open {
  display:block;
}
.hide {
  display:none;
}
</style>
          <div class="container px-6 mx-auto grid">
            @component('components.tables.create-title',['item' => 'Delivery Trip'])
            @endcomponent
            <div
              class="px-4 py-4 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            <form action="{{ route('admin.deliverytrip.update',['deliverytrip' => $delivery_trip->slug]) }}" method="post">
                @csrf
              <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Trip Date</span>
                <input
                  class="block mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  name="trip_date"
                  type="date"
                  required
                  value="{{ old('trip_date', $delivery_trip->trip_date) }}"
                  placeholder="Date"
                  x-on:click="open = true"
                  autofocus
                />
              </label>
              <input type="text" id="slug" name="slug" hidden>
              <label class="mt-4 block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Total Weight (KG)</span>
                <input
                  class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Enter weight"
                  name="total_weight"
                  step="any"
                  type="number"
                  value={{ old('total_weight', $delivery_trip->total_weight) }}
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
                >
                
                <option value="" disabled>Please select lorry</option>
                @foreach ($lorries as $lorry)
                    
                <option 
                <?= $lorry->id == old('lorry', $delivery_trip->lorries()->get()[0]->id)  ? 'selected' : ''  ?>
                value="{{ $lorry->id }}">{{ $lorry->plate_no }}
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
                    
                <option 
                <?= $driver->id == old('driver', $delivery_trip->drivers()->get()[0]->id)  ? 'selected' : ''  ?>
                value="{{ $driver->id }}">{{ $driver->name }}
                  
                </option>
                @endforeach
                </select>
              </label>
              {{-- multdropdown for workmen --}}
              <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">
                    Workman
                  </span>
                  {{-- start here --}}
                  <div id="body">
                  <select name="workmen[]" id="workman" multiple>
                    @foreach ($workmen as $workman)
                    @if($workman->position == 'workman')

                      @foreach ($delivery_trip->workmen()->get() as $wm)
                        <option 
                        <?= $workman->id == $wm->id  ? 'selected=true' : ''  ?>
                        value="{{ $workman->id }}">{{ $workman->name }}</option>
                      @endforeach
                    @endif
                    @endforeach

                    <option value="driver">Driver</option>

                    @foreach ($workmen as $workman)
                    @if($workman->position == 'driver')
                      
                      @foreach ($delivery_trip->workmen()->get() as $d)
                        <option 
                        <?= $workman->id == $d->id  ? 'selected=true' : ''  ?>
                        value="{{ $workman->id }}">{{ $workman->name }}</option>
                      @endforeach

                    @endif
                    @endforeach
                </select>
              </div>
              </label>
            </div>
              @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.deliverytrip.index'])
              @endcomponent
          </form>
              {{-- <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script> --}}
              <script src="{{ asset("assets/js/multi-select-tag.js") }}" ></script>
              <script>
                // new MultiSelectTag('countries')  // id
                new MultiSelectTag('workman', {
                  rounded: true,    // default true
                  shadow: true,      // default false
                  placeholder: 'Search',  // default Search...
                  tagColor: {
                      textColor: '#327b2c',
                      borderColor: '#92e681',
                      bgColor: '#eaffe6',
                  },
                  onChange: function(values) {
                      console.log(values)
                  }
                })
                
                
              </script>

    @endsection



