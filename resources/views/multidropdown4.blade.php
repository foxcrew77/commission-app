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
                  {{-- start here --}}
              <div id="multiselectcontainer" class="multiselectcontainer flex items-start gap-20" name="workmen[]">
                <div id="custom-select" class="custom-select open relative w-full">
                    <div id="select-box" class="select-box bg-white border rounded bg-neutral-100 flex flex-row justify-between items-center px-10
                    
                    ">
                        <input type="text" class="tags_input" name="tags" hidden>
                        <div class="selected-options flex flex-wrap mt-2 mb-2"> {{-- selected-options  --}}
                            {{-- <span type="button" class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">Black<span class="remove-tag ml-4 cursor-pointer">&times;</span></span>
                            <span class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">White<span class="remove-tag ml-4 cursor-pointer">&times;</span></span>
                            <span class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">Green<span class="remove-tag ml-4 cursor-pointer">&times;</span></span>
                            <span class="tag bg-gray-100 text-black rounded border border-black mr-2 py-1 px-2 flex items-center">Orange<span class="remove-tag ml-4 cursor-pointer">&times;</span></span> --}}
                        </div>
                        <div class="arrow mx-10">
                            <i data-feather="chevron-down" style="stroke: gray; stroke-width:2; width:16px;height:16px" ></i>  
                        </div>
                    </div>
                    <div id="options" class="options absolute w-full bg-white border-black max-h-56 shadow-md " style="max-height:170px; overflow-y: auto; z-index:1">
                        <div class="option-search-tags bg-white border border-gray-400 mt-2 py-2">
                            <input type="text" class="search-tags w-full border-0 px-2 text-sm
                            focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray
                            "
                            placeholder="Search workman..."/>
                            <button type="button" class="clear absolute border-0 bg-transparent px-0 py-0" style="left:auto;right:10px"><i data-feather="x-square" style="stroke: black; stroke-width:1; width:24px;height:24px" ></i></button>
                        </div>
                        <div style="cursor: default;" class="option all-tags px-4 optionWM active:text-black active:bg-gray-400" data-value="All">select All</div>
                        <div style="cursor: default;" class="option px-4 active:text-black active:bg-gray-400" data-value="Black">Black</div>
                        <div style="cursor: default;" class="option px-4 active:text-black active:bg-gray-400" data-value="White">White</div>
                        <div style="cursor: default;" class="option px-4 active:text-black active:bg-gray-400" data-value="Green">Green</div>
                        <div style="cursor: default;" class="option px-4 active:text-black active:bg-gray-400" data-value="Orange">Orange</div>
                        <div style="cursor: default;" class="option px-4 active:text-black active:bg-gray-400" data-value="Yellow">Yellow</div>
                        <div style="cursor: default;" class="option px-4 active:text-black active:bg-gray-400" data-value="Red">Red</div>
                        <div style="cursor: default;" class="option px-4 active:text-black active:bg-gray-400" data-value="Purple">Purple</div>
                        <div style="cursor: default; display:none;" class="option no-result-message px-4 py-4" data-value="">No result match</div>
                    </div>
                    <span class="tag_error_msg error hidden"></span>
                  </div>
                </label>
                  <input type="button" class="btn_submit" value="submit" />
              </div>
              {{-- https://www.youtube.com/watch?v=MyJx3Fj1tWc --}}
              {{-- multdropdown for workmen --}}
            </div>
            @component('components.navigation.save-cancel-button',['IndexRoute' => 'admin.lorry.index'])
        </form>
            @endcomponent
          </div>
          
          <script defer>
            window.onload = () => {
            // Get the button, and when the user clicks on it, execute myFunction
              document.getElementById("select-box").onclick = function() {toggleOpen()};

            /* myFunction toggles between adding and removing the show class, which is used to hide and show the          dropdown content */
              function toggleOpen() {
                // document.getElementById("options").classList.toggle("open");
                if (document.getElementById("options").style.display == "none") {
                  document.getElementById("options").style.display == "block";
                } 
                  else {
                    document.getElementById("options").style.display == "none";
                }
              }
            }
            // function toggleOpen(){
            //   const customSelectsOpen = document.getElementById("custom-select");
            //   customSelectsOpen.classList.toggle("open");
            // }
            // customSelectsOpen.addEventListener("click", function(){
              // alert(customSelectsOpen.style.display);
              // customSelectsOpen.classList.toggle("open");
              // if (!customSelectsOpen.classList.contains("open")) {
              //   customSelectsOpen.classList.add("open");
              //     } 
              //     else {
              //       customSelectsOpen.classList.remove("open");
              //   }
            // });
            document.addEventListener("DOMContentLoaded", function(){
              const customSelects = document.querySelectorAll(".custom-select");
              
              function updateSelectedOptions(customSelect){
                const selectedOptions = Array.from(customSelect.querySelectorAll(".option.active")).filter(option => option !== customSelect.querySelector(".option.all-tags")).map(function(option){
                  return {
                    value: option.getAttribute("data-value"),
                    text: option.textContent.trim()
                  };
                });

                const selectedValues = selectedOptions.map(function(option){
                  return option.value;
                });

                customSelect.querySelector(".tags_input").value = selectedValues.join(', ');

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

                customSelect.querySelector(".selected-options").innerHTML = tagsHTML;

              }
                
              
              customSelects.forEach(function(customSelect){
                const searchInput = customSelect.querySelector(".search-tags");
                const optionContainer = customSelect.querySelector(".options");
                const noResultMessage = customSelect.querySelector(".no-result-message");
                const options = customSelect.querySelectorAll(".option");
                const allTagsOption = customSelect.querySelector(".option.all-tags");
                const clearButton = customSelect.querySelector(".clear");

                allTagsOption.addEventListener("click", function(){
                  const isActive = allTagsOption.classList.contains("active");
                  // toggle active class for each option
                  options.forEach(function(option){
                    if(option !== allTagsOption){
                      option.classList.toggle("active", !isActive);
                    }
                  });

                  updateSelectedOptions(customSelect);
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

              customSelects.forEach(function(customSelect){
                const options = customSelect.querySelectorAll(".option");
                options.forEach(function(option){
                  option.addEventListener("click", function(){
                    option.classList.toggle("active");
                    updateSelectedOptions(customSelect);
                  });
                });
              });

              document.addEventListener("click", function(event){
                const removeTag = event.target.closest(".remove-tag");
                if(removeTag){
                  const customSelect = removeTag.closest(".custom-select");
                  const valueToRemove = removeTag.getAttribute("data-value");
                  const optionToRemove = customSelect.querySelector(".option[data-value='"+valueToRemove+"']");
                  optionToRemove.classList.remove("active");

                  const otherSelectedOptions = customSelect.querySelectorAll(".option.active:not(.all-tags)");
                  const allTagsOption = customSelect.querySelector(".option.all-tags");

                  if(otherSelectedOptions.length === 0){
                    allTagsOption.classList.remove("active");
                  }
                  updateSelectedOptions(customSelect);
                }
              });
              //add open class to open select box
              //try adjust open select box di sini:
              //1. try tambah class khas di select box
              //2. try buat, ikut jumlah workman, lepas cukup workman, tutup select box sendiri
              const selectBoxes = document.querySelectorAll(".select-box");
              selectBoxes.forEach(function(selectBox){
                selectBox.addEventListener("click", function(event){
                  if(!event.target.closest(".tag")){
                    selectBox.parentNode.classList.toggle("open");
                  }
                });
              });
              //open select
              document.addEventListener("click", function(event){
                if(!event.target.closest(".custom-select") && !event.target.classList.contains("remove-tag")){
                  customSelects.forEach(function(customSelect){
                    customSelect.classList.remove("open");
                  });
                }
              });

              function resetCustomSelects(){
                customSelects.forEach(function(customSelect){
                  customSelect.querySelectorAll(".option.active").forEach(function(option){
                    option.classList.remove("active");
                  });
                  customSelect.querySelector(".option.all-tags").classList.remove("active");
                  updateSelectedOptions(customSelect);
                });
              }

              updateSelectedOptions(customSelects[0]);

              const submitButton = document.querySelector(".btn_submit");
              submitButton.addEventListener("click", function(){
                let valid = true;

                customSelects.forEach(function(customSelect){
                  const selectedOptions = customSelect.querySelectorAll(".option.active");

                   if(selectedOptions.length === 0){
                    const wmErrorMsg = customSelect.querySelector(".tag_error_msg");
                    wmErrorMsg.textContent = "This field is required";
                    wmErrorMsg.style.display = "block";
                    valid = false;
                  } else {
                    const wmErrorMsg = customSelect.querySelector(".tag_error_msg");
                    wmErrorMsg.textContent = "";
                    wmErrorMsg.style.display = "none";
                  }
                });

                if(valid){
                  let tags = document.querySelector(".tags_input").value;
                  resetCustomSelects();
                  return;
                }
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





