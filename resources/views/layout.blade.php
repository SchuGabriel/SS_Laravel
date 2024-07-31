<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield("pageTitle")</title>
    @yield("style")
</head>
<header class="cabecalho">
    <nav class="menu">
        <ul class="colunas">
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