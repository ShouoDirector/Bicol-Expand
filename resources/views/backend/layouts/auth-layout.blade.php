<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <base href="/">
    <link href="./backend/dist/css/tabler.min.css?1684106062" rel="stylesheet" />
    <link href="./backend/dist/css/tabler-flags.min.css?1684106062" rel="stylesheet" />
    <link href="./backend/dist/css/tabler-payments.min.css?1684106062" rel="stylesheet" />
    <link href="./backend/dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet" />

    @stack('stylesheets')
    @livewireStyles

    <link href="./backend/dist/css/demo.min.css?1684106062" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }

    </style>
</head>

<body class=" d-flex flex-column">
    <script src="./backend/dist/js/demo-theme.min.js?1684106062"></script>
    @yield('content')
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./backend/dist/js/tabler.min.js?1684106062" defer></script>
    
    @stack('scripts')
    @livewireScripts

    <script src="./backend/dist/js/demo.min.js?1684106062" defer></script>
</body>

</html>
