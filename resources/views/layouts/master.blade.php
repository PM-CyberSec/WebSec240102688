<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Basic Website - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    @include('layouts.menu')
    <div class="card m-4">
        <div class="card-header">Master</div>
    </div>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
