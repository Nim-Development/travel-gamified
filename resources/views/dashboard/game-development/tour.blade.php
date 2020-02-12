@extends('dashboard.layout.app')

@section('content')    

    {{-- React Tours component --}}
    <div 
        tour="{{ json_encode($tour) }}" 
        itineraries="{{ json_encode($itineraries) }}"  
        cities="{{ json_encode($cities) }}" 
        routes="{{ json_encode($routes) }}" 
        transits="{{ json_encode($transits) }}" 
        
        id="tour"></div>

@endsection