@extends("layout")
@section("pageTitle", "Aplicacao")
@section("content")
<div class="container">
    <form method="POST" action="{{ route('aplicacao.search') }}">
        @csrf
        <div>
            <div class="label_input">
                <label for="referencia">Referencia:</label>
                <input type="text" name="referencia" id="referencia" @if($produto) value="{{ old('referencia', $produto->referencia) }}" @endif>
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

        <input type="hidden" name='produto_id' value="{{ $produto->id }}">

        <select class="js-example-basic-multiple1" name="modelo_id[]" id="modelo_id" multiple>
            <option value=""></option>
            @foreach($modelos as $modelo)
            <option value="{{ $modelo->id }}">{{ $modelo->nome }}</option>
            @endforeach
        </select>
        <br><br>
        <select class="js-example-basic-multiple2" name="motor_id[]" id="motor_id" multiple>
            <option value=""></option>
            @foreach($motores as $motor)
            <option value="{{ $motor->id }}">{{ $motor->nome }}</option>
            @endforeach
        </select>
        <br><br>
        <select class="js-example-basic-single2" name="posicao_id" id="posicao_id">
            <option value=""></option>
            @foreach($posicoes as $posicao)
            <option value="{{ $posicao->id }}">{{ $posicao->nome }}</option>
            @endforeach
        </select>

        <label for="ano_ini">Ano Inicial:</label>
        <input type="text" name="ano_ini">

        <label for="ano_fim">Ano Final:</label>
        <input type="text" name="ano_fim">

        <label for="observacao">Observação:</label>
        <textarea name="observacao" id="observacao" rows="5" cols="70"></textarea>

        <button type="submit">Salvar</button>
    </form>
</div>
@endif
@if($aplicacoes)
<div class="container">
    <table>
        <tr>
            <td>Modelo</td>
            <td>Motor</td>
            <td>Posicao</td>
            <td>Ano</td>
            <td>Observação</td>
        </tr>
    </table>
    <hr>
    @foreach($aplicacoes as $aplicacao)
    <table>
        <tr>
            <td>
                @foreach($aplicacao->modelos as $modelos)
                {{ $modelos->nome }}
                <br>
                @endforeach
            </td>
            <td>
                @foreach($aplicacao->motores as $motores)
                {{ $motores->nome }}
                <br>
                @endforeach
            </td>
            <td>{{ $aplicacao->posicao->nome }}</td>
            <td>
                @if($aplicacao->ano_inicial <> null)
                    {{ $aplicacao->ano_inicial }} 
                @else
                    -
                @endif
                á 
                @if($aplicacao->ano_final <> null)
                    {{ $aplicacao->ano_final }}
                @else
                    -
                @endif
            </td>
            <td>{{ $aplicacao->observacao }}</td>
        </tr>
    </table>
    @if($aplicacao->produto_id <> null)<hr>@endif
    @endforeach
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