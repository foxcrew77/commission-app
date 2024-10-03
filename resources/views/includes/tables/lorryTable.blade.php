<table class="w-full whitespace-no-wrap">
    <thead>
        <tr
            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">No.</th>
            <th class="px-4 py-3">@sortablelink('plate_no', 'Plate Number')</th>
            <th class="px-4 py-3">@sortablelink('capacity', 'Capacity (KG)')</th>
            <th class="px-4 py-3">@sortablelink('outlet', 'Outlet')</th>
            <th class="px-4 py-3">@sortablelink('status', 'Status')</th>
            <th class="px-4 py-3">@sortablelink('updated_at', 'Updated at')</th>
            <th class="px-4 py-3">Actions</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach ($lorries as $lorry)
        <tr 
            data-href="{{ route('admin.lorry.show',['lorry' => $lorry->slug]) }}"
            class="cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400" >
            <td class="px-4 py-3 text-sm">{{ $lorries->firstItem() + $loop->index}}</td>
            <td class="px-4 py-3 text-sm">{{ $lorry->plate_no }}</td>
            <td class="px-4 py-3 text-sm">{{ $lorry->capacity }}</td>
            <td class="px-4 py-3 text-sm">{{ $lorry->outlet }}</td>
            <td class="px-4 py-3 text-sm">{{ $lorry->status }}</td>
            <td class="px-4 py-3 text-sm">{{ $lorry->updated_at }}</td>
            <td class="px-4 py-3">
                @component('components.navigation.edit-delete-button', [
                    'route' => route( 'admin.lorry.edit',['lorry' => $lorry->slug]),
                    'deleteRoute' => route( 'admin.lorry.destroy',['lorry' => $lorry->slug]),
                    ])
                @endcomponent
            </td>
        </tr>
        @endforeach
    </tbody>
    {{-- {!! $lorries->appends(Request::except('page'))->render() !!} --}}
</table>