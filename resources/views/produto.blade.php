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

            <div class="inputs-container">
                <div class="container-ref-nome">
                    <div class="input">
                        <label for="referencia">Referencia:</label>
                        <input type="text" name="referencia" id="referencia" value="{{ $produto->referencia }}">
                    </div>

                    <div class="input" id="nome">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" value="{{ $produto->nome }}">
                    </div>
                </div>

                <div class="input">
                    <label for="cod_similar">Cod Similar (separados por vírgulas):</label>
                    <input type="text" name="cod_similar" id="cod_similar" value="{{ $produto->cod_similar->pluck('nome')->implode(',') }}">
                </div>

                <div class="container-qtd_mult">
                    <div class="input">
                        <label for="quant_carro">Qtd Carro:</label>
                        <input type="text" name="quant_carro" id="quant_carro" value="{{ $produto->quant_carro }}">
                    </div>

                    <div class="input">
                        <label for="multiplo">Multiplo:</label>
                        <input type="text" name="multiplo" id="multiplo" value="{{ $produto->multiplo }}">
                    </div>
                    <div class="input">
                        <label for="observacao">Observação:</label>
                        <input type="text" name="observacao" id="observacao" value="{{ $produto->observacao }}">
                    </div>

                </div>
                <div class="input">
                    <label for="grupo">Selecione o Grupo:</label>
                    <select class="js-example-basic-multiple" name="grupo_id[]" id="grupo_id" multiple="multiple">
                        @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}"
                            {{ $grupo_id == $grupo->id ? 'selected' : '' }}>{{ $grupo->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="submit-container">
                <button type="submit">Salvar</button>
            </div>
        </form>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2({
            placeholder: "Selecione os grupos"
        });
    });
</script>
@endsection