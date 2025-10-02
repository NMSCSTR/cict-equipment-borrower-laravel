<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield("title", "Welcome")</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

        <!-- Google Font: Poppins -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
         <link rel="shortcut icon" href="https://www.nmsc.edu.ph/application/files/9117/2319/6158/CICT_LOGO.png" type="image/x-icon">
         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

         <!-- Include DataTables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.tailwindcss.min.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/dataTables.tailwindcss.min.js"></script>

        <style>
            body {
                font-family: 'Poppins', sans-serif;
            }

        </style>

        @stack('styles')
        <!-- Tailwind (via Vite) -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body >
        <div class="my-4"></div>
        @yield("content")
        @stack('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
