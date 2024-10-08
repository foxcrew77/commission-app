@extends('layouts.admin')
@section('content')
<style>
    @media (prefers-color-scheme: dark) {
  i {
    stroke: aliceblue;
  }
}
</style>
        {{-- <div class="container px-6 mx-auto grid"> --}}
        <div class="container px-6 mx-auto">
            <h2
                class="mt-4 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
                {{ $workman->name }}
            </h2>

            <!-- General elements -->
            <h4
                class="mb-4 mt-2 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
                Driver Details
            </h4>
            
            <div
                class="w-full px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            
            @include('includes.back-button', [
                'IndexRoute' => 'admin.driver.index',
                'route' => route( 'admin.workman.edit',['workman' => $workman->slug]),
                'deleteRoute' => route( 'admin.workman.destroy',['workman' => $workman->slug]),
                ])
            <div class="w-auto overflow-visible rounded-lg shadow-xs">
                <div class="w-auto overflow-x-auto">
                <div class="flex flex-row">
                    <div class="flex flex-col w-64">
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">No.</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Name</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Driver ID</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Outlet</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Status</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Last Update By</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Created At</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Updated At</div>
                    </div>
                    <div class="flex flex-col w-full">
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $workman->id }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $workman->name }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">
                        @if($workman->asWorkman_id == 0)
                        -
                        @else
                        {{ $workman->asWorkman_id }}
                        @endif
                    </div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $workman->outlet }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $workman->status }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $created_by->name }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $workman->created_at }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $workman->updated_at }}</div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            @component('components.navigation.back-button',['IndexRoute' => 'admin.workman.index'])
                
            @endcomponent
        </div>
@endsection
