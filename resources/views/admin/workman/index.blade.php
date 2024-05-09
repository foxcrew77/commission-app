@extends('layouts.admin')
@section('content')
<div class="container grid px-6 mx-auto mb-6">
    @component('components.tables.table-title', ['title' => 'Workman'])
        
    @endcomponent
    @component('components.tables.index-table-filter',[
        'placeholder' => 'Search for workman',
        'addNew' => 'Add New Workman',
        'createRoute' => 'admin.workman.create'])
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


