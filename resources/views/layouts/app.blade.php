<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar p-0">
            <h4 class="text-white text-center py-3 border-bottom">
                Bulk Portal
            </h4>

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('contacts.index') }}"
               class="{{ request()->routeIs('contacts.*') ? 'active' : '' }}">
                Contacts
            </a>

            <a href="{{ route('templates.index') }}"
               class="{{ request()->routeIs('templates.*') ? 'active' : '' }}">
                Templates
            </a>

            <a href="{{ route('campaigns.index') }}"
               class="{{ request()->routeIs('campaigns.*') ? 'active' : '' }}">
                Campaigns
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                        class="btn btn-danger w-100 rounded-0 mt-4">
                    Logout
                </button>
            </form>
        </div>

        <div class="col-md-10">
            <nav class="navbar navbar-light bg-white border-bottom px-3">
                <span class="navbar-brand mb-0 h5">
                    Bulk Email Management Portal
                </span>

                <div>
                    Logged in as:
                    <strong>{{ auth()->user()->name }}</strong>
                </div>
            </nav>

            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

    </div>
</div>
@stack('scripts')
</body>
</html>