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
              {{-- multidropdown for workmen --}}
              <div class="w-full mt-24 max-w-lg">
                <!-- Start Component -->
                {{-- {{var_dump($workmenJson)}} --}}
                <div
                  x-data="multiselect(
                  { 

                    items: [
                      {{-- { label: @json($workmen[0]->name), value: @json($workmen[0]->name) },  --}}
                      { label: 'Blue', value:  '#0000FF' }, 
                      { label: 'Green', value: '#00FF00' },
                      { label: 'Red', value: '#FF0000' },
                      { label: 'Yellow', value: '#FFFF00' },
                      { label: 'Gray', value: '#CCC' },
                      { label: 'I am a very long value and will show a maximum of 50 chars!', value: '#FF0F0E' },
                    ]
                    ,
                    size: 6,
                  })"
                  x-init="onInit"
                  @focusout="handleBlur"
                  class="relative"
                >
                  <!-- Start Item Tags And Input Field -->
                  <div
                    class="flex items-center justify-between px-1 border border-2 rounded-md relative pr-8 bg-white"
                  >
                    <ul class="flex flex-wrap items-center w-full">
                      <!-- Tags (Selected) -->
                      <template x-for="(selectedItem, idx) in selectedItems">
                        <li
                          x-text="shortenedLabel(selectedItem.label, maxTagChars)"
                          @click="removeElementByIdx(idx)"
                          @keyup.backspace="removeElementByIdx(idx)"
                          @keyup.delete="removeElementByIdx(idx)"
                          tabindex="0"
                          class="relative m-1 px-2 py-1.5 border rounded-md cursor-pointer hover:bg-gray-100 after:content-['x'] after:ml-1.5 after:text-red-300 outline-none focus:outline-none ring-0 focus:ring-2 focus:ring-amber-300 ring-inset transition-all"
                        ></li>
                      </template>
          
                      <!-- Search Input -->
                      <input
                        x-ref="searchInput"
                        x-model="search"
                        @click="expanded = true"
                        @focusin="expanded = true"
                        @input="expanded = true"
                        @keyup.arrow-down="expanded = true; selectNextItem()"
                        @keyup.arrow-up="expanded = true; selectPrevItem()"
                        @keyup.escape="reset"
                        @keyup.enter="addActiveItem"
                        :placeholder="searchPlaceholder"
                        type="text"
                        class="flex-grow py-2 px-2 mx-1 my-1.5 outline-none focus:outline-none focus:ring-amber-300 focus:ring-2 ring-inset transition-all rounded-md w-24"
                      />
          
                      <!-- Arrow Icon -->
                      <svg
                        @click="expanded = !expanded; expanded && $refs.searchInput.focus()"
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        stroke-width="0"
                        fill="#ccc"
                        :class="expanded && 'rotate-180'"
                        class="absolute right-2 top-1/2 -translate-y-1/2 cursor-pointer focus:outline-none"
                        tabindex="-1"
                      >
                        <path
                          d="M12 17.414 3.293 8.707l1.414-1.414L12 14.586l7.293-7.293 1.414 1.414L12 17.414z"
                        />
                      </svg>
                    </ul>
                  </div>
                  <!-- End Item Tags And Input Field -->
          
                  <!-- Start Items List -->
                  <template x-if="expanded">
                    <ul
                      x-ref="listBox"
                      class="w-full list-none border border-2 border-t-0 rounded-md focus:outline-none overflow-y-auto outline-none focus:outline-none bg-white absolute left-0 bottom-100"
                      tabindex="0"
                      :style="listBoxStyle"
                    >
                      <!-- Item Element -->
                      <template x-if="filteredItems.length">
                        <template x-for="(filteredItem, idx) in filteredItems">
                          <li
                            x-text="shortenedLabel(filteredItem.label, maxItemChars)"
                            @click="handleItemClick(filteredItem)"
                            :class="idx === activeIndex && 'bg-amber-200'"
                            :title="filteredItem.label"
                            class="hover:bg-amber-200 cursor-pointer px-2 py-2"
                          ></li>
                        </template>
                      </template>
          
                      <!-- Empty Text -->
                      <template x-if="!filteredItems.length">
                        <li
                          x-text="emptyText"
                          class="cursor-pointer px-2 py-2 text-gray-400"
                        ></li>
                      </template>
                    </ul>
                  </template>
                  <!-- End Items List -->
                </div>
                <!-- End Component -->
              </div>
            </div>
            @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.lorry.index'])
            @endcomponent
          </div>
          <script>
            function multiselect(config) {
              return {
                items: config.items ?? [],
          
                allItems: null,
          
                selectedItems: null,
          
                search: config.search ?? "",
          
                searchPlaceholder: config.searchPlaceholder ?? "Type here...",
          
                expanded: config.expanded ?? false,
          
                emptyText: config.emptyText ?? "No items found...",
          
                allowDuplicates: config.allowDuplicates ?? false,
          
                size: config.size ?? 4,
          
                itemHeight: config.itemHeight ?? 40,
          
                maxItemChars: config.maxItemChars ?? 50,
          
                maxTagChars: config.maxTagChars ?? 25,
          
                activeIndex: -1,
          
                onInit() {
                  // Set the allItems array since we want to filter later on and keep the original (items) array as reference
                  this.allItems = [...this.items];
          
                  this.$watch("filteredItems", (newValues, oldValues) => {
                    // Reset the activeIndex whenever the filteredItems array changes
                    if (newValues.length !== oldValues.length) this.activeIndex = -1;
                  });
          
                  this.$watch("selectedItems", (newValues, oldValues) => {
                    if (this.allowDuplicates) return;
          
                    // Remove already selected items from the items (allItems) array (if allowDuplicates is false)
                    this.allItems = this.items.filter((item, idx, all) =>
                      newValues.every((n) => n.value !== item.value)
                    );
                  });
          
                  // Scroll to active element whenever activeIndex changes (if expanded is true and we have a value)
                  this.$watch("activeIndex", (newValue, oldValue) => {
                    if (
                      this.activeIndex == -1 ||
                      !this.filteredItems[this.activeIndex] ||
                      !this.expanded
                    )
                      return;
          
                    this.scrollToActiveElement();
                  });
          
                  // Check whether there are selected values or not and set them
                  this.selectedItems = this.items
                    ? this.items.filter((item) => item.selected)
                    : [];
                },
          
                handleBlur(e) {
                  // If the current active element (relatedTarget) is a child element of the component itself, return
                  // Note: The current active element must have a tabindex attribute set in order to appear as a relatedTarget
                  if (this.$el.contains(e.relatedTarget)) {
                    return;
                  }
          
                  this.reset();
                },
          
                reset() {
                  // 1) Clear the search value
                  this.search = "";
          
                  // 2) Close the list
                  this.expanded = false;
          
                  // 3) Reset the active index
                  this.activeIndex = -1;
                },
          
                handleItemClick(item) {
                  // 1) Add the item
                  this.selectedItems.push(item);
          
                  // 2) Reset the search input
                  this.search = "";
          
                  // 3) Keep the focus on the search input
                  this.$refs.searchInput.focus();
                },
          
                selectNextItem() {
                  if (!this.filteredItems.length) return;
          
                  // Array count starts at 0, so we abstract 1
                  if (this.filteredItems.length - 1 == this.activeIndex) {
                    return (this.activeIndex = 0);
                  }
          
                  this.activeIndex++;
                },
          
                selectPrevItem() {
                  if (!this.filteredItems.length) return;
          
                  if (this.activeIndex == 0 || this.activeIndex == -1)
                    return (this.activeIndex = this.filteredItems.length - 1);
          
                  this.activeIndex--;
                },
          
                addActiveItem() {
                  if (!this.filteredItems[this.activeIndex]) return;
          
                  this.selectedItems.push(this.filteredItems[this.activeIndex]);
          
                  this.search = "";
                },
          
                scrollToActiveElement() {
                  // Remove the first two child elements since they are <template> tags
                  const availableListElements = [...this.$refs.listBox.children].slice(
                    2,
                    -1
                  );
          
                  // Scroll to active <li> element
                  availableListElements[this.activeIndex].scrollIntoView({
                    block: "end",
                  });
                },
          
                removeElementByIdx(itemIdx) {
                  this.selectedItems.splice(itemIdx, 1);
          
                  // Focus the input element to keep the blur functionlity
                  // otherwise @focusout on the root element will not be triggered
                  if (!this.selectedItems.length) this.$refs.searchInput.focus();
                },
          
                shortenedLabel(label, maxChars) {
                  return !maxChars || label.length <= maxChars
                    ? label
                    : `${label.substr(0, maxChars)}...`;
                },
          
                get filteredItems() {
                  return this.allItems.filter((item) =>
                    item.label.toLowerCase().includes(this.search?.toLowerCase())
                  );
                },
          
                get listBoxStyle() {
                  // We add 2 since there is border that takes space
                  return {
                    maxHeight: `${this.size * this.itemHeight + 2}px`,
                  };
                },
              };
            }
          </script>
@endsection





