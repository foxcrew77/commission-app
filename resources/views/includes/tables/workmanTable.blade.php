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
        @foreach ($workmen as $workman)
        <tr 
            data-href="{{ route('admin.workman.show',['workman' => $workman->slug]) }}"
            class="cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3 text-sm">{{ $workmen->firstItem() + $loop->index}}</td>
            <td class="px-4 py-3 text-sm">{{ $workman->name }}</td>
            <td class="px-4 py-3 text-sm">{{ $workman->outlet }}</td>
            <td class="px-4 py-3 text-sm">{{ $workman->status }}</td>
            <td class="px-4 py-3 text-sm">{{ $workman->updated_at }}</td>
            <td class="px-4 py-3">
                @component('components.navigation.edit-delete-button', [
                    'route' => route( 'admin.workman.edit',['workman' => $workman->slug]),
                    'deleteRoute' => route( 'admin.workman.destroy',['workman' => $workman->slug]),
                    ])
                @endcomponent
            </td>
        </tr>
        @endforeach

    </tbody>
</table>