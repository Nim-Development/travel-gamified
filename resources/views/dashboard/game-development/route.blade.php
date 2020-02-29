@extends('dashboard.layout.app')

@section('content')    

    {{-- React Tours component --}}
    <div route="{{ json_encode($route) }}" transits="{{ json_encode($transits) }}" id="route"></div>

@endsection