@extends("layout")
@section('pageTitle', "Pesquisar")
@section("content")
<div class="container">
    <a href="{{ route('home.pesquisar') }}">Voltar</a>
    <form action="{{ route('pesquisar.search') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="inputs-container">
            <div class="container-ref-nome">
                <div class="input">
                    <label for="lbl_nome" id="referencia">Referencia:</label>
                    <input type="text" id="referencia" name="referencia">
                </div>
            </div>

            <div class="filtro_container">
                <div class="input">
                    <select class="js-example-basic-single2" name="grupo_id" id="grupo_id">
                        <option value=""></option>
                        @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input">
                    <select class="js-example-basic-single1" name="modelo_id" id="modelo_id">
                        <option value=""></option>
                        @foreach ($modelos as $modelo)
                        <option value="{{ $modelo->id }}">{{ $modelo->nome }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input">
                    <select class="js-example-basic-single3" name="motor_id" id="motor_id">
                        <option value=""></option>
                        @foreach ($motores as $motor)
                        <option value="{{ $motor->id }}">{{ $motor->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="filtro">
                <label for="lbl_Ano">Ano:</label>
                <input type="text" id="ano" name="ano">
            </div>

            <div class="filtro">
                <select class="js-example-basic-single4" name="posicao_id" id="posicao_id">
                    <option value=""></option>
                    @foreach ($posicoes as $posicao)
                    <option value="{{ $posicao->id }}">{{ $posicao->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filtro_submit">
                <button type="submit">Pesquisar</button>
            </div>
        </div>
    </form>
</div>
@foreach ($produtos as $produto)
<div class="container">
    <table>
        <tr>
            <th>Referencia</th>
            <th>Nome</th>
            <th>Qtd. Carro</th>
            <th>Multiplo</th>
            <th>Observacao</th>
        </tr>
        <tr>
            <td>{{ $produto->referencia }}</td>
            <td>{{ $produto->nome }}</td>
            <td>{{ $produto->quant_carro }}</td>
            <td>{{ $produto->multiplo }}</td>
            <td>{{ $produto->observacao }}</td>
        </tr>
    </table>
    <table>
        <tr>
            <th>Modelo</th>
            <th>Motor</th>
            <th>Ano</th>
            <th>Posicao</th>
            <th>Observação</th>
        </tr>
        @foreach ($produto->aplicacoes as $aplicacao)
        <tr>
            <td>{{ $aplicacao->modelo }}</td>
            <td>{{ $aplicacao->motor }}</td>
            <td>{{ $aplicacao->ano_inicial }} Até {{ $aplicacao->ano_final }}</td>
            <td>{{ $aplicacao->posicao }}</td>
            <td>{{ $aplicacao->observacao }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endforeach
<script>
    $('.js-example-basic-single1').select2({
        placeholder: "Selecione o modelo"
    });
    $('.js-example-basic-single2').select2({
        placeholder: "Selecione o grupo"
    });
    $('.js-example-basic-single3').select2({
        placeholder: "Selecione o motor"
    });
    $('.js-example-basic-single4').select2({
        placeholder: "Selecione a posição"
    });
</script>
@endsection