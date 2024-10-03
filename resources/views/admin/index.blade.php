@extends('layouts.admin')
@section('content')
<style type="text/css">
  @media print {
    body {
      visibility: hidden;
    }
    #printContent {
      display: table;
      visibility: visible;
      position: absolute;
      left: 0;
      top: 0;
    }
    div {
    border-collapse: collapse;
    }
    table, tr, td {
    border-collapse: collapse;
    }
  }
</style>
          <div class="container px-6 mx-auto grid">
            <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Dashboard
            </h2>
            
            
            <!-- CTA -->
            {{-- <a
              class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
              href="https://github.com/estevanmaito/windmill-dashboard"
            >
              <div class="flex items-center">
                <svg
                  class="w-5 h-5 mr-2"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  ></path>
                </svg>
                <span>Star this project on GitHub</span>
              </div>
              <span>View more &RightArrow;</span>
            </a> --}}
            <!-- Cards -->
            <div class="grid gap-6 mb-6 md:grid-cols-2 xl:grid-cols-4">
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
                >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                  ></path>
                </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    KKIP Total Monthly Weight
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                  @foreach ($totalKKIPMonthlyWeight[0] as $item)
                      {{ $item }} KG
                  @endforeach
                  {{-- {{ $totalKKIPMonthlyWeight->Total_Weight }} --}}
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500"
                >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"
                  ></path>
                </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    KK2 Total Monthly Weight
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                  @foreach ($totalKK2MonthlyWeight[0] as $item)
                      {{ $item }} KG
                  @endforeach
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500"
                >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    fill-rule="evenodd"
                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                    KKIP Total Monthly Commission
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                  @foreach ($totalKKIPMonthlyCommission[0] as $item)
                      $ {{ $item }}
                  @endforeach
                  </p>
                </div>
              </div>
              <!-- Card -->
              <div
                class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <div
                  class="p-3 mr-4 text-teal-500 bg-teal-100 rounded-full dark:text-teal-100 dark:bg-teal-500"
                >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    fill-rule="evenodd"
                    d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
                </div>
                <div>
                  <p
                    class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400"
                  >
                  KK2 Total Monthly Commission
                  </p>
                  <p
                    class="text-lg font-semibold text-gray-700 dark:text-gray-200"
                  >
                  @foreach ($totalKK2MonthlyCommission[0] as $item)
                      $ {{ $item }}
                  @endforeach
                  </p>
                </div>
              </div>
            </div>
            {{-- outlet dropdown --}}
            <label class="block">
              <span class=" pb-2 text-gray-700 dark:text-gray-400">
                Please select month:
              </span>
            </label>
              <form action="{{ route('admin.monthComm') }}" method="post">
                @csrf
                <?php
  
                $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 =>   'Dec');
                $transposed = array_slice($months, date('n'), 12, true) + array_slice($months, 0, date('n'), true);
                $last8 = array_reverse(array_slice($transposed, -8, 12, true), true);
  
                ?>
                <div class="flex flex-row space-between">
                  <div class="w-full flex flex-row space-x-4 mb-2">
                    <select 
                    class="block w-32 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none  focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          required
                          name="month">
                      <?php
                          foreach ($months as $num => $name) {
                            var_dump($_POST["month"]);
                              if($_POST["month"] == $num){
                                printf('<option selected value="%u">%s</option>', $num, $name);
                              } else {
                                printf('<option value="%u">%s</option>', $num, $name);
                              }
                          }
                      ?>
                    </select>
                    <select 
                    class="block w-32 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none  focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                          required
                          name="year">
                      <?php
                          for($i=2021;$i<=$year;$i++){
                            if($_POST["year"] == $i){
                              echo '<option selected value="'.$i.'">'.$i.'</option>';
                            } else {
                              echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          }
                      ?>
                    </select>
                    <button
    
                    class="flex flex-row items-center px-2 text-sm font-semibold leading-5 text-white transition-colors duration-150 bg-purple-600 border     border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none"
    
                    type="submit"
    
                    >
    
                      <i data-feather="corner-down-right" class=""></i>
    
                      <span class="block text-xs">&nbsp;Calculate</span>
                    
                    </button>
                  </form>
                  <div class="flex justify-between">
                    <button
                    id="print"
                    class="flex flex-row items-center px-2 text-sm font-semibold leading-5 text-white transition-colors duration-150 bg-purple-600 border     border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none"
    
                    {{-- type="print" --}}
    
                    >
    
                      <i data-feather="printer" class=""></i>
    
                      <span class="block text-xs">&nbsp;Print</span>
                    
                    </button>
                  </div>
                  </div>
                  
                </div>
              
            
            <!-- New Table -->
            <div class="w-full overflow-hidden rounded-lg shadow-xs">
              <div class="w-full overflow-x-auto">
                
                <div class="" id="printContent">
                {{-- table container start --}}
                  <div class="table-container flex flex-row w-full text-center">
                    <div class=" w-full flex flex-col">
                      <div class="rowOne w-full text-sm font-semibold tracking-wide py-2 text-gray-500 uppercase border dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">{{ $selected_month }} {{ $selected_year }} Commission</div>
                      <div class="rowTwo w-full flex flex-row">
                        <div class="table-one w-full"  style="border-collapse: collapse;">
                          @include('includes.tables.summaryTableKKIP',[
                            'outlet' => 'KKIP',
                            $KKIPdriverMonthlyCommission,
                            $KKIPworkmanMonthlyCommission,
                          ])
                        </div>
                        <div class="table-two w-full" style="border-collapse: collapse;">
                          @include('includes.tables.summaryTableKK2',[
                            'outlet' => 'KK2',
                            $KK2driverMonthlyCommission,
                            $KK2workmanMonthlyCommission,
                          ])
                        </div>
                      </div>
                    </div>
                  </div>
                {{-- table container end --}}
              </div>
              </div>
            <!-- Charts -->
            {{-- <h2
              class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
              Charts
            </h2>
            <div class="grid gap-6 mb-8 md:grid-cols-2">
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Revenue
                </h4>
                <canvas id="pie"></canvas>
                <div
                  class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
                >
                  <!-- Chart legend -->
                  <div class="flex items-center">
                    <span
                      class="inline-block w-3 h-3 mr-1 bg-blue-500 rounded-full"
                    ></span>
                    <span>Shirts</span>
                  </div>
                  <div class="flex items-center">
                    <span
                      class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"
                    ></span>
                    <span>Shoes</span>
                  </div>
                  <div class="flex items-center">
                    <span
                      class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                    ></span>
                    <span>Bags</span>
                  </div>
                </div>
              </div>
              <div
                class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800"
              >
                <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                  Traffic
                </h4>
                <canvas id="line"></canvas>
                <div
                  class="flex justify-center mt-4 space-x-3 text-sm text-gray-600 dark:text-gray-400"
                >
                  <!-- Chart legend -->
                  <div class="flex items-center">
                    <span
                      class="inline-block w-3 h-3 mr-1 bg-teal-600 rounded-full"
                    ></span>
                    <span>Organic</span>
                  </div>
                  <div class="flex items-center">
                    <span
                      class="inline-block w-3 h-3 mr-1 bg-purple-600 rounded-full"
                    ></span>
                    <span>Paid</span>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          <script>
            const printBtn = document.getElementById('print');

            printBtn.addEventListener('click', function(){
              print();
            })
          </script>
          
@endsection