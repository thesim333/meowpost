<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cat Tails: @yield('title')</title>

    @section('meta_tags')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    @show

    @section('styles')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @show

    @section('scripts')

    @show
</head>
<body>
    <div class="container">
        @section('header')
            <header class="my-4 text-center">
                <h1>@yield('heading')</h1>
            </header>
        @show

        @section('content')

        @show

        @section('footer')

        @show
    </div>
</body>
</html>