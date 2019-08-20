<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <style>
            body {
                margin-top: 70px;
            }
        </style>
    </head>
    <body>
        <div id="app">
            <example-component></example-component>   
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            window.Echo.channel('canal')
                .listen('EventSocket', (e) => {
                    console.log("Lo escuche: ");
                    console.log(e);
                });
        </script>
    </body>
</html>
