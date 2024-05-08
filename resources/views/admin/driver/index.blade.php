@extends('layouts.admin')
@section('content')
<div class="container grid px-6 mx-auto">
    <h2 class="mt-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Driver
    </h2>
    <div class="my-4 mt-2 flex sm:flex-row justify-between focus-within:text-purple-500">
        <div class="flex  sm:flex-row">
            <div class="flex flex-row mb-2 sm:mb-0">
                <div class="relative">
                    <select
                        class="cursor-pointer w-full text-sm text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
                        <option class="">All</option>
                        <option selected>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
            </div>
            <div class="block relative text-purple-500">
                <input 
                class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-white border-gray-500 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                type="text"
                placeholder="Search for driver"
                aria-label="Search" />
            </div>
        </div>
        <div class="">
            <a href="{{ route('admin.driver.create')}}">
                <button
                        class="flex items-center justify-between px-4 w-full py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                >
                    Add New Driver
                    <span class="ml-2" aria-hidden="true">+</span>
            </button>
        </a>
        </div>
    </div>
    {{ $drivers->links() }}
    <div class="w-full overflow-visible rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">No.</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Outlet</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($drivers as $driver)
                    <tr 
                        data-href="{{ route('admin.driver.show',['driver' => $driver->id]) }}"
                        class="cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">{{ $drivers->firstItem() + $loop->index}}</td>
                        <td class="px-4 py-3 text-sm">{{ $driver->name }}</td>
                        <td class="px-4 py-3 text-sm">{{ $driver->outlet }}</td>
                        <td class="px-4 py-3">
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
        </div>
        {{ $drivers->links() }}
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rows = document.querySelectorAll('tr[data-href]');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                window.location.href = row.dataset.href;
            })
        });
    });
</script>

@endsection


