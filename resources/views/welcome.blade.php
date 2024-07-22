<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aplicación</title>
        @vite('resources/css/app.css', $mode = 'development', $ref = true)
    </head>
    <body>
        <div id="app"></div>
        @vite('resources/js/app.js', $mode = 'development', $ref = true)
    </body>
</html>
