@extends("layout")
@section('pageTitle', "Nova Montadora")
@section("content")
<div class="container">
    <h1>Nova Montadora</h1>
    <a href="{{ route('montadora.index') }}">Voltar</a>
    @if($montadora->id)
    <form action="{{ route('montadora.update', ['id'=>$montadora->id]) }}" method="post" enctype="multipart/form-data">
        @method("PUT")
        @else
        <form action="{{ route('montadora.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $montadora->nome }}">

            <button type="submit">Salvar</button>
        </form>
</div>
@endsection