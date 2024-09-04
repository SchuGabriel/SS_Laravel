@extends("layout")
@section("pageTitle", "Home")
@section("style")
<link rel="stylesheet" href="{{ asset('asset/css/default.css') }}" type="text/css" />
@endsection
@section("content")
<div class="container">
    <h1>Bem vindo</h1>
    <ul class="link-list">
        <li><a href="{{ route('home.pesquisar') }}">Pesquisar</a></li>
        <li><a href="{{ route('home.cadastro') }}">Cadastro</a></li>
        <li><a href="{{ route('home.conferencia') }}">Conferencia</a></li>
    </ul>
</div>
@endsection
