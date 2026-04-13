<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'MahoraPOS' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex bg-slate-50 antialiased">

    <x-sidebar />

    <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
        <x-navbar />
        <main class="flex-1 overflow-y-auto p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
