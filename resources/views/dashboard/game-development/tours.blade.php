@extends('dashboard.layout.app')

@section('content')    

    {{-- React Tours component --}}
    <div tours="{{ json_encode($tours) }}" id="tours"></div>

@endsection