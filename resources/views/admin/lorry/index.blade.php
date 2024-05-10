@extends('layouts.admin')
@section('content')
<div class="container grid px-6 mx-auto mb-6">
    
    @component('components.tables.table-title', ['title' => 'Lorry'])
    @endcomponent
    @component('components.tables.index-table-filter',[
        'placeholder' => 'Search for lorry',
        'addNew' => 'Add New Lorry',
        'createRoute' => 'admin.lorry.create'])
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


