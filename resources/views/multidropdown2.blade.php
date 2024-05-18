<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mistral UI Example</title>
  </head>
  <body class="bg-neutral-100 h-screen grid place-content-center">

    <!-- Example Code -->
        
        <div x-data="{
                options: [],
                selected: null,
                open: false,
                filter: '',
                async retriveData(){
                  {{-- this.options = await (await fetch('http://commission-app.test/workmendropdown')).json(); --}}
                }
            }" 
            x-init="retriveData()"
            class="w-full relative">
            <div @click="open = !open" class="p-3 rounded-lg flex gap-2 w-full border border-neutral-300 cursor-pointer truncate h-12 bg-white" x-text="options.length + ' items selected'">
            </div>
            <div class="p-3 rounded-lg flex gap-3 w-full shadow-lg x-50 absolute flex-col bg-white mt-3" x-show="open" x-trap="open" @click.outside="open = false" @keydown.escape.window="open = false" x-transition:enter=" ease-[cubic-bezier(.3,2.3,.6,1)] duration-200" x-transition:enter-start="!opacity-0 !mt-0" x-transition:enter-end="!opacity-1 !mt-3" x-transition:leave=" ease-out duration-200" x-transition:leave-start="!opacity-1 !mt-3" x-transition:leave-end="!opacity-0 !mt-0">
                <input x-model="filter" placeholder="filter" class="border-b outline-none p-3 -mx-3 pt-0" type="text">
                <p x-show="! $el.parentNode.innerText.toLowerCase().includes(filter.toLowerCase())" class="text-neutral-400 text-center font-bolc text-2xl">
                    –
                </p>
                {{-- <select x-model="selectedCountry">
                  <template x-for="option in options">
                    <option :value="" x-text="option"></option>
                  </template>
                </select> --}}
                {{-- <ul x-data="options">
                  <template x-for="option in options">
                      <li x-text="option.label"></li>
                  </template>
              </ul> --}}
              {{-- <template x-for="option in options"> --}}
                @foreach ($workmenDropdown as $workman)
                    
                <div x-show="$el.innerText.toLowerCase().includes(filter.toLowerCase())" class="flex items-center">
                  <input x-model="options" id="{{ $workman->slug }}" type="checkbox" value="{{ $workman->slug }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                  <label for="{{ $workman->slug }}" x-text="" class="ml-2 text-sm font-medium text-gray-900 flex-grow">{{ $workman->name }}</label>
                </div>
                @endforeach

              {{-- </template> --}}
                {{-- <div x-show="$el.innerText.toLowerCase().includes(filter.toLowerCase())" class="flex items-center">
                    <input x-model="options" id="tom" type="checkbox" value="tom" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label for="tom" class="ml-2 text-sm font-medium text-gray-900 flex-grow">Tom</label>
                </div>
                <div x-show="$el.innerText.toLowerCase().includes(filter.toLowerCase())" class="flex items-center">
                    <input x-model="options" id="john" type="checkbox" value="john" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label for="john" class="ml-2 text-sm font-medium text-gray-900 flex-grow">John</label>
                </div> --}}
            </div>
        </div>
        
    <!-- End Example Code -->

    <!-- Alpine Plugins -->
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Alpine Core -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script defer src="https://cdn.tailwindcss.com"></script>
   
  </body>
</html>