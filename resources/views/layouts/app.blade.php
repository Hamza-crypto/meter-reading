<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Consumption Tracking</title>
    <!-- Include any CSS, JavaScript, or meta tags needed for your application -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Electricity Consumption Tracking
            </a>
            <!-- Other navigation links -->
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <!-- Include any JavaScript files needed for your application -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
