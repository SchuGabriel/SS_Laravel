@extends("layout")
@section("pageTitle", "Conferencia")
@section("content")
<div class="container">
    <h1>Cadastro</h1>
    <ul class="link-list">
        <li><a href="{{ route('conferencia.entrada') }}">Chegada de Material</a></li>
        <li><a href="{{ route('conferencia.saida') }}">Saída de Material</a></li>
    </ul>
</div>
@endsection
