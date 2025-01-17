<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto Laravel con Vue 3</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- @vite('resources/js/app.js') <!-- Carga el archivo app.js compilado por Vite --> --}}
</head>
<body class="font-sans antialiased bg-slate-100">
    <div class="bg-slate-100 p-4">
        <div id="app"></div>
    </div>
</body>
</html>
