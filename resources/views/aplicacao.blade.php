@extends("layout")
@section("pageTitle", "Aplicacao")
@section("content")
<div class="container">
    <form method="POST" action="{{ route('aplicacao.search') }}">
        @csrf
        <div>
            <div class="label_input">
                <label for="referencia">Referencia:</label>
                <input type="text" name="referencia" id="referencia">
            </div>
            <button type="submit">Buscar</button>
        </div>
    </form>
</div>
@if($produto)
<div class="container">
    <form method="POST" action="{{ route('aplicacao.store') }}">
        @csrf
        <h2>Aplicação</h2>

        <select class="js-example-basic-multiple1" name="modelo_id[]" id="modelo_id" multiple>
            <option value=""></option>
            @foreach($modelos as $modelo)
            <option value="{{ $modelo->id }}">{{ $modelo->nome }}</option>
            @endforeach
        </select>

        <select class="js-example-basic-single2" name="posicao_id" id="posicao_id">
            <option value=""></option>
            @foreach($posicoes as $posicao)
            <option value="{{ $posicao->id }}">{{ $posicao->nome }}</option>
            @endforeach
        </select>

        <label for="ano_ini">Ano Inicial:</label>
        <input type="text">

        <label for="ano_fim">Ano Final:</label>
        <input type="text">

        <select class="js-example-basic-multiple2" name="motor_id[]" id="motor_id" multiple>
            <option value=""></option>
            @foreach($motores as $motor)
            <option value="{{ $motor->id }}">{{ $motor->nome }}</option>
            @endforeach
        </select>

        <label for="observacao">Observação:</label>
        <textarea name="observacao" id="observacao" rows="5" cols="70"></textarea>
    </form>
</div>
@endif
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple1').select2({
            placeholder: "Selecione as modelos"
        });
        $('.js-example-basic-single2').select2({
            placeholder: "Selecione a posição"
        });
        $('.js-example-basic-multiple2').select2({
            placeholder: "Selecione os motores",
        });
    });
</script>
@endsection