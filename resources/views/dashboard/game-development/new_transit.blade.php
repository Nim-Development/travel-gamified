@extends('dashboard.layout.app')

@section('content')    

    {{-- React Tours component --}}
    <div routes="{{ json_encode($routes) }}" cities="{{ json_encode($cities) }}" id="new_transit"></div>

@endsection