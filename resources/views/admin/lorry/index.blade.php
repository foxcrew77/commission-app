@extends('layouts.admin')
@section('content')
<div class="container grid px-6 mx-auto mb-6">
    @component('components.tables.table-title', [
        'title' => 'Lorry',
        'resetRoute' => 'admin.lorry.index'
        ])
    @endcomponent
    @component('components.tables.index-table-filter',[
        'addNew' => 'Add New Lorry',
        'createRoute' => 'admin.lorry.create',
        'filterByCriteria' => ['Plate Number' => 'plate_no', 'Capacity' => 'capacity', 'Outlet' => 'outlet'],
        'statusFilter' => ['All' => '%active%', 'Active' => 'active', 'Inactive' => 'inactive'],
        'firstFilterBy' => 'plate_no'
        ])
    @endcomponent
    {{ $lorries->links() }}
    <div class="w-full overflow-visible rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            @include('includes.tables.lorryTable')
        </div>
        {{ $lorries->links() }}
    </div>
</div>
<script src="{{ asset("assets/js/clickable-row.js") }}" defer></script>

@endsection


