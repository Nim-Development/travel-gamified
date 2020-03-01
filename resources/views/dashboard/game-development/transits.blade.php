@extends('dashboard.layout.app')

@section('content')    

    {{-- React Tours component --}}
    <div transits="{{ json_encode($transits) }}" id="transits"></div>

@endsection