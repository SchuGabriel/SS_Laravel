@extends("layout")
@section("pageTitle", "Home")
@section("style")
<link rel="stylesheet" href="{{ asset('asset/css/default.css') }}" type="text/css" />
@endsection
@section("content")
<div class="container">
    <h1>Bem vindo</h1>
    <ul class="link-list">
        <li><a href="{{ route('produto.index') }}">Produtos</a></li>
        <li><a href="{{ route('montadora.index') }}">Montadora</a></li>
        <li><a href="{{ route('modelo.index') }}">Modelo</a></li>
        <li><a href="{{ route('grupo.index') }}">Grupo</a></li>
    </ul>
</div>
@endsection
