<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Vuetify CSS -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        <div id="app"></div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
