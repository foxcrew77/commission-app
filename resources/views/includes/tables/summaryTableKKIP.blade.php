<div class="flex flex-col w-full mb-2">
    <div class="w-full py-2 text-sm font-bold tracking-wide text-gray-600 uppercase border dark:border-gray-600 bg-gray-50 dark:text-gray-400 dark:bg-gray-700">
        @foreach ($totalKKIPMonthlyCommission[0] as $comm)
        {{ $outlet }} (Total: $ {{ $comm }})
        @endforeach
    </div>
    <div class="content flex flex-row w-full">
        <div class="column w-full">
            <table class="w-full whitespace-no-wrap" style="border-collapse: collapse;"> 
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-gray-500 uppercase border dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    {{-- <th class="px-4 py-3 text-center" colspan="4">KKIP Commission</th> --}}
                </tr>
                <tr
                    class="text-xs font-semibold tracking-wide text-gray-500 uppercase border dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-4 py-2 border" colspan="2">Driver</th>
                </tr>
                </thead>
                <tbody
                class="bg-white divide-y dark:divide-gray-700 border dark:bg-gray-800 text-sm"
                >
                <?php  $sumDriver = 0 ?>
                @foreach ($KKIPdriverMonthlyCommission as $comm)
                    
                {{-- first row --}}
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-semibold border">
                            {{ $comm->Driver }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $comm->Commission }}
                    </td>
                </tr>
                <?php  $sumDriver += $comm->Commission ?>
                @endforeach
                </tr>
                <tr>
                    <td class="px-4 py-3 font-bold border dark:text-gray-400">Total (Driver):</td>
                    <td class="px-4 py-3 text-sm font-semibold dark:text-gray-400">{{ $sumDriver }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="column w-full">
            <table class="w-full whitespace-no-wrap"> 
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-gray-500 uppercase border dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    {{-- <th class="px-4 py-3 text-center" colspan="4">KK2 Commission</th> --}}
                </tr>
                <tr
                    class="text-xs font-semibold tracking-wide text-gray-500 uppercase border dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-4 py-2 border" colspan="2">Workman</th>
                </tr>
                </thead>
                <tbody
                class="bg-white divide-y dark:divide-gray-700 border dark:bg-gray-800 text-sm"
                >
                {{-- first row --}}
                <?php  $sumDriver = 0 ?>
                @foreach ($KKIPworkmanMonthlyCommission as $comm)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-semibold border">
                        {{ $comm->Workman }}
                    </td>
                    <td class="px-4 py-3 text-sm">
                        {{ $comm->Commission }}
                    </td>
                </tr>
                <?php  $sumDriver += $comm->Commission ?>
                @endforeach
                <tr>
                    <td class="px-4 py-3 font-bold border dark:text-gray-400">Total (Workman):</td>
                    <td class="px-4 py-3 text-sm font-semibold dark:text-gray-400">{{ $sumDriver }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>