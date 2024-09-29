<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'To-Do List')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;

        window.routes = {
            'register': '{{ route('register') }}',
            'dashboard': '{{ route('dashboard') }}',
            'login': '{{ route('login') }}',
            'tasks.store': '{{ route('tasks.store') }}',
            'tasks.index': '{{ route('tasks.index') }}',
            'tasks.update': '{{ route('tasks.update', ['task' => ':task']) }}',
        };
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">To-Do List</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @if (auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" id="logout-link">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-5" id="pjax-container">
    @yield('content')
</div>

<!-- Scripts -->
<script src="/js/app.js"></script>

<!-- Custom Scripts -->
@yield('scripts')

<script>
    // Логика для логаута через AJAX
    $('#logout-link').click(function (event) {
        event.preventDefault();
        $.post('{{ route('logout') }}', {
            _token: '{{ csrf_token() }}'
        }, function () {
            window.location.href = '{{ route('login') }}';
        });
    });
</script>

</body>
</html>
