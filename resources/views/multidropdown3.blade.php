
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>
      Multi-Select-Box with tags and (optional) duplicates: @alpinejs,
      @tailwindcss
    </title>

    <!-- Dependencies -->
    <script
      defer
      src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

    <script src="https://cdn.tailwindcss.com"></script>
  </head>

  <body class="p-12 bg-gray-900 flex flex-col items-center min-h-screen">
    <div class="w-full">
      <select multiple x-data="multiselect">
        <optgroup label="Workman">
                        
          <option value="john-doe">John Doe</option>
                        
          <option value="FDOeE">Yeow Rin Kor</option>
                        
          <option value="MALF3">Norhidayah Salam binti Diah</option>
                        
          <option value="vTM7m">Sittampalam a/l Tanasekharan</option>
                        
          <option value="2javJ">En Thung Chun</option>
                        
          <option value="W5uyr">Tam Low Zhao</option>
                        
          <option value="L3bgJ">Lu Shik Fun</option>
                        
          <option value="Extc5">Ko Cer Niau</option>
                        
          <option value="gSS1b">Maya Cha Kin Cen</option>
                        
          <option value="O3OKW">Sumayyah binti Nik Farisan Iman</option>
                        
          <option value="PNNPy">Kamaruzzaman bin Fareez</option>
                        
          <option value="QwVmK">Zabrina a/l Jomo Kwame Lakshmi</option>
                        
          <option value="EXeEd">Nuur Ridiatul binti Syed Ihsan Yussof</option>
                        
          <option value="wNjTS">Zabrina Manicka</option>
                        
          <option value="jOD1F">Kavita Bhullar a/l Satwant</option>
                        
          <option value="IDVv0">Zheng Sue Rong</option>
                        
          <option value="Va0k2">Hjh Darwisyah Faris binti Wan Lufty Ajmal</option>
                        
          <option value="yIrRk">Hajjah Nurfarrah Farhan binti Azhan</option>
                        
          <option value="aVU9D">Mohammad Hj Azizulhasni Roslee bin Syed Norazmi</option>
                        
          <option value="3jpi2">Thamboosamy Rajan</option>
                        
          <option value="sXih9">Zabrina a/l Palanivel</option>
                        
          <option value="s32Mt">Hui Liu Choi</option>
                        
          <option value="Dye85">Lye Zeah Liet</option>
                        
          <option value="w1UA9">Muhammet Zufayri bin Ihsan Shukri</option>
                        
          <option value="vUYkL">P&#039;ng Phong Kek</option>
                        
          <option value="ewfgo">Nurfatehah binti Azib Daud</option>
                        
          <option value="deqpZ">Sangeeta a/l Jeevandran Selvanayagam</option>
                        
          <option value="6QUFP">Gong Kuong Win</option>
                        
          <option value="sktMm">Muhamed Ishak Baharruddin bin Noorhakim</option>
                  </optgroup>
        <optgroup label="Driver">
                        
          <option value="jane-doe">Jane Doe</option>
                        
          <option value="kambing">Kambing</option>
                        
          <option value="hanif">Hanif</option>
                        
          <option value="hassan">Hassan</option>
                        
          <option value="pUSKm">Nur Hjh Cempaka Kasim</option>
                        
          <option value="jFeRu">Haran a/l Chanturu</option>
                        
          <option value="v6T09">Thanuja Perera a/l Vijandren Jayaram</option>
                        
          <option value="3EyWD">Izzaty binti Nik Ashrul Kamaruddin</option>
                        
          <option value="L9re4">Hao Wi Tin</option>
                        
          <option value="8is80">Sannatasah Asirvatham a/l Maha Thiru</option>
                        
          <option value="eKgB0">Ewe Pong Zao</option>
                        
          <option value="YJY1B">R.  Chandran</option>
                        
          <option value="dLvmh">Thew Sum Joy</option>
                        
          <option value="AVrBC">Mohamed Kamaruzaman bin Iqwan Safee</option>
                  </optgroup>
      </select>
    </div>
    
    <script>
      document.addEventListener("alpine:init", () => {
  Alpine.data("multiselect", () => ({
    style: {
      wrapper: "w-full relative",
      select:
        "border w-full border-gray-300 rounded-lg py-2 px-2 text-sm flex gap-2 items-center cursor-pointer bg-white",
      menuWrapper:
        "w-full rounded-lg py-1.5 text-sm mt-1 shadow-lg absolute bg-white z-10",
      menu: "max-h-52 overflow-y-auto",
      textList: "overflow-x-hidden text-ellipsis grow whitespace-nowrap",
      trigger: "px-2 py-2 rounded bg-neutral-100",
      badge: "py-1.5 px-3 rounded-full bg-neutral-100",
      search:
        "px-3 py-2 w-full border-0 border-b-2 border-neutral-100 pb-3 outline-0 mb-1",
      optionGroupTitle:
        "px-3 py-2 text-neutral-400 uppercase font-bold text-xs sticky top-0 bg-white",
      clearSearchBtn: "absolute p-3 right-0 top-1 text-neutral-600",
      label: "hover:bg-neutral-50 cursor-pointer flex py-2 px-3"
    },

    icons: {
      times:
        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><g xmlns="http://www.w3.org/2000/svg" stroke="currentColor" stroke-linecap="round" stroke-width="2"><path d="M6 18L18 6M18 18L6 6"/></g></svg>',
      arrowDown:
        '<svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4"><path xmlns="http://www.w3.org/2000/svg" stroke-linecap="round" stroke-width="2" d="M5 10l7 7 7-7"/></svg>'
    },

    init() {
      const style = this.style;

      const originalSelect = this.$el;
      originalSelect.classList.add("hidden");

      const wrapper = document.createElement("div");
      wrapper.className = style.wrapper;
      wrapper.setAttribute("x-data", "newSelect");

      const newSelect = document.createElement("div");
      newSelect.className = style.select;
      newSelect.setAttribute("x-bind", "selectTrigger");
      newSelect.id = 'appendHere';

      const textList = document.createElement("span");
      textList.className = style.textList;

      const triggerBtn = document.createElement("button");
      triggerBtn.className = style.trigger;
      triggerBtn.innerHTML = this.icons.arrowDown;

      const countBadge = document.createElement("span");
      countBadge.className = style.badge;
      countBadge.setAttribute("x-bind", "countBadge");

      newSelect.append(textList);
      newSelect.append(countBadge);
      newSelect.append(triggerBtn);

      const menuWrapper = document.createElement("div");
      menuWrapper.className = style.menuWrapper;
      menuWrapper.setAttribute("x-bind", "selectMenu");

      const menu = document.createElement("div");
      menu.className = style.menu;

      const search = document.createElement("input");
      search.className = style.search;
      search.setAttribute("x-bind", "search");
      search.setAttribute("placeholder", "filter");

      const clearSearchBtn = document.createElement("button");
      clearSearchBtn.className = style.clearSearchBtn;
      clearSearchBtn.setAttribute("x-bind", "clearSearchBtn");
      clearSearchBtn.innerHTML = this.icons.times;

      menuWrapper.append(search);
      menuWrapper.append(menu);
      menuWrapper.append(clearSearchBtn);

      originalSelect.parentNode.insertBefore(
        wrapper,
        originalSelect.nextSibling
      );

      const itemGroups = originalSelect.querySelectorAll("optgroup");

      if (itemGroups.length > 0) {
        itemGroups.forEach((itemGroup) => processItems(itemGroup));
      } else {
        processItems(originalSelect);
      }

      function processItems(parent) {
        const items = parent.querySelectorAll("option");
        const subMenu = document.createElement("ul");
        const groupName = parent.getAttribute("label") || null;

        if (groupName) {
          const groupTitle = document.createElement("h5");
          groupTitle.className = style.optionGroupTitle;
          groupTitle.innerText = groupName;
          groupTitle.setAttribute("x-bind", "groupTitle");
          menu.appendChild(groupTitle);
        }

        items.forEach((item) => {
          const li = document.createElement("li");
          li.setAttribute("x-bind", "listItem");

          const checkBox = document.createElement("input");
          checkBox.classList.add("mr-3", "mt-1");
          checkBox.type = "checkbox";
          checkBox.value = item.value;
          checkBox.id = originalSelect.name + "_" + item.value;

          const label = document.createElement("label");
          label.className = style.label;
          label.setAttribute("for", checkBox.id);
          label.innerText = item.innerText;

          checkBox.setAttribute("x-bind", "checkBox");

          if (item.hasAttribute("selected")) {
            checkBox.checked = true;
          }
          label.prepend(checkBox);
          li.append(label);
          subMenu.appendChild(li);
        });
        menu.appendChild(subMenu);
      }

      wrapper.appendChild(newSelect);
      wrapper.appendChild(menuWrapper);

      Alpine.data("newSelect", () => ({
        open: false,
        showCountBadge: false,
        items: [],
        selectedItems: [],
        filterBy: "",
        init() {
          this.regenerateTextItems();
        },

        regenerateTextItems() {
          this.selectedItems = [];
          this.items.forEach((item) => {
            const checkbox = item.querySelector("input[type=checkbox]");
            const text = item.querySelector("label").innerText;
            
            if (checkbox.checked) {
              this.selectedItems.push(text);
            }
          });

          if (this.selectedItems.length > 1) {
            this.showCountBadge = true;
          } else {
            this.showCountBadge = false;
          }

          if (this.selectedItems.length === 0) {
            textList.innerHTML = '<span class="text-neutral-400">select</span>';
          } else {
            textList.innerHTML = '';
            
            textList.appendChild(newSpan);
            this.selectedItems.map(function(item){
                const newSpan = document.createElement("span");
                newSpan.className = style.badge;
                newSpan.style = 'display:inline-block';
                newSpan.innerText = item;
            });
            // textList.innerText = this.selectedItems.join(", ");
            // textList.appendChild(toNodeList);
          }
        },
        // document.querySelector('#output').innerHTML = 'Hi <span>' + name + '</span>'; 
        selectTrigger: {
          ["@click"]() {
            this.open = !this.open;

            if (this.open) {
              this.$nextTick(() =>
                this.$root.querySelector("input[x-bind=search]").focus()
              );
            }
          }
        },
        selectMenu: {
          ["x-show"]() {
            return this.open;
          },
          ["x-transition"]() {},
          ["@keydown.escape.window"]() {
            this.open = false;
          },
          ["@click.away"]() {
            this.open = false;
          },
          ["x-init"]() {
            this.items = this.$el.querySelectorAll("li");
            this.regenerateTextItems();
          }
        },
        checkBox: {
          ["@change"]() {
            const checkBox = this.$el;

            if (checkBox.checked) {
              originalSelect
                .querySelector("option[value='" + checkBox.value + "']")
                .setAttribute("selected", true);
            } else {
              originalSelect
                .querySelector("option[value='" + checkBox.value + "']")
                .removeAttribute("selected");
            }
            this.regenerateTextItems();
          }
        },
        countBadge: {
          ["x-show"]() {
            return this.showCountBadge;
          },
          ["x-text"]() {
            return this.selectedItems.length;
          }
        },
        search: {
          ["@keydown.escape.stop"]() {
            this.filterBy = "";
            this.$el.blur();
          },
          ["@keyup"]() {
            this.filterBy = this.$el.value;
          },
          ["x-model"]() {
            return this.filterBy;
          }
        },
        clearSearchBtn: {
          ["@click"]() {
            this.filterBy = "";
          },
          ["x-show"]() {
            return this.filterBy.length > 0;
          }
        },
        listItem: {
          ["x-show"]() {
            return (
              this.filterBy === "" ||
              this.$el.innerText
                .toLowerCase()
                .startsWith(this.filterBy.toLowerCase())
            );
          }
        },
        groupTitle: {
          ["x-show"]() {
            if (this.filterBy === "") return true;

            let atLeastOneItemIsShown = false;

            this.$el.nextElementSibling
              .querySelectorAll("li")
              .forEach((item) => {
                console.log(this.filterBy);
                if (
                  item.innerText
                    .toLowerCase()
                    .startsWith(this.filterBy.toLowerCase())
                )
                  atLeastOneItemIsShown = true;
              });
            return atLeastOneItemIsShown;
          }
        }
      }));
    }
  }));
});

    </script>
      </body>
</html>