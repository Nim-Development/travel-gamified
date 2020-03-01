@extends('dashboard.layout.app')

@section('content')    

    {{-- React Tours component --}}
    <div transit="{{ json_encode($transit) }}"  routes="{{ json_encode($routes) }}" cities="{{ json_encode($cities) }}" id="transit"></div>

@endsection