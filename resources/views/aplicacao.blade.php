@extends("layout")
@section("pageTitle", "Aplicacao")
@section("content")
<div class="master-container">
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
            <div class="inputs-container">
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
                <div class="container-qtd_mult">

                    <div class="input">
                        <br><br>
                        <select class="js-example-basic-single2" name="posicao_id" id="posicao_id">
                            <option value=""></option>
                            @foreach($posicoes as $posicao)
                            <option value="{{ $posicao->id }}">{{ $posicao->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input">
                        <label for="ano_ini">Ano Inicial:</label>
                        <input type="text" name="ano_ini">
                    </div>

                    <div class="input">
                        <label for="ano_fim">Ano Final:</label>
                        <input type="text" name="ano_fim">
                    </div>
                </div>

                <div class="input">
                    <label for="observacao">Observação:</label>
                    <textarea name="observacao" id="observacao" rows="5" cols="70"></textarea>
                </div>
            </div>
            <div class="submit-container">
                <button type="submit">Salvar</button>
            </div>
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
            @foreach($aplicacoes as $aplicacao)
            <tr>
                <td>{{ $aplicacao->modelo }}</td>
                <td>{{ $aplicacao->motor }}</td>
                <td>{{ $aplicacao->posicao }}</td>
                <td>{{ $aplicacao->ano_inicial }} Até {{ $aplicacao->ano_final }}</td>
                <td>{{ $aplicacao->observacao }}</td>
            </tr>
            @endforeach
        </table>
    </div>
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