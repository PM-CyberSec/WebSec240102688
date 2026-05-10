<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>WebSecService</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/future.css') }}">
</head>
<body class="has-fixed-navbar">
    @include('layouts.menu')

    @yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Initialize particles
    if (document.getElementById("particles-js")) {
        particlesJS("particles-js", {
            "particles": {
                "number": { "value": 80 },
                "color": { "value": "#00e5ff" },
                "shape": { "type": "triangle" },
                "opacity": { "value": 0.5 },
                "size": { "value": 3 },
                "move": {
                    "enable": true,
                    "speed": 2
                }
            }
        });
    }

    // Initialize TomSelect on all .form-select elements
    document.querySelectorAll('.form-select').forEach(el => {
        if (!el.classList.contains('no-ts')) {
            new TomSelect(el, {
                create: el.multiple ? true : false,
                plugins: el.multiple ? ['remove_button'] : [],
                persist: false,
                dropdownParent: 'body', // Portals dropdown to body to avoid stacking context issues
            });
        }
    });
});
</script>
</body>
</html>
