@extends("layout")
@section('pageTitle', "Novo Produto")
@section("content")
<div class="container">
    <h1>Novo Produto</h1>
    <a href="{{ route('produto.index') }}">Voltar</a>
    @if($produto->id)
    <form action="{{ route('produto.update', ['id' => $produto->id]) }}" method="post" enctype="multipart/form-data">
        @method("PUT")
        @else
        <form action="{{ route('produto.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf

            <label for="referencia">Referencia:</label>
            <input type="text" name="referencia" id="referencia" value="{{ $produto->referencia }}">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $produto->nome }}">

            <label for="observacao">Observação:</label>
            <input type="text" name="observacao" id="observacao" value="{{ $produto->observacao }}">

            <label for="quant_carro">Qtd Carro:</label>
            <input type="text" name="quant_carro" id="quant_carro" value="{{ $produto->quant_carro }}">

            <label for="multiplo">Multiplo:</label>
            <input type="text" name="multiplo" id="multiplo" value="{{ $produto->multiplo }}">

            <label for="cod_similar">Cod Similar (separados por vírgulas):</label>
            <input type="text" name="cod_similar" id="cod_similar" value="{{ $produto->cod_similar->pluck('nome')->implode(',') }}">

            <select name="grupo_id" id="grupo_id">
                @foreach ($grupos as $grupo)
                <option value="{{ $grupo->id }}" 
                    {{ $grupo_id == $grupo->id ? 'selected' : '' }}
                    >{{ $grupo->nome }}</option>
                @endforeach
            </select>

            <button type="submit">Salvar</button>
        </form>
</div>
@endsection