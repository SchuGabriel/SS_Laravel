@extends("layout")
@section('pageTitle', "Pesquisar")
@section("content")
<div class="container">
    <a href="{{ route('home.pesquisar') }}">Voltar</a>
    <form action="{{ route('pesquisar.search') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="lbl_nome">Referencia:</label>
            <input type="text" id="referencia">
        </div>

        <div>
            <select class="js-example-basic-single2" name="grupo_id" id="grupo_id">
                <option value=""></option>
                @foreach ($grupos as $grupo)
                <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <select class="js-example-basic-single1" name="modelo_id" id="modelo_id">
                <option value=""></option>
                @foreach ($modelos as $modelo)
                <option value="{{ $modelo->id }}">{{ $modelo->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <select class="js-example-basic-single3" name="motor_id" id="motor_id">
                <option value=""></option>
                @foreach ($motores as $motor)
                <option value="{{ $motor->id }}">{{ $motor->nome }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="lbl_Ano">Ano:</label>
            <input type="text" id="ano">
        </div>

        <div>
            <select class="js-example-basic-single4" name="posicao_id" id="posicao_id">
                <option value=""></option>
                @foreach ($posicoes as $posicao)
                <option value="{{ $posicao->id }}">{{ $posicao->nome }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Salvar</button>
    </form>
</div>
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