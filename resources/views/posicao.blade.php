@extends("layout")
@section('pageTitle', "Nova Posicao")
@section("content")
<div class="container">
    <h1>Nova Posicao</h1>
    <a href="{{ route('posicao.index') }}">Voltar</a>
    @if($posicao->id)
    <form action="{{ route('posicao.update', ['id'=>$posicao->id]) }}" method="post" enctype="multipart/form-data">
        @method("PUT")
        @else
        <form action="{{ route('posicao.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $posicao->nome }}">

            <button type="submit">Salvar</button>
        </form>
</div>
@endsection