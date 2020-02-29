@extends('dashboard.layout.app')

@section('content')    

    {{-- React Tours component --}}
    <div routes="{{ json_encode($routes) }}" id="routes"></div>

@endsection