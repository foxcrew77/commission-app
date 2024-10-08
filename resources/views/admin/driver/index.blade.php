@extends('layouts.admin')
@section('content')
<div class="container grid px-6 mt-4 mx-auto mb-6">
    @component('components.tables.table-title', [
        'title' => 'Driver',
        'resetRoute' => 'admin.driver.index'
        ])
        
    @endcomponent
    @component('components.tables.index-table-filter',[
        'addNew' => 'Add New Driver',
        'createRoute' => 'admin.driver.create',
        'filterByCriteria' => ['Name' => 'name', 'Outlet' => 'outlet'],
        'statusFilter' => ['All' => '%active%', 'Active' => 'active', 'Inactive' => 'inactive'],
        'firstFilterBy' => 'name'
        ])
    @endcomponent
    {{ $drivers->links() }}
    <div class="w-full overflow-visible rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @include('includes.tables.driverTable')
        </div>
        {{ $drivers->links() }}
    </div>
</div>
<script src="{{ asset("assets/js/clickable-row.js") }}" defer></script>

@endsection


