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
.tag {
  cursor: pointer;
}
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
                            <span type="button" onclick="myFunction()" class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">Black<button class="ml-4 cursor-pointer">&times;</button></span>
                            <span class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">White<button class="ml-4 cursor-pointer">&times;</button></span>
                            <span class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">Green<button class="ml-4 cursor-pointer">&times;</button></span>
                            <span class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">Orange<button class="ml-4 cursor-pointer">&times;</button></span>
                        </div>
                        <div class="arrow mx-10">
                            <i data-feather="chevron-down" style="stroke: gray; stroke-width:2; width:16px;height:16px" ></i>  
                        </div>
                    </div>
                    <div id="open" class="options open absolute w-full bg-white border-black max-h-56 z-10 shadow-md " style="max-height:170px; overflow-y: auto; z-index:1">
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
            document.addEventListener("DOMContentLoaded", function(){
              const customSelects = document.querySelectorAll(".custom-select");
              
              function updateSelectedOptions(customSelects){
                const selectedOptions = Array.from(customSelects.querySelectorAll(".options.active")).filter(option => option !== customSelects.querySelector(".options.all-tags")).map(function(option){
                  return {
                    value: option.getAttribute("data-value"),
                    text: option.textContent.trim()
                  }
                });

                const selectedValues = selectedOptions.map(function(option){
                  return option.value;
                });

                customSelects.querySelector(".tags_input").value = selectedValues.join(', ');

                let tagsHTML = "";

                if(selectedOptions.length === 0){
                  tagsHTML = '<span class="placeholder">Select workman</span>';
                } else {
                  const maxTagsToShow = 4;
                  let additionalWorkmanCount = 0;

                  selectedOptions.forEach(function(option, index){
                    if(index < maxTagsToShow){
                      tagsHTML += '<span class="tag">'+option.text+'<span class="remove-tag" data-value="'+option.value+'">&times;</span></span>'
                    } else {
                      additionalWorkmanCount++;
                    }
                  });

                  if(additionalWorkmanCount > 0){
                    tagsHTML += '<span class="tag">+'+additionalWorkmanCount+'</span>'
                  }

                }

                customSelects.querySelector(".selected-options").innerHTML = tagsHTML;

              }
                
              
              customSelects.forEach(function(customSelects){
                const searchInput = customSelects.querySelector(".search-tags");
                const optionContainer = customSelects.querySelector(".options");
                const noResultMessage = customSelects.querySelector(".no-result-message");
                const options = customSelects.querySelectorAll(".option");
                const allTagsOption = customSelects.querySelector(".option.all-tags");
                const clearButton = customSelects.querySelector(".clear");

                allTagsOption.addEventListener("click", function(){
                  const isActive = allTagsOption.classList.contains("active");

                  options.forEach(function(option){
                    if(option !== allTagsOption){
                      option.classList.toggle("active", !isActive);
                    }
                  });

                  updateSelectedOptions(customSelects);
                });

                clearButton.addEventListener("click", function(){
                  searchInput.value = "";
                  options.forEach(function(option){
                    option.style.display = "block";
                  });
                  noResultMessage.style.display = "none";
                });

                searchInput.addEventListener("input", function(){
                  const searchTerm = searchInput.value.toLowerCase();

                  options.forEach(function(option){
                    const optionText = option.textContent.trim().toLocaleLowerCase();
                    const shouldShow = optionText.includes(searchTerm);
                    option.style.display = shouldShow ? "block" : "none";
                  });
                  const anyOptiosnMatch = Array.from(options).some(option => option.style.display === "block");
                  noResultMessage.style.display = anyOptiosnMatch ? "none" : "block";

                  if(searchTerm){
                    optionContainer.classList.add("option-search-active");
                  } else {
                    optionContainer.classList.remove("option-search-active");
                  }
                });
                
              });

              customSelects.forEach(function(customSelects){
                const options = customSelects.querySelectorAll(".option");
                options.forEach(function(option){
                  option.addEventListener("click", function(){
                    option.classList.toggle("active");
                    updateSelectedOptions(customSelects);
                  });
                })
              });

              document.addEventListener("click", function(event){
                const removeTag = event.target.closest(".remove-tag");
                if(removeTag){
                  const customSelects = removeTag.closest(".custom-select");
                  const valueToRemove = removeTag.getAttribute("data-value");
                  const optionToRemove = customSelects.querySelector(".option[data-value='"+valueToRemove+"']");
                  optionToRemove.classList.remove("active");

                  const otherSelectedOptions = customSelects.querySelectorAll(".option.active:not(.all-tags)");
                  const allTagsOption = customSelects.querySelector(".option.all-tags");

                  if(otherSelectedOptions.length === 0){
                    allTagsOption.classList.remove("active");
                  }
                  updateSelectedOptions(customSelects);
                }
              });

              cosnt selectBoxes = document.querySelectorAll(".select-box");
              selectBoxes.forEach(function(selectBox){
                selectBox.addEventListener("click", function(event){
                  if(!event.target.closest(".tag")){
                    selectBox.parentNode.classList.toggle("open");
                  }
                });
              });

              document.addEventListener("click", function(event){
                if(!event.target.closes(".custom-select") && !event.target.classList.contains("remove-tag")){
                  customSelects.forEach(function(customSelects){
                    customSelects.classList.remove("open");
                  });
                }
              });

              function resetCustomSelects(){
                customSelects.forEach(function(customSelects){
                  customSelects.querySelectorAll(".option.active").forEach(function(option){
                    option.classList.remove("active");
                  });
                  customSelects.querySelector(".option.all-tags").classList.remove("active");
                  updateSelectedOptions(customSelects);
                });
              }

              updateSelectedOptions(customSelects[0]);

              const submitButton = document.querySelector(".btn_submit");
              submitButton.addEventListener("click", function(){
                let valid = true;

                customSelects.forEach(function(customSelects){
                  c (minit ke 23:07)
                })
              })
            });
            //testing change class name
            function myFunction() {
                var element = document.querySelector(".open");
                if (element.style.display === "none") {
                  element.style.display = "block";
                } else {
                  element.style.display = "none";
                }
                // element.classList.add("hidden");
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





