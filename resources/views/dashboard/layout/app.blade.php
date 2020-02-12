<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Triptamine Dashboard - Lets craft some awesome travel experiences!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        <meta name="description" content="This is an example dashboard created using build-in elements and components.">
        <meta name="msapplication-tap-highlight" content="no">
        <!--
        =========================================================
        * ArchitectUI HTML Theme Dashboard - v1.0.0
        =========================================================
        * Product Page: https://dashboardpack.com
        * Copyright 2019 DashboardPack (https://dashboardpack.com)
        * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
        =========================================================
        * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
        -->
    <link href="{{asset('css/main.css')}}" rel="stylesheet"></head>

    {{-- this are additional stylesheets compiled from the React Dashboard SASS files. --}}
    <link href="{{asset('css/main-2.css')}}" rel="stylesheet"></head>
    <link href="{{asset('css/main-3.css')}}" rel="stylesheet"></head>
    <link href="{{asset('css/main-4.css')}}" rel="stylesheet"></head>

    {{-- Icons/Fonts --}}
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pe-icon-7-stroke.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lnr-icons.css') }}" rel="stylesheet">


    </head>    
    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">

            @include('dashboard.layout.header')

            <div class="app-main">

                {{-- Sidebar --}}
                @include('dashboard.layout.sidebar')

                <div class="app-main__outer">

                    {{-- Main content --}}
                        <div class="app-main__inner">
                            @yield('content')
                        </div>
                    {{-- Footer --}}
                    @include('dashboard.layout.footer')
                </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    </body>
</html>
