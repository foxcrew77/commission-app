@extends('layouts.admin')
@section('content')
<div class="container grid px-6 mx-auto mb-6">
    @component('components.tables.table-title', [
        'title' => 'Workman',
        'resetRoute' => 'admin.workman.index'
        ])
        
    @endcomponent
    @component('components.tables.index-table-filter',[
        'addNew' => 'Add New Workman',
        'createRoute' => 'admin.workman.create',
        'filterByCriteria' => ['Name' => 'name', 'Outlet' => 'outlet'],
        'statusFilter' => ['All' => '%active%', 'Active' => 'active', 'Inactive' => 'inactive'],
        'firstFilterBy' => 'name'
        ])
    @endcomponent
    {{ $workmen->links() }}
    <div class="w-full overflow-visible rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @include('includes.tables.workmanTable')
        </div>
        {{ $workmen->links() }}
    </div>
</div>
<script src="{{ asset("assets/js/clickable-row.js") }}" defer></script>

@endsection


