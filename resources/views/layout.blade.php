<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("pageTitle")</title>
    <link rel="stylesheet" href="{{ asset('/css/default.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/css/select2.css') }}" type="text/css" />
    @yield("style")
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<header class="cabecalho">
    <nav class="menu">
        <ul class="colunas">
            <li><a href="{{ asset('/') }}" class="lista">Home</a></li>
        </ul>
    </nav>
</header>

<body>
    @include("includes.errors")
    @yield("content")
    <footer class="footer">
        <p>© 2024 - Desenvolvido por Gabriel Schu</p>
    </footer>
</body>

</html>