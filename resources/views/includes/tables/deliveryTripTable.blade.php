<table class="w-full whitespace-no-wrap">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4">No.</th>
            <th class="px-4">Date</th>
            <th class="px-4">Total Weight</th>
            <th class="px-4">Lorry</th>
            <th class="px-4">Driver</th>
            <th class="px-4">Workmen</th>
            <th class="px-4">Outlet</th>
            <th class="px-4">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($delivery_trip as $trip)
        {{-- <tr class="text-gray-700 dark:text-gray-400"> --}}
        <tr 
            data-href="{{ route('admin.deliverytrip.show',['deliverytrip' => $trip->slug]) }}"
            class="cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400">
            <td class="px-4 text-sm">{{ $delivery_trip->firstItem() + $loop->index}}</td>
            <td class="flex flex-row gap-px px-4 py-3 text-sm">
                    <div class="mr-2 flex items-center">
                        <span class="block ">{{ date('d-m-Y', strtotime($trip->trip_date)); }}</span>
                    </div>
                    <div class="mt-2 flex flex-col items-center">
                        @component('components.newbadge')
                        @endcomponent
                        @component('components.addedtimebadge', ['addedTime' => $trip->created_at->shortRelativeDiffForHumans()])
                        @endcomponent
                    </div>

            </td>
            <td class="px-4 text-sm">
                {{ $trip->total_weight }} KG
            </td>
            <td class="flex flex-col px-4 text-sm">
                @foreach ($trip->lorries()->get() as $lorry)
                    <span class="mt-2">{{ $lorry->plate_no}}</span>
                    <span class="text-gray-500 text-xs">{{ $lorry->capacity}} KG</span>
                @endforeach
            </td>
            <td class="px-4 text-sm">
                @foreach ($trip->drivers()->get() as $driver)
                    {{ $driver->name }}
                @endforeach
                
            </td>
            <td class="px-4 py-3 text-sm">
                @foreach ($trip->workmen()->get() as $workman)
                    <ul class="list-disc list-inside">
                        <li>▪ {{ $workman->name }}</li>
                    </ul>
                @endforeach
                
            </td>
            <td class="px-4 text-sm">
                    @foreach ($trip->lorries()->get() as $lorry)
                    {{ $lorry->outlet }}</span>
                @endforeach
            </td>
            <td class="px-4">
                <div class="flex items-center space-x-4 text-sm">
                    <button
                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                        aria-label="Edit">
                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                            </path>
                        </svg>
                    </button>
                    <button
                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                    aria-label="Delete">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
                </svg>
            </button>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>