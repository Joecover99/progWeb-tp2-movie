<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel's cursed home Page</title>
    </head>
    <body>
        <h1>Errors:</h1>
        <pre>{{ $errors }}</pre>
    </body>
</html>
