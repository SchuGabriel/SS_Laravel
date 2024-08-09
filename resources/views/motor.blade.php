@extends("layout")
@section('pageTitle', "Novo Motor")
@section("content")
<div class="container">
    <h1>Novo Motor</h1>
    <a href="{{ route('motor.index') }}">Voltar</a>
    @if($motor->id)
    <form action="{{ route('motor.update', ['id'=>$motor->id]) }}" method="post" enctype="multipart/form-data">
        @method("PUT")
        @else
        <form action="{{ route('motor.store') }}" method="post" enctype="multipart/form-data">
            @endif
            @csrf

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="{{ $motor->nome }}">

            <button type="submit">Salvar</button>
        </form>
</div>
@endsection