@extends('layouts.admin')
@section('content')
        {{-- <div class="container px-6 mx-auto grid"> --}}
        <div class="container px-6 mx-auto">
            <h2
                class="mt-4 text-2xl font-semibold text-gray-700 dark:text-gray-200"
            >
                {{ $delivery_trip->slug }}
            </h2>

            <!-- General elements -->
            <h4
                class="mb-4 mt-2 text-lg font-semibold text-gray-600 dark:text-gray-300"
            >
                Delivery Trip Details
            </h4>
            <div
                class="w-full px-4 py-3 bg-white rounded-lg shadow-md dark:bg-gray-800"
            >
            @include('includes.back-button', [
                'IndexRoute' => 'admin.deliverytrip.index',
                'route' => route( 'admin.deliverytrip.edit',['deliverytrip' => $delivery_trip->slug]),
                'deleteRoute' => route( 'admin.deliverytrip.destroy',['deliverytrip' => $delivery_trip->slug]),
                ])
            <div class="w-auto overflow-visible rounded-lg shadow-xs">
                <div class="w-auto overflow-x-auto">
                <div class="flex flex-row">
                    <div class="flex flex-col w-64">
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">No.</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Date</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Document No.</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Lorry</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Driver</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Workman</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Outlet</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Created By</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Created At</div>
                    <div class="px-4 py-4 text-sm font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">Updated At</div>
                    </div>
                    <div class="flex flex-col w-full">
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $delivery_trip->id }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $delivery_trip->trip_date }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $delivery_trip->slug }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $delivery_trip->lorries()->get()[0]->plate_no }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $delivery_trip->drivers()->get()[0]->name }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">
                        @if(count($delivery_trip->workmen()->get()) == 2)
                        {{ $delivery_trip->workmen()->get()[0]->name }} & {{ $delivery_trip->workmen()->get()[1]->name }}
                        @else
                        {{ $delivery_trip->workmen()->get()[0]->name }}
                        @endif
                    </div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $outlet }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $created_by->name }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $delivery_trip->created_at }}</div>
                    <div class="px-4 py-4 text-sm font-semibold cursor-pointer hover:bg-gray-100 text-gray-700 dark:text-gray-400 divide-y border-b">{{ $delivery_trip->updated_at }}</div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            @component('components.navigation.back-button',['IndexRoute' => 'admin.deliverytrip.index'])
                
            @endcomponent
        </div>
@endsection
