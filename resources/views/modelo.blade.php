@extends("layout")
@section('pageTitle', "Novo Modelo")
@section("content")
<div class="container">
    <h1>Novo Modelo</h1>
    <a href="{{ route('modelo.index') }}">Voltar</a>
    @if($modelo->id)
    <form action="{{ route('modelo.update', ['id'=>$modelo->id]) }}" method="post" enctype="multipart/form-data">
        @method("PUT")
        @else
        <form action="{{ route('modelo.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf

            <select name="montadora_id" id="montadora_id">
                @foreach($montadoras as $montadora)
                <option value="{{ $montadora->id }}"
                    {{ $montadora->id == $modelo->montadora_id ? 'selected': '' }}
                >{{ $montadora->nome }}</option>
                @endforeach
            </select>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $modelo->nome }}">

            <button type="submit">Salvar</button>
        </form>
</div>
@endsection