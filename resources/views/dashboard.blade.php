<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Auth::check()) 
        <meta name="user-id" content="{{ Auth::user()->id }}"> 
    @endif

    <title>{{ 'Travel Blog' }}</title>
    <link rel="icon" href="{!! asset('/storage/images/compass.ico') !!}"/>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" defer></script>
        @yield('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    @yield('header')
    <main>
        <div class="section dashboard" id="admin">
        @if (session('status'))
            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
        @endif
        
            <div class="row m-0">
                <div class="col-12 col-md-5 col-lg-4 shadow-lg p-3 dashboard-block">
                    <div class="card dashboard-card">
                        <div class="avatar-border my-3 mx-auto">
                            <img src="/storage/avatars/{{ Auth::user()->avatar}}" class="card-img-top dashboard-avatar rounded" alt="Photo of user">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title text-center">{{ Auth::user()->name }}</h3>
                            <p class="card-text text-center font-italic">On Travel Blog from: {{ Auth::user()->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @yield('menu')
                </div>
                <div class="col-12 col-md-7 col-lg-8 dashboard-block">
                    <div >
                    @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    @yield('footer')
</body>
</html>