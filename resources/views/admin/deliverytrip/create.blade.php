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

              <div class="flex justify-center mt-8">
                <!-- Define component with preselected options -->
                {{-- <div class="w-full" x-data="alpineMuliSelect({selected:['te_11', 'te_12'], elementId:'multSelect'})"> --}}
                <div class="w-full" x-data="alpineMuliSelect({selected:['te_11', 'te_12'], elementId:'multSelect'})" x-init="workman = await (await fetch('http://commission-app.test/workmendropdown'))">

                    <!-- Select Options -->
                    <select class="hidden" id="multSelect">
                        <option value="te_1" data-search="arsenal">Arsenal</option>
                        <option value="te_2" data-search="aston villa">Aston Villa</option>
                        <option value="te_3" data-search="Brentford">Brentford</option>
                        <option value="te_4" data-search="Brighton">Brighton</option>
                        <option value="te_5" data-search="Burnley">Burnley</option>
                        <option value="te_6" data-search="Chelsea">Chelsea</option>
                        <option value="te_7" data-search="Crystal Palace">Crystal Palace</option>
                        <option value="te_8" data-search="Everton">Everton</option>
                        <option value="te_10" data-search="Leeds">Leeds</option>
                        <option value="te_9" data-search="Leicester">Leicester</option>
                        <option value="te_11" data-search="Liverpool">Liverpool</option>
                        <option value="te_12" data-search="Manchester City">Man City</option>
                        <option value="te_13" data-search="Manchester Utd">Man Utd</option>
                        <option value="te_14" data-search="Newcastle">Newcastle</option>
                        <option value="te_15" data-search="Norwich">Norwich</option>
                        <option value="te_16" data-search="Southampton">Southampton</option>
                        <option value="te_17" data-search="Tottenham Hotspur spurs">Spurs</option>
                        <option value="te_18" data-search="Watford">Watford</option>
                        <option value="te_19" data-search="West Ham">West Ham</option>
                        <option value="te_20" data-search="Wolves">Wolves</option>
                    </select>

                    <div class="w-full flex flex-col items-center h-64 mx-auto" @keyup.alt="toggle">
                        <!-- Selected Teams -->
                        <input name="teams[]" type="hidden" x-bind:value="selectedValues()">

                        <div class="inline-block relative w-full">

                            <div class="flex flex-col items-center relative">

                                <!-- Selected elements container -->
                                <div class="w-full">
                                    <div class="my-2 p-1 flex border border-gray-200 bg-white rounded-md">
                                        <div class="flex flex-auto w-full flex-wrap" x-on:click="open">
                                            <!-- iterating over selected elements -->
                                            <template x-for="(option,index) in selectedElms" :key="option.value">
                                                <div x-show="index < 2"
                                                    class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full text-indigo-700 bg-indigo-100 border border-indigo-300 ">
                                                    <div class="text-xs font-normal leading-none max-w-full flex-initial"
                                                        x-model="selectedElms[option]" x-text="option.text"></div>
                                                    <div class="flex flex-auto flex-row-reverse">
                                                        <div x-on:click.stop="remove(index,option)">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                              </svg>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <!-- More than two items selected -->
                                            <div x-show="selectedElms.length > 2" class="flex justify-center items-center m-1 font-medium py-1 px-2 rounded-full text-indigo-700 bg-indigo-100 border border-indigo-300 ">
                                                <div class="text-xs font-normal h-6 flex justify-center items-center leading-none max-w-full flex-initial">
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-indigo-200 text-pink-800 mr-2">
                                                        <span x-text="selectedElms.length -2"></span>
                                                    </span>
                                                    more selected
                                                </div>
                                            </div>
                                            <!-- None items selected -->
                                            <div x-show="selectedElms.length == 0" class="flex-1">
                                                <input placeholder="Select workman" class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800" x-bind:value="selectedElements()">
                                            </div>
                                        </div>
                                        {{-- button turun dropdown --}}
                                        <!-- Drop down toogle with icons--> 
                                        <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200">
                                            <button type="button" x-show="!isOpen()" x-on:click="open()" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                                  </svg>
                                            </button>
                                            <button type="button" x-show="isOpen()" x-on:click="close()" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                                                  </svg>                                  
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Dropdown container -->
                                <div class="w-full">
                                    <div x-show.transition.origin.top="isOpen()" x-trap="isOpen()" class="absolute shadow-lg top-100 bg-white z-40 w-full lef-0 rounded max-h-80" x-on:click.away="close">
                                        <div class="flex flex-col w-full">

                                            <div class="px-2 py-4 border-b-2">
                                                <!-- Search input-->
                                                <div class="w-1/2 mt-1 relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                        </svg>
                                                    </div>
                                                    <input type="text" name="search" autocomplete="off" id="search" x-model.debounce.750ms="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 py-1 sm:text-sm border border-indigo-300 rounded-md h-10" placeholder="" @keyup.escape="clear"
                                                        @keyup.delete="deselect">
                                                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                                                        <kbd class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400 mr-2" x-on:click="clear">
                                                            Clear Search (ESC)
                                                        </kbd>
                                                        <kbd class="inline-flex items-center border border-gray-200 rounded px-2 text-sm font-sans font-medium text-gray-400" x-on:click="deselect">
                                                            Reset (DEL)
                                                        </kbd>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Options container -->
                                            <ul class="z-10 mt-0 w-full bg-white shadow-lg max-h-80 rounded-md py-0 text-base ring-1 ring-black ring-opacity-5 focus:outline-none  overflow-y-auto sm:text-sm" tabindex="-1" role="listbox" @keyup.delete="deselect">
                                                <template x-for="(option,index) in options" :key="option.text">
                                                    <li class="text-gray-900 cursor-default select-none relative py-2 pl-3 pr-3"
                                                        role="option">
                                                        <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-slate-100"
                                                            x-bind:class="option.selected ? 'bg-indigo-100' : ''"
                                                            @click="select(index,$event)">
                                                            <div x-bind:class="option.selected ? 'border-indigo-600' : ''"
                                                                class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                                <div class="w-full items-center flex">
                                                                    <div class="mx-2 leading-6" x-model="option"
                                                                        x-text="option.text"></div>
                                                                    <span
                                                                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600"
                                                                        x-show="option.selected">

                                                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                                            viewBox="0 0 20 20" fill="currentColor"
                                                                            aria-hidden="true">
                                                                            <path fill-rule="evenodd"
                                                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                                                clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </template>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
              </div>
              {{-- multidropdown for workmen --}}
            </div>
            @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.lorry.index'])
            @endcomponent
          </div>
          <script defer>
            document.addEventListener("alpine:init", () => {
                Alpine.data("alpineMuliSelect", (obj) => ({
                    elementId: obj.elementId,
                    options: [],
                    selected: obj.selected,
                    selectedElms: [],
                    show: false,
                    search: '',
                    open() {
                        this.show = true
                    },
                    close() {
                        this.show = false
                    },
                    toggle() {
                        this.show = !this.show
                    },
                    isOpen() {
                        return this.show === true
                    },

                    // Initializing component 
                    init() {
                        const options = document.getElementById(this.elementId).options;
                        for (let i = 0; i < options.length; i++) {

                            this.options.push({
                                value: options[i].value,
                                text: options[i].innerText,
                                search: options[i].dataset.search,
                                selected: Object.values(this.selected).includes(options[i].value)
                            });

                            if (this.options[i].selected) {
                                this.selectedElms.push(this.options[i])
                            }
                        }

                        // searching for the given value
                        this.$watch("search", (e => {
                            this.options = []
                            const options = document.getElementById(this.elementId).options;
                            Object.values(options).filter((el) => {
                                var reg = new RegExp(this.search, 'gi');
                                return el.dataset.search.match(reg)
                            }).forEach((el) => {
                                let newel = {
                                    value: el.value,
                                    text: el.innerText,
                                    search: el.dataset.search,
                                    selected: Object.values(this.selected).includes(el.value)
                                }
                                this.options.push(newel);

                            })


                        }));
                    },
                    // clear search field
                    clear() {
                        this.search = ''
                    },
                    // deselect selected options
                    deselect() {
                        setTimeout(() => {
                            this.selected = []
                            this.selectedElms = []
                            Object.keys(this.options).forEach((key) => {
                                this.options[key].selected = false;
                            })
                        }, 100)
                    },
                    // select given option
                    select(index, event) {
                        if (!this.options[index].selected) {
                            this.options[index].selected = true;
                            this.options[index].element = event.target;
                            this.selected.push(this.options[index].value);
                            this.selectedElms.push(this.options[index]);

                        } else {
                            this.selected.splice(this.selected.lastIndexOf(index), 1);
                            this.options[index].selected = false
                            Object.keys(this.selectedElms).forEach((key) => {
                                if (this.selectedElms[key].value == this.options[index].value) {
                                    setTimeout(() => {
                                        this.selectedElms.splice(key, 1)
                                    }, 100)
                                }
                            })
                        }
                    },
                    // remove from selected option
                    remove(index, option) {
                        this.selectedElms.splice(index, 1);
                        Object.keys(this.options).forEach((key) => {
                            if (this.options[key].value == option.value) {
                                this.options[key].selected = false;
                                Object.keys(this.selected).forEach((skey) => {
                                    if (this.selected[skey] == option.value) {
                                        this.selected.splice(skey, 1);
                                    }
                                })
                            }
                        })
                    },
                    // filter out selected elements
                    selectedElements() {
                        return this.options.filter(op => op.selected === true)
                    },
                    // get selected values
                    selectedValues() {
                        return this.options.filter(op => op.selected === true).map(el => el.value)
                    }
                }));
            });

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





