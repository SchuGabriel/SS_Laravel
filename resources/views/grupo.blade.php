@extends("layout")
@section('pageTitle', "Novo Grupo")
@section("content")
<div class="container">
    <h1>Novo Grupo</h1>
    <a href="{{ route('grupo.index') }}">Voltar</a>
    @if($grupo->id)
    <form action="{{ route('grupo.update', ['id'=>$grupo->id]) }}" method="post" enctype="multipart/form-data">
        @method("PUT")
        @else
        <form action="{{ route('grupo.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $grupo->nome }}">

            <button type="submit">Salvar</button>
        </form>
</div>
@endsection