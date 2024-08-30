@extends("layout")
@section("pageTitle", "Cadastro")
@section("style")
<link rel="stylesheet" href="{{ asset('asset/css/default.css') }}" type="text/css" />
@endsection
@section("voltar")
<li><a href="{{ asset('/') }}" class="lista">Voltar</a></li>
@endsection
@section("content")
<div class="container">
    <h1>Cadastro</h1>
    <ul class="link-list">
        <li><a href="{{ route('aplicacao.index') }}">Aplicação</a></li>
        <li><a href="{{ route('produto.index') }}">Produto</a></li>
        <li><a href="{{ route('montadora.index') }}">Montadora</a></li>
        <li><a href="{{ route('modelo.index') }}">Modelo</a></li>
        <li><a href="{{ route('grupo.index') }}">Grupo</a></li>
        <li><a href="{{ route('motor.index') }}">Motor</a></li>
        <li><a href="{{ route('posicao.index') }}">Posição</a></li>
    </ul>
</div>
@endsection
