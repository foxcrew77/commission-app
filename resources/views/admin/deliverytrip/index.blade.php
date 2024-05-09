@extends('layouts.admin')
@section('content')
<div class="container grid px-6 mx-auto mb-6">
    @component('components.tables.table-title', ['title' => 'Delivery Trip'])
    @endcomponent
    @component('components.tables.delivery_trip-index-table-filter')
    @endcomponent
    {{ $delivery_trip->links() }}
    
    <div class="w-full overflow-visible rounded-lg shadow-xs">
        
        <div class="w-full overflow-x-auto">
            
            @include('includes.tables.deliveryTripTable')
        </div>
        {{ $delivery_trip->links() }}
    </div>
</div>

@endsection


