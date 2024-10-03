<table class="w-full whitespace-no-wrap">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">No.</th>
            <th class="px-4 py-3">@sortablelink('name', 'Name')</th>
            <th class="px-4 py-3">@sortablelink('outlet', 'Outlet')</th>
            <th class="px-4 py-3">@sortablelink('status', 'Status')</th>
            <th class="px-4 py-3">@sortablelink('updated_at', 'Updated at')</th>
            <th class="px-4 py-3">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($drivers as $driver)
        <tr 
            data-href="{{ route('admin.driver.show',['driver' => $driver->slug]) }}"
            class="cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm">{{ $drivers->firstItem() + $loop->index}}</td>
            <td class="px-4 py-3 text-sm">{{ $driver->name }}</td>
            <td class="px-4 py-3 text-sm">{{ $driver->outlet }}</td>
            <td class="px-4 py-3 text-sm">{{ $driver->status }}</td>
            <td class="px-4 py-3 text-sm">{{ $driver->updated_at }}</td>
            <td class="px-4 py-3">
                @component('components.navigation.edit-delete-button', [
                    'route' => route( 'admin.driver.edit',['driver' => $driver->slug]),
                    'deleteRoute' => route( 'admin.driver.destroy',['driver' => $driver->slug]),
                    ])
                @endcomponent
            </td>
        </tr>
        @endforeach

    </tbody>
</table>