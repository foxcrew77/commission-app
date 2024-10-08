<table class="w-full whitespace-no-wrap">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4">No.</th>
            <th class="px-4">@sortablelink('trip_date', 'Date')</th>
            <th class="px-4">@sortablelink('total_weight', 'Total Weight')</th>
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
            <td class="flex flex-row gap-px px-4 text-sm">
                    <div class="mr-2 mt-2 flex items-center">
                        <span class="block ">{{ date('d-m-Y', strtotime($trip->trip_date)); }}</span>
                    </div>
                    <div class="mt-2 flex flex-col items-center">
                        {{-- @if ($trip->created_at !== null) --}}
                            @component('components.newbadge', ['addedTime' =>
                            $trip->created_at->shortRelativeDiffForHumans()
                            ])
                            @endcomponent
                            @component('components.addedtimebadge', ['addedTime' =>             $trip->created_at->shortRelativeDiffForHumans()
                            ])
                            @endcomponent
                            
                        {{-- @endif --}}
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
                @component('components.navigation.edit-delete-button', [
                    'route' => route( 'admin.deliverytrip.edit',['deliverytrip' => $trip->slug]),
                    'deleteRoute' => route( 'admin.deliverytrip.destroy',['deliverytrip' => $trip->slug]),
                    ])
                @endcomponent
            </td>
        </tr>
        @endforeach

    </tbody>
</table>